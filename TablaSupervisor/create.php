<?php
// Incluimos nuestro archivo config 
require_once "config.php";
 
// Definimos las variables a utilizar 
$nombre =  $apellidos = $correo = $zona = $telefono = $estacion ="";

$nombre_err = $apellidos_err = $correo_err = $zona_err = $telefono_err = $estacion_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validando el campo Nombre(s) 
    $input_nombre = trim($_POST["nombre"]);
    if(empty($input_nombre)){
        $nombre_err = "Por favor ingrese un apellido.";     
    } else{
        $nombre = $input_nombre;
    }

    // Validando el campo Nombre(s) 
    $input_apellidos = trim($_POST["apellidos"]);
    if(empty($input_apellidos)){
        $apellidos_err = "Por favor ingrese un apellido.";     
    } else{
        $apellidos = $input_apellidos;
    }

     // Validando el campo Nombre(s) 
    $input_correo = trim($_POST["correo"]);
    if(empty($input_correo)){
        $correo_err = "Por favor ingrese un apellido.";     
    } else{
        $correo = $input_correo;
    }

     // Validando el campo Nombre(s) 
    $input_zona = trim($_POST["zona"]);
    if(empty($input_zona)){
        $zona_err = "Por favor ingrese un apellido.";     
    } else{
        $zona = $input_zona;
    }

    // Validando el campo Nombre(s) 
    $input_telefono = trim($_POST["telefono"]);
    if(empty($input_telefono)){
        $telefono_err = "Por favor ingrese un apellido.";     
    } else{
        $telefono = $input_telefono;
    }
     

    // Validando el campo Nombre(s) 
    $input_estacion = trim($_POST["estacion"]);
    if(empty($input_estacion)){
        $estacion_err = "Por favor ingrese un apellido.";     
    } else{
        $estacion = $input_estacion;
    }
 

    // Check input errors before inserting in database
    if(empty($nombre_err) && empty($apellidos_err) && empty($correo_err) && empty($zona_err) && empty($telefono_err) && empty($estacion_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO t_supervisor (nombre, apellidos, correo, zona, telefono, estacion) 
                    VALUES (?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssss", $param_nombre, $param_apellidos, $param_correo, $param_zona, 
                                   $param_telefono, $param_estacion);
            
            // Set parameters
            $param_nombre = $nombre;
            $param_apellidos = $apellidos;
            $param_correo = $correo;
            $param_zona = $zona;
            $param_telefono = $telefono;
            $param_estacion = $estacion;
                      
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
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
    <title>Agregar Empleado</title>
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
                        <h2>Agregar Usuario</h2>
                    </div>
                    <p>Favor de llenar el siguiente formulario, para agregar el usuario.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        
                        <div class="form-group <?php echo (!empty($nombre_err)) ? 'has-error' : ''; ?>">
                            <label>Nombre del Supervisor:</label>
                            <input type="text" name="nombre" class="form-control" value="<?php echo $nombre; ?>">
                            <span class="help-block"><?php echo $nombre_err;?></span>
                        </div>
                        
                        <div class="form-group <?php echo (!empty($apellidos_err)) ? 'has-error' : ''; ?>">
                            <label>Apellidos del Supervisor:</label>
                            <input type="text" name="apellidos" class="form-control" value="<?php echo $apellidos; ?>">
                            <span class="help-block"><?php echo $apellidos_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($correo_err)) ? 'has-error' : ''; ?>">
                            <label>Correo del Supervisor:</label>
                            <input type="text" name="correo" class="form-control" value="<?php echo $correo; ?>">
                            <span class="help-block"><?php echo $correo_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($zona_err)) ? 'has-error' : ''; ?>">
                            <label>Zona del Supervisor:</label>
                            <input type="text" name="zona" class="form-control" value="<?php echo $zona; ?>">
                            <span class="help-block"><?php echo $zona_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($telefono_err)) ? 'has-error' : ''; ?>">
                            <label>Telefono del Supervisor:</label>
                            <input type="text" name="telefono" class="form-control" value="<?php echo $telefono; ?>">
                            <span class="help-block"><?php echo $telefono_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($estacion_err)) ? 'has-error' : ''; ?>">
                            <label>Estacion del Supervisor:</label>
                            <input type="text" name="estacion" class="form-control" value="<?php echo $estacion; ?>">
                            <span class="help-block"><?php echo $estacion_err;?></span>
                        </div> 


                       
                        <input type="submit" class="btn btn-primary" value="Agregar" >
                        <a href="index.php" class="btn btn-default">Cancelar</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>