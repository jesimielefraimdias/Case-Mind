<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Home_model;

class Home_controller extends Controller
{
	protected $model;

	public function __construct()
	{
		$this->model = new Home_model();
		session_start();
	}

	public function permissao()
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
		return view("home.php");
	}

	public function sair()
	{
		if (!$this->permissao()) {
			return view("erro.php");
		}

		session_destroy();
	}

	public function get_usuario()
	{
		if (!$this->permissao()) {
			return view("erro.php");
		}
		if (!isset($_SESSION["id_usuario"])) return view("erro.php");


		if (($retorno = $this->model->get_usuario($_SESSION["id_usuario"])) == null) {
			return view("erro.php");
		}

		echo json_encode($retorno);
	}

	public function unset_usuario_comum()
	{
		if (isset($_SESSION["id_usuario_comum"])) {
			unset($_SESSION["id_usuario_comum"]);
		}
	}

	public function imagem_usuario()
	{

		$caminho_img = $_SERVER["DOCUMENT_ROOT"] . "\\..\\assets_server\\img_usuarios\\" . "imagem_".$_SESSION["id_usuario"];
		$img_png = $caminho_img.".png";
		$img_jpeg = $caminho_img.".jpeg";
		
		if (file_exists($img_png)) {
			echo base64_encode(file_get_contents($img_png));
		} else if (file_exists($img_jpeg)) {
			echo base64_encode(file_get_contents($img_jpeg));
		}
	}
}
