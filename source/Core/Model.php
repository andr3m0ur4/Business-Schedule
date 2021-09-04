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
        foreach (static::$safe as $unset) {
            unset($this->$unset);
        }

        return get_object_vars($this);
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
