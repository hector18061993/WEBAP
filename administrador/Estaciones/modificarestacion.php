<?php

require_once "config.php";
 
$nombre =  $lat = $lng = $direccion= $telefono = $email = $activo = $servicio = $razonsocial = $rfc = $imagen = "";

$nombre_err = $lat_err = $lng_err = $direccion_err = $telefono_err = $email_err = $activo_err = $servicio_err = $razonsocial_err = $rfc_err = $imagen_err ="";
 
if(isset($_POST["id"]) && !empty($_POST["id"])){
    
    $id = $_POST["id"];
    
    $input_nombre = trim($_POST["nombre"]);
    if(empty($input_nombre)){
        $nombre_err = "favor de ingresar el nuevo nombre de la Estacion.";     
    } else{
        $nombre = $input_nombre;
    }

    $input_lat = trim($_POST["lat"]);
    if(empty($input_lat)){
        $lat_err = "Favor de ingresar la nueva ubicacion de la Estacion.";     
    } else{
        $lat = $input_lat;
    }

    $input_lng = trim($_POST["lng"]);
    if(empty($input_lng)){
        $lng_err = "Favor de ingresar la nueva ubicacion de la Estacion.";     
    } else{
        $lng = $input_lng;
    }

    
    $input_direccion = trim($_POST["direccion"]);
    if(empty($input_direccion)){
        $direccion_err = "Favor de ingresar la nueva direccion de la Estacion.";     
    } else{
        $direccion = $input_direccion;
    }

    $input_telefono = trim($_POST["telefono"]);
    if(empty($input_telefono)){
        $telefono_err = "Favor de ingresar la nueva direccion de la Estacion.";     
    } else{
        $telefono = $input_telefono;
    }

    $input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = "Favor de ingresar la nueva direccion de la Estacion.";     
    } else{
        $email = $input_email;
    }

    $input_activo = trim($_POST["activo"]);
    if(empty($input_activo)){
        $activo_err = "Favor de ingresar la nueva direccion de la Estacion.";     
    } else{
        $activo = $input_activo;
    }

    $input_servicio = trim($_POST["servicio"]);
    if(empty($input_servicio)){
        $servicio_err = "Favor de ingresar la nueva direccion de la Estacion.";     
    } else{
        $servicio = $input_servicio;
    }

    $input_razonsocial = trim($_POST["razonsocial"]);
    if(empty($input_razonsocial)){
        $razonsocial_err = "Favor de ingresar la nueva direccion de la Estacion.";     
    } else{
        $razonsocial = $input_razonsocial;
    }

    $input_rfc = trim($_POST["rfc"]);
    if(empty($input_rfc)){
        $rfc_err = "Favor de ingresar la nueva direccion de la Estacion.";     
    } else{
        $rfc = $input_rfc;
    }

    $input_imagen = trim($_POST["imagen"]);
    if(empty($input_imagen)){
        $imagen_err = "Favor de ingresar la nueva direccion de la Estacion.";     
    } else{
        $imagen = $input_imagen;
    }


 
       
    if(empty($nombre_err) && empty($lat_err) && empty($lng_err) && empty($direccion_err) && empty($telefono_err)
        && empty($email_err) && empty($activo_err) && empty($servicio_err) && empty($razonsocial_err) 
        && empty($rfc_err) && empty($imagen_err)){

        // Prepare an update statement
        $sql = "UPDATE estacion SET nombre=?, lat=?, lng=?, direccion=? WHERE idestacion=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssi", $param_nombre, $param_lat, $param_lng, 
                $param_direccion, $param_id);
            
            // Set parameters
            $param_nombre = $nombre;
            $param_lat = $lat;
            $param_lng = $lng;
            $param_direccion = $direccion;
            $param_telefono = $telefono;
            $param_email = $email;
            $param_activo = $activo;
            $param_servicio = $servicio;
            $param_razonsocial = $razonsocial;
            $param_rfc = $rfc;
            $param_imagen = $imagen;
            $param_id = $id;
            
            if(mysqli_stmt_execute($stmt)){
                
                header("location: inicioestacion.php");
                exit();
            } else{
                echo "Ocurrio un error. Intentelo mas tarde.";
            }
        }
         
        mysqli_stmt_close($stmt);
    }
    
    
    mysqli_close($link);
} else{
    
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        
        $id =  trim($_GET["id"]);
        
        
        $sql = "SELECT * FROM estacion WHERE idestacion = ?";
        if($stmt = mysqli_prepare($link, $sql)){
          
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            
            $param_id = $id;
            
            
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                   $param_nombre = $nombre;
                   $param_lat = $lat;
                   $param_lng = $lng;
                   $param_direccion = $direccion;
                   $param_telefono = $telefono;
                   $param_email = $email;
                   $param_activo = $activo;
                   $param_servicio = $servicio;
                   $param_razonsocial = $razonsocial;
                   $param_rfc = $rfc;
                   $param_imagen = $imagen;
                   $param_id = $id;
            
                                                          
                   
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
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<link href="../cssmapa/bootstrap.min.css" rel="stylesheet" />
<!-- Custom Theme files -->
<link href="../css/style.css" rel="stylesheet" type="text/css" media="all"/>
<!--icons-css-->
<link href="../css/font-awesome.css" rel="stylesheet"> 
<!--Google Fonts-->
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-2.0.3.min.js" ></script>

<script src="https://aps.googleapi.com/maps/api/js?key=AIzaSyA1aE0WtuiVtGobAxmOxnlDFAT_c1DM0ZE"type="text/javascript"></script>

<!--ARCHIVOS JAVASCRIPT DE BOOTSTRAP -->
<script type="text/javascript" src="../jsmapa/bootstrap.min.js" ></script>

    <style type="text/css">
    .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
                            <style>
        #mapa{ 
            width: 1350px;
            height: 350px;
            float: left;
            background: #CCC ;
        }
        #infor{
            width: 800px;
            height: 50px;
            float: left;
        }
        .titulo {
    background-color: #F5F5F5;
    letter-spacing: normal;
    word-spacing: normal;
    margin: 10px;
    padding: 5px;
    border-radius:10px;
    alignment-adjust:central;
}
.titulo:hover{
    opacity: .9;
    background-color: #E5E5E5;}
    
.barra {
    background-color: #90C;
    border-radius:10px;
    text-align:right;
    color:#FFF;
    padding:10px;
    font-size:16px;
}
    #art-main .art-sheet.clearfix .art-layout-wrapper .art-content-layout .art-content-layout-row .art-layout-cell.art-content .art-post.art-article .art-postcontent.art-postcontent-0.clearfix .art-content-layout .art-content-layout-row .art-layout-cell.layout-item-0 #formulario table tr td div {
    font-weight: bold;
}
 </style>

