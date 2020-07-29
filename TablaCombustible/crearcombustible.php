<?php
// Incluimos nuestro archivo config 
require_once "config.php";
 
// Definimos las variables a utilizar 
$nombre =  $costoactual =  $imagen = "";

$nombre_err = $costoactual_err = $imagen_err  = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validando el campo Nombre(s) 
    $input_nombre = trim($_POST["nombre"]);
    if(empty($input_nombre)){
        $nombre_err = "Favor de ingresar un nombre del Combustible.";     
    } else{
        $nombre = $input_nombre;
    }

    // Validando el campo Email
    $input_costoactual = trim($_POST["costoactual"]);
    if(empty($input_costoactual)){
        $costoactual_err = "Favor de ingresar el costo del Combustible.";     
    } else{
        $costoactual = $input_costoactual;
    }

    $input_imagen = trim($_POST["imagen"]);
    if(empty($input_imagen)){
        $imagen_err = "Favor de ingresar la imagen del Combustible.";     
    } else{
        $imagen = $input_imagen;
    }

     
    // Check input errors before inserting in database
    if(empty($nombre_err) && empty($costoactual_err) && empty($imagen_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO t_combustible (nombre, costoactual, imagen) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_nombre, $param_costoactual, $param_imagen);
            
            // Set parameters
            $param_nombre = $nombre;
            $param_costoactual = $costoactual;          
            $param_imagen = $imagen;
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
                        
                        <div class="form-group <?php echo (!empty($costoactual_err)) ? 'has-error' : ''; ?>">
                            <label>Costo Actual del tipo de Combustible:</label>
                            <form class="form-inline">
                            <div class="form-group">
                            <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                            <div class="input-group">
                            <div class="input-group-addon">$</div>
                            <input type="text" name="costoactual" class="form-control" id="exampleInputAmount" placeholder="COSTO DEL COMBUSTIBLE" value="<?php echo $costoactual; ?>">
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


                        <input type="submit" class="btn btn-primary" value="Agregar Nuevos Datos de Registro" >
                        <a href="iniciocombustible.php" class="btn btn-success">Regresar a Pantalla Principal</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>