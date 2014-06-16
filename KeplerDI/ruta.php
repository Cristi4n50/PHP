<?php
require 'ModeloMySQL/funcionesPublicas.php';
date_default_timezone_set('America/Bogota');
require 'validarSQLInjection.php';



if ($_POST['Class']) {
    $clase = $_POST['Class'];
 
    switch ($clase) {
        case 001:
            require_once ('ModeloMySQL/tipoInmuebleBuscador.class.php');
            break;
        case 002:
            require_once ('ModeloMySQL/departamentoBuscador.class.php');
            break;
        case 003:
            require_once ('ModeloMySQL/ciudadBuscador.class.php');
            break;
        case 004:
            require_once ('ModeloMySQL/sectorBuscador.class.php');
            break;
        case 005:
            require_once ('ModeloMySQL/rangoBuscador.class.php');
            break;
        case 106:
            require_once ('PHPValoresBuscador/resultadoBuscador.class.php');
            break;
        case 107:
            require_once ('ModeloMySQL/inmuebleSeleccionado.class.php');
            break;
        default:
            die("-99998");
            break;
    } //switch  
}   
