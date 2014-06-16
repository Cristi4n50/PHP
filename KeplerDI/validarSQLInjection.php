<?php
require_once('palabrasReservadas.php');
$recuento = 0;

foreach ($_GET as $key => $value) {
    $Cadena = strtolower($value);//se convierte la cadena a minuscula
    for ($i = 0; $i < sizeof($baneados); $i++) {

        $posInicial = strpos($Cadena, $baneados[$i]);
        if($posInicial !== false){

            do{
                $posFinal = $posInicial + strlen($baneados[$i]);

                $value = substr($value, 0, $posInicial).substr($value, $posFinal);
                $Cadena = substr($Cadena, 0, $posInicial).substr($Cadena, $posFinal);
                $posInicial = strpos($Cadena, $baneados[$i]);

            }while ($posInicial !== false);
        }

    } //for $baneados
    $_GET[$key] = $value;
}//for $_GET

foreach ($_POST as $key => $value) {
    $Cadena = strtolower($value);//se convierte la cadena a minuscula
    for ($i = 0; $i < sizeof($baneados); $i++) {

        $posInicial = strpos($Cadena, $baneados[$i]);
        if($posInicial !== false){

            do{
                $posFinal = $posInicial + strlen($baneados[$i]);

                $value = substr($value, 0, $posInicial).substr($value, $posFinal);
                $Cadena = substr($Cadena, 0, $posInicial).substr($Cadena, $posFinal);
                $posInicial = strpos($Cadena, $baneados[$i]);

            }while ($posInicial !== false);
        }

    } //for $baneados
    $_POST[$key] = $value;
}//for $_GET
?>
