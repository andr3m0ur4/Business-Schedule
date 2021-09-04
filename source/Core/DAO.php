<?php

namespace Source\Core;

use Source\Support\Message;

abstract class DAO
{
    protected ?object $data;
    protected ?\PDOException $fail;
    protected \PDO $db;
    protected Message $message;

    public function __construct()
    {
        $this->db = Connect::getConnection();
        $this->message = new Message();
        $this->fail = null;
    }

    public function __set($name, $value)
    {
        if (empty($this->data)) {
            $this->data = new \stdClass();
        }

        $this->data->$name = $value;
    }

    public function __isset($name)
    {
        return isset($this->data->$name);
    }

    public function __get($name)
    {
        return $this->data->$name ?? null;
    }

    public function data() : ?object
    {
        return $this->data;
    }

    public function fail() : ?\PDOException
    {
        return $this->fail;
    }
    
    public function message() : ?Message
    {
        return $this->message;
    }
    
    protected function create(string $entity, array $data) : ?int
    {
        try {
            $collumns = implode(', ', array_keys($data));
            $values = ':' . implode(', :', array_keys($data));

            $sql = "INSERT INTO {$entity} ({$collumns}) VALUES ({$values})";
            $stmt = $this->db->prepare($sql);
            $stmt->execute($this->filter($data));

            return $this->db->lastInsertId();
        } catch (\PDOException $ex) {
            $this->fail = $ex;
            return null;
        }
    }

    protected function read(string $select, string $params = null) : ?\PDOStatement
    {
        try {
            $stmt = $this->db->prepare($select);

            if ($params) {
                parse_str($params, $params);

                foreach ((array) $params as $key => $value) {
                    if ($key == 'limit' || $key == 'offset') {
                        $stmt->bindValue(":{$key}", $value, \PDO::PARAM_INT);
                    } else {
                        $stmt->bindValue(":{$key}", $value, \PDO::PARAM_STR);
                    }
                }
            }

            $stmt->execute();
            return $stmt;
        } catch (\PDOException $ex) {
            $this->fail = $ex;
            return null;
        }
    }

    protected function update(string $entity, array $data, string $terms, string $params) : ?int
    {
        try {
            $dataSet = [];

            foreach ($data as $bind => $value) {
                $dataSet[] = "{$bind} = :{$bind}";
            }

            $dataSet = implode(', ', $dataSet);
            parse_str($params, $params);

            $sql = "UPDATE {$entity} SET {$dataSet} WHERE {$terms}";
            $stmt = $this->db->prepare($sql);
            $stmt->execute($this->filter(array_merge($data, $params)));
            return $stmt->rowCount() ?? 1;
        } catch (\PDOException $ex) {
            $this->fail = $ex;
            return null;
        }
    }

    protected function delete(string $entity, string $terms, string $params) : ?int
    {
        try {
            $sql = "DELETE FROM {$entity} WHERE {$terms}";
            $stmt = $this->db->prepare($sql);
            parse_str($params, $params);
            $stmt->execute($params);
            return $stmt->rowCount() ?? 1;
        } catch (\PDOException $ex) {
            $this->fail = $ex;
            return null;
        }
    }

    private function filter(array $data) : array
    {
        $filter = [];

        foreach ($data as $key => $value) {
            $filter[$key] = is_null($value) ? null : filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
        }

        return $filter;
    }
}
