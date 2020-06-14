<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Home_controller extends Controller
{
	protected $model;

    public function __construct(){
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
}

