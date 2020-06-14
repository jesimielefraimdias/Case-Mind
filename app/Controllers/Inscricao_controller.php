<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Inscricao_model;

class Inscricao_controller extends Controller
{

    private $msg;
    protected $model;

    public function __construct()
    {
        $this->msg = ["erro" => false, "erro_nome" => "", "erro_cpf" => "", 
                    "erro_email" => "", "erro_senha" => "", "erro_imagem" => "",
                    "erro_inserir" => "","erro_upload" => false];
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

        
        if (!preg_match("/^[a-zA-Z ]*$/", $_POST["nome"]) || empty($_POST["nome"])) {
            $this->msg["erro_nome"] = "Digite um nome válido!";
            $this->msg["erro"] = true;
        }

        if (!$this->valida_cpf($_POST["cpf"])) {
            $this->msg["erro_cpf"] = "Digite um cpf válido!";
            $this->msg["erro"] = true;
        } else if ($this->model->get_usuario_cpf(preg_replace('/[^0-9]/is', '', $_POST["cpf"])) != null) {
            $this->msg["erro_cpf"] = "Cpf já cadastrado!";
            $this->msg["erro"] = true;
        }

        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $this->msg["erro_email"] = "Digite um email válido!";
            $this->msg["erro"] = true;
        }else if ($this->model->get_usuario_email($_POST["email"]) != null) {
            $this->msg["erro_email"] = "Email já cadastrado!";
            $this->msg["erro"] = true;
        }

        if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($_POST["senha"]) < 8) {
            
            $this->msg["erro_senha"] = "";
            if (!$uppercase) {
                if (strlen($this->msg["erro_senha"]) == 0) $this->msg["erro_senha"] = "Precisa ter pelo menos uma: maiúscula";
                else $this->msg["erro_senha"] .= ", maiúscula";
            }
            if (!$lowercase) {
                if (strlen($this->msg["erro_senha"]) == 0) $this->msg["erro_senha"] = "Precisa ter pelo menos uma: minúscula";
                else $this->msg["erro_senha"] .= ", minúscula";
            }
            if (!$number) {
                if (strlen($this->msg["erro_senha"]) == 0) $this->msg["erro_senha"] = "Precisa ter pelo menos um: número";
                else $this->msg["erro_senha"] .= ", número";
            }
            if (!$specialChars) {
                if (strlen($this->msg["erro_senha"]) == 0) $this->msg["erro_senha"] = "Precisa ter pelo menos um: caracter especial";
                else $this->msg["erro_senha"] .= ", caracter especial";
            }
            if (strlen($_POST["senha"]) < 8) {
                if (strlen($this->msg["erro_senha"]) == 0) $this->msg["erro_senha"] = "Precisa ter pelo menos: 8 caracteres";
                else $this->msg["erro_senha"] .= ", 8 caracteres";
            }

            $this->msg["erro"] = true;
        }
    }

    public function valida_imagem(){

        if(!isset($_FILES) || !isset($_FILES["imagem_perfil"])){
            $this->msg["erro_imagem"] = "Selecione uma imagem!";
            $this->msg["erro"] = true;
            return;
        }

        $imagem_perfil = $_FILES["imagem_perfil"];
        $tipo = explode("/", $imagem_perfil["type"]);
        
        if($imagem_perfil["size"] > 500000){
            $this->msg["erro_imagem"] = "A imagem é muito grande";
            $this->msg["erro"] = true;
            return;
        }

        if($tipo[1] != "png" && $tipo[1] != "jpeg"){
            $this->msg["erro_imagem"] = "Tipo inválido";
            $this->msg["erro"] = true;    
            return;
        }
    }

    public function cadastro()
    {

        $this->validar_dados();
        $this->valida_imagem();

        if ($this->msg["erro"] == true) {
            echo json_encode($this->msg);
            return;
        }
    
        $nome = $_POST["nome"];
        $cpf = preg_replace('/[^0-9]/is', '', $_POST["cpf"]);
        $email = $_POST["email"];
        $senha = password_hash($_POST["senha"], PASSWORD_DEFAULT);
        $imagem_perfil = $_FILES["imagem_perfil"];


        $retorno = $this->model->inserir($nome, $cpf, $email, $senha);
       
        if(($retorno) != null){
            if(!$this->model->inserir_imagem($retorno->id_usuario, $imagem_perfil)){
                $this->msg["erro_upload"] = true;
            }
        } else {
            $this->msg["erro_inserir"] = "Erro ao cadastrar usuário, tente mais tarde!";
            $this->msg["erro"] = true;
        }

        echo json_encode($this->msg);
    }
}
