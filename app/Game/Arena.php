<?php declare(strict_types=1);

namespace Hero\Game;

class Arena
{
	private PlayerSorter $playerOrderRules;

	/**
	 * Arena constructor.
	 * @param PlayerSorter $playerOrderRules
	 */
	public function __construct(PlayerSorter $playerOrderRules)
	{
		$this->playerOrderRules = $playerOrderRules;
	}

	public function fight(Warrior $player1, Warrior $player2)
	{
		list($firstPlayer, $secondPlayer) = $this->playerOrderRules->sort($player1, $player2);



		//$this->fightFactory->newFight
	}
}