<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$nombre = $descripcion = $cx = $cy = $tipocombustible = $costocombustible = "";
$nombre_err = $descripcion_err = $cx_err = $cy_err = $tipocombustible_err = $costocombustible_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    // Validando el registro de nmombre
    $input_nombre = trim($_POST["nombre"]);
    if(empty($input_nombre)){
        $nombre_err = "Por favor ingrese un nombre de estacion.";     
    } else{
        $nombre = $input_nombre;
    }

    // Validando ubicacion
    $input_descripcion = trim($_POST["descripcion"]);
    if(empty($input_descripcion)){
        $descripcion_err = "Por favor ingrese una ubicacion de la estacion.";     
    } else{
        $descripcion = $input_descripcion;
    }

     
    // Validando gerente en turno
    $input_cx = trim($_POST["cx"]);
    if(empty($input_cx)){
        $cx_err = "Por favor ingrese un gerente en turno actual.";     
    } else{
        $cx = $input_cx;
    }

    // Validando estado actual de la estacion
    $input_cy = trim($_POST["cy"]);
    if(empty($input_cy)){
        $cy_err = "Por favor ingrese un estado actual de la estacion.";     
    } else{
        $cy = $input_cy;
    }

    // Validando precio gasolina magna 
    $input_tipocombustible = trim($_POST["tipocombustible"]);
    if(empty($input_tipocombustible)){
        $tipocombustible_err = "Por favor ingrese un precio de la gasolina magna.";     
    } else{
        $tipocombustible = $input_tipocombustible;
    }

    // Validando costo gasolina premium 
    $input_costocombustible = trim($_POST["costocombustible"]);
    if(empty($input_costocombustible)){
        $costocombustible_err = "Por favor ingrese un costo de la gasolina premium.";     
    } else{
        $costocombustible = $input_costocombustible;
    }

    // Check input errors before inserting in database
    if(empty($nombre_err) && empty($descripcion_err) && empty($cx_err) && empty($cy_err) 
                        && empty($tipocombustible_err) && empty($costocombustible_err)){

        // Prepare an update statement
        $sql = "UPDATE t_estaciones SET nombre=?, descripcion=?, cx=?, cy=?, tipocombustible=?, 
        costocombustible=? WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssi", $param_nombre, $param_descripcion, $param_cx, 
                $param_cy, $param_tipocombustible, $param_costocombustible, $param_id);
            
            // Set parameters
            $param_nombre = $nombre;
            $param_descripcion = $descripcion;
            $param_cx = $cx;
            $param_cy = $cy;
            $param_tipocombustible = $tipocombustible;
            $param_costocombustible = $costocombustible;            
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
                    $tipocombustible = $row["tipocombustible"];
                    $costocombustible = $row["costocombustible"];
                   
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
                    
                        <div class="form-group <?php echo (!empty($tipocombustible_err)) ? 'has-error' : ''; ?>">
                            <label>Tipo de Combustible:</label>
                            <input type="text" name="tipocombustible" class="form-control" value="<?php echo $tipocombustible; ?>">
                            <span class="help-block"><?php echo $tipocombustible_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($costocombustible_err)) ? 'has-error' : ''; ?>">
                            <label>Costo del Combustible:</label>
                            <input type="text" name="costocombustible" class="form-control" value="<?php echo $costocombustible; ?>">
                            <span class="help-block"><?php echo $costocombustible_err;?></span>
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


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1aE0WtuiVtGobAxmOxnlDFAT_c1DM0ZE"type="text/javascript"></script>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
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
