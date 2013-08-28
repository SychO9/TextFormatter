<?php

/**
* @package   s9e\TextFormatter
* @copyright Copyright (c) 2010-2013 The s9e Authors
* @license   http://www.opensource.org/licenses/mit-license.php The MIT License
*/
namespace s9e\TextFormatter\Configurator\Helpers\HTML5;

use DOMDocument;
use DOMXPath;
use s9e\TextFormatter\Configurator\Collections\Ruleset;
use s9e\TextFormatter\Configurator\Collections\TagCollection;
use s9e\TextFormatter\Configurator\Helpers\TemplateHelper;
use s9e\TextFormatter\Configurator\Items\Tag;

abstract class RulesGenerator
{
	/**
	* Generate rules based on HTML5 content models
	*
	* Possible options:
	*
	*  parentHTML: HTML leading to the start of the rendered text. Defaults to "<div>"
	*  renderer:   instance of Renderer, used to render tags that have no individual templates set.
	*              Must output valid XML, not HTML
	*  rootRules:  instance of Ruleset that defines the rules set at the root of the text
	*
	* @param  TagCollection $tags    Tags collection
	* @param  array         $options Array of option settings
	* @return array ['root'=>[ruleName=>targets],'tags'=>[tagName=>[ruleName=>targets]]]
	*/
	public static function getRules(TagCollection $tags, array $options = [])
	{
		// Unless specified otherwise, we consider that the renderered text will be displayed as
		// the child of a <div> element
		$parentHTML = (isset($options['parentHTML']))
		            ? $options['parentHTML']
		            : '<div>';

		// Create a proxy for the parent markup so that we can determine which tags are allowed at
		// the root of the text (IOW, with no parent) or even disabled altogether
		$rootForensics = self::generateRootForensics($parentHTML);

		// Study the tags
		$templateForensics = [];
		foreach ($tags as $tagName => $tag)
		{
			$xsl = self::generateTagXSL($tagName, $tag, $options);

			$templateForensics[$tagName] = new TemplateForensics($xsl);
		}

		// Get the root's ruleset or create an empty ruleset for it otherwise
		$rootRules = (isset($options['rootRules']))
		           ? $options['rootRules']
		           : new Ruleset;

		// Generate a full set of rules
		$rules = self::generateRules($templateForensics, $rootForensics, $rootRules);

		// Clean up tags' rules
		foreach ($rules['tags'] as $tagName => &$tagRules)
		{
			$tagRules = self::cleanUpRules($tagRules);
		}
		unset($tagRules);

		// Clean up root rules
		$rules['root'] = self::cleanUpRules($rules['root']);

		return $rules;
	}

	/**
	* Collect all the XSL used by given tag into a single string
	*
	* @param  string $tagName Tag's name
	* @param  Tag    $tag     Tag object
	* @param  array  $options Helper's option
	* @return string          Tag's XSL, minus the xsl:template root
	*/
	protected static function generateTagXSL($tagName, Tag $tag, array $options)
	{
		$xsl = '';

		foreach ($tag->templates as $template)
		{
			$xsl .= $template;
		}

		// Render the tag and use the result as a template. This allows us to handle tags that are
		// meant to be rendered via a wildcard template, and also cases where the name of an element
		// is not readily available in the template
		if (isset($options['renderer']))
		{
			$uid = sha1(uniqid(mt_rand(), true));
			$xml = '<rt><' . $tagName;

			// Add the namespace declaraction, if applicable
			$pos = strpos($tagName, ':');
			if ($pos !== false)
			{
				$prefix = substr($tagName, 0, $pos);
				$xml .= ' xmlns:' . $prefix . '="urn:s9e:TextFormatter:' . $prefix . '"';
			}

			// Create every attribute defined, given it a value of "x"
			foreach ($tag->attributes as $attrName => $attribute)
			{
				$xml .= ' ' . $attrName . '="x"';
			}

			// Add a unique token that will help detect the output of <xsl:apply-templates/>
			$xml .= '>' . $uid . '</' . $tagName . '></rt>';

			// Render the tag and use TemplateHelper to ensure the result is well-formed XML
			$template = TemplateHelper::saveTemplate(TemplateHelper::loadTemplate(
				$options['renderer']->render($xml)
			));

			// Replace the unique token and append to the XSL
			$xsl .= str_replace($uid, '<xsl:apply-templates/>', $template);
		}

		return $xsl;
	}

	/**
	* Generate a TemplateForensics instance for the root element
	*
	* @param  string            $html Root HTML, e.g. "<div>"
	* @return TemplateForensics
	*/
	protected static function generateRootForensics($html)
	{
		$dom = new DOMDocument;
		$dom->loadHTML($html);

		// Get the document's <body> element
		$body = $dom->getElementsByTagName('body')->item(0);

		// Grab the deepest node
		$node = $body;
		while ($node->firstChild)
		{
			$node = $node->firstChild;
		}

		// Now append an <xsl:apply-templates/> node to make the markup look like a normal template
		$node->appendChild($dom->createElementNS(
			'http://www.w3.org/1999/XSL/Transform',
			'xsl:apply-templates'
		));

		// Finally create and return a new TemplateForensics instance
		return new TemplateForensics($dom->saveXML($body));
	}

