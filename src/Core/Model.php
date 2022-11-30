<?php

namespace Digi\Todoapp\Core;

class Model
{
    private static $dsn = 'mysql:dbname=projetmcd;host=localhost';
    private static $username = 'projet2';
    private static $password = 'projet2';
    public static $instance = null;

    private function __construct()
    {
        try {
            self::$instance = new \PDO(
                self::$dsn,
                self::$username,
                self::$password
            );
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            new Model();
        }
        return self::$instance;
    }

    private static function getClass()
    {
        $classe = get_called_class();
        $classeTab = explode('\\', $classe);
        return $classeTab[count($classeTab) - 1];
    }

    public static function getAll()
    {
        $query = self::getInstance()->query(
            'select * from ' . self::getClass()
        );
        return $query->fetchAll(\PDO::FETCH_CLASS, get_called_class());
    }

    //Get All avec Order by
    /**
     * Récupère toutes les lignes d'une table en effectuant un tri
     *
     * @param string $colonneDeTri => le tri se fait en fonction de cette colonne
     * @return array
     */
    public static function getAllOrderBy($colonneDeTri)
    {
        $query = self::getInstance()->query(
            'select * from ' . self::getClass() . ' order by ' . $colonneDeTri
        );
        return $query->fetchAll(\PDO::FETCH_CLASS, get_called_class());
    }

    public static function getById($id)
    {
        $query = self::getInstance()->query(
            'select * from ' . self::getClass() . ' where id=' . $id
        );
        return $query->fetchAll(\PDO::FETCH_CLASS, get_called_class());
    }

    /**
     * retourne le dernier id créé de la table
     *
     * @return void
     */
    public static function getLastId()
    {
        $query = self::getInstance()->query(
            'select max(id) from ' . self::getClass()
        );
        $result = $query->fetchAll(\PDO::FETCH_CLASS, get_called_class());
        return $result[0]->{"max(id)"};
    }


    public static function deleteById($id)
    {
        $sql = 'delete from ' . self::getClass() . ' where id=' . $id;
        $query = self::getInstance()->exec($sql);
    }

    public static function deleteByAttribute($name, $value)
    {
        $sql =
            'delete from ' .
            self::getClass() .
            ' where ' .
            $name .
            '=' .
            $value;
        $query = self::getInstance()->exec($sql);
    }

    public static function deleteByTwoAttributes($name1, $value1, $name2, $value2)
    {
        $sql = 'delete from ' . self::getClass() . ' where '.$name1.'=' . $value1 . ' and '.$name2.'=' . $value2;
        $query = self::getInstance()->exec($sql);
    }

    public static function create()
    {
        $vars = self::clear();
        $sql = 'insert into ' . self::getClass() . ' values(' . $vars[0] . ')';
        return self::getInstance()
            ->prepare($sql)
            ->execute($vars[1]);
    }

    public static function updateById()
    {
        unset($_POST['update']);
        $sql = 'update ' . \strtolower(self::getClass()) . ' set ';
        foreach ($_POST as $key => $value) {
            if ($key === 'create') {
                continue;
            }
            $sql .= $key . '= :' . $key . ',';
        }
        $sql = substr($sql, 0, strlen($sql) - 1);
        $sql .= ' where id=' . $_GET['update'];
        $vars = self::clear();
        return self::getInstance()
            ->prepare($sql)
            ->execute($vars[1]);
    }

    public static function getByAttribute($name, $value)
    {
        $query = self::getInstance()->query(
            'select * from ' .
                \strtolower(self::getClass()) .
                ' where ' .
                $name .
                '=' .
                "'" .
                $value .
                "'"
        );
        return $query->fetchAll(\PDO::FETCH_CLASS, get_called_class());
    }

    /**
     * update enrigstrement par l'id
     *
     * @param string $col
     * @param string $value
     * @param int $id
     * @return void
     */
    public static function updateAttributeById($col, $value, $id)
    {
        $sql =
            'update ' .
            \strtolower(self::getClass()) .
            ' set ' .
            $col .
            " = '" .
            $value .
            "' where id=" .
            $id;

        $query = self::getInstance()->exec($sql);
    }

    private static function clear()
    {
        unset($_POST['create']);
        $return[] = ':id';
        if (isset($_GET['insert']) || isset($_GET['insertuser'])) {
            $return[] = ['id' => null];
        }
        foreach ($_POST as $key => $value) {
            $return[0] .= ',:' . $key;
            $return[1][$key] = htmlspecialchars($value);
        }
        return $return;
    }
}
