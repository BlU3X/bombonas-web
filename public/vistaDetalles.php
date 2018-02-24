<?php
require_once '../class/autoload.php';


$titulo = "Detalles bombona";
$lang = "es";



require_once 'header.php';
?>

<div class="container principal">

    <div class="container datos">
        <?php
        $id = $_GET["id"];
        $o = new bombonas();

        $datos = $o->getOne($id);
        $fechaInicial = functions::cambioFormatoFechas($datos["fecha_inicial"]);
        $fechaFinal = functions::cambioFormatoFechas($datos["fecha_final"]);
        echo "<span>Nombre: </span> {$datos["nombre"]}<br>";
        echo "<span>Fecha Inicial: </span>{$fechaInicial} <br>";
        echo "<span>Fecha final aproximada: </span>{$fechaFinal} <br>";
        echo "<span>Duración media: </span>{$datos["media"]} <br>";
        ?>
        <a class = "btn btn-primary" href="javascript:history.go(-1);">Atras</a>

        <a class = "btn btn-primary" href="<?php echo "../action/borrarBombona.php?id=$id" ?>">Eliminar</a>

    </div>
    <div class="container registro">
        <h3> Registro de duraciones: </h3>
    </div>

    <table class="table detalles">
        <th class="first">Fecha Inicio</th>
        <th class="mid">Fecha Final</th>
        <th class="last">Media</th>
        <?php
        $log = new log();
        $datosLog = $log->getById($id);

        foreach ($datosLog as $value) {
            ?>

            <tbody>

            <td class="first"><?php echo functions::cambioFormatoFechas($value["fecha_inicio"]) ?></th>
            <td class="mid"><?php echo functions::cambioFormatoFechas($value["fecha_fin"]) ?></td>
            <td class="last"><?php echo $value["media"] ?></td>

            </tbody>
            <?php
        }
        ?>




    </table>
</div>

<?php
require_once './footer.php';
?>

