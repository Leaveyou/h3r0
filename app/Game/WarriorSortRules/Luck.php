<?php declare(strict_types=1);

namespace Hero\Game\WarriorSortRules;

use Hero\Game\SortFunction;
use Hero\Game\Warrior;

class Luck implements SortFunction
{
	/**
	 * @param Warrior $warriorA
	 * @param Warrior $warriorB
	 * @return Warrior[]?
	 */
	public function establishOrder(Warrior $warriorA, Warrior $warriorB): ?array
	{
		if ($warriorA->getLuck() === $warriorB->getLuck()) {
			return null;
		}
		$warriors = [$warriorA, $warriorB];
		usort($warriors, function(Warrior $a, Warrior $b) {
			return (-1) * ($a->getLuck()->compare($b->getLuck()));
		});
		return $warriors;
	}
}
