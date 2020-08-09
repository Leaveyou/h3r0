<?php declare(strict_types=1);

namespace Hero\Modules\Defense;

use Hero\Game\DefensiveSkill;
use Hero\Game\WarriorStats;
use Hero\Tools\Chance;

class MagicShield implements DefensiveSkill
{
	/**
	 * @var Chance
	 */
	private Chance $chance;

	/**
	 * MagicShield constructor.
	 * @param Chance $chance
	 */
	public function __construct(Chance $chance)
	{
		$this->chance = $chance;
	}

	public function use(WarriorStats $warriorStats, int $attack): int
	{
		return 0;
	}

	public function getName(): string
	{
		return "Magic Shield";
	}
}
