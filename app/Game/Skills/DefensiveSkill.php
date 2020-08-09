<?php declare(strict_types=1);

namespace Hero\Game\Skills;

use Hero\Game\WarriorStats;

interface DefensiveSkill
{
	public function use(WarriorStats $warriorStats, int $attack): ?int;
}
