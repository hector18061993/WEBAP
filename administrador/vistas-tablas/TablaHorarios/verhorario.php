<?php

if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    
    require_once "config.php";
    
    
    $sql = "SELECT * FROM horarios WHERE idhorarios = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        
        $param_id = trim($_GET["id"]);
        
        
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                
                $nombredia = $row["nombredia"];
                $descripcion = $row["descripcion"];
                                                
            } else{
                
                header("location: errorhorario.php");
                exit();
            }
            
        } else{
            echo "Oops! A ocurrido un error. Por favor intentelo mas tarde.";
        }
    }
     
    
    mysqli_stmt_close($stmt);
    
    
    mysqli_close($link);
} else{
    
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
                        <label>Descripcion del Horario:</label>
                        <p class="form-control-static"><?php echo $row["descripcion"]; ?></p>
                    </div>
                   
                    <p><a href="iniciohorario.php" class="btn btn-info">Regresar a la Pantalla Principal</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>

