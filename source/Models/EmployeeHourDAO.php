<?php

namespace Source\Models;

use Source\Core\DAO;

class EmployeeHourDAO extends DAO
{
    public function __construct()
    {
        parent::__construct('employee_hours');
    }

    public function findById(int $id, string $collumns = '*') : ?EmployeeHour
    {
        $find = $this->find('id = :id', "id={$id}", $collumns);

        $employeeHour = $find->fetch();

        if ($this->fail() || !$employeeHour) {
            $this->message->warning('Horário não encontrado para o código informado');
            return null;
        }

        return new EmployeeHour(
            $employeeHour->id,
            $employeeHour->start_time,
            $employeeHour->final_time,
            $employeeHour->date,
            $employeeHour->id_employee,
            $employeeHour->id_schedule
        );
    }

    public function all() : array
    {
        $all = parent::fetch(true);

        if ($this->fail() || !$all) {
            $this->message->warning('Sua consulta não retornou horários de funcionários');
            return [];
        }

        $employeeHours = [];

        foreach ($all as $employeeHour) {
            $employeeHours[] = new EmployeeHour(
                $employeeHour->id,
                $employeeHour->start_time,
                $employeeHour->final_time,
                $employeeHour->date,
                $employeeHour->id_employee,
                $employeeHour->id_schedule
            );
        }

        return $employeeHours;
    }

    public function save(EmployeeHour $employeeHour) : bool
    {
        if (!$employeeHour->required()) {
            $this->message->warning('Horário inicial, horário final e data são obrigatórios');
            return false;
        }

        // Employee Hour Update
        if (!empty($employeeHour->getId())) {
            $employeeHourId = $employeeHour->getId();

            $this->update($employeeHour->safe(), 'id = :id', "id={$employeeHourId}");

            if ($this->fail()) {
                $this->message->error('Erro ao atualizar, verifique os dados');
                return false;
            }
        }
        
        // Employee Hour Create
        if (empty($employeeHour->getId())) {
            $employeeHourId = $this->create($employeeHour->safe());
            
            if ($this->fail()) {
                $this->message->error('Erro ao cadastrar, verifique os dados');
                return false;
            }
        }

        $this->message->success('Dados salvos com sucesso');
        $this->data = $this->findById($employeeHourId);
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
