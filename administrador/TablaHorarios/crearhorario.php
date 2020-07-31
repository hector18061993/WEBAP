<?php
// Incluimos nuestro archivo config 
require_once "config.php";
 
// Definimos las variables a utilizar 
$nombredia = $horaapertura = $horacierre = "";

$nombredia_err = $horaapertura_err = $horacierre_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validando el campo Nombre(s) 
    $input_nombredia = trim($_POST["nombredia"]);
    if(empty($input_nombredia)){
        $nombredia_err = "Favor de ingresar el nombre de un dia valido.";     
    } else{
        $nombredia = $input_nombredia;
    }

    // Validando el campo Email
    $input_horaapertura = trim($_POST["horaapertura"]);
    if(empty($input_horaapertura)){
        $horaapertura_err = "Favor de ingresar la hora de apertura.";     
    } else{
        $horaapertura = $input_horaapertura;
    }

     // Validando el campo Email
    $input_horacierre = trim($_POST["horacierre"]);
    if(empty($input_horacierre)){
        $horacierre_err = "Favor de ingresar la hora de cierre.";     
    } else{
        $horacierre = $input_horacierre;
    }    
    // Check input errors before inserting in database
    if(empty($nombredia_err) && empty($horaapertura_err)  && empty($horacierre_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO t_horarios (nombredia, horaapertura, horacierre) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_nombredia, $param_horaapertura, $param_horacierre);
            
            // Set parameters
            $param_nombredia = $nombredia;
            $param_horaapertura = $horaapertura;          
            $param_horacierre = $horacierre; 

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: iniciohorario.php");
                exit();
            } else{
                echo "Algo salio mal. Intentelo mas tarde.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
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

                        <input type="submit" class="btn btn-primary" value="Agregar Nuevos Datos de Registro" >
                        <a href="iniciohorario.php" class="btn btn-success">Regresar a Pantalla Principal</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>