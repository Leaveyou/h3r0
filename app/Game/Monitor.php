<?php declare(strict_types=1);

namespace Hero\Game;

use Hero\Tools\ConsoleColors as Color;

class Monitor
{
	/**
	 * @param int $round
	 * @param string $firstWarriorName
	 * @param int $firstWarriorHealth
	 * @param string $secondWarriorName
	 * @param int $secondWarriorHealth
	 */
	public function roundStart(int $round, string $firstWarriorName, int $firstWarriorHealth, string $secondWarriorName, int $secondWarriorHealth): void
	{
		echo PHP_EOL . Color::red("# Round {$round}:") . PHP_EOL;
		echo "# " . $firstWarriorName . " - " . $firstWarriorHealth . " health" . PHP_EOL;
		echo "# " . $secondWarriorName . " - " . $secondWarriorHealth . " health" . PHP_EOL;
		echo "----------------------- " . PHP_EOL;
	}
}