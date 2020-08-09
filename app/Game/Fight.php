<?php declare(strict_types=1);

namespace Hero\Game;

use Generator;

class Fight
{
	const NUMBER_OF_ROUNDS = 20;

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
	 * @return Generator
	 */
	public function rounds(): Generator
	{
		// todo: refactor to only ever generate a round at a time. and combine with order generator
		for( $round = 1; $round <= self::NUMBER_OF_ROUNDS; $round++) {

			$kill = $this->firstWarrior->attack($this->secondWarrior);
			echo $this->secondWarrior->getName() . "'s health dropped to " . $this->secondWarrior->getHealth() . PHP_EOL;
			yield $kill;
			if ($kill) break;

			$kill = $this->secondWarrior->attack($this->firstWarrior);
			echo $this->firstWarrior->getName() . "'s health dropped to " . $this->firstWarrior->getHealth() . PHP_EOL;
			yield $kill;
			if ($kill) break;
		}
	}
}
