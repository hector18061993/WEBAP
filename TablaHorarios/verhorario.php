<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM t_horarios WHERE id = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
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
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: errorhorario.php");
                exit();
            }
            
        } else{
            echo "Oops! A ocurrido un error. Por favor intentelo mas tarde.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: errorhorario.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ver los Horarios de las Estaciones</title>
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
                        <h2>Ver los Horarios de las Estaciones</h2>
                    </div>
                    <div class="form-group">
                        <label>Dia de la semana:</label>
                        <p class="form-control-static"><?php echo $row["nombredia"]; ?></p>
                    </div>
                    
                    <div class="form-group">
                        <label>Hora de Apertura:</label>
                        <p class="form-control-static"><?php echo $row["horaapertura"]; ?></p>
                    </div>

                     <div class="form-group">
                        <label>Hora de Cierre:</label>
                        <p class="form-control-static"><?php echo $row["horacierre"]; ?></p>
                    </div>
                    
                    <p><a href="iniciohorario.php" class="btn btn-info">Regresar a la Pantalla Principal</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>

