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

    public function alterar($id, $nome, $cpf, $email, $senha = null)
    {

        if($senha == null){
            $data = [
                "nome" => $nome,
                "cpf" => $cpf,
                "email" => $email
            ];
            
        } else {
            $data = [
                "nome" => $nome,
                "cpf" => $cpf,
                "email" => $email,
                "senha" => $senha
            ];
        }

        $builder = $this->db->table("usuario");
        $builder->set($data);
        $builder->where("id_usuario", $id);
        $builder->update();

        return true;
    }

    public function get_usuario_id($id)
    {
        $data = [
            "id_usuario" => $id
        ];

        $query = $this->db->table("usuario")->getWhere($data);

        return $query->getResult();
    }

    public function get_usuario_cpf($cpf)
    {
        $data = [
            "cpf" => $cpf
        ];

        $query = $this->db->table("usuario")->getWhere($data);

        return $query->getResult();
    }

    public function get_usuario_email($email)
    {
        $data = [
            "email" => $email
        ];

        $query = $this->db->table("usuario")->getWhere($data);

        return $query->getResult();
    }
}

?>
