﻿<!DOCTYPE html>
<head>
    <style>
        #mapa{
            width: 400px;
            height: 400px;
            float:left;
            background: green;
        }
        #infor{
            width: 400px;
            height: 400px;
            float:left;
        }
    </style>
<!--IMPORTANTE RESPETAR EL ORDEN -->
<!--ESTILOS DE BOOSTRAP -->
<link href="css/bootstrap.min.css" rel="stylesheet" />
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-2.0.3.min.js" ></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1aE0WtuiVtGobAxmOxnlDFAT_c1DM0ZE"type="text/javascript"></script>
<!--ARCHIVOS JAVASCRIPT DE BOOTSTRAP -->
<script type="text/javascript" src="js/bootstrap.min.js" ></script>
<script>
    //VARIABLES GENERALES
    //declaras fuera del ready de jquery
    var nuevos_marcadores = [];
    var marcadores_bd= [];
    var mapa = null; //VARIABLE GENERAL PARA EL MAPA
    //FUNCION PARA QUITAR MARCADORES DE MAPA
    function limpiar_marcadores(lista)
    {
        for(i in lista)
        {
            //QUITAR MARCADOR DEL MAPA
            lista[i].setMap(null);
        }
    }
    $(document).on("ready", function(){
        
        //VARIABLE DE FORMULARIO
        var formulario = $("#formulario");
        
        var punto = new google.maps.LatLng(19.163622,-99.545926);
        var config = {
            zoom:4,
            center:punto,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        mapa = new google.maps.Map( $("#mapa")[0], config );

        google.maps.event.addListener(mapa, "click", function(event){
           var coordenadas = event.latLng.toString();
           
           coordenadas = coordenadas.replace("(", "");
           coordenadas = coordenadas.replace(")", "");
           
           var lista = coordenadas.split(",");
           
           var direccion = new google.maps.LatLng(lista[0], lista[1]);
           //PASAR LA INFORMACI�N AL FORMULARIO
           formulario.find("input[name='nombre']").focus();
           formulario.find("input[name='lat']").val(lista[0]);
           formulario.find("input[name='lng']").val(lista[1]);
           
           
           var marcador = new google.maps.Marker({
               //titulo:prompt("Titulo del marcador?"),
               position:direccion,
               map: mapa, 
               animation:google.maps.Animation.DROP,
               draggable:false
           });
           //VIDEO 15
           $("#collapseOne").collapse('show');
           $("#collapseTwo").collapse('hide');
           //ALMACENAR UN MARCADOR EN EL ARRAY nuevos_marcadores
           nuevos_marcadores.push(marcador);
           
           google.maps.event.addListener(marcador, "click", function(){

           });
           
           //BORRAR MARCADORES NUEVOS
           limpiar_marcadores(nuevos_marcadores);
           marcador.setMap(mapa);
        });
        $("#btn_grabar").on("click", function(){
            //INSTANCIAR EL FORMULARIO
            var f = $("#formulario");
            
            //VALIDAR CAMPO TITULO
            if(f.find("input[name='nombre']").val().trim()=="")
            {
                alert("Falta nombre");
                return false;
            }
            //VALIDAR CAMPO CX
            if(f.find("input[name='lat']").val().trim()=="")
            {
                alert("Falta Coordenada lat");
                return false;
            }
            //VALIDAR CAMPO CY
            if(f.find("input[name='lng']").val().trim()=="")
            {
                alert("Falta Coordenada lng");
                return false;
            }
            //FIN VALIDACIONES
            
            if(f.hasClass("busy"))
            {
                //Cuando se haga clic en el boton grabar
                //se le marcar� con una clase 'busy' indicando
                //que ya se ha presionado, y no permitir que se
                //realiCe la misma operaci�n hasta que esta termine
                //SI TIENE LA CLASE BUSY, YA NO HARA NADA
                return false;
            }
            //SI NO TIENE LA CLASE BUSY, SE LA PONDREMOS AHORA
            f.addClass("busy");
            //Y CUANDO QUITAR LA CLASE BUSY?
            //CUANDO SE TERMINE DE PROCESAR ESTA SOLICITUD
            //ES DECIR EN EL EVENTO COMPLETE
            
            var loader_grabar = $("#loader_grabar");
           $.ajax({
               type:"POST",
               url:"iajax.php",
               dataType:"JSON",
               data:f.serialize()+"&tipo=grabar",
               success:function(data){
          if(data.estado=="ok")
                    {
                        loader_grabar.removeClass("label-warning").addClass("label-success")
                        .text("Grabado OK").delay(4000).slideUp();
                        listar();
                    }
                    else
                    {
                        alert(data.mensaje);
                    }
               },
               beforeSend:function(){
                   //Notificar al usuario mientras que se procesa su solicitud
                   loader_grabar.removeClass("label-success").addClass("label label-warning")
                   .text("Procesando...").slideDown();
               },
               complete:function(){
                   //QUITAR LA CLASE BUSY
                   f.removeClass("busy");
                   f[0].reset();
                   //[0] jquery trabaja con array de elementos javascript no
                   //asi que se debe especificar cual elemento se har� reset
                   //capricho de javascript
                   //AHORA PERMITIR� OTRA VEZ QUE SE REALICE LA ACCION
                   //Notificar que se ha terminado de procesar
               }
           });
           return false;
        });
        //BORRAR
        $("#btn_borrar").on("click", function(){
            var f_eliminar = $("#formulario_eliminar");
            $.ajax({
               type:"POST",
               url:"iajax.php",
               data:"id="+f_eliminar.find("input[name='idestacion']").val()+"&tipo=borrar",  //checar id aqui-----------------//
               dataType:"JSON",
               success:function(data){
                   if(data.estado=="ok")
                    {
                        limpiar_marcadores(nuevos_marcadores);
                        alert(data.mensaje);
                        f_eliminar[0].reset();
                        listar();
                    }
                    else
                    {
                        alert(data.mensaje);
                    }
               },
               beforeSend:function(){
                   
               },
               complete:function(){
                   
               }
            });
        });

        //ACTUALIZAR
        $("#btn_actualizar").on("click", function(){
            var f_eliminar = $("#formulario_eliminar");
            $.ajax({
               type:"POST",
               url:"iajax.php",
               data:f_eliminar.serialize()+"&tipo=actualizar",
               dataType:"JSON",
               success:function(data){
                   if(data.estado=="ok")
                    {
                        limpiar_marcadores(nuevos_marcadores);
                        alert(data.mensaje);
                        f_eliminar[0].reset();
                        listar();
                    }
                    else
                    {
                        alert(data.mensaje);
                    }
               },
               beforeSend:function(){
                   
               },
               complete:function(){
                   
               }
            });
        });

        //BUSCAR
        $("#btn_buscar").on("click", function(){
          var palabra_buscar = $("#palabra_buscar").val();
          var select_resultados = $("#select_resultados");
          $.ajax({
            type:"POST",
            dataType:"JSON",
            url:"iajax.php",
            data:"palabra_buscar="+palabra_buscar+"&tipo=buscar",
            success: function(data){
              if(data.estado=="ok")
              {
                $.each(data.mensaje, function(i, item){
                  $("<option data-lat='"+item.lat+"' data-lng='"+item.lng+"' value='"+item.idestacion+"'>"+item.nombre+"</option>")
                  .appendTo(select_resultados);
                });
              }

            },
            beforeSend: function(){
              select_resultados.empty();//limpiar ComboBox
            },
            complete: function(){

            }
          });
          return false;
        });

        //CENTRAR EL MARCADOR AL SELECCIONARLO
        $("#select_resultados").on("click, change", function(){
          //PEQUEÑA VALIDACION
          if($(this).children().length<1)
          {
            return false;//NO HACER NADA, AL NO TENER ITEMS
          }
          var cx = $("#select_resultados option:selected").data("lat");
          var cy = $("#select_resultados option:selected").data("lng");
          //Crear variable coordenada
          var myLatLng = new google.maps.LatLng(lat, lng);
          //VARIABLE MAPA
          mapa.setCenter(myLatLng);
        });


        //CARGAR PUNTOS AL TERMINAR DE CARGAR LA P�GINA
        listar();//FUNCIONA, AHORA A GRAFICAR LOS PUNTOS EN EL MAPA
    });
    //FUERA DE READY DE JQUERY
    //FUNCTION PARA RECUPERAR PUNTOS DE LA BD
    function listar()
    {
        //ANTES DE LISTAR MARCADORES
        //SE DEBEN QUITAR LOS ANTERIORES DEL MAPA
       limpiar_marcadores(marcadores_bd);
       var f_eliminar = $("#formulario_eliminar");
       $.ajax({
               type:"POST",
               url:"iajax.php",
               dataType:"JSON",
               data:"&tipo=listar",
               success:function(data){
                   if(data.estado=="ok")
                    {
                        //alert("Hay puntos en la BD");
                        $.each(data.mensaje, function(i, item){
                            //OBTENER LAS COORDENADAS DEL PUNTO
                            var posi = new google.maps.LatLng(item.lat, item.lng);//bien
                            //CARGAR LAS PROPIEDADES AL MARCADOR
                            var marca = new google.maps.Marker({
                                idMarcador:item.idestacion,
                                position:posi,
                                nombre: item.nombre,
                                lat:item.lat,
                                lng:item.lng
                            });
                            //AGREGAR EVENTO CLICK AL MARCADOR
                            google.maps.event.addListener(marca, "click", function(){
                                $("#collapseOne").collapse('hide');
                                $("#collapseTwo").collapse('show');
                               //alert("Hiciste click en "+marca.idMarcador + " - " + marca.titulo) ;
                               //SOLO MOVER CUANDO SE MARQUE EL CHECKBOX DEL FORMULARIO
                               if($("#opc_edicion").prop("checked"))
                               
                               {
                                    //HACER UN MARCADOR DRAGGABLE
                                    marca.setOptions({draggable: true});

                                    google.maps.event.addListener(marca, 'dragend', function(event) { 
                                        //AL FINAL DE MOVE EL MARCADOR
                                        //ESTE MISMO YA SE ACTUALIZA CON LAS NUEVAS COORDENADAS
                                        //alert(marca.position);
                                        var coordenadas = event.latLng.toString();
                                        coordenadas = coordenadas.replace("(", "");
                                        coordenadas = coordenadas.replace(")", "");
                                        var lista = coordenadas.split(",");
                                        f_eliminar.find("input[name='lat']").val(lista[0]);
                                        f_eliminar.find("input[name='lng']").val(lista[1]);
                                    } );
                                }
                                else
                                {
                                    
                                    f_eliminar.find("input[name='nombre']").val(marca.nombre);
                                    f_eliminar.find("input[name='lat']").val(marca.lat);
                                    f_eliminar.find("input[name='lng']").val(marca.lng);
                                    f_eliminar.find("input[name='id']").val(marca.idMarcador);
                                }
                                limpiar_marcadores(nuevos_marcadores);
                            });
                            //AGREGAR EL MARCADOR A LA VARIABLE MARCADORES_BD
                            marcadores_bd.push(marca);
                            //UBICAR EL MARCADOR EN EL MAPA
                            marca.setMap(mapa);
                        });
                    }
                else
                    {
                        alert("NO hay puntos en la BD");
                    }
               },
               beforeSend:function(){
                   
               },
               complete:function(){
                   
               }
           });
    }
    //PLANTILLA AJAX
    
</script>
</head>
<body>
    <div id="mapa">
        <h2>Aquí ira el mapa!</h2>
    </div>
    
    <div id="infor">
        <div class="accordion" id="accordion2">
            <div class="accordion-group">
              <div class="accordion-heading">
               
            <div class="accordion-group">
              <div class="accordion-heading">
                <h2>Ver Estacion</h2>
                  
              </div>
             
                <div class="accordion-inner">
                  <form id="formulario_eliminar">
                      <input type="hidden" class="form-control"  name="id"/>
                        <table>
                            <tr>
                                <td>Nombre</td>
                                <td><input type="text" class="form-control"  name="nombre" autocomplete="off"/></td>
                            </tr>
                            <tr>
                                <td>Lat:</td>
                                <td><input type="text" class="form-control" readonly  name="lat" autocomplete="off"/></td>
                            </tr>
                            <tr>
                                <td>Lon:</td>
                                <td><input type="text" class="form-control"  readonly name="lng" autocomplete="off"/></td>
                            </tr>
                            <!-- Aqui estar� se colocaran los mensajes para el usuario -->
                            <tr>
                                <td></td>
                                <td><span id="loader_grabar" class=""></span></td>
                            </tr>
                            <tr>
                                
                                <td><a href="estaciondetalle.php?id=2" title="Ver Informacion de la Estacion" class="btn btn-warning btn-sm"><span>Ver estacion</span></a> </td>
                            </tr>
                            
                        </table>
                    </form>
                </div>
              </div>
            </div>
            
</body>
</html>