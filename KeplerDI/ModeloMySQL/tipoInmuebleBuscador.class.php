<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 

class tipoInmuebleBuscador {
    public function tipoInmuebleBuscador($Metodo='') {
        switch($Metodo){

            case "printTipoInmueble":
                $Datos = $this->printTipoInmueble();
                print ($Datos);
            break;  
        }
    }
    
    function printTipoInmueble() {
        //Consulta simple para traer los tipos de inmueble
        $sql = "select IdConfValorLista, Descripcion from confvalorlista where confvalorlista.IdSislista = 4";

        //Ejecucion de query
        $res_query = mysqlEjecutar($sql, 'Error de Ejecucion');
        $cadena = "<option value='0'>Seleccione Tipo de Inmueble</option>";

        //Se imprimen los resultados
        while ($row = mysqli_fetch_array($res_query)) {
            $cadena .= "<option value='".$row["IdConfValorLista"]."'>".$row["Descripcion"]."</option>";
        }
        return $cadena;
    }
    
}

if ($_POST["Metodo"] !="")
{
    new tipoInmuebleBuscador($_POST["Metodo"]); 
    mysqli_close($cnx);
}