<?php

namespace Digi\Todoapp\Model;

use Digi\Todoapp\Core\Model;

class Affectation extends Model
{
    private $id_projets;
    private $id_users;
    private bool $admin;

    public static function createAffectation($id_projet, $id_users, $isadmin)
    {
        $vars = self::clearAffectation($id_projet, $id_users, $isadmin);
        $sql = 'insert into affectation'. " values(" . $vars[0] . ")";
        return self::getInstance()->prepare($sql)->execute($vars[1]);
    }

    private static function clearAffectation($id_projet, $id_users, $isadmin)
    {
        $return[] = ':id_projets,:id_users,:admin';
        if (isset($_GET['insert'])) {
            $return[1]['id_projets'] = $id_projet;
            $return[1]['id_users'] = $id_users;
            $return[1]['admin'] = $isadmin;
        }
        return $return;
    }



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

    public function getId_user()
    {
        return $this->id_users;
    }
}
