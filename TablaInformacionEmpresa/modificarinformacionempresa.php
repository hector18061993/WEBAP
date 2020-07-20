<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$nombre = $descripcion = $subdescripcion = "";
$nombre_err = $descripcion_err = $subdescripcion_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    // Validate name
    $input_nombre = trim($_POST["nombre"]);
    if(empty($input_nombre)){
        $nombre_err = "Favor de ingresar el nuevo nombre de la informacion.";     
    } else{
        $nombre = $input_nombre;
    }
    
    // Validate lastname
    $input_descripcion = trim($_POST["descripcion"]);
    if(empty($input_descripcion)){
        $descripcion_err = "Favor de ingresar la nueva descripcion de la informacion.";     
    } else{
        $descripcion = $input_descripcion;
    }

     
    // Validate email
    $input_subdescripcion = trim($_POST["subdescripcion"]);
    if(empty($input_subdescripcion)){
        $subdescripcion_err = "Dato opcional.";     
    } else{
        $subdescripcion = $input_subdescripcion;
    }
    
    // Check input errors before inserting in database
    if(empty($nombre_err) && empty($descripcion_err)){

        // Prepare an update statement
        $sql = "UPDATE t_informacionempresa SET nombre=?, descripcion=?, subdescripcion=? WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssi", $param_nombre, $param_descripcion, 
                $param_subdescripcion, $param_id);
            
            // Set parameters
            $param_nombre = $nombre;
            $param_descripcion = $descripcion;
            $param_subdescripcion = $subdescripcion;
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: inicioinformacionempresa.php");
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
        $sql = "SELECT * FROM t_informacionempresa WHERE id = ?";
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
                    $subdescripcion = $row["subdescripcion"];
                    
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: errorpagina.php");
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
        header("location: errorpagina.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Datos</title>
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
                        <h2>Actualizar Datos</h2>
                    </div>
                    <p>Edite los datos de entrada y envíe para actualizar el registro de usuarios.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">

                        <div class="form-group <?php echo (!empty($nombre_err)) ? 'has-error' : ''; ?>">
                            <label>Nombre de la Informacion:</label>
                            <input type="text" name="nombre" class="form-control" value="<?php echo $nombre; ?>">
                            <span class="help-block"><?php echo $nombre_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($descripcion_err)) ? 'has-error' : ''; ?>">
                            <label>Descripcion de la Informacion:</label>
                            <textarea name="descripcion" class="form-control"><?php echo $descripcion; ?></textarea>
                            <span class="help-block"><?php echo $descripcion_err;?></span>
                        </div>

                       <div class="form-group <?php echo (!empty($subdescripcion_err)) ? 'has-error' : ''; ?>">
                            <label>Subdescripcion de la Informacion:</label>
                            <p>*Se agrega opcionalmente*</p>
                            <textarea name="subdescripcion" class="form-control"><?php echo $subdescripcion; ?></textarea>
                            <span class="help-block"><?php echo $subdescripcion_err;?></span>
                        </div>

                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Guardar cambios">
                        <a href="inicioinformacionempresa.php" class="btn btn-success">Regresar a Pantalla Principal</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>