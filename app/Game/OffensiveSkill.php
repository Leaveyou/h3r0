<?php declare(strict_types=1);


namespace Hero\Game;


interface OffensiveSkill
{
	public function use(Defender $target, int $strength);
}