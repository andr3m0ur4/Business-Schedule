<?php

namespace Source\Models;

use Source\Core\DAO;

class EmployeeTimeDAO extends DAO
{
    public function __construct()
    {
        parent::__construct('employees_times');
    }

    public function findById(int $id, string $collumns = '*') : ?EmployeeTime
    {
        $find = $this->find('id = :id', "id={$id}", $collumns);

        $employeeTime = $find->fetch();

        if ($this->fail() || !$employeeTime) {
            $this->message->warning('Horário não encontrado para o código informado');
            return null;
        }

        return new EmployeeTime(
            $employeeTime->id,
            $employeeTime->start_time,
            $employeeTime->final_time,
            $employeeTime->date,
            $employeeTime->week_day,
            $employeeTime->id_employee
        );
    }

    public function all() : array
    {
        $all = parent::fetch(true);

        if ($this->fail() || !$all) {
            $this->message->warning('Sua consulta não retornou horários de funcionários');
            return [];
        }

        $employeeTimes = [];

        foreach ($all as $employeeTime) {
            $employeeTimes[] = new EmployeeTime(
                $employeeTime->id,
                $employeeTime->start_time,
                $employeeTime->final_time,
                $employeeTime->date,
                $employeeTime->week_day,
                $employeeTime->id_employee
            );
        }

        return $employeeTimes;
    }

    public function save(EmployeeTime $employeeTime) : bool
    {
        if (!$employeeTime->required()) {
            $this->message->warning('Horário inicial, horário final e data são obrigatórios');
            return false;
        }

        // Employee Hour Update
        if (!empty($employeeTime->getId())) {
            $employeeTimeId = $employeeTime->getId();

            $this->update($employeeTime->safe(), 'id = :id', "id={$employeeTimeId}");

            if ($this->fail()) {
                $this->message->error('Erro ao atualizar, verifique os dados');
                return false;
            }
        }
        
        // Employee Hour Create
        if (empty($employeeTime->getId())) {
            $employeeTimeId = $this->create($employeeTime->safe());
            
            if ($this->fail()) {
                $this->message->error('Erro ao cadastrar, verifique os dados');
                return false;
            }
        }

        $this->message->success('Dados salvos com sucesso');
        $this->data = $this->findById($employeeTimeId);
        return true;
    }

    public function destroy(int $id) : bool
    {
        if (!empty($id)) {
            $this->delete('id', $id);
        }

        if ($this->fail()) {
            $this->message->warning('Não foi possível remover o horário do funcionário.');
            return false;
        }

        $this->message->success('Horário de funcionário removido com sucesso');
        return true;
    }
}
