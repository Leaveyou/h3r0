<?php declare(strict_types=1);

namespace Hero\Modules\Defense;

use Hero\Game\DefensiveSkill;
use Hero\Game\SkillChance;
use Hero\Game\WarriorStats;

class MagicShield extends SkillChance implements DefensiveSkill
{
	public function use(WarriorStats $warriorStats, int $attack): ?int
	{
		if (parent::roll()) {
			$this->monitor("{$warriorStats->getName()} uses Magic Shield® and takes no damage.");
			return 0;
		}
		return null;
	}
}
