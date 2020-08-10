<?php declare(strict_types=1);

namespace Tests\Unit\Game\Skills\Defense;

use Hero\Game\Monitor;
use Hero\Game\Skills\Defense\DefaultDefense;
use Hero\Game\WarriorStats;
use Hero\Tools\Chance;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use Mockery\MockInterface;

class DefaultDefenseTest extends MockeryTestCase
{

	/**
	 * @var WarriorStats|MockInterface
	 */
	private $warriorStats;
	/**
	 * @var Chance|MockInterface
	 */
	private $skillChance;
	/**
	 * @var DefaultDefense
	 */
	private DefaultDefense $defaultDefense;
	/**
	 * @var Monitor|MockInterface
	 */
	private $monitor;

	protected function setUp(): void
	{
		$this->warriorStats = \Mockery::mock(WarriorStats::class);

		$this->skillChance = \Mockery::mock(Chance::class);
		$this->monitor = \Mockery::mock(Monitor::class);
		$this->defaultDefense = new DefaultDefense($this->skillChance);
		$this->defaultDefense->setMonitor($this->monitor);
	}

	public function testLucky()
	{
		$luck = \Mockery::mock(Chance::class);
		$luck->shouldReceive("roll")->withNoArgs()->andReturn(true);

		$this->warriorStats->shouldReceive("getLuck")->once()->andReturn($luck);
		$this->warriorStats->shouldReceive("getName")->once()->andReturn("Gigi");

		$this->monitor->shouldReceive("customMessage")->with("Gigi gets lucky and takes no damage.");
		$attack = 5;
		$this->defaultDefense->use($this->warriorStats, $attack);
	}

	public function testUnlucky()
	{
		$luck = \Mockery::mock(Chance::class);
		$luck->shouldReceive("roll")->withNoArgs()->andReturn(false);

		$defense = 10;
		$health = 70;
		$attack = 50;

		$this->warriorStats->shouldReceive("getLuck")->once()->andReturn($luck);
		$this->warriorStats->shouldReceive("getName")->once()->andReturn("Gigi");
		$this->warriorStats->shouldReceive("getDefense")->once()->andReturn($defense);
		$this->warriorStats->shouldReceive("getHealth")->once()->andReturn($health);
		$this->monitor->shouldReceive("customMessage")->with("Gigi gets hit for " . ($attack - $defense) . " damage.");
		$this->defaultDefense->use($this->warriorStats, $attack);
	}

	public function testVeryUnlucky()
	{
		$luck = \Mockery::mock(Chance::class);
		$luck->shouldReceive("roll")->withNoArgs()->andReturn(false);
		$defense = 10;
		$health = 30;
		$attack = 50;
		$this->warriorStats->shouldReceive("getLuck")->once()->andReturn($luck);
		$this->warriorStats->shouldReceive("getName")->once()->andReturn("Gigi");
		$this->warriorStats->shouldReceive("getDefense")->once()->andReturn($defense);
		$this->warriorStats->shouldReceive("getHealth")->once()->andReturn($health);
		$this->monitor->shouldReceive("customMessage")->with("Gigi gets hit for " . ($health) . " damage.");
		$this->defaultDefense->use($this->warriorStats, $attack);
	}
}
