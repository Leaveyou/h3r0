<?php declare(strict_types=1);

namespace Hero\Game;

use InvalidArgumentException;

class Warrior
{
	/** @var OffensiveSkill[] */
	private array $offensiveSkills = [];

	/** @var DefensiveSkill[] */
	private array $defensiveSkills = [];

	private string $name;
	private int $health;
	private int $strength;
	private int $defense;
	private int $speed;
	private int $luck;

	/**
	 * Warrior constructor. Contains some common sense validation
	 * @param string $name Used in the interface for display and logging purposes. [1, 100] characters long
	 * @param int $health [0, 9000]
	 * @param int $strength [0, 9000]
	 * @param int $defense [0, 9000]
	 * @param int $speed [0, 9000]
	 * @param int $luck [0, 100]
	 */
	public function __construct(string $name, int $health, int $strength, int $defense, int $speed, int $luck)
	{
		if (mb_strlen($name) < 1) throw new InvalidArgumentException("Warrior name must be at least 1 character long!");
		if (mb_strlen($name) > 100) throw new InvalidArgumentException("Warrior name must be at most 100 characters long!");
		if (!mb_check_encoding($name, "UTF-8") ) throw new InvalidArgumentException("Warrior name is not a valid UTF-8 string!");

		if ($health    < 0 || $health   > 9000) throw new InvalidArgumentException("Warrior health must be between [0, 9000]!");
		if ($strength  < 0 || $strength > 9000) throw new InvalidArgumentException("Warrior strength must be between [0, 9000]!");
		if ($defense   < 0 || $defense  > 9000) throw new InvalidArgumentException("Warrior defense must be between [0, 9000]!");
		if ($speed     < 0 || $speed    > 9000) throw new InvalidArgumentException("Warrior speed must be between [0, 9000]!");
		if ($luck      < 0 || $luck     > 9000) throw new InvalidArgumentException("Warrior luck must be between [0, 100]!");

		$this->name = $name;
		$this->health = $health;
		$this->strength = $strength;
		$this->defense = $defense;
		$this->speed = $speed;
		$this->luck = $luck;
	}

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

	public function getLuck()
	{
		return $this->luck;
	}

	public function getSpeed()
	{
		return $this->speed;
	}
}