<?php

namespace Source\Core;

class Connect
{
    private const OPTIONS = [
        \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
        \PDO::ATTR_CASE => \PDO::CASE_NATURAL
    ];

    private static \PDO $db;
    
    public static function getConnection() : ?\PDO
    {
        if (empty(self::$db)) {
            try {
                self::$db = new \PDO(
                    'mysql:host=' . CONF_DB_HOST . ';dbname=' . CONF_DB_NAME,
                    CONF_DB_USER,
                    CONF_DB_PASS,
                    self::OPTIONS
                );
            } catch (\PDOException $ex) {
                die("Erro: {$ex->getMessage()}");
                // redirect('/ops/problemas');
            }
        }

        return self::$db;
    }

    // final private function __construct()
    // {}

    // final private function __clone()
    // {}
}
