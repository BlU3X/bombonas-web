<?php

class conexion {

    private static $host, $driver, $user, $pasw, $bdname, $charset;

    static function con() {
        $datosBD = require '../config/basedatos.php';

        try {

            $con = new PDO("{$datosBD["driver"]}:host={$datosBD["host"]};dbname={$datosBD["namedb"]}", $datosBD["user"], $datosBD["pasw"]);
            $con->exec("SET NAMES {$datosBD["charset"]}");
            return $con;
        } catch (PDOException $ex) {
            echo "Error: " . $ex->getMessage();
            die();
        }
    }

}
