<?php declare(strict_types=1);


namespace Hero\Tools;

class ConsoleColors
{
	public static function red(string $text) : string
	{
		return "\033[31m" . $text . "\033[39m";
	}

	public static function green(string $text)
	{
		return "\033[32m" . $text . "\033[39m";
	}
	public static function yellow(string $text)
	{
		return "\033[33m" . $text . "\033[39m";
	}

	public static function blue(string $text)
	{
		return "\033[34m" . $text . "\033[39m";
	}


	public static function magenta(string $text)
	{
		return "\033[35m" . $text . "\033[39m";
	}


	public static function cyan(string $text)
	{
		return "\033[36m" . $text . "\033[39m";
	}


	public static function gray(string $text)
	{
		return "\033[37m" . $text . "\033[39m";
	}

}