<?php declare(strict_types=1);

namespace Hero\Game\Skills\Offense;

use Hero\Game\Defender;
use Hero\Game\Skills\OffensiveSkill;
use Hero\Game\Skills\SkillChance;
use Hero\Game\WarriorStats;

class RapidStrike extends SkillChance implements OffensiveSkill
{
    public function use(Defender $target, WarriorStats $warriorStats): bool
    {
        $this->monitor("{$warriorStats->getName()} uses Rapid Strike® on {$target->getName()}");
        $target->defend($warriorStats->getStrength());
        $target->defend($warriorStats->getStrength());
        return true;
    }
}
