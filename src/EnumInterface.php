<?php

namespace HughCube\Enum;

interface EnumInterface
{
    public static function title($value);

    public static function name($value);

    public static function isDefault($value);

    public static function getDefault();

    public static function all($onlyCanSelect = true);

    public static function has($value);

    public static function isCanSelect($type);
}
