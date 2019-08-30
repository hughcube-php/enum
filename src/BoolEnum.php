<?php

namespace HughCube\Enum;

/**
 * Class Boolean
 * @package common\constants
 *
 * @method static boolean isTrue(string | int $type)         检查是否为true
 * @method static boolean isFalse(string | int $type)          检查是否为false
 */
class BoolEnum extends Enum
{
    const TRUE  = '1';
    const FALSE = '0';

    /**
     * @inheritDoc
     */
    public static function labels()
    {
        return [
            static::TRUE => ['title' => '是', 'name' => 'true'],
            static::FALSE => ['title' => '否', 'name' => 'false', 'is_default' => true],
        ];
    }
}
