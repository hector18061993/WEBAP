<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
// Definimos las variables a utilizar 
$nombre = $descripcion =  $cx = $cy = $razonsocial = $rfc =$zona =$supervisor = $prioridad = $direccion= $telefono= $correo = $activo= 
$enservicio = "";

$nombre_err = $descripcion_err = $cx_err = $cy_err = $razonsocial_err = $rfc_err = $zona_err = $supervisor_err = $prioridad_err = $direccion_err = $telefono_err = $correo_err = $activo_err = $enservicio_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    // Validando el campo Nombre(s) 
    $input_nombre = trim($_POST["nombre"]);
    if(empty($input_nombre)){
        $nombre_err = "favor de ingresar el nuevo nombre de la Estacion.";     
    } else{
        $nombre = $input_nombre;
    }

    // Validando el campo Apellido(s)
    $input_descripcion = trim($_POST["descripcion"]);
    if(empty($input_descripcion)){
        $descripcion_err = "Favor de ingresar la nueva descripcion de la Estacion.";     
    } else{
        $descripcion = $input_descripcion;
    }

    
    // Validando el campo Email
    $input_cx = trim($_POST["cx"]);
    if(empty($input_cx)){
        $cx_err = "Favor de ingresar la nueva ubicacion de la Estacion.";     
    } else{
        $cx = $input_cx;
    }

    // Validando el campo Telefono
    $input_cy = trim($_POST["cy"]);
    if(empty($input_cy)){
        $cy_err = "Favor de ingresar la nueva ubicacion de la Estacion.";     
    } else{
        $cy = $input_cy;
    }

    // Validando el campo Tipo de Usuario
    $input_razonsocial = trim($_POST["razonsocial"]);
    if(empty($input_razonsocial)){
        $razonsocial_err = "Favor de ingresar la nueva razon social de la Estacion.";     
    } else{
        $razonsocial = $input_razonsocial;
    }


    // Validar el campo Usuario
    $input_rfc = trim($_POST["rfc"]);
    if(empty($input_rfc)){
        $rfc_err = "Favor de ingresar el nuevo RFC de la Estacion.";     
    } else{
        $rfc = $input_rfc;
    }
    
    // Validar el campo Usuario
    $input_zona = trim($_POST["zona"]);
    if(empty($input_zona)){
        $zona_err = "Favor de ingresar la nueva zona de la Estacion.";     
    } else{
        $zona = $input_zona;
    }

     // Validar el campo Usuario
    $input_supervisor = trim($_POST["supervisor"]);
    if(empty($input_supervisor)){
        $supervisor_err = "Favor de ingresar el nuevo supervisor de la Estacion.";     
    } else{
        $supervisor = $input_supervisor;
    }

     // Validar el campo Usuario
    $input_prioridad = trim($_POST["prioridad"]);
    if(empty($input_prioridad)){
        $prioridad_err = "Favor de ingresar la nueva prioridad de la Estacion.";     
    } else{
        $prioridad = $input_prioridad;
    }

     // Validar el campo Usuario
    $input_direccion = trim($_POST["direccion"]);
    if(empty($input_direccion)){
        $direccion_err = "Favor de ingresar la nueva direccion de la Estacion.";     
    } else{
        $direccion = $input_direccion;
    }
 // Validar el campo Usuario
    $input_telefono = trim($_POST["telefono"]);
    if(empty($input_telefono)){
        $telefono_err = "Favor de ingresar el nuevo telefono de la Estacion.";     
    } else{
        $telefono = $input_telefono;
    }

     // Validar el campo Usuario
    $input_correo = trim($_POST["correo"]);
    if(empty($input_correo)){
        $correo_err = "Favor de ingresar el nuevo correo de la Estacion.";     
    } else{
        $correo = $input_correo;
    }

     // Validar el campo Usuario
    $input_activo = trim($_POST["activo"]);
    if(empty($input_activo)){
        $activo_err = "Favor de ingresar el nuevo estatus de la Estacion.";     
    } else{
        $activo = $input_activo;
    }

     // Validar el campo Usuario
    $input_enservicio = trim($_POST["enservicio"]);
    if(empty($input_enservicio)){
        $enservicio_err = "Favor de ingresar el nuevo estado actual de la Estacion.";     
    } else{
        $enservicio = $input_enservicio;
    }

    
    // Check input errors before inserting in database
     if(empty($nombre_err) && empty($descripcion_err)  && empty($cx_err) && empty($cy_err) && empty($razonsocial_err) && empty($rfc_err) 
                          && empty($zona_err) && empty($supervisor_err) && empty($prioridad_err) && empty($direccion_err) && empty($telefono_err)           && empty($correo_err) && empty($activo_err) && empty($enservicio_err)){

        // Prepare an update statement
        $sql = "UPDATE t_estaciones SET nombre=?, descripcion=?, cx=?, cy=?, razonsocial=?, rfc=?, zona=?, supervisor=?, prioridad=?, direccion=?, telefono=?, correo=?, activo=?, enservicio=? WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssssssssssi", $param_nombre, $param_descripcion, $param_cx, $param_cy, 
                $param_razonsocial, $param_rfc, $param_zona, $param_supervisor, $param_prioridad, $param_direccion, 
                $param_telefono, $param_correo, $param_activo, $param_enservicio, $param_id);
            
            // Set parameters
            $param_nombre = $nombre;
            $param_descripcion = $descripcion;
            $param_cx = $cx;
            $param_cy = $cy;
            $param_razonsocial = $razonsocial;
            $param_rfc = $rfc;
            $param_zona = $zona;
            $param_supervisor = $supervisor;
            $param_prioridad = $prioridad;
            $param_direccion = $direccion;
            $param_telefono = $telefono;
            $param_correo = $correo;
            $param_activo = $activo;
            $param_enservicio = $enservicio;
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: inicioe.php");
                exit();
            } else{
                echo "Ocurrio un error. Intentelo mas tarde.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM t_estaciones WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $nombre = $row["nombre"];
                    $descripcion = $row["descripcion"];
                    $cx = $row["cx"];
                    $cy = $row["cy"];
                    $razonsocial = $row["razonsocial"];
                    $rfc = $row["rfc"];
                    $zona = $row["zona"];
                    $supervisor = $row["supervisor"];
                    $prioridad = $row["prioridad"];
                    $direccion = $row["direccion"];
                    $telefono = $row["telefono"];
                    $correo = $row["correo"];
                    $activo = $row["activo"];
                    $enservicio = $row["enservicio"];
                                      
                   
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: errore.php");
                    exit();
                }
                
            } else{
                echo "Oops! Ocurrio un error. Porfavor intentelo mas tarde.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($link);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: errore.php");
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
                        
                        <div class="form-group <?php echo (!empty($descripcion_err)) ? 'has-error' : ''; ?>">
                            <label>Nueva descripcion de la Estacion:</label>
                            <textarea name="descripcion" class="form-control"><?php echo $descripcion; ?></textarea>
                            <span class="help-block"><?php echo $descripcion_err;?></span>
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

                        <div class="form-group <?php echo (!empty($razonsocial_err)) ? 'has-error' : ''; ?>">
                            <label>Nueva razon Social de la Estacion:</label>
                            <input placeholder="NUEVA RAZON SOCIAL DE LA ESTACION" type="text" name="razonsocial" class="form-control" value="<?php echo $razonsocial; ?>">
                            <span class="help-block"><?php echo $razonsocial_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($rfc_err)) ? 'has-error' : ''; ?>">
                            <label>Nuevo RFC de la Estacion:</label>
                            <input placeholder="NUEVO RFC DE LA ESTACION" type="text" name="rfc" class="form-control" value="<?php echo $rfc; ?>">
                            <span class="help-block"><?php echo $rfc_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($zona_err)) ? 'has-error' : ''; ?>">
                            <label>Nueva Zona de la Estacion:</label>
                            <input placeholder="NUEVA ZONA DE LA ESTACION" type="text" name="zona" class="form-control" value="<?php echo $zona; ?>">
                            <span class="help-block"><?php echo $zona_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($supervisor_err)) ? 'has-error' : ''; ?>">
                            <label>Nuevo supervisor de la Estacion:</label>
                            <select class="form-control" name="supervisor" value="<?php echo $supervisor; ?>">
                                <option>SI</option>
                                <option>NO</option>                            
                            </select>
                            <span class="help-block"><?php echo $supervisor_err;?></span>
                        </div>  

                        <div class="form-group <?php echo (!empty($prioridad_err)) ? 'has-error' : ''; ?>">
                            <label>Nueva prioridad de la Estacion:</label>
                            <input placeholder="NUEVA PRIORIDAD DE LA ESTACION" type="text" name="prioridad" class="form-control" value="<?php echo $prioridad; ?>">
                            <span class="help-block"><?php echo $prioridad_err;?></span>
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


                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Guardar cambios">
                        <a href="inicioe.php" class="btn btn-success">Regresar a la Pantalla Principal</a>
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
