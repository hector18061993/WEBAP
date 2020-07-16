<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$nombre = $direccion = $telefono = $email = $usuario = $clave = "";
$nombre_err = $direccion_err = $telefono_err = $email_err = $usuario_err = $clave_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    // Validate name
    $input_nombre = trim($_POST["nombre"]);
    if(empty($input_nombre)){
        $nombre_err = "Por favor ingrese un apellido.";     
    } else{
        $nombre = $input_nombre;
    }
    
    // Validate lastname
    $input_direccion = trim($_POST["direccion"]);
    if(empty($input_direccion)){
        $direccion_err = "Por favor ingrese un apellido.";     
    } else{
        $direccion = $input_direccion;
    }

     
    // Validate email
    $input_telefono = trim($_POST["telefono"]);
    if(empty($input_telefono)){
        $telefono_err = "Por favor ingrese un usuario.";     
    } else{
        $telefono = $input_telefono;
    }

    // Validate telefono
    $input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = "Por favor ingrese un telefono.";     
    } else{
        $email = $input_email;
    }

    // Validate user
    $input_usuario = trim($_POST["usuario"]);
    if(empty($input_usuario)){
        $usuario_err = "Por favor ingrese un usuario.";     
    } else{
        $usuario = $input_usuario;
    }

    // Validate password
    $input_clave = trim($_POST["clave"]);
    if(empty($input_clave)){
        $clave_err = "Por favor ingrese una contraseña.";     
    } else{
        $clave = $input_clave;
    }
  
    
    // Check input errors before inserting in database
    if(empty($nombre_err) && empty($direccion_err) && empty($telefono_err) 
        && empty($email_err) && empty($usuario_err) && empty($clave_err)){

        // Prepare an update statement
        $sql = "UPDATE t_gerenteturno SET nombre=?, direccion=?, telefono=?, email=?, usuario=?, clave=? WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssi", $param_nombre, $param_direccion, 
                $param_telefono, $param_email, $param_usuario, $param_clave, $param_id);
            
            // Set parameters
            $param_nombre = $nombre;
            $param_direccion = $direccion;
            $param_telefono = $telefono;
            $param_email = $email;
            $param_usuario = $usuario;
            $param_clave = $clave;
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
        $sql = "SELECT * FROM t_gerenteturno WHERE id = ?";
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
                    $direccion = $row["direccion"];
                    $telefono = $row["telefono"];
                    $email = $row["email"];
                    $usuario = $row["usuario"];
                    $clave = $row["clave"];
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
                            <label>Nombre del Gerente en turno:</label>
                            <input type="text" name="nombre" class="form-control" value="<?php echo $nombre; ?>">
                            <span class="help-block"><?php echo $nombre_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($direccion_err)) ? 'has-error' : ''; ?>">
                            <label>Direccion del gerente en turno:</label>
                            <input type="text" name="direccion" class="form-control" value="<?php echo $direccion; ?>">
                            <span class="help-block"><?php echo $direccion_err;?></span>
                        </div>

                       <div class="form-group <?php echo (!empty($telefono_err)) ? 'has-error' : ''; ?>">
                            <label>Telefono del gerente en turno</label>
                            <input type="text" name="telefono" class="form-control" value="<?php echo $telefono; ?>">
                            <span class="help-block"><?php echo $telefono_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                            <label>Correo ndel gerente en turno:</label>
                            <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                            <span class="help-block"><?php echo $email_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($usuario_err)) ? 'has-error' : ''; ?>">
                            <label>Usuario del gerente en turno:</label>
                            <input type="text" name="usuario" class="form-control" value="<?php echo $usuario; ?>">
                            <span class="help-block"><?php echo $usuario_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($clave_err)) ? 'has-error' : ''; ?>">
                            <label>Contraseña del gerente en turno:</label>
                            <input type="text" name="clave" class="form-control" value="<?php echo $clave; ?>">
                            <span class="help-block"><?php echo $clave_err;?></span>
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