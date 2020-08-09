<?php declare(strict_types=1);

namespace Hero\Game;

use Generator;
use Hero\Tools\ConsoleColors;

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
	 * @return Generator|AttackSummary[]
	 */
	public function getAttacks(): Generator
	{
		for ($round = 1; $round <= self::NUMBER_OF_ROUNDS; $round++) {
			echo PHP_EOL . ConsoleColors::red("# Round {$round}:") . PHP_EOL;
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
