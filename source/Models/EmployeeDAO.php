<?php

namespace Source\Models;

use Source\Core\DAO;
use Source\Support\Session;

class EmployeeDAO extends DAO
{
    protected static $entity = 'employees';

    public function find(string $terms, string $params, string $collumns = '*') : ?Employee
    {
        $find = $this->read("SELECT {$collumns} FROM " . self::$entity . " WHERE {$terms}", $params);

        if ($this->fail() || !$find->rowCount()) {
            $this->message->warning('Funcionário não encontrado para o código informado');
            return null;
        }

        $employee = $find->fetchObject();
        return new Employee($employee->id, $employee->name, $employee->email, $employee->password, $employee->phone, $employee->job);
    }

    public function findById(int $id, string $collumns = '*') : ?Employee
    {
        return $this->find("id = :id", "id={$id}", $collumns);
    }

    public function findByEmail(string $email, string $collumns = '*') : ?Employee
    {
        return $this->find("email = :email", "email={$email}", $collumns);
    }

    public function login(string $email, string $password) : bool
    {
        if ($employee = $this->findByEmail($email)) {
            if (password_verify($password, $employee->getPassword())) {
                session()->set('idUser', $employee->getId());
                redirect('/');
            }
        }
        
        $this->message->error('E-mail e ou senha estão incorretos');
        return false;
    }

    public function all(int $limit = 30, int $offset = 0, string $collumns = '*') : ?array
    {
        $all = $this->read(
            "SELECT {$collumns} FROM " . self::$entity . " LIMIT :limit OFFSET :offset",
            "limit={$limit}&offset={$offset}"
        );

        if ($this->fail() || !$all->rowCount()) {
            $this->message->warning('Sua consulta não retornou funcionários');
            return null;
        }

        $employees = [];

        foreach ($all->fetchAll(\PDO::FETCH_OBJ) as $employee) {
            $employees[] = new Employee($employee->id, $employee->name, $employee->email, $employee->password, $employee->job);
        }

        return $employees;
    }

    // Save employee

    public function save(Employee $employee) : ?Employee
    {
        if (!$employee->required()) {
            $this->message->warning('Nome, e-mail e senha são obrigatórios');
            return null;
        }
        
        if (!is_email($employee->getEmail())) {
            $this->message->warning('O e-mail informado não tem um formato válido');
            return null;
        }

        if (!is_password($employee->getPassword())) {
            $this->message->warning(
                'A senha deve ter entre ' . CONF_PASSWORD_MIN_LEN . ' e ' . CONF_PASSWORD_MAX_LEN . ' caracteres'
            );
            return null;
        }

        $employee->setPassword(password_hash($employee->getPassword(), PASSWORD_DEFAULT));
        
        // Employee Update
        if (!empty($employee->getId())) {
            $employeeId = $employee->getId();
            
            if ($this->find('email = :email AND id != :id', "email={$employee->getEmail()}&id={$employeeId}")) {
                $this->message->warning('O e-mail informado já está cadastrado');
                return null;
            }

            $this->update(self::$entity, $employee->safe(), 'id = :id', "id={$employeeId}");

            if ($this->fail()) {
                $this->message->error('Erro ao atualizar, verifique os dados');
                return null;
            }
        }

        // Employee Create
        if (empty($employee->getId())) {
            if ($this->findByEmail($employee->getEmail())) {
                $this->message->warning('O e-mail informado já está cadastrado');
                return null;
            }
            
            $employeeId = $this->create(self::$entity, $employee->safe());
            
            if ($this->fail()) {
                $this->message->error('Erro ao cadastrar, verifique os dados');
                return null;
            }
        }

        return $this->findById($employeeId);
    }

    public function destroy(Employee $employee) : ?Employee
    {
        if (!empty($employee->getId())) {
            $this->delete(self::$entity, 'id = :id', "id={$employee->getId()}");
        }

        if ($this->fail()) {
            $this->message->warning('Não foi possível remover o funcionário.');
            return null;
        }

        $this->message->success('Funcionário removido com sucesso');
        $employee = null;
        return $employee;
    }

}
