<?php

namespace HughCube\Enum;

use BadMethodCallException;

trait EnumTrait
{
    /**
     * @return array
     */
    public static function labels()
    {
        return [];
    }

    /**
     * 获取value对应的title
     *
     * @param string $value
     * @return null|string
     */
    public static function title($value)
    {
        return static::getAttribute($value, 'title', $value);
    }

    /**
     * 获取value对应的name
     *
     * @param string $value
     * @return null|string
     */
    public static function name($value)
    {
        return static::getAttribute($value, 'name', $value);
    }

    /**
     * 获取默认的值
     *
     * @return string|null
     */
    public static function getDefault()
    {
        $labels = static::labels();

        foreach ($labels as $value => $item) {
            if (static::isDefault($value)) {
                return static::normalize($value);
            }
        }

        return null;
    }

    /**
     * 当前值是否选中使用的, 一般用作默认值
     *
     * @param string $type
     * @return bool
     */
    public static function isCanSelect($type): bool
    {
        return false !== static::getAttribute($type, 'can_select');
    }

    /**
     * 当前值是否默认的
     *
     * @param string $type
     * @return bool
     */
    public static function isDefault($type): bool
    {
        return true === static::getAttribute($type, 'is_default');
    }

    /**
     * 是否有这个类型
     *
     * @param string $type
     * @return bool
     */
    public static function has($type): bool
    {
        if (!in_array(gettype($type), ['boolean', 'integer', 'double', 'float', 'string', 'NULL'])) {
            return false;
        }

        $labels = static::labels();

        return isset($labels[$type]) && is_array($labels[$type]);
    }

    /**
     * 获取所有的类型
     *
     * @return array
     */
    public static function all($onlyCanSelect = true): array
    {
        $types = [];

        $labels = static::labels();
        foreach ($labels as $type => $item) {
            if (!$onlyCanSelect || static::isCanSelect($type)) {
                $types[] = static::normalize($type);
            }
        }

        return $types;
    }

    /**
     * 魔术方法
     *
     * @param  string  $name
     * @param  array  $arguments
     * @return bool
     * @throws BadMethodCallException
     */
    public static function __callStatic(string $name, array $arguments)
    {
        if ('is' === strtolower(substr($name, 0, 2))) {
            return static::is(substr($name, 2), $arguments[0]);
        }

        throw new BadMethodCallException("No such method exists: {$name}");
    }

    /**
     * 检测某个名字对应的值
     */
    protected static function is($name, $type): bool
    {
        $labels = static::labels();
        foreach ($labels as $key => $label) {
            if (isset($label['name']) && strtolower($name) === strtolower($label['name'])) {
                return static::isEqual($key, $type);
            }
        }

        return false;
    }

    /**
     * 比较两个type是否相等
     */
    protected static function isEqual($a, $b): bool
    {
        $a = static::normalize($a);

        return null !== $a && $a === static::normalize($b);
    }

    /**
     * 格式化值, 如果type不存在返回null
     * @return null|string
     */
    protected static function normalize($type)
    {
        return static::has($type) ? ((string)$type) : null;
    }

    /**
     * 获取指定值对应的信息
     */
    public static function getAttribute($type, $name, $default = null)
    {
        $labels = static::labels();

        if (isset($labels[$type], $labels[$type][$name])) {
            return $labels[$type][$name];
        }

        return $default;
    }
}
