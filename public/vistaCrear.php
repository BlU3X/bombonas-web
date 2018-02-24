<?php
require_once '../class/autoload.php';


$titulo = "Crear bombona";
$lang = "es";

require_once 'header.php';
?>
<div class="container principal">
    <?php
    if (!isset($_POST["crear"])) {
        ?>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">

            <input type="text" placeholder="nombre de la bombona" name="nombre">

            <input class = "btn btn-primary" type="submit" value="Crear" name="crear">
            <a class = "btn btn-primary" href="javascript:history.go(-1);">Cancelar</a>
        </form>


        <?php
    } else {

        $bombona = $_POST["nombre"];
        $bombona = new bombonas($bombona);

        $bombona->save();
        echo "Bombona: {$_POST["nombre"]} creada";
        header("Location: vistaPrincipal.php");
    }
    ?>
</div>
<?php
require_once './footer.php';
?>

