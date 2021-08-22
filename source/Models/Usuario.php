<?php

namespace Source\Models;

use Source\Core\Model;

class Usuario extends Model
{
    public function nome($nome = null)
    {
        if (is_null($nome)) {
            return $this->nome;
        }

        $this->nome = $nome;
        return $this;
    }

    public function idade($idade = null)
    {
        if (is_null($idade)) {
            return $this->idade;
        }

        $this->idade = $idade;
        return $this;
    }
}
