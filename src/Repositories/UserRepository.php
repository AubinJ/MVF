<?php

namespace Repositories;

use PDO;
use Models\DbConnexion;

use Models\User;


final class UserRepository
{
    private $pdo;
    public function __construct(DbConnexion $dbConnexion)
    {
        $this->pdo = $dbConnexion->getPDO();
    }


    public function login(string $email, string $password)
    {
        $hash = hash("whirlpool", $password);


        try {
            $stmt = $this->pdo->query("SELECT * FROM mvf_user WHERE Email = '$email' AND Mdp = '$hash' ");
        } catch (\PDOException $e) {
            var_dump($e);
        }
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $user = new User($row);
        }

        if (isset($user)) {
            $_SESSION["id"] = $user->getId();
            return "connected";
        } else {
            return "not connected";
        }
    }

    public function register(User $user)
    {

        // On peut appliquer la fonction filterValidateEmail 
        // si on souhaite vérifier que l'email existe déja , il faut faire une requête en ce sens 



        // On a besoin de hasher le mdp , j'utilise donc la fonction hash de php 
        // qui attend en paramètre un nom d'algorithme de hashage, ici j'utilise whirlpool , qui est assez sécurisé,
        // mais on pourait aussi utiliser SHA256, ou une bibliothèque de hashage spécialisée comme BCRYPT ou Argon2, ou d'autres...
        // Le premier paramètre de cette fonction native de php est l'algo de hashage à utiliser, le deuxième, la chaine de caractères 
        // à hasher
        // php connaît deja whirlpool
        $password = hash("whirlpool", $user->getPassword());

        try {
            // Je peux préparer ma requête 
            // ATTENTION à avoir le BON nombre de champs , conformément à la table concernée
            $stmt = $this->pdo->prepare("INSERT INTO mvf_user VALUES(NULL, ?, ?, ?, ?)");
            // ICI , je dois faire ATTENTION à passer les éléments dans le même ordre que dans ma table USER
            $stmt->execute([$user->getNom(), $user->getPrenom(), $user->getMail(), $user->getTel(), $user->getAdresse(), $password]);



            // Si la requête a fonctionnée, et qu'une ligne en bdd a été modifiée 
            // Alors ca renvoi le chiffre 1 
            return  "Inserted";
        } catch (\PDOException $e) {
            // SI il y a eu une erreur dans la requête SQL , 
            // alors on retourne l'erreur au fichier de traitement.php
            return "Error";
        }
    }


    public function checkUserExist(User $user)
    {
        $email = $user->getMail();

        try {
            $stmt = $this->pdo->query("SELECT * FROM mvf_user WHERE Email = '$email' ");
        } catch (\PDOException $e) {
            return $e;
        }
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $user = new User($row);
        }

        return $stmt->rowCount() == 1;
    }



    // public function __construct()
    // {
    //     $database = new DbConnexion;
    //     $this->DB = $database->getDB();

    //     require_once __DIR__ . '/../../config.php';
    // }


    // private function CreerNouvelId()
    // {
    //     $Database = new DbConnexion("User");

    //     $utilisateurs = $Database->getAllUtilisateurs();


    //     $IDs = [];

    //     foreach ($utilisateurs as $utilisateur) {
    //         $IDs[] = $utilisateur->getId();
    //     }


    //     $i = 1;
    //     $unique = false;
    //     while ($unique === false) {
    //         if (in_array($i, $IDs)) {
    //             $i++;
    //         } else {
    //             $unique = true;
    //         }
    //     }
    //     return $i;
    // }

    // public function getObjectToArray(): array
    // {
    //     return [
    //         "id" => $this->getId(),
    //         "nom" => $this->getNom(),
    //         "prenom" => $this->getPrenom(),
    //         "mail" => $this->getMail(),
    //         "tel" => $this->getTel(),
    //         "adresse" => $this->getAdresse(),
    //         "password" => $this->getPassword()

    //     ];
    // }
}
