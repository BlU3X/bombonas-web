<?php

//require_once 'autoload.php';

class functions {

    public static function media($id) {
//        require_once './bombonas.php';

        $o = new bombonas();
        $mediaNueva = self::duracionBombona($id);
        $media = $o->get_media($id);

        if ($media == 0) {
            $media = $mediaNueva;
        } else {
            $media = ($media + $mediaNueva) / 2;
        }

        return $media;
    }

    public static function fechaFinalAprox($id) {
        //mostrar fecha que se acabará la bombona, aproximadamente.
//        require_once './bombonas.php';
        $o = new bombonas();

        $fechaInicial = $o->get_fecha_inicial($id);
        $media = $o->get_media($id);

        if ($media == 0) {
//            $resultado = "Aun no se puede establecer la aproximación de la fecha final";
//            die("Aun no se puede establecer la aproximación de la fecha final");
            $resultado = $fechaInicial;
        } else {

            $fechaInicial = new DateTime($fechaInicial);

            $resultado = $fechaInicial->add(new DateInterval("P{$media}D"));

            $resultado = $resultado->format('Y-m-d');
        }

        return $resultado;
    }

    public static function duracionBombona($id) {
//        require_once './bombonas.php';
//        $fechaInicial - $fechaFinal;
        $o = new bombonas;
        $fechaInicial = $o->get_fecha_inicial($id);

        $fechaInicial = new DateTime($fechaInicial);

        $fechaFinal = date("Y-m-d");
        $fechaFinal = new DateTime($fechaFinal);

        $intervalo = $fechaInicial->diff($fechaFinal);

        return $intervalo->format("%a");
    }

    public static function cambioFormatoFechas($fecha) {

        $nSueltos = explode("-", $fecha);

        $fecha = "$nSueltos[2]-$nSueltos[1]-$nSueltos[0]";

        return $fecha;
    }

    public static function porcentajeMedia($id) {
        //calcular el porcentaje restante de la bombona.
//        require_once './bombonas.php';
        $o = new bombonas();


        $parte = self::diasRestantes($id);

        $total = $o->get_media($id);

        if ($parte == 0 or $total == 0) {
            $porcentaje = 0;
        } else {
            $porcentaje = $parte / $total * 100;
        }
        return round($porcentaje, 2);
    }

    public static function diasRestantes($id) {
        //obtener el numero de dias restantes.
        $bombona = new bombonas();

        $fechaFinal = $bombona->get_fecha_final($id);

        $hoy = date("Y-m-d");


        $fechaFinal = new DateTime($fechaFinal);
        $hoy = new DateTime($hoy);

        $intervalo = $fechaFinal->diff($hoy);

        return $intervalo->format("%a");
    }

}
