<?php declare(strict_types=1);

namespace Hero\Tools;

use BadMethodCallException;

/**
 * @method static red     (string $text): string
 * @method static green   (string $text): string
 * @method static yellow  (string $text): string
 * @method static blue    (string $text): string
 * @method static magenta (string $text): string
 * @method static cyan    (string $text): string
 * @method static gray    (string $text): string
 */
class ConsoleColors
{

	private static array $colors = [
		"default" => "\e[39m",
		"red"     => "\e[31m",
		"green"   => "\e[32m",
		"yellow"  => "\e[33m",
		"blue"    => "\e[34m",
		"magenta" => "\e[35m",
		"cyan"    => "\e[36m",
		"gray"    => "\e[37m",
	];

	/**
	 * @param string $methodName
	 * @param array $arguments
	 * @return string
	 */
	public static function __callStatic(string $methodName, array $arguments): string
	{
		list($text) = $arguments;
		if (isset(self::$colors[$methodName])) {
			$colorCode = self::$colors[$methodName];
			$default = self::$colors["default"];
			return $colorCode . $text . $default;
		}
		throw new BadMethodCallException("Method " . __CLASS__ . ":: $methodName() does not exist");
	}
}
