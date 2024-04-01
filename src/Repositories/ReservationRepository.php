<?php

namespace src\Repositories;

use PDO;
use PDOException;
use src\Models\Reservation;



class ReservationRepository
{
    private $DB;

    public function __construct()
    {
        $database = new Database();
        $this->DB = $database->getDB();
        require_once __DIR__ . '/../../config.php';
    }

    public function CreeReservation(Reservation $Reservation)
    {
        $sql = "INSERT INTO `mvf_reservation` VALUES (NULL, ?, ?, ?, ?);";
        $statement = $this->DB->prepare($sql);
        $retour = $statement->execute(
            [
                $Reservation->getNombreReservation(),
                $Reservation->isEnfantReservation(),
                $Reservation->getLugeReservation(),
                $Reservation->getCasqueReservation(),
                $Reservation->getIdUser()

            ]
        );
        return $retour;
    }
    public function getAllResarvation()
    {
        $sql = "SELECT * FROM  mvf_reservation;";
        $statement = $this->DB->prepare($sql);
        $statement->execute();
        $retour = $statement->fetchAll(PDO::FETCH_CLASS, Reservation::class);
        return $retour;
    }


    public function getThisReservationById(int $id): Reservation
    {
        $sql = "SELECT * FROM mvf_user WHERE Id_reservation = :id;";
        $statement = $this->DB->prepare($sql);
        $statement->execute([
            ":id" => $id
        ]);
        $statement->setFetchMode(PDO::FETCH_CLASS, Reservation::class);
        $retour = $statement->fetch();
        return $retour;
    }

    public function getAllResavationByUserId(int $id)
    {
        $sql = "SELECT * FROM mvf_reservation WHERE id_user = :id;";
        $statement = $this->DB->prepare($sql);
        $statement->execute([
            ":id" => $id
        ]);
        $retour = $statement->fetchAll(PDO::FETCH_CLASS, Reservation::class);
        return $retour;
    }

    public function updateThisResavation(Reservation $reservation)
    {
        $sql = "UPDATE mvf_reservation 
                    SET
                        Nombre_reservation = :NbResrvation,
                    	Enfant_reservation = :Enfants,
                        Luge_reservation = :Luge,
                        Casque_reservation	=:Casque,
                        Id_User	= :IdUser;";

        $statement = $this->DB->prepare($sql);

        $statement = $this->DB->prepare($sql);
        $retour = $statement->execute([

            ":NbResrvation" => $reservation->getNombreReservation(),
            ":Enfants" => $reservation->isEnfantReservation(),
            ":Luge" => $reservation->getLugeReservation(),
            ":Casque" => $reservation->getCasqueReservation(),
            ":IdUser" => $reservation->getIdUser(),




        ]);
        return $retour;
    }

    public function deleteThisReservation(int $id)
    {
        try {
            $sql = "DELETE FORM FROM  mvf_contenir WHERE Id_reservation	= :id;
                    DELETE FORM FROM  mvf_avoir WHERE Id_reservation= :id;
                    DELETE FORM FROM  mvf_reservation WHERE Id_reservation	= :id;";
            $statement = $this->DB->prepare($sql);
            $retour = $statement->execute([
                ":id" => $id
            ]);
        } catch (PDOException $error) {
            echo "Erreur de suppression : " . $error->getMessage();
            return FALSE;
        }
    }
}
