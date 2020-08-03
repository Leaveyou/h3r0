<?php declare(strict_types=1);


namespace Hero\Game;

use Generator;

class Fight
{
	private Warrior $firstPlayer;
	private Warrior $secondPlayer;

	/**
	 * @param Warrior $firstPlayer
	 * @param Warrior $secondPlayer
	 */
	public function __construct(Warrior $firstPlayer, Warrior $secondPlayer)
	{
		$this->firstPlayer = $firstPlayer;
		$this->secondPlayer = $secondPlayer;
	}

	/**
	 * @return Generator
	 */
	public function rounds(): Generator
	{
		yield 1;
	}
}