<?php

namespace src\Controllers;

use src\Services\Render;

class HomeController
{

    use Render;

    public function index()
    {
        $success = $_GET['success'] ?? null;
        $error  = $_GET['error'] ?? null;
        $this->render('home', ['error' => $error, 'success' => $success]);
    }

    public function dashboard()
    {
        $this->render('dashboard');
    }

    public function login()
    {
        $success = $_GET['success'] ?? null;
        $error  = $_GET['error'] ?? null;
        $this->render('login', ['error' => $error, 'success' => $success]);
    }

    public function notFound()
    {
        $this->render('404');
    }

    public function receipt()
    {
        $this->render('receipt');
    }
}
