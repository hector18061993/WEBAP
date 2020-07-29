<?php

require_once "config.php";
 
$nombre =  $cx = $cy = $direccion= $telefono= $correo = $activo= $enservicio = $imagen = "";

$nombre_err = $cx_err = $cy_err = $direccion_err = $telefono_err = $correo_err = $activo_err = $enservicio_err = $imagen_err = "";
 
if(isset($_POST["id"]) && !empty($_POST["id"])){
    
    $id = $_POST["id"];
    
    $input_nombre = trim($_POST["nombre"]);
    if(empty($input_nombre)){
        $nombre_err = "favor de ingresar el nuevo nombre de la Estacion.";     
    } else{
        $nombre = $input_nombre;
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
 
    $input_telefono = trim($_POST["telefono"]);
    if(empty($input_telefono)){
        $telefono_err = "Favor de ingresar el nuevo telefono de la Estacion.";     
    } else{
        $telefono = $input_telefono;
    }

     
    $input_correo = trim($_POST["correo"]);
    if(empty($input_correo)){
        $correo_err = "Favor de ingresar el nuevo correo de la Estacion.";     
    } else{
        $correo = $input_correo;
    }

    
    $input_activo = trim($_POST["activo"]);
    if(empty($input_activo)){
        $activo_err = "Favor de ingresar el nuevo estatus de la Estacion.";     
    } else{
        $activo = $input_activo;
    }

    
    $input_enservicio = trim($_POST["enservicio"]);
    if(empty($input_enservicio)){
        $enservicio_err = "Favor de ingresar el nuevo estado actual de la Estacion.";     
    } else{
        $enservicio = $input_enservicio;
    }

    $input_imagen = trim($_POST["imagen"]);
    if(empty($input_imagen)){
        $imagen_err = "Favor de ingresar el nuevo estado actual de la Estacion.";     
    } else{
        $imagen = $input_imagen;
    }


    
    if(empty($nombre_err) && empty($cx_err) && empty($cy_err) && empty($direccion_err) 
                          && empty($telefono_err) && empty($correo_err) && empty($activo_err) && empty($enservicio_err)){

        // Prepare an update statement
        $sql = "UPDATE t_estaciones SET nombre=?, cx=?, cy=?, direccion=?, telefono=?, correo=?, activo=?, enservicio=?, imagen=? WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssssssi", $param_nombre, $param_cx, $param_cy, 
                $param_direccion, $param_telefono, $param_correo, $param_activo, $param_enservicio, $param_imagen, $param_id);
            
            // Set parameters
            $param_nombre = $nombre;
            $param_cx = $cx;
            $param_cy = $cy;
            $param_direccion = $direccion;
            $param_telefono = $telefono;
            $param_correo = $correo;
            $param_activo = $activo;
            $param_enservicio = $enservicio;
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
        
        
        $sql = "SELECT * FROM t_estaciones WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
          
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            
            $param_id = $id;
            
            
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    $nombre = $row["nombre"];
                    $cx = $row["cx"];
                    $cy = $row["cy"];
                    $direccion = $row["direccion"];
                    $telefono = $row["telefono"];
                    $correo = $row["correo"];
                    $activo = $row["activo"];
                    $enservicio = $row["enservicio"];
                    $imagen = $row["imagen"];
                                      
                   
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
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Datos de la Estacion de Servicio</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
    .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
                            <style>
        #mapa{ 
            width: 470px;
            height: 300px;
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
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Actualizar Datos de la Estacion de Servicio</h2>
                    </div>
                    <p>Edite los campos que desee cambiar, posteriormente guarde los cambios.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post" name="formulario" id="formulario">

                        <div class="form-group <?php echo (!empty($nombre_err)) ? 'has-error' : ''; ?>">
                            <label>Nuevo nombre de la Estacion:</label>
                            <input placeholder="NUEVO NOMBRE DE LA ESTACION" type="text" name="nombre" class="form-control" value="<?php echo $nombre; ?>">
                            <span class="help-block"><?php echo $nombre_err;?></span>
                        </div>
                        
                        <div class="form-mapa <?php echo (!empty($ubicacionlatitud_err)) ? 'has-error' : ''; ?>">
                            <label>Ubicacion de la Estacion:</label>
                            <p>Favor de seleccionar la ubicacion en el mapa</p>
                            <div id="mapa" > </div>
                                  <table>
                                    <tr>
                                    <td></td>
                                    <td>
                                    <input type="text" style="display:none" class="form-control" readonly  name="cx" id="cx" autocomplete="off"/></td>
                                    <td></td>
                                    <td>
                                    <input type="text" style="display:none" class="form-control"  readonly name="cy" id="cy" autocomplete="off"/></td>           
                                    </tr>
                                  </table>   
                                  <?php 
                                  ?>
                                  <?php   ?>
                              </div>

                        

                        <div class="form-group <?php echo (!empty($direccion_err)) ? 'has-error' : ''; ?>">
                            <label>Nueva direccion de la Estacion:</label>
                            <input placeholder="NUEVA DIRECCION DE LA ESTACION" type="text" name="direccion" class="form-control" value="<?php echo $direccion; ?>">
                            <span class="help-block"><?php echo $direccion_err;?></span>
                        </div>

                         <div class="form-group <?php echo (!empty($telefono_err)) ? 'has-error' : ''; ?>">
                            <label>Nuevo Telefono de la Estacion:</label>
                            <input placeholder="NUEVO TELEFONO DE LA ESTACION" type="text" name="telefono" class="form-control" value="<?php echo $telefono; ?>">
                            <span class="help-block"><?php echo $telefono_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($correo_err)) ? 'has-error' : ''; ?>">
                            <label>Nuevo correo de la Estacion:</label>
                            <input placeholder="NUEVO CORREO DE LA ESTACION" type="text" name="correo" class="form-control" value="<?php echo $correo; ?>">
                            <span class="help-block"><?php echo $correo_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($activo_err)) ? 'has-error' : ''; ?>">
                            <label>Nuevo estado actual de la Estacion:</label>
                            <p>Favor de colocar si esta activa o inactiva la estacion de servicio</p>
                            <select class="form-control" name="activo" value="<?php echo $activo; ?>">
                                <option>SI</option>
                                <option>NO</option>                            
                            </select>
                            <span class="help-block"><?php echo $activo_err;?></span>
                        </div>   

                        <div class="form-group <?php echo (!empty($enservicio_err)) ? 'has-error' : ''; ?>">
                            <label>Nuevo estado de servicio de la Estacion:</label>
                            <p>Favor de colocar si se encuentra en servicio o no se encuentra en servicio</p>
                            <select class="form-control" name="enservicio" value="<?php echo $enservicio; ?>">
                                <option>SI</option>
                                <option>NO</option>                            
                            </select>
                            <span class="help-block"><?php echo $enservicio_err;?></span>
                        </div>    

                        <div class="form-group <?php echo (!empty($correo_err)) ? 'has-error' : ''; ?>">
                            <label>Imagen la Estacion:</label>
                            <input placeholder="NUEVO CORREO DE LA ESTACION" type="text" name="correo" class="form-control" value="<?php echo $correo; ?>">
                            <span class="help-block"><?php echo $correo_err;?></span>
                        </div>


                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Guardar cambios">
                        <a href="inicioestacion.php" class="btn btn-success">Regresar a la Pantalla Principal</a>
                    </form>
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
                {var sevilla = new google.maps.LatLng( <?php  echo $cx; ?>,<?php echo $cy;?>);
                 var opciones = {
                    zoom : 17,
                    center: sevilla,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                    };
                var div = document.getElementById('mapa');              
                var map = new google.maps.Map(div, opciones);   
                    var marcador = new google.maps.Marker({
                    position: new google.maps.LatLng(<?php echo $cx; ?>,<?php echo $cy;?>),
                    draggable: true,
                    map: map,
                    title: 'algo'});
                var markerLatLng = marcador.getPosition();
                document.getElementById('cx').value = markerLatLng.lat();
                document.getElementById('cy').value = markerLatLng.lng();   
                google.maps.event.addListener(
                marcador, 'dragend', function(){ markerLatLng = marcador.getPosition();
                document.getElementById('cx').value = markerLatLng.lat();
                document.getElementById('cy').value = markerLatLng.lng(); });
            }

        })();
    </script>
