<?php declare(strict_types=1);

namespace Hero\Game;

interface SortFunction
{
	/**
	 * @param Warrior $warriorA
	 * @param Warrior $warriorB
	 * @return Warrior[]
	 */
	public function establishOrder(Warrior $warriorA, Warrior $warriorB): ?array;
}
