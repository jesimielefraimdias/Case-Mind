<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Login_model;

class Login_controller extends Controller
{
    private $msg;
    protected $model;

    public function __construct()
    {
        $this->msg = ["erro" => ["erro" => false, "erro_emailorcpf" => null, "erro_senha" => null, "erro_login" => null], 
                    "data" => ["grau_acesso" => null]];
        $this->model = new Login_model();
    }

    public function Index()
    {
        return view("index.php");
    }

    public function valida_cpf($cpf)
    {

        // Extrai somente os números
        $cpf = preg_replace('/[^0-9]/is', '', $cpf);

        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
            return false;
        }

        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;
    }

    private function validar_dados()
    {
        if (!filter_var($_POST["emailorcpf"], FILTER_VALIDATE_EMAIL) && !$this->valida_cpf($_POST["emailorcpf"])) {
            $this->msg["erro"]["erro_emailorcpf"] = "Digite um email/cpf válido";
            $this->msg["erro"]["erro"] = true;
        }

        if (empty($_POST["senha"])) {
            $this->msg["erro"]["erro_senha"] = "Campo da senha está vázio!";
            $this->msg["erro"]["erro"] = true;
        }
    }

    public function login()
    {

        $this->validar_dados();

        if ($this->msg["erro"]["erro"] == true) {
            echo json_encode($this->msg);
            return;
        }
        
        
        if (($dados = $this->model->get_usuario_cpf(preg_replace('/[^0-9]/is', '', $_POST["emailorcpf"]))) == null) {
            if (($dados = $this->model->get_usuario_email($_POST["emailorcpf"])) == null) {
                $this->msg["erro"]["erro_login"] = "Verifique os dados digitados!";
                $retorno["erro"]["erro"] = true;
                echo json_encode($this->msg);
                return;
            }
        }

        if (!password_verify($_POST["senha"], $dados->senha)) {
            $this->msg["erro"]["erro_login"] = "Senha incorreta!";
            $this->msg["erro"]["erro"] = true;
            echo json_encode($this->msg);
            return;
        } else if($dados->grau_acesso == "I"){
            $this->msg["erro"]["erro_login"] = "Usuário inativo!";
            $this->msg["erro"]["erro"] = true;
            echo json_encode($this->msg);
            return;
        }

        session_start();
        $_SESSION["id_usuario"] = $dados->id_usuario;
        $_SESSION["grau_acesso"] = $dados->grau_acesso;

        $this->msg["data"]["grau_acesso"] = $dados->grau_acesso;
        echo json_encode($this->msg);
    }
}

?>