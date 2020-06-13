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

        if(($query = $this->db->table("usuario")->getWhere($data)) != null){
            return $query->getResult()[0];
        }
        return null;
    }

    public function get_usuario_email($email)
    {
        $data = [
            "email" => $email
        ];

          if(($query = $this->db->table("usuario")->getWhere($data)) != null){
            $teste = $query->getResult()[0];
            return $teste;
        }
        return null;
    }
}
