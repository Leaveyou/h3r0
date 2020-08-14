<?php declare(strict_types=1);

namespace Hero\Demo;

use Tests\Unit\Demo\WarriorBuilderTest;

function rand($a, $b)
{
    return WarriorBuilderTest::$functions->randMock($a, $b);
}

namespace Tests\Unit\Demo;

use BadMethodCallException;
use Hero\Demo\WarriorBuilder;
use Hero\Tools\Chance;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;

class WarriorBuilderTest extends MockeryTestCase
{
    public static $functions;

    protected function setUp(): void
    {
        self::$functions = Mockery::mock();
    }

    function testRandomness()
    {
        $warriorBuilder = new WarriorBuilder();

        $warriorBuilder->setMinimumHealth(1);
        $warriorBuilder->setMaximumHealth(2);
        $warriorBuilder->setMinimumStrength(3);
        $warriorBuilder->setMaximumStrength(4);
        $warriorBuilder->setMinimumDefense(5);
        $warriorBuilder->setMaximumDefense(6);
        $warriorBuilder->setMinimumLuck(7);
        $warriorBuilder->setMaximumLuck(8);
        $warriorBuilder->setMinimumSpeed(9);
        $warriorBuilder->setMaximumSpeed(10);

        self::$functions->shouldReceive('randMock')->with(1, 2)->once()->andReturn(1);
        self::$functions->shouldReceive('randMock')->with(3, 4)->once()->andReturn(3);
        self::$functions->shouldReceive('randMock')->with(5, 6)->once()->andReturn(5);
        self::$functions->shouldReceive('randMock')->with(7, 8)->once()->andReturn(7);
        self::$functions->shouldReceive('randMock')->with(9, 10)->once()->andReturn(9);

        $result = $warriorBuilder->build("Gigi");

        $this->assertEquals("Gigi", $result->getName());
        $this->assertEquals(1, $result->getHealth());
        $this->assertEquals(3, $result->getStrength());
        $this->assertEquals(5, $result->getDefense());
        $this->assertEquals(new Chance(7), $result->getLuck());
        $this->assertEquals(9, $result->getSpeed());

        // test building resets parameters
        $this->expectException(BadMethodCallException::class);
        $result = $warriorBuilder->build("Gigi");
    }

    public function testMinimumHealthValidation()
    {
        $warriorBuilder = new WarriorBuilder();
        // $warriorBuilder->setMinimumHealth(1);
        $warriorBuilder->setMaximumHealth(2);
        $warriorBuilder->setMinimumStrength(3);
        $warriorBuilder->setMaximumStrength(4);
        $warriorBuilder->setMinimumDefense(5);
        $warriorBuilder->setMaximumDefense(6);
        $warriorBuilder->setMinimumLuck(7);
        $warriorBuilder->setMaximumLuck(8);
        $warriorBuilder->setMinimumSpeed(9);
        $warriorBuilder->setMaximumSpeed(10);

        $this->expectException(BadMethodCallException::class);
        $this->expectExceptionCode(0xCACA0);

        $warriorBuilder->build("Gigi");
    }


    public function testMaximumHealthValidation()
    {
        $warriorBuilder = new WarriorBuilder();
        $warriorBuilder->setMinimumHealth(1);
        // $warriorBuilder->setMaximumHealth(2);
        $warriorBuilder->setMinimumStrength(3);
        $warriorBuilder->setMaximumStrength(4);
        $warriorBuilder->setMinimumDefense(5);
        $warriorBuilder->setMaximumDefense(6);
        $warriorBuilder->setMinimumLuck(7);
        $warriorBuilder->setMaximumLuck(8);
        $warriorBuilder->setMinimumSpeed(9);
        $warriorBuilder->setMaximumSpeed(10);

        $this->expectException(BadMethodCallException::class);
        $this->expectExceptionCode(0xCACA1);

        $warriorBuilder->build("Gigi");
    }

    public function testMinimumStrengthValidation()
    {
        $warriorBuilder = new WarriorBuilder();
        $warriorBuilder->setMinimumHealth(1);
        $warriorBuilder->setMaximumHealth(2);
        // $warriorBuilder->setMinimumStrength(3);
        $warriorBuilder->setMaximumStrength(4);
        $warriorBuilder->setMinimumDefense(5);
        $warriorBuilder->setMaximumDefense(6);
        $warriorBuilder->setMinimumLuck(7);
        $warriorBuilder->setMaximumLuck(8);
        $warriorBuilder->setMinimumSpeed(9);
        $warriorBuilder->setMaximumSpeed(10);

        $this->expectException(BadMethodCallException::class);
        $this->expectExceptionCode(0xCACA2);

        $warriorBuilder->build("Gigi");
    }

    public function testMaximumStrengthValidation()
    {
        $warriorBuilder = new WarriorBuilder();
        $warriorBuilder->setMinimumHealth(1);
        $warriorBuilder->setMaximumHealth(2);
        $warriorBuilder->setMinimumStrength(3);
        // $warriorBuilder->setMaximumStrength(4);
        $warriorBuilder->setMinimumDefense(5);
        $warriorBuilder->setMaximumDefense(6);
        $warriorBuilder->setMinimumLuck(7);
        $warriorBuilder->setMaximumLuck(8);
        $warriorBuilder->setMinimumSpeed(9);
        $warriorBuilder->setMaximumSpeed(10);

        $this->expectException(BadMethodCallException::class);
        $this->expectExceptionCode(0xCACA3);

        $warriorBuilder->build("Gigi");
    }

