<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Listado de Gerentes en Sistema</title>
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
                        <h1 class="pull-left">Gerentes en Sistema</h1><br><br>
                        <br><a href="creargetu.php" class="btn btn-warning pull-right">Agregar nuevo Gerente</a></div>
                    </div>
                    <?php
                    
                    require_once "config.php";
                    
                    $sql = "SELECT * FROM gerenteturno";

                    if($result = mysqli_query($link, $sql)){

                        if(mysqli_num_rows($result) > 0){

                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Nombre</th>";
                                        echo "<th>Apellidos</th>";
                                        echo "<th>Direccion</th>";
                                        echo "<th>Telefono</th>";
                                        echo "<th>Correo</th>";
                                        echo "<th>Nombre de Usuario</th>";
                                        echo "<th>Clave de Usuario</th>";
                                        
                                        echo "<th>Acción</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";

                                while($row = mysqli_fetch_array($result)){

                                        echo "<tr>";
                                        echo "<td>" . $row['nombre'] . "</td>";
                                        echo "<td>" . $row['apellido'] . "</td>";
                                        echo "<td>" . $row['direccion'] . "</td>";
                                        echo "<td>" . $row['telefono'] . "</td>";
                                        echo "<td>" . $row['email'] . "</td>";
                                        echo "<td>" . $row['usuario'] . "</td>";
                                        echo "<td>" . $row['password'] . "</td>";
                                      
                                        echo "<td>";

                                            echo "<a href='vergetu.php?id=". $row['idgerenteturno'] ."' title='Ver producto a detalle' data-toggle='tooltip'><span class='glyphicon glyphicon-zoom-in'></span></a>";

                                            echo "<a href='modificargetu.php?id=". $row['idgerenteturno'] ."' title='Actualizar' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";

                                            echo "<a href='eliminargetu.php?id=". $row['idgerenteturno'] ."' title='Eliminar' data-toggle='tooltip'><span class='glyphicon glyphicon-remove'></span></a>";

                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }
 
                    
                    mysqli_close($link);
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>