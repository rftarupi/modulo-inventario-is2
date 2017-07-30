<?php

/**
 * Clase que maneja la conexion/desconexion a la base de datos
 * mediante las funciones PDO (PHP Data Objects).
 * Utiliza el patron de diseno singleton para el manejo de la conexion.
 */
class DataBase {

    //Propiedades estaticas con la informacion de la conexion (DSN):
    private static $dbName = 'dd2lfq87un5o7h';
    private static $dbHost = 'ec2-54-163-254-76.compute-1.amazonaws.com';
    private static $port = '5432';
    private static $dbUsername = 'fgiceozsnpejaz';
    private static $dbUserPassword = '7177c494b626df6fcc521e7515df89b511e8de0857df1aa7dc6b49aa3bb035f0';
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