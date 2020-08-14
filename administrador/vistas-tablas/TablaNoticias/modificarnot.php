<?php

require_once "config.php";
 

$nombre = $descripcion = $imagen =  $fechaelaboracion = $fechapublicacion = $activo = "";
$nombre_err = $descripcion_err = $imagen_err = $fechaelaboracion_err = $fechapublicacion_err = $activo_err ="";
 

if(isset($_POST["id"]) && !empty($_POST["id"])){
    
    $id = $_POST["id"];
        
    $input_nombre = trim($_POST["nombre"]);
    if(empty($input_nombre)){
        $nombre_err = "Favor de ingresar un nuevo nombre de la noticia.";     
    } else{
        $nombre = $input_nombre;
    }
    
    
    $input_descripcion = trim($_POST["descripcion"]);
    if(empty($input_descripcion)){
        $descripcion_err = "Favor de ingresar una nueva descripcion para la noticia.";     
    } else{
        $descripcion = $input_descripcion;
    }

    $input_imagen = trim($_POST["imagen"]);
    if(empty($input_imagen)){
        $imagen_err = "Favor de ingresar una nueva imagen para la noticia.";     
    } else{
        $imagen = $input_imagen;
    }

    $input_fechaelaboracion = trim($_POST["fechaelaboracion"]);
    if(empty($input_fechaelaboracion)){
        $fechaelaboracion_err = "Favor de ingresar una nueva imagen para la noticia.";     
    } else{
        $fechaelaboracion = $input_fechaelaboracion;
    }


    $input_fechapublicacion = trim($_POST["fechapublicacion"]);
    if(empty($input_fechapublicacion)){
        $fechapublicacion_err = "Favor de ingresar una nueva imagen para la noticia.";     
    } else{
        $fechapublicacion = $input_fechapublicacion;
    }
    
    $input_activo = trim($_POST["activo"]);
    if(empty($input_activo)){
        $activo_err = "Favor de ingresar una nueva imagen para la noticia.";     
    } else{
        $activo = $input_activo;
    }
    
    if(empty($nombre_err) && empty($descripcion_err) && empty($imagen_err) && empty($fechaelaboracion_err) && empty($fechapublicacion_err) && empty($activo_err)){

        
        $sql = "UPDATE noticia SET nombre=?, descripcion=?, imagen=?, fechaelaboracion=?, fechapublicacion=?, activo=? 
                WHERE idnoticia=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "ssssssi", $param_nombre, $param_descripcion, 
                $param_imagen, $param_fechaelaboracion, $param_fechapublicacion, $param_activo, $param_id);
            
            
            $param_nombre = $nombre;
            $param_descripcion = $descripcion;
            $param_imagen = $imagen;
            $param_fechaelaboracion = $fechaelaboracion;
            $param_fechapublicacion = $fechapublicacion;
            $param_activo = $activo;
            $param_id = $id;
            
            
            if(mysqli_stmt_execute($stmt)){
                
                header("location: inicionot.php");
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
        
        
        $sql = "SELECT * FROM noticia WHERE idnoticia = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            
            $param_id = $id;
            
        
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    
                    $nombre = $row["nombre"];
                    $descripcion = $row["descripcion"];
                    $imagen = $row["imagen"];
                    $fechaelaboracion = $row["fechaelaboracion"];
                    $fechapublicacion = $row["fechapublicacion"];
                    $activo = $row["activo"];
                    
                } else{
                    
                    header("location: errornot.php");
                    exit();
                }
                
            } else{
                echo "Oops! Ocurrio un error. Porfavor intentelo mas tarde.";
            }
        }
        
        
        mysqli_stmt_close($stmt);
        
        
        mysqli_close($link);
    }  else{
        
        header("location: errornot.php");
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
                            <label>Nombre de la Noticia:</label>
                            <input type="text" name="nombre" class="form-control" value="<?php echo $nombre; ?>">
                            <span class="help-block"><?php echo $nombre_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($descripcion_err)) ? 'has-error' : ''; ?>">
                            <label>Descripcion de la noticia:</label>
                            <textarea name="descripcion" class="form-control"><?php echo $descripcion; ?></textarea>   
                            <span class="help-block"><?php echo $descripcion_err;?></span>
                        </div>

                        <div class="form-group  <?php echo (!empty($imagen_err)) ? 'has-error' : ''; ?>">
                        <label>Imagen de la Noticia:</label>
                        <input type="file" name="imagen" value="<?php echo $imagen; ?>">
                        <span class="help-block"><?php echo $imagen_err;?></span>
                        </div>
                         
                         <div class="form-group <?php echo (!empty($fechaelaboracion_err)) ? 'has-error' : ''; ?>">
                            <label>Nombre de la Noticia:</label>
                            <input type="text" name="fechaelaboracion" class="form-control" value="<?php echo $fechaelaboracion; ?>">
                            <span class="help-block"><?php echo $fechaelaboracion_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($fechapublicacion_err)) ? 'has-error' : ''; ?>">
                            <label>Nombre de la Noticia:</label>
                            <input type="text" name="fechapublicacion" class="form-control" value="<?php echo $fechapublicacion; ?>">
                            <span class="help-block"><?php echo $fechapublicacion_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($activo_err)) ? 'has-error' : ''; ?>">
                            <label>Nombre de la Noticia:</label>
                            <input type="text" name="activo" class="form-control" value="<?php echo $activo; ?>">
                            <span class="help-block"><?php echo $activo_err;?></span>
                        </div>

                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Guardar cambios">
                        <a href="inicionot.php" class="btn btn-success">Regresar a Pantalla Principal</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>