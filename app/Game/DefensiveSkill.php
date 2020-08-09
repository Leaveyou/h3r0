<?php declare(strict_types=1);


namespace Hero\Game;


interface DefensiveSkill
{
	// todo: simplify skills. No wrapper. Chance goes directly inside skill
	public function use(WarriorStats $warriorStats, int $attack);
}