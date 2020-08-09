<?php declare(strict_types = 1);

use Hero\Game\Arena;
use Hero\Game\FightFactory;
use Hero\Game\WarriorSorter;
use Hero\Game\Warrior;
use Hero\Modules\Defense\DefaultDefense;
use Hero\Modules\Defense\MagicShield;
use Hero\Modules\Offense\DefaultStrike;
use Hero\Modules\Offense\RapidStrike;
use Hero\Modules\WarriorSortRules\Luck as LuckSorter;
use Hero\Modules\WarriorSortRules\Speed as SpeedSorter;
use Hero\Tools\Chance;

$autoloader = require("vendor/autoload.php");

// todo: monolog debug messages

$orderus = new Warrior("Orderus", 170, 70, 45, 42, new Chance(13));
$orderus->addOffensiveSkill(new RapidStrike(), new Chance(12));
$orderus->addOffensiveSkill(new DefaultStrike(), new Chance(100));
$orderus->addDefensiveSkill(new MagicShield(), new Chance(15));
$orderus->addDefensiveSkill(new DefaultDefense(), new Chance(100));

$balaurus = new Warrior("Balaurus", 170, 70, 43, 42, new Chance(12));
$balaurus->addOffensiveSkill(new DefaultStrike(), new Chance(100));
$balaurus->addDefensiveSkill(new DefaultDefense(), new Chance(100));

$warriorSorter = new WarriorSorter();
$warriorSorter->registerFunction(new SpeedSorter());
$warriorSorter->registerFunction(new LuckSorter());

$arena = new Arena($warriorSorter, new FightFactory());

$winner = $arena->fight($orderus, $balaurus);


