<?php

namespace HughCube\PinCode\Tests;

use HughCube\Enum\Enum;
use HughCube\Enum\EnumInterface;
use HughCube\Enum\NetworkTypeEnum;
use PHPUnit\Framework\TestCase;

class NetworkTypeEnumTest extends TestCase
{
    public function testInstance()
    {
        $enum = new NetworkTypeEnum;

        $this->assertInstanceOf(EnumInterface::class, $enum);
        $this->assertInstanceOf(Enum::class, $enum);
    }
}
