<?php

namespace Digi\Todoapp\Model;

use Digi\Todoapp\Core\Model;

class Users extends Model{
    
    private $id;
    private string $pseudo;
    private string $mail;
    private string $pwd;

    public static function getPseudoWithId($ids){
        $where = '';
        foreach($ids as $id){
            $where .= $id . ',';
        }
        $where = substr($where,0,strlen($where)-1);
        $query = self::getInstance()->query('select distinct pseudo from users join affectation on id_users=id where id in(' . $where . ') and admin=0 and id_projets='. $_GET['update']);
        return $query->fetchAll(\PDO::FETCH_CLASS, get_called_class());
    }

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
     * Get the value of pseudo
     */ 
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * Set the value of pseudo
     *
     * @return  self
     */ 
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * Get the value of mail
     */ 
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set the value of mail
     *
     * @return  self
     */ 
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get the value of pwd
     */ 
    public function getPwd()
    {
        return $this->pwd;
    }

    /**
     * Set the value of pwd
     *
     * @return  self
     */ 
    public function setPwd($pwd)
    {
        $this->pwd = $pwd;

        return $this;
    }
}