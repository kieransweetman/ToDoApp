<?php

namespace Digi\Todoapp\Model;

use Digi\Todoapp\Core\Model;

class Projets extends Model{
    private $id;
    private string $libelle;
    private array $taches;

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of libelle
     */ 
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set the value of libelle
     *
     * @return  self
     */ 
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get the value of taches
     */ 
    public function getTaches()
    {
        return $this->taches;
    }

    /**
     * Set the value of taches
     *
     * @return  self
     */ 
    public function setTaches($taches)
    {
        $this->taches = $taches;

        return $this;
    }
}