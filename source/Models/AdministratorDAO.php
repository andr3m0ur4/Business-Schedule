<?php

namespace Source\Models;

use Source\Core\DAO;

class AdministratorDAO extends DAO
{
    public function __construct()
    {
        parent::__construct('administrators');
    }

    public function findById(int $id, string $collumns = '*') : ?Administrator
    {
        $find = $this->find('id = :id', "id={$id}", $collumns);

        $administrator = $find->fetch();

        if ($this->fail() || !$administrator) {
            $this->message->warning('Administrador não encontrado para o código informado');
            return null;
        }

        return new Administrator($administrator->id, $administrator->name, $administrator->email, $administrator->password, $administrator->phone);
    }

    public function findByEmail(string $email, string $collumns = '*') : ?Administrator
    {
        $find = $this->find('email = :email', "email={$email}", $collumns);

        $administrator = $find->fetch();

        if ($this->fail() || !$administrator) {
            $this->message->warning('Administrador não encontrado para o email informado');
            return null;
        }

        return new Administrator($administrator->id, $administrator->name, $administrator->email, $administrator->password, $administrator->phone);
    }

    public function login(string $email, string $password) : bool
    {
        if ($administrator = $this->findByEmail($email)) {
            if (password_verify($password, $administrator->getPassword())) {
                session()->set('idUser', $administrator->getId());
                session()->set('level', 2);
                redirect('/');
            }
        }
        
        $this->message->error('E-mail e ou senha estão incorretos');
        return false;
    }

    public function findByName(string $name, string $collumns = '*') : ?AdministratorDAO
    {
        return $this->find('name LIKE :name', "name=%{$name}%", $collumns);
    }

    public function all() : array
    {
        $all = parent::fetch(true);

        if ($this->fail() || !$all) {
            $this->message->warning('Sua consulta não retornou administradores');
            return [];
        }

        $administrators = [];

        foreach ($all as $administrator) {
            $administrators[] = new Administrator(
                $administrator->id,
                $administrator->name,
                $administrator->email,
                $administrator->password,
                $administrator->phone
            );
        }

        return $administrators;
    }

    public function save(Administrator $administrator) : bool
    {
        if (!$administrator->required()) {
            $this->message->warning('Nome, e-mail e senha são obrigatórios');
            return false;
        }
        
        if (!is_email($administrator->getEmail())) {
            $this->message->warning('O e-mail informado não tem um formato válido');
            return false;
        }

        if (!is_password($administrator->getPassword())) {
            $this->message->warning(
                'A senha deve ter entre ' . CONF_PASSWORD_MIN_LEN . ' e ' . CONF_PASSWORD_MAX_LEN . ' caracteres'
            );
            return false;
        }

        $administrator->setPassword(password_hash($administrator->getPassword(), PASSWORD_DEFAULT));

        // Administrator Update
        if (!empty($administrator->getId())) {
            $adminId = $administrator->getId();
            
            if ($this->find('email = :email AND id != :id', "email={$administrator->getEmail()}&id={$adminId}", 'id')->fetch()) {
                $this->message->warning('O e-mail informado já está cadastrado');
                return false;
            }

            $this->update($administrator->safe(), 'id = :id', "id={$adminId}");
            
            if ($this->fail()) {
                $this->message->error('Erro ao atualizar, verifique os dados');
                return false;
            }
        }
        
        // Administrator Create
        if (empty($administrator->getId())) {
            if ($this->findByEmail($administrator->getEmail())) {
                $this->message->warning('O e-mail informado já está cadastrado');
                return false;
            }
            
            $adminId = $this->create($administrator->safe());
            
            if ($this->fail()) {
                $this->message->error('Erro ao cadastrar, verifique os dados');
                return false;
            }
        }

        $this->message->success('Dados salvos com sucesso');
        $this->data = $this->findById($adminId);
        return true;
    }

    public function destroy(int $id) : bool
    {
        if (!empty($id)) {
            $this->delete('id', $id);
        }

        if ($this->fail()) {
            $this->message->warning('Não foi possível remover o administrador.');
            return false;
        }

        $this->message->success('Administrador removido com sucesso');
        return true;
    }
}
