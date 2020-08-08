<?php
// Process delete operation after confirmation
if(isset($_POST["iddiferenciador"]) && !empty($_POST["iddiferenciador"])){
    // Include config file
    require_once "config.php";
    
    // Prepare a delete statement
    $sql = "DELETE FROM diferenciador WHERE iddiferenciador = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "iddiferenciador", $param_iddiferenciador);
        
        // Set parameters
        $param_iddiferenciador = trim($_POST["iddiferenciador"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Records deleted successfully. Redirect to landing page
            header("location: iniciodiferenciador.php");
            exit();
        } else{
            echo "Oops! A ocurrido un error. Intentelo de nuevo mas tarde.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);
} else{
    // Check existence of id parameter
    if(empty(trim($_GET["iddiferenciador"]))){
        // URL doesn't contain id parameter. Redirect to error page
        header("location: errordiferenciador.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Eliminar Registros del Diferenciador</title>
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
                        <h1>Eliminar el registro seleccionado</h1>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger fade in">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["iddiferenciador"]); ?>"/>
                            <p>¿Desea borrar este registro del sistema?</p><br>
                            <p>
                                <input type="submit" value="Si" class="btn btn-danger">
                                <a href="iniciodiferenciador.php" class="btn btn-primary">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>

