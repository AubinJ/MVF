<?php

namespace src\Models;



class place
{
    private $Id_place;
    private $Nom_place;
    private $Tarif_place;
    private $Date_place;
    private $Tarif_Reduit;
    private $Id_reservation;


    use Services\Hydratation;







    /**
     * Get the value of Id_place
     */
    public function getIdPlace()
    {
        return $this->Id_place;
    }

    /**
     * Set the value of Id_place
     */
    public function setIdPlace($Id_place): self
    {
        $this->Id_place = $Id_place;

        return $this;
    }

    /**
     * Get the value of Nom_place
     */
    public function getNomPlace()
    {
        return $this->Nom_place;
    }

    /**
     * Set the value of Nom_place
     */
    public function setNomPlace($Nom_place): self
    {
        $this->Nom_place = $Nom_place;

        return $this;
    }

    /**
     * Get the value of Tarif_place
     */
    public function getTarifPlace()
    {
        return $this->Tarif_place;
    }

    /**
     * Set the value of Tarif_place
     */
    public function setTarifPlace($Tarif_place): self
    {
        $this->Tarif_place = $Tarif_place;

        return $this;
    }

    /**
     * Get the value of Date_place
     */
    public function getDatePlace()
    {
        return $this->Date_place;
    }

    /**
     * Set the value of Date_place
     */
    public function setDatePlace($Date_place): self
    {
        $this->Date_place = $Date_place;

        return $this;
    }

    /**
     * Get the value of Tarif_Reduit
     */
    public function getTarifReduit()
    {
        return $this->Tarif_Reduit;
    }

    /**
     * Set the value of Tarif_Reduit
     */
    public function setTarifReduit($Tarif_Reduit): self
    {
        $this->Tarif_Reduit = $Tarif_Reduit;

        return $this;
    }

    /**
     * Get the value of Id_reservation
     */
    public function getIdReservation()
    {
        return $this->Id_reservation;
    }

    /**
     * Set the value of Id_reservation
     */
    public function setIdReservation($Id_reservation): self
    {
        $this->Id_reservation = $Id_reservation;

        return $this;
    }
}
