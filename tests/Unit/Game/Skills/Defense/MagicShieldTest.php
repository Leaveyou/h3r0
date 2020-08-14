<?php declare(strict_types=1);

namespace Tests\Unit\Game\Skills\Defense;

use Hero\Game\Monitor;
use Hero\Game\Skills\Defense\MagicShield;
use Hero\Game\WarriorStats;
use Hero\Tools\Chance;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;

class MagicShieldTest extends TestCase
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
     * @var MagicShield
     */
    private MagicShield $magicShield;
    /**
     * @var Monitor|MockInterface
     */
    private $monitor;

    protected function setUp(): void
    {
        $this->warriorStats = \Mockery::mock(WarriorStats::class);

        $this->skillChance = \Mockery::mock(Chance::class);
        $this->monitor = \Mockery::mock(Monitor::class);
        $this->magicShield = new MagicShield($this->skillChance);
        $this->magicShield->setMonitor($this->monitor);
    }

    public function testLucky()
    {
        $this->skillChance->shouldReceive("roll")->withNoArgs()->andReturn(true);
        $this->warriorStats->shouldReceive("getName")->once()->andReturn("Gigi");
        $this->monitor->shouldReceive("customMessage")->with("Gigi uses Magic Shield® and takes no damage.");
        $return = $this->magicShield->use($this->warriorStats, 5);
        $this->assertSame(0, $return, "Warrior should not receive any damage when using Magic Shield");
    }

    public function testUnLucky()
    {
        $this->skillChance->shouldReceive("roll")->withNoArgs()->andReturn(false);
        $return = $this->magicShield->use($this->warriorStats, 123);
        $this->assertSame(null, $return, "Skill should not have triggered");
    }
}