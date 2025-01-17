<?php

namespace App\Models;

use CodeIgniter\Model;

class Login_model extends Model
{

    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function get_usuario_cpf($cpf)
    {
        $data = [
            "cpf" => $cpf
        ];
        $query = $this->db->table("usuario")->getWhere($data);
        $retorno = $query->getResult();

        if (count($retorno) == 0) {
            return null;
        }

        return $retorno[0];
    }

    public function get_usuario_email($email)
    {
        $data = [
            "email" => $email
        ];

        $query = $this->db->table("usuario")->getWhere($data);
        $retorno = $query->getResult();

        if (count($retorno) == 0) {
            return null;
        }

        return $retorno[0];
    }
}
