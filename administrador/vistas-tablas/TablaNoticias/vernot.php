<?php

if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    
    require_once "config.php";
    
    
    $sql = "SELECT * FROM noticia WHERE idnoticia = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        
        $param_id = trim($_GET["id"]);
        
        
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                $nombre = $row["nombre"];
                $descripcion = $row["descripcion"];
                $imagen = $row["imagen"];
                $fechaelaboracion = $row["fechaelaboracion"];
                $fechapublicacion = $row["fechapublicacion"];
                $activo = $row["activo"];
                
                
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
                        <h2>Ver Informacion de las Noticias</h2>
                    </div>
                    <div class="form-group">
                        <label>Nombre de la Noticia:</label>
                        <p class="form-control-static"><?php echo $row["nombre"]; ?></p>
                    </div>

                    <div class="form-group">
                        <label>Descripcion de la Noticia:</label>
                        <p class="form-control-static"><?php echo $row["descripcion"]; ?></p>
                    </div>

                    <div class="form-group">
                        <label>Imagen de la Noticia:</label>
                        <p class="form-control-static"><?php echo $row["imagen"]; ?></p>
                    </div>

                     <div class="form-group">
                        <label>Fecha de Elaboracion:</label>
                        <p class="form-control-static"><?php echo $row["fechaelaboracion"]; ?></p>
                    </div>

                     <div class="form-group">
                        <label>Imagen de Publicacion:</label>
                        <p class="form-control-static"><?php echo $row["fechapublicacion"]; ?></p>
                    </div>

                     <div class="form-group">
                        <label>Estado Actual:</label>
                        <p class="form-control-static"><?php echo $row["activo"]; ?></p>
                    </div>
                  
                    <p><a href="inicionot.php" class="btn btn-primary">Regresar a Pantalla Principal</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>