<?php

//require_once 'autoload.php';

class log {

    private $id, $fecha_inicio, $fecha_fin, $media, $id_bombonas;

    function __construct($fecha_inicio = null, $fecha_fin = null, $media = null, $id_bombonas = null) {
        $this->fecha_inicio = $fecha_inicio;
        $this->fecha_fin = $fecha_fin;
        $this->media = $media;
        $this->id_bombonas = $id_bombonas;
    }

    public function getById($id) {

//        require '../class/autoload.php';
        $con = conexion::con();

        $sql = "SELECT * FROM log WHERE id_bombonas = $id order by id desc";

        $sentencia = $con->query($sql);
        $con = NULL;
        return $sentencia->fetchAll();
    }

    public function save($fecha_inicio, $fecha_fin, $media, $id_bombonas) {
        //guardar nuevos registros en el log cuando se actualiza una bombona.
        try {

//            require_once 'conexion.php';
            $con = conexion::con();

//////////////Insercion en base de datos sin sentencias preparadas//////////////////////////////////////////
//            $sql = "INSERT INTO bombonas ( nombre, fecha_inicial, fecha_final, media) VALUES ( '{$this->nombre}', '$this->fecha_inicial', '{$this->fecha_final}', '{$this->media}')";
//            $con->exec($sql);
////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////Insercion en base de datos con sentencias preparadas. ///////////////////////
            $sql = "INSERT INTO log(fecha_inicio, fecha_fin, media, id_bombonas) VALUES (:fecha_inicio,:fecha_fin,:media,:id_bombonas)";
            $sentencia = $con->prepare($sql);

            $sentencia->bindParam(":fecha_inicio", $fecha_inicio);
            $sentencia->bindParam(":fecha_fin", $fecha_fin);
            $sentencia->bindParam(":media", $media);
            $sentencia->bindParam(":id_bombonas", $id_bombonas);

            $sentencia->execute();

            $nextRow = $sentencia->rowCount();
            $con = NULL;
            return $nextRow;
///////////////////////////////////////////////////////////////////////////////////////////
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            die();
        }
    }

}
