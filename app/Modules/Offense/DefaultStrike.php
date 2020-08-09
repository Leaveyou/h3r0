<?php declare(strict_types=1);

namespace Hero\Modules\Offense;

use Hero\Game\Defender;
use Hero\Game\OffensiveSkill;
use Hero\Game\WarriorStats;

class DefaultStrike implements OffensiveSkill
{
	public function use(Defender $target, WarriorStats $warriorStats): bool
	{
		// todo: perhaps create "Attack object"
		return !$target->defend($warriorStats->getStrength());
	}

	public function getName(): string
	{
		return "basic attack";
	}
}