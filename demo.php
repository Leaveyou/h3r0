<?php declare(strict_types = 1);

use Hero\Demo\WarriorBuilder;
use Hero\Game\Arena;
use Hero\Game\Monitor;
use Hero\Game\Skills\Defense\DefaultDefense;
use Hero\Game\Skills\Defense\MagicShield;
use Hero\Game\Skills\Offense\DefaultStrike;
use Hero\Game\Skills\Offense\RapidStrike;
use Hero\Game\WarriorSorter;
use Hero\Game\WarriorSortRules\Luck as LuckSorter;
use Hero\Game\WarriorSortRules\Speed as SpeedSorter;
use Hero\Tools\Chance;
use Hero\Tools\ConsoleColors as Color;

$autoloader = require("vendor/autoload.php");

$monitor = new Monitor();

$warriorBuilder = new WarriorBuilder();

$orderus = $warriorBuilder
    ->setMinimumHealth(70)
    ->setMaximumHealth(100)
    ->setMinimumStrength(70)
    ->setMaximumStrength(80)
    ->setMinimumDefense(45)
    ->setMaximumDefense(55)
    ->setMinimumLuck(10)
    ->setMaximumLuck(30)
    ->setMinimumSpeed(40)
    ->setMaximumSpeed(50)
    ->build(Color::green("Orderus"));

$rapidStrike = new RapidStrike(new Chance(12));
$defaultStrike = new DefaultStrike(new Chance(100));
$defaultDefense = new DefaultDefense(new Chance(100));
$magicShield = new MagicShield(new Chance(15));

$orderus->addOffensiveSkill($rapidStrike->setMonitor($monitor));
$orderus->addOffensiveSkill($defaultStrike->setMonitor($monitor));

$orderus->addDefensiveSkill($magicShield->setMonitor($monitor));
$orderus->addDefensiveSkill($defaultDefense->setMonitor($monitor));

$balaurus = $warriorBuilder
    ->setMinimumHealth(60)
    ->setMaximumHealth(90)
    ->setMinimumStrength(60)
    ->setMaximumStrength(90)
    ->setMinimumDefense(40)
    ->setMaximumDefense(60)
    ->setMinimumLuck(24)
    ->setMaximumLuck(40)
    ->setMinimumSpeed(40)
    ->setMaximumSpeed(60)
    ->build(Color::cyan("Balaurus"));

$balaurus->addOffensiveSkill($defaultStrike->setMonitor($monitor));
$balaurus->addDefensiveSkill($defaultDefense->setMonitor($monitor));

$warriorSorter = new WarriorSorter();
$warriorSorter->registerFunction(new SpeedSorter());
$warriorSorter->registerFunction(new LuckSorter());

$arena = new Arena($warriorSorter, new Monitor());
$arena->fight($orderus, $balaurus);

// todo: determine ties