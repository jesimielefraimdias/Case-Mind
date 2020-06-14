<?php

namespace App\Models;

use CodeIgniter\Model;

class Home_model extends Model
{

    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function get_usuario($id)
    {
        $data = [
            "id_usuario" => $id
        ];

        $builder = $this->db->table("usuario");
        $builder->select("nome, cpf, email, grau_acesso");
        $retorno = $builder->getWhere($data);
        $retorno = $retorno->getResult();

        if (count($retorno) == 0) {
            return null;
        }

        return $retorno[0];
    }
}
