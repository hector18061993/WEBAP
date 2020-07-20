<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM t_estaciones WHERE id = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
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
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: errorpagina.php");
                exit();
            }
            
        } else{
            echo "Oops! A ocurrido un error. Por favor intentelo mas tarde.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: errorpagina.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ver Empleado</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Ver Estaciones</h2>
                    </div>
                    <div class="form-group">
                        <label>Nombre de la Estacion:</label>
                        <p class="form-control-static"><?php echo $row["nombre"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Descripcion:</label>
                        <p class="form-control-static"><?php echo $row["descripcion"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Ubicacion Latitud:</label>
                        <p class="form-control-static"><?php echo $row["cx"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Ubicacion Longitud:</label>
                        <p class="form-control-static"><?php echo $row["cy"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Razon Social:</label>
                        <p class="form-control-static"><?php echo $row["razonsocial"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>RFC:</label>
                        <p class="form-control-static"><?php echo $row["rfc"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Zona:</label>
                        <p class="form-control-static"><?php echo $row["zona"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Supervisor:</label>
                        <p class="form-control-static"><?php echo $row["supervisor"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Prioridad:</label>
                        <p class="form-control-static"><?php echo $row["prioridad"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Direccion:</label>
                        <p class="form-control-static"><?php echo $row["direccion"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Telefono:</label>
                        <p class="form-control-static"><?php echo $row["telefono"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Correo:</label>
                        <p class="form-control-static"><?php echo $row["correo"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Activo:</label>
                        <p class="form-control-static"><?php echo $row["activo"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>En servicio:</label>
                        <p class="form-control-static"><?php echo $row["enservicio"]; ?></p>
                    </div>
                    <p><a href="inicioestacion.php" class="btn btn-warning">Volver a la Pagina Principal</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>