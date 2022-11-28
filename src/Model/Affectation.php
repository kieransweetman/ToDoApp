<?php

namespace Digi\Todoapp\Model;

use Digi\Todoapp\Core\Model;

class Affectation extends Model
{
    private  $id_projets;
    private  $id_users;
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
    public function getId_projets()
    {
        return $this->id_projets;
    }
    public function getId_user()
    {
        return $this->id_users;
    }

    public static function getProjetsByUser($id)
    {
        $query = self::getInstance()->query(
            'select * from affectation where id_users=' . $id
        );
        return $query->fetchAll(\PDO::FETCH_CLASS, get_called_class());
    }
}
