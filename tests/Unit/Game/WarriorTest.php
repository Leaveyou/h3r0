<?php declare(strict_types=1);

namespace Tests\Unit\Game;

use Hero\Game\Defender;
use Hero\Game\Skills\DefensiveSkill;
use Hero\Game\Skills\OffensiveSkill;
use Hero\Game\Warrior;
use Hero\Tools\Chance;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use Mockery\MockInterface;

class WarriorTest extends MockeryTestCase
{
    /**
     * @var Chance
     */
    private Chance $luck;
    /**
     * @var Warrior
     */
    private Warrior $warrior;
    /**
     * @var Defender|MockInterface
     */
    private $defender;
    /**
     * @var OffensiveSkill|MockInterface
     */
    private $offensiveSkill;

    public function testAttackWithNoSkills()
    {
        $result = $this->warrior->attack($this->defender);
        $this->assertFalse($result);
    }

    public function testAttackWithImpossibleSkills()
    {
        $this->warrior->addOffensiveSkill($this->offensiveSkill);

        $this->offensiveSkill->shouldReceive("roll")->once()->withNoArgs()->andReturn(false);

        $result = $this->warrior->attack($this->defender);
        $this->assertFalse($result);
    }

    public function testAttackWithSureSkills()
    {
        $this->warrior->addOffensiveSkill($this->offensiveSkill);

        $this->offensiveSkill->shouldReceive("roll")->twice()->withNoArgs()->andReturn(true);
        $this->offensiveSkill->shouldReceive("use")->twice()->with($this->defender, $this->warrior)->andReturn(true, false);

        $result = $this->warrior->attack($this->defender);
        $this->assertSame(true, $result);
        $result = $this->warrior->attack($this->defender);
        $this->assertSame(false, $result);
    }

    public function testShortName()
    {
        $this->expectExceptionMessage("Warrior name is too short!");
        $this->warrior = new Warrior("", 99, 88, 77, 66, $this->luck);
    }

    public function testLongName()
    {
        $this->expectExceptionMessage("Warrior name is too long!");
        $this->warrior = new Warrior(str_repeat("a", 101), 99, 88, 77, 66, $this->luck);
    }

    public function testWeirdName()
    {
        $this->expectExceptionMessage("Warrior name is in an unknown language!");
        $this->warrior = new Warrior("Asd\x00\x81sdf", 99, 88, 77, 66, $this->luck);
    }

    public function testDefendDeathBLowWithNoSkills()
    {
        $result = $this->warrior->defend(100);
        $this->assertFalse($result);
    }

    public function testDefendMosquitoByteWithNoSkills()
    {
        $result = $this->warrior->defend(1);
        $this->assertTrue($result);
    }

    public function testDefenseSkills()
    {
        $initialHealth = $this->warrior->getHealth();
        $intendedDamage = 5;

        $defensiveSkill1 = Mockery::mock(DefensiveSkill::class);
        $defensiveSkill1->shouldReceive("use")
            ->with($this->warrior, 10)
            ->once()
            ->andReturn(null);
        $defensiveSkill2 = Mockery::mock(DefensiveSkill::class);
        $defensiveSkill2
            ->shouldReceive("use")
            ->with($this->warrior, 10)
            ->once()
            ->andReturn($intendedDamage);
        $defensiveSkill3 = Mockery::mock(DefensiveSkill::class);
        $defensiveSkill3
            ->shouldReceive("use")
            ->with($this->warrior, 10)
            ->never()
            ->andReturn();

        $this->warrior->addDefensiveSkill($defensiveSkill1);
        $this->warrior->addDefensiveSkill($defensiveSkill2);
        $this->warrior->addDefensiveSkill($defensiveSkill3);

        $result = $this->warrior->defend(10);
        $this->assertTrue($result);
        $this->assertSame(5, $initialHealth - $this->warrior->getHealth(),  "Incorrect damage applied");
    }

    protected function setUp(): void
    {
        $this->luck = new Chance(55);
        $this->warrior = new Warrior("Gigi", 99, 88, 77, 66, $this->luck);
        $this->defender = Mockery::mock(Defender::class);
        $this->offensiveSkill = Mockery::mock(OffensiveSkill::class);
    }

}
