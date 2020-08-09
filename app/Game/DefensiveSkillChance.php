<?php declare(strict_types=1);


namespace Hero\Game;


use Hero\Tools\Chance;

abstract class DefensiveSkillChance implements DefensiveSkill
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

	protected function roll()
	{
		return $this->chance->roll();
	}

}