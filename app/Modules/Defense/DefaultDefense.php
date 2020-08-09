<?php declare(strict_types=1);

namespace Hero\Modules\Defense;

use Hero\Game\DefensiveSkill;
use Hero\Game\WarriorStats;
use Hero\Tools\Chance;

class DefaultDefense implements DefensiveSkill
{

	private Chance $chance;

	/**
	 * DefaultDefense constructor.
	 * @param Chance $chance
	 */
	public function __construct(Chance $chance)
	{
		$this->chance = $chance;
	}

	/**
	 * @param WarriorStats $warriorStats
	 * @param int $attack
	 * @return int damage taken
	 */
	public function use(WarriorStats $warriorStats, int $attack): int
	{
		// todo: perhaps throw event for damage received
		// todo: treat 0 health event
		// todo: treat luck interaction
		return min(
			$attack - $warriorStats->getDefense(),
			$warriorStats->getHealth()
		);
	}



	public function getName(): string
	{
		return "default defense";
	}
}
