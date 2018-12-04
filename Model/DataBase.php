<?php

/**
 * Clase que maneja la conexion/desconexion a la base de datos
 * mediante las funciones PDO (PHP Data Objects).
 * Utiliza el patron de diseno singleton para el manejo de la conexion.
 */
class DataBase {

    //Propiedades estaticas con la informacion de la conexion (DSN):
    private static $dbName = 'd3ji0rl251ug43';
    private static $dbHost = 'ec2-23-21-201-12.compute-1.amazonaws.com';
    private static $port = '5432';
    private static $dbUsername = 'wjhndxlqdbztkd';
    private static $dbUserPassword = 'e027f03e9b9c3efcd5221d1ac45b8ec6724f4b4825af9c7ff91a2431c288c184';
    //Propiedad para control de la conexion:
    private static $conexion = null;

    /**
     * No se permite instanciar esta clase, se utilizan sus elementos
     * de tipo estatico.
     */
    public function __construct() {
        exit('No se permite instanciar esta clase.');
    }

    /**
     * Metodo estatico que crea una conexion a la base de datos.
     */
    public static function connect() {
        // Una sola conexion para toda la aplicacion (singleton):
        // La palabra reservada self nos ayuda a acceder a las propiedades estaticas de conexion
        if (null == self::$conexion) {
            try {
                self::$conexion = new PDO("pgsql:host=" . self::$dbHost . ";"."port=".self::$port .";". "dbname=" . self::$dbName, self::$dbUsername, self::$dbUserPassword);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        return self::$conexion;
    }

    /**
     * Metodo estatico para desconexion de la bdd.
     */
    public static function disconnect() {
        self::$conexion = null;
    }
}
