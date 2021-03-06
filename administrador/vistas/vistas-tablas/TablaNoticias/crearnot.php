<?php
// Incluimos nuestro archivo config 
require_once "config.php";
 
// Definimos las variables a utilizar 
$nombre = $descripcion = $imagen = "";

$nombre_err = $descripcion_err = $imagen_err  = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validando el campo Nombre(s) 
    $input_nombre = trim($_POST["nombre"]);
    if(empty($input_nombre)){
        $nombre_err = "Favor de ingresar un nombre para la noticia.";     
    } else{
        $nombre = $input_nombre;
    }

     // Validando el campo Nombre(s) 
    $input_descripcion = trim($_POST["descripcion"]);
    if(empty($input_descripcion)){
        $descripcion_err = "Favor de ingresar una descripcion de la noticia.";     
    } else{
        $descripcion = $input_descripcion;
    }


    // Validando el campo Email
    $input_imagen = trim($_POST["imagen"]);
    if(empty($input_imagen)){
        $imagen_err = "Favor de ingresar una imagen para la noticia.";     
    } else{
        $imagen = $input_imagen;
    }

     
    // Check input errors before inserting in database
    if(empty($nombre_err) && empty($descripcion_err) && empty($imagen_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO t_noticia (nombre, descripcion, imagen) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_nombre, $param_descripcion, $param_imagen);
            
            // Set parameters
            $param_nombre = $nombre;
            $param_descripcion = $descripcion;
            $param_imagen = $imagen;          
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: inicionot.php");
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
                        
                        <div class="form-group <?php echo (!empty($nombre_err)) ? 'has-error' : ''; ?>">
                            <label>Nombre de la Informacion:</label>
                            <input type="text" name="nombre" class="form-control" value="<?php echo $nombre; ?>">
                            <span class="help-block"><?php echo $nombre_err;?></span>
                        </div>
                        
                        <div class="form-group <?php echo (!empty($descripcion_err)) ? 'has-error' : ''; ?>">
                            <label>Descripcion de la informacion:</label>
                            <textarea name="descripcion" class="form-control"><?php echo $descripcion; ?></textarea>   
                            <span class="help-block"><?php echo $descripcion_err;?></span>
                        </div>
                      
                        <div class="form-group  <?php echo (!empty($imagen_err)) ? 'has-error' : ''; ?>">
                        <label>Imagen de la Noticia:</label>
                        <input type="file" name="imagen" value="<?php echo $imagen; ?>">
                        <span class="help-block"><?php echo $imagen_err;?></span>
                        </div>

                        <input type="submit" class="btn btn-primary" value="Agregar Noticias" >
                        <a href="inicionot.php" class="btn btn-success">Regresar a Pantalla Principal</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>