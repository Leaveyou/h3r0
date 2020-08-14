<?php declare(strict_types=1);

namespace Hero\Game;

use Hero\Tools\ConsoleColors as Color;

class Monitor
{
    public function customMessage($message)
    {
        echo $message . PHP_EOL;
    }

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

    public function showFirst(string $warriorName)
    {
        echo "{$warriorName} goes first" . PHP_EOL;
    }

    public function showWinner(string $name, int $health)
    {
        echo PHP_EOL . Color::red("Winner is ") . $name . Color::red(" with {$health} health remaining.") . PHP_EOL . PHP_EOL;
    }

    public function showTie(int $rounds)
    {
        echo PHP_EOL . Color::red("Fight ends in a tie after") . $rounds . Color::red(" rounds.") . PHP_EOL . PHP_EOL;
    }
}
