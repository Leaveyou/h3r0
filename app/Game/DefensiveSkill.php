<?php declare(strict_types=1);


namespace Hero\Game;


interface DefensiveSkill
{

	public function use(WarriorStats $warriorStats, int $attack): WarriorStats;
}