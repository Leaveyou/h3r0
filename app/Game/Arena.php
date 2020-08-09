<?php declare(strict_types=1);

namespace Hero\Game;

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
				return $attacker;
			}
		}
		return null;
	}
}