<?php declare(strict_types=1);

namespace Hero\Game;

use Hero\Tools\ConsoleColors as Color;

class Arena
{
	private WarriorSorter $warriorOrderRules;
	/**
	 * @var FightFactory
	 */
	private FightFactory $fightFactory;

	/**
	 * Arena constructor.
	 * @param WarriorSorter $warriorOrderRules
	 * @param FightFactory $fightFactory
	 */
	public function __construct(WarriorSorter $warriorOrderRules, FightFactory $fightFactory)
	{
		$this->warriorOrderRules = $warriorOrderRules;
		$this->fightFactory = $fightFactory;
	}

	public function fight(Warrior $warriorA, Warrior $warriorB): ?Warrior
	{
		// todo: register listeners for events
		list($firstWarrior, $secondWarrior) = $this->warriorOrderRules->sort($warriorA, $warriorB);
		$fight = $this->fightFactory->newFight($firstWarrior, $secondWarrior);
		foreach ($fight->getAttacks() as $attack) {
			$attacker = $attack->getAttacker();
			$defender = $attack->getDefender();

			if ($defender->getHealth() === 0) {
				echo PHP_EOL . Color::red("Winner is ") . $attacker->getName() . Color::red(" with {$attacker->getHealth()} health remaining") . PHP_EOL . PHP_EOL;
				return $attacker;
			}
		}

		echo Color::red("Fight ends in a tie after " . Fight::NUMBER_OF_ROUNDS . " rounds.") . PHP_EOL;
		return null;
	}
}