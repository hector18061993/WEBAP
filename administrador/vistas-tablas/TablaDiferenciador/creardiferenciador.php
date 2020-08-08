<?php
// Incluimos nuestro archivo config 
require_once "config.php";
 
// Definimos las variables a utilizar 
$imagen =  $descripcion =  $liga = "";

$imagen_err = $descripcion_err = $liga_err  = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validando el campo Nombre(s) 
    $input_imagen = trim($_POST["imagen"]);
    if(empty($input_imagen)){
        $imagen_err = "Favor de ingresar la imagen del diferenciador.";     
    } else{
        $imagen = $input_imagen;
    }

    // Validando el campo Email
    $input_descripcion = trim($_POST["descripcion"]);
    if(empty($input_descripcion)){
        $descripcion_err = "Favor de ingresar la descripcion del diferenciador.";     
    } else{
        $descripcion = $input_descripcion;
    }

    $input_liga = trim($_POST["liga"]);
    if(empty($input_liga)){
        $liga_err = "Favor de ingresar la liga del diferenciador.";     
    } else{
        $liga = $input_liga;
    }

     
    // Check input errors before inserting in database
    if(empty($imagen_err) && empty($descripcion_err) && empty($liga_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO diferenciador (imagen, descripcion, liga) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_imagen, $param_descripcion, $param_liga);
            
            // Set parameters
            $param_imagen = $imagen;
            $param_descripcion = $descripcion;          
            $param_liga = $liga;
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: iniciodiferenciador.php");
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
    <title>Agregar Combustibles a Sistema</title>
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
                        <h2>Registros de Diferenciadores</h2>
                    </div>
                    <p>Favor de ingresar los nuevos datos del Combustible .</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        
                        <div class="form-group <?php echo (!empty($imagen_err)) ? 'has-error' : ''; ?>">
                            <label>Imagen del Diferenciador:</label>
                            <input placeholder="IMAGEN DEL DIFERENCIADOR" type="text" name="imagen" class="form-control" value="<?php echo $imagen; ?>">
                            <span class="help-block"><?php echo $imagen_err;?></span>
                        </div>
                        
                        <div class="form-group <?php echo (!empty($descripcion_err)) ? 'has-error' : ''; ?>">
                            <label>Descripcion del diferenciador:</label>
                            <input placeholder="DESCRIPCION DEL DIFERENCIADOR" type="text" name="descripcion" class="form-control" value="<?php echo $descripcion; ?>">
                            <span class="help-block"><?php echo $descripcion_err;?></span>
                        </div>

                         <div class="form-group <?php echo (!empty($liga_err)) ? 'has-error' : ''; ?>">
                            <label>Liga del diferenciador:</label>
                            <input placeholder="LIGA DEL DIFERENCIADOR" type="text" name="liga" class="form-control" value="<?php echo $liga; ?>">
                            <span class="help-block"><?php echo $liga_err;?></span>
                        </div>

                        <input type="submit" class="btn btn-primary" value="Agregar Nuevos Datos de Registro" >
                        <a href="iniciodiferenciador.php" class="btn btn-success">Regresar a Pantalla Principal</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>