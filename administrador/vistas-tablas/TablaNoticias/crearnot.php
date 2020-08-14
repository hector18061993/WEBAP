<?php

require_once "config.php";
 
 
$nombre = $descripcion = $imagen = $fechaelaboracion = $fechapublicacion = $activo ="";

$nombre_err = $descripcion_err = $imagen_err = $fechaelaboracion_err = $fechapublicacion_err = $activo_err ="";
 

if($_SERVER["REQUEST_METHOD"] == "POST"){

     
    $input_nombre = trim($_POST["nombre"]);
    if(empty($input_nombre)){
        $nombre_err = "Favor de ingresar un nombre para la noticia.";     
    } else{
        $nombre = $input_nombre;
    }

     
    $input_descripcion = trim($_POST["descripcion"]);
    if(empty($input_descripcion)){
        $descripcion_err = "Favor de ingresar una descripcion de la noticia.";     
    } else{
        $descripcion = $input_descripcion;
    }


    
    $input_imagen = trim($_POST["imagen"]);
    if(empty($input_imagen)){
        $imagen_err = "Favor de ingresar una imagen para la noticia.";     
    } else{
        $imagen = $input_imagen;
    }

    $input_fechaelaboracion = trim($_POST["fechaelaboracion"]);
    if(empty($input_fechaelaboracion)){
        $fechaelaboracion_err = "Favor de ingresar una imagen para la noticia.";     
    } else{
        $fechaelaboracion = $input_fechaelaboracion;
    }

    $input_fechapublicacion = trim($_POST["fechapublicacion"]);
    if(empty($input_fechapublicacion)){
        $fechapublicacion_err = "Favor de ingresar una imagen para la noticia.";     
    } else{
        $fechapublicacion = $input_fechapublicacion;
    }

    $input_activo = trim($_POST["activo"]);
    if(empty($input_activo)){
        $activo_err = "Favor de ingresar una imagen para la noticia.";     
    } else{
        $activo = $input_activo;
    }


    if(empty($nombre_err) && empty($descripcion_err) && empty($imagen_err) && empty($fechaelaboracion_err) && empty($fechapublicacion_err) && empty($activo_err)){
        
        
        $sql = "INSERT INTO noticia (nombre, descripcion, imagen, fechaelaboracion, fechapublicacion, activo) 
                    VALUES (?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "ssssss", $param_nombre, $param_descripcion, $param_imagen, $param_fechaelaboracion, 
                $param_fechapublicacion, $param_activo);
            
            
            $param_nombre = $nombre;
            $param_descripcion = $descripcion;
            $param_imagen = $imagen;
            $param_fechaelaboracion = $fechaelaboracion;
            $param_fechapublicacion = $fechapublicacion;
            $param_activo = $activo;          
            
            
            if(mysqli_stmt_execute($stmt)){
                
                header("location: inicionot.php");
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
                            <label>Nombre de la Informacion:</label>
                            <input type="text" name="nombre" class="form-control" value="<?php echo $nombre; ?>">
                            <span class="help-block"><?php echo $nombre_err;?></span>
                        </div>
                        
                        <div class="form-group <?php echo (!empty($descripcion_err)) ? 'has-error' : ''; ?>">
                            <label>Descripcion de la informacion:</label>
                            <textarea name="descripcion" class="form-control"><?php echo $descripcion; ?></textarea>   
                            <span class="help-block"><?php echo $descripcion_err;?></span>
                        </div>
                      
                        <div class="form-group  <?php echo (!empty($imagen_err)) ? 'has-error' : ''; ?>">
                        <label>Imagen de la Noticia:</label>
                        <input type="file" name="imagen" value="<?php echo $imagen; ?>">
                        <span class="help-block"><?php echo $imagen_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($fechaelaboracion_err)) ? 'has-error' : ''; ?>">
                            <label>Nombre de la Informacion:</label>
                            <input type="text" name="fechaelaboracion" class="form-control" value="<?php echo $fechaelaboracion; ?>">
                            <span class="help-block"><?php echo $fechaelaboracion_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($fechapublicacion_err)) ? 'has-error' : ''; ?>">
                            <label>Nombre de la Informacion:</label>
                            <input type="text" name="fechapublicacion" class="form-control" value="<?php echo $fechapublicacion; ?>">
                            <span class="help-block"><?php echo $fechapublicacion_err;?></span>
                        </div>

                         <div class="form-group <?php echo (!empty($activo_err)) ? 'has-error' : ''; ?>">
                            <label>Nombre de la Informacion:</label>
                            <input type="text" name="activo" class="form-control" value="<?php echo $activo; ?>">
                            <span class="help-block"><?php echo $activo_err;?></span>
                        </div>


                        <input type="submit" class="btn btn-primary" value="Agregar Noticias" >
                        <a href="inicionot.php" class="btn btn-success">Regresar a Pantalla Principal</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>