<?php

require_once "config.php";
 
 
$imagen = $nombre = $descripcion = "";

$imagen_err = $nombre_err = $descripcion_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    $input_imagen = trim($_POST["imagen"]);
    if(empty($input_imagen)){
        $imagen_err = "Favor de ingresar la imagen.";     
    } else{
        $imagen = $input_imagen;
    }

    
    $input_nombre = trim($_POST["nombre"]);
    if(empty($input_nombre)){
        $nombre_err = "Favor de ingresar el nombre del servicio.";     
    } else{
        $nombre = $input_nombre;
    }

    
    $input_descripcion = trim($_POST["descripcion"]);
    if(empty($input_descripcion)){
        $descripcion_err = "Favor de ingresar la hora de cierre.";     
    } else{
        $descripcion = $input_descripcion;
    }    
    

    if(empty($imagen_err) && empty($nombre_err)  && empty($descripcion_err)){
        
        
        $sql = "INSERT INTO serviciosamenidades (imagen, nombre, descripcion) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "sss", $param_imagen, $param_nombre, $param_descripcion);
            
            
            $param_imagen = $imagen;
            $param_nombre = $nombre;          
            $param_descripcion = $descripcion; 

            
            if(mysqli_stmt_execute($stmt)){
               
                header("location: inicioservicio.php");
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
                        
                        <div class="form-group <?php echo (!empty($imagen_err)) ? 'has-error' : ''; ?>">
                            <label>Nombre del Dia :</label>
                            <input placeholder="IMAGEN" type="text" name="imagen" class="form-control" value="<?php echo $imagen; ?>">
                            <span class="help-block"><?php echo $imagen_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($nombre_err)) ? 'has-error' : ''; ?>">
                            <label>Nombre:</label>
                            <input placeholder="NOMBRE" type="text" name="nombre" class="form-control" value="<?php echo $nombre; ?>">
                            <span class="help-block"><?php echo $nombre_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($descripcion_err)) ? 'has-error' : ''; ?>">
                            <label>Descripcion:</label>
                            <input placeholder="DESCRIPCION" type="text" name="descripcion" class="form-control" value="<?php echo $descripcion; ?>">
                            <span class="help-block"><?php echo $descripcion_err;?></span>
                        </div>

                        <input type="submit" class="btn btn-primary" value="Agregar Nuevos Datos de Registro" >
                        <a href="inicioservicio.php" class="btn btn-success">Regresar a Pantalla Principal</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>