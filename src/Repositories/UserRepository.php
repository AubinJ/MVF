<?php

namespace src\Repositories;

use PDO;
use Models\DbConnexion;

use Models\User;


final class UserRepository
{
    private $DB;

    public function __construct()
    {
        $database = new DbConnexion;
        $this->DB = $database->getDB();

        require_once __DIR__ . '/../../config.php';
    }


    private function CreerNouvelId()
    {
        $Database = new DbConnexion("User");

        $utilisateurs = $Database->getAllUtilisateurs();


        $IDs = [];

        foreach ($utilisateurs as $utilisateur) {
            $IDs[] = $utilisateur->getId();
        }


        $i = 1;
        $unique = false;
        while ($unique === false) {
            if (in_array($i, $IDs)) {
                $i++;
            } else {
                $unique = true;
            }
        }
        return $i;
    }

    public function getObjectToArray(): array
    {
        return [
            "id" => $this->getId(),
            "nom" => $this->getNom(),
            "prenom" => $this->getPrenom(),
            "mail" => $this->getMail(),
            "tel" => $this->getTel(),
            "adresse" => $this->getAdresse(),
            "password" => $this->getPassword()

        ];
    }
}
