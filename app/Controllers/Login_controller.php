<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Login_model;

class Login_controller extends Controller
{
    protected $model;

    public function __construct()
    {
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
        $erro = "n";
        $erro_emailorcpf = $erro_senha = "";

        if (!filter_var($_POST["emailorcpf"], FILTER_VALIDATE_EMAIL) && !$this->valida_cpf($_POST["emailorcpf"])) {
            $erro_emailorcpf = "Digite um email/cpf válido";
            $erro = "s";
        }

        if (empty($_POST["senha"])) {
            $erro_senha = "Campo da senha está vázio!";
            $erro = "s";
        }

        return ["erro" => $erro, "erro_emailorcpf" => $erro_emailorcpf, "erro_senha" => $erro_senha, "erro_login" => ""];
    }

    public function login()
    {

        $retorno = $this->validar_dados();

        if ($retorno["erro"] == "s") {
            echo json_encode($retorno);
            return;
        }

        if (($dados = $this->model->get_usuario_cpf(preg_replace('/[^0-9]/is', '', $_POST["emailorcpf"]))) == null) {
            if (($dados = $this->model->get_usuario_email($_POST["emailorcpf"])) == null) {
                $retorno["erro_login"] = "Verifique os dados digitados!";
                $retorno["erro"] = "s";
                echo json_encode($retorno);
                return;
            }
        }

        if (!password_verify($_POST["senha"], $dados[0]->senha)) {
            $retorno["erro_login"] = "Senha incorreta!";
            $retorno["erro"] = "s";
            echo json_encode($retorno);
            return;
        } else if($dados[0]->grau_acesso == "I"){
            $retorno["erro_login"] = "Usuário inativo!";
            $retorno["erro"] = "s";
            echo json_encode($retorno);
            return;
        }

        echo json_encode($retorno);

        session_start();
        $_SESSION["id_usuario"] = $dados[0]->id_usuario;
        $_SESSION["grau_acesso"] = $dados[0]->grau_acesso;
    }
}

?>