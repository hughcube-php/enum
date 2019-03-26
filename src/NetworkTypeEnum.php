<?php

namespace HughCube\Enum;

/**
 * Class Network
 * @package common\constants
 *
 * @method static boolean isNone(string | int $type)        检查是否未设置的值
 * @method static boolean isUndefined(string | int $type)   检查是否未知网络
 * @method static boolean isWifi(string | int $type)        检查是否WiFi
 * @method static boolean is1g(string | int $type)          检查是否1G
 * @method static boolean is2g(string | int $type)          检查是否2G
 * @method static boolean is3g(string | int $type)          检查是否3G
 * @method static boolean is4g(string | int $type)          检查是否4G
 * @method static boolean is5g(string | int $type)          检查是否5G
 */
class NetworkTypeEnum extends Enum
{
    const NONE      = '0';
    const UNDEFINED = '11';
    const WIFI      = '21';
    const M_1G      = '31';
    const M_2G      = '32';
    const M_3G      = '33';
    const M_4G      = '34';
    const M_5G      = '35';

    public static $labels = [
        self::NONE => ['title' => 'none', 'name' => 'none', 'is_default' => true, 'can_select' => false],
        self::UNDEFINED => ['title' => 'undefined', 'name' => 'undefined'],
        self::WIFI => ['title' => 'Wi-Fi', 'name' => 'wifi'],
        self::M_1G => ['title' => '1G', 'name' => '1g'],
        self::M_2G => ['title' => '2G', 'name' => '2g'],
        self::M_3G => ['title' => '3G', 'name' => '3g'],
        self::M_4G => ['title' => '4G', 'name' => '4g'],
        self::M_5G => ['title' => '5G', 'name' => '5g'],
    ];

    /**
     * 是否移动网络
     *
     * @param $type
     * @return bool
     */
    public static function isMobile($type)
    {
        return static::is1g($type)
               || static::is2g($type)
               || static::is3g($type)
               || static::is4g($type)
               || static::is5g($type);
    }
}
