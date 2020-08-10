<?php declare(strict_types=1);

namespace Tests\Unit\Game;

use Hero\Game\Warrior;
use Hero\Game\WarriorSorter;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use PHPUnit\Framework\TestCase;

class WarriorSorterTest extends MockeryTestCase
{

	public function testNoSortFunctions()
	{
		$warriorSorter = new WarriorSorter();
		$warriorA = \Mockery::mock(Warrior::class);
		$warriorB = \Mockery::mock(Warrior::class);
		$result = $warriorSorter->sort($warriorA, $warriorB);
		$this->assertEquals([$warriorA, $warriorB], $result, "Warriors are not given back in the order they were inserted if there are no sort functions registered");
	}
}
