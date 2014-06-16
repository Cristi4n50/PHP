/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


//Al estar cargado el DOM...
$(document).ready(function(){
    $('.carousel').carousel({
      interval: 2000
    })
    
    $('#id_tabla_resultados').hide();   //Se esconde la tabla donde iran los resultados de la busqueda
    //Se esconde el select box de ciudad y sector
    $('#id_select_ciudad').hide();      
    $('#id_select_sector').hide();
    
    //Se ejecuta una llamada AJAX que traiga los tipos de inmueble
    $.ajax({
            url: 'ruta.php',         //URL destino
            type: 'POST',
            data: 'Class=001&Metodo=printTipoInmueble',         //001 ---> tipoInmuebleBuscador.class.php
            success: function(datos){
                $('#id_select_tipoInmueble').html(datos);
            }
            
    });
    
    //Se ejecuta una llamada AJAX que traiga los departamentos
    $.ajax({
            url: 'ruta.php',         //URL destino
            type: 'POST',
            data: 'Class=002&Metodo=printDepartamento',         //002 ---> departamentoBuscador.class.php
        //Si ejecuta bien...
       success: function(datos){
            $('#id_select_dpto').html(datos);   //Inserta los datos en el select box de departamentos
        }
            
    });
    
    var tipooferta = $("input[name=tipoOferta]:checked").val(); //Se obtiene el valor del tipo de oferta inicial
    valorRango(tipooferta); //Ejecutamos la funcion valorRango(tipooferta) para traer los rangos de valores iniciales
    
    //Si se cambia el tipo de oferta...
    $("input[name=tipoOferta]").on('change', function() {
        var tipooferta = $("input[name=tipoOferta]:checked").val(); //Obtenemos el nuevo tipo de oferta seleccionado
        valorRango(tipooferta);                                     //Se ejecuta la funcion valorRango(tipooferta) 
        
        //Se esconden los select box de ciudad y sector
        $('#id_select_ciudad').hide();      
        $('#id_select_sector').hide();
        
        //Se setean los valores de departamento, ciudad y sector en 0
        $('#id_select_dpto').val('0');
        $('#id_select_ciudad').val('0');
        $('#id_select_sector').val('0');
        $('#id_select_tipoInmueble').val('0');
    });

    
    //Si cambia el select box de departamento...
    $('#id_select_dpto').on('change', function() {
        $('#id_select_sector').hide();                              //Se esconde el select box del sector
        $('#id_select_sector').val('0');                            //Seteamos en 0 el sector
        var id_dpto = $('#id_select_dpto option:selected').val();   //Se obtiene el departamento seleccionado
        //Ejecutamos la llamada AJAX
        $.ajax({
            url: 'ruta.php',         //URL destino
            type: 'POST',                                   //Metodo de Envio
            data: 'Class=003&Metodo=printCiudad&id_dpto='+id_dpto,                       //003 ---> ciudadBuscador.class.php
            //Si se ejecuta bien...
            success: function(datos){
                $('#id_select_ciudad').show();          //Mostramos el select box de ciudades
                $('#id_select_ciudad').html(datos);     //Se llena el select box con las ciudades
            }
            
        });
    });
    
    //En el evento 'change' del select box 'id_select_ciudad'
    $('#id_select_ciudad').on('change', function() {
        //Obtenemos el valor del valor seleccionado
        var id_ciudad = $('#id_select_ciudad option:selected').val();
        //Ejecutamos una llamada Ajax que va hasta un archivo y regresa la respuesta
        $.ajax({
            //Especificamos la URL
            url: 'ruta.php',
            //Metodo por el cual enviaremos los datos
            type: 'POST',
            //Datos a enviar
            data: 'Class=004&Metodo=printSector&id_ciudad='+id_ciudad,
            //Si se ejecuta satisfactoriamente...
            success: function(datos){
                //Muestra la lista de sectores
                $('#id_select_sector').show();
                //Ingresa las opciones para el selec box 'id_select_sector'
                $('#id_select_sector').html(datos);
            }
            
        });
    });
    
    
     //Si cambia el select box de tipo de inmueble...
    $('#id_select_tipoInmueble').on('change', function() {
        $('#id_select_ciudad').hide();                              //Se esconde el select box de ciudad
        $('#id_select_ciudad').val('0'); 
        $('#id_select_sector').hide();                              //Se esconde el select box del sector
        $('#id_select_sector').val('0');                            //Seteamos en 0 el sector
        $('#id_select_dpto').val('0');                              //Seteamos en 0 el departamento  
    });
    
    
    
    
     //Cuando rpesionen el boton "Enviar"
    $('#id_form_busqueda').on('submit', function(e) {
        e.preventDefault(); //Se previene que la pagina vaya a algun lado
        //Recogemos variables a enviar
        var id_tipoinmueble = $('#id_select_tipoInmueble option:selected').val();
        var tipooferta = $("input[name=tipoOferta]:checked").val();
        var id_sector = $('#id_select_sector option:selected').val();
        var id_dpto = $('#id_select_dpto option:selected').val();
        var id_ciudad = $('#id_select_ciudad option:selected').val();
        var rango = $('#id_select_rango option:selected').val();
        var rango = rango.split('-');
        var rango_i = rango[0];
        var rango_f = rango[1];
        //alert("sector="+id_sector+"&ciudad="+id_ciudad+"&dpto="+id_dpto+"&tipooferta="+tipooferta+'&tipoinmueble='+id_tipoinmueble+'&rango_i='+rango_i+'&rango_f='+rango_f);
        //Ejecutamos la llamada AJAX
        $.ajax({
            url: 'ruta.php',
            type: 'POST',
            data: "Class=106&Metodo=printResultado&sector="+id_sector+"&ciudad="+id_ciudad+"&dpto="+id_dpto+"&tipooferta="+tipooferta+'&tipoinmueble='+id_tipoinmueble+'&rango_i='+rango_i+'&rango_f='+rango_f,
            success: function(datos){
                //Mostramos la tabla que contendra los datos
                $('#id_tabla_resultados').show();
                //Se llena la tabla con los datos recibidos
                $('#id_tabla_resultados').html(datos);
                
            }
            
        });
     });
     
     $("").on('change', function() {
         alert(this.val());
     });
     
     
});

    //Funcion que se ejecuta cada vez que se cambie el tipo de oferta a buscar
    //Trae los rangos de valores y los muestra en el select box dependiendo del tipo de oferta oferta
    function valorRango(tipooferta) {
        $.ajax({
            url: 'ruta.php',   //URL destino
            type: 'POST',                           //Metodo de envio
            data: 'Class=005&Metodo=printRango&tipooferta='+tipooferta,         //Datos a enviar
            //Si se ejecuta bien...
            success: function(datos){
                //Llena el select box con los rangos de valores devueltos 
                $('#id_select_rango').html(datos);
            }   
        });
    }
    
    function mostrarModal(id_inmueble) {
        $.ajax({
            url: 'ruta.php',   //URL destino
            type: 'POST',                           //Metodo de envio
            data: 'Class=107&Metodo=printInmueble&id_inmueble='+id_inmueble,         //Datos a enviar
            //Si se ejecuta bien...
            success: function(datos){
                //Llena el select box con los rangos de valores devueltos 
                $('#id_info_inmueble').html(datos);
                $('#id_abrirModal').click();  
            }   
        });
    }
