<?php

namespace src\Repositories;

use Models\place;
use src\Models\Film;
use PDO;
use src\Models\Database;

class PlaceRepository
{
    private $DB;

    public function __construct()
    {
        $database = new Database;
        $this->DB = $database->getDB();

        require_once __DIR__ . '/../../config.php';
    }

    // Exemple d'une requête avec query :
    // il n'y a pas de risques, car aucun paramètre venant de l'extérieur n'est demandé dans le sql.
    public function getAllPlace()
    {
        $sql = $this->concatenationRequete("");

        return $this->DB->query($sql)->fetchAll(PDO::FETCH_CLASS, Place::class);
    }


    /**
     * Exemple d'une requête préparée, avec prepare, bindParam et execute :
     * - prepare : permet d'écrire la requête sql, en remplaçant les nom des variables par :variable.
     * Il est aussi possible de mettre un '?', mais c'est moins lisible, surtout quand on a beaucoup de paramètres à passer.
     * - bindParam : permet d'associer un :variable avec la vraie variable.
     * - execute : permet d'exécuter le sql complet.
     *
     * L'id est un paramètre donné par le code, il y a un risque d'altération de la donnée.
     * Pour éviter des injections on prépare (on désamorce) la requête.
     */

    public function getThisPlaceById($id): Place
    {
        $sql = $this->concatenationRequete("WHERE " . PREFIXE . "Place.ID = :id");

        $statement = $this->DB->prepare($sql);
        $statement->bindParam(':id', $id);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_CLASS, Place::class);
        return $statement->fetch();
    }

    // /**
    //  * Un autre exemple d'une requête préparée, avec prepare et execute :
    //  * Cette fois-ci on donne les paramètres tout de suite lors du execute, sous forme d'un tableau associatif.
    //  */
    // public function getThoseFilmsByClassificationAge($Id_Classification): array
    // {
    //     $sql = $this->concatenationRequete("WHERE " . PREFIXE . "films.ID_CLASSIFICATION_AGE_PUBLIC = :Id_Classification");

    //     $statement = $this->DB->prepare($sql);

    //     $statement->execute([':Id_Classification' => $Id_Classification]);

    //     return $statement->fetchAll(PDO::FETCH_CLASS, Film::class);
    // }


    // Construire la méthode getThoseFilmsByName() Et oui, parce qu'on peut avoir plusieurs films avec le même nom !
    public function getThoseNomPlace($NOM): array
    {
        $sql = $this->concatenationRequete("WHERE   films.NOM LIKE :NOM");

        $statement = $this->DB->prepare($sql);

        $statement->execute([':NOM' => "%" . $NOM . "%"]);

        return $statement->fetchAll(PDO::FETCH_CLASS, Place::class);
    }

    /**
     * Permet de créer un nouveau film. Retourne l'objet film avec son Id fraîchement créé par la BDD.
     *
     * @param Place $Place
     * @return Place
     */
    public function CreateThisFilm(Place $place): Place
    {
        $sql = "INSERT INTO Place (Nom_place, Tarif_place, Date_place, Tarif_Reduit) VALUES (:Nom_place, :Tarif_place, :Date_place, :Tarif_Reduit);";

        $statement = $this->DB->prepare($sql);

        $statement->execute([
            ':Nom_place' => $place->getNomPlace(),
            ':Tarif_place' => $place->getTarifPlace(),
            ':Date_place' => $place->getDatePlace(),
            ':Tarif_Reduit' => $place->getTarifReduit(),

        ]);

        $id = $this->DB->lastInsertId();
        $place->setIdPlace($id);

        return $place;
    }

    // Construire la méthode updateThisFilm()
    public function updateThisFilm(Place $place): bool
    {
        $sql = "UPDATE Place
SET Nom_place = :Nom_place,
Tarif_place = :Tarif_place,
Date_place = :Date_place,
Tarif_Reduit = :Tarif_Reduit,

WHERE ID = :id;";

        $statement = $this->DB->prepare($sql);

        $success = $statement->execute([
            ':id' => $place->getIdPlace(),
            ':nom' => $place->getNomPlace()(),
            ':url_affiche' => $place->getTarifPlace(),
            ':lien_trailer' => $place->getDatePlace(),
            ':resume' => $place->getTarifReduit(),


        ]);

        return $success;
    }

    // Construire la méthode deleteThisFilm()
    public function deleteThisFilm($Id): bool
    {
        $sql = "DELETE FROM mvf_contenir WHERE Id_Place = :Id;
DELETE FROM projections WHERE Id_Place = :Id;
DELETE FROM place WHERE ID = :Id";

        $statement = $this->DB->prepare($sql);

        return $statement->execute([':Id' => $Id]);
    }

    public function addId_reservation(Place $place): bool
    {
        if ($place->getIdReservation() !== []) {
            $sql = "INSERT INTO mvf_contenir (Id_Place, Id_reservation) VALUES (:Id_Place, :Id_reservation)";
            for ($i = 1; $i < sizeof($place->getIdReservation()); $i++) {
                $sql .= ", (:getIdReservation$i, :id_place)";
            }
            $sql .= ";";
            $statement = $this->DB->prepare($sql);
            $variables = [":id_place" => $place->getIdPlace()];

            for ($i = 0; $i < sizeof($place->getIdReservation()); $i++) {
                $variables[":IdReservation$i"] = $place->getIdReservation()[$i];
            }

            return $statement->execute($variables);
        } else {
            return true;
        }
    }

    public function removeId_reservation(Place $place): bool
    {
        $sql = "DELETE FROM mvf_contenir WHERE ID_Place = :id_place";
        $statement = $this->DB->prepare($sql);
        return $statement->execute([":id_place" => $place->getIdPlace()]);
    }

    private function concatenationRequete(string $requete): string
    {
        $sql = "SELECT mvf_place.Id_place,
         mvf_place.NOM,
        mvf_place.Nom_place,
        mvf_place.Tarif_place,
        mvf_place.Date_place,
        mvf_place.Tarif_Reduit,
        
        mvf_place.ID_CLASSIFICATION_AGE_PUBLIC AS ID_CLASSIFICATION,
        GROUP_CONCAT(categories.NOM) AS NOMS_CATEGORIES,
        GROUP_CONCAT(categories.ID) AS ID_CATEGORIES,
        classification_age_public.INTITULE as NOM_CLASSIFICATION
        FROM mvf_place
        LEFT JOIN mvf_contenir ON place.Id_place = mvf_contenir.Id_place
        LEFT JOIN mvf_reservation ON mvf_contenir.Id_reservation = Id_reservation
        -- inner?
        ";
        $sql .= $requete;
        $sql .= " GROUP BY place.ID;";

        return $sql;
    }
}
