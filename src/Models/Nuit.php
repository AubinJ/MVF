<?php

namespace src\Models;


class Nuit
{
    private $Id_nuit;
    private $Name_nuit;
    private $Prix_nuit;

    function __construct(array $datas)
    {
        foreach ($datas as $key => $value) {
            $this->$key = $value;
        }
    }


    /**
     * Get the value of Id_nuit
     */
    public function getIdNuit()
    {
        return $this->Id_nuit;
    }

    /**
     * Set the value of Id_nuit
     */
    public function setIdNuit($Id_nuit): self
    {
        $this->Id_nuit = $Id_nuit;

        return $this;
    }

    /**
     * Get the value of Name_nuit
     */
    public function getNameNuit()
    {
        return $this->Name_nuit;
    }

    /**
     * Set the value of Name_nuit
     */
    public function setNameNuit($Name_nuit): self
    {
        $this->Name_nuit = $Name_nuit;

        return $this;
    }

    /**
     * Get the value of Prix_nuit
     */
    public function getPrixNuit()
    {
        return $this->Prix_nuit;
    }

    /**
     * Set the value of Prix_nuit
     */
    public function setPrixNuit($Prix_nuit): self
    {
        $this->Prix_nuit = $Prix_nuit;

        return $this;
    }
}
