<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM privacidad WHERE idprivacidad = ?";
    
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
                $titulo = $row["titulo"];
                $descripcion = $row["descripcion"];
                
                                
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: errorprivgacidad.php");
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
    header("location: errorprivacidad.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ver los Datos del Combustible</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="content">
            <h2>Datos &raquo; Combustible</h2>
            <hr />
                
                    <table class="table table-striped table-condensed">
                <tr>
                    <th width="20%">Titulo:</th>
                    <td><?php echo $row['titulo']; ?></td>
                </tr>
                <tr>
                    <th>Descripcion:</th>
                    <td><?php echo $row['descripcion']; ?></td>
                </tr>
                
             </td>
        </tr>
    </table>
            <a href="inicioprivacidad.php" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>Regresar</a>

        </div>
    </div>
                   
                    
                </div>
            </div>        
        </div>
    </div>
</body>
</html>

