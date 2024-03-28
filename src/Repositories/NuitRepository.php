<?php

namespace Repositories;


use src\Models\Database;



class NuitManager
{
    private $pdo;

    public function __construct(DbConnexion $dbConnexion)
    {
        $this->pdo = $dbConnexion->getPDO();
    }

    public function getallNuit()
    {

        $nuitsArray = [];

        try {
            $stmt = $this->pdo->query("SELECT * FROM mvf_nuit");
        } catch (\PDOException $e) {
            var_dump($e);
        }
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $nuitsArray[] = $row;
        }

        return $nuitsArray;
    }



    public function getNuitById($id)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM mvf_nuit WHERE id_nuit  = :id");
            $stmt->execute([$id]);
            $nuit = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $nuit;
        } catch (\PDOException $e) {
            var_dump($e);
            return;
        }
    }

    public function getNameNuit($name)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM mvf_nuit WHERE Name_nuit = ''");
            $stmt->execute([$name]);
            $nuit = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $nuit;
        } catch (\PDOException $e) {
            var_dump($e);
            return;
        }
    }


       
    }


        
}
