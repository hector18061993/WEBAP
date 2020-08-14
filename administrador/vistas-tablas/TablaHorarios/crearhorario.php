<?php

require_once "config.php";
 

$nombredia = $descripcion = "";

$nombredia_err = $descripcion_err = "";
 

if($_SERVER["REQUEST_METHOD"] == "POST"){

    
    $input_nombredia = trim($_POST["nombredia"]);
    if(empty($input_nombredia)){
        $nombredia_err = "Favor de ingresar el nombre de un dia valido.";     
    } else{
        $nombredia = $input_nombredia;
    }

    
    $input_descripcion = trim($_POST["descripcion"]);
    if(empty($input_descripcion)){
        $descripcion_err = "Favor de ingresar la hora de cierre.";     
    } else{
        $descripcion = $input_descripcion;
    }    
    

    if(empty($nombredia_err) && empty($descripcion_err)){
        
        
        $sql = "INSERT INTO horarios (nombredia, descripcion) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "ss", $param_nombredia, $param_descripcion);
            
            
            $param_nombredia = $nombredia;       
            $param_descripcion = $descripcion; 

            
            if(mysqli_stmt_execute($stmt)){
                
                header("location: iniciohorario.php");
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
                        
                        <div class="form-group <?php echo (!empty($nombredia_err)) ? 'has-error' : ''; ?>">
                            <label>Nombre del Dia :</label>
                            <input placeholder="DIA LUNES, MARTES, MIERCOLES, ETC..." type="text" name="nombredia" class="form-control" value="<?php echo $nombredia; ?>">
                            <span class="help-block"><?php echo $nombredia_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($descripcion_err)) ? 'has-error' : ''; ?>">
                            <label>Hora de Apertura:</label>
                            <input placeholder="Descripcion de la Aperturas" type="text" name="descripcion" class="form-control" value="<?php echo $descripcion; ?>">
                            <span class="help-block"><?php echo $descripcion_err;?></span>
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