<?php
require_once '../class/autoload.php';


$titulo = "Bombonas";
$lang = "es";



require_once 'header.php';
?>
<div class="container principal">

    <?php
    $bombona = new bombonas();

    echo "<div class='container nuevaBombona'><a class='btn btn-primary nuevaBombona' href='vistaCrear.php'>Nueva bombona</a></div>";
    ?>
    <table class="table table-bordered">

        <?php
        foreach ($bombona->getAll() as $value) {

            $media = functions::porcentajeMedia($value["id"]);
            if ($media >= 40) {
                $class = "bg-success";
            } elseif ($media > 15 && $media < 40) {
                $class = "bg-warning";
            } else {
                $class = "bg-danger";
            }
            ?>

            <tbody>

            <td class="first"><a class='btn btn-primary' href="<?php echo "vistaDetalles.php?id={$value["id"]}" ?>"><?php echo $value["nombre"] ?></a></th>
            <td class="mid">
                <div class="progress">
                    <div class="progress-bar <?php echo $class ?>" role="progressbar" style="width: <?php echo $media ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo functions::porcentajeMedia($value["id"]); ?>%</div>
                </div>

            </td>
            <td class="last"><a class='btn btn-primary' href="<?php echo "../action/renovarBombona.php?id={$value["id"]}" ?>">Renovar</a></td>


            </tbody>

            <?php
        }
        echo "</table>";
        ?>


</div>
<?php
require_once './footer.php';
?>
