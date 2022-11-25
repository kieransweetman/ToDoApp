<?php

namespace Digi\Todoapp\Model;

class Affectation{
    private Projets $id_projets;
    private Users $id_user;
    private bool $admin;

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