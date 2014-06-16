<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class departamentoBuscador {
    public function departamentoBuscador($Metodo='') {
        switch($Metodo){

            case "printDepartamento":
                $Datos = $this->printDepartamento();
                print ($Datos);
            break;  
        }
    }
    
    function printDepartamento() {
        //Consulta simple para traer los tipos de inmueble
        $sql = "SELECT * FROM gendepartamento";

        //Ejecucion de query
        $res_query = mysqlEjecutar($sql, 'Error de Ejecucion');

        $cadena = "<option value='0'>Seleccione Departamento</option>";

        //Se imprimen los resultados
        while ($row = mysqli_fetch_array($res_query)) {
            $cadena .= "<option value='".$row["IdGenDepartamento"]."'>".$row["Departamento"]."</option>";
        }
        return $cadena;
    }
    
}

if ($_POST["Metodo"] != "")
{
    new departamentoBuscador($_POST["Metodo"]);  
    mysqli_close($cnx);
}
