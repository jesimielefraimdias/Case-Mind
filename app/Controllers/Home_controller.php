<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Home_model;

class Home_controller extends Controller
{
	protected $model;

    public function __construct(){		
		$this->model = new Home_model();
		session_start();
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
		if (!$this->permissao()) {
			return view("erro.php");
		}

		session_destroy();
	}

	public function get_usuario(){
		if (!$this->permissao()) {
			return view("erro.php");
		}
		if(!isset($_SESSION["id_usuario"])) return view("erro.php");

		
		if(($retorno = $this->model->get_usuario($_SESSION["id_usuario"])) == null){
			return view("erro.php");
		}
	
		echo json_encode($retorno);
	}
}

