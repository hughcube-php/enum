<?php

namespace HughCube\PinCode\Tests;

use HughCube\Enum\BoolEnum;
use HughCube\Enum\Enum;
use HughCube\Enum\EnumInterface;
use PHPUnit\Framework\TestCase;

class BoolEnumTest extends TestCase
{
    public function testInstance()
    {
        $enum = new BoolEnum;
        $this->assertInstanceOf(EnumInterface::class, $enum);
        $this->assertInstanceOf(Enum::class, $enum);
    }

    public function testIsTrue()
    {
        $this->assertSame(true, BoolEnum::isTrue(BoolEnum::TRUE));
        $this->assertSame(false, BoolEnum::isTrue(BoolEnum::FALSE));
    }

    public function testIsFalse()
    {
        $this->assertSame(true, BoolEnum::isFalse(BoolEnum::FALSE));
        $this->assertSame(false, BoolEnum::isFalse(BoolEnum::TRUE));
    }
}
