<?php

/**
* @package   s9e\TextFormatter
* @copyright Copyright (c) 2010-2013 The s9e Authors
* @license   http://www.opensource.org/licenses/mit-license.php The MIT License
*/
namespace s9e\TextFormatter\Bundles;

abstract class S18 extends \s9e\TextFormatter\Bundle
{
	/**
	* @var s9e\TextFormatter\Parser Singleton instance used by parse()
	*/
	public static $parser;

	/**
	* @var s9e\TextFormatter\Renderer Singleton instance used by render() and renderMulti()
	*/
	public static $renderer;

	/**
	* Return a new instance of s9e\TextFormatter\Parser
	*
	* @return s9e\TextFormatter\Parser
	*/
	public static function getParser()
	{
		return unserialize("O:24:\"s9e\\TextFormatter\\Parser\":4:{s:16:\"\000*\000pluginsConfig\";a:5:{s:7:\"BBCodes\";a:5:{s:7:\"bbcodes\";a:48:{s:4:\"ABBR\";a:0:{}s:7:\"ACRONYM\";a:0:{}s:6:\"ANCHOR\";a:0:{}s:1:\"B\";a:0:{}s:3:\"BDO\";a:0:{}s:5:\"BLACK\";a:0:{}s:4:\"BLUE\";a:0:{}s:2:\"BR\";a:0:{}s:6:\"CENTER\";a:0:{}s:4:\"CODE\";a:1:{s:16:\"defaultAttribute\";s:4:\"lang\";}s:5:\"COLOR\";a:0:{}s:5:\"EMAIL\";a:1:{s:17:\"contentAttributes\";a:1:{i:0;s:5:\"email\";}}s:5:\"FLASH\";a:1:{s:17:\"contentAttributes\";a:1:{i:0;s:7:\"content\";}}s:4:\"FONT\";a:0:{}s:3:\"FTP\";a:1:{s:17:\"contentAttributes\";a:1:{i:0;s:3:\"ftp\";}}s:4:\"GLOW\";a:0:{}s:5:\"GREEN\";a:0:{}s:2:\"HR\";a:0:{}s:4:\"HTML\";a:0:{}s:1:\"I\";a:0:{}s:3:\"IMG\";a:2:{s:17:\"contentAttributes\";a:1:{i:0;s:7:\"content\";}s:16:\"defaultAttribute\";s:3:\"alt\";}s:4:\"IURL\";a:1:{s:17:\"contentAttributes\";a:1:{i:0;s:4:\"iurl\";}}s:4:\"LEFT\";a:0:{}s:2:\"LI\";a:0:{}s:4:\"LIST\";a:1:{s:16:\"defaultAttribute\";s:4:\"type\";}s:3:\"LTR\";a:0:{}s:2:\"ME\";a:0:{}s:4:\"MOVE\";a:0:{}s:5:\"NOBBC\";a:0:{}s:3:\"PRE\";a:0:{}s:5:\"QUOTE\";a:1:{s:16:\"defaultAttribute\";s:6:\"author\";}s:3:\"RED\";a:0:{}s:5:\"RIGHT\";a:0:{}s:3:\"RTL\";a:0:{}s:1:\"S\";a:0:{}s:6:\"SHADOW\";a:0:{}s:4:\"SIZE\";a:0:{}s:3:\"SUB\";a:0:{}s:3:\"SUP\";a:0:{}s:5:\"TABLE\";a:0:{}s:2:\"TD\";a:0:{}s:4:\"TIME\";a:1:{s:17:\"contentAttributes\";a:1:{i:0;s:4:\"time\";}}s:2:\"TR\";a:0:{}s:2:\"TT\";a:0:{}s:1:\"U\";a:0:{}s:3:\"URL\";a:1:{s:17:\"contentAttributes\";a:1:{i:0;s:3:\"url\";}}s:5:\"WHITE\";a:0:{}s:3:\"PHP\";a:2:{s:20:\"predefinedAttributes\";a:1:{s:4:\"lang\";s:3:\"php\";}s:7:\"tagName\";s:4:\"CODE\";}}s:10:\"quickMatch\";s:1:\"[\";s:6:\"regexp\";s:285:\"#\\[/?(A(?:BBR|CRONYM|NCHOR)|B(?:(?:R|DO|L(?:ACK|UE)))?|C(?:ENTER|O(?:DE|LOR))|EMAIL|F(?:LASH|ONT|TP)|G(?:LOW|REEN)|H(?:R|TML)|I(?:MG|URL)?|L(?:EFT|I(?:ST)?|TR)|M(?:OV)?E|NOBBC|P(?:HP|RE)|QUOTE|R(?:ED|IGHT|TL)|S(?:(?:HADOW|IZE|U[BP]))?|T(?:[DRT]|ABLE|IME)|U(?:RL)?|WHITE)(?=[\\] =:/])#iS\";s:11:\"regexpLimit\";i:10000;s:17:\"regexpLimitAction\";s:4:\"warn\";}s:9:\"Emoticons\";a:4:{s:6:\"regexp\";s:89:\"/(?:8\\)|:(?:[DP[o]|'\\[|\\)\\)?|-[*X[\\\\]|:\\))|;[)D]|>:[D[]|\\?\\?\\?|C:-\\)|O(?:0|:-\\))|\\^-\\^)/S\";s:7:\"tagName\";s:1:\"E\";s:11:\"regexpLimit\";i:10000;s:17:\"regexpLimitAction\";s:4:\"warn\";}s:9:\"Autoemail\";a:6:{s:8:\"attrName\";s:5:\"email\";s:10:\"quickMatch\";s:1:\"@\";s:6:\"regexp\";s:39:\"/\\b[-a-z0-9_+.]+@[-a-z0-9.]*[a-z0-9]/Si\";s:7:\"tagName\";s:5:\"EMAIL\";s:11:\"regexpLimit\";i:10000;s:17:\"regexpLimitAction\";s:4:\"warn\";}s:8:\"Autolink\";a:6:{s:8:\"attrName\";s:3:\"url\";s:10:\"quickMatch\";s:3:\"://\";s:6:\"regexp\";s:49:\"#(?:f|ht)tps?://\\S(?:[^\\s\\[\\]]*(?:\\[\\w*\\])?)++#iS\";s:7:\"tagName\";s:3:\"URL\";s:11:\"regexpLimit\";i:10000;s:17:\"regexpLimitAction\";s:4:\"warn\";}s:12:\"HTMLElements\";a:6:{s:10:\"quickMatch\";s:1:\"<\";s:6:\"prefix\";s:4:\"html\";s:6:\"regexp\";s:198:\"#<(?:/((?:a|[su]|b(?:r|lockquote)?|del|em|hr|i(?:mg|ns)?|pre))|((?:a|[su]|b(?:r|lockquote)?|del|em|hr|i(?:mg|ns)?|pre))((?:\\s+[a-z][-a-z]*(?:\\s*=\\s*(?:\"[^\"]*\"|'[^']*'|[^\\s\"'=<>`]+))?)*+)\\s*/?)\\s*>#i\";s:7:\"aliases\";a:2:{s:1:\"a\";a:2:{s:0:\"\";s:3:\"URL\";s:4:\"href\";s:3:\"url\";}s:3:\"img\";a:1:{s:0:\"\";s:3:\"IMG\";}}s:11:\"regexpLimit\";i:10000;s:17:\"regexpLimitAction\";s:4:\"warn\";}}s:17:\"\000*\000registeredVars\";a:1:{s:9:\"urlConfig\";a:2:{s:14:\"allowedSchemes\";s:18:\"/^(?:f|ht)tps?\$/Di\";s:13:\"requireScheme\";b:0;}}s:14:\"\000*\000rootContext\";a:3:{s:15:\"allowedChildren\";s:2:\"_\001\";s:18:\"allowedDescendants\";s:2:\"\377\003\";s:5:\"flags\";i:0;}s:13:\"\000*\000tagsConfig\";a:61:{s:1:\"E\";a:7:{s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:42:\"s9e\\TextFormatter\\Parser::filterAttributes\";s:6:\"params\";a:4:{s:3:\"tag\";N;s:9:\"tagConfig\";N;s:14:\"registeredVars\";N;s:6:\"logger\";N;}}}s:12:\"nestingLimit\";i:10;s:5:\"rules\";a:1:{s:5:\"flags\";i:193;}s:8:\"tagLimit\";i:1000;s:9:\"bitNumber\";i:0;s:15:\"allowedChildren\";s:2:\"\020\001\";s:18:\"allowedDescendants\";s:2:\"\377\003\";}s:4:\"ABBR\";a:8:{s:10:\"attributes\";a:1:{s:4:\"abbr\";a:1:{s:8:\"required\";b:1;}}s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:42:\"s9e\\TextFormatter\\Parser::filterAttributes\";s:6:\"params\";a:4:{s:3:\"tag\";N;s:9:\"tagConfig\";N;s:14:\"registeredVars\";N;s:6:\"logger\";N;}}}s:12:\"nestingLimit\";i:10;s:5:\"rules\";a:1:{s:5:\"flags\";i:0;}s:8:\"tagLimit\";i:1000;s:9:\"bitNumber\";i:0;s:15:\"allowedChildren\";s:2:\"\031\001\";s:18:\"allowedDescendants\";s:2:\"\377\003\";}s:7:\"ACRONYM\";a:8:{s:10:\"attributes\";a:1:{s:7:\"acronym\";a:1:{s:8:\"required\";b:1;}}s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:42:\"s9e\\TextFormatter\\Parser::filterAttributes\";s:6:\"params\";a:4:{s:3:\"tag\";N;s:9:\"tagConfig\";N;s:14:\"registeredVars\";N;s:6:\"logger\";N;}}}s:12:\"nestingLimit\";i:10;s:5:\"rules\";a:1:{s:5:\"flags\";i:0;}s:8:\"tagLimit\";i:1000;s:9:\"bitNumber\";i:0;s:15:\"allowedChildren\";s:2:\"\031\001\";s:18:\"allowedDescendants\";s:2:\"\377\003\";}s:6:\"ANCHOR\";a:8:{s:10:\"attributes\";a:1:{s:6:\"anchor\";a:2:{s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:53:\"s9e\\TextFormatter\\Parser\\BuiltInFilters::filterRegexp\";s:6:\"params\";a:2:{s:9:\"attrValue\";N;i:0;s:23:\"/^#?[a-z][-a-z_0-9]*\$/i\";}}}s:8:\"required\";b:1;}}s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:42:\"s9e\\TextFormatter\\Parser::filterAttributes\";s:6:\"params\";a:4:{s:3:\"tag\";N;s:9:\"tagConfig\";N;s:14:\"registeredVars\";N;s:6:\"logger\";N;}}}s:12:\"nestingLimit\";i:10;s:5:\"rules\";a:1:{s:5:\"flags\";i:0;}s:8:\"tagLimit\";i:1000;s:9:\"bitNumber\";i:0;s:15:\"allowedChildren\";s:2:\"\031\001\";s:18:\"allowedDescendants\";s:2:\"\377\003\";}s:1:\"B\";a:7:{s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:42:\"s9e\\TextFormatter\\Parser::filterAttributes\";s:6:\"params\";a:4:{s:3:\"tag\";N;s:9:\"tagConfig\";N;s:14:\"registeredVars\";N;s:6:\"logger\";N;}}}s:12:\"nestingLimit\";i:10;s:5:\"rules\";a:1:{s:5:\"flags\";i:0;}s:8:\"tagLimit\";i:1000;s:9:\"bitNumber\";i:0;s:15:\"allowedChildren\";s:2:\"\031\001\";s:18:\"allowedDescendants\";s:2:\"\377\003\";}s:3:\"BDO\";a:8:{s:10:\"attributes\";a:1:{s:3:\"bdo\";a:2:{s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:53:\"s9e\\TextFormatter\\Parser\\BuiltInFilters::filterRegexp\";s:6:\"params\";a:2:{s:9:\"attrValue\";N;i:0;s:17:\"/^(?:ltr|rtl)\$/Di\";}}}s:8:\"required\";b:1;}}s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:42:\"s9e\\TextFormatter\\Parser::filterAttributes\";s:6:\"params\";a:4:{s:3:\"tag\";N;s:9:\"tagConfig\";N;s:14:\"registeredVars\";N;s:6:\"logger\";N;}}}s:12:\"nestingLimit\";i:10;s:5:\"rules\";a:1:{s:5:\"flags\";i:0;}s:8:\"tagLimit\";i:1000;s:9:\"bitNumber\";i:0;s:15:\"allowedChildren\";s:2:\"\031\001\";s:18:\"allowedDescendants\";s:2:\"\377\003\";}s:5:\"BLACK\";a:7:{s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:42:\"s9e\\TextFormatter\\Parser::filterAttributes\";s:6:\"params\";a:4:{s:3:\"tag\";N;s:9:\"tagConfig\";N;s:14:\"registeredVars\";N;s:6:\"logger\";N;}}}s:12:\"nestingLimit\";i:10;s:5:\"rules\";a:1:{s:5:\"flags\";i:0;}s:8:\"tagLimit\";i:1000;s:9:\"bitNumber\";i:0;s:15:\"allowedChildren\";s:2:\"\031\001\";s:18:\"allowedDescendants\";s:2:\"\377\003\";}s:4:\"BLUE\";a:7:{s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:42:\"s9e\\TextFormatter\\Parser::filterAttributes\";s:6:\"params\";a:4:{s:3:\"tag\";N;s:9:\"tagConfig\";N;s:14:\"registeredVars\";N;s:6:\"logger\";N;}}}s:12:\"nestingLimit\";i:10;s:5:\"rules\";a:1:{s:5:\"flags\";i:0;}s:8:\"tagLimit\";i:1000;s:9:\"bitNumber\";i:0;s:15:\"allowedChildren\";s:2:\"\031\001\";s:18:\"allowedDescendants\";s:2:\"\377\003\";}s:2:\"BR\";a:7:{s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:42:\"s9e\\TextFormatter\\Parser::filterAttributes\";s:6:\"params\";a:4:{s:3:\"tag\";N;s:9:\"tagConfig\";N;s:14:\"registeredVars\";N;s:6:\"logger\";N;}}}s:12:\"nestingLimit\";i:10;s:5:\"rules\";a:1:{s:5:\"flags\";i:193;}s:8:\"tagLimit\";i:1000;s:9:\"bitNumber\";i:0;s:15:\"allowedChildren\";s:2:\"\020\001\";s:18:\"allowedDescendants\";s:2:\"\377\003\";}s:6:\"CENTER\";a:7:{s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:42:\"s9e\\TextFormatter\\Parser::filterAttributes\";s:6:\"params\";a:4:{s:3:\"tag\";N;s:9:\"tagConfig\";N;s:14:\"registeredVars\";N;s:6:\"logger\";N;}}}s:12:\"nestingLimit\";i:10;s:5:\"rules\";a:1:{s:5:\"flags\";i:512;}s:8:\"tagLimit\";i:1000;s:9:\"bitNumber\";i:1;s:15:\"allowedChildren\";s:2:\"_\001\";s:18:\"allowedDescendants\";s:2:\"\377\003\";}s:4:\"CODE\";a:8:{s:10:\"attributes\";a:1:{s:4:\"lang\";a:2:{s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:57:\"s9e\\TextFormatter\\Parser\\BuiltInFilters::filterSimpletext\";s:6:\"params\";a:1:{s:9:\"attrValue\";N;}}}s:8:\"required\";b:0;}}s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:42:\"s9e\\TextFormatter\\Parser::filterAttributes\";s:6:\"params\";a:4:{s:3:\"tag\";N;s:9:\"tagConfig\";N;s:14:\"registeredVars\";N;s:6:\"logger\";N;}}}s:12:\"nestingLimit\";i:10;s:5:\"rules\";a:1:{s:5:\"flags\";i:912;}s:8:\"tagLimit\";i:1000;s:9:\"bitNumber\";i:2;s:15:\"allowedChildren\";s:2:\"\000\000\";s:18:\"allowedDescendants\";s:2:\"\000\000\";}s:5:\"COLOR\";a:8:{s:10:\"attributes\";a:1:{s:5:\"color\";a:2:{s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:52:\"s9e\\TextFormatter\\Parser\\BuiltInFilters::filterColor\";s:6:\"params\";a:1:{s:9:\"attrValue\";N;}}}s:8:\"required\";b:1;}}s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:42:\"s9e\\TextFormatter\\Parser::filterAttributes\";s:6:\"params\";a:4:{s:3:\"tag\";N;s:9:\"tagConfig\";N;s:14:\"registeredVars\";N;s:6:\"logger\";N;}}}s:12:\"nestingLimit\";i:10;s:5:\"rules\";a:1:{s:5:\"flags\";i:0;}s:8:\"tagLimit\";i:1000;s:9:\"bitNumber\";i:0;s:15:\"allowedChildren\";s:2:\"\031\001\";s:18:\"allowedDescendants\";s:2:\"\377\003\";}s:5:\"EMAIL\";a:8:{s:10:\"attributes\";a:1:{s:5:\"email\";a:2:{s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:52:\"s9e\\TextFormatter\\Parser\\BuiltInFilters::filterEmail\";s:6:\"params\";a:1:{s:9:\"attrValue\";N;}}}s:8:\"required\";b:1;}}s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:42:\"s9e\\TextFormatter\\Parser::filterAttributes\";s:6:\"params\";a:4:{s:3:\"tag\";N;s:9:\"tagConfig\";N;s:14:\"registeredVars\";N;s:6:\"logger\";N;}}}s:12:\"nestingLimit\";i:10;s:5:\"rules\";a:1:{s:5:\"flags\";i:66;}s:8:\"tagLimit\";i:1000;s:9:\"bitNumber\";i:3;s:15:\"allowedChildren\";s:2:\"S\001\";s:18:\"allowedDescendants\";s:2:\"\363\003\";}s:5:\"FLASH\";a:9:{s:10:\"attributes\";a:3:{s:7:\"content\";a:2:{s:11:\"filterChain\";a:2:{i:0;a:2:{s:8:\"callback\";s:49:\"s9e\\TextFormatter\\Bundles\\S18\\Helper::prependHttp\";s:6:\"params\";a:1:{s:9:\"attrValue\";N;}}i:1;a:2:{s:8:\"callback\";s:50:\"s9e\\TextFormatter\\Parser\\BuiltInFilters::filterUrl\";s:6:\"params\";a:3:{s:9:\"attrValue\";N;s:9:\"urlConfig\";N;s:6:\"logger\";N;}}}s:8:\"required\";b:1;}s:6:\"flash0\";a:2:{s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:53:\"s9e\\TextFormatter\\Parser\\BuiltInFilters::filterNumber\";s:6:\"params\";a:1:{s:9:\"attrValue\";N;}}}s:8:\"required\";b:1;}s:6:\"flash1\";a:2:{s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:53:\"s9e\\TextFormatter\\Parser\\BuiltInFilters::filterNumber\";s:6:\"params\";a:1:{s:9:\"attrValue\";N;}}}s:8:\"required\";b:1;}}s:22:\"attributePreprocessors\";a:1:{i:0;a:2:{i:0;s:5:\"flash\";i:1;s:34:\"/^(?<flash0>\\d+),(?<flash1>\\d+)\$/D\";}}s:11:\"filterChain\";a:2:{i:0;a:2:{s:8:\"callback\";s:55:\"s9e\\TextFormatter\\Parser::executeAttributePreprocessors\";s:6:\"params\";a:2:{s:3:\"tag\";N;s:9:\"tagConfig\";N;}}i:1;a:2:{s:8:\"callback\";s:42:\"s9e\\TextFormatter\\Parser::filterAttributes\";s:6:\"params\";a:4:{s:3:\"tag\";N;s:9:\"tagConfig\";N;s:14:\"registeredVars\";N;s:6:\"logger\";N;}}}s:12:\"nestingLimit\";i:10;s:5:\"rules\";a:1:{s:5:\"flags\";i:193;}s:8:\"tagLimit\";i:1000;s:9:\"bitNumber\";i:3;s:15:\"allowedChildren\";s:2:\"\020\001\";s:18:\"allowedDescendants\";s:2:\"\377\003\";}s:4:\"FONT\";a:8:{s:10:\"attributes\";a:1:{s:4:\"font\";a:2:{s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:57:\"s9e\\TextFormatter\\Parser\\BuiltInFilters::filterSimpletext\";s:6:\"params\";a:1:{s:9:\"attrValue\";N;}}}s:8:\"required\";b:1;}}s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:42:\"s9e\\TextFormatter\\Parser::filterAttributes\";s:6:\"params\";a:4:{s:3:\"tag\";N;s:9:\"tagConfig\";N;s:14:\"registeredVars\";N;s:6:\"logger\";N;}}}s:12:\"nestingLimit\";i:10;s:5:\"rules\";a:1:{s:5:\"flags\";i:0;}s:8:\"tagLimit\";i:1000;s:9:\"bitNumber\";i:0;s:15:\"allowedChildren\";s:2:\"\031\001\";s:18:\"allowedDescendants\";s:2:\"\377\003\";}s:3:\"FTP\";a:8:{s:10:\"attributes\";a:1:{s:3:\"ftp\";a:2:{s:11:\"filterChain\";a:2:{i:0;a:2:{s:8:\"callback\";s:48:\"s9e\\TextFormatter\\Bundles\\S18\\Helper::prependFtp\";s:6:\"params\";a:1:{s:9:\"attrValue\";N;}}i:1;a:2:{s:8:\"callback\";s:50:\"s9e\\TextFormatter\\Parser\\BuiltInFilters::filterUrl\";s:6:\"params\";a:3:{s:9:\"attrValue\";N;s:9:\"urlConfig\";N;s:6:\"logger\";N;}}}s:8:\"required\";b:1;}}s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:42:\"s9e\\TextFormatter\\Parser::filterAttributes\";s:6:\"params\";a:4:{s:3:\"tag\";N;s:9:\"tagConfig\";N;s:14:\"registeredVars\";N;s:6:\"logger\";N;}}}s:12:\"nestingLimit\";i:10;s:5:\"rules\";a:1:{s:5:\"flags\";i:66;}s:8:\"tagLimit\";i:1000;s:9:\"bitNumber\";i:3;s:15:\"allowedChildren\";s:2:\"S\001\";s:18:\"allowedDescendants\";s:2:\"\363\003\";}s:4:\"GLOW\";a:9:{s:10:\"attributes\";a:2:{s:5:\"glow0\";a:2:{s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:52:\"s9e\\TextFormatter\\Parser\\BuiltInFilters::filterColor\";s:6:\"params\";a:1:{s:9:\"attrValue\";N;}}}s:8:\"required\";b:1;}s:5:\"glow1\";a:2:{s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:53:\"s9e\\TextFormatter\\Parser\\BuiltInFilters::filterNumber\";s:6:\"params\";a:1:{s:9:\"attrValue\";N;}}}s:8:\"required\";b:1;}}s:22:\"attributePreprocessors\";a:1:{i:0;a:2:{i:0;s:4:\"glow\";i:1;s:52:\"/^(?<glow0>[a-zA-Z]+|#[0-9a-fA-F]+),(?<glow1>\\d+)\$/D\";}}s:11:\"filterChain\";a:2:{i:0;a:2:{s:8:\"callback\";s:55:\"s9e\\TextFormatter\\Parser::executeAttributePreprocessors\";s:6:\"params\";a:2:{s:3:\"tag\";N;s:9:\"tagConfig\";N;}}i:1;a:2:{s:8:\"callback\";s:42:\"s9e\\TextFormatter\\Parser::filterAttributes\";s:6:\"params\";a:4:{s:3:\"tag\";N;s:9:\"tagConfig\";N;s:14:\"registeredVars\";N;s:6:\"logger\";N;}}}s:12:\"nestingLimit\";i:10;s:5:\"rules\";a:1:{s:5:\"flags\";i:640;}s:8:\"tagLimit\";i:1000;s:9:\"bitNumber\";i:1;s:15:\"allowedChildren\";s:2:\"\020\001\";s:18:\"allowedDescendants\";s:2:\"\377\003\";}s:5:\"GREEN\";a:7:{s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:42:\"s9e\\TextFormatter\\Parser::filterAttributes\";s:6:\"params\";a:4:{s:3:\"tag\";N;s:9:\"tagConfig\";N;s:14:\"registeredVars\";N;s:6:\"logger\";N;}}}s:12:\"nestingLimit\";i:10;s:5:\"rules\";a:1:{s:5:\"flags\";i:0;}s:8:\"tagLimit\";i:1000;s:9:\"bitNumber\";i:0;s:15:\"allowedChildren\";s:2:\"\031\001\";s:18:\"allowedDescendants\";s:2:\"\377\003\";}s:2:\"HR\";a:7:{s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:42:\"s9e\\TextFormatter\\Parser::filterAttributes\";s:6:\"params\";a:4:{s:3:\"tag\";N;s:9:\"tagConfig\";N;s:14:\"registeredVars\";N;s:6:\"logger\";N;}}}s:12:\"nestingLimit\";i:10;s:5:\"rules\";a:1:{s:5:\"flags\";i:705;}s:8:\"tagLimit\";i:1000;s:9:\"bitNumber\";i:1;s:15:\"allowedChildren\";s:2:\"\020\001\";s:18:\"allowedDescendants\";s:2:\"\377\003\";}s:4:\"HTML\";a:7:{s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:42:\"s9e\\TextFormatter\\Parser::filterAttributes\";s:6:\"params\";a:4:{s:3:\"tag\";N;s:9:\"tagConfig\";N;s:14:\"registeredVars\";N;s:6:\"logger\";N;}}}s:12:\"nestingLimit\";i:10;s:5:\"rules\";a:1:{s:5:\"flags\";i:64;}s:8:\"tagLimit\";i:1000;s:9:\"bitNumber\";i:4;s:15:\"allowedChildren\";s:2:\"_\001\";s:18:\"allowedDescendants\";s:2:\"\377\003\";}s:1:\"I\";a:7:{s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:42:\"s9e\\TextFormatter\\Parser::filterAttributes\";s:6:\"params\";a:4:{s:3:\"tag\";N;s:9:\"tagConfig\";N;s:14:\"registeredVars\";N;s:6:\"logger\";N;}}}s:12:\"nestingLimit\";i:10;s:5:\"rules\";a:1:{s:5:\"flags\";i:2;}s:8:\"tagLimit\";i:1000;s:9:\"bitNumber\";i:0;s:15:\"allowedChildren\";s:2:\"\031\001\";s:18:\"allowedDescendants\";s:2:\"\377\003\";}s:3:\"IMG\";a:8:{s:10:\"attributes\";a:4:{s:3:\"alt\";a:1:{s:8:\"required\";b:0;}s:6:\"height\";a:2:{s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:53:\"s9e\\TextFormatter\\Parser\\BuiltInFilters::filterNumber\";s:6:\"params\";a:1:{s:9:\"attrValue\";N;}}}s:8:\"required\";b:0;}s:5:\"width\";a:2:{s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:53:\"s9e\\TextFormatter\\Parser\\BuiltInFilters::filterNumber\";s:6:\"params\";a:1:{s:9:\"attrValue\";N;}}}s:8:\"required\";b:0;}s:7:\"content\";a:2:{s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:50:\"s9e\\TextFormatter\\Parser\\BuiltInFilters::filterUrl\";s:6:\"params\";a:3:{s:9:\"attrValue\";N;s:9:\"urlConfig\";N;s:6:\"logger\";N;}}}s:8:\"required\";b:1;}}s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:42:\"s9e\\TextFormatter\\Parser::filterAttributes\";s:6:\"params\";a:4:{s:3:\"tag\";N;s:9:\"tagConfig\";N;s:14:\"registeredVars\";N;s:6:\"logger\";N;}}}s:12:\"nestingLimit\";i:10;s:5:\"rules\";a:1:{s:5:\"flags\";i:193;}s:8:\"tagLimit\";i:1000;s:9:\"bitNumber\";i:0;s:15:\"allowedChildren\";s:2:\"\020\001\";s:18:\"allowedDescendants\";s:2:\"\377\003\";}s:4:\"IURL\";a:8:{s:10:\"attributes\";a:1:{s:4:\"iurl\";a:2:{s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:48:\"s9e\\TextFormatter\\Bundles\\S18\\Helper::filterIurl\";s:6:\"params\";a:3:{s:9:\"attrValue\";N;s:9:\"urlConfig\";N;s:6:\"logger\";N;}}}s:8:\"required\";b:1;}}s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:42:\"s9e\\TextFormatter\\Parser::filterAttributes\";s:6:\"params\";a:4:{s:3:\"tag\";N;s:9:\"tagConfig\";N;s:14:\"registeredVars\";N;s:6:\"logger\";N;}}}s:12:\"nestingLimit\";i:10;s:5:\"rules\";a:1:{s:5:\"flags\";i:66;}s:8:\"tagLimit\";i:1000;s:9:\"bitNumber\";i:3;s:15:\"allowedChildren\";s:2:\"S\001\";s:18:\"allowedDescendants\";s:2:\"\363\003\";}s:4:\"LEFT\";a:7:{s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:42:\"s9e\\TextFormatter\\Parser::filterAttributes\";s:6:\"params\";a:4:{s:3:\"tag\";N;s:9:\"tagConfig\";N;s:14:\"registeredVars\";N;s:6:\"logger\";N;}}}s:12:\"nestingLimit\";i:10;s:5:\"rules\";a:1:{s:5:\"flags\";i:512;}s:8:\"tagLimit\";i:1000;s:9:\"bitNumber\";i:1;s:15:\"allowedChildren\";s:2:\"_\001\";s:18:\"allowedDescendants\";s:2:\"\377\003\";}s:2:\"LI\";a:7:{s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:42:\"s9e\\TextFormatter\\Parser::filterAttributes\";s:6:\"params\";a:4:{s:3:\"tag\";N;s:9:\"tagConfig\";N;s:14:\"registeredVars\";N;s:6:\"logger\";N;}}}s:12:\"nestingLimit\";i:10;s:5:\"rules\";a:2:{s:11:\"closeParent\";a:1:{s:2:\"LI\";i:1;}s:5:\"flags\";i:512;}s:8:\"tagLimit\";i:1000;s:9:\"bitNumber\";i:5;s:15:\"allowedChildren\";s:2:\"_\001\";s:18:\"allowedDescendants\";s:2:\"\377\003\";}s:4:\"LIST\";a:8:{s:10:\"attributes\";a:1:{s:4:\"type\";a:2:{s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:53:\"s9e\\TextFormatter\\Parser\\BuiltInFilters::filterRegexp\";s:6:\"params\";a:2:{s:9:\"attrValue\";N;i:0;s:211:\"/^(?:armenian|c(?:ircle|jk-ideographic)|d(?:ecimal(?:-leading-zero)?|isc)|georgian|h(?:ebrew|iragana(?:-iroha)?)|katakana(?:-iroha)?|lower-(?:alpha|greek|latin|roman)|none|square|upper-(?:alpha|latin|roman))\$/Di\";}}}s:8:\"required\";b:0;}}s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:42:\"s9e\\TextFormatter\\Parser::filterAttributes\";s:6:\"params\";a:4:{s:3:\"tag\";N;s:9:\"tagConfig\";N;s:14:\"registeredVars\";N;s:6:\"logger\";N;}}}s:12:\"nestingLimit\";i:10;s:5:\"rules\";a:1:{s:5:\"flags\";i:672;}s:8:\"tagLimit\";i:1000;s:9:\"bitNumber\";i:1;s:15:\"allowedChildren\";s:2:\"0\000\";s:18:\"allowedDescendants\";s:2:\"\377\003\";}s:3:\"LTR\";a:7:{s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:42:\"s9e\\TextFormatter\\Parser::filterAttributes\";s:6:\"params\";a:4:{s:3:\"tag\";N;s:9:\"tagConfig\";N;s:14:\"registeredVars\";N;s:6:\"logger\";N;}}}s:12:\"nestingLimit\";i:10;s:5:\"rules\";a:1:{s:5:\"flags\";i:512;}s:8:\"tagLimit\";i:1000;s:9:\"bitNumber\";i:1;s:15:\"allowedChildren\";s:2:\"_\001\";s:18:\"allowedDescendants\";s:2:\"\377\003\";}s:2:\"ME\";a:8:{s:10:\"attributes\";a:1:{s:2:\"me\";a:1:{s:8:\"required\";b:1;}}s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:42:\"s9e\\TextFormatter\\Parser::filterAttributes\";s:6:\"params\";a:4:{s:3:\"tag\";N;s:9:\"tagConfig\";N;s:14:\"registeredVars\";N;s:6:\"logger\";N;}}}s:12:\"nestingLimit\";i:10;s:5:\"rules\";a:1:{s:5:\"flags\";i:512;}s:8:\"tagLimit\";i:1000;s:9:\"bitNumber\";i:6;s:15:\"allowedChildren\";s:2:\"\037\001\";s:18:\"allowedDescendants\";s:2:\"\377\003\";}s:4:\"MOVE\";a:7:{s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:42:\"s9e\\TextFormatter\\Parser::filterAttributes\";s:6:\"params\";a:4:{s:3:\"tag\";N;s:9:\"tagConfig\";N;s:14:\"registeredVars\";N;s:6:\"logger\";N;}}}s:12:\"nestingLimit\";i:10;s:5:\"rules\";a:1:{s:5:\"flags\";i:0;}s:8:\"tagLimit\";i:1000;s:9:\"bitNumber\";i:0;s:15:\"allowedChildren\";s:2:\"\031\001\";s:18:\"allowedDescendants\";s:2:\"\377\003\";}s:5:\"NOBBC\";a:7:{s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:42:\"s9e\\TextFormatter\\Parser::filterAttributes\";s:6:\"params\";a:4:{s:3:\"tag\";N;s:9:\"tagConfig\";N;s:14:\"registeredVars\";N;s:6:\"logger\";N;}}}s:12:\"nestingLimit\";i:10;s:5:\"rules\";a:1:{s:5:\"flags\";i:80;}s:8:\"tagLimit\";i:1000;s:9:\"bitNumber\";i:4;s:15:\"allowedChildren\";s:2:\"\000\000\";s:18:\"allowedDescendants\";s:2:\"\000\000\";}s:3:\"PRE\";a:7:{s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:42:\"s9e\\TextFormatter\\Parser::filterAttributes\";s:6:\"params\";a:4:{s:3:\"tag\";N;s:9:\"tagConfig\";N;s:14:\"registeredVars\";N;s:6:\"logger\";N;}}}s:12:\"nestingLimit\";i:10;s:5:\"rules\";a:1:{s:5:\"flags\";i:896;}s:8:\"tagLimit\";i:1000;s:9:\"bitNumber\";i:1;s:15:\"allowedChildren\";s:2:\"\031\001\";s:18:\"allowedDescendants\";s:2:\"\377\003\";}s:5:\"QUOTE\";a:8:{s:10:\"attributes\";a:3:{s:6:\"author\";a:1:{s:8:\"required\";b:0;}s:4:\"date\";a:2:{s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:53:\"s9e\\TextFormatter\\Parser\\BuiltInFilters::filterNumber\";s:6:\"params\";a:1:{s:9:\"attrValue\";N;}}}s:8:\"required\";b:0;}s:4:\"link\";a:2:{s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:53:\"s9e\\TextFormatter\\Parser\\BuiltInFilters::filterRegexp\";s:6:\"params\";a:2:{s:9:\"attrValue\";N;i:0;s:115:\"!^(?:board=\\d+;)?(?:t(?:opic|hreadid)=[\\dmsg#./]{1,40}(?:;start=[\\dmsg#./]{1,40})?|msg=\\d+?|action=profile;u=\\d+)\$!\";}}}s:8:\"required\";b:0;}}s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:42:\"s9e\\TextFormatter\\Parser::filterAttributes\";s:6:\"params\";a:4:{s:3:\"tag\";N;s:9:\"tagConfig\";N;s:14:\"registeredVars\";N;s:6:\"logger\";N;}}}s:12:\"nestingLimit\";i:10;s:5:\"rules\";a:1:{s:5:\"flags\";i:512;}s:8:\"tagLimit\";i:1000;s:9:\"bitNumber\";i:2;s:15:\"allowedChildren\";s:2:\"_\001\";s:18:\"allowedDescendants\";s:2:\"\377\003\";}s:3:\"RED\";a:7:{s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:42:\"s9e\\TextFormatter\\Parser::filterAttributes\";s:6:\"params\";a:4:{s:3:\"tag\";N;s:9:\"tagConfig\";N;s:14:\"registeredVars\";N;s:6:\"logger\";N;}}}s:12:\"nestingLimit\";i:10;s:5:\"rules\";a:1:{s:5:\"flags\";i:0;}s:8:\"tagLimit\";i:1000;s:9:\"bitNumber\";i:0;s:15:\"allowedChildren\";s:2:\"\031\001\";s:18:\"allowedDescendants\";s:2:\"\377\003\";}s:5:\"RIGHT\";a:7:{s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:42:\"s9e\\TextFormatter\\Parser::filterAttributes\";s:6:\"params\";a:4:{s:3:\"tag\";N;s:9:\"tagConfig\";N;s:14:\"registeredVars\";N;s:6:\"logger\";N;}}}s:12:\"nestingLimit\";i:10;s:5:\"rules\";a:1:{s:5:\"flags\";i:512;}s:8:\"tagLimit\";i:1000;s:9:\"bitNumber\";i:1;s:15:\"allowedChildren\";s:2:\"_\001\";s:18:\"allowedDescendants\";s:2:\"\377\003\";}s:3:\"RTL\";a:7:{s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:42:\"s9e\\TextFormatter\\Parser::filterAttributes\";s:6:\"params\";a:4:{s:3:\"tag\";N;s:9:\"tagConfig\";N;s:14:\"registeredVars\";N;s:6:\"logger\";N;}}}s:12:\"nestingLimit\";i:10;s:5:\"rules\";a:1:{s:5:\"flags\";i:512;}s:8:\"tagLimit\";i:1000;s:9:\"bitNumber\";i:1;s:15:\"allowedChildren\";s:2:\"_\001\";s:18:\"allowedDescendants\";s:2:\"\377\003\";}s:1:\"S\";a:7:{s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:42:\"s9e\\TextFormatter\\Parser::filterAttributes\";s:6:\"params\";a:4:{s:3:\"tag\";N;s:9:\"tagConfig\";N;s:14:\"registeredVars\";N;s:6:\"logger\";N;}}}s:12:\"nestingLimit\";i:10;s:5:\"rules\";a:1:{s:5:\"flags\";i:64;}s:8:\"tagLimit\";i:1000;s:9:\"bitNumber\";i:0;s:15:\"allowedChildren\";s:2:\"_\001\";s:18:\"allowedDescendants\";s:2:\"\377\003\";}s:6:\"SHADOW\";a:9:{s:10:\"attributes\";a:2:{s:5:\"color\";a:2:{s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:53:\"s9e\\TextFormatter\\Parser\\BuiltInFilters::filterRegexp\";s:6:\"params\";a:2:{s:9:\"attrValue\";N;i:0;s:29:\"/^(?:[#0-9a-zA-Z\\-]{3,12})\$/D\";}}}s:8:\"required\";b:1;}s:9:\"direction\";a:2:{s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:53:\"s9e\\TextFormatter\\Parser\\BuiltInFilters::filterRegexp\";s:6:\"params\";a:2:{s:9:\"attrValue\";N;i:0;s:44:\"/^(?:left|right|top|bottom|[0123]\\d{0,2})\$/D\";}}}s:8:\"required\";b:1;}}s:22:\"attributePreprocessors\";a:1:{i:0;a:2:{i:0;s:6:\"shadow\";i:1;s:83:\"/^(?<color>[#0-9a-zA-Z\\-]{3,12}),(?<direction>left|right|top|bottom|[0123]\\d{0,2})/\";}}s:11:\"filterChain\";a:2:{i:0;a:2:{s:8:\"callback\";s:55:\"s9e\\TextFormatter\\Parser::executeAttributePreprocessors\";s:6:\"params\";a:2:{s:3:\"tag\";N;s:9:\"tagConfig\";N;}}i:1;a:2:{s:8:\"callback\";s:42:\"s9e\\TextFormatter\\Parser::filterAttributes\";s:6:\"params\";a:4:{s:3:\"tag\";N;s:9:\"tagConfig\";N;s:14:\"registeredVars\";N;s:6:\"logger\";N;}}}s:12:\"nestingLimit\";i:10;s:5:\"rules\";a:1:{s:5:\"flags\";i:0;}s:8:\"tagLimit\";i:1000;s:9:\"bitNumber\";i:0;s:15:\"allowedChildren\";s:2:\"\031\001\";s:18:\"allowedDescendants\";s:2:\"\377\003\";}s:4:\"SIZE\";a:8:{s:10:\"attributes\";a:1:{s:4:\"size\";a:2:{s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:53:\"s9e\\TextFormatter\\Parser\\BuiltInFilters::filterRegexp\";s:6:\"params\";a:2:{s:9:\"attrValue\";N;i:0;s:101:\"/^([1-9][\\d]?p[xt]|small(?:er)?|larger?|xx?-(?:small|large)|medium|(?:0\\.[1-9]|[1-9](\\.\\d\\d?)?)?em)\$/\";}}}s:8:\"required\";b:1;}}s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:42:\"s9e\\TextFormatter\\Parser::filterAttributes\";s:6:\"params\";a:4:{s:3:\"tag\";N;s:9:\"tagConfig\";N;s:14:\"registeredVars\";N;s:6:\"logger\";N;}}}s:12:\"nestingLimit\";i:10;s:5:\"rules\";a:1:{s:5:\"flags\";i:0;}s:8:\"tagLimit\";i:1000;s:9:\"bitNumber\";i:0;s:15:\"allowedChildren\";s:2:\"\031\001\";s:18:\"allowedDescendants\";s:2:\"\377\003\";}s:3:\"SUB\";a:7:{s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:42:\"s9e\\TextFormatter\\Parser::filterAttributes\";s:6:\"params\";a:4:{s:3:\"tag\";N;s:9:\"tagConfig\";N;s:14:\"registeredVars\";N;s:6:\"logger\";N;}}}s:12:\"nestingLimit\";i:10;s:5:\"rules\";a:1:{s:5:\"flags\";i:0;}s:8:\"tagLimit\";i:1000;s:9:\"bitNumber\";i:0;s:15:\"allowedChildren\";s:2:\"\031\001\";s:18:\"allowedDescendants\";s:2:\"\377\003\";}s:3:\"SUP\";a:7:{s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:42:\"s9e\\TextFormatter\\Parser::filterAttributes\";s:6:\"params\";a:4:{s:3:\"tag\";N;s:9:\"tagConfig\";N;s:14:\"registeredVars\";N;s:6:\"logger\";N;}}}s:12:\"nestingLimit\";i:10;s:5:\"rules\";a:1:{s:5:\"flags\";i:0;}s:8:\"tagLimit\";i:1000;s:9:\"bitNumber\";i:0;s:15:\"allowedChildren\";s:2:\"\031\001\";s:18:\"allowedDescendants\";s:2:\"\377\003\";}s:5:\"TABLE\";a:7:{s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:42:\"s9e\\TextFormatter\\Parser::filterAttributes\";s:6:\"params\";a:4:{s:3:\"tag\";N;s:9:\"tagConfig\";N;s:14:\"registeredVars\";N;s:6:\"logger\";N;}}}s:12:\"nestingLimit\";i:10;s:5:\"rules\";a:1:{s:5:\"flags\";i:672;}s:8:\"tagLimit\";i:1000;s:9:\"bitNumber\";i:1;s:15:\"allowedChildren\";s:2:\"\020\002\";s:18:\"allowedDescendants\";s:2:\"\377\003\";}s:2:\"TD\";a:7:{s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:42:\"s9e\\TextFormatter\\Parser::filterAttributes\";s:6:\"params\";a:4:{s:3:\"tag\";N;s:9:\"tagConfig\";N;s:14:\"registeredVars\";N;s:6:\"logger\";N;}}}s:12:\"nestingLimit\";i:10;s:5:\"rules\";a:2:{s:11:\"closeParent\";a:2:{s:4:\"GLOW\";i:1;s:2:\"TD\";i:1;}s:5:\"flags\";i:512;}s:8:\"tagLimit\";i:1000;s:9:\"bitNumber\";i:7;s:15:\"allowedChildren\";s:2:\"_\001\";s:18:\"allowedDescendants\";s:2:\"\377\003\";}s:4:\"TIME\";a:8:{s:10:\"attributes\";a:1:{s:4:\"time\";a:2:{s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:53:\"s9e\\TextFormatter\\Parser\\BuiltInFilters::filterNumber\";s:6:\"params\";a:1:{s:9:\"attrValue\";N;}}}s:8:\"required\";b:1;}}s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:42:\"s9e\\TextFormatter\\Parser::filterAttributes\";s:6:\"params\";a:4:{s:3:\"tag\";N;s:9:\"tagConfig\";N;s:14:\"registeredVars\";N;s:6:\"logger\";N;}}}s:12:\"nestingLimit\";i:10;s:5:\"rules\";a:1:{s:5:\"flags\";i:193;}s:8:\"tagLimit\";i:1000;s:9:\"bitNumber\";i:8;s:15:\"allowedChildren\";s:2:\"\020\001\";s:18:\"allowedDescendants\";s:2:\"\377\003\";}s:2:\"TR\";a:7:{s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:42:\"s9e\\TextFormatter\\Parser::filterAttributes\";s:6:\"params\";a:4:{s:3:\"tag\";N;s:9:\"tagConfig\";N;s:14:\"registeredVars\";N;s:6:\"logger\";N;}}}s:12:\"nestingLimit\";i:10;s:5:\"rules\";a:2:{s:11:\"closeParent\";a:1:{s:2:\"TR\";i:1;}s:5:\"flags\";i:672;}s:8:\"tagLimit\";i:1000;s:9:\"bitNumber\";i:9;s:15:\"allowedChildren\";s:2:\"\220\000\";s:18:\"allowedDescendants\";s:2:\"\377\003\";}s:2:\"TT\";a:7:{s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:42:\"s9e\\TextFormatter\\Parser::filterAttributes\";s:6:\"params\";a:4:{s:3:\"tag\";N;s:9:\"tagConfig\";N;s:14:\"registeredVars\";N;s:6:\"logger\";N;}}}s:12:\"nestingLimit\";i:10;s:5:\"rules\";a:1:{s:5:\"flags\";i:0;}s:8:\"tagLimit\";i:1000;s:9:\"bitNumber\";i:0;s:15:\"allowedChildren\";s:2:\"\031\001\";s:18:\"allowedDescendants\";s:2:\"\377\003\";}s:1:\"U\";a:7:{s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:42:\"s9e\\TextFormatter\\Parser::filterAttributes\";s:6:\"params\";a:4:{s:3:\"tag\";N;s:9:\"tagConfig\";N;s:14:\"registeredVars\";N;s:6:\"logger\";N;}}}s:12:\"nestingLimit\";i:10;s:5:\"rules\";a:1:{s:5:\"flags\";i:0;}s:8:\"tagLimit\";i:1000;s:9:\"bitNumber\";i:0;s:15:\"allowedChildren\";s:2:\"\031\001\";s:18:\"allowedDescendants\";s:2:\"\377\003\";}s:3:\"URL\";a:8:{s:10:\"attributes\";a:1:{s:3:\"url\";a:2:{s:11:\"filterChain\";a:2:{i:0;a:2:{s:8:\"callback\";s:49:\"s9e\\TextFormatter\\Bundles\\S18\\Helper::prependHttp\";s:6:\"params\";a:1:{s:9:\"attrValue\";N;}}i:1;a:2:{s:8:\"callback\";s:50:\"s9e\\TextFormatter\\Parser\\BuiltInFilters::filterUrl\";s:6:\"params\";a:3:{s:9:\"attrValue\";N;s:9:\"urlConfig\";N;s:6:\"logger\";N;}}}s:8:\"required\";b:1;}}s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:42:\"s9e\\TextFormatter\\Parser::filterAttributes\";s:6:\"params\";a:4:{s:3:\"tag\";N;s:9:\"tagConfig\";N;s:14:\"registeredVars\";N;s:6:\"logger\";N;}}}s:12:\"nestingLimit\";i:10;s:5:\"rules\";a:1:{s:5:\"flags\";i:66;}s:8:\"tagLimit\";i:1000;s:9:\"bitNumber\";i:3;s:15:\"allowedChildren\";s:2:\"S\001\";s:18:\"allowedDescendants\";s:2:\"\363\003\";}s:5:\"WHITE\";a:7:{s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:42:\"s9e\\TextFormatter\\Parser::filterAttributes\";s:6:\"params\";a:4:{s:3:\"tag\";N;s:9:\"tagConfig\";N;s:14:\"registeredVars\";N;s:6:\"logger\";N;}}}s:12:\"nestingLimit\";i:10;s:5:\"rules\";a:1:{s:5:\"flags\";i:0;}s:8:\"tagLimit\";i:1000;s:9:\"bitNumber\";i:0;s:15:\"allowedChildren\";s:2:\"\031\001\";s:18:\"allowedDescendants\";s:2:\"\377\003\";}s:6:\"html:a\";a:8:{s:10:\"attributes\";a:1:{s:4:\"href\";a:2:{s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:50:\"s9e\\TextFormatter\\Parser\\BuiltInFilters::filterUrl\";s:6:\"params\";a:3:{s:9:\"attrValue\";N;s:9:\"urlConfig\";N;s:6:\"logger\";N;}}}s:8:\"required\";b:0;}}s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:42:\"s9e\\TextFormatter\\Parser::filterAttributes\";s:6:\"params\";a:4:{s:3:\"tag\";N;s:9:\"tagConfig\";N;s:14:\"registeredVars\";N;s:6:\"logger\";N;}}}s:12:\"nestingLimit\";i:10;s:5:\"rules\";a:2:{s:15:\"requireAncestor\";a:1:{i:0;s:4:\"HTML\";}s:5:\"flags\";i:66;}s:8:\"tagLimit\";i:1000;s:9:\"bitNumber\";i:3;s:15:\"allowedChildren\";s:2:\"S\001\";s:18:\"allowedDescendants\";s:2:\"\363\003\";}s:6:\"html:b\";a:7:{s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:42:\"s9e\\TextFormatter\\Parser::filterAttributes\";s:6:\"params\";a:4:{s:3:\"tag\";N;s:9:\"tagConfig\";N;s:14:\"registeredVars\";N;s:6:\"logger\";N;}}}s:12:\"nestingLimit\";i:10;s:5:\"rules\";a:2:{s:15:\"requireAncestor\";a:1:{i:0;s:4:\"HTML\";}s:5:\"flags\";i:2;}s:8:\"tagLimit\";i:1000;s:9:\"bitNumber\";i:0;s:15:\"allowedChildren\";s:2:\"\031\001\";s:18:\"allowedDescendants\";s:2:\"\377\003\";}s:15:\"html:blockquote\";a:7:{s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:42:\"s9e\\TextFormatter\\Parser::filterAttributes\";s:6:\"params\";a:4:{s:3:\"tag\";N;s:9:\"tagConfig\";N;s:14:\"registeredVars\";N;s:6:\"logger\";N;}}}s:12:\"nestingLimit\";i:10;s:5:\"rules\";a:2:{s:15:\"requireAncestor\";a:1:{i:0;s:4:\"HTML\";}s:5:\"flags\";i:512;}s:8:\"tagLimit\";i:1000;s:9:\"bitNumber\";i:1;s:15:\"allowedChildren\";s:2:\"_\001\";s:18:\"allowedDescendants\";s:2:\"\377\003\";}s:7:\"html:br\";a:7:{s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:42:\"s9e\\TextFormatter\\Parser::filterAttributes\";s:6:\"params\";a:4:{s:3:\"tag\";N;s:9:\"tagConfig\";N;s:14:\"registeredVars\";N;s:6:\"logger\";N;}}}s:12:\"nestingLimit\";i:10;s:5:\"rules\";a:2:{s:15:\"requireAncestor\";a:1:{i:0;s:4:\"HTML\";}s:5:\"flags\";i:161;}s:8:\"tagLimit\";i:1000;s:9:\"bitNumber\";i:0;s:15:\"allowedChildren\";s:2:\"\020\000\";s:18:\"allowedDescendants\";s:2:\"\377\003\";}s:8:\"html:del\";a:7:{s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:42:\"s9e\\TextFormatter\\Parser::filterAttributes\";s:6:\"params\";a:4:{s:3:\"tag\";N;s:9:\"tagConfig\";N;s:14:\"registeredVars\";N;s:6:\"logger\";N;}}}s:12:\"nestingLimit\";i:10;s:5:\"rules\";a:2:{s:15:\"requireAncestor\";a:1:{i:0;s:4:\"HTML\";}s:5:\"flags\";i:64;}s:8:\"tagLimit\";i:1000;s:9:\"bitNumber\";i:0;s:15:\"allowedChildren\";s:2:\"_\001\";s:18:\"allowedDescendants\";s:2:\"\377\003\";}s:7:\"html:em\";a:7:{s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:42:\"s9e\\TextFormatter\\Parser::filterAttributes\";s:6:\"params\";a:4:{s:3:\"tag\";N;s:9:\"tagConfig\";N;s:14:\"registeredVars\";N;s:6:\"logger\";N;}}}s:12:\"nestingLimit\";i:10;s:5:\"rules\";a:2:{s:15:\"requireAncestor\";a:1:{i:0;s:4:\"HTML\";}s:5:\"flags\";i:2;}s:8:\"tagLimit\";i:1000;s:9:\"bitNumber\";i:0;s:15:\"allowedChildren\";s:2:\"\031\001\";s:18:\"allowedDescendants\";s:2:\"\377\003\";}s:7:\"html:hr\";a:7:{s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:42:\"s9e\\TextFormatter\\Parser::filterAttributes\";s:6:\"params\";a:4:{s:3:\"tag\";N;s:9:\"tagConfig\";N;s:14:\"registeredVars\";N;s:6:\"logger\";N;}}}s:12:\"nestingLimit\";i:10;s:5:\"rules\";a:2:{s:15:\"requireAncestor\";a:1:{i:0;s:4:\"HTML\";}s:5:\"flags\";i:673;}s:8:\"tagLimit\";i:1000;s:9:\"bitNumber\";i:1;s:15:\"allowedChildren\";s:2:\"\020\000\";s:18:\"allowedDescendants\";s:2:\"\377\003\";}s:6:\"html:i\";a:7:{s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:42:\"s9e\\TextFormatter\\Parser::filterAttributes\";s:6:\"params\";a:4:{s:3:\"tag\";N;s:9:\"tagConfig\";N;s:14:\"registeredVars\";N;s:6:\"logger\";N;}}}s:12:\"nestingLimit\";i:10;s:5:\"rules\";a:2:{s:15:\"requireAncestor\";a:1:{i:0;s:4:\"HTML\";}s:5:\"flags\";i:2;}s:8:\"tagLimit\";i:1000;s:9:\"bitNumber\";i:0;s:15:\"allowedChildren\";s:2:\"\031\001\";s:18:\"allowedDescendants\";s:2:\"\377\003\";}s:8:\"html:img\";a:8:{s:10:\"attributes\";a:3:{s:3:\"alt\";a:1:{s:8:\"required\";b:0;}s:6:\"height\";a:1:{s:8:\"required\";b:0;}s:5:\"width\";a:1:{s:8:\"required\";b:0;}}s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:42:\"s9e\\TextFormatter\\Parser::filterAttributes\";s:6:\"params\";a:4:{s:3:\"tag\";N;s:9:\"tagConfig\";N;s:14:\"registeredVars\";N;s:6:\"logger\";N;}}}s:12:\"nestingLimit\";i:10;s:5:\"rules\";a:2:{s:15:\"requireAncestor\";a:1:{i:0;s:4:\"HTML\";}s:5:\"flags\";i:161;}s:8:\"tagLimit\";i:1000;s:9:\"bitNumber\";i:0;s:15:\"allowedChildren\";s:2:\"\020\000\";s:18:\"allowedDescendants\";s:2:\"\377\003\";}s:8:\"html:ins\";a:7:{s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:42:\"s9e\\TextFormatter\\Parser::filterAttributes\";s:6:\"params\";a:4:{s:3:\"tag\";N;s:9:\"tagConfig\";N;s:14:\"registeredVars\";N;s:6:\"logger\";N;}}}s:12:\"nestingLimit\";i:10;s:5:\"rules\";a:2:{s:15:\"requireAncestor\";a:1:{i:0;s:4:\"HTML\";}s:5:\"flags\";i:64;}s:8:\"tagLimit\";i:1000;s:9:\"bitNumber\";i:0;s:15:\"allowedChildren\";s:2:\"_\001\";s:18:\"allowedDescendants\";s:2:\"\377\003\";}s:8:\"html:pre\";a:7:{s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:42:\"s9e\\TextFormatter\\Parser::filterAttributes\";s:6:\"params\";a:4:{s:3:\"tag\";N;s:9:\"tagConfig\";N;s:14:\"registeredVars\";N;s:6:\"logger\";N;}}}s:12:\"nestingLimit\";i:10;s:5:\"rules\";a:2:{s:15:\"requireAncestor\";a:1:{i:0;s:4:\"HTML\";}s:5:\"flags\";i:896;}s:8:\"tagLimit\";i:1000;s:9:\"bitNumber\";i:1;s:15:\"allowedChildren\";s:2:\"\031\001\";s:18:\"allowedDescendants\";s:2:\"\377\003\";}s:6:\"html:s\";a:7:{s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:42:\"s9e\\TextFormatter\\Parser::filterAttributes\";s:6:\"params\";a:4:{s:3:\"tag\";N;s:9:\"tagConfig\";N;s:14:\"registeredVars\";N;s:6:\"logger\";N;}}}s:12:\"nestingLimit\";i:10;s:5:\"rules\";a:2:{s:15:\"requireAncestor\";a:1:{i:0;s:4:\"HTML\";}s:5:\"flags\";i:2;}s:8:\"tagLimit\";i:1000;s:9:\"bitNumber\";i:0;s:15:\"allowedChildren\";s:2:\"\031\001\";s:18:\"allowedDescendants\";s:2:\"\377\003\";}s:6:\"html:u\";a:7:{s:11:\"filterChain\";a:1:{i:0;a:2:{s:8:\"callback\";s:42:\"s9e\\TextFormatter\\Parser::filterAttributes\";s:6:\"params\";a:4:{s:3:\"tag\";N;s:9:\"tagConfig\";N;s:14:\"registeredVars\";N;s:6:\"logger\";N;}}}s:12:\"nestingLimit\";i:10;s:5:\"rules\";a:2:{s:15:\"requireAncestor\";a:1:{i:0;s:4:\"HTML\";}s:5:\"flags\";i:2;}s:8:\"tagLimit\";i:1000;s:9:\"bitNumber\";i:0;s:15:\"allowedChildren\";s:2:\"\031\001\";s:18:\"allowedDescendants\";s:2:\"\377\003\";}}}");
	}

	/**
	* Return a new instance of s9e\TextFormatter\Renderer
	*
	* @return s9e\TextFormatter\Renderer
	*/
	public static function getRenderer()
	{
		return unserialize("O:38:\"s9e\\TextFormatter\\Bundles\\S18\\Renderer\":3:{s:13:\"\000*\000htmlOutput\";b:1;s:16:\"\000*\000dynamicParams\";a:0:{}s:9:\"\000*\000params\";a:10:{s:8:\"IS_GECKO\";s:0:\"\";s:5:\"IS_IE\";s:0:\"\";s:8:\"IS_OPERA\";s:0:\"\";s:6:\"L_CODE\";s:4:\"Code\";s:13:\"L_CODE_SELECT\";s:8:\"[Select]\";s:7:\"L_QUOTE\";s:5:\"Quote\";s:12:\"L_QUOTE_FROM\";s:10:\"Quote from\";s:11:\"L_SEARCH_ON\";s:2:\"on\";s:10:\"SCRIPT_URL\";s:0:\"\";s:12:\"SMILEYS_PATH\";s:0:\"\";}}");
	}
}