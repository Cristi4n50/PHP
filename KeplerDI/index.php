<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Directorio Inmobiliario</title>
        <link rel="stylesheet" href="./../Libs/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="StylesheetsFiles/stylesheets.css">
        <script src="../Libs/jquery.min.js"></script>
        <script src="../Libs/bootstrap/js/bootstrap.js"></script>
        <script src="JavascriptFiles/scriptjs.js"></script>
    </head>
    <body>
        <div class="wrapper">
            <!-- Inicia Banner Superior Inicio-->
            <div class="banner_SuperiorInicio" id="id_banner_SuperiorInicio">
                Banner Superior Inicio
            </div>
            <!-- Inicia Buscador -->
            <div class="buscador_Marco" id="id_buscador_Marco">
                <form method="POST" name="form_busqueda" id="id_form_busqueda" class="form-horizontal form-search">
                    <label class="radio">
                        <input type="radio" name="tipoOferta"  value="2" checked>Venta<br>
                        <input type="radio" name="tipoOferta"  value="1">Arriendo
                    </label>
                    <select name="select_tipoInmueble" id="id_select_tipoInmueble">
                        <!-- Aqui van las opciones de tipo de inmueble -->
                    </select>
                    <select name="select_dpto" id="id_select_dpto">
                        <!-- Aqui van las opciones de departamento -->
                    </select>
                    <select id="id_select_ciudad">
                        <!-- Aqui van las opciones de ciudad -->
                    </select>
                    <select id="id_select_sector">
                        <!-- Aqui van las opciones de sector -->
                    </select>
                    <span class="add-on">$</span>
                    <select id="id_select_rango">
                        <!-- Aqui van las opciones de rango de valores -->
                    </select>
                    <input type="submit" class="btn btn-submit btn-primary">
                </form> 
            </div>
            <!-- Fin Buscador -->
            <div id="id_banner_IzquierdoInicio">
                Banner Izquierda Inicio

            </div>
            <div id="id_banner_DerechoInicio">
                Banner Derecha Inicio
            </div>
            <!-- Inicia Resultados -->
            <div id="sec_resultados">
                <table border="1" id="id_tabla_resultados" class="table table-hover table-striped">
                    <!-- Aqui van los resultados arrojados -->
                </table>
            </div>
            <div class="push"></div>
            <!-- Fin Resultados -->
        </div>
        <div class="footer">
            Pie de Pagina
        </div>
        
        <a id="id_abrirModal" data-toggle='modal' href='#modal_info'></a>
 
        <!-- Modal -->
        <div id="modal_info" class="modal hide fade in" style="display: none;">
            <div class="modal-header">
                <a data-dismiss="modal" class="close">×</a>
                <h3>Informacion del Inmueble</h3>
            </div>
            <div class='modal-body'>
             

             <div id="myCarousel" class="carousel slide">
              <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
              </ol>
              <!-- Carousel items -->
              <div class="carousel-inner">
                <div class="item"><img src="../Imagenes/bg51.jpg"></div>
                <div class="item"><img src="../Imagenes/bg51.jpg"></div>
              </div>
              <!-- Carousel nav -->
              <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
              <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>

            </div>
            <div id="id_info_inmueble"></div>
           </div>
     
            <div class="modal-footer">
                <a href="#" data-dismiss="modal" class="btn">Cerrar</a>
            </div>
        </div>
    </body>
</html>
