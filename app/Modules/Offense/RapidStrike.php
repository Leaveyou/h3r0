<?php declare(strict_types=1);

namespace Hero\Modules\Offense;

use Hero\Game\Defender;
use Hero\Game\OffensiveSkill;
use Hero\Game\WarriorStats;
use Hero\Tools\Chance;

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

	public function use(Defender $target, int $strength): bool
	{
		if (!$this->chance->roll()) return false;

		$target->defend($strength);
		$target->defend($strength);

		return true;
	}

	public function getName(): string
	{
		return "Rapid Strike";
	}
}
