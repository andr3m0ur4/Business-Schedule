<?php

namespace Source\Core;

abstract class DAO
{
    protected \PDO $db;

    public function __construct()
    {
        $this->db = Connect::getConnection();
    }
}
