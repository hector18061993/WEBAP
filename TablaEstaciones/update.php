<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$nombre = $descripcion =  $cx = $cy = $razonsocial = $rfc =$zona =$supervisor = $prioridad = $direccion= $telefono= $correo = $activo= $enservicio = 
$idproducto = $idservicio = $idgerente1 = $idgerente2 = $idgerente3 = "";

$nombre_err = $descripcion_err = $cx_err = $cy_err = $razonsocial_err = $rfc_err = $zona_err = $supervisor_err = $prioridad_err = $direccion_err = 
$telefono_err = $correo_err = $activo_err = $enservicio_err = $idproducto_err = $idservicio_err = $idgerente1_err = $idgerente2_err = 
$idgerente3_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    // Validando el campo Nombre(s) 
    $input_nombre = trim($_POST["nombre"]);
    if(empty($input_nombre)){
        $nombre_err = "Por favor ingrese un apellido.";     
    } else{
        $nombre = $input_nombre;
    }

    // Validando el campo Apellido(s)
    $input_descripcion = trim($_POST["descripcion"]);
    if(empty($input_descripcion)){
        $descripcion_err = "Por favor ingrese un apellido.";     
    } else{
        $descripcion = $input_descripcion;
    }

    
    // Validando el campo Email
    $input_cx = trim($_POST["cx"]);
    if(empty($input_cx)){
        $cx_err = "Por favor ingrese un correo electronico.";     
    } else{
        $cx = $input_cx;
    }

    // Validando el campo Telefono
    $input_cy = trim($_POST["cy"]);
    if(empty($input_cy)){
        $cy_err = "Por favor ingrese un numero telefonico.";     
    } else{
        $cy = $input_cy;
    }

    // Validando el campo Tipo de Usuario
    $input_razonsocial = trim($_POST["razonsocial"]);
    if(empty($input_razonsocial)){
        $razonsocial_err = "Por favor ingrese un tipo de usuario.";     
    } else{
        $razonsocial = $input_razonsocial;
    }


    // Validar el campo Usuario
    $input_rfc = trim($_POST["rfc"]);
    if(empty($input_rfc)){
        $rfc_err = "Por favor ingrese un usuario.";     
    } else{
        $rfc = $input_rfc;
    }
    
    // Validar el campo Usuario
    $input_zona = trim($_POST["zona"]);
    if(empty($input_zona)){
        $zona_err = "Por favor ingrese un usuario.";     
    } else{
        $zona = $input_zona;
    }

     // Validar el campo Usuario
    $input_supervisor = trim($_POST["supervisor"]);
    if(empty($input_supervisor)){
        $supervisor_err = "Por favor ingrese un usuario.";     
    } else{
        $supervisor = $input_supervisor;
    }

     // Validar el campo Usuario
    $input_prioridad = trim($_POST["prioridad"]);
    if(empty($input_prioridad)){
        $prioridad_err = "Por favor ingrese un usuario.";     
    } else{
        $prioridad = $input_prioridad;
    }

     // Validar el campo Usuario
    $input_direccion = trim($_POST["direccion"]);
    if(empty($input_direccion)){
        $direccion_err = "Por favor ingrese un usuario.";     
    } else{
        $direccion = $input_direccion;
    }
 // Validar el campo Usuario
    $input_telefono = trim($_POST["telefono"]);
    if(empty($input_telefono)){
        $telefono_err = "Por favor ingrese un usuario.";     
    } else{
        $telefono = $input_telefono;
    }

     // Validar el campo Usuario
    $input_correo = trim($_POST["correo"]);
    if(empty($input_correo)){
        $correo_err = "Por favor ingrese un usuario.";     
    } else{
        $correo = $input_correo;
    }

     // Validar el campo Usuario
    $input_activo = trim($_POST["activo"]);
    if(empty($input_activo)){
        $activo_err = "Por favor ingrese un usuario.";     
    } else{
        $activo = $input_activo;
    }

     // Validar el campo Usuario
    $input_enservicio = trim($_POST["enservicio"]);
    if(empty($input_enservicio)){
        $enservicio_err = "Por favor ingrese un usuario.";     
    } else{
        $enservicio = $input_enservicio;
    }

     // Validar el campo Usuario
    $input_idproducto = trim($_POST["idproducto"]);
    if(empty($input_idproducto)){
        $idproducto_err = "Por favor ingrese un usuario.";     
    } else{
        $idproducto = $input_idproducto;
    }

     // Validar el campo Usuario
    $input_idservicio = trim($_POST["idservicio"]);
    if(empty($input_idservicio)){
        $idservicio_err = "Por favor ingrese un usuario.";     
    } else{
        $idservicio = $input_idservicio;
    }

     // Validar el campo Usuario
    $input_idgerente1 = trim($_POST["idgerente1"]);
    if(empty($input_idgerente1)){
        $idgerente1_err = "Por favor ingrese un usuario.";     
    } else{
        $idgerente1 = $input_idgerente1;
    }

    // Validar el campo Usuario
    $input_idgerente2 = trim($_POST["idgerente2"]);
    if(empty($input_idgerente2)){
        $idgerente2_err = "Por favor ingrese un usuario.";     
    } else{
        $idgerente2 = $input_idgerente2;
    }

    // Validar el campo Usuario
    $input_idgerente3 = trim($_POST["idgerente3"]);
    if(empty($input_idgerente3)){
        $idgerente3_err = "Por favor ingrese un usuario.";     
    } else{
        $idgerente3 = $input_idgerente3;
    } 

    // Check input errors before inserting in database
    if(empty($nombre_err) && empty($descripcion_err)  && empty($cx_err) && empty($cy_err) && empty($razonsocial_err) && empty($rfc_err) 
                          && empty($zona_err) && empty($supervisor_err) && empty($prioridad_err) && empty($direccion_err) && empty($telefono_err) 
                          && empty($correo_err) && empty($activo_err) && empty($enservicio_err) && empty($idproducto_err) && empty($idservicio_err) 
                          && empty($idgerente1_err) && empty($idgerente2_err) && empty($idgerente3_err)){

        // Prepare an update statement
        $sql = "UPDATE t_estaciones SET nombre=?, descripcion=?, cx=?, cy=?, razonsocial=?, rfc=?, zona=?, supervisor=?, prioridad=?, direccion=?, telefono=?, correo=?, activo=?, enservicio=?, idproducto=?, idservicio=?, idgerente1=?, idgerente2=?, idgerente3=? WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssssssssssssssssi", $param_nombre, $param_descripcion, $param_cx, $param_cy, 
                $param_razonsocial, $param_rfc, $param_zona, $param_supervisor, $param_prioridad, $param_direccion, 
                $param_telefono, $param_correo, $param_activo, $param_enservicio, $param_idproducto, $param_idservicio, $param_idgerente1, 
                $param_idgerente2, $param_idgerente3, $param_id);
            
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
            $param_idproducto = $idproducto;
            $param_idservicio = $idservicio;
            $param_idgerente1 = $idgerente1;
            $param_idgerente2 = $idgerente2;
            $param_idgerente3 = $idgerente3;
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: index.php");
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
                    $idproducto = $row["idproducto"];
                    $idservicio = $row["idservicio"];
                    $idgerente1 = $row["idgerente1"];
                    $idgerente2 = $row["idgerente2"];
                    $idgerente3 = $row["idgerente3"];
                    
                   
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
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
        header("location: error.php");
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
                    <p>Agregue la informacion actualizada de la estacion.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post" name="formulario" id="formulario">

                        <div class="form-group <?php echo (!empty($nombre_err)) ? 'has-error' : ''; ?>">
                            <label>Nombre de la Estacion:</label>
                            <input type="text" name="nombre" class="form-control" value="<?php echo $nombre; ?>">
                            <span class="help-block"><?php echo $nombre_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($descripcion_err)) ? 'has-error' : ''; ?>">
                            <label>Descripcion de la Estacion:</label>
                            <input type="text" name="descripcion" class="form-control" value="<?php echo $descripcion; ?>">
                            <span class="help-block"><?php echo $descripcion_err;?></span>
                        </div>

                       <div class="form-mapa <?php echo (!empty($ubicacionlatitud_err)) ? 'has-error' : ''; ?>">
                            
                            <div id="mapa" > </div>
                                  <table>
                                    <tr>
                                    <td>Coordenada X</td>
                                    <td>
                                    <input type="text" class="form-control" readonly  name="cx" id="cx" autocomplete="off"/></td>
                                    <td>Coordenada Y</td>
                                    <td>
                                    <input type="text" class="form-control"  readonly name="cy" id="cy" autocomplete="off"/></td>    
                                    </tr>
                                  </table> 
                        </div>
                    
                        <div class="form-group <?php echo (!empty($razonsocial_err)) ? 'has-error' : ''; ?>">
                            <label> Razon social de la Estacion:</label> 
                            <input type="text" name="razonsocial" class="form-control" value="<?php echo $razonsocial; ?>">
                            <span class="help-block"><?php echo $razonsocial_err;?></span>
                        </div>
                        
                        <div class="form-group <?php echo (!empty($rfc_err)) ? 'has-error' : ''; ?>">
                            <label>RFC de la Estacion:</label>
                            <input type="text" name="rfc" class="form-control" value="<?php echo $rfc; ?>">
                            <span class="help-block"><?php echo $rfc_err;?></span>
                        </div>


                        <div class="form-group <?php echo (!empty($zona_err)) ? 'has-error' : ''; ?>">
                            <label>Zona de la Estacion:</label>
                            <input type="text" name="zona" class="form-control" value="<?php echo $zona; ?>">
                            <span class="help-block"><?php echo $zona_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($supervisor_err)) ? 'has-error' : ''; ?>">
                            <label>Supervisor de la Estacion:</label>
                            <input type="text" name="supervisor" class="form-control" value="<?php echo $supervisor; ?>">
                            <span class="help-block"><?php echo $supervisor_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($prioridad_err)) ? 'has-error' : ''; ?>">
                            <label>Prioridad de la Estacion:</label>
                            <input type="text" name="prioridad" class="form-control" value="<?php echo $prioridad; ?>">
                            <span class="help-block"><?php echo $prioridad_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($direccion_err)) ? 'has-error' : ''; ?>">
                            <label>Direccion de la Estacion:</label>
                            <input type="text" name="direccion" class="form-control" value="<?php echo $direccion; ?>">
                            <span class="help-block"><?php echo $direccion_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($telefono_err)) ? 'has-error' : ''; ?>">
                            <label>Telefono de la Estacion:</label>
                            <input type="text" name="telefono" class="form-control" value="<?php echo $telefono; ?>">
                            <span class="help-block"><?php echo $telefono_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($correo_err)) ? 'has-error' : ''; ?>">
                            <label>Correo de la Estacion:</label>
                            <input type="text" name="correo" class="form-control" value="<?php echo $correo; ?>">
                            <span class="help-block"><?php echo $correo_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($activo_err)) ? 'has-error' : ''; ?>">
                            <label>Estado de la Estacion:</label>
                            <input type="text" name="activo" class="form-control" value="<?php echo $activo; ?>">
                            <span class="help-block"><?php echo $activo_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($enservicio_err)) ? 'has-error' : ''; ?>">
                            <label>Funcionamiento de la Estacion:</label>
                            <input type="text" name="enservicio" class="form-control" value="<?php echo $enservicio; ?>">
                            <span class="help-block"><?php echo $enservicio_err;?></span>
                        </div>
                        
                        <div class="form-group <?php echo (!empty($idproducto_err)) ? 'has-error' : ''; ?>">
                            <label>Id Producto de la Estacion:</label>
                            <input type="text" name="idproducto" class="form-control" value="<?php echo $idproducto; ?>">
                            <span class="help-block"><?php echo $idproducto_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($idservicio_err)) ? 'has-error' : ''; ?>">
                            <label>Id Servicio de la Estacion:</label>
                            <input type="text" name="idservicio" class="form-control" value="<?php echo $idservicio; ?>">
                            <span class="help-block"><?php echo $idservicio_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($idgerente1_err)) ? 'has-error' : ''; ?>">
                            <label>Id Gerente1 :</label>
                            <input type="text" name="idgerente1" class="form-control" value="<?php echo $idgerente1; ?>">
                            <span class="help-block"><?php echo $idgerente1_err;?></span>
                        </div>

                         <div class="form-group <?php echo (!empty($idgerente2_err)) ? 'has-error' : ''; ?>">
                            <label>Id Gerente2 :</label>
                            <input type="text" name="idgerente2" class="form-control" value="<?php echo $idgerente2; ?>">
                            <span class="help-block"><?php echo $idgerente2_err;?></span>
                        </div>


                         <div class="form-group <?php echo (!empty($idgerente3_err)) ? 'has-error' : ''; ?>">
                            <label>Id Gerente3 :</label>
                            <input type="text" name="idgerente3" class="form-control" value="<?php echo $idgerente3; ?>">
                            <span class="help-block"><?php echo $idgerente3_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Enviar">
                        <a href="index.php" class="btn btn-default">Cancelar</a>
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
