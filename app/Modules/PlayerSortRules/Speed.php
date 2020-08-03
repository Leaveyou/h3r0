<?php declare(strict_types=1);


namespace Hero\Modules\PlayerSortRules;


use Hero\Game\SortFunction;
use Hero\Game\Warrior;

class Speed implements SortFunction
{
	/**
	 * @param Warrior $warrior1
	 * @param Warrior $warrior2
	 * @return Warrior[]?
	 */
	public function establishOrder(Warrior $warrior1, Warrior $warrior2): ?array
	{
		if ($warrior1->getSpeed() === $warrior2->getSpeed()) {
			return null;
		}
		$warriors = [$warrior1, $warrior2];
		usort($warriors, function(Warrior $a, Warrior $b) {
			return $a->getSpeed() <=> $b->getSpeed();
		});
		return $warriors;
	}
}