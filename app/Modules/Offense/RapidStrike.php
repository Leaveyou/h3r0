<?php declare(strict_types=1);

namespace Hero\Modules\Offense;

use Hero\Game\Defender;
use Hero\Game\OffensiveSkill;
use Hero\Game\SkillChance;
use Hero\Game\WarriorStats;

class RapidStrike extends SkillChance implements OffensiveSkill
{
	public function use(Defender $target, WarriorStats $warriorStats): bool
	{
		$this->monitor("{$warriorStats->getName()} uses Rapid Strike® on {$target->getName()}");
		$target->defend($warriorStats->getStrength());
		$target->defend($warriorStats->getStrength());
		return true;
	}
}
