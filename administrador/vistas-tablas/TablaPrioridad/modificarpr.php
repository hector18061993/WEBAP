<?php

require_once "config.php";
 

$numero =  $nombre = "";

$numero_err = $nombre_err = "";
 

if(isset($_POST["id"]) && !empty($_POST["id"])){
    
    $id = $_POST["id"];
   

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

        
        $sql = "UPDATE prioridad SET numero=?, nombre=? 
                WHERE idprioridad=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "ssi", $param_numero, $param_nombre, $param_id);
            
            
            $param_numero = $numero;
            $param_nombre = $nombre;
            $param_id = $id;
            
            
            if(mysqli_stmt_execute($stmt)){
                
                header("location: iniciopr.php");
                exit();
            } else{
                echo "Ocurrio un error. Intentelo mas tarde.";
            }
        }
         
        
        mysqli_stmt_close($stmt);
    }
    
    
    mysqli_close($link);
} else{
    
        if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        
        $id =  trim($_GET["id"]);
        
        
        $sql = "SELECT * FROM prioridad WHERE idprioridad = ?";
        if($stmt = mysqli_prepare($link, $sql)){
        
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            $param_id = $id;
            
            
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    
                    $numero = $row["numero"];
                    $nombre = $row["nombre"];
                    
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: errorpr.php");
                    exit();
                }
                
            } else{
                echo "Oops! Ocurrio un error. Porfavor intentelo mas tarde.";
            }
        }
        
       
        mysqli_stmt_close($stmt);
        
       
        mysqli_close($link);
    }  else{
        
        header("location: errorpr.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Prioridad</title>
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
                        <h2>Actualizar los Datos de la Prioridad</h2>
                    </div>
                    <p>Edite los datos de entrada y envíe para actualizar el registro de usuarios.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">

                        <div class="form-group <?php echo (!empty($numero_err)) ? 'has-error' : ''; ?>">
                            <label>Numero de Prioridad:</label>
                            <input type="text" name="numero" class="form-control" value="<?php echo $numero; ?>">
                            <span class="help-block"><?php echo $numero_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($nombre_err)) ? 'has-error' : ''; ?>">
                            <label>Nombre de la Prioridad:</label>
                            <input type="text" name="nombre" class="form-control" value="<?php echo $nombre; ?>">
                            <span class="help-block"><?php echo $nombre_err;?></span>
                        </div>

                       
                        <input type="submit" class="btn btn-primary" value="Guardar Prioridad">
                        <a href="iniciopr.php" class="btn btn-success">Regresar a Pantalla Principal</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>