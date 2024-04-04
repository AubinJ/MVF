<?php

namespace src\Models;

class Reservation
{

    private int $Id_reservation;
    private int $Nombre_reservation;
    private bool $Enfant_reservation;
    private int $Luge_reservation;
    private int $Casque_reservation;
    private int $Id_User;


    function __construct(array $datas = [])
    {
        foreach ($datas as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Get the value of Id_reservation
     */
    public function getIdReservation(): int
    {
        return $this->Id_reservation;
    }

    /**
     * Set the value of Id_reservation
     */
    public function setIdReservation(int $Id_reservation): self
    {
        $this->Id_reservation = $Id_reservation;

        return $this;
    }

    /**
     * Get the value of Nombre_reservation
     */
    public function getNombreReservation(): int
    {
        return $this->Nombre_reservation;
    }

    /**
     * Set the value of Nombre_reservation
     */
    public function setNombreReservation(int $Nombre_reservation): self
    {
        $this->Nombre_reservation = $Nombre_reservation;

        return $this;
    }

    /**
     * Get the value of Enfant_reservation
     */
    public function isEnfantReservation(): bool
    {
        return $this->Enfant_reservation;
    }

    /**
     * Set the value of Enfant_reservation
     */
    public function setEnfantReservation(bool $Enfant_reservation): self
    {
        $this->Enfant_reservation = $Enfant_reservation;

        return $this;
    }

    /**
     * Get the value of Luge_reservation
     */
    public function getLugeReservation(): int
    {
        return $this->Luge_reservation;
    }

    /**
     * Set the value of Luge_reservation
     */
    public function setLugeReservation(int $Luge_reservation): self
    {
        $this->Luge_reservation = $Luge_reservation;

        return $this;
    }

    /**
     * Get the value of Casque_reservation
     */
    public function getCasqueReservation(): int
    {
        return $this->Casque_reservation;
    }

    /**
     * Set the value of Casque_reservation
     */
    public function setCasqueReservation(int $Casque_reservation): self
    {
        $this->Casque_reservation = $Casque_reservation;

        return $this;
    }

    /**
     * Get the value of Id_User
     */
    public function getIdUser(): int
    {
        return $this->Id_User;
    }

    /**
     * Set the value of Id_User
     */
    public function setIdUser(int $Id_User): self
    {
        $this->Id_User = $Id_User;

        return $this;
    }
}
