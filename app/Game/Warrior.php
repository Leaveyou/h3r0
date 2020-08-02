<?php declare(strict_types=1);

namespace Hero\Game;

class Warrior
{
	/** @var OffensiveSkill[] */
	private array $offensiveSkills = [];

	/** @var DefensiveSkill[] */
	private array $defensiveSkills = [];

	/**
	 * @param OffensiveSkill $rapidStrike
	 */
	public function addOffensiveSkill(OffensiveSkill $rapidStrike): void
	{
		$this->offensiveSkills[] = $rapidStrike;
	}

	/**
	 * @param DefensiveSkill $rapidStrike
	 */
	public function addDefensiveSkill(DefensiveSkill $rapidStrike): void
	{
		$this->defensiveSkills[] = $rapidStrike;
	}
}