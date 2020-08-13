<?php
// Incluimos nuestro archivo config 
require_once "config.php";
 
// Definimos las variables a utilizar 
$nombre = $imagen = $costo = $idestacion= "";

$nombre_err = $imagen_err = $costo_err = $idestacion_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validando el campo Nombre(s) 
    $input_nombre = trim($_POST["nombre"]);
    if(empty($input_nombre)){
        $nombre_err = "Favor de ingresar un nombre del Combustible.";     
    } else{
        $nombre = $input_nombre;
    }


    $input_imagen = trim($_POST["imagen"]);
    if(empty($input_imagen)){
        $imagen_err = "Favor de ingresar la imagen del Combustible.";     
    } else{
        $imagen = $input_imagen;
    }


    // Validando el campo Email
    $input_costo = trim($_POST["costo"]);
    if(empty($input_costo)){
        $costo_err = "Favor de ingresar el costo del Combustible.";     
    } else{
        $costo = $input_costo;
    }


    $input_idestacion = trim($_POST["idestacion"]);
    if(empty($input_idestacion)){
        $idestacion_err = "Favor de ingresar el costo del Combustible.";     
    } else{
        $idestacion = $input_idestacion;
    }

    

     
    // Check input errors before inserting in database
    if(empty($nombre_err) && empty($imagen_err) && empty($costo_err) && empty($idestacion_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO combustible (nombre, imagen, costo, idestacion) VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_nombre, $param_imagen, $param_costo, $param_idestacion);
            
            // Set parameters
            $param_nombre = $nombre;
            $param_imagen = $imagen;
            $param_costo = $costo; 
            $param_idestacion = $idestacion; 
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
                        
                        <div class="form-group <?php echo (!empty($imagen_err)) ? 'has-error' : ''; ?>">
                            <label>Imagen del Combustible:</label>
                            <input placeholder="NOMBRE DEL COMBUSTIBLE" type="text" name="imagen" class="form-control" value="<?php echo $imagen; ?>">
                            <span class="help-block"><?php echo $imagen_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($costo_err)) ? 'has-error' : ''; ?>">
                            <label>Costo del Combustible:</label>
                            <input placeholder="NOMBRE DEL COMBUSTIBLE" type="text" name="costo" class="form-control" value="<?php echo $costo; ?>">
                            <span class="help-block"><?php echo $costo_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($idestacion_err)) ? 'has-error' : ''; ?>">
                            <label>Costo del Combustible:</label>
                            <input placeholder="NOMBRE DEL COMBUSTIBLE" type="text" name="idestacion" class="form-control" value="<?php echo $idestacion; ?>">
                            <span class="help-block"><?php echo $idestacion_err;?></span>
                        </div>

                     


                        <input type="submit" class="btn btn-sm btn-primary" value="Agregar Nuevos Datos de Registro" >
                        <a href="iniciocombustible.php" class="btn btn-sm btn-success">Regresar a Pantalla Principal</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>