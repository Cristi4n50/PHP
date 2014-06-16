<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

   
class ciudadBuscador {
    public function ciudadBuscador($Metodo='') {
        switch($Metodo){

            case "printCiudad":
                $Datos = $this->printCiudad();
                print ($Datos);
            break;  
        }
    }
    
    function printCiudad() {
        //Consulta simple para traer los tipos de inmueble
        $id_dpto = $_POST["id_dpto"];
        //Consulta generada de acuerdo al departamento seleccionado en el buscador
        $sql = "SELECT * FROM genciudad where IdGenDepartamento = ".$id_dpto;

        //Ejecucion de query
        $res_query = mysqlEjecutar($sql, "Error de Ejecucion");

        $cadena = "<option value='0'>Seleccione Ciudad</option>";
        //Se imprimen los resultados
        while ($row = mysqli_fetch_array($res_query)) {
            $cadena .= "<option value='".$row["IdGenCiudad"]."'>".$row["NombreCiudad"]."</option>";
        }
        
        
        return $cadena;
    }
    
}

if ($_POST["Metodo"] != "")
{
    new ciudadBuscador($_POST["Metodo"]);    
}
