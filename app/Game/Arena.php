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

	public function fight(Warrior $warriorA, Warrior $warriorB)
	{
		// todo: should return winner
		list($firstWarrior, $secondWarrior) = $this->warriorOrderRules->sort($warriorA, $warriorB);
		$fight = $this->fightFactory->newFight($firstWarrior, $secondWarrior);

		$roundsGenerator = $fight->rounds();

		foreach ($roundsGenerator as $round) {
			// echo $round;
			//
		}
	}

}