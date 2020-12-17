<?php


class Db
{
    private static $instance;
    private PDO $pdo;

// private erhinder Zugriff von aißen
    private function __construct()
    {
        $db = parse_ini_file("..\\todoListe\\config.ini");
        $user = $db['user'];
        $password = $db['password'];
        $name = $db['name'];
        $host = $db['host'];
        $type = $db['type'];
        $this->pdo = new PDO($type . ':host=' . $host . ';dbname=' . $name, $user, $password);
    }

    private function __clone()
    {
        // TODO: Implement __clone() method.
    }

    /**
     * @return Db
     */
    public static function getInstance()
    {
        if (!static::$instance) {
            static::$instance = new Db();
        }
        return static::$instance;
    }

    public function getPdo(): PDO
    {
        return $this->pdo;
    }
}
