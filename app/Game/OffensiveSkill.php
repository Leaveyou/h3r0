<?php declare(strict_types=1);

namespace Hero\Game;

use Hero\Tools\Chance;

interface OffensiveSkill
{
	public function __construct(Chance $chance);
	public function use(Defender $target, int $strength): bool;
	public function getName(): string;
}