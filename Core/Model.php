<?php

    namespace Core;
    
    class Model
    {
        protected $db;

        public function __construct()
        {
            global $config;

            try {
                $db = new \PDO(
                    "mysql:dbname={$config['dbname']};host={$config['host']};charset=utf8",
                    $config['dbuser'],
                    $config['dbpass']
                );
                $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            } catch (\PDOException $e) {
                die("ERRO: {$e->getMessage()}");
            }
            
            $this->db = $db;
        }
    }
    