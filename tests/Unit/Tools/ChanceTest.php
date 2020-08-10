<?php declare(strict_types=1);

namespace Hero\Tools;

use Tests\Unit\Tools\ChanceTest;

function rand($a, $b)
{
	return ChanceTest::$functions->rand($a, $b);
}

namespace Tests\Unit\Tools;

use Hero\Tools\Chance;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;

class ChanceTest extends MockeryTestCase
{
	public static $functions;

	protected function setUp(): void
	{
		self::$functions = Mockery::mock();

	}

	public function testLowerEdge()
	{
		self::$functions->shouldReceive("rand")->with(0, 99)->andReturn(0);
		$chance = new Chance(1);
		$outcome = $chance->roll();
		$this->assertSame(true, $outcome);
	}
	public function testHigherEdge()
	{
		self::$functions->shouldReceive("rand")->with(0, 99)->andReturn(1);
		$chance = new Chance(1);
		$outcome = $chance->roll();
		$this->assertSame(false, $outcome);
	}
	public function testMaximumChance()
	{
		self::$functions->shouldReceive("rand")->with(0, 99)->andReturn(99);
		$chance = new Chance(100);
		$outcome = $chance->roll();
		$this->assertSame(true, $outcome, "100% chance events should always roll TRUE");
	}

	public function testChanceComparison()
	{
		self::$functions->shouldReceive("rand")->with(0, 99)->andReturn(99);
		$chance1 = new Chance(11);
		$chance2 = new Chance(12);

		$this->assertSame(-1, $chance1->compare($chance2));
		$this->assertSame(0, $chance1->compare($chance1));
		$this->assertSame(1, $chance2->compare($chance1));
	}
}