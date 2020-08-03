<?php declare(strict_types=1);

namespace Hero\Game;

class PlayerSorter
{
	/** @var SortFunction[] */
	private array $sortFunctions;

	public function sort(Warrior $player1, Warrior $player2)
	{
		// todo: determine correct term: "player" or "warrior"
		// todo: refactor this shit

		foreach ($this->sortFunctions as $function) {
			$order = $function->establishOrder($player1, $player2);
			if ($order) {
				return $order;
			}
		}
		return [$player1, $player2]; // whatever
	}

	public function registerFunction(SortFunction $sortFunction)
	{
		$this->sortFunctions[] = $sortFunction;
	}
}