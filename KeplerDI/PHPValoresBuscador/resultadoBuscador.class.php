<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class resultadoBuscador {
    public function resultadoBuscador($urlImagenes, $Metodo='') {
        switch($Metodo){

            case "printResultado":
                $Datos = $this->printResultado($urlImagenes);
                print ($Datos);
            break;  
        }
    }
    
    public function printResultado($urlImagenes) {
        $sql = "select 
        inmueblearchivo.NombreArchivoInterno,
        inmueble.IdInmueble,    
	inmueble.CodigoInmueble,
	inmueble.AreaConstruida,
	inmueble.AreaPrivada,
	tipoinmueble.Descripcion as TipoInmueble,
	inmueble.DireccionCompleta,
	genbarrio.NombreBarrio,
	unidad.NombreUnidad,
	inmueble.Descripcion,
	vendedor.NombreVendedor,
	gensector.IdGenSector,
	genbarrio.IdGenBarrio,
	genciudad.IdGenCiudad,
	gendepartamento.IdGenDepartamento,
        inmuebleoferta.precio
    from inmueble
	inner join confvalorlista as tipoinmueble on inmueble.IdConfValorLista_TipoInmueble = tipoinmueble.IdConfValorLista
	inner join inmuebleoferta on inmueble.IdInmueble = inmuebleoferta.IdInmueble
        inner join genbarrio on inmueble.IdGenBarrio = genbarrio.IdGenBarrio
	left join inmueblexunidad on inmueble.IdInmueble = inmueblexunidad.IdInmueble
	left join unidad on inmueblexunidad.IdUnidad = unidad.IdUnidad
	inner join vendedor on inmueble.IdVendedor = vendedor.IdVendedor
	inner join gensector on genbarrio.IdGenSector = gensector.IdGenSector
	inner join genciudad on gensector.IdGenCiudad = genciudad.IdGenCiudad
	inner join gendepartamento on genciudad.IdGenDepartamento = gendepartamento.IdGenDepartamento
        left join inmueblearchivo on inmueble.IdInmueble = inmueblearchivo.IdInmueble
        ";
  
    
        //Recibimos variable global $_POST enviada en la funcion $.ajax con los datos del buscador
        $sector = $_POST["sector"];
        $ciudad = $_POST["ciudad"];
        $dpto = $_POST["dpto"];
        $tipoOferta = $_POST["tipooferta"];
        $tipoInmueble = $_POST["tipoinmueble"];
        $rango_i = $_POST["rango_i"];
        $rango_f = $_POST["rango_f"];

        //Obtenemos el tipo de oferta para filtrar los inmuebles
        if (($tipoOferta!="undefined") && ($tipoOferta>0) && ($tipoOferta!="")) {
             $sql .= "WHERE inmuebleoferta.TipoOferta = ".$tipoOferta;
        }
    
    
        //Si el sector tiene algo y es mayor que 0 se traen los inmuebles de ese sector
        if(($sector!="undefined") && ($sector>0)) {
             $sql .= " AND gensector.IdGenSector = ".$sector;

             //Si $ciudad tiene algo y es mayor que 0 se traen los inmuebles de esa ciudad
        } elseif (($ciudad!="undefined") && ($ciudad>0)) {
            $sql .= " AND genciudad.IdGenCiudad = ".$ciudad;

            //Si $dpto tiene algo y es mayor que 0 se traen los inmuebles de ese departamento
        } elseif (($dpto!="undefined") && ($dpto>0)) {
             $sql .= " AND gendepartamento.IdGenDepartamento = ".$dpto;
        }



        //Para traer los inmuebles por el tipo de inmueble seleccionado
        if (($tipoInmueble!="undefined") && ($tipoInmueble>0) && ($tipoInmueble!="")) {
             $sql .= " AND inmueble.IdConfValorLista_TipoInmueble = ".$tipoInmueble;
        }
    
        //Se traen los inmuebles entre un rango de precios seleccionado en el buscador
        if(($rango_i>=0) && ($rango_i!='')){
            $sql .= " AND inmuebleoferta.precio BETWEEN ".$rango_i."AND".$rango_f;
        }

        //Ejecutamos la query $sql generada arriba
        $res_query = mysqlEjecutar($sql, 'Error de Ejecucion');



        $num_rows = mysqli_num_rows($res_query);
        //Contamos los registros que trae el array y si es menos que 1 saca una alerta diciendo "No hay Registros"
        if($num_rows < 1) {
            $cadena = "<thead><th>No se encontraron Registros</th></thead>";
            //Sino imprimira normalmente las filas que el arreglo traiga
        } else {
            $cadena = "<caption>Hay ".$num_rows." Registros</caption>";
            $cadena .= "<thead><tr><th>Imagen</th><th>Codigo</th><th>Precio</th><th>Area Construida</th><th>Direccion</th><th>Barrio</th><th>Anunciante</th></tr></thead><tbody>";
            while ($row = mysqli_fetch_array($res_query)) {
                $cadena .= "<tr><td><a onclick='mostrarModal(".$row["IdInmueble"].");'><img src='".$urlImagenes.$row["NombreArchivoInterno"]."' width='45' /></a></td><td>".$row["CodigoInmueble"]."</td><td>".$row["precio"]."</td><td>".$row["AreaConstruida"]."</td><td>".$row["DireccionCompleta"]."</td><td>".$row["NombreBarrio"]."</td><td>".$row["NombreVendedor"]."</td></tr>";
            }
            $cadena .= "</tbody>";
        }
        return $cadena;
    }
}
      
if ($_POST["Metodo"] != "")
{
    new resultadoBuscador($urlImagenes, $_POST["Metodo"]);    
}
    