<?php declare(strict_types=1);

namespace Hero\Modules\Defense;

use Hero\Game\DefensiveSkill;
use Hero\Game\DefensiveSkillChance;
use Hero\Game\WarriorStats;
use Hero\Tools\Chance;
use Hero\Tools\ConsoleColors as Color;

class MagicShield extends DefensiveSkillChance
{

	public function use(WarriorStats $warriorStats, int $attack): ?int
	{
		if (parent::roll()) {
			echo "{$warriorStats->getName()} uses " . Color::blue("Magic Shield") . " and takes no damage." . PHP_EOL;
			return 0;
		}
		return null;
	}
}
