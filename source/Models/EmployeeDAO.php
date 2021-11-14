<?php

namespace Source\Models;

use Source\Core\DAO;

class EmployeeDAO extends DAO
{
    public function __construct()
    {
        parent::__construct('employees');
    }

    public function findById(int $id, string $collumns = '*') : ?Employee
    {
        $find = $this->find('id = :id', "id={$id}", $collumns);

        $employee = $find->fetch();

        if ($this->fail() || !$employee) {
            $this->message->warning('Funcionário não encontrado para o código informado');
            return null;
        }

        return new Employee($employee->id, $employee->name, $employee->email, $employee->password, $employee->phone, $employee->job, $employee->description);
    }

    public function findByEmail(string $email, string $collumns = '*') : ?Employee
    {
        $find = $this->find('email = :email', "email={$email}", $collumns);

        $employee = $find->fetch();

        if ($this->fail() || !$employee) {
            $this->message->warning('Funcionário não encontrado para o email informado');
            return null;
        }

        return new Employee($employee->id, $employee->name, $employee->email, $employee->password, $employee->phone, $employee->job, $employee->description);
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

    public function findByName(string $name, string $collumns = '*') : ?EmployeeDAO
    {
        return $this->find('name LIKE :name', "name=%{$name}%", $collumns);
    }

    public function all() : array
    {
        $all = parent::fetch(true);

        if ($this->fail() || !$all) {
            $this->message->warning('Sua consulta não retornou funcionários');
            return [];
        }

        $employees = [];

        foreach ($all as $employee) {
            $employees[] = new Employee(
                $employee->id,
                $employee->name,
                $employee->email,
                $employee->password,
                $employee->phone,
                $employee->job,
                $employee->description
            );
        }

        return $employees;
    }

    // Save employee
    public function save(Employee $employee) : bool
    {
        if (!$employee->required()) {
            $this->message->warning('Nome, e-mail e senha são obrigatórios');
            return false;
        }
        
        if (!is_email($employee->getEmail())) {
            $this->message->warning('O e-mail informado não tem um formato válido');
            return false;
        }

        if (!is_password($employee->getPassword())) {
            $this->message->warning(
                'A senha deve ter entre ' . CONF_PASSWORD_MIN_LEN . ' e ' . CONF_PASSWORD_MAX_LEN . ' caracteres'
            );
            return false;
        }

        $employee->setPassword(password_hash($employee->getPassword(), PASSWORD_DEFAULT));
        
        // Employee Update
        if (!empty($employee->getId())) {
            $employeeId = $employee->getId();
            
            if ($this->find('email = :email AND id != :id', "email={$employee->getEmail()}&id={$employeeId}")->fetch()) {
                $this->message->warning('O e-mail informado já está cadastrado');
                return false;
            }

            $this->update($employee->safe(), 'id = :id', "id={$employeeId}");

            if ($this->fail()) {
                $this->message->error('Erro ao atualizar, verifique os dados');
                return false;
            }
        }

        // Employee Create
        if (empty($employee->getId())) {
            if ($this->findByEmail($employee->getEmail())) {
                $this->message->warning('O e-mail informado já está cadastrado');
                return false;
            }
            
            $employeeId = $this->create($employee->safe());
            
            if ($this->fail()) {
                $this->message->error('Erro ao cadastrar, verifique os dados');
                return false;
            }
        }

        $this->message->success('Dados salvos com sucesso');
        $this->data = $this->findById($employeeId);
        return true;
    }

    public function destroy(int $id) : bool
    {
        if (!empty($id)) {
            $this->delete('id', $id);
        }

        if ($this->fail()) {
            $this->message->warning('Não foi possível remover o funcionário.');
            return false;
        }

        $this->message->success('Funcionário removido com sucesso');
        return true;
    }
}
