<?php

namespace Digi\Todoapp\Core;

class Model {
    private static $dsn = 'mysql:dbname=projetmcd;host=localhost';
    private static $username = 'projet2';
    private static $password = 'projet2';
    public static $instance=NULL;

    private function __construct() {
        try {
            self::$instance = new \PDO(self::$dsn,self::$username,self::$password);
        } catch(\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getInstance() {
        if (self::$instance === NULL) {
            new Model();
        }
        return self::$instance;
    }

    private static function getClass() {
        $classe = get_called_class();
        $classeTab = explode('\\',$classe);
        return $classeTab[count($classeTab)-1];
    }

    public static function getAll() {
        $query = self::getInstance()->query('select * from '.self::getClass());
        return $query->fetchAll(\PDO::FETCH_CLASS, get_called_class());
    }

    //Get All avec Order by
    public static function getAllOrderBy($colonneDeTri) {
        $query = self::getInstance()->query('select * from '.self::getClass().' order by '.$colonneDeTri);
        return $query->fetchAll(\PDO::FETCH_CLASS, get_called_class());
    }

    public static function getById($id) {
        $query = self::getInstance()->query('select * from '.self::getClass().' where id='.$id);
        return $query->fetchAll(\PDO::FETCH_CLASS, get_called_class());
    }

    public static function deleteById($id) {
        $sql = "delete from ".self::getClass()." where id=".$id;
        $query = self::getInstance()->exec($sql);
    }

    public static function create() {
        $vars = self::clear();
        $sql = 'insert into '.self::getClass()." values(".$vars[0].")";
        var_dump($sql);
        var_dump($vars);
        return self::getInstance()->prepare($sql)->execute($vars[1]);
    }

    public static function updateById() {
        $sql = "update ".self::getClass()." set ";
        foreach ($_POST as $key=>$value) {
            if ($key === 'create') {
                continue;
            }
            $sql .= $key.'= :'.$key.',';
        }
        $sql = substr($sql,0,strlen($sql)-1);
        $sql .= " where id=".$_GET['update'];
        $vars = self::clear();
        return self::getInstance()->prepare($sql)->execute($vars[1]);
    }

    public static function getByAttribute($name,$value) {
        $query = self::getInstance()->query('select * from '.self::getClass().' where '.$name.'='."'".$value."'");
        return $query->fetchAll(\PDO::FETCH_CLASS, get_called_class());
    }

    private static function clear() {
        unset($_POST['create']);
        $return[] = ':id';
        if (isset($_GET['insert'])) {
            $return[] = ['id' => null];
        }
        foreach ($_POST as $key=>$value) {
            $return[0] .= ',:'.$key;
            $return[1][$key] = htmlspecialchars($value); 
        }
        return $return;
    }
}
