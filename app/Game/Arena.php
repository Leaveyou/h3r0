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
		list($firstWarrior, $secondWarrior) = $this->warriorOrderRules->sort($warriorA, $warriorB);

		// todo: determine of this should be here. Smells temporal coupling
		//$this->armWarriors($firstWarrior, $secondWarrior);

		$fight = $this->fightFactory->newFight($firstWarrior, $secondWarrior);

		foreach ($fight->rounds() as $round) {
			echo $round;
		}
	}

//	private function armWarriors(Warrior $firstWarrior, Warrior $secondWarrior)
//	{
//		$firstWarrior->setTarget($secondWarrior);
//		$secondWarrior->setTarget($firstWarrior);
//	}
}