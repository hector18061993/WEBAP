<?php

require_once "config.php";
 

$nombre = $descripcion = $imagen = $costo = $activo  = "";
$nombre_err = $descripcion_err = $imagen_err = $costo_err  =  $activo_err = "";
 

if(isset($_POST["id"]) && !empty($_POST["id"])){
    
    $id = $_POST["id"];
    
    
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
        $imagen_err = "Por favor ingrese un usuario.";     
    } else{
        $imagen = $input_imagen;
    }
    
    
    $input_costo = trim($_POST["costo"]);
    if(empty($input_costo)){
        $costo_err = "Por favor ingrese un usuario.";     
    } else{
        $costo = $input_costo;
    }
    
   
    
    $input_activo = trim($_POST["activo"]);
    if(empty($input_activo)){
        $activo_err = "Por favor ingrese una imagen.";     
    } else{
        $activo = $input_activo;
    }

       
    
    if(empty($nombre_err) && empty($descripcion_err) && empty($imagen_err) && empty($costo_err)  
        && empty($activo_err)){

    
        $sql = "UPDATE productossecundarios SET nombre=?, descripcion=?, imagen=?, costo=?, activo=? 
                WHERE idproductossecundarios=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "sssssi", $param_nombre, $param_descripcion, 
                $param_imagen, $param_costo, $param_activo, $param_id);
            
            
            $param_nombre = $nombre;
            $param_descripcion = $descripcion;
            $param_imagen = $imagen;
            $param_costo = $costo;
            $param_activo = $activo;
            $param_id = $id;
            
            
            if(mysqli_stmt_execute($stmt)){
                
                header("location: index.php");
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
        
       
        $sql = "SELECT * FROM productossecundarios WHERE idproductosssecundarios = ?";
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
                    $costo = $row["costo"];
                    $activo = $row["activo"];
                    
                    
                } else{
                   
                    header("location: errorpagina.php");
                    exit();
                }
                
            } else{
                echo "Oops! Ocurrio un error. Porfavor intentelo mas tarde.";
            }
        }
        
        
        mysqli_stmt_close($stmt);
        
       
        mysqli_close($link);
    }  else{
        
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
                            <label>Categoria del Producto:</label>
                            <input type="text" name="imagen" class="form-control" value="<?php echo $imagen; ?>">
                            <span class="help-block"><?php echo $imagen_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($costo_err)) ? 'has-error' : ''; ?>">
                            <label>Costo del Producto:</label>
                            <input type="text" name="costo" class="form-control" value="<?php echo $costo; ?>">
                            <span class="help-block"><?php echo $costo_err;?></span>
                        </div>

                        <div class="form-group  <?php echo (!empty($activo_err)) ? 'has-error' : ''; ?>">
                        <label>Imagen del Producto:</label>
                        <input type="file" name="activo" value="<?php echo $activo; ?>">
                        <span class="help-block"><?php echo $activo_err;?></span>
                        </div>

                        
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Guardar Producto">
                        <a href="inicioestacion.php" class="btn btn-success">Regresar a Pantalla Principal</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>