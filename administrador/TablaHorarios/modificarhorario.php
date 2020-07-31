<?php

require_once "config.php";
 

$nombredia =  $horaapertura =  $horacierre = "";
$nombredia_err = $horaapertura_err = $horacierre_err = "";
 

if(isset($_POST["id"]) && !empty($_POST["id"])){

    $id = $_POST["id"];
    
    $input_nombredia = trim($_POST["nombredia"]);
    if(empty($input_nombredia)){
        $nombredia_err = "Favor de ingresar el nuevo nombre del Combustible.";     
    } else{
        $nombredia = $input_nombredia;
    }


    $input_horaapertura = trim($_POST["horaapertura"]);
    if(empty($input_horaapertura)){
        $horaapertura_err = "Favor de ingresar el nuevo costo del Combustible.";     
    } else{
        $horaapertura = $input_horaapertura;
    }

    $input_horacierre = trim($_POST["horacierre"]);
    if(empty($input_horacierre)){
        $horacierre_err = "Favor de ingresar el nuevo costo del Combustible.";     
    } else{
        $horacierre = $input_horacierre;
    }


    if(empty($nombredia_err) && empty($horaapertura_err) && empty($horacierre_err)){

    
        $sql = "UPDATE t_horarios SET nombredia=?, horaapertura=?, horacierre=? WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "sssi", $param_nombredia, $param_horaapertura, $param_horacierre, $param_id);
            
            
            $param_nombredia = $nombredia;
            $param_horaapertura = $horaapertura;
            $param_horacierre = $horacierre;
            $param_id = $id;
            
            
            if(mysqli_stmt_execute($stmt)){
                
                header("location: iniciohorario.php");
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
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM t_horarios WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $nombredia = $row["nombredia"];
                    $horaapertura = $row["horaapertura"];
                    $horacierre = $row["horacierre"];
                    
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: errorcombustible.php");
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

                        <div class="form-group <?php echo (!empty($nombredia_err)) ? 'has-error' : ''; ?>">
                            <label>Dia:</label>
                            <input placeholder="DIA LUNES, MARTES, MIERCOLES, ETC..." type="text" name="nombredia" class="form-control" value="<?php echo $nombredia; ?>">
                            <span class="help-block"><?php echo $nombredia_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($horaapertura_err)) ? 'has-error' : ''; ?>">
                            <label>Hora de Apertura:</label>
                            <p>Formato de Horario 00:00:00</p>
                            <input placeholder="HORA EN FORMATO 00:00:00" type="text" name="horaapertura" class="form-control" value="<?php echo $horaapertura; ?>">
                            <span class="help-block"><?php echo $horaapertura_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($horacierre_err)) ? 'has-error' : ''; ?>">
                            <label>Hora de Cierre:</label>
                            <p>Formato de Horario 00:00:00</p>
                            <input placeholder="HORA EN FORMATO 00:00:00" type="text" name="horacierre" class="form-control" value="<?php echo $horacierre; ?>">
                            <span class="help-block"><?php echo $horacierre_err;?></span>
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