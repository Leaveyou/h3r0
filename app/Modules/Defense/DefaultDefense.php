<?php declare(strict_types=1);

namespace Hero\Modules\Defense;

use Hero\Game\DefensiveSkill;
use Hero\Game\WarriorStats;
use Hero\Tools\Chance;
use Hero\Tools\ConsoleColors;

class DefaultDefense implements DefensiveSkill
{

	private Chance $chance;

	/**
	 * DefaultDefense constructor.
	 * @param Chance $chance
	 */
	public function __construct(Chance $chance)
	{
		$this->chance = $chance;
	}

	/**
	 * @param WarriorStats $warriorStats
	 * @param int $attack
	 * @return int|null Damage taken
	 */
	public function use(WarriorStats $warriorStats, int $attack): ?int
	{
		// todo: perhaps throw event for damage received

		if ($warriorStats->getLuck()->roll()) {
			echo "{$warriorStats->getName()} gets lucky and takes no damage." . PHP_EOL;
			return 0;
		}

		$damage = min(
			$attack - $warriorStats->getDefense(),
			$warriorStats->getHealth()
		);

		echo "{$warriorStats->getName()} gets hit for " . ConsoleColors::red((string)$damage) . " damage." . PHP_EOL;

		return $damage;
	}
}
