<?php 
namespace App\Controllers;
use CodeIgniter\Controller;

class Home_controller extends Controller
{
	public function index()
	{
		return view('home.php');
	}

	//--------------------------------------------------------------------

}
