<?php

namespace App\Models;

use CodeIgniter\Model;

class Inscricao_model extends Model
{

    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function inserir($nome, $cpf, $email, $senha)
    {
        $data = [
            "nome" => $nome,
            "cpf" => $cpf,
            "email" => $email,
            "senha" => $senha
        ];
        
        if(!$this->db->table("usuario")->insert($data)){
            return null;
        }

        return $this->get_usuario_cpf($cpf);
    }

    public function inserir_imagem($id_usuario, $imagem_perfil)
    {
        
        $tipo = explode("/",$imagem_perfil["type"]);
        $target = $_SERVER["DOCUMENT_ROOT"]."\\..\\assets_server\\img_usuarios\\"."imagem_".$id_usuario.".".$tipo[1];

        if(!move_uploaded_file($imagem_perfil["tmp_name"], $target)){
            return false;
        }
        return true;
    }

    public function get_usuario_cpf($cpf)
    {
        $data = [
            "cpf" => $cpf
        ];
        $query = $this->db->table("usuario")->getWhere($data);
        $retorno = $query->getResult();
        
        if(count($retorno) == 0){
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
        
        if(count($retorno) == 0){
            return null;
        }

        return $retorno[0];

    }
}
