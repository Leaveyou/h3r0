<?php declare(strict_types=1);

namespace Hero\Game;

use Hero\Tools\Chance;

class WarriorDefensiveSkill
{
	private DefensiveSkill $defensiveSkill;
	private Chance $chance;
	private WarriorStats $warriorStats;

	/**
	 * WarriorDefensiveSkill constructor.
	 * @param DefensiveSkill $defensiveSkill
	 * @param WarriorStats $warriorStats
	 * @param Chance $chance
	 */
	public function __construct(DefensiveSkill $defensiveSkill, WarriorStats $warriorStats, Chance $chance)
	{
		$this->defensiveSkill = $defensiveSkill;
		$this->chance = $chance;
		$this->warriorStats = $warriorStats;
	}

	public function try(int $attack): ?int
	{
		if (!$this->chance->roll()) {
			return null;
		}
		return $this->defensiveSkill->use($this->warriorStats, $attack);
	}
}