<?php declare(strict_types=1);

namespace Hero\Modules\Offense;

use Hero\Game\Defender;
use Hero\Game\OffensiveSkill;

class DefaultStrike implements OffensiveSkill
{
	public function use(Defender $target, int $strength)
	{
		$target->defend($strength);

	}
}