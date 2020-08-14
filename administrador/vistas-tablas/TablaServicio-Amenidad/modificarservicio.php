<?php

require_once "config.php";
 

$imagen =  $nombre  =  $descripcion = "";
$imagen_err = $nombre_err = $descripcion_err = "";
 

if(isset($_POST["id"]) && !empty($_POST["id"])){
    
    $id = $_POST["id"];
    
    
    $input_imagen = trim($_POST["imagen"]);
    if(empty($input_imagen)){
        $imagen_err = "Favor de ingresar el nuevo nombre del Combustible.";     
    } else{
        $imagen = $input_imagen;
    }

    
    $input_nombre = trim($_POST["nombre"]);
    if(empty($input_nombre)){
        $nombre_err = "Favor de ingresar el nuevo costo del Combustible.";     
    } else{
        $nombre = $input_nombre;
    }

    $input_descripcion = trim($_POST["descripcion"]);
    if(empty($input_descripcion)){
        $descripcion_err = "Favor de ingresar la imagen de la Estacion.";     
    } else{
        $descripcion = $input_descripcion;
    }


    if(empty($imagen_err) && empty($nombre_err)  && empty($descripcion_err)){

        
        $sql = "UPDATE serviciosamenidades SET imagen=?, nombre=?, descripcion=? 
                WHERE idserviciosamenidades=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "sssi", $param_imagen, $param_nombre, 
                $param_descripcion, $param_id);
            
            $param_imagen = $imagen;
            $param_nombre = $nombre;
            $param_descripcion = $descripcion;
            $param_id = $id;
            
            
            if(mysqli_stmt_execute($stmt)){
                
                header("location: inicioservicio.php");
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
        
        
        $sql = "SELECT * FROM serviciosamenidades WHERE idserviciosamenidades = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    
                    $imagen = $row["imagen"];
                    $nombre = $row["nombre"];
                    $descripcion = $row["descripcion"];
                    
                } else{
                    
                    header("location: errorservicio.php");
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
        header("location: errorservicio.php");
        exit();
    }
}
?>

 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Datos de los servicios de la Estacion</title>
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
                        <h2>Actualizar Servicios y/o Amenidades</h2>
                    </div>
                    <p>Edite los campos que desee cambiar, posteriormente guarde los cambios.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">

                        <div class="form-group <?php echo (!empty($imagen_err)) ? 'has-error' : ''; ?>">
                            <label>Nuevo nombre del Tipo de Combustible:</label>
                            <input placeholder="NUEVO NOMBRE DEL COMBUSTIBLE" type="text" name="imagen" class="form-control" value="<?php echo $imagen; ?>">
                            <span class="help-block"><?php echo $imagen_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($nombre_err)) ? 'has-error' : ''; ?>">
                            <label>Nuevo nombre del Tipo de Combustible:</label>
                            <input placeholder="NUEVO NOMBRE DEL COMBUSTIBLE" type="text" name="nombre" class="form-control" value="<?php echo $nombre; ?>">
                            <span class="help-block"><?php echo $nombre_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($descripcion_err)) ? 'has-error' : ''; ?>">
                            <label>Nuevo nombre del Tipo de Combustible:</label>
                            <input placeholder="NUEVO NOMBRE DEL COMBUSTIBLE" type="text" name="descripcion" class="form-control" value="<?php echo $descripcion; ?>">
                            <span class="help-block"><?php echo $descripcion_err;?></span>
                        </div>
                                             
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Actualizar los datos del registro">
                        <a href="iniciocombustible.php" class="btn btn-success">Regresar a Pantalla Principal</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>