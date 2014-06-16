<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    
class inmuebleSeleccionado {
    public function inmuebleSeleccionado($Metodo='') {
        switch($Metodo){

            case "printInmueble":
                $Datos = $this->printInmueble();
                print ($Datos);
            break;  
        }
    }
    
    function printInmueble() {
        $id_inmueble = $_POST["id_inmueble"];
        $cadena = "";
        $sql_prin = "select 
	inmueble.CodigoInmueble,
	grupo.NombreLista,
	caracteristica.Descripcion as NombreCaracteristica,
	inmueblecaracteristica.DescripcionCaracteristica as ValorCaracteristica

    from inmueble
            inner join inmueblecaracteristica on inmueble.IdInmueble = inmueblecaracteristica.IdInmueble
            inner join confvalorlista as caracteristica on inmueblecaracteristica.IdConfValorLista_Caracteristica = caracteristica.IdConfValorLista 
            inner join sislista as grupo on caracteristica.IdSisLista = grupo.IdSisLista
                where inmueble.IdInmueble = ".$id_inmueble;

    $sql_lista = "select distinct
            grupo.NombreLista
        from inmueble
            inner join inmueblecaracteristica on inmueble.IdInmueble = inmueblecaracteristica.IdInmueble
            inner join confvalorlista as caracteristica on inmueblecaracteristica.IdConfValorLista_Caracteristica = caracteristica.IdConfValorLista 
            inner join sislista as grupo on caracteristica.IdSisLista = grupo.IdSisLista
            where inmueble.IdInmueble = ".$id_inmueble;

        $res_lista = mysqlEjecutar($sql_lista, 'Error de Ejecucion');
        
        
        
        $lista = array();
        while ($row = mysqli_fetch_array($res_lista)) {
            array_push($lista, $row["NombreLista"]); 
        }
        
        foreach ($lista as $nom_lista) {
           $sql = $sql_prin;
           $cadena .= "<div  class='accordion-group'>
                    <div class='accordion-heading'>
                      <a class='accordion-toggle' data-toggle='collapse' data-parent='#accordion2' href='#collapse".$nom_lista."'>"
                        .$nom_lista.
                      "</a>
                    </div>
                    <div id='collapse".$nom_lista."' class='accordion-body collapse'>
                      <div class='accordion-inner'>";
        
            $sql .= " AND grupo.NombreLista like '".$nom_lista."'";
            $res_query = mysqlEjecutar($sql, 'Error de Ejecucion');
            $cadena .= "<ul style='list-style-type:none'>";
            while ($row = mysqli_fetch_array($res_query)) {
                 $cadena .= "<li>".utf8_encode($row["NombreCaracteristica"])." ".utf8_encode($row["ValorCaracteristica"])."</li>";
                     
                                  
            } 
            $cadena .= "</ul>
                    </div>
                </div>
            </div>";
            
        }
        return $cadena;
    }
}

    
if ($_POST["Metodo"] != "")
{
    new inmuebleSeleccionado($_POST["Metodo"]);    
}


    

 
        
        
     
            

        
        
   