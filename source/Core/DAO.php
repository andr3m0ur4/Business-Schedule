<?php

namespace Source\Core;

use Source\Support\Message;

abstract class DAO
{
    protected ?object $data;
    protected ?\PDOException $fail;
    protected \PDO $db;
    protected Message $message;
    protected string $query;
    protected array $params;
    protected string $order;
    protected string $limit;
    protected string $offset;
    protected static string $entity;

    public function __construct(string $entity)
    {
        self::$entity = $entity;
        $this->db = Connect::getConnection();
        $this->message = new Message();
        $this->fail = null;
        $this->params = [];
        $this->order = '';
        $this->limit = '';
        $this->offset = '';
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

    public function find(?string $terms = null, ?string $params = null, string $collumns = '*')
    {
        if ($terms) {
            $this->query = "SELECT {$collumns} FROM " . static::$entity . " WHERE {$terms}";
            parse_str($params, $this->params);
            return $this;
        }

        $this->query = "SELECT {$collumns} FROM " . static::$entity;
        return $this;
    }

    public function order(?string $collumnOrder)
    {
        $this->order = " ORDER BY {$collumnOrder}";
        return $this;
    }

    public function limit(int $limit)
    {
        $this->limit = " LIMIT {$limit}";
        return $this;
    }

    public function offset(int $offset)
    {
        $this->offset = " OFFSET {$offset}";
        return $this;
    }

    public function fetch(bool $all = false)
    {
        try {
            $stmt = $this->db->prepare($this->query . $this->order . $this->limit . $this->offset);
            $stmt->execute($this->params);

            if (!$stmt->rowCount()) {
                return null;
            }

            if ($all) {
                return $stmt->fetchAll(\PDO::FETCH_OBJ);
            }

            return $stmt->fetchObject();
        } catch (\PDOException $ex) {
            $this->fail = $ex;
            return null;
        }
    }

    public function count($collumn, $params) : int
    {
        $count = 'COUNT(*)';
        $table =  static::$entity;
        $sql = "SELECT {$count} AS counter FROM {$table} WHERE {$collumn} like '%{$params}%'";
        $result = $this->db->query($sql);
        $row = $result->fetch(\PDO::FETCH_OBJ);
        return intval($row->counter);
    }
    
    protected function create(array $data) : ?int
    {
        try {
            $collumns = implode(', ', array_keys($data));
            $values = ':' . implode(', :', array_keys($data));

            $sql = "INSERT INTO " . static::$entity . " ({$collumns}) VALUES ({$values})";
            $stmt = $this->db->prepare($sql);
            $stmt->execute($this->filter($data));

            return $this->db->lastInsertId();
        } catch (\PDOException $ex) {
            $this->fail = $ex;
            return null;
        }
    }

    protected function update(array $data, string $terms, string $params) : ?int
    {
        try {
            $dataSet = [];

            foreach ($data as $bind => $value) {
                $dataSet[] = "{$bind} = :{$bind}";
            }
            
            $dataSet = implode(', ', $dataSet);
            parse_str($params, $params);

            $sql = "UPDATE " . static::$entity . " SET {$dataSet} WHERE {$terms}";
            $stmt = $this->db->prepare($sql);
            $stmt->execute($this->filter(array_merge($data, $params)));
            return $stmt->rowCount() ?? 1;
        } catch (\PDOException $ex) {
            $this->fail = $ex;
            return null;
        }
    }

    public function delete(string $key, string $value) : bool
    {
        try {
            $sql = "DELETE FROM " . static::$entity . " WHERE {$key} = :key";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':key', $value, \PDO::PARAM_STR);
            $stmt->execute();
            return true;
        } catch (\PDOException $ex) {
            $this->fail = $ex;
            return false;
        }
    }

    public function getLastId() : int
    {
        try {
            $sql = "SELECT max(id) AS last FROM " . static::$entity;
            $result = $this->db->query($sql);
            $row = $result->fetch(\PDO::FETCH_OBJ);
            return intval($row->last);
        } catch (\PDOException $ex) {
            $this->fail = $ex;
            return -1;
        }
    }

    private function filter(array $data) : array
    {
        $filter = [];

        foreach ($data as $key => $value) {
            $filter[$key] = is_null($value) ? null : filter_var($value, FILTER_DEFAULT);
        }

        return $filter;
    }
}
