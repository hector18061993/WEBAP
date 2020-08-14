<?php
 
require_once "config.php";
 
 
$numero =  $nombre = "";

$numero_err = $nombre_err = "";
 

if($_SERVER["REQUEST_METHOD"] == "POST"){

     
    $input_numero = trim($_POST["numero"]);
    if(empty($input_numero)){
        $numero_err = "Por favor ingrese un apellido.";     
    } else{
        $numero = $input_numero;
    }

     
    $input_nombre = trim($_POST["nombre"]);
    if(empty($input_nombre)){
        $nombre_err = "Por favor ingrese un apellido.";     
    } else{
        $nombre = $input_nombre;
    }
 
    if(empty($numero_err) && empty($nombre_err)){
        
        
        $sql = "INSERT INTO prioridad (numero, nombre) 
                    VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "ss", $param_numero, $param_nombre);
            
            
            $param_numero = $numero;
            $param_nombre = $nombre;
                      
            
            if(mysqli_stmt_execute($stmt)){
            
                header("location: index.php");
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
    <title>Agregar Empleado</title>
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
                        <h2>Agregar Usuario</h2>
                    </div>
                    <p>Favor de llenar el siguiente formulario, para agregar el usuario.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        
                        <div class="form-group <?php echo (!empty($numero_err)) ? 'has-error' : ''; ?>">
                            <label>Agregar Prioridad para la estacion:</label>
                            <input type="text" name="numero" class="form-control" value="<?php echo $numero; ?>">
                            <span class="help-block"><?php echo $numero_err;?></span>
                        </div>
                        
                        <div class="form-group <?php echo (!empty($nombre_err)) ? 'has-error' : ''; ?>">
                            <label>Agregar descripcion de la prioridad:</label>
                            <input type="text" name="nombre" class="form-control" value="<?php echo $nombre; ?>">
                            <span class="help-block"><?php echo $nombre_err;?></span>
                        </div>                        
                       
                        <input type="submit" class="btn btn-primary" value="Agregar" >
                        <a href="iniciopr.php" class="btn btn-success">Regresar a Pantalla Principal</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>