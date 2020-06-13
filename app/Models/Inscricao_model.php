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

    public function inserir($nome, $cpf, $email, $senha, $imagem_perfil)
    {


        $data = [
            "nome" => $nome,
            "cpf" => $cpf,
            "email" => $email,
            "senha" => $senha
        ];

        $this->db->table("usuario")->insert($data);
        
        if(!$this->db->table("usuario")->insert($data)){
            return false;
        }

        $retorno = $this->get_usuario_cpf($cpf);

        $tipo = explode("/",$imagem_perfil["type"]);
        $target = $_SERVER["DOCUMENT_ROOT"]."\\..\\assets\\img_usuarios\\"."imagem_".$retorno[0]->id_usuario.".".$tipo[1];

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

        return $query->getResult();//($query->num_rows() > 0) ? $query->getResult() : null;
    }

    public function get_usuario_email($email)
    {
        $data = [
            "email" => $email
        ];

        $query = $this->db->table("usuario")->getWhere($data);

        return $query->getResult();//($query->num_rows() > 0) ? $query->getResultArray() : null;
    }
}

?>
