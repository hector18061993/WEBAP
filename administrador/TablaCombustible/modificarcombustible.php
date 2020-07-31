<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$nombre =  $costoactual  =  $imagen = "";
$nombre_err = $costoactual_err = $imagen_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    // Validate name
    $input_nombre = trim($_POST["nombre"]);
    if(empty($input_nombre)){
        $nombre_err = "Favor de ingresar el nuevo nombre del Combustible.";     
    } else{
        $nombre = $input_nombre;
    }

    // Validate email
    $input_costoactual = trim($_POST["costoactual"]);
    if(empty($input_costoactual)){
        $costoactual_err = "Favor de ingresar el nuevo costo del Combustible.";     
    } else{
        $costoactual = $input_costoactual;
    }

    $input_imagen = trim($_POST["imagen"]);
    if(empty($input_imagen)){
        $imagen_err = "Favor de ingresar la imagen de la Estacion.";     
    } else{
        $imagen = $input_imagen;
    }

    // Check input errors before inserting in database
    if(empty($nombre_err) && empty($costoactual_err)  && empty($imagen_err)){

        // Prepare an update statement
        $sql = "UPDATE t_combustible SET nombre=?, costoactual=?, imagen=? WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssi", $param_nombre, 
                $param_costoactual, $param_id);
            
            // Set parameters
            $param_nombre = $nombre;
            $param_costoactual = $costoactual;
            $param_imagen = $imagen;
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: iniciocombustible.php");
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
        $sql = "SELECT * FROM t_combustible WHERE id = ?";
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
                    $costoactual = $row["costoactual"];
                    
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