<?php declare(strict_types=1);

namespace Hero\Game;

use Hero\Tools\Chance;
use InvalidArgumentException;

class Warrior implements Defender
{
	private string $name;
	private WarriorStats $warriorStats;

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
		$this->warriorStats = new WarriorStats($health, $strength, $defense, $speed, $luck);
	}

	/**
	 * @param OffensiveSkill $offensiveSkill
	 * @param Chance $chance
	 */
	public function addOffensiveSkill(OffensiveSkill $offensiveSkill, Chance $chance): void
	{
		$this->offensiveSkills[] = new WarriorOffensiveSkill($offensiveSkill, $this->warriorStats, $chance);
	}

	/**
	 * @param DefensiveSkill $defensiveSkill
	 * @param Chance $chance
	 */
	public function addDefensiveSkill(DefensiveSkill $defensiveSkill, Chance $chance): void
	{
		$this->defensiveSkills[] = new WarriorDefensiveSkill($defensiveSkill, $this->warriorStats, $chance);
	}

	/**
	 * @return string Warrior name
	 */
	public function getName(): string
	{
		return $this->name;
	}

	/**
	 * Attack target warrior.
	 * @param Defender $target Target of the attack
	 * @return bool Whether attack was successful
	 */
	public function attack(Defender $target): bool
	{
		foreach ($this->offensiveSkills as $offensiveSkill) {
			if ($offensiveSkill->try($target)) {
				return true;
			}
		}
		return false;
	}

	/**
	 * Handle incoming attack of set damage
	 * @param int $attack Requested attack
	 */
	public function defend(int $attack)
	{
		foreach ($this->defensiveSkills as $defensiveSkill) {
			if ($defensiveSkill->try($attack)) {
				break;
			}
		}
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

	public function getSpeed()
	{
		return $this->warriorStats->getSpeed();
	}
	public function getLuck()
	{
		return $this->warriorStats->getLuck();
	}
}