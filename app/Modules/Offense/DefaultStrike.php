<?php declare(strict_types=1);

namespace Hero\Modules\Offense;

use Hero\Game\Defender;
use Hero\Game\OffensiveSkill;
use Hero\Game\WarriorStats;
use Hero\Tools\Chance;

class DefaultStrike implements OffensiveSkill
{
	/**
	 * @var Chance
	 */
	private Chance $chance;

	public function __construct(Chance $chance)
	{
		$this->chance = $chance;
	}

	public function use(Defender $target, WarriorStats $warriorStats): bool
	{
		echo "{$warriorStats->getName()} attacks {$target->getName()}" . PHP_EOL;
		$target->defend($warriorStats->getStrength());
		return true;
	}

	public function getName(): string
	{
		return "basic attack";
	}

	public function roll()
	{
		return $this->chance->roll();
	}
}
