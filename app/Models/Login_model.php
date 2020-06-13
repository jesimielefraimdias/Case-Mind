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

        $builder = $this->db->table("usuario")->where($data);
        if($builder->countAllResults() == 1){
            $query = $builder->get();
            return $query->getRow();
        }

        return null;
    }

    public function get_usuario_email($email)
    {
        $data = [
            "email" => $email
        ];

        $builder = $this->db->table("usuario")->where($data);
        if($builder->countAllResults() == 1){
            $query = $builder->get();
            return $query->getRow();
        }

        return null;    
    }
}
