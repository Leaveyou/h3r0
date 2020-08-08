<?php declare(strict_types=1);

namespace Hero\Modules\Defense;

use Hero\Game\DefensiveSkill;
use Hero\Game\WarriorStats;

class DefaultDefense implements DefensiveSkill
{
	public function use(WarriorStats $warriorStats, int $attack): WarriorStats
	{
		$damage = min($warriorStats->getHealth(), 0);
		// todo: perhaps throw event for damage received
		$newHealth = $warriorStats->getHealth() - $damage;
		// todo: treat 0 health event

		return new WarriorStats(
			$newHealth,
			$warriorStats->getStrength() + 0,
			$warriorStats->getDefense() + 0,
			$warriorStats->getSpeed() + 0,
			clone $warriorStats->getLuck()
		);
	}
}
