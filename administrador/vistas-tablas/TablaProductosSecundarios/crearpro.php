<?php
 
require_once "config.php";
 
 
$nombre = $descripcion = $imagen = $costo = $activo = "";

$nombre_err = $descripcion_err = $imagen_err  = $costo_err =  $activo_err = "";
 

if($_SERVER["REQUEST_METHOD"] == "POST"){

     
    $input_nombre = trim($_POST["nombre"]);
    if(empty($input_nombre)){
        $nombre_err = "Por favor ingrese un apellido.";     
    } else{
        $nombre = $input_nombre;
    }

     
    $input_descripcion = trim($_POST["descripcion"]);
    if(empty($input_descripcion)){
        $descripcion_err = "Por favor ingrese un apellido.";     
    } else{
        $descripcion = $input_descripcion;
    }


    
    $input_imagen = trim($_POST["imagen"]);
    if(empty($input_imagen)){
        $imagen_err = "Por favor ingrese un correo electronico.";     
    } else{
        $imagen = $input_imagen;
    }

    
    $input_costo = trim($_POST["costo"]);
    if(empty($input_costo)){
        $costo_err = "Por favor ingrese un correo electronico.";     
    } else{
        $costo = $input_costo;
    }
    
    $input_activo = trim($_POST["activo"]);
    if(empty($input_activo)){
        $activo_err = "Por favor ingrese una imagen del Producto.";     
    } else{
        $activo = $input_activo;
    }
    

    if(empty($nombre_err) && empty($descripcion_err) && empty($imagen_err) && empty($costo_err) && empty($activo_err)){
        
        
        $sql = "INSERT INTO productossecundarios (nombre, descripcion, imagen, costo, activo) VALUES (?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "sssss", $param_nombre, $param_descripcion, 
                                  $param_imagen, $param_costo, $param_activo);
             
            
            $param_nombre = $nombre;
            $param_descripcion = $descripcion;
            $param_imagen = $imagen;
            $param_costo = $costo;
            $param_activo = $activo;
                     
            
            
            if(mysqli_stmt_execute($stmt)){
                
                header("location: inicio.php");
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
    <title>Agregar Productos</title>
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
                            <label>Nombre del Producto:</label>
                            <input type="text" name="nombre" class="form-control" value="<?php echo $nombre; ?>">
                            <span class="help-block"><?php echo $nombre_err;?></span>
                        </div>
                        
                        <div class="form-group <?php echo (!empty($descripcion_err)) ? 'has-error' : ''; ?>">
                            <label>Descripcion del Producto:</label>
                            <input type="text" name="descripcion" class="form-control" value="<?php echo $descripcion; ?>">
                            <span class="help-block"><?php echo $descripcion_err;?></span>
                        </div>
                        

                        <div class="form-group <?php echo (!empty($imagen_err)) ? 'has-error' : ''; ?>">
                            <label>Imagen del Producto:</label>
                            <input type="text" name="imagen" class="form-control" value="<?php echo $imagen; ?>">
                            <span class="help-block"><?php echo $imagen_err;?></span>
                        </div>
                        

                        <div class="form-group <?php echo (!empty($costo_err)) ? 'has-error' : ''; ?>">
                            <label>Costo del Producto:</label>
                            <input type="text" name="costo" class="form-control" value="<?php echo $costo; ?>">
                            <span class="help-block"><?php echo $costo_err;?></span>
                        </div>
                                        
                       
                        <div class="form-group <?php echo (!empty($activo_err)) ? 'has-error' : ''; ?>">
                            <label>Estado del Producto:</label>
                            <input type="text" name="activo" class="form-control" value="<?php echo $activo; ?>">
                            <span class="help-block"><?php echo $activo_err;?></span>
                        </div>
                       
                        <input type="submit" class="btn btn-primary" value="Guardar cambios en producto" >
                        <a href="inicio.php" class="btn btn-success">Regresar a Pantalla Principal</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>