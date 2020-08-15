<?php

require_once "config.php";
 

$idestacion =  $idcatestacion = $fecha = $activo = "";
$idestacion_err = $idcatestacion_err = $fecha_err = $activo_err = "";
 

if(isset($_POST["id"]) && !empty($_POST["id"])){

    $id = $_POST["id"];
    
    $input_idestacion = trim($_POST["idestacion"]);
    if(empty($input_idestacion)){
        $idestacion_err = "Favor de ingresar el nuevo nombre del Combustible.";     
    } else{
        $idestacion = $input_idestacion;
    }


    $input_idcatestacion = trim($_POST["idcatestacion"]);
    if(empty($input_idcatestacion)){
        $idcatestacion_err = "Favor de ingresar el nuevo costo del Combustible.";     
    } else{
        $idcatestacion = $input_idcatestacion;
    }

    $input_fecha = trim($_POST["fecha"]);
    if(empty($input_fecha)){
        $fecha_err = "Favor de ingresar el nuevo costo del Combustible.";     
    } else{
        $fecha = $input_fecha;
    }


    $input_activo = trim($_POST["activo"]);
    if(empty($input_activo)){
        $activo_err = "Favor de ingresar el nuevo costo del Combustible.";     
    } else{
        $activo = $input_activo;
    }


    if(empty($nombredia_err) && empty($descripcion_err)){

    
        $sql = "UPDATE estacion_catalogo SET idestacion=?, idcatestacion=?, fecha=?, activo=? WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "ssssi", $param_idestacion, $param_idcatestacion, $param_fecha, $param_activo, $param_id);
            
            
            $param_idestacion = $idestacion;
            $param_idcatestacion = $idcatestacion;
            $param_fecha = $fecha;
            $param_activo = $activo;
            $param_id = $id;
            
            
            if(mysqli_stmt_execute($stmt)){
                
                header("location: inicioestacion_catalogo.php");
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
        
        
        $sql = "SELECT * FROM estacion_catalogo WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            
            $param_id = $id;
            
            
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    
                    $idestacion = $row["idestacion"];
                    $idcatestacion = $row["idcatestacion"];
                    $fecha = $row["fecha"];
                    $activo = $row["activo"];
                    
                    
                    
                } else{
                    
                    header("location: errorestacion_catalogo.php");
                    exit();
                }
                
            } else{
                echo "Oops! Ocurrio un error. Porfavor intentelo mas tarde.";
            }
        }
        
        
        mysqli_stmt_close($stmt);
        
        
        mysqli_close($link);
    }  else{
        
        header("location: errorestacion_catalogo.php");
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

                        <div class="form-group <?php echo (!empty($idestacion_err)) ? 'has-error' : ''; ?>">
                            <label>Nombre:</label>
                            <input placeholder="ELEGIR LOS DIAS DE LA SEMANA" type="text" name="idestacion" class="form-control" value="<?php echo $idestacion; ?>">
                            <span class="help-block"><?php echo $idestacion_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($idcatestacion_err)) ? 'has-error' : ''; ?>">
                            <label>Descripcion:</label>
                            <input placeholder="Descripcion" type="text" name="idcatestacion" class="form-control" value="<?php echo $idcatestacion; ?>">
                            <span class="help-block"><?php echo $idcatestacion_err;?></span>
                        </div> 

                         <div class="form-group <?php echo (!empty($fecha_err)) ? 'has-error' : ''; ?>">
                            <label>Imagen:</label>
                            <input placeholder="ELEGIR LOS DIAS DE LA SEMANA" type="text" name="fecha" class="form-control" value="<?php echo $fecha; ?>">
                            <span class="help-block"><?php echo $fecha_err;?></span>
                        </div>    

                        <div class="form-group <?php echo (!empty($activo_err)) ? 'has-error' : ''; ?>">
                            <label>Estado Actual:</label>
                            <input placeholder="ELEGIR LOS DIAS DE LA SEMANA" type="text" name="activo" class="form-control" value="<?php echo $activo; ?>">
                            <span class="help-block"><?php echo $activo_err;?></span>
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