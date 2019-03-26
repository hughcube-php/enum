<?php

namespace HughCube\Enum;

use BadMethodCallException;

trait EnumTrait
{
    /**
     * @var array
     */
    protected static $labels = [];

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
        foreach(static::$labels as $value => $item){
            if (static::isDefault($value)){
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
    public static function isCanSelect($type)
    {
        return false !== static::getAttribute($type, 'can_select');
    }

    /**
     * 当前值是否默认的
     *
     * @param string $type
     * @return bool
     */
    public static function isDefault($type)
    {
        return true === static::getAttribute($type, 'is_default');
    }

    /**
     * 是否有这个类型
     *
     * @param string $type
     * @return bool
     */
    public static function has($type)
    {
        return isset(static::$labels[$type]) && is_array(static::$labels[$type]);
    }

    /**
     * 获取对照表
     *
     * @return array
     */
    public static function getLabels()
    {
        return static::$labels;
    }

    /**
     * 获取所有的类型
     *
     * @return array
     */
    public static function all($onlyCanSelect = true)
    {
        $types = [];

        foreach(static::$labels as $type => $item){
            if (!$onlyCanSelect || static::isCanSelect($type)){
                $types[] = static::normalize($type);
            }
        }

        return $types;
    }

    /**
     * 魔术方法
     *
     * @param string $name
     * @param array $arguments
     * @return bool
     * @throws BadMethodCallException
     */
    public static function __callStatic($name, $arguments)
    {
        if ('is' === strtolower(substr($name, 0, 2))){
            return static::is(substr($name, 2), $arguments[0]);
        }

        throw new BadMethodCallException("No such method exists: {$name}");
    }

    /**
     * 检测某个名字对应的值
     *
     * @param string $name
     * @param string $type
     * @return bool
     */
    protected static function is($name, $type)
    {
        foreach(static::$labels as $key => $label){
            if (isset($label['name']) && strtolower($name) === strtolower($label['name'])){
                return static::isEqual($key, $type);
            }
        }

        return false;
    }

    /**
     * 比较两个type是否相等
     *
     * @param mixed $a
     * @param mixed $b
     * @return boolean
     */
    protected static function isEqual($a, $b)
    {
        $a = static::normalize($a);

        return null !== $a && $a === static::normalize($b);
    }

    /**
     * 格式化值, 如果type不存在返回null
     *
     * @param $type
     * @return null|string
     */
    protected static function normalize($type)
    {
        return static::has($type) ? ((string)$type) : null;
    }

    /**
     * 获取指定值对应的信息
     *
     * @param string $type
     * @param string $name 属性名
     * @param null $default
     * @return null|string
     */
    public static function getAttribute($type, $name, $default = null)
    {
        if (!static::has($type)){
            return $default;
        }

        return array_key_exists($name, static::$labels[$type]) ? static::$labels[$type][$name] : $default;
    }
}
