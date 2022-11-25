<?php

namespace Digi\Todoapp\Model;

class Affectation{
    private Projets $id_projets;
    private Users $id_users;
    private bool $admin;

    /**
     * Get the value of id_projets
     */ 
    public function getId_projets()
    {
        return $this->id_projets;
    }

    /**
     * Set the value of id_projets
     *
     * @return  self
     */ 
    public function setId_projets($id_projets)
    {
        $this->id_projets = $id_projets;

        return $this;
    }

    /**
     * Get the value of id_users
     */ 
    public function getId_users()
    {
        return $this->id_users;
    }

    /**
     * Set the value of id_users
     *
     * @return  self
     */ 
    public function setId_users($id_users)
    {
        $this->id_users = $id_users;

        return $this;
    }

    /**
     * Get the value of admin
     */ 
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * Set the value of admin
     *
     * @return  self
     */ 
    public function setAdmin($admin)
    {
        $this->admin = $admin;

        return $this;
    }
}