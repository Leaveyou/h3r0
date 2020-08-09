<?php declare(strict_types=1);

namespace Hero\Game;

use Hero\Tools\Chance;

class WarriorOffensiveSkill
{
	private OffensiveSkill $offensiveSkill;
	private Chance $chance;
	private WarriorStats $warriorStats;

	public function __construct(OffensiveSkill $offensiveSkill, WarriorStats $warriorStats, Chance $chance)
	{
		$this->offensiveSkill = $offensiveSkill;
		$this->chance = $chance;
		$this->warriorStats = $warriorStats;
	}

	public function try(Defender $target): ?bool
	{
		if (!$this->chance->roll()) {
			return null;
		}
		return $this->offensiveSkill->use($target, $this->warriorStats);
	}

	public function getName()
	{
		// todo: I don't like this
		return $this->offensiveSkill->getName();
	}


}
