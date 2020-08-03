<?php declare(strict_types = 1);

use Hero\Game\PlayerSorter;
use Hero\Game\Warrior;
use Hero\Modules\Defense\MagicShield;
use Hero\Modules\Offense\RapidStrike;
use Hero\Modules\PlayerSortRules\Luck as LuckSorter;
use Hero\Modules\PlayerSortRules\Speed as SpeedSorter;

$autoloader = require("vendor/autoload.php");



$orderus = new Warrior("Orderus", 70, 70, 45, 40, 10);

$rapidStrike = new RapidStrike();
$orderus->addOffensiveSkill($rapidStrike);

$magicShield = new MagicShield();
$orderus->addDefensiveSkill($magicShield);

$balaurus = new Warrior("Balaurus", 70, 70, 45, 40, 10);


$playerSorter = new PlayerSorter();
$playerSorter->registerFunction(new SpeedSorter());
$playerSorter->registerFunction(new LuckSorter());

$arena = new Hero\Game\Arena($playerSorter);

$arena->fight($orderus, $balaurus);


