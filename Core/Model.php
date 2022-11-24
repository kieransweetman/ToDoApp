<?php

class Model{
    private static $dsn = 'mysql:dbname=projetmcd;host=localhost';
    private static $username = 'greg';
    private static $password = 'root';
    public static $instance = NULL;

    private function __construct(){
        try{
            self::$instance = new \PDO(self::$dsn, self::$username, self::$password);
        }catch(\PDOException $e){
            echo $e->getMessage();
        }
    }

    public static function getInstance(){//pattern Singleton => l'objectif est de restreindre l'instanciation à un seul objet
        if(self::$instance === NULL){
            new Model();
        }
        return self::$instance;
    }

    public static function create(){
        $sql = "insert into projets values(null,'test')";
        self::getInstance()->exec($sql);
    }
}

Model::create();