<?php declare(strict_types=1);

namespace Hero\Game;

interface SortFunction
{
	/**
	 * @param Warrior $warrior1
	 * @param Warrior $warrior2
	 * @return Warrior[]
	 */
	public function establishOrder(Warrior $warrior1, Warrior $warrior2): ?array;
}