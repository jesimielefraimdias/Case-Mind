<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Login_controller extends BaseController
{
    protected $login_model;

    public function __construct()
    {
        $this->login_model =new Login_model();
    }

    public function Index()
    {
        return view("index");
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

        if (!filter_var($_POST["emailorcpf"], FILTER_VALIDATE_EMAIL) && !$this->valida_cpf($_POST["emailorcpf"])) {
            $erro_emailorcpf = "Digite um email/cpf válido";
            $erro = "s";
        }

        if (empty($_POST["senha"])) {
            $erro_senha = "Campo da senha vázio";
            $erro = "s";
        }

        return ["erro" => $erro, "erro_emailorcpf" => $erro_emailorcpf, "erro_senha" => $erro_senha];
    }

    public function login()
    {
        $retorno = $this->validar_dados();

        echo json_encode($retorno);
    }
}
