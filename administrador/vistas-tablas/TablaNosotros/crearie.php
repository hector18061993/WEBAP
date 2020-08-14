<?php

require_once "config.php";
 
$titulo = $descripcion = "";

$titulo_err = $descripcion_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){

     
    $input_titulo = trim($_POST["titulo"]);
    if(empty($input_titulo)){
        $titulo_err = "Favor de ingresar el nombre de la informacion.";     
    } else{
        $titulo = $input_titulo;
    }

     // Validando el campo Nombre(s) 
    $input_descripcion = trim($_POST["descripcion"]);
    if(empty($input_descripcion)){
        $descripcion_err = "Favor de ingresar la descripcion de la informacion.";     
    } else{
        $descripcion = $input_descripcion;
    }
    
    
    if(empty($nombre_err) && empty($descripcion_err) ){
        
        
        $sql = "INSERT INTO nosotros (titulo, descripcion) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "ss", $param_titulo, $param_descripcion);
            
            
            $param_titulo = $titulo;
            $param_descripcion = $descripcion;
                     
            if(mysqli_stmt_execute($stmt)){
                
                header("location: inicioie.php");
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
                        <h2>Agregar Informacion sobre Nosotros</h2>
                    </div>
                    <p>Favor de llenar el siguiente formulario, para agregar el usuario.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        
                        <div class="form-group <?php echo (!empty($titulo_err)) ? 'has-error' : ''; ?>">
                            <label>Nombre de la Informacion:</label>
                            <input type="text" name="titulo" class="form-control" value="<?php echo $titulo; ?>">
                            <span class="help-block"><?php echo $titulo_err;?></span>
                        </div>
                        
                        <div class="form-group <?php echo (!empty($descripcion_err)) ? 'has-error' : ''; ?>">
                            <label>Descripcion de la informacion:</label>
                            <textarea name="descripcion" class="form-control"><?php echo $descripcion; ?></textarea>            
                            <span class="help-block"><?php echo $descripcion_err;?></span>
                        </div>

                        <input type="submit" class="btn btn-primary" value="Agregar Informacion" >
                        <a href="inicioie.php" class="btn btn-success">Regresar a Pantalla Principal</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>