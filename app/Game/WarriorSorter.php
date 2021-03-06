<?php declare(strict_types=1);

namespace Hero\Game;

class WarriorSorter
{
    /** @var SortFunction[] */
    private array $sortFunctions = [];

    public function sort(Warrior $warriorA, Warrior $warriorB)
    {
        foreach ($this->sortFunctions as $function) {
            $order = $function->establishOrder($warriorA, $warriorB);
            if ($order) {
                return $order;
            }
        }
        return [$warriorA, $warriorB]; // whatever
    }

    /**
     * Register function for determining the warrior attack order.
     * Functions are evaluated in the order they are registered
     *
     * @param SortFunction $sortFunction
     */
    public function registerFunction(SortFunction $sortFunction): void
    {
        $this->sortFunctions[] = $sortFunction;
    }
}
