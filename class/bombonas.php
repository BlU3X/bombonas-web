<?php

class bombonas {

    private $id = null,
            $nombre,
            $fecha_inicial,
            $fecha_final,
            $media = 1;

    function __construct($nombre = null) {
        $this->nombre = $nombre;
        $this->fecha_inicial = date('Y-m-d');
        $this->fecha_final = date('Y-m-d');
    }

    function get_id() {
        return $this->id;
    }

    function get_nombre() {
        return $this->nombre;
    }

    function get_fecha_inicial($id) {

        $con = conexion::con();
        $sql = "SELECT fecha_inicial FROM bombonas where id = $id";

        $sentencia = $con->query($sql);

        $media = $sentencia->fetch();

        $con = NULL;

        return $media["fecha_inicial"];
    }

    function get_fecha_final($id) {

        $con = conexion::con();
        $sql = "SELECT fecha_final FROM bombonas where id = $id";

        $sentencia = $con->query($sql);

        $media = $sentencia->fetch();
        $con = NULL;

        return $media["fecha_final"];
    }

    function get_media($id) {


        $con = conexion::con();
        $sql = "SELECT media FROM bombonas where id = $id";

        $sentencia = $con->query($sql);

        $media = $sentencia->fetch();
        $con = NULL;
        return $media["media"];
    }

    function set_id($id) {
        $this->id = $id;
    }

    function set_nombre($nombre) {
        $this->nombre = $nombre;
    }

    function set_fecha_inicial($fecha_inicial) {
        $this->fecha_inicial = $fecha_inicial;
    }

    function set_fecha_final($fecha_final) {
        $this->fecha_final = $fecha_final;
    }

    function set_media($media) {
        $this->media = $media;
    }

    public function getAll() {

        $con = conexion::con();
        $sql = "SELECT * FROM bombonas";

        $sentencia = $con->query($sql);
        $con = NULL;
        return $sentencia->fetchAll();
    }

    public function getOne($id) {

        $con = conexion::con();
        $sql = "SELECT * FROM bombonas where id = $id";

        $sentencia = $con->query($sql);
        $con = NULL;
        return $sentencia->fetch(PDO::FETCH_ASSOC);
    }

    public function save() {

        try {

            $con = conexion::con();

//////////////Insercion en base de datos sin sentencias preparadas//////////////////////////////////////////
//            $sql = "INSERT INTO bombonas ( nombre, fecha_inicial, fecha_final, media) VALUES ( '{$this->nombre}', '$this->fecha_inicial', '{$this->fecha_final}', '{$this->media}')";
//            $con->exec($sql);
////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////Insercion en base de datos con sentencias preparadas. ///////////////////////
            $sql = "INSERT INTO bombonas (nombre,fecha_inicial,fecha_final,media) VALUES (:nombre,:fecha_inicial,:fecha_final,:media)";
            $sentencia = $con->prepare($sql);

            $sentencia->bindParam(":nombre", $this->nombre);
            $sentencia->bindParam(":fecha_inicial", $this->fecha_inicial);
            $sentencia->bindParam(":fecha_final", $this->fecha_final);
            $sentencia->bindParam(":media", $this->media);

            $sentencia->execute();
            $con = NULL;
///////////////////////////////////////////////////////////////////////////////////////////
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            die();
        }
    }

    public function update($id, $fecha_final, $media) {
        //actualizar los datos de una bombona.
        $con = conexion::con();
        $fecha_inicio = date("Y-m-d");
        $sql = "UPDATE bombonas SET fecha_inicial=:fecha_inicio,fecha_final=:fecha_final,media=:media WHERE id = $id";
        $sentencia = $con->prepare($sql);

        $sentencia->bindParam(":fecha_inicio", $fecha_inicio);
        $sentencia->bindParam(":fecha_final", $fecha_final);
        $sentencia->bindParam(":media", $media);

        $sentencia->execute();

        $nextRow = $sentencia->rowCount();
        $con = NULL;
        return $nextRow;
    }

    public function updateFechaFinal($id, $fecha_final) {
        //actualizar los datos de una bombona.

        $con = conexion::con();

        $sql = "UPDATE bombonas SET fecha_final=:fecha_final WHERE id = $id";
        $sentencia = $con->prepare($sql);

        $sentencia->bindParam(":fecha_final", $fecha_final);

        $sentencia->execute();

        $nextRow = $sentencia->rowCount();
        $con = NULL;
        return $nextRow;
    }

    public function delete($id) {
        //borrar una bombona.

        $con = conexion::con();

        $sql = "DELETE FROM bombonas WHERE id = $id";

        $sentencia = $con->exec($sql);
        $con = NULL;
    }

}
