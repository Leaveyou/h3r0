<?php declare(strict_types=1);

namespace Hero\Game;

use Hero\Tools\Chance;

interface DefensiveSkill
{
	public function __construct(Chance $chance);
	public function use(WarriorStats $warriorStats, int $attack): int;
	public function getName(): string;
}