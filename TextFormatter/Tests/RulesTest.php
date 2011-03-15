<?php

namespace s9e\Toolkit\TextFormatter\Tests;

use s9e\Toolkit\TextFormatter\ConfigBuilder,
    s9e\Toolkit\TextFormatter\Parser,
    s9e\Toolkit\TextFormatter\Renderer;

include_once __DIR__ . '/../ConfigBuilder.php';
include_once __DIR__ . '/../Parser.php';

class RulesTest extends \PHPUnit_Framework_TestCase
{
	public function testRequireParent()
	{
		$text = '[*]list item';
		$xml  = $this->getParser()->parse($text);

		$this->assertNotContains('<LI>', $xml);
	}

	public function testCloseParent()
	{
		$text     = '[list][*]one[*]two[/list]';
		$expected =
		            '<rt><LIST><st>[list]</st><LI><st>[*]</st>one</LI><LI><st>[*]</st>two</LI><et>[/list]</et></LIST></rt>';
		$actual   = $this->getParser()->parse($text);

		$this->assertSame($expected, $actual);
	}

	/**
	* @depends testCloseParent
	*/
	public function testCloseParentWorksOnParentsWithSuffix()
	{
		$text     = '[list][*:123]one[*:456]two[/list]';
		$expected =
		            '<rt><LIST><st>[list]</st><LI><st>[*:123]</st>one</LI><LI><st>[*:456]</st>two</LI><et>[/list]</et></LIST></rt>';
		$actual   = $this->getParser()->parse($text);

		$this->assertSame($expected, $actual);
	}

	public function testDeny()
	{
		$cb = new ConfigBuilder;

		$cb->BBCodes->add('b');
		$cb->BBCodes->add('denied');

		$cb->addBBCodeRule('b', 'deny', 'denied');

		$text     = '[b][denied][/denied][/b]';
		$expected = '<rt><B><st>[b]</st>[denied][/denied]<et>[/b]</et></B></rt>';
		$actual   = $cb->getParser()->parse($text);

		$this->assertSame($expected, $actual);
	}

	public function testAllow()
	{
		$cb = new ConfigBuilder;

		$cb->BBCodes->add('b', array('defaultRule' => 'deny'));
		$cb->BBCodes->add('allowed');
		$cb->BBCodes->add('denied');

		$cb->addBBCodeRule('b', 'allow', 'allowed');

		$text     = '[b][allowed/][denied/][/b]';
		$expected = '<rt><B><st>[b]</st><ALLOWED>[allowed/]</ALLOWED>[denied/]<et>[/b]</et></B></rt>';
		$actual   = $cb->getParser()->parse($text);

		$this->assertSame($expected, $actual);
	}

	public function testRequireAscendant()
	{
		$cb = new ConfigBuilder;

		$cb->BBCodes->add('foo');
		$cb->BBCodes->add('bar');

		$cb->addBBCodeRule('bar', 'requireAscendant', 'foo');

		$text     = ' [bar/] [foo][bar][/bar][/foo]';
		$expected =
		            '<rt> [bar/] <FOO><st>[foo]</st><BAR><st>[bar]</st><et>[/bar]</et></BAR><et>[/foo]</et></FOO></rt>';
		$actual   = $cb->getParser()->parse($text);

		$this->assertSame($expected, $actual);
	}

	/**
	* @depends testDeny
	*/
	public function testRulesCanBeSetOnAliases()
	{
		$cb = new ConfigBuilder;

		$cb->BBCodes->add('b');
		$cb->BBCodes->add('denied');

		$cb->addBBCodeAlias('b', 'b_alias');
		$cb->addBBCodeAlias('denied', 'denied_alias');

		$cb->addBBCodeRule('b_alias', 'deny', 'denied_alias');

		$text     = '[b][denied][/denied][/b]';
		$expected = '<rt><B><st>[b]</st>[denied][/denied]<et>[/b]</et></B></rt>';
		$actual   = $cb->getParser()->parse($text);

		$this->assertSame($expected, $actual);
	}

	protected function getParser()
	{
		$cb = new ConfigBuilder;

		$cb->BBCodes->add('b');
		$cb->BBCodes->add('list');
		$cb->BBCodes->add('li');

		$cb->addBBCodeAlias('li', '*');

		$cb->addBBCodeRule('li', 'requireParent', 'list');
		$cb->addBBCodeRule('li', 'closeParent', 'li');

		return new Parser($cb->getParserConfig());
	}
}