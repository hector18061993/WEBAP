<?php

require_once "config.php";
 

$nombre =  $apellido =  $direccion = $telefono = $email = $usuario = $password = "";

$nombre_err = $apellido_err = $direccion_err = $telefono_err = $email_err = $usuario_err = $password_err = "";
 

if($_SERVER["REQUEST_METHOD"] == "POST"){

   
    $input_nombre = trim($_POST["nombre"]);
    if(empty($input_nombre)){
        $nombre_err = "Favor de ingresar el nombre(s) del gerente en turno de la Estacion.";     
    } else{
        $nombre = $input_nombre;
    }

    
    $input_apellido = trim($_POST["apellido"]);
    if(empty($input_apellido)){
        $apellido_err = "Favor de ingresar los apellidos del gerente en turno de la Estacion.";     
    } else{
        $apellido = $input_apellido;
    }


    $input_direccion = trim($_POST["direccion"]);
    if(empty($input_direccion)){
        $direccion_err = "Favor de ingresar la direccion del gerente de la Estacion.";     
    } else{
        $direccion = $input_direccion;
    }

    
    $input_telefono = trim($_POST["telefono"]);
    if(empty($input_telefono)){
        $telefono_err = "Favor de ingresar el telefono del gerente de la Estacion.";     
    } else{
        $telefono = $input_telefono;
    }

    $input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = "Favor de ingresar el correo del gerente de la Estacion.";     
    } else{
        $email = $input_email;
    }

    
    $input_usuario = trim($_POST["usuario"]);
    if(empty($input_usuario)){
        $usuario_err = "Favor de ingresar el nombre de usuario del gerente de la Estacion.";     
    } else{
        $usuario = $input_usuario;
    }


    
    $input_password = trim($_POST["password"]);
    if(empty($input_password)){
        $password_err = "Favor de ingresar la contraseña del gerente de la Estacion.";     
    } else{
        $password = $input_password;
    }

   
    
    if(empty($nombre_err) && empty($apellido_err) && empty($direccion_err) && empty($telefono_err) 
        && empty($email_err) && empty($usuario_err) && empty($password_err) ){
        
        
        $sql = "INSERT INTO gerenteturno (nombre, apellido, direccion, telefono, email, usuario, password) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
           
            mysqli_stmt_bind_param($stmt, "sssssss", $param_nombre, $param_apellido, $param_direccion, $param_telefono, 
                $param_email, $param_usuario, $param_password);
            
         
            $param_nombre = $nombre;
            $param_apellido = $apellido;
            $param_direccion = $direccion;
            $param_telefono = $telefono;
            $param_email = $email;
            $param_usuario = $usuario;
            $param_password = $password;
            
            
            if(mysqli_stmt_execute($stmt)){
                
                header("location: iniciogetu.php");
                exit();
            } else{
                echo "Algo salio mal. Intentelo mas tarde.";
            }
        }
         
        
        mysqli_stmt_close($stmt);
    }
    
    
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
                        
                        <div class="form-group <?php echo (!empty($apellido_err)) ? 'has-error' : ''; ?>">
                            <label>Apellidos del Gerente en Turno:</label>
                            <input placeholder="APELLIDO(S)" type="text" name="apellido" class="form-control" value="<?php echo $apellido; ?>">
                            <span class="help-block"><?php echo $apellido_err;?></span>
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

                        <div class="form-group <?php echo (!empty($usuario_err)) ? 'has-error' : ''; ?>">
                            <label>Usuario de Acceso del Gerente en Turno:</label>
                            <input placeholder="USUARIO" type="text" name="usuario" class="form-control" value="<?php echo $usuario; ?>">
                            <span class="help-block"><?php echo $usuario_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                            <label>Clave de Acceso del Gerente en Turno:</label>
                            <input placeholder="CONTRASEÑA" type="text" name="password" class="form-control" value="<?php echo $password; ?>">
                            <span class="help-block"><?php echo $password_err;?></span>
                        </div>
                        
                                               
                       
                        <input type="submit" class="btn btn-primary" value="Agregar Gerente al Sistema" >
                        <a href="iniciogetu.php" class="btn btn-success">Regresar a Pantalla Principal</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>