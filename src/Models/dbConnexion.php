<?php

namespace  Models;

class DbConnexion
{
    private $host   = "localhost";
    private $login  = "mvf";
    private $pass   = "mvf";
    private $bdd    = "mvf";
    private $pdo;

    function __construct()
    {
        try {
            $this->pdo = new \PDO("mysql:host={$this->host};dbname={$this->bdd};charset=utf8", $this->login, $this->pass);
        } catch (\PDOException $e) {
            die("Service indisponible");
        }
    }

    public function getPDO()
    {
        return $this->pdo;
    }
}
