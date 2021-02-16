<?php

namespace Api\DB;

use Exception;
use PDO;


class DBConnection
{
    // Para resolver el punto 1, vamos a utilizar una propiedad static.
    /** @var PDO La instancia de PDO a manejar como Singleton. */
    protected static $PDOinstance;

    private function __construct()
    {}

    public static function getConnection()
    {
        // Antes de crear la instancia de PDO, preguntamos si existe ya una instancia almacenada.
        if(self::$PDOinstance == null) {
            self::connect();
        }

        return self::$PDOinstance;
    }

    /**
     * Crea la instancia de PDO.
     */
    private static function connect()
    {
        $db_host = "localhost";
        $db_user = "root";
        $db_pass = "";
        $db_base = "social";
        $db_dsn = "mysql:host=$db_host;dbname=$db_base;charset=utf8mb4";

        try {
            // Guardamos la instancia de PDO en la propiedad static.
//            echo "Creando la instancia de PDO<br>";
            self::$PDOinstance = new PDO($db_dsn, $db_user, $db_pass);
        } catch (Exception $e) {
            echo "Oops, falló la conexión: " . $e->getMessage();
        }
    }
}