<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    
class rangoBuscador {
    public function rangoBuscador($pesosArrendamiento, $pesosVenta,$Metodo='') {
        switch($Metodo){

            case "printRango":
                $Datos = $this->printRango($pesosArrendamiento, $pesosVenta);
                print ($Datos);
            break;  
        }
    }
    
    function printRango($pesosArrendamiento, $pesosVenta) {
        $tipooferta = $_POST["tipooferta"];
        $sql = "select  min(precio) as minimo, max(precio) as maximo  from inmuebleoferta where tipoOferta = ".$tipooferta;
        //Se ejecuta la consulta generada
        $res_query = mysqlEjecutar($sql, 'Error de Ejecucion');

        $cadena = "<option value=''>Seleccione Valores</option>";

        while ($row = mysqli_fetch_array($res_query)) {
            $minimo = $row["minimo"];
            $maximo = $row["maximo"];
        }
        
        if($tipooferta == 1) {
            $pesos = $pesosArrendamiento;
        } else {
            $pesos = $pesosVenta;
        }

        $numero_indice = (int)($minimo/$pesos);

        $numero_final = (int)($maximo/$pesos);

        $indice = $numero_indice * $pesos;

        $final = ($numero_final*$pesos)+$pesos;

        if($minimo == null) {
            echo "<option>0 - 0</option>";
        } else {
            while ($indice < $final) {
               $cadena .= "<option>".$indice." - ".($indice+$pesos)."</option>";
                $indice += $pesos;
            }
        }
        return $cadena;
    }
}

if ($_POST["Metodo"] != "")
{
    new rangoBuscador($pesosArrendamiento, $pesosVenta, $_POST["Metodo"]);    
}
    


 
    