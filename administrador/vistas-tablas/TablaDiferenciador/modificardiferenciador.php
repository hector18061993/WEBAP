<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$imagen =  $descripcion  =  $liga = "";
$imagen_err = $descripcion_err = $liga_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["iddiferenciador"]) && !empty($_POST["iddiferenciador"])){
    // Get hidden input value
    $id = $_POST["iddiferenciador"];
    
    // Validate name
    $input_imagen = trim($_POST["imagen"]);
    if(empty($input_imagen)){
        $imagen_err = "Favor de ingresar la imagen del diferenciador.";     
    } else{
        $imagen = $input_imagen;
    }

    // Validate email
    $input_descripcion = trim($_POST["descripcion"]);
    if(empty($input_descripcion)){
        $descripcion_err = "Favor de ingresar la descripcion del diferenciador.";     
    } else{
        $descripcion = $input_descripcion;
    }

    $input_liga = trim($_POST["liga"]);
    if(empty($input_liga)){
        $liga_err = "Favor de ingresar la liga del diferenciador.";     
    } else{
        $liga = $input_liga;
    }

    // Check input errors before inserting in database
    if(empty($imagen_err) && empty($descripcion_err)  && empty($liga_err)){

        // Prepare an update statement
        $sql = "UPDATE diferenciador SET imagen=?, descripcion=?, liga=? WHERE iddiferenciador=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssi", $param_imagen, 
                $param_descripcion, $param_liga, $param_id);
            
            // Set parameters
            $param_imagen = $imagen;
            $param_descripcion = $descripcion;
            $param_liga = $liga;
            $param_iddiferenciador = $iddiferenciador;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: iniciodiferenciador.php");
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
    if(isset($_GET["iddiferenciador"]) && !empty(trim($_GET["iddiferenciador"]))){
        // Get URL parameter
        $iddiferenciador =  trim($_GET["iddiferenciador"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM diferenciador WHERE iddiferenciador = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_iddiferenciador);
            
            // Set parameters
            $param_iddiferenciador = $iddiferenciador;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $imagen = $row["imagen"];
                    $descripcion = $row["descripcion"];
                    
                    
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: errorcombustible.php");
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
        header("location: errorcombustible.php");
        exit();
    }
}
?>

 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Datos del Combustible</title>
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
                        <h2>Actualizar Datos del Combustible</h2>
                    </div>
                    <p>Edite los campos que desee cambiar, posteriormente guarde los cambios.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">

                        <div class="form-group <?php echo (!empty($nombre_err)) ? 'has-error' : ''; ?>">
                            <label>Nuevo nombre del Tipo de Combustible:</label>
                            <input placeholder="NUEVO NOMBRE DEL COMBUSTIBLE" type="text" name="nombre" class="form-control" value="<?php echo $nombre; ?>">
                            <span class="help-block"><?php echo $nombre_err;?></span>
                        </div>

                        
                       <div class="form-group <?php echo (!empty($costoactual_err)) ? 'has-error' : ''; ?>">
                            <label>Nuevo costo Actual del tipo de Combustible:</label>
                            <form class="form-inline">
                            <div class="form-group">
                            <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                            <div class="input-group">
                            <div class="input-group-addon">$</div>
                            <input type="text" name="costoactual" class="form-control" id="exampleInputAmount" placeholder="NUEVO COSTO DEL COMBUSTIBLE" value="<?php echo $costoactual; ?>">
                            <span class="help-block"><?php echo $costoactual_err;?></span>
                            </div>

                            <br>

                        <div class="form-group <?php echo (!empty($imagen_err)) ? 'has-error' : ''; ?>">
                        <form action="../../form-result.php" method="post" enctype="multipart/form-data" target="_blank">
                        <label>Agregar imagen del combustible:</label>
                        <p>Solo se aceptan formatos de imagen</p>
                        <input type="file" name="imagen" accept="image/png, .jpeg, .jpg, image/gif" value="<?php echo $imagen; ?>">
                        </p></form>
                        <span class="help-block"><?php echo $imagen_err;?></span>
                        </div>



                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Actualizar los datos del registro">
                        <a href="iniciocombustible.php" class="btn btn-success">Regresar a Pantalla Principal</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>