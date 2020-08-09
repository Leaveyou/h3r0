<?php declare(strict_types=1);

namespace Hero\Game\Skills;

use Hero\Game\Defender;
use Hero\Game\WarriorStats;

interface OffensiveSkill
{
	public function use(Defender $target, WarriorStats $warriorStats): bool;
	public function roll();

}
