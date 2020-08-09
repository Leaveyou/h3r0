<?php declare(strict_types=1);

namespace Hero\Tools;

use BadMethodCallException;

/**
 * @method static red(string $text): string
 * @method static green(string $text): string
 * @method static yellow(string $text): string
 * @method static blue(string $text): string
 * @method static magenta(string $text): string
 * @method static cyan(string $text): string
 * @method static gray(string $text): string
 */
class ConsoleColors
{
	private static array $colors = [
		"red" => 31,
		"green" => 32,
		"yellow" => 33,
		"blue" => 34,
		"magenta" => 35,
		"cyan" => 36,
		"gray" => 37,
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
			return "\033[" . self::$colors[$methodName] . "m$text\033[39m";
		}
		throw new BadMethodCallException("Method " . __CLASS__ . ":: $methodName() does not exist");
	}
}
