<?php declare(strict_types=1);

namespace Hero\Modules\Offense;

use Hero\Game\Defender;
use Hero\Game\OffensiveSkill;
use Hero\Game\WarriorStats;
use Hero\Tools\Chance;
use Hero\Tools\ConsoleColors;

class RapidStrike implements OffensiveSkill
{
	/**
	 * @var Chance
	 */
	private Chance $chance;

	/**
	 * RapidStrike constructor.
	 * @param Chance $chance
	 */
	public function __construct(Chance $chance)
	{
		$this->chance = $chance;
	}

	public function use(Defender $target, WarriorStats $warriorStats): bool
	{
		echo "{$warriorStats->getName()} uses " . ConsoleColors::magenta("Rapid Strike") . " on {$target->getName()}" . PHP_EOL;
		$target->defend($warriorStats->getStrength());
		$target->defend($warriorStats->getStrength());

		return true;
	}

	public function getName(): string
	{
		return "Rapid Strike";
	}

	public function roll()
	{
		return $this->chance->roll();
	}
}
