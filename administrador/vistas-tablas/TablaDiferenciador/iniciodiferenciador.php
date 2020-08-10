<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pantalla Principal Combustibles AP</title>
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
                <div class="col-md-18">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">"Diferenciador"</h2><br><br>
                        <br><a href="creardiferenciador.php" class="btn btn-success pull-right" >Agregar Diferenciador</span></a></div>



                    </div>
                    <?php
                    // Include config file
                    require_once "config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM diferenciador";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-striped table-hover'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Imagen</th>";
                                        echo "<th>Descripcion</th>";
                                        echo "<th>Liga</th>";
                                       
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['imagen'] . "</td>";
                                        echo "<td>" . $row['descripcion'] . "</td>";
                                        echo "<td>" . $row['liga'] . "</td>";
                                        echo '
                                             </td>
                                              <td>
                                              <a href="verdiferenciador.php?id='.$row['iddiferenciador'].'" title="Ver Informacion del Combustible" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span></a> 

                                                 <a href="modificardiferenciador.php?id='.$row['iddiferenciador'].'" title="Actualizar la informacion del Tipo de Combustible" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>

                                                 <a href="eliminardiferenciador.php?id='.$row['iddiferenciador'].'" title="Eliminar el registro del Combustible" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>

                                                  </td>
                                                </tr>
                                                ';
                                            
                                        
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
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