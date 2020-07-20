<?php
// Incluimos nuestro archivo config 
require_once "config.php";
 
// Definimos las variables a utilizar 
$nombre = $descripcion = $costoactual = "";

$nombre_err = $descripcion_err = $costoactual_err  = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validando el campo Nombre(s) 
    $input_nombre = trim($_POST["nombre"]);
    if(empty($input_nombre)){
        $nombre_err = "Favor de ingresar un nombre del Combustible.";     
    } else{
        $nombre = $input_nombre;
    }

     // Validando el campo Nombre(s) 
    $input_descripcion = trim($_POST["descripcion"]);
    if(empty($input_descripcion)){
        $descripcion_err = "Favor de ingresar la descripcion del Combustible.";     
    } else{
        $descripcion = $input_descripcion;
    }


    // Validando el campo Email
    $input_costoactual = trim($_POST["costoactual"]);
    if(empty($input_costoactual)){
        $costoactual_err = "Favor de ingresar el costo del Combustible.";     
    } else{
        $costoactual = $input_costoactual;
    }

     
    // Check input errors before inserting in database
    if(empty($nombre_err) && empty($descripcion_err) && empty($costoactual_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO t_combustible (nombre, descripcion, costoactual) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_nombre, $param_descripcion, $param_costoactual);
            
            // Set parameters
            $param_nombre = $nombre;
            $param_descripcion = $descripcion;
            $param_costoactual = $costoactual;          
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: iniciocombustible.php");
                exit();
            } else{
                echo "Algo salio mal. Intentelo mas tarde.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Agregar Combustibles a Sistema</title>
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
                        <h2>Agregar Registros de Combustibles</h2>
                    </div>
                    <p>Favor de ingresar los nuevos datos del Combustible .</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        
                        <div class="form-group <?php echo (!empty($nombre_err)) ? 'has-error' : ''; ?>">
                            <label>Nombre del Tipo de Combustible:</label>
                            <input placeholder="NOMBRE DEL COMBUSTIBLE" type="text" name="nombre" class="form-control" value="<?php echo $nombre; ?>">
                            <span class="help-block"><?php echo $nombre_err;?></span>
                        </div>
                        
                        <div class="form-group <?php echo (!empty($descripcion_err)) ? 'has-error' : ''; ?>">
                            <label>Descripcion del tipo de Combustible:</label>
                            <input placeholder="DESCRIPCION ACERCA DEL COMBUSTIBLE" type="text" name="descripcion" class="form-control" value="<?php echo $descripcion; ?>">
                            <span class="help-block"><?php echo $descripcion_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($costoactual_err)) ? 'has-error' : ''; ?>">
                            <label>Costo Actual del tipo de Combustible:</label>
                            <input placeholder="COSTO ACTUAL DEL COMBUSTIBLE" type="text" name="costoactual" class="form-control" value="<?php echo $costoactual; ?>">
                            <span class="help-block"><?php echo $costoactual_err;?></span>
                        </div>
                       
                        <input type="submit" class="btn btn-primary" value="Agregar Nuevos Datos de Registro" >
                        <a href="iniciocombustible.php" class="btn btn-success">Regresar a Pantalla Principal</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>