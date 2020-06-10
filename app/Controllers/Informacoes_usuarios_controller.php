<?php

namespace App\Controllers;

use CodeIgniter\Controller;


class Informacoes_usuarios_controller extends Controller
{
    public function Index()
    {
        return view("informacoes_usuarios");
    }
}