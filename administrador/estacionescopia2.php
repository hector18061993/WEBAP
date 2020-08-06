<?php

require_once "conexion.php";
 
$titulo =  $cx = $cy = $direccion= "";

$titulo_err = $cx_err = $cy_err = $direccion_err = "";
 
if(isset($_POST["IdPunto"]) && !empty($_POST["IdPunto"])){
    
    $id = $_POST["IdPunto"];
    
    $input_titulo = trim($_POST["Titulo"]);
    if(empty($input_titulo)){
        $titulo_err = "favor de ingresar el nuevo nombre de la Estacion.";     
    } else{
        $titulo = $input_titulo;
    }

    $input_cx = trim($_POST["cx"]);
    if(empty($input_cx)){
        $cx_err = "Favor de ingresar la nueva ubicacion de la Estacion.";     
    } else{
        $cx = $input_cx;
    }

    $input_cy = trim($_POST["cy"]);
    if(empty($input_cy)){
        $cy_err = "Favor de ingresar la nueva ubicacion de la Estacion.";     
    } else{
        $cy = $input_cy;
    }

    
    $input_direccion = trim($_POST["direccion"]);
    if(empty($input_direccion)){
        $direccion_err = "Favor de ingresar la nueva direccion de la Estacion.";     
    } else{
        $direccion = $input_direccion;
    }
 
   
    if(empty($titulo_err) && empty($cx_err) && empty($cy_err) && empty($direccion_err)){

        // Prepare an update statement
        $sql = "SELECT * FROM  estaciones WHERE IdPunto=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssi", $param_titulo, $param_cx, $param_cy, 
                $param_direccion, $param_id);
            
            // Set parameters
            $param_titulo = $titulo;
            $param_cx = $cx;
            $param_cy = $cy;
            $param_direccion = $direccion;
            
            $param_id = $id;
            
            if(mysqli_stmt_execute($stmt)){
                
                header("location: 404.php");
                exit();
            } else{
                echo "Ocurrio un error. Intentelo mas tarde.";
            }
        }
         
        mysqli_stmt_close($stmt);
    }
    
    
    mysqli_close($link);
} else{
    
    if(isset($_GET["IdPunto"]) && !empty(trim($_GET["idPunto"]))){
        
        $id =  trim($_GET["IdPunto"]);
        
        
        $sql = "SELECT * FROM estaciones WHERE IdPunto = ?";
        if($stmt = mysqli_prepare($link, $sql)){
          
            mysqli_stmt_bind_param($stmt, "IdPunto", $param_id);
            
            
            $param_id = $id;
            
            
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    $nombre = $row["nombre"];
                    $cx = $row["cx"];
                    $cy = $row["cy"];
                    $direccion = $row["direccion"];
                                      
                } else{
                    header("location: errorestacion.php");
                    exit();
                }
                
            } else{
                echo "Oops! Ocurrio un error. Porfavor intentelo mas tarde.";
            }
        }
        
        mysqli_stmt_close($stmt);
 
        mysqli_close($link);
    }  else{
        
        header("location: errorestacion.php");
        exit();
    }
}
?>
 
<!DOCTYPE HTML>
<html>
<head>
<title>Sistema Web Administrador | Usuario Administrador: Estaciones</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<link href="cssmapa/bootstrap.min.css" rel="stylesheet" />
<!-- Custom Theme files -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<!--icons-css-->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!--Google Fonts-->
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-2.0.3.min.js" ></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1aE0WtuiVtGobAxmOxnlDFAT_c1DM0ZE"type="text/javascript"></script>

