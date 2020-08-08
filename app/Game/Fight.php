<?php declare(strict_types=1);

namespace Hero\Game;

use Generator;

class Fight
{
	private Warrior $firstWarrior;
	private Warrior $secondWarrior;

	/**
	 * @param Warrior $firstWarrior
	 * @param Warrior $secondWarrior
	 */
	public function __construct(Warrior $firstWarrior, Warrior $secondWarrior)
	{
		$this->firstWarrior = $firstWarrior;
		$this->secondWarrior = $secondWarrior;
	}

	/**
	 * @return Generator|bool[]
	 */
	public function rounds(): Generator
	{
		for( $round = 1; $round <= 20; $round++) {
			yield $this->firstWarrior->attack($this->secondWarrior);
			yield $this->secondWarrior->attack($this->firstWarrior);
		}
	}
}