<?php
// Incluimos nuestro archivo config 
require_once "config.php";
 
// Definimos las variables a utilizar 
$nombre =  $apellidos = $turno = $direccion = $telefono = $email = $usuariogerente = $clavegerente = "";

$nombre_err = $apellidos_err = $turno_err = $direccion_err = $telefono_err = $email_err = $usuariogerente_err = $clavegerente_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validando el campo Nombre(s) 
    $input_nombre = trim($_POST["nombre"]);
    if(empty($input_nombre)){
        $nombre_err = "Favor de ingresar un nombre(s) del Gerente en Turno.";     
    } else{
        $nombre = $input_nombre;
    }

    // Validando el campo Nombre(s) 
    $input_apellidos = trim($_POST["apellidos"]);
    if(empty($input_apellidos)){
        $apellidos_err = "Favor de ingresar los apellidos del Gerente en Turno.";     
    } else{
        $apellidos = $input_apellidos;
    }

    // Validando el campo Nombre(s) 
    $input_turno = trim($_POST["turno"]);
    if(empty($input_turno)){
        $turno_err = "Favor de ingresar el turno del Gerente.";     
    } else{
        $turno = $input_turno;
    }

    // Validando el campo Apellido(s)
    $input_direccion = trim($_POST["direccion"]);
    if(empty($input_direccion)){
        $direccion_err = "Favor de ingresar la direccion del Gerente.";     
    } else{
        $direccion = $input_direccion;
    }

    // Validando el campo Email
    $input_telefono = trim($_POST["telefono"]);
    if(empty($input_telefono)){
        $telefono_err = "Favor de ingresar el telefono del Gerente.";     
    } else{
        $telefono = $input_telefono;
    }

    // Validando el campo Telefono
    $input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = "Favor de ingresar el correo del Gerente.";     
    } else{
        $email = $input_email;
    }

    // Validando el campo Tipo de Usuario
    $input_usuariogerente = trim($_POST["usuariogerente"]);
    if(empty($input_usuariogerente)){
        $usuariogerente_err = "Favor de ingresar el usuario del Gerente.";     
    } else{
        $usuariogerente = $input_usuariogerente;
    }


    // Validar el campo Usuario
    $input_clavegerente = trim($_POST["clavegerente"]);
    if(empty($input_clavegerente)){
        $clavegerente_err = "Favor de ingresar una contraseña del Gerente.";     
    } else{
        $clavegerente = $input_clavegerente;
    }

  
    // Check input errors before inserting in database
    if(empty($nombre_err) && empty($apellidos_err) && empty($turno_err) && empty($direccion_err) && empty($telefono_err) 
        && empty($email_err) && empty($usuariogerente_err) && empty($clavegerente_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO t_gerenteturno (nombre, apellidos, turno, direccion, telefono, email, usuariogerente, clavegerente) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssss", $param_nombre, $param_apellidos, $param_turno, $param_direccion, $param_telefono, 
                $param_email, $param_usuariogerente, $param_clavegerente);
            
            // Set parameters
            $param_nombre = $nombre;
            $param_apellidos = $apellidos;
            $param_turno = $turno;
            $param_direccion = $direccion;
            $param_telefono = $telefono;
            $param_email = $email;
            $param_usuariogerente = $usuariogerente;
            $param_clavegerente = $clavegerente;
            
            
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
                            <label>Nombre del Gerente en Turno:</label>
                            <input placeholder="NOMBRE(S)" type="text" name="nombre" class="form-control" value="<?php echo $nombre; ?>">
                            <span class="help-block"><?php echo $nombre_err;?></span>
                        </div>
                        
                        <div class="form-group <?php echo (!empty($apellidos_err)) ? 'has-error' : ''; ?>">
                            <label>Apellidos del Gerente en Turno:</label>
                            <input placeholder="APELLIDO(S)" type="text" name="apellidos" class="form-control" value="<?php echo $apellidos; ?>">
                            <span class="help-block"><?php echo $apellidos_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($turno_err)) ? 'has-error' : ''; ?>">
                            <label>Turno del Gerente:</label>
                            <input placeholder="TURNO" type="text" name="turno" class="form-control" value="<?php echo $turno; ?>">
                            <span class="help-block"><?php echo $turno_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($direccion_err)) ? 'has-error' : ''; ?>">
                            <label>Direccion del Gerente en Turno</label>
                            <input placeholder="DIRECCION" type="text" name="direccion" class="form-control" value="<?php echo $direccion; ?>">
                            <span class="help-block"><?php echo $direccion_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($telefono_err)) ? 'has-error' : ''; ?>">
                            <label>Telefono del Gerente en Turno:</label>
                            <input placeholder="TELEFONO" type="text" name="telefono" class="form-control" value="<?php echo $telefono; ?>">
                            <span class="help-block"><?php echo $telefono_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                            <label>Correo del Gerente en Turno:</label>
                            <input placeholder="CORREO" type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                            <span class="help-block"><?php echo $email_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($usuariogerente_err)) ? 'has-error' : ''; ?>">
                            <label>Usuario de Acceso del Gerente en Turno:</label>
                            <input placeholder="USUARIO" type="text" name="usuariogerente" class="form-control" value="<?php echo $usuariogerente; ?>">
                            <span class="help-block"><?php echo $usuariogerente_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($clavegerente_err)) ? 'has-error' : ''; ?>">
                            <label>Clave de Acceso del Gerente en Turno:</label>
                            <input placeholder="CONTRASEÑA" type="text" name="clavegerente" class="form-control" value="<?php echo $clavegerente; ?>">
                            <span class="help-block"><?php echo $clavegerente_err;?></span>
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