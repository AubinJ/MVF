<?php


namespace src\Controllers;

use Repositories\NuitManager;

class NuitController
{
    private $nuitManager;

    public function __construct(NuitManager $nuitManager)
    {
        $this->nuitManager = $nuitManager;
    }

    public function index()
    {

        $nuits = $this->nuitManager->getAllNuit();

        return $nuits;
    }

    public function show($id)
    {
        // Get nuit by ID
        $nuit = $this->nuitManager->getNuitById($id);


        return $nuit;
    }
}
