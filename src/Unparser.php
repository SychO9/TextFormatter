<?php

/**
* @package   s9e\TextFormatter
* @copyright Copyright (c) 2010-2015 The s9e Authors
* @license   http://www.opensource.org/licenses/mit-license.php The MIT License
*/
namespace s9e\TextFormatter;

use DOMDocument;

abstract class Unparser
{
	/**
	* Transform an intermediate representation back to its original form
	*
	* @param  string $xml Intermediate representation
	* @return string      Original text
	*/
	public static function unparse($xml)
	{
		return htmlspecialchars_decode(strip_tags($xml), ENT_QUOTES);
	}
}