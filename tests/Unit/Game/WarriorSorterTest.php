<?php declare(strict_types=1);

namespace Tests\Unit\Game;

use Hero\Game\SortFunction;
use Hero\Game\Warrior;
use Hero\Game\WarriorSorter;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use Mockery\MockInterface;

class WarriorSorterTest extends MockeryTestCase
{
	/**
	 * @var WarriorSorter
	 */
	private WarriorSorter $warriorSorter;
	/**
	 * @var Warrior|MockInterface
	 */
	private $warriorA;
	/**
	 * @var Warrior|MockInterface
	 */
	private $warriorB;

	protected function setUp(): void
	{
		$this->warriorSorter = new WarriorSorter();
		$this->warriorA = \Mockery::mock(Warrior::class);
		$this->warriorB = \Mockery::mock(Warrior::class);
	}

	public function testNoSortFunctions()
	{
		$result = $this->warriorSorter->sort($this->warriorA, $this->warriorB);
		$this->assertSame([$this->warriorA, $this->warriorB], $result, "Warriors are not given back in the order they were inserted if there are no sort functions registered");
	}


	public function testSortFunctions()
	{
		$sortFunction1 = \Mockery::mock(SortFunction::class);
		$sortFunction1
			->shouldReceive("establishOrder")
			->with($this->warriorA, $this->warriorB)->once()
			->andReturn(null);

		$sortFunction2 = \Mockery::mock(SortFunction::class);
		$sortFunction2
			->shouldReceive("establishOrder")
			->with($this->warriorA, $this->warriorB)->once()
			->andReturn([$this->warriorB, $this->warriorA]);

		$sortFunction3 = \Mockery::mock(SortFunction::class);
		$sortFunction3
			->shouldReceive("establishOrder")
			->with($this->warriorA, $this->warriorB)->never();


		$this->warriorSorter->registerFunction($sortFunction1);
		$this->warriorSorter->registerFunction($sortFunction2);
		$this->warriorSorter->registerFunction($sortFunction3);

		$result = $this->warriorSorter->sort($this->warriorA, $this->warriorB);
		$this->assertSame([$this->warriorB, $this->warriorA], $result, "Warriors are not returned in correct order");
	}
}
