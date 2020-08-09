<?php declare(strict_types=1);


namespace Hero\Game;

use Hero\Tools\Chance;

interface WarriorStats
{
	public function getName(): string;
	public function getHealth(): int;
	public function getStrength(): int;
	public function getDefense(): int;
	public function getSpeed(): int;
	public function getLuck(): Chance;
}
