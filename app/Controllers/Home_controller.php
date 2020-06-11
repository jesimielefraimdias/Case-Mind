<?php 
namespace App\Controllers;
use CodeIgniter\Controller;

class Home_controller extends Controller
{
	public function index()
	{
		session_start();

		if(isset($_SESSION["grau_acesso"]) && $_SESSION["grau_acesso"] != "I"){
			return view('home.php');
		}
		
	}

	//--------------------------------------------------------------------

}
