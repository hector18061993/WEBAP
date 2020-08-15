<?php

require_once "config.php";
 

$idestacion = $idcatestacion = $fecha = $activo = "";

$idestacion_err = $idcatestacion_err = $fecha_err = $activo_err = "";
 

if($_SERVER["REQUEST_METHOD"] == "POST"){

    
    $input_idestacion = trim($_POST["idestacion"]);
    if(empty($input_idestacion)){
        $idestacion_err = "Favor de ingresar el nombre de un dia valido.";     
    } else{
        $idestacion = $input_idestacion;
    }

    
    $input_idcatestacion = trim($_POST["idcatestacion"]);
    if(empty($input_idcatestacion)){
        $idcatestacion_err = "Favor de ingresar la hora de cierre.";     
    } else{
        $idcatestacion = $input_idcatestacion;
    }    
    

    $input_fecha = trim($_POST["fecha"]);
    if(empty($input_fecha)){
        $fecha_err = "Favor de ingresar la hora de cierre.";     
    } else{
        $fecha = $input_fecha;
    }  

    $input_activo = trim($_POST["activo"]);
    if(empty($input_activo)){
        $activo_err = "Favor de ingresar la hora de cierre.";     
    } else{
        $activo = $input_activo;
    }  


    if(empty($idestacion_err) && empty($idcatestacion_err) && empty($fecha_err) && empty($activo_err)){
        
        
        $sql = "INSERT INTO estacion_catalogo (idestacion, idcatestacion, fecha, activo) VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "ssss", $param_idestacion, $param_idcatestacion, $param_fecha, $param_activo);
            
            
            $param_idestacion = $idestacion;       
            $param_idcatestacion = $idcatestacion;
            $param_fecha = $fecha;
            $param_activo = $activo;
            

            if(mysqli_stmt_execute($stmt)){
                
                header("location: inicioestacion_catalogo.php");
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
                        
                        <div class="form-group <?php echo (!empty($idestacion_err)) ? 'has-error' : ''; ?>">
                            <label>Estacion:</label>
                            <input placeholder="NOMBRE" type="text" name="idestacion" class="form-control" value="<?php echo $idestacion; ?>">
                            <span class="help-block"><?php echo $idestacion_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($idcatestacion_err)) ? 'has-error' : ''; ?>">
                            <label>Catalogo Estacion:</label>
                            <input placeholder="Descripcion de la Aperturas" type="text" name="idcatestacion" class="form-control" value="<?php echo $idcatestacion; ?>">
                            <span class="help-block"><?php echo $idcatestacion_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($fecha_err)) ? 'has-error' : ''; ?>">
                            <label>Imagen del Catalogo:</label>
                            <input placeholder="Descripcion de la Aperturas" type="text" name="fecha" class="form-control" value="<?php echo $fecha; ?>">
                            <span class="help-block"><?php echo $fecha_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($activo_err)) ? 'has-error' : ''; ?>">
                            <label>Imagen del Catalogo:</label>
                            <input placeholder="Descripcion de la Aperturas" type="text" name="activo" class="form-control" value="<?php echo $activo; ?>">
                            <span class="help-block"><?php echo $activo_err;?></span>
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