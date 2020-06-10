<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Login_controller extends BaseController
{
    
    public function Index(){
        return view("index");
    }

    private function validar_dados()
    {
        $erro = "n";

        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $erro_email = "Digite um email válido";
            $erro = "s";
        }

        if(empty($_POST["senha"])){
            $erro_senha = "Campo da senha vázio";
            $erro = "s";
        }
        
        return ["erro" => $erro, "erro_email" => $erro_email, "erro_senha" => $erro_senha];
    }

    public function login(){
        $retorno = $this->validar_dados();
        
        echo json_encode($retorno);
    }
}