<!--ARCHIVOS JAVASCRIPT DE BOOTSTRAP -->
<script type="text/javascript" src="jsmapa/bootstrap.min.js" ></script>

    <style>
        #mapa{
            width: 1300px;
            height: 300px;
            float:left;
            background: blue;
        }
        #infor{
            width: 455px;
            height: 700px;
            float:left;
        }
    </style>


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
            zoom:8,
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
           formulario.find("input[name='titulo']").focus();
           formulario.find("input[name='cx']").val(lista[0]);
           formulario.find("input[name='cy']").val(lista[1]);
           
           
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
            if(f.find("input[name='titulo']").val().trim()=="")
            {
                alert("Falta título");
                return false;
            }
            //VALIDAR CAMPO CX
            if(f.find("input[name='cx']").val().trim()=="")
            {
                alert("Falta Coordenada X");
                return false;
            }
            //VALIDAR CAMPO CY
            if(f.find("input[name='cy']").val().trim()=="")
            {
                alert("Falta Coordenada Y");
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
               data:"id="+f_eliminar.find("input[name='id']").val()+"&tipo=borrar",
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
                  $("<option data-cx='"+item.cx+"' data-cy='"+item.cy+"' value='"+item.IdPunto+"'>"+item.Titulo+"</option>")
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
          var cx = $("#select_resultados option:selected").data("cx");
          var cy = $("#select_resultados option:selected").data("cy");
          //Crear variable coordenada
          var myLatLng = new google.maps.LatLng(cx, cy);
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
                            var posi = new google.maps.LatLng(item.cx, item.cy);//bien
                            //CARGAR LAS PROPIEDADES AL MARCADOR
                            var marca = new google.maps.Marker({
                                idMarcador:item.IdPunto,
                                position:posi,
                                titulo: item.Titulo,
                                cx:item.cx,
                                cy:item.cy
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
                                        f_eliminar.find("input[name='cx']").val(lista[0]);
                                        f_eliminar.find("input[name='cy']").val(lista[1]);
                                    } );
                                }
                                else
                                {
                                    
                                    f_eliminar.find("input[name='titulo']").val(marca.titulo);
                                    f_eliminar.find("input[name='cx']").val(marca.cx);
                                    f_eliminar.find("input[name='cy']").val(marca.cy);
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
<!--map-->
</head>
<body>  
<div class="page-container">    
                <div class="header-main">
                    <div class="header-left">
                            <div class="logo-name">
                                     <a href="index.html"> <h1>Informacion</h1> 
                                    <!--<img id="logo" src="" alt="Logo"/>--> 
                                  </a>                              
                            </div>
                            <div class="clearfix"> </div>
                         </div>
                         <div class="header-right">
                            <div class="profile_details_left"><!--notifications of menu start -->

                                <ul class="nofitications-dropdown">
                                    <li class="dropdown head-dpdn">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-envelope"></i><span class="badge">3</span></a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <div class="notification_header">
                                                    <h3>You have 3 new messages</h3>
                                                </div>
                                            </li>
                                            <li><a href="#">
                                               <div class="user_img"><img src="images/p4.png" alt=""></div>
                                               <div class="notification_desc">
                                                <p>Lorem ipsum dolor</p>
                                                <p><span>1 hour ago</span></p>
                                                </div>
                                               <div class="clearfix"></div> 
                                            </a></li>
                                            <li class="odd"><a href="#">
                                                <div class="user_img"><img src="images/p2.png" alt=""></div>
                                               <div class="notification_desc">
                                                <p>Lorem ipsum dolor </p>
                                                <p><span>1 hour ago</span></p>
                                                </div>
                                              <div class="clearfix"></div>  
                                            </a></li>
                                            <li><a href="#">
                                               <div class="user_img"><img src="images/p3.png" alt=""></div>
                                               <div class="notification_desc">
                                                <p>Lorem ipsum dolor</p>
                                                <p><span>1 hour ago</span></p>
                                                </div>
                                               <div class="clearfix"></div> 
                                            </a></li>
                                            <li>
                                                <div class="notification_bottom">
                                                    <a href="#">See all messages</a>
                                                </div> 
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="dropdown head-dpdn">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-bell"></i><span class="badge blue">3</span></a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <div class="notification_header">
                                                    <h3>You have 3 new notification</h3>
                                                </div>
                                            </li>
                                            <li><a href="#">
                                                <div class="user_img"><img src="images/p5.png" alt=""></div>
                                               <div class="notification_desc">
                                                <p>Lorem ipsum dolor</p>
                                                <p><span>1 hour ago</span></p>
                                                </div>
                                              <div class="clearfix"></div>  
                                             </a></li>
                                             <li class="odd"><a href="#">
                                                <div class="user_img"><img src="images/p6.png" alt=""></div>
                                               <div class="notification_desc">
                                                <p>Lorem ipsum dolor</p>
                                                <p><span>1 hour ago</span></p>
                                                </div>
                                               <div class="clearfix"></div> 
                                             </a></li>
                                             <li><a href="#">
                                                <div class="user_img"><img src="images/p7.png" alt=""></div>
                                               <div class="notification_desc">
                                                <p>Lorem ipsum dolor</p>
                                                <p><span>1 hour ago</span></p>
                                                </div>
                                               <div class="clearfix"></div> 
                                             </a></li>
                                             <li>
                                                <div class="notification_bottom">
                                                    <a href="#">See all notifications</a>
                                                </div> 
                                            </li>
                                        </ul>
                                    </li>   
                                    <li class="dropdown head-dpdn">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-tasks"></i><span class="badge blue1">9</span></a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <div class="notification_header">
                                                    <h3>You have 8 pending task</h3>
                                                </div>
                                            </li>
                                            <li><a href="#">
                                                <div class="task-info">
                                                    <span class="task-desc">Database update</span><span class="percentage">40%</span>
                                                    <div class="clearfix"></div>    
                                                </div>
                                                <div class="progress progress-striped active">
                                                    <div class="bar yellow" style="width:40%;"></div>
                                                </div>
                                            </a></li>
                                            <li><a href="#">
                                                <div class="task-info">
                                                    <span class="task-desc">Dashboard done</span><span class="percentage">90%</span>
                                                   <div class="clearfix"></div> 
                                                </div>
                                                <div class="progress progress-striped active">
                                                     <div class="bar green" style="width:90%;"></div>
                                                </div>
                                            </a></li>
                                            <li><a href="#">
                                                <div class="task-info">
                                                    <span class="task-desc">Mobile App</span><span class="percentage">33%</span>
                                                    <div class="clearfix"></div>    
                                                </div>
                                               <div class="progress progress-striped active">
                                                     <div class="bar red" style="width: 33%;"></div>
                                                </div>
                                            </a></li>
                                            <li><a href="#">
                                                <div class="task-info">
                                                    <span class="task-desc">Issues fixed</span><span class="percentage">80%</span>
                                                   <div class="clearfix"></div> 
                                                </div>
                                                <div class="progress progress-striped active">
                                                     <div class="bar  blue" style="width: 80%;"></div>
                                                </div>
                                            </a></li>
                                            <li>
                                                <div class="notification_bottom">
                                                    <a href="#">See all pending tasks</a>
                                                </div> 
                                            </li>
                                        </ul>
                                    </li>   
                                </ul>
                                <div class="clearfix"> </div>
                            </div>
                            <!--notification menu end -->
                            <div class="profile_details">       
                                <ul>
                                    <li class="dropdown profile_details_drop">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                            <div class="profile_img">   
                                                <span class="prfil-img"><img src="images/p1.png" alt=""> </span> 
                                                <div class="user-name">
                                                    <p>Malorum</p>
                                                    <span>Administrator</span>
                                                </div>
                                                <i class="fa fa-angle-down lnr"></i>
                                                <i class="fa fa-angle-up lnr"></i>
                                                <div class="clearfix"></div>    
                                            </div>  
                                        </a>
                                        <ul class="dropdown-menu drp-mnu">
                                            <li> <a href="#"><i class="fa fa-cog"></i> Settings</a> </li> 
                                            <li> <a href="#"><i class="fa fa-user"></i> Profile</a> </li> 
                                            <li> <a href="#"><i class="fa fa-sign-out"></i> Logout</a> </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="clearfix"> </div>               
                        </div>
                     <div class="clearfix"> </div>  
                </div>
<!--heder end here-->
<!--inner block start here-->
<div class="inner-block">

<div id="mapa">
        <h2>Mapa AP</h2>
    </div>
</div>
</div>

<div class="container">
<div class="row">
  <div class="col-md-3"><br><h3><strong>Ejemplo</strong></h3>
    <ul>Direccion: </ul>
    <ul>Correo: </ul>
    <ul>telefono: </ul>
  </div>
  <div class="col-md-3"><br><h3>Datos Fiscales</h3>
    <ul>RFC: </ul>
    <ul>Razon Social: </ul>
  </div>
  <div class="col-md-3"><br><h3>Estacion en Servicio</h3>
    <ul>Estacion en Servicio. SI</ul>
    <ul>Estacion Activa: SI</ul>
  </div>
  <div class="col-md-3"><br><h3>Imagen</h3>
  </div>
</div>
</div>

<div class="container">
<div class="row">
  <div class="col-md-3"><br><h3>Horarios de la Estacion</h3>
    <ul>Lunes</ul>
    <ul>Martes</ul>
    <ul>Miercoles</ul>
    <ul>Jueves</ul>
    <ul>Viernes</ul>
    <ul>Sabado</ul>
    <ul>Domingo</ul>

  </div>
  <div class="col-md-3"><br><h3>Productos</h3>
    <ul>Producto 1</ul>
    <ul>Producto 2</ul>
    <ul>Producto 3</ul>
    <ul>Producto 4</ul>
    
  </div>
  <div class="col-md-3"><br><h3>Servicios</h3>
    <ul>Servicio de lavado</ul>
    <ul>Servicio de Baño</ul>
    <ul>Wifi gratuito</ul>
  </div>
  <div class="col-md-3"><br><h3>Combustibles Disponibles</h3>
    <ul>Combustible 1</ul>
    <ul>Combustible 2</ul>
    <ul>Combustible 3</ul>
  </div>
</div>
</div>

<!--slide bar menu end here-->
<script>
var toggle = true;
            
$(".sidebar-icon").click(function() {                
  if (toggle)
  {
    $(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
    $("#menu span").css({"position":"absolute"});
  }
  else
  {
    $(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
    setTimeout(function() {
      $("#menu span").css({"position":"relative"});
    }, 400);
  }               
                toggle = !toggle;
            });
</script>
<!--scrolling js-->
        <script src="js/jquery.nicescroll.js"></script>
        <script src="js/scripts.js"></script>
        <!--//scrolling js-->
<script src="js/bootstrap.js"> </script>
<!-- mother grid end here-->
</body>
</html>        