<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require '../Conf/configuracion.php';

function mysqlEjecutar($SQL, $die, $retornarId=0) {
    $cnx = mysqli_connect($GLOBALS["host"], $GLOBALS["user"], $GLOBALS["pass"], $GLOBALS["db"]);
    $RS = mysqli_query($cnx, $SQL);
    
    $resultadoID = mysqli_insert_id($cnx);
    
    if(!$RS){
        die($die);
    }
    return $RS;
    
    if($retornarId==1) {
        return $resultadoID;
    }
}
