<?php

if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    
    require_once "config.php";
    
    
    $sql = "SELECT * FROM prioridad WHERE idprioridad = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        
        $param_id = trim($_GET["id"]);
        
            if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                
                $numero = $row["numero"];
                $nombre = $row["nombre"];
                
                                
            } else{
                
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! A ocurrido un error. Por favor intentelo mas tarde.";
        }
    }
     
    
    mysqli_stmt_close($stmt);
    
    
    mysqli_close($link);
} else{
    
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ver Prioridades Registradas</title>
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
                        <h2>Ver Prioridad</h2>
                    </div>
                    <div class="form-group">
                        <label>Indice de la Prioridad:</label>
                        <p class="form-control-static"><?php echo $row["numero"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Nombre de la Prioridad:</label>
                        <p class="form-control-static"><?php echo $row["nombre"]; ?></p>
                    </div>
                    
                    <p><a href="iniciopr.php" class="btn btn-primary">Regresar a Pantalla Principal</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>