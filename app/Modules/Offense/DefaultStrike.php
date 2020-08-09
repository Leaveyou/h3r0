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

	public function use(Defender $target, int $strength): bool
	{
		if (!$this->chance->roll()) return false;

		// todo: perhaps create "Attack object" or strength
		$target->defend($strength);
		return true;
	}

	public function getName(): string
	{
		return "basic attack";
	}

}
