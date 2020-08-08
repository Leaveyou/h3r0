<?php declare(strict_types=1);


namespace Hero\Game;


class FightFactory
{
	public function newFight(Warrior $firstWarrior, Warrior $secondWarrior)
	{
		return new Fight($firstWarrior, $secondWarrior);
	}
}