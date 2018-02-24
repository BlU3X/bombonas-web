<?php

require_once '../class/autoload.php';

$id = $_GET["id"];

$bombona = new bombonas();

$bombona->delete($id);

header("Location: ../public/vistaPrincipal.php");

