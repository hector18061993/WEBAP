<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$nombre =  $apellidos = $turno = $direccion = $telefono = $email = $usuariogerente = $clavegerente = "";

$nombre_err = $apellidos_err = $turno_err = $direccion_err = $telefono_err = $email_err = $usuariogerente_err = $clavegerente_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    // Validando el campo Nombre(s) 
    $input_nombre = trim($_POST["nombre"]);
    if(empty($input_nombre)){
        $nombre_err = "Favor de ingresar el nuevo nombre(s) del gerente en turno de la Estacion.";     
    } else{
        $nombre = $input_nombre;
    }

    // Validando el campo Nombre(s) 
    $input_apellidos = trim($_POST["apellidos"]);
    if(empty($input_apellidos)){
        $apellidos_err = "Favor de ingresar los nuevos apellidos del gerente en turno de la Estacion.";     
    } else{
        $apellidos = $input_apellidos;
    }

    // Validando el campo Nombre(s) 
    $input_turno = trim($_POST["turno"]);
    if(empty($input_turno)){
        $turno_err = "Favor de ingresar el nuevo turno del gerente en turno de la Estacion..";     
    } else{
        $turno = $input_turno;
    }

    // Validando el campo Apellido(s)
    $input_direccion = trim($_POST["direccion"]);
    if(empty($input_direccion)){
        $direccion_err = "Favor de ingresar la nueva direccion del gerente de la Estacion.";     
    } else{
        $direccion = $input_direccion;
    }

    // Validando el campo Email
    $input_telefono = trim($_POST["telefono"]);
    if(empty($input_telefono)){
        $telefono_err = "Favor de ingresar el nuevo telefono del gerente de la Estacion.";     
    } else{
        $telefono = $input_telefono;
    }

    // Validando el campo Telefono
    $input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = "Favor de ingresar el nuevo correo del gerente de la Estacion.";     
    } else{
        $email = $input_email;
    }

    // Validando el campo Tipo de Usuario
    $input_usuariogerente = trim($_POST["usuariogerente"]);
    if(empty($input_usuariogerente)){
        $usuariogerente_err = "Favor de ingresar el nuevo nombre de usuario del gerente de la Estacion.";     
    } else{
        $usuariogerente = $input_usuariogerente;
    }


    // Validar el campo Usuario
    $input_clavegerente = trim($_POST["clavegerente"]);
    if(empty($input_clavegerente)){
        $clavegerente_err = "Favor de ingresar la nueva contraseña del gerente de la Estacion.";     
    } else{
        $clavegerente = $input_clavegerente;
    }
  
    
    // Check input errors before inserting in database
     if(empty($nombre_err) && empty($apellidos_err) && empty($turno_err) && empty($direccion_err) && empty($telefono_err) 
        && empty($email_err) && empty($usuariogerente_err) && empty($clavegerente_err)){

        // Prepare an update statement
        $sql = "UPDATE t_gerenteturno SET nombre=?, apellidos=?, turno=?, direccion=?, telefono=?, email=?, usuariogerente=?, clavegerente=? 
               WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssssi", $param_nombre, $param_apellidos, $param_turno, $param_direccion, $param_telefono, $param_email, 
                                  $param_usuariogerente, $param_clavegerente, $param_id);
            
            // Set parameters
            $param_nombre = $nombre;
            $param_apellidos = $apellidos;
            $param_turno = $turno;
            $param_direccion = $direccion;
            $param_telefono = $telefono;
            $param_email = $email;
            $param_usuariogerente = $usuariogerente;
            $param_clavegerente = $clavegerente;
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: iniciogerenteturno.php");
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
                    $apellidos = $row["apellidos"];
                    $turno = $row["turno"];
                    $direccion = $row["direccion"];
                    $telefono = $row["telefono"];
                    $email = $row["email"];
                    $usuariogerente = $row["usuariogerente"];
                    $clavegerente = $row["clavegerente"];
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
                            <label>Nombre del Gerente en turno:</label>
                            <input placeholder="NUEVO NOMBRE(S)" type="text" name="nombre" class="form-control" value="<?php echo $nombre; ?>">
                            <span class="help-block"><?php echo $nombre_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($apellidos_err)) ? 'has-error' : ''; ?>">
                            <label>Apellidos del gerente en turno:</label>
                            <input placeholder="NUEVO APELLIDO(S)" type="text" name="apellidos" class="form-control" value="<?php echo $apellidos; ?>">
                            <span class="help-block"><?php echo $apellidos_err;?></span>
                        </div>

                       <div class="form-group <?php echo (!empty($turno_err)) ? 'has-error' : ''; ?>">
                            <label>Nuevo Turno del Gerente:</label>
                            <input placeholder="NUEVO TURNO" type="text" name="turno" class="form-control" value="<?php echo $turno; ?>">
                            <span class="help-block"><?php echo $turno_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($direccion_err)) ? 'has-error' : ''; ?>">
                            <label>Direccion del Gerente en turno:</label>
                            <input placeholder="NUEVA DIRECCION" type="text" name="direccion" class="form-control" value="<?php echo $direccion; ?>">
                            <span class="help-block"><?php echo $direccion_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($telefono_err)) ? 'has-error' : ''; ?>">
                            <label>Telefono del gerente en turno:</label>
                            <input placeholder="NUEVO TELEFONO" type="text" name="telefono" class="form-control" value="<?php echo $telefono; ?>">
                            <span class="help-block"><?php echo $telefono_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                            <label>Correo del gerente en turno:</label>
                            <input placeholder="NUEVO CORREO" type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                            <span class="help-block"><?php echo $email_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($usuariogerente_err)) ? 'has-error' : ''; ?>">
                            <label>Usuario del gerente en turno:</label>
                            <input placeholder="NUEVO USUARIO" type="text" name="usuariogerente" class="form-control" value="<?php echo $usuariogerente; ?>">
                            <span class="help-block"><?php echo $usuariogerente_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($clavegerente_err)) ? 'has-error' : ''; ?>">
                            <label>Clave del gerente en turno:</label>
                            <input placeholder="NUEVA CONTRASEÑA" type="text" name="clavegerente" class="form-control" value="<?php echo $clavegerente; ?>">
                            <span class="help-block"><?php echo $clavegerente_err;?></span>
                        </div>

                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Guardar cambios">
                        <a href="iniciogerenteturno.php" class="btn btn-success">Regresar a Pantalla Principal</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>