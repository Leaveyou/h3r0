<?php declare(strict_types=1);


namespace Hero\Modules\PlayerSortRules;


use Hero\Game\SortFunction;
use Hero\Game\Warrior;

class Luck implements SortFunction
{
	/**
	 * @param Warrior $warrior1
	 * @param Warrior $warrior2
	 * @return Warrior[]?
	 */
	public function establishOrder(Warrior $warrior1, Warrior $warrior2): ?array
	{
		if ($warrior1->getLuck() === $warrior2->getLuck()) {
			return null;
		}
		$warriors = [$warrior1, $warrior2];
		usort($warriors, function(Warrior $a, Warrior $b) {
			return $a->getLuck() <=> $b->getLuck();
		});
		return $warriors;
	}
}