</head>
<body>

<body>  
<div class="page-container">    
                <div class="header-main">
                    <div class="header-left">
                            <div class="logo-name">
                                     <a href="index.html"> <h1>Estaciones</h1> 
                                    <!--<img id="logo" src="" alt="Logo"/>--> 
                                  </a>                              
                            </div>
                            <div class="clearfix"> </div>
                         </div>
                         <div class="header-right">
                            <div class="profile_details_left"><!--notifications of menu start -->
                                <ul class="nofitications-dropdown"> 

                                <a href="../vistas/home.php"><i class="fa fa-home"></i><span></span></span></a>
                                

                                <ul class="nofitications-dropdown">
                                    <li class="dropdown head-dpdn">
                                        
                                        <ul class="dropdown-menu">
                                            <li>
                                               
                                            </li>
                                            <li><a href="#">
                                               <div class="user_img"><img src="images/p4.png" alt=""></div>
                                              
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
                                                    
                                                </div> 
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="dropdown head-dpdn">
                                        
                                        <ul class="dropdown-menu">
                                            
                                        </ul>
                                    </li>   
                                    <li class="dropdown head-dpdn">
                                       
                                        <ul class="dropdown-menu">
                                            <li>
                                                <div class="notification_header">
                                                  
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
                                                    <span class="task-desc"></span><span class="percentage">90%</span>
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

     <div class="col-xs-12 col-sm-6 col-md-8">

    <div id="mapa" > 
            </div>
        </div>
    </div>
