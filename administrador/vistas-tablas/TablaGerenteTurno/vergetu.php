<?php

if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    
    require_once "config.php";
    
    
    $sql = "SELECT * FROM gerenteturno WHERE idgerenteturno = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        
        $param_id = trim($_GET["id"]);
        
        
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                
                $nombre = $row["nombre"];
                $apellido = $row["apellido"];
                $telefono = $row["telefono"];
                $email = $row["email"];
                $usuario = $row["usuario"];
                $password = $row["password"];
                                
            } else{
                
                header("location: errorgetu.php");
                exit();
            }
            
        } else{
            echo "Oops! A ocurrido un error. Por favor intentelo mas tarde.";
        }
    }
     
    
    mysqli_stmt_close($stmt);
    
    
    mysqli_close($link);
} else{
    
    header("location: errorgetu.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ver Productos  Registrados</title>
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
                        <h2>Ver Productos</h2>
                    </div>
                    <div class="form-group">
                        <label>Nombre del Gerente en turno:</label>
                        <p class="form-control-static"><?php echo $row["nombre"]; ?></p>
                    </div>

                     <div class="form-group">
                        <label>Apellido del Gerente en turno:</label>
                        <p class="form-control-static"><?php echo $row["apellido"]; ?></p>
                    </div>


                    <div class="form-group">
                        <label>Direccion del gerente en turno:</label>
                        <p class="form-control-static"><?php echo $row["direccion"]; ?></p>
                    </div>
                    
                    <div class="form-group">
                        <label>Telefono del Gerente en Turno:</label>
                        <p class="form-control-static"><?php echo $row["telefono"]; ?></p>
                    </div>
                    
                    <div class="form-group">
                        <label>Correo del Gerente en Turno:</label>
                        <p class="form-control-static"><?php echo $row["email"]; ?></p>
                    </div>
                    
                    <div class="form-group">
                        <label>Usuario del Gerente en Turno:</label>
                        <p class="form-control-static"><?php echo $row["usuario"]; ?></p>
                    </div>  
                    
                    <div class="form-group">
                        <label>Usuario del Gerente en Turno:</label>
                        <p class="form-control-static"><?php echo $row["password"]; ?></p>
                    </div>   

                    <p><a href="iniciogetu.php" class="btn btn-primary">Regresar a Pantalla Principal</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>