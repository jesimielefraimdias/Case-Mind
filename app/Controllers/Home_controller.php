<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Home_model;

class Home_controller extends Controller
{
	protected $model;
	public function __construct(){
		
		session_start();
		$this->model = new Home_model();
		
	}

	public function permissao()
	{
		if(isset($_SESSION["grau_acesso"]) && $_SESSION["grau_acesso"] != "I"){
			return true;
		}

		return false;
	}

	public function index()
	{
		if(!$this->permissao()){
			return view("erro.php");
		}

		return view("home.php");	
	}

	public function sair()
	{
		if(!$this->permissao()){
			return view("erro.php");
		}
		
		session_destroy();
	}

	public function dados_usuario(){
		if(!$this->permissao()){
			return view("erro.php");
		}
		$retorno = $this->model->get_usuario_id($_SESSION["id_usuario"]);

		if($retorno == null){
			return view("erro.php");
		}


		echo json_encode(["cpf" => $retorno[0]->cpf, "email" => $retorno[0]->email, "nome" => $retorno[0]->nome, "grau_acesso" => $retorno[0]->grau_acesso]);
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

    public function validar_dados($id)
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
        } else if (($retorno = $this->model->get_usuario_cpf(preg_replace('/[^0-9]/is', '', $_POST["cpf"]))) != null) {
			if($retorno[0]->id_usuario != $id){
				$erro_cpf = "Cpf já cadastrado!";
				$erro = "s";
			}
        }

        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $erro_email = "Digite um email válido!";
            $erro = "s";
        } else if (($retorno = $this->model->get_usuario_email($_POST["email"])) != null) {
			if($retorno[0]->id_usuario != $id){
				$erro_email = "Email já cadastrado!";
            	$erro = "s";
			}
		}
		
		if(!empty($_POST["senha"])){
			if (!$uppercase || !$lowercase || !$number || !$specialChars || (strlen($_POST["senha"]) < 8)) {
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
		}

        return ["erro" => $erro, "erro_nome" => $erro_nome, "erro_cpf" => $erro_cpf, "erro_email" => $erro_email, "erro_senha" => $erro_senha];
    }

    public function alterar($id = null)
    {
		if($id && $_SESSION["grau_acesso"] != "A"){
			return view("erro.php");
		} else if($id && $_SESSION["grau_acesso"] == "A"){
			$retorno = $this->validar_dados($id);
		} else if(!$id && $_SESSION["grau_acesso"] == "U" || !$id && $_SESSION["grau_acesso"] == "A"){
			$id = $_SESSION["id_usuario"];
			$retorno = $this->validar_dados($id);
		}
        
        if ($retorno["erro"] == 's') {
            echo json_encode($retorno);
            return;
        }

		$nome = $_POST["nome"];
		$cpf = preg_replace('/[^0-9]/is', '', $_POST["cpf"]);
		$email = $_POST["email"];
		$senha = $_POST["senha"];

		//$this->model->alterar($id, $nome, $cpf, $email);

		
		if(!empty($senha)){
			$senha = password_hash($_POST["senha"], PASSWORD_DEFAULT);
			$this->model->alterar($id, $nome, $cpf, $email, $senha);
		} else {
			$this->model->alterar($id, $nome, $cpf, $email);

		}
		
        echo json_encode($retorno);
    }

	//--------------------------------------------------------------------
}