	/**
	* Generate and return rules based on a set of TemplateForensics
	*
	* @param  array             $templateForensics Array of [tagName => TemplateForensics]
	* @param  TemplateForensics $rootForensics     TemplateForensics for the root of the text
	* @param  Ruleset           $rootRules         Rules set for the root context
	* @return array
	*/
	protected static function generateRules(array $templateForensics, TemplateForensics $rootForensics, Ruleset $rootRules)
	{
		$rules = [
			'root' => [],
			'tags' => []
		];

		// Create TemplateForensics object that will be used to determine whether to create rules
		// related to newlines and paragraphs
		$br = new TemplateForensics('<br/>');
		$p  = new TemplateForensics('<p><xsl:apply-templates /></p>');

		foreach ($templateForensics as $srcTagName => $srcTag)
		{
			// Test whether this tag can be used with no parent
			$ruleName = ($rootForensics->allowsChild($srcTag)) ? 'allowChild' : 'denyChild';
			$rules['root'][$ruleName][$srcTagName] = $srcTagName;

			// Test whether this tag should be closed automatically
			if ($srcTag->isVoid())
			{
				$rules['tags'][$srcTagName]['autoClose'] = true;
			}

			// Test whether this tag should be reopened automatically
			if ($srcTag->isFormattingElement())
			{
				$rules['tags'][$srcTagName]['autoReopen'] = true;
			}

			// Test whether this tag should break current paragraph
			if ($srcTag->closesParent($p))
			{
				$rules['tags'][$srcTagName]['breakParagraph'] = true;
			}

			// Create a createParagraphs rule for this tag if it's a block tag, the root rules
			// have a createParagraphs rule themselves and the elements are compatible
			if ($srcTag->allowsChild($p)
			 && $srcTag->isBlock()
			 && !$p->closesParent($srcTag)
			 && !empty($rootRules['createParagraphs']))
			{
				$rules['tags'][$srcTagName]['createParagraphs'] = true;
			}

			// Create an ignoreTags rule if the tag's forensics call for it
			if ($srcTag->isEmpty())
			{
				$rules['tags'][$srcTagName]['ignoreTags'] = true;
			}

			// Test whether text children should be ignored
			if (!$srcTag->allowsText())
			{
				$rules['tags'][$srcTagName]['ignoreText'] = true;
			}

			// Create an isTransparent rule if the tag is transparent
			if ($srcTag->isTransparent())
			{
				$rules['tags'][$srcTagName]['isTransparent'] = true;
			}

			// Create a noBrChild rule if the tag does not allow <br/> children
			if (!$srcTag->allowsChild($br))
			{
				$rules['tags'][$srcTagName]['noBrChild'] = true;
			}

			// Create a noBrDescendant rule if the tag does not allow <br/> descendants or if it
			// preserves whitespace (e.g. <pre>)
			if (!$srcTag->allowsDescendant($br) || $srcTag->preservesWhitespace())
			{
				$rules['tags'][$srcTagName]['noBrDescendant'] = true;
			}

			// Test whether this tag is a block-level element, which would mean its surrounding
			// whitespace should be trimmed
			if ($srcTag->isBlock())
			{
				$rules['tags'][$srcTagName]['ignoreSurroundingWhitespace'] = true;
			}

			foreach ($templateForensics as $trgTagName => $trgTag)
			{
				// Test whether the target tag can be a child of the source tag and a descendant
				// of the parent markup
				if ($srcTag->allowsChild($trgTag)
				 && $rootForensics->allowsDescendant($trgTag))
				{
					$rules['tags'][$srcTagName]['allowChild'][$trgTagName] = $trgTagName;
				}
				else
				{
					$rules['tags'][$srcTagName]['denyChild'][$trgTagName] = $trgTagName;
				}

				// Test whether the target tag can be a descendant of the source tag
				if (!$srcTag->allowsDescendant($trgTag))
				{
					$rules['tags'][$srcTagName]['denyDescendant'][$trgTagName] = $trgTagName;
				}

				if ($srcTag->closesParent($trgTag))
				{
					$rules['tags'][$srcTagName]['closeParent'][$trgTagName] = $trgTagName;
				}
			}
		}

		return $rules;
	}

	/**
	* Prune conflicting rules from a set
	*
	* @param  array $rules Array of [ruleName => targets]
	* @return array
	*/
	protected static function cleanUpRules(array $rules)
	{
		// Prepare to resolve conflicting rules
		$precedence = [
			['denyDescendant', 'allowChild'],
			['denyChild',      'allowChild']
		];

		// Apply precedence, e.g. if there's a denyChild rule, remove any allowChild rules
		foreach ($precedence as list($k1, $k2))
		{
			if (!isset($rules[$k1], $rules[$k2]))
			{
				continue;
			}

			$rules[$k2] = array_diff(
				$rules[$k2],
				$rules[$k1]
			);
		}

		// Remove empty rules
		$rules = array_filter($rules);

		return $rules;
	}
}