<?php declare(strict_types=1);


namespace Hero\Game;


interface Defender
{
	/**
	 *
	 * @param int $attack
	 * @return bool Whether warrior survived
	 */
	public function defend(int $attack): bool;
	public function getName(): string;
}
