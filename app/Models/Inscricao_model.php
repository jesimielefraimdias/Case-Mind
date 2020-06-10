<?php

namespace App\Models;

use CodeIgniter\Model;

class Inscricao_model extends Model
{

    private $db;

    public function __construct(){
        $this->db = \Config\Database::connect();
    }

    public function inserir($nome, $email, $senha){
        
        $data = [
            "nome" => $nome,
            "email" => $email,
            "senha" => $senha
        ];
//        $db = \Config\Database::connect();
 
        $this->db->table("usuario")->insert($data);
    }
}
