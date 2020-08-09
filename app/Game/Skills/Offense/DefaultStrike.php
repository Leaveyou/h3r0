<?php declare(strict_types=1);

namespace Hero\Game\Skills\Offense;

use Hero\Game\Defender;
use Hero\Game\Skills\OffensiveSkill;
use Hero\Game\Skills\SkillChance;
use Hero\Game\WarriorStats;

class DefaultStrike extends SkillChance implements OffensiveSkill
{
	public function use(Defender $target, WarriorStats $warriorStats): bool
	{
		$this->monitor("{$warriorStats->getName()} attacks {$target->getName()}");
		$target->defend($warriorStats->getStrength());
		return true;
	}
}
