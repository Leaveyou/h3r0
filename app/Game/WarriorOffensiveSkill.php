<?php declare(strict_types=1);

namespace Hero\Game;

use Hero\Tools\Chance;

class WarriorOffensiveSkill
{
	private OffensiveSkill $offensiveSkill;
	private Chance $chance;
	private WarriorStats $stats;

	public function __construct(OffensiveSkill $offensiveSkill, WarriorStats $stats, Chance $chance)
	{
		$this->offensiveSkill = $offensiveSkill;
		$this->chance = $chance;
		$this->stats = $stats;
	}

	public function try(Defender $target): bool
	{
		if (!$this->chance->roll()) {
			return false;
		}
		$this->offensiveSkill->use($target, $this->stats->getStrength());
		return true;
	}
}
