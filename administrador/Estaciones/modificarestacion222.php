<?php

require_once "config.php";
 
$nombre =  $lat = $lng = $direccion=  "";

$nombre_err = $lat_err = $lng_err = $direccion_err = "";
 
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
 
       
    if(empty($nombre_err) && empty($lat_err) && empty($lng_err) && empty($direccion_err)){

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
                    
                    $nombre = $row["nombre"];
                    $lat = $row["lat"];
                    $lng = $row["lng"];
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
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<link href="../cssmapa/bootstrap.min.css" rel="stylesheet" />
<!-- Custom Theme files -->
<link href="../css/style.css" rel="stylesheet" type="text/css" media="all"/>
<!--icons-css-->
<link href="../css/font-awesome.css" rel="stylesheet"> 
<!--Google Fonts-->
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-2.0.3.min.js" ></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1aE0WtuiVtGobAxmOxnlDFAT_c1DM0ZE"type="text/javascript"></script>

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
                        <h2><p class="form-control-static"><?php echo $row["titulo"]; ?></p></h2>
                        </div>                       

                        <div class="form-group <?php echo (!empty($direccion_err)) ? 'has-error' : ''; ?>">
                            <label>Direccion:</label>
                            <p class="form-control-static"><?php echo $row["direccion"]; ?></p>
                            <span class="help-block"><?php echo $direccion_err;?></span>
                        </div>

                    </div>
                    <div class="col-md-3">
                     <div class="form-group <?php echo (!empty($direccion_err)) ? 'has-error' : ''; ?>">
                            <label>Telefono:</label>
                            <p class="form-control-static"><?php echo $row["telefono"]; ?></p>
                            <span class="help-block"><?php echo $direccion_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($direccion_err)) ? 'has-error' : ''; ?>">
                            <label>Correo:</label>
                            <p class="form-control-static"><?php echo $row["correo"]; ?></p>
                            <span class="help-block"><?php echo $direccion_err;?></span>
                        </div>



                    </div>

                    <div class="col-md-3">
                    <div class="form-group <?php echo (!empty($direccion_err)) ? 'has-error' : ''; ?>">
                            <label>Servicios:</label>
                            <p class="form-control-static"><?php echo $row["servicios"]; ?></p>
                            <span class="help-block"><?php echo $direccion_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($direccion_err)) ? 'has-error' : ''; ?>">
                            <label>Horario:</label>
                            <p class="form-control-static"><?php echo $row["horarios"]; ?></p>
                            <span class="help-block"><?php echo $direccion_err;?></span>
                        </div>

                    </div>

                    <div class="col-md-3">
                    <div class="form-group <?php echo (!empty($direccion_err)) ? 'has-error' : ''; ?>">
                            <label>Combustibles:</label>
                            <p class="form-control-static"><?php echo $row["combustibles"]; ?></p>
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

    <script type="text/javascript">
        (function() { // generacion de mapa
            window.onload = function()
                {var sevilla = new google.maps.LatLng( <?php  echo $lat; ?>,<?php echo $lng;?>);
                 var opciones = {
                    zoom : 17,
                    center: sevilla,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                    };


                var div = document.getElementById('mapa');              
                var map = new google.maps.Map(div, opciones);   
                    var marcador = new google.maps.Marker({
                    position: new google.maps.LatLng(<?php echo $lat; ?>,<?php echo $lng;?>),
                    draggable: false,
                    map: map,
                    title: 'algo'});

                    
                var markerLatLng = marcador.getPosition();
                document.getElementById('lat').value = markerLatLng.lat();
                document.getElementById('lng').value = markerLatLng.lng();   
                google.maps.event.addListener(
                marcador, 'dragend', function(){ markerLatLng = marcador.getPosition();
                document.getElementById('lat').value = markerLatLng.lat();
                document.getElementById('lng').value = markerLatLng.lng(); });
            }

        })();
    </script>





























     
                              











