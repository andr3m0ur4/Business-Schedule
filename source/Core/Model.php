<?php

namespace Source\Core;

abstract class Model
{
    protected static array $required;
    protected static array $protected;

    public function __construct(array $protected, array $required)
    {
        self::$protected = array_merge($protected, []);
        self::$required = $required;
    }

    public function safe() : ?array
    {
        $data = get_object_vars($this);
        foreach (static::$protected as $unset) {
            unset($data[$unset]);
        }

        return $data;
    }

    public function required() : bool
    {
        foreach (static::$required as $field) {
            if (empty($this->$field)) {
                return false;
            }
        }

        return true;
    }
}
