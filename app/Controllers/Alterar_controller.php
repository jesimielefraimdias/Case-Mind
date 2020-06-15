<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Alterar_model;

class Alterar_controller extends Controller
{
	private $model;
	private $msg;

	public function __construct()
	{

		$this->msg = [
			"erro" => false, "erro_nome" => "", "erro_cpf" => "",
			"erro_email" => "", "erro_senha" => "", "erro_imagem" => "",
			"erro_alterar" => "", "erro_upload" => false
		];

		$this->model = new Alterar_model();

		session_start();
	}

	public function setar_id()
	{
		if (isset($_GET["id_usuario_comum"])) {
			$_SESSION["id_usuario_comum"] = $_GET["id_usuario_comum"];
		}
	}

	private function permissao()
	{
		if (isset($_SESSION["grau_acesso"]) && $_SESSION["grau_acesso"] != "I") {
			return true;
		}
		return false;
	}

	public function index()
	{
		if (!$this->permissao()) {
			return view("erro.php");
		}

		return view("alterar.php");
	}

	public function voltar()
	{
		if ($this->permissao() && isset($_SESSION["id_usuario_comum"])) {
			unset($_SESSION["id_usuario_comum"]);
		}
	}

	public function dados_usuario()
	{

		if (!$this->permissao()) {
			return view("erro.php");
		}

		$id_usuario = $_SESSION["id_usuario"];

		if (isset($_SESSION["id_usuario_comum"])) {
			$id_usuario = $_SESSION["id_usuario_comum"];
		}

		$retorno = $this->model->get_usuario_id($id_usuario);

		if ($retorno == null) {
			return view("erro.php");
		}
		echo json_encode($retorno);
	}

	private function valida_cpf($cpf)
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

	private function validar_dados($id)
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
		} else if (($retorno = $this->model->get_usuario_cpf(preg_replace('/[^0-9]/is', '', $_POST["cpf"]))) != null) {
			if ($retorno->id_usuario != $id) {
				$this->msg["erro_cpf"] = "Cpf já cadastrado!";
				$this->msg["erro"] = true;
			}
		}

		if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
			$this->msg["erro_email"] = "Digite um email válido!";
			$this->msg["erro"] = true;
		} else if (($retorno = $this->model->get_usuario_email($_POST["email"])) != null) {
			if ($retorno->id_usuario != $id) {
				$this->msg["erro_email"] = "Email já cadastrado!";
				$this->msg["erro"] = true;
			}
		}

		if (!empty($_POST["senha"])) {
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
					if (strlen($this->msg["erro_senha"]) == 0) $erro_senha = "Precisa ter pelo menos: 8 caracteres";
					else $this->msg["erro_senha"] .= ", 8 caracteres";
				}

				$this->msg["erro"] = true;
			}
		}
	}

	private function valida_imagem()
	{

		if (!isset($_FILES) || !isset($_FILES["imagem_perfil"])) {
			$this->msg["erro_imagem"] = "Selecione uma imagem!";
			$this->msg["erro"] = true;
			return;
		}

		$imagem_perfil = $_FILES["imagem_perfil"];
		$tipo = explode("/", $imagem_perfil["type"]);

		if ($imagem_perfil["size"] > 500000) {
			$this->msg["erro_imagem"] = "A imagem é muito grande";
			$this->msg["erro"] = true;
			return;
		}

		if ($tipo[1] != "png" && $tipo[1] != "jpeg") {
			$this->msg["erro_imagem"] = "Tipo inválido";
			$this->msg["erro"] = true;
			return;
		}
	}

	public function alterar()
	{
		if (!$this->permissao()) {
			return view("erro.php");
		}

		if ($_SESSION["grau_acesso"] == "I") {
			return view("erro.php");
		} else if ($_SESSION["grau_acesso"] == "A" && isset($_SESSION["id_usuario_comum"])) {
			$id = $_SESSION["id_usuario_comum"];
		} else if ($_SESSION["grau_acesso"] == "U" || $_SESSION["grau_acesso"] == "A" && !isset($_SESSION["id_usuario_comum"])) {
			$id = $_SESSION["id_usuario"];
		}
		$this->validar_dados($id);

		if (isset($_FILES) && isset($_FILES["imagem_perfil"])) {
			$imagem_perfil = $_FILES["imagem_perfil"];
			$this->valida_imagem();
		}

		if ($this->msg["erro"]) {
			echo json_encode($this->msg);
			return;
		}

		$nome = $_POST["nome"];
		$cpf = preg_replace('/[^0-9]/is', '', $_POST["cpf"]);
		$email = $_POST["email"];
		$senha = $_POST["senha"];

		if (empty($senha)) $senha = null;
		else $senha = password_hash($senha, PASSWORD_DEFAULT);

		if ($this->model->alterar($id, $nome, $cpf, $email, $senha)) {
			if (isset($imagem_perfil) && !$this->model->inserir_imagem($id, $imagem_perfil)) {
				$this->msg["erro_upload"] = true;
			}
		} else {
			$this->erro_msg["erro_alterar"] = "Erro ao alterar usuário, tente mais tarde!";
			$this->msg["erro"] = true;
		}

		echo json_encode($this->msg);
	}

	public function imagem_usuario()
	{
		$caminho_img = $_SERVER["DOCUMENT_ROOT"] . "\\..\\assets_server\\img_usuarios\\" . "imagem_" . $_SESSION["id_usuario"];
		$img_png = $caminho_img . ".png";
		$img_jpeg = $caminho_img . ".jpeg";

		if (file_exists($img_png)) {
			echo base64_encode(file_get_contents($img_png));
		} else if (file_exists($img_jpeg)) {
			echo base64_encode(file_get_contents($img_jpeg));
		}
	}

	//--------------------------------------------------------------------
}
