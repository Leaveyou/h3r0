<?php declare(strict_types=1);

namespace Hero\Game;

use Hero\Tools\Chance;
use InvalidArgumentException;

class Warrior implements Defender, WarriorStats
{
	private int $health;
	private int $strength;
	private int $defense;
	private int $speed;
	private Chance $luck;
	private string $name;

	/** @var WarriorOffensiveSkill[] */
	private array $offensiveSkills = [];

	/** @var WarriorDefensiveSkill[] */
	private array $defensiveSkills = [];

	/**
	 * Warrior constructor. Contains some common sense validation
	 * @param string $name Used in the interface for display and logging purposes. [1, 100] characters long
	 * @param int $health [0, 9000]
	 * @param int $strength [0, 9000]
	 * @param int $defense [0, 9000]
	 * @param int $speed [0, 9000]
	 * @param Chance $luck
	 */
	public function __construct(string $name, int $health, int $strength, int $defense, int $speed, Chance $luck)
	{
		$this->name = $this->validateName($name);
		if ($health   < 0 || $health   > 9000) throw new InvalidArgumentException("Warrior's health must be between [0, 9000]!");
		if ($strength < 0 || $strength > 9000) throw new InvalidArgumentException("Warrior's strength must be between [0, 9000]!");
		if ($defense  < 0 || $defense  > 9000) throw new InvalidArgumentException("Warrior's defense must be between [0, 9000]!");
		if ($speed    < 0 || $speed    > 9000) throw new InvalidArgumentException("Warrior's speed must be between [0, 9000]!");

		$this->health = $health;
		$this->strength = $strength;
		$this->defense = $defense;
		$this->speed = $speed;
		$this->luck = $luck;	}

	/**
	 * @param OffensiveSkill $offensiveSkill
	 * @param Chance $chance
	 */
	public function addOffensiveSkill(OffensiveSkill $offensiveSkill, Chance $chance): void
	{
		$this->offensiveSkills[] = new WarriorOffensiveSkill($offensiveSkill, $this, $chance);
	}

	/**
	 * @param DefensiveSkill $defensiveSkill
	 * @param Chance $chance
	 */
	public function addDefensiveSkill(DefensiveSkill $defensiveSkill, Chance $chance): void
	{
		$this->defensiveSkills[] = new WarriorDefensiveSkill($defensiveSkill, $this, $chance);
	}

	/**
	 * @return string Warrior name
	 */
	public function getName(): string
	{
		return $this->name;
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

	/**
	 * Attack target warrior.
	 * @param Defender $target Target of the attack
	 * @return bool
	 */
	public function attack(Defender $target): bool
	{
		foreach ($this->offensiveSkills as $offensiveSkill) {
			$kill = $offensiveSkill->try($target);
			if (!is_null($kill)) {
				echo $this->getName() . " uses " . $offensiveSkill->getName() . " on " . $target->getName() . PHP_EOL;

				return $kill;
			}
		}
		return false;
	}

	/**
	 * Handle incoming attack of set damage
	 * @param int $attack Requested attack
	 * @return bool
	 */
	public function defend(int $attack): bool
	{
		$damageTaken = $this->getDamage($attack);
		$this->health -= $damageTaken;

		return ($this->health > 0);
	}

	/**
	 * @param string $name
	 * @return string
	 */
	private function validateName(string $name): string
	{
		if (mb_strlen($name) < 1) throw new InvalidArgumentException("Warrior name is too short!");
		if (mb_strlen($name) > 100) throw new InvalidArgumentException("Warrior name is too long!");
		if (!mb_check_encoding($name, "UTF-8") ) throw new InvalidArgumentException("Warrior name is in an unknown language!");
		return $name;
	}

	/**
	 * @param int $attack
	 * @return int
	 */
	private function getDamage(int $attack): int
	{
		// todo: refactor into defensive skill stack class
		foreach ($this->defensiveSkills as $defensiveSkill) {
			$damageTaken = $defensiveSkill->try($attack);
			if (!is_null($damageTaken)) {
				return $damageTaken;

			}
		}
		return $attack;
	}
}