<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Inscricao_model;

class Inscricao_controller extends Controller
{

    protected $model;

    public function __construct()
    {
        $this->model = new Inscricao_model();
    }
    public function Index()
    {
        return view("inscricao");
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

    public function validar_dados()
    {

        //Deve ter uma maiscula, minuscula, números e um caracter especial.
        $uppercase = preg_match('@[A-Z]@', $_POST["senha"]);
        $lowercase = preg_match('@[a-z]@', $_POST["senha"]);
        $number    = preg_match('@[0-9]@', $_POST["senha"]);
        $specialChars = preg_match('@[^\w]@', $_POST["senha"]);

        $erro = "n";
        $erro_nome = $erro_cpf = $erro_email = $erro_senha = "";

        
        if (!preg_match("/^[a-zA-Z ]*$/", $_POST["nome"]) || empty($_POST["nome"])) {
            $erro_nome = "Digite um nome válido!";
            $erro = "s";
        }

        if (!$this->valida_cpf($_POST["cpf"])) {
            $erro_cpf = "Digite um cpf válido!";
            $erro = "s";
        } else if ($this->model->get_usuario_cpf(preg_replace('/[^0-9]/is', '', $_POST["cpf"])) != null) {
            $erro_cpf = "Cpf já cadastrado!";
            $erro = "s";
        }

        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $erro_email = "Digite um email válido!";
            $erro = "s";
        } else if ($this->model->get_usuario_email($_POST["email"]) != null) {
            $erro_email = "Email já cadastrado!";
            $erro = "s";
        }

        if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($_POST["senha"]) < 8) {
            $erro_senha = "";
            if (!$uppercase) {
                if (strlen($erro_senha) == 0) $erro_senha = "Precisa ter pelo menos uma: maiúscula";
                else $erro_senha .= ", maiúscula";
            }
            if (!$lowercase) {
                if (strlen($erro_senha) == 0) $erro_senha = "Precisa ter pelo menos uma: minúscula";
                else $erro_senha .= ", minúscula";
            }
            if (!$number) {
                if (strlen($erro_senha) == 0) $erro_senha = "Precisa ter pelo menos um: número";
                else $erro_senha .= ", número";
            }
            if (!$specialChars) {
                if (strlen($erro_senha) == 0) $erro_senha = "Precisa ter pelo menos um: caracter especial";
                else $erro_senha .= ", caracter especial";
            }
            if (strlen($_POST["senha"]) < 8) {
                if (strlen($erro_senha) == 0) $erro_senha = "Precisa ter pelo menos um: 8 caracteres";
                else $erro_senha .= ", 8 caracteres";
            }

            $erro = "s";
        }

        return ["erro" => $erro, "erro_nome" => $erro_nome, "erro_cpf" => $erro_cpf, "erro_email" => $erro_email, "erro_senha" => $erro_senha];
    }

    public function valida_imagem(){

        if(!isset($_FILES["imagem_perfil"])){
            return false;
        }

        $imagem_perfil = $_FILES["imagem_perfil"];
        $tipo = explode("/",$imagem_perfil["type"]);
        
        if($imagem_perfil["size"] > 500000){
            return ["erro" => "s", "erro_imagem" => "A imagem é muito grande!"];
        }

        if($tipo[1] != "png" && $tipo[1] != "jpeg"){
            return ["erro" => "s", "erro_imagem" => "Tipo não válido!"];    
        }

        return ["erro" => "n", "erro_imagem" => ""];
    }

    public function cadastro()
    {

//        echo json_encode($_FILES);
    
        $retorno = $this->validar_dados();
        $retorno1 = $this->valida_imagem();

        if ($retorno["erro"] == 's' || $retorno1["erro"] == "s") {
            echo json_encode($retorno);
            return;
        }

        $nome = $_POST["nome"];
        $cpf = preg_replace('/[^0-9]/is', '', $_POST["cpf"]);
        $email = $_POST["email"];
        $senha = password_hash($_POST["senha"], PASSWORD_DEFAULT);
        $imagem_perfil = $_FILES["imagem_perfil"];
        $this->model->inserir($nome, $cpf, $email, $senha, $imagem_perfil);

        echo json_encode($retorno);
    }
}
?>