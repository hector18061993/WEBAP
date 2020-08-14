<?php

require_once "config.php";
 
$nombre =  $apellido = $direccion = $telefono = $email = $usuario = $password = "";

$nombre_err = $apellido_err = $direccion_err = $telefono_err = $email_err = $usuario_err = $password_err = "";
 

if(isset($_POST["id"]) && !empty($_POST["id"])){
    
    $id = $_POST["id"];
    
     
    $input_nombre = trim($_POST["nombre"]);
    if(empty($input_nombre)){
        $nombre_err = "Favor de ingresar el nuevo nombre(s) del gerente en turno de la Estacion.";     
    } else{
        $nombre = $input_nombre;
    }

     
    $input_apellido = trim($_POST["apellido"]);
    if(empty($input_apellido)){
        $apellido_err = "Favor de ingresar los nuevos apellidos del gerente en turno de la Estacion.";     
    } else{
        $apellido = $input_apellido;
    }

    $input_direccion = trim($_POST["direccion"]);
    if(empty($input_direccion)){
        $direccion_err = "Favor de ingresar la nueva direccion del gerente de la Estacion.";     
    } else{
        $direccion = $input_direccion;
    }

    $input_telefono = trim($_POST["telefono"]);
    if(empty($input_telefono)){
        $telefono_err = "Favor de ingresar el nuevo telefono del gerente de la Estacion.";     
    } else{
        $telefono = $input_telefono;
    }

    
    $input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = "Favor de ingresar el nuevo correo del gerente de la Estacion.";     
    } else{
        $email = $input_email;
    }

    $input_usuario = trim($_POST["usuario"]);
    if(empty($input_usuario)){
        $usuario_err = "Favor de ingresar el nuevo nombre de usuario del gerente de la Estacion.";     
    } else{
        $usuario = $input_usuario;
    }

    $input_password = trim($_POST["password"]);
    if(empty($input_password)){
        $password_err = "Favor de ingresar la nueva contraseña del gerente de la Estacion.";     
    } else{
        $password = $input_password;
    }
  
    
    if(empty($nombre_err) && empty($apellido_err) && empty($direccion_err) && empty($telefono_err) 
    && empty($email_err) && empty($usuario_err) && empty($password_err)){

        
        $sql = "UPDATE gerenteturno SET nombre=?, apellido=?, direccion=?, telefono=?, email=?, usuario=?, password=? 
               WHERE idgerenteturno=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "sssssssi", $param_nombre, $param_apellido, $param_direccion, $param_telefono, 
                $param_email, $param_usuario, $param_password, $param_id);
            
            
            $param_nombre = $nombre;
            $param_apellido = $apellido;
            $param_direccion = $direccion;
            $param_telefono = $telefono;
            $param_email = $email;
            $param_usuario = $usuario;
            $param_password = $password;
            $param_id = $id;
            
            
            if(mysqli_stmt_execute($stmt)){
                
                header("location: iniciogetu.php");
                exit();
            } else{
                echo "Ocurrio un error. Intentelo mas tarde.";
            }
        }
         
        
        mysqli_stmt_close($stmt);
    }
    
    
    mysqli_close($link);
} else{
    
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        
        $id =  trim($_GET["id"]);
        
        $sql = "SELECT * FROM gerenteturno WHERE idgerenteturno = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            
            $param_id = $id;
            
            
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                   

                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    
                    $nombre = $row["nombre"];
                    $apellido = $row["apellido"];
                    $direccion = $row["direccion"];
                    $telefono = $row["telefono"];
                    $email = $row["email"];
                    $usuario = $row["usuario"];
                    $password = $row["password"];
                } else{
                    
                    header("location: errorgetu.php");
                    exit();
                }
                
            } else{
                echo "Oops! Ocurrio un error. Porfavor intentelo mas tarde.";
            }
        }
        
        
        mysqli_stmt_close($stmt);
        
        
        mysqli_close($link);
    }  else{
       

        header("location: errorgetu.php");
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

                        <div class="form-group <?php echo (!empty($apellido_err)) ? 'has-error' : ''; ?>">
                            <label>Apellidos del gerente en turno:</label>
                            <input placeholder="NUEVO APELLIDO(S)" type="text" name="apellido" class="form-control" value="<?php echo $apellido; ?>">
                            <span class="help-block"><?php echo $apellido_err;?></span>
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

                        <div class="form-group <?php echo (!empty($usuario_err)) ? 'has-error' : ''; ?>">
                            <label>Usuario del gerente en turno:</label>
                            <input placeholder="NUEVO USUARIO" type="text" name="usuario" class="form-control" value="<?php echo $usuario; ?>">
                            <span class="help-block"><?php echo $usuario_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                            <label>Clave del gerente en turno:</label>
                            <input placeholder="NUEVA CONTRASEÑA" type="text" name="password" class="form-control" value="<?php echo $password; ?>">
                            <span class="help-block"><?php echo $password_err;?></span>
                        </div>

                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Guardar cambios">
                        <a href="iniciogetu.php" class="btn btn-success">Regresar a Pantalla Principal</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>