</div>
        <div class="col-md-12">
                    
        <br><br>
        <div class="col-md-12">
        <div class="col-md-3">
        <div class="form-group <?php echo (!empty($titulo_err)) ? 'has-error' : ''; ?>">
            <h2><p class="form-control-static"><?php echo $row["nombre"]; ?></p></h2>
            </div>                       

            <div class="form-group <?php echo (!empty($direccion_err)) ? 'has-error' : ''; ?>">
                <label>Direccion:</label>
                <p class="form-control-static"><?php echo $row["direccion"]; ?></p>
                <span class="help-block"><?php echo $direccion_err;?></span>
            </div>

            </div>
            <div class="col-md-3">
            <div class="form-group <?php echo (!empty($telefono_err)) ? 'has-error' : ''; ?>">
                <label>Telefono:</label>
                <p class="form-control-static"><?php echo $row["telefono"]; ?></p>
                <span class="help-block"><?php echo $telefono_err;?></span>
            </div>

            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Correo:</label>
                <p class="form-control-static"><?php echo $row["email"]; ?></p>
                <span class="help-block"><?php echo $email_err;?></span>
            </div>


            </div>
            <div class="col-md-3">
            <div class="form-group <?php echo (!empty($activo_err)) ? 'has-error' : ''; ?>">
                <label>Activo:</label>
                <p class="form-control-static"><?php echo $row["activo"]; ?></p>
                <span class="help-block"><?php echo $activo_err;?></span>
                </div>


            <div class="form-group <?php echo (!empty($servicio_err)) ? 'has-error' : ''; ?>">
                    <label>Servicio:</label>
                    <p class="form-control-static"><?php echo $row["servicio"]; ?></p>
                    <span class="help-block"><?php echo $direccion_err;?></span>
                </div>
            </div>


                    <div class="col-md-3">
                    <div class="form-group <?php echo (!empty($razonsocial_err)) ? 'has-error' : ''; ?>">
                            <label>Razon Social:</label>
                            <p class="form-control-static"><?php echo $row["razonsocial"]; ?></p>
                            <span class="help-block"><?php echo $direccion_err;?></span>
                        </div>
                    </div>

                    <div class="col-md-3">
                    <div class="form-group <?php echo (!empty($rfc_err)) ? 'has-error' : ''; ?>">
                            <label>R F C:</label>
                            <p class="form-control-static"><?php echo $row["rfc"]; ?></p>
                            <span class="help-block"><?php echo $direccion_err;?></span>
                        </div>
                    </div>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>


<!--IMPORTANTE RESPETAR EL ORDEN -->

<link href="css/bootstrap.min.css" rel="stylesheet" /> 

<script type="text/javascript" src="http://code.jquery.com/jquery-2.0.3.min.js" ></script>

<script type="text/javascript" src="js/bootstrap.min.js" ></script>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"> </script>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1aE0WtuiVtGobAxmOxnlDFAT_c1DM0ZE"type="text/javascript"></script>

   <script>
    //VARIABLES GENERALES
        //declaras fuera del ready de jquery
    var nuevos_marcadores = [];
    var marcadores_bd= [];
    var mapa = null; //VARIABLE GENERAL PARA EL MAPA
    //FUNCION PARA QUITAR MARCADORES DE MAPA
    function limpiar_marcadores(lista)
    {
      
    }
    $(document).on("ready", function(){
        
        
        var punto = new google.maps.LatLng(19.163622,-99.545926);
        var config = {
            zoom:9,
            center:punto,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        mapa = new google.maps.Map( $("#mapa")[0], config );

        google.maps.event.addListener(mapa, function(event){
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
               draggable:true
           });
           //VIDEO 15
           $("#collapseOne").collapse('show');
           $("#collapseTwo").collapse('hide');
           //ALMACENAR UN MARCADOR EN EL ARRAY nuevos_marcadores
           nuevos_marcadores.push(marcador);
           
           google.maps.event.addListener(marcador, "click", function(){

           });
           
           //BORRAR MARCADORES NUEVOS
           //limpiar_marcadores(nuevos_marcadores);
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
                            var posi = new google.maps.LatLng(item.<?php echo "lat"; ?>, item.<?php echo "lng"; ?>);//bien
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
                                    marca.setOptions({draggable: false});

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
        </script>



