<?php declare(strict_types=1);


namespace Hero\Game;


use Hero\Tools\Chance;
use InvalidArgumentException;

class WarriorStats
{
	private int $health;
	private int $strength;
	private int $defense;
	private int $speed;
	private Chance $luck;


	/**
	 * WarriorStats constructor.
	 * @param int $health
	 * @param int $strength
	 * @param int $defense
	 * @param int $speed
	 * @param Chance $luck
	 */
	public function __construct(int $health, int $strength, int $defense, int $speed, Chance $luck)
	{
		if ($health   < 0 || $health   > 9000) throw new InvalidArgumentException("Warrior's health must be between [0, 9000]!");
		if ($strength < 0 || $strength > 9000) throw new InvalidArgumentException("Warrior's strength must be between [0, 9000]!");
		if ($defense  < 0 || $defense  > 9000) throw new InvalidArgumentException("Warrior's defense must be between [0, 9000]!");
		if ($speed    < 0 || $speed    > 9000) throw new InvalidArgumentException("Warrior's speed must be between [0, 9000]!");

		$this->health = $health;
		$this->strength = $strength;
		$this->defense = $defense;
		$this->speed = $speed;
		$this->luck = $luck;
	}


	public function getHealth(): int
	{
		return $this->health;
	}

	public function getStrength(): int
	{
		return $this->strength;
	}

	public function getDefense(): int
	{
		return $this->defense;
	}

	public function getSpeed(): int
	{
		return $this->speed;
	}

	public function getLuck(): Chance
	{
		return $this->luck;
	}
}