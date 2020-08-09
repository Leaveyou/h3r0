<?php declare(strict_types=1);

namespace Hero\Modules\Defense;

use Hero\Game\DefensiveSkill;
use Hero\Game\WarriorStats;

class DefaultDefense implements DefensiveSkill
{
	public function use(WarriorStats $warriorStats, int $attack)
	{
		// todo: perhaps throw event for damage received
		// todo: treat 0 health event
		// todo: treat luck interaction
		return min(
			$attack - $warriorStats->getDefense(),
			$warriorStats->getHealth()
		);
	}
}
