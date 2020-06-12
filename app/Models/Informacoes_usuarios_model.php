<?php

namespace App\Models;

use CodeIgniter\Model;

class Informacoes_usuarios_model extends Model
{

    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function get_usuarios($id)
    {

        $builder = $this->db->table("usuario");
        $builder->select("id_usuario, nome, cpf, email, grau_acesso");
        $builder->where("id_usuario !=", $id);
        $query = $builder->get();

        return $query->getResult();
    }

    public function ativarordesativar($id){
        $builder = $this->db->table("usuario");
        $builder->select("grau_acesso");
        $builder->where("id_usuario", $id);
        $query = $builder->get();
        $objt = $query->getResult()[0];


        if($objt->grau_acesso == "I"){
            $this->ativar($id);
        } else {
            $this->desativar($id);
        }  
    }

    protected function ativar($id){

        $builder = $this->db->table("usuario");
        $builder->set("grau_acesso", "U");
        $builder->where("id_usuario", $id);
        $builder->update();
    }

    protected function desativar($id){

        $builder = $this->db->table("usuario");
        $builder->set("grau_acesso", "I");
        $builder->where("id_usuario", $id);
        $builder->update();
    }
}

?>
