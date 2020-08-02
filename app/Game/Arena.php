<?php declare(strict_types=1);


namespace Hero\Game;

use Generator;
use Hero\Game\Warrior;

class Arena
{

	/**
	 * Arena constructor.
	 */
	public function __construct()
	{
	}

	/**
	 * @return Generator
	 *
	 * @param Warrior $player1
	 * @param Warrior $player2
	 */
	public function rounds(Warrior $player1, Warrior $player2): Generator
	{
		yield 1;
	}
}