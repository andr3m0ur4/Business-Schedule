<?php

namespace Source\Models;

use Source\Core\DAO;

class EmployeeTvShowHourDAO extends DAO
{
    public function __construct()
    {
        parent::__construct('employee_tv_show_hours');
    }

    public function findById(int $id, string $collumns = '*') : ?EmployeeTvShowHour
    {
        $find = $this->find('id = :id', "id={$id}", $collumns);

        $EmployeeTvShowHour = $find->fetch();

        if ($this->fail() || !$EmployeeTvShowHour) {
            $this->message->warning('não encontrada o código informado');
            return null;
        }

        return new EmployeeTvShowHour($EmployeeTvShowHour->id, $EmployeeTvShowHour->id_employee_hours, $EmployeeTvShowHour->id_tv_show_hours);
    }

    public function all() : array
    {
        $all = parent::fetch(true);

        if ($this->fail() || !$all) {
            $this->message->warning('Sua consulta não retornou nada');
            return [];
        }

        $EmployeeTvShowHours = [];

        foreach ($all as $EmployeeTvShowHour) {
            $EmployeeTvShowHours[] = new EmployeeTvShowHour($EmployeeTvShowHour->id, $EmployeeTvShowHour->id_employee_hours, $EmployeeTvShowHour->id_tv_show_hours);
        }

        return $EmployeeTvShowHours;
    }

    public function save(EmployeeTvShowHour $EmployeeTvShowHour) : bool
    {
        if (!$EmployeeTvShowHour->required()) {
            $this->message->warning('Campos obrigatórios não preenchidos');
            return false;
        }

        // Schedule Update
        if (!empty($EmployeeTvShowHour->getId())) {
            $EmployeeTvShowHourId = $EmployeeTvShowHour->getId();

            $this->update($EmployeeTvShowHour->safe(), 'id = :id', "id={$EmployeeTvShowHourId}");

            if ($this->fail()) {
                $this->message->error('Erro ao atualizar, verifique os dados');
                return false;
            }
        }
        
        // schedule Create
        if (empty($EmployeeTvShowHour->getId())) {
            $EmployeeTvShowHourId = $this->create($EmployeeTvShowHour->safe());
            
            if ($this->fail()) {
                $this->message->error('Erro ao cadastrar, verifique os dados');
                return false;
            }
        }

        $this->message->success('Dados salvos com sucesso');
        $this->data = $this->findById($EmployeeTvShowHourId);
        return true;
    }

    public function destroy(int $id) : bool
    {
        if (!empty($id)) {
            $this->delete('id', $id);
        }

        if ($this->fail()) {
            $this->message->warning('Não foi possível remover a escala.');
            return false;
        }

        $this->message->success('Escala removida com sucesso');
        return true;
    }
}
