<?php

require_once '../class/autoload.php';

$log = new log();
$bombona = new bombonas();
$o = new functions();

$id_bombonas = $_GET["id"];
$fecha_inicio = $bombona->get_fecha_inicial($id_bombonas);
$fecha_fin = date("Y-m-d");

$media = $o->media($id_bombonas);

$log->save($fecha_inicio, $fecha_fin, $media, $id_bombonas);

$bombona->update($id_bombonas, $fecha_fin, $media);

$fecha_final = $o->fechaFinalAprox($id_bombonas);

$bombona->updateFechaFinal($id_bombonas, $fecha_final);

header("Location: ../public/vistaPrincipal.php");
