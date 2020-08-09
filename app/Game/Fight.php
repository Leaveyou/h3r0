<?php declare(strict_types=1);

namespace Hero\Game;

use Generator;

class Fight
{
	const NUMBER_OF_ROUNDS = 20;

	private Warrior $firstWarrior;
	private Warrior $secondWarrior;
	private Monitor $monitor;

	/**
	 * @param Warrior $firstWarrior
	 * @param Warrior $secondWarrior
	 */
	public function __construct(Warrior $firstWarrior, Warrior $secondWarrior)
	{

		$this->firstWarrior = $firstWarrior;
		$this->secondWarrior = $secondWarrior;
		$this->monitor = new Monitor();
	}

	/**
	 * @return Generator|AttackSummary[]
	 */
	public function getAttacks(): Generator
	{
		for ($round = 1; $round <= self::NUMBER_OF_ROUNDS; $round++) {

			$this->monitor->roundStart(
				$round,
				$this->firstWarrior->getName(),
				$this->firstWarrior->getHealth(),
				$this->secondWarrior->getName(),
				$this->secondWarrior->getHealth()
			);

			foreach ($this->getPairCombinations() as list("attacker" => $attacker, "defender" => $defender)) {
				$attacker->attack($defender);
				yield new AttackSummary($attacker, $defender);
			}
		}
	}

	/**
	 * @return Generator|Warrior[][]
	 */
	private function getPairCombinations(): Generator
	{
		yield ["attacker" => $this->firstWarrior, "defender" => $this->secondWarrior];
		yield ["attacker" => $this->secondWarrior, "defender" => $this->firstWarrior];
	}

}
