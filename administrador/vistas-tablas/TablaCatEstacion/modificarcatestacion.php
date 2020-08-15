<?php

require_once "config.php";
 

$nombre =  $descripcion = $imagen = $activo = $fecha = $tipo = "";
$nombre_err = $descripcion_err = $imagen_err = $activo_err = $fecha_err = $tipo_err = "";
 

if(isset($_POST["id"]) && !empty($_POST["id"])){

    $id = $_POST["id"];
    
    $input_nombre = trim($_POST["nombre"]);
    if(empty($input_nombre)){
        $nombre_err = "Favor de ingresar el nuevo nombre del Combustible.";     
    } else{
        $nombre = $input_nombre;
    }


    $input_descripcion = trim($_POST["descripcion"]);
    if(empty($input_descripcion)){
        $descripcion_err = "Favor de ingresar el nuevo costo del Combustible.";     
    } else{
        $descripcion = $input_descripcion;
    }

    $input_imagen = trim($_POST["imagen"]);
    if(empty($input_imagen)){
        $imagen_err = "Favor de ingresar el nuevo costo del Combustible.";     
    } else{
        $imagen = $input_imagen;
    }


    $input_activo = trim($_POST["activo"]);
    if(empty($input_activo)){
        $activo_err = "Favor de ingresar el nuevo costo del Combustible.";     
    } else{
        $activo = $input_activo;
    }


    $input_fecha = trim($_POST["fecha"]);
    if(empty($input_fecha)){
        $fecha_err = "Favor de ingresar el nuevo costo del Combustible.";     
    } else{
        $fecha = $input_fecha;
    }

    $input_tipo = trim($_POST["tipo"]);
    if(empty($input_tipo)){
        $tipo_err = "Favor de ingresar el nuevo costo del Combustible.";     
    } else{
        $tipo = $input_tipo;
    }


    if(empty($nombredia_err) && empty($descripcion_err)){

    
        $sql = "UPDATE cat_estacion SET nombre=?, descripcion=?, imagen=?, activo=?, fecha=?, tipo=? WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "ssssssi", $param_nombre, $param_descripcion, $param_imagen, $param_activo, $param_fecha, 
                $param_tipo, $param_id);
            
            
            $param_nombre = $nombre;
            $param_descripcion = $descripcion;
            $param_imagen = $imagen;
            $param_activo = $activo;
            $param_fecha = $fecha;
            $param_tipo = $tipo;
            $param_id = $id;
            
            
            if(mysqli_stmt_execute($stmt)){
                
                header("location: iniciocatestacion.php");
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
        
        
        $sql = "SELECT * FROM cat_estacion WHERE id = ?";
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
                    $activo = $row["activo"];
                    $fecha = $row["fecha"];
                    $tipo = $row["tipo"];
                    
                    
                } else{
                    
                    header("location: errorcombustible.php");
                    exit();
                }
                
            } else{
                echo "Oops! Ocurrio un error. Porfavor intentelo mas tarde.";
            }
        }
        
        
        mysqli_stmt_close($stmt);
        
        
        mysqli_close($link);
    }  else{
        
        header("location: errorcombustible.php");
        exit();
    }
}
?>

 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Actualizar los datos de los horarios de las Estaciones</title>
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
                        <h2>Actualizar los Horarios de las Estaciones</h2>
                    </div>
                    <p>Edite los campos que desee cambiar, posteriormente guarde los cambios.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">

                        <div class="form-group <?php echo (!empty($nombre_err)) ? 'has-error' : ''; ?>">
                            <label>Nombre:</label>
                            <input placeholder="ELEGIR LOS DIAS DE LA SEMANA" type="text" name="nombre" class="form-control" value="<?php echo $nombre; ?>">
                            <span class="help-block"><?php echo $nombre_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($descripcion_err)) ? 'has-error' : ''; ?>">
                            <label>Descripcion:</label>
                            <input placeholder="Descripcion" type="text" name="descripcion" class="form-control" value="<?php echo $descripcion; ?>">
                            <span class="help-block"><?php echo $descripcion_err;?></span>
                        </div> 

                         <div class="form-group <?php echo (!empty($imagen_err)) ? 'has-error' : ''; ?>">
                            <label>Imagen:</label>
                            <input placeholder="ELEGIR LOS DIAS DE LA SEMANA" type="text" name="imagen" class="form-control" value="<?php echo $imagen; ?>">
                            <span class="help-block"><?php echo $imagen_err;?></span>
                        </div>    

                        <div class="form-group <?php echo (!empty($activo_err)) ? 'has-error' : ''; ?>">
                            <label>Estado Actual:</label>
                            <input placeholder="ELEGIR LOS DIAS DE LA SEMANA" type="text" name="activo" class="form-control" value="<?php echo $activo; ?>">
                            <span class="help-block"><?php echo $activo_err;?></span>
                        </div>  

                        <div class="form-group <?php echo (!empty($fecha_err)) ? 'has-error' : ''; ?>">
                            <label>Fecha:</label>
                            <input placeholder="ELEGIR LOS DIAS DE LA SEMANA" type="text" name="fecha" class="form-control" value="<?php echo $fecha; ?>">
                            <span class="help-block"><?php echo $fecha_err;?></span>
                        </div>                         

                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Actualizar los datos del registro">
                        <a href="iniciohorario.php" class="btn btn-success">Regresar a Pantalla Principal</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>