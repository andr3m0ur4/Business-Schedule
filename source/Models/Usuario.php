<?php

    namespace Source\Models;

    use Source\Core\Model;

    class Usuario extends Model
    {
        public function getAll()
        {
            $array = [];

            $sql = "SELECT * FROM usuarios";
            $sql = $this->db->query($sql);

            if ($sql->rowCount() > 0) {
                $array = $sql->fetchAll(\PDO::FETCH_OBJ);
            }

            return $array;
        }
    }
    