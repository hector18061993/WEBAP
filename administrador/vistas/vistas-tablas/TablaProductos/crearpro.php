<?php
// Incluimos nuestro archivo config 
require_once "config.php";
 
// Definimos las variables a utilizar 
$nombre = $descripcion = $categoria = $costo = $imagen = $descuento = "";

$nombre_err = $descripcion_err = $categoria_err  = $costo_err =  $imagen_err = $descuento_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validando el campo Nombre(s) 
    $input_nombre = trim($_POST["nombre"]);
    if(empty($input_nombre)){
        $nombre_err = "Por favor ingrese un apellido.";     
    } else{
        $nombre = $input_nombre;
    }

     // Validando el campo Nombre(s) 
    $input_descripcion = trim($_POST["descripcion"]);
    if(empty($input_descripcion)){
        $descripcion_err = "Por favor ingrese un apellido.";     
    } else{
        $descripcion = $input_descripcion;
    }


    // Validando el campo Email
    $input_categoria = trim($_POST["categoria"]);
    if(empty($input_categoria)){
        $categoria_err = "Por favor ingrese un correo electronico.";     
    } else{
        $categoria = $input_categoria;
    }

    // Validando el campo Email
    $input_costo = trim($_POST["costo"]);
    if(empty($input_costo)){
        $costo_err = "Por favor ingrese un correo electronico.";     
    } else{
        $costo = $input_costo;
    }
    
    $input_imagen = trim($_POST["imagen"]);
    if(empty($input_imagen)){
        $imagen_err = "Por favor ingrese una imagen del Producto.";     
    } else{
        $imagen = $input_imagen;
    }
    

     
    // Validando el campo Email
    $input_descuento = trim($_POST["descuento"]);
    if(empty($input_descuento)){
        $descuento_err = "Por favor ingrese un correo electronico.";     
    } else{
        $descuento = $input_descuento;
    }

    // Check input errors before inserting in database
    if(empty($nombre_err) && empty($descripcion_err) && empty($categoria_err) && empty($costo_err) && empty($imagen_err) && empty($descuento_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO t_producto (nombre, descripcion, categoria, costo, imagen, descuento) VALUES (?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssss", $param_nombre, $param_descripcion, 
                                  $param_categoria, $param_costo, $param_imagen, $param_descuento);
             
            // Set parameters
            $param_nombre = $nombre;
            $param_descripcion = $descripcion;
            $param_categoria = $categoria;
            $param_costo = $costo;
            $param_imagen = $imagen;
            $param_descuento = $descuento;          
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
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
    <title>Agregar Productos</title>
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
                            <label>Nombre del Producto:</label>
                            <input type="text" name="nombre" class="form-control" value="<?php echo $nombre; ?>">
                            <span class="help-block"><?php echo $nombre_err;?></span>
                        </div>
                        
                        <div class="form-group <?php echo (!empty($descripcion_err)) ? 'has-error' : ''; ?>">
                            <label>Descripcion del Producto:</label>
                            <input type="text" name="descripcion" class="form-control" value="<?php echo $descripcion; ?>">
                            <span class="help-block"><?php echo $descripcion_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($categoria_err)) ? 'has-error' : ''; ?>">
                            <label>Categoria del Producto:</label>
                            <input type="text" name="categoria" class="form-control" value="<?php echo $categoria; ?>">
                            <span class="help-block"><?php echo $categoria_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($costo_err)) ? 'has-error' : ''; ?>">
                            <label>Costo del Producto:</label>
                            <form class="form-inline">
                            <div class="form-group">
                            <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                            <div class="input-group">
                            <div class="input-group-addon">$</div>
                            <input type="text" name="costo" class="form-control" id="exampleInputAmount" placeholder="COSTO DEL PRODUCTO" value="<?php echo $costo; ?>">
                            <div class="input-group-addon">.00</div>
                            </div>
                            <span class="help-block"><?php echo $costo_err;?></span>
                            </div>                     
                       
                        <div class="form-group  <?php echo (!empty($imagen_err)) ? 'has-error' : ''; ?>">
                        <label>Imagen del Producto:</label>
                        <input type="file" name="imagen" value="<?php echo $imagen; ?>">
                        <span class="help-block"><?php echo $imagen_err;?></span>
                        </div>
                        
                        <div class="form-group <?php echo (!empty($descuento_err)) ? 'has-error' : ''; ?>">
                            <label>Descuento del Producto:</label>
                            <p>Es opcional llenarlo</p>
                            <input type="text" name="descuento" class="form-control" value="<?php echo $descuento; ?>">
                            <span class="help-block"><?php echo $descuento_err;?></span>
                        </div>
                       
                        <input type="submit" class="btn btn-primary" value="Guardar cambios en producto" >
                        <a href="index.php" class="btn btn-success">Regresar a Pantalla Principal</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>