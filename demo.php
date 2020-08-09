<?php declare(strict_types = 1);

use Hero\Demo\WarriorBuilder;
use Hero\Game\Arena;
use Hero\Game\FightFactory;
use Hero\Game\WarriorSorter;
use Hero\Modules\Defense\DefaultDefense;
use Hero\Modules\Defense\MagicShield;
use Hero\Modules\Offense\DefaultStrike;
use Hero\Modules\Offense\RapidStrike;
use Hero\Modules\WarriorSortRules\Luck as LuckSorter;
use Hero\Modules\WarriorSortRules\Speed as SpeedSorter;
use Hero\Tools\Chance;
use Hero\Tools\ConsoleColors as Color;

$autoloader = require("vendor/autoload.php");

// todo: monolog debug messages

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

$orderus->addOffensiveSkill(new RapidStrike(new Chance(12)));
$orderus->addOffensiveSkill(new DefaultStrike(new Chance(100)));

$orderus->addDefensiveSkill(new MagicShield(new Chance(15)));
$orderus->addDefensiveSkill(new DefaultDefense(new Chance(100)));

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

$balaurus->addOffensiveSkill(new DefaultStrike(new Chance(100)));
$balaurus->addDefensiveSkill(new DefaultDefense(new Chance(100)));

$warriorSorter = new WarriorSorter();
$warriorSorter->registerFunction(new SpeedSorter());
$warriorSorter->registerFunction(new LuckSorter());

$arena = new Arena($warriorSorter, new FightFactory());
$arena->fight($orderus, $balaurus);

// todo: determine ties