    public function testMinimumDefenseValidation()
    {
        $warriorBuilder = new WarriorBuilder();
        $warriorBuilder->setMinimumHealth(1);
        $warriorBuilder->setMaximumHealth(2);
        $warriorBuilder->setMinimumStrength(3);
        $warriorBuilder->setMaximumStrength(4);
        // $warriorBuilder->setMinimumDefense(5);
        $warriorBuilder->setMaximumDefense(6);
        $warriorBuilder->setMinimumLuck(7);
        $warriorBuilder->setMaximumLuck(8);
        $warriorBuilder->setMinimumSpeed(9);
        $warriorBuilder->setMaximumSpeed(10);

        $this->expectException(BadMethodCallException::class);
        $this->expectExceptionCode(0xCACA4);

        $warriorBuilder->build("Gigi");
    }

    public function testMaximumDefenseValidation()
    {
        $warriorBuilder = new WarriorBuilder();
        $warriorBuilder->setMinimumHealth(1);
        $warriorBuilder->setMaximumHealth(2);
        $warriorBuilder->setMinimumStrength(3);
        $warriorBuilder->setMaximumStrength(4);
        $warriorBuilder->setMinimumDefense(5);
        // $warriorBuilder->setMaximumDefense(6);
        $warriorBuilder->setMinimumLuck(7);
        $warriorBuilder->setMaximumLuck(8);
        $warriorBuilder->setMinimumSpeed(9);
        $warriorBuilder->setMaximumSpeed(10);

        $this->expectException(BadMethodCallException::class);
        $this->expectExceptionCode(0xCACA5);

        $warriorBuilder->build("Gigi");
    }

    public function testMinimumLuckValidation()
    {
        $warriorBuilder = new WarriorBuilder();
        $warriorBuilder->setMinimumHealth(1);
        $warriorBuilder->setMaximumHealth(2);
        $warriorBuilder->setMinimumStrength(3);
        $warriorBuilder->setMaximumStrength(4);
        $warriorBuilder->setMinimumDefense(5);
        $warriorBuilder->setMaximumDefense(6);
        //$warriorBuilder->setMinimumLuck(7);
        $warriorBuilder->setMaximumLuck(8);
        $warriorBuilder->setMinimumSpeed(9);
        $warriorBuilder->setMaximumSpeed(10);

        $this->expectException(BadMethodCallException::class);
        $this->expectExceptionCode(0xCACA6);

        $warriorBuilder->build("Gigi");
    }

    public function testMaximumLuckValidation()
    {
        $warriorBuilder = new WarriorBuilder();
        $warriorBuilder->setMinimumHealth(1);
        $warriorBuilder->setMaximumHealth(2);
        $warriorBuilder->setMinimumStrength(3);
        $warriorBuilder->setMaximumStrength(4);
        $warriorBuilder->setMinimumDefense(5);
        $warriorBuilder->setMaximumDefense(6);
        $warriorBuilder->setMinimumLuck(7);
        // $warriorBuilder->setMaximumLuck(8);
        $warriorBuilder->setMinimumSpeed(9);
        $warriorBuilder->setMaximumSpeed(10);

        $this->expectException(BadMethodCallException::class);
        $this->expectExceptionCode(0xCACA7);

        $warriorBuilder->build("Gigi");
    }

    public function testMinimumSpeedValidation()
    {
        $warriorBuilder = new WarriorBuilder();
        $warriorBuilder->setMinimumHealth(1);
        $warriorBuilder->setMaximumHealth(2);
        $warriorBuilder->setMinimumStrength(3);
        $warriorBuilder->setMaximumStrength(4);
        $warriorBuilder->setMinimumDefense(5);
        $warriorBuilder->setMaximumDefense(6);
        $warriorBuilder->setMinimumLuck(7);
        $warriorBuilder->setMaximumLuck(8);
        // $warriorBuilder->setMinimumSpeed(9);
        $warriorBuilder->setMaximumSpeed(10);

        $this->expectException(BadMethodCallException::class);
        $this->expectExceptionCode(0xCACA8);

        $warriorBuilder->build("Gigi");
    }

    public function testMaximumSpeedValidation()
    {
        $warriorBuilder = new WarriorBuilder();
        $warriorBuilder->setMinimumHealth(1);
        $warriorBuilder->setMaximumHealth(2);
        $warriorBuilder->setMinimumStrength(3);
        $warriorBuilder->setMaximumStrength(4);
        $warriorBuilder->setMinimumDefense(5);
        $warriorBuilder->setMaximumDefense(6);
        $warriorBuilder->setMinimumLuck(7);
        $warriorBuilder->setMaximumLuck(8);
        $warriorBuilder->setMinimumSpeed(9);
        // $warriorBuilder->setMaximumSpeed(10);

        $this->expectException(BadMethodCallException::class);
        $this->expectExceptionCode(0xCACA9);

        $warriorBuilder->build("Gigi");
    }
}