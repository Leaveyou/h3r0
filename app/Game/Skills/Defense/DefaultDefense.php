<?php declare(strict_types=1);

namespace Hero\Game\Skills\Defense;

use Hero\Game\Skills\DefensiveSkill;
use Hero\Game\Skills\SkillChance;
use Hero\Game\WarriorStats;

class DefaultDefense extends SkillChance implements DefensiveSkill
{
    /**
     * @param WarriorStats $warriorStats
     * @param int $attack
     * @return int|null Damage taken
     */
    public function use(WarriorStats $warriorStats, int $attack): ?int
    {
        if ($warriorStats->getLuck()->roll()) {
            $this->monitor("{$warriorStats->getName()} gets lucky and takes no damage.");
            return 0;
        }

        $damage = min(
            $attack - $warriorStats->getDefense(),
            $warriorStats->getHealth()
        );

        $this->monitor("{$warriorStats->getName()} gets hit for $damage damage.");
        return $damage;
    }
}
