<?php declare(strict_types=1);


namespace Hero\Modules\Defense;


use Hero\Game\DefensiveSkill;
use Hero\Game\WarriorStats;

class MagicShield implements DefensiveSkill
{

	/**
	 * MagicShield constructor.
	 */
	public function __construct()
	{
	}

	public function use(WarriorStats $warriorStats, int $attack): ?int
	{
		return 0;
	}
}