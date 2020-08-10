<?php declare(strict_types=1);

namespace Tests\Unit\Game;

use Hero\Game\Arena;
use Hero\Game\Monitor;
use Hero\Game\Warrior;
use Hero\Game\WarriorSorter;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use Mockery\Mock;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;

class ArenaTest extends MockeryTestCase
{
	/** @var WarriorSorter|MockInterface */
	private WarriorSorter $warriorSorter;

	/** @var Monitor|MockInterface */
	private Monitor $monitor;
	/**
	 * @var Arena
	 */
	private Arena $arena;

	public function setUp(): void
	{
		$this->warriorSorter = \Mockery::mock(WarriorSorter::class);
		$this->monitor = \Mockery::mock(Monitor::class);
		$this->arena = new Arena($this->warriorSorter, $this->monitor);
	}

	public function testSortingAndTiedGameWithImmortalCharacters()
	{
		$warriorA = \Mockery::mock(Warrior::class);
		$warriorA->shouldReceive("getName")->andReturn("Warrior A");
		$warriorA->shouldReceive("getHealth")->andReturn(88);
		$warriorA->shouldReceive("attack")->andReturn(88);

		$warriorB = \Mockery::mock(Warrior::class);
		$warriorB->shouldReceive("getName")->andReturn("Warrior B");
		$warriorB->shouldReceive("getHealth")->andReturn(99);
		$warriorB->shouldReceive("attack")->andReturn(99);

		$this->warriorSorter->shouldReceive("sort")->with($warriorA, $warriorB)->andReturn([$warriorB, $warriorA]);

		$this->monitor->shouldReceive("showFirst")->with("Warrior B");
		$this->monitor->shouldReceive("roundStart")->withAnyArgs()->times(20);
		$this->monitor->shouldReceive("showTie")->withAnyArgs()->once();

		$this->arena->fight($warriorA, $warriorB);
	}

	public function testDeadWarrior()
	{
		$warriorA = \Mockery::mock(Warrior::class);
		$warriorA->shouldReceive("getName")->andReturn("Warrior A");
		$warriorA->shouldReceive("getHealth")->andReturn(0);
		$warriorA->shouldReceive("attack")->andReturn(88);

		$warriorB = \Mockery::mock(Warrior::class);
		$warriorB->shouldReceive("getName")->andReturn("Warrior B");
		$warriorB->shouldReceive("getHealth")->andReturn(99);
		$warriorB->shouldReceive("attack")->andReturn(99);

		$this->warriorSorter->shouldReceive("sort")->with($warriorA, $warriorB)->andReturn([$warriorA, $warriorB]);

		$this->monitor->shouldReceive("showFirst")->with("Warrior A");
		$this->monitor->shouldReceive("roundStart")->withAnyArgs()->times(1);
		$this->monitor->shouldReceive("showWinner")->with('Warrior B', 99)->once();

		$this->arena->fight($warriorA, $warriorB);
	}

	public function test2Rounds()
	{
		$warriorA = \Mockery::mock(Warrior::class);
		$warriorA->shouldReceive("getName")->andReturn("Warrior A");
		$warriorA->shouldReceive("getHealth")->andReturn(88,88,0,0);
		$warriorA->shouldReceive("attack")->andReturn(88);

		$warriorB = \Mockery::mock(Warrior::class);
		$warriorB->shouldReceive("getName")->andReturn("Warrior B");
		$warriorB->shouldReceive("getHealth")->andReturn(99,77,55,33);
		$warriorB->shouldReceive("attack")->andReturn(99);

		$this->warriorSorter->shouldReceive("sort")->with($warriorA, $warriorB)->andReturn([$warriorA, $warriorB]);

		$this->monitor->shouldReceive("showFirst")->with("Warrior A");
		$this->monitor->shouldReceive("roundStart")->with(1, 'Warrior A', 88, 'Warrior B', 99)->times(1);
		$this->monitor->shouldReceive("roundStart")->with(2, 'Warrior A', 0, 'Warrior B', 55)->times(1);
		$this->monitor->shouldReceive("showWinner")->with('Warrior B', 33)->once();

		$this->arena->fight($warriorA, $warriorB);
	}
}
