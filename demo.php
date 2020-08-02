<?php declare(strict_types = 1);

use Hero\Game\Arena;
use Hero\Game\Warrior;
use Hero\Modules\Defense\MagicShield;
use Hero\Modules\Offense\RapidStrike;

$autoloader = require("vendor/autoload.php");

$arena = new Arena();

$orderus = new Warrior();

$rapidStrike = new RapidStrike();
$orderus->addOffensiveSkill($rapidStrike);

$magicShield = new MagicShield();
$orderus->addDefensiveSkill($magicShield);

$balaurus = new Warrior();


foreach ($arena->rounds($orderus, $balaurus) as $round) {
	echo $round;
}
