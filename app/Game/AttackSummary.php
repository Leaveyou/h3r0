<?php declare(strict_types=1);

namespace Hero\Game;

class AttackSummary
{
	private Warrior $attacker;
	private Warrior $defender;

	/**
	 * AttackSummary constructor.
	 * @param Warrior $attacker
	 * @param Warrior $defender
	 */
	public function __construct(Warrior $attacker, Warrior $defender)
	{
		$this->attacker = $attacker;
		$this->defender = $defender;
	}

	public function getAttacker(): Warrior
	{
		return $this->attacker;
	}

	public function getDefender(): Warrior
	{
		return $this->defender;
	}
}
