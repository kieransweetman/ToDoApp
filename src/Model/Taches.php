<?php

namespace Digi\Todoapp\Model;

use Digi\Todoapp\Core\Model;

class Taches extends Model
{
    private $id;
    private string $titre;
    private string $priorite;
    private string $statut;
    private string $description;
    private Users $users;

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
     * Get the value of titre
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set the value of titre
     *
     * @return  self
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get the value of priorite
     */
    public function getPriorite()
    {
        return $this->priorite;
    }

    /**
     * Set the value of priorite
     *
     * @return  self
     */
    public function setPriorite($priorite)
    {
        $this->priorite = $priorite;

        return $this;
    }

    /**
     * Get the value of statut
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set the value of statut
     *
     * @return  self
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of users
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Set the value of users
     *
     * @return  self
     */
    public function setUsers($users)
    {
        $this->users = $users;

        return $this;
    }
}
