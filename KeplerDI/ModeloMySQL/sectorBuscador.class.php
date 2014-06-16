<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    
    //Recibimos la ciudad por la variable global $_POST
    


class sectorBuscador {
    public function sectorBuscador($Metodo='') {
        switch($Metodo){

            case "printSector":
                $Datos = $this->printSector();
                print ($Datos);
            break;  
        }
    }
    
    function printSector() {
        //Consulta simple para traer los tipos de inmueble
        $id_ciudad = $_POST["id_ciudad"];
    
        //Consulta generada deacuerdo a la ciudad seleccionada
        $sql = "SELECT * FROM gensector where IdGenCiudad = ".$id_ciudad;

        //Ejecucion de query
        $res_query = mysqlEjecutar($sql, 'Error de Ejecucion');

        $cadena = "<option value='0'>Seleccione Sector</option>";
        //Se imprimen los resultados
        while ($row = mysqli_fetch_array($res_query)) {
            $cadena .= "<option value='".$row["IdGenSector"]."'>".$row["NombreSector"]."</option>";
        } 
        return $cadena;
    }
}

if ($_POST["Metodo"] != "")
{
    new sectorBuscador($_POST["Metodo"]);
    mysqli_close($cnx);
}
