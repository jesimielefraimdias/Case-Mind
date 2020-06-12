<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Informacoes_usuarios_model;

class Informacoes_usuarios_controller extends Controller
{
	protected $model;

    public function __construct(){
		session_start();
		$this->model = new Informacoes_usuarios_model();
    }

    public function permissao()
	{
		if(isset($_SESSION["grau_acesso"]) && $_SESSION["grau_acesso"] == "A"){
			return true;
		}
		return false;
	}

	public function index()
	{
		if(!$this->permissao()){
			return view("erro.php");
		}

        return view("informacoes_usuarios.php");
	}

	public function get_usuarios(){
		$retorno = $this->model->get_usuarios($_SESSION["id_usuario"]);
		//echo json_encode($_GET);

		echo json_encode($retorno);
	}

	public function ativarordesativar(){
		if($_SESSION["grau_acesso"] != "A"){
			return view("erro.php");
		}
		$this->model->ativarordesativar($_GET["id_usuario"]);
		echo json_encode($_GET);
	}
}