<?php

namespace HughCube\Enum;

/**
 * Class GenderEnum
 * @package common\constants
 *
 * @method static boolean isNone(string | int $type)         检查是否为none
 * @method static boolean isMale(string | int $type)         检查是否为male
 * @method static boolean isFemale(string | int $type)       检查是否为female
 * @method static boolean isOther(string | int $type)        检查是否为other
 */
class GenderEnum extends Enum
{
    const NONE   = '0';
    const MALE   = '1';
    const FEMALE = '2';
    const OTHER  = '3';

    protected static $labels = [
        self::NONE => ['title' => 'none', 'name' => 'none', 'is_default' => true, 'can_select' => false],
        self::MALE => ['title' => '男', 'name' => 'male'],
        self::FEMALE => ['title' => '女', 'name' => 'female'],
        self::OTHER => ['title' => '其他', 'name' => 'other'],
    ];
}
