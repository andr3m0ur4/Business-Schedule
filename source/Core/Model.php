<?php

namespace Source\Core;

abstract class Model
{
    private static array $required;
    private static array $safe;

    public function __construct()
    {
    }

    public function safe() : ?array
    {
        $data = get_object_vars($this);

        foreach (static::$safe as $unset) {
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
