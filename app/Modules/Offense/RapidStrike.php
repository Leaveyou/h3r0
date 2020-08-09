<?php declare(strict_types=1);

namespace Hero\Modules\Offense;

use Hero\Game\Defender;
use Hero\Game\OffensiveSkill;
use Hero\Game\WarriorStats;

class RapidStrike implements OffensiveSkill
{
	public function use(Defender $target, WarriorStats $warriorStats): bool
	{
		return
			!$target->defend($warriorStats->getStrength()) &&
			!$target->defend($warriorStats->getStrength());
	}

	public function getName(): string
	{
		return "Rapid Strike";
	}
}