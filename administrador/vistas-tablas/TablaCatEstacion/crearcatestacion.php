<?php

require_once "config.php";
 

$nombre = $descripcion = $imagen = $activo =  $fecha = $tipo ="";

$nombredia_err = $descripcion_err = $imagen_err = $activo_err = $fecha_err = $tipo_err ="";
 

if($_SERVER["REQUEST_METHOD"] == "POST"){

    
    $input_nombre = trim($_POST["nombre"]);
    if(empty($input_nombre)){
        $nombre_err = "Favor de ingresar el nombre de un dia valido.";     
    } else{
        $nombre = $input_nombre;
    }

    
    $input_descripcion = trim($_POST["descripcion"]);
    if(empty($input_descripcion)){
        $descripcion_err = "Favor de ingresar la hora de cierre.";     
    } else{
        $descripcion = $input_descripcion;
    }    
    

    $input_imagen = trim($_POST["imagen"]);
    if(empty($input_imagen)){
        $imagen_err = "Favor de ingresar la hora de cierre.";     
    } else{
        $imagen = $input_imagen;
    }  

    $input_activo = trim($_POST["activo"]);
    if(empty($input_activo)){
        $activo_err = "Favor de ingresar la hora de cierre.";     
    } else{
        $activo = $input_activo;
    }  


    $input_fecha = trim($_POST["fecha"]);
    if(empty($input_fecha)){
        $fecha_err = "Favor de ingresar la hora de cierre.";     
    } else{
        $fecha = $input_fecha;
    }  

    $input_tipo = trim($_POST["tipo"]);
    if(empty($input_tipo)){
        $tipo_err = "Favor de ingresar la hora de cierre.";     
    } else{
        $tipo = $input_tipo;
    }  


    if(empty($nombredia_err) && empty($descripcion_err) && empty($imagen_err) && empty($activo_err) && empty($fecha_err) 
        && empty($tipo_err)){
        
        
        $sql = "INSERT INTO cat_estacion (nombre, descripcion, imagen, activo, fecha, tipo) VALUES (?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "ssssss", $param_nombre, $param_descripcion, $param_imagen, $param_activo, 
                                    $param_fecha, $param_tipo);
            
            
            $param_nombre = $nombre;       
            $param_descripcion = $descripcion;
            $param_imagen = $imagen;
            $param_activo = $activo;
            $param_fecha = $fecha;
            $param_tipo = $tipo; 

            
            if(mysqli_stmt_execute($stmt)){
                
                header("location: iniciocatestacion.php");
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
    <title>Agregar Horarios de Estaciones al Sistema</title>
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
                        <h2>Agregar Horarios de Estaciones al Sistema</h2>
                    </div>
                    <p>Favor de ingresar los horarios de las Estaciones.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        
                        <div class="form-group <?php echo (!empty($nombre_err)) ? 'has-error' : ''; ?>">
                            <label>Nombre del Catalogo:</label>
                            <input placeholder="NOMBRE" type="text" name="nombre" class="form-control" value="<?php echo $nombre; ?>">
                            <span class="help-block"><?php echo $nombre_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($descripcion_err)) ? 'has-error' : ''; ?>">
                            <label>Descripcion:</label>
                            <input placeholder="Descripcion de la Aperturas" type="text" name="descripcion" class="form-control" value="<?php echo $descripcion; ?>">
                            <span class="help-block"><?php echo $descripcion_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($imagen_err)) ? 'has-error' : ''; ?>">
                            <label>Imagen del Catalogo:</label>
                            <input placeholder="Descripcion de la Aperturas" type="text" name="imagen" class="form-control" value="<?php echo $imagen; ?>">
                            <span class="help-block"><?php echo $imagen_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($activo_err)) ? 'has-error' : ''; ?>">
                            <label>Imagen del Catalogo:</label>
                            <input placeholder="Descripcion de la Aperturas" type="text" name="activo" class="form-control" value="<?php echo $activo; ?>">
                            <span class="help-block"><?php echo $activo_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($fecha_err)) ? 'has-error' : ''; ?>">
                            <label>Fecha del Catalogo:</label>
                            <input placeholder="Descripcion de la Aperturas" type="text" name="fecha" class="form-control" value="<?php echo $fecha; ?>">
                            <span class="help-block"><?php echo $fecha_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($tipo_err)) ? 'has-error' : ''; ?>">
                            <label>Fecha del Catalogo:</label>
                            <input placeholder="Descripcion de la Aperturas" type="text" name="tipo" class="form-control" value="<?php echo $tipo; ?>">
                            <span class="help-block"><?php echo $tipo_err;?></span>
                        </div>

                       
                        <input type="submit" class="btn btn-primary" value="Agregar Nuevos Datos de Registro" >
                        <a href="iniciohorario.php" class="btn btn-success">Regresar a Pantalla Principal</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>