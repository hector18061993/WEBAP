<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM t_usuario WHERE id = ?";
    
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
                $nombre = $row["nombre"];
                $direccion = $row["direccion"];
                $telefono = $row["telefono"];
                $email = $row["email"];
                $cargo = $row["cargo"];
                $usuario = $row["usuario"];
                $password = $row["password"];
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
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
    header("location: error.php");
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
                        <h2>Ver Usuarios</h2>
                    </div>
                    
                    <div class="form-group">
                        <label>Nombre:</label>
                        <p class="form-control-static"><?php echo $row["nombre"]; ?></p>
                    </div>

                    <div class="form-group">
                        <label>Direccion:</label>
                        <p class="form-control-static"><?php echo $row["direccion"]; ?></p>
                    </div>
                    
                    <div class="form-group">
                        <label>Telefono:</label>
                        <p class="form-control-static"><?php echo $row["telefono"]; ?></p>
                    </div>

                    <div class="form-group">
                        <label>Email:</label>
                        <p class="form-control-static"><?php echo $row["email"]; ?></p>
                    </div>

                    <div class="form-group">
                        <label>Cargo:</label>
                        <p class="form-control-static"><?php echo $row["cargo"]; ?></p>
                    </div>

                    <div class="form-group">
                        <label>Usuario:</label>
                        <p class="form-control-static"><?php echo $row["usuario"]; ?></p>
                    </div>

                    <div class="form-group">
                        <label>Contraseña:</label>
                        <p class="form-control-static"><?php echo $row["password"]; ?></p>
                    </div>
                    <p><a href="index.php" class="btn btn-primary">Volver</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>