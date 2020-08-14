<?php

if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    
    require_once "config.php";
    
    
    $sql = "SELECT * FROM nosotros WHERE idnosotros = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        $param_id = trim($_GET["id"]);
        
        
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                
                $titulo = $row["titulo"];
                $descripcion = $row["descripcion"];
                               
                
            } else{
                
                header("location: errorie.php");
                exit();
            }
            
        } else{
            echo "Oops! A ocurrido un error. Por favor intentelo mas tarde.";
        }
    }
     
    
    mysqli_stmt_close($stmt);
    
    
    mysqli_close($link);
} else{
    
    header("location: errorpagina.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ver Empleado</title>
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
                        <h2>Ver Informacion</h2>
                    </div>
                    <div class="form-group">
                        <label>Titulo:</label>
                        <p class="form-control-static"><?php echo $row["titulo"]; ?></p>
                    </div>

                    <div class="form-group">
                        <label>Descripcion de la Informacion:</label>
                        <p class="form-control-static"><?php echo $row["descripcion"]; ?></p>
                    </div>

                                      
                    <p><a href="inicioie.php" class="btn btn-primary">Regresar a Pantalla Principal</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>