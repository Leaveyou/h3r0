<?php declare(strict_types=1);

namespace Hero\Game;

use Generator;

class Arena
{
    const NUMBER_OF_ROUNDS = 20;

    private WarriorSorter $warriorOrderRules;
    private Monitor $monitor;

    /**
     * Arena constructor.
     * @param WarriorSorter $warriorOrderRules
     * @param Monitor $monitor
     */
    public function __construct(WarriorSorter $warriorOrderRules, Monitor $monitor)
    {
        $this->warriorOrderRules = $warriorOrderRules;
        $this->monitor = $monitor;
    }

    /**
     * Simulate fight between two warriors
     * @param Warrior $warriorA
     * @param Warrior $warriorB
     * @return Warrior|null
     */
    public function fight(Warrior $warriorA, Warrior $warriorB): ?Warrior
    {
        foreach ($this->getAttacks($warriorA, $warriorB) as $attack) {
            $attacker = $attack->getAttacker();
            $defender = $attack->getDefender();

            if ($defender->getHealth() === 0) {
                $this->monitor->showWinner($attacker->getName(), $attacker->getHealth());
                return $attacker;
            }
        }
        $this->monitor->showTie(self::NUMBER_OF_ROUNDS);
        return null;
    }

    /**
     * @param Warrior $warriorA
     * @param Warrior $warriorB
     * @return Generator|AttackSummary[]
     */
    private function getAttacks(Warrior $warriorA, Warrior $warriorB): Generator
    {
        list($firstWarrior, $secondWarrior) = $this->warriorOrderRules->sort($warriorA, $warriorB);
        $this->monitor->showFirst($firstWarrior->getName());
        for ($round = 1; $round <= self::NUMBER_OF_ROUNDS; $round++) {
            $this->monitor->roundStart(
                $round,
                $firstWarrior->getName(),
                $firstWarrior->getHealth(),
                $secondWarrior->getName(),
                $secondWarrior->getHealth()
            );

            foreach ($this->getPairCombinations($firstWarrior, $secondWarrior) as list("attacker" => $attacker, "defender" => $defender)) {
                $attacker->attack($defender);
                yield new AttackSummary($attacker, $defender);
            }
        }
    }

    /**
     * @param Warrior $firstWarrior
     * @param Warrior $secondWarrior
     * @return Generator|Warrior[][]
     */
    private function getPairCombinations(Warrior $firstWarrior, Warrior $secondWarrior): Generator
    {
        yield ["attacker" => $firstWarrior, "defender" => $secondWarrior];
        yield ["attacker" => $secondWarrior, "defender" => $firstWarrior];
    }
}
