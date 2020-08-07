<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registro de las Estaciones de Servicio</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h1 class="pull-left">Estaciones de Servicio Registradas</h1><br><br>
                        <br><a href="../vistas-tablas/crearestacion.php" class="btn btn-warning pull-right">Agregar una nueva estacion</a></div>
                    </div>
                    <?php
                    // Include config file
                    require_once "conexion.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM estaciones";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Nombre</th>";
                                        echo "<th>Ubicacion</th>";
                                        echo "<th>Direccion</th>";
                                                                            
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['titulo'] . "</td>";
                                        echo "<td>" . $row['cx'],  
                                                      $row['cy'] . "</td>";
                                        echo "<td>" . $row['direccion'] . "</td>";
                                       
                                        echo "<td>";

                                        echo "<a href='verestacion.php?id=". $row['id'] ."' title='Ver estacion' data-toggle='tooltip'><span class='glyphicon glyphicon-zoom-in'></span></a>";
                                            echo "<a href='modificarestacion.php?id=". $row['id'] ."' title='Actualizar estacion' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='eliminarestacion.php?id=". $row['id'] ."' title='Eliminar estacion' data-toggle='tooltip'><span class='glyphicon glyphicon-remove'></span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No hay ningun registro.</em></p>";
                        }
                    } else{
                        echo "ERROR: No se pudo ejecutar el SQL " . mysqli_error($link);
                    }
 
                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>