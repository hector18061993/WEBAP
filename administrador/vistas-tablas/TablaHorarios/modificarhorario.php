<?php

require_once "config.php";
 

$nombredia =  $descripcion = "";
$nombredia_err = $descripcion_err = "";
 

if(isset($_POST["id"]) && !empty($_POST["id"])){

    $id = $_POST["id"];
    
    $input_nombredia = trim($_POST["nombredia"]);
    if(empty($input_nombredia)){
        $nombredia_err = "Favor de ingresar el nuevo nombre del Combustible.";     
    } else{
        $nombredia = $input_nombredia;
    }


    $input_descripcion = trim($_POST["descripcion"]);
    if(empty($input_descripcion)){
        $descripcion_err = "Favor de ingresar el nuevo costo del Combustible.";     
    } else{
        $descripcion = $input_descripcion;
    }


    if(empty($nombredia_err) && empty($descripcion_err)){

    
        $sql = "UPDATE horarios SET nombredia=?, descripcion=? WHERE idhorarios=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "ssi", $param_nombredia, $param_descripcion, $param_id);
            
            
            $param_nombredia = $nombredia;
            $param_descripcion = $descripcion;
            $param_id = $id;
            
            
            if(mysqli_stmt_execute($stmt)){
                
                header("location: iniciohorario.php");
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
        
        
        $sql = "SELECT * FROM horarios WHERE idhorarios = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            
            $param_id = $id;
            
            
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    
                    $nombredia = $row["nombredia"];
                    $descripcion = $row["descripcion"];
                    
                    
                } else{
                    
                    header("location: errorcombustible.php");
                    exit();
                }
                
            } else{
                echo "Oops! Ocurrio un error. Porfavor intentelo mas tarde.";
            }
        }
        
        
        mysqli_stmt_close($stmt);
        
        
        mysqli_close($link);
    }  else{
        
        header("location: errorcombustible.php");
        exit();
    }
}
?>

 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Actualizar los datos de los horarios de las Estaciones</title>
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
                        <h2>Actualizar los Horarios de las Estaciones</h2>
                    </div>
                    <p>Edite los campos que desee cambiar, posteriormente guarde los cambios.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">

                        <div class="form-group <?php echo (!empty($nombredia_err)) ? 'has-error' : ''; ?>">
                            <label>Dia:</label>
                            <input placeholder="ELEGIR LOS DIAS DE LA SEMANA" type="text" name="nombredia" class="form-control" value="<?php echo $nombredia; ?>">
                            <span class="help-block"><?php echo $nombredia_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($descripcion_err)) ? 'has-error' : ''; ?>">
                            <label>Hora de Apertura:</label>
                            <input placeholder="Descripcion" type="text" name="descripcion" class="form-control" value="<?php echo $descripcion; ?>">
                            <span class="help-block"><?php echo $descripcion_err;?></span>
                        </div>                        

                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Actualizar los datos del registro">
                        <a href="iniciohorario.php" class="btn btn-success">Regresar a Pantalla Principal</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>