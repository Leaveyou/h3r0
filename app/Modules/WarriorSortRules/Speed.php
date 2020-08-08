<?php declare(strict_types=1);

namespace Hero\Modules\WarriorSortRules;

use Hero\Game\SortFunction;
use Hero\Game\Warrior;

class Speed implements SortFunction
{
	/**
	 * @param Warrior $warriorA
	 * @param Warrior $warriorB
	 * @return Warrior[]?
	 */
	public function establishOrder(Warrior $warriorA, Warrior $warriorB): ?array
	{
		if ($warriorA->getSpeed() === $warriorB->getSpeed()) {
			return null;
		}
		$warriors = [$warriorA, $warriorB];
		usort($warriors, function(Warrior $a, Warrior $b) {
			return (-1) * ($a->getSpeed() <=> $b->getSpeed());
		});
		return $warriors;
	}
}
