<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Erro_controller extends Controller
{
	public function __construct()
	{
		session_start();
	}

	public function index()
	{
		return view("erro.php");
	}

	public function permissao_usuario()
	{
		if (isset($_SESSION["grau_acesso"]) && $_SESSION["grau_acesso"] != "I") {
			echo json_encode(["acesso" => true]);
			return;
		}
		echo json_encode(["acesso" => false]);
	
	}

	public function permissao_admin()
	{
		if (isset($_SESSION["grau_acesso"]) && $_SESSION["grau_acesso"] == "A") {
			echo json_encode(["acesso" => true]);
			return;
		}
		echo json_encode(["acesso" => false]);
	}
}
