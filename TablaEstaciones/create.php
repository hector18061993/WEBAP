<?php
// Incluimos nuestro archivo config 
require_once "config.php";
 
// Definimos las variables a utilizar 
$nombre = $descripcion =  $cx = $cy = $tipocombustible = $costocombustible = "";

$nombre_err = $descripcion_err = $cx_err = $cy_err = $tipocombustible_err = $costocombustible_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validando el campo Nombre(s) 
    $input_nombre = trim($_POST["nombre"]);
    if(empty($input_nombre)){
        $nombre_err = "Por favor ingrese un apellido.";     
    } else{
        $nombre = $input_nombre;
    }

    // Validando el campo Apellido(s)
    $input_descripcion = trim($_POST["descripcion"]);
    if(empty($input_descripcion)){
        $descripcion_err = "Por favor ingrese un apellido.";     
    } else{
        $descripcion = $input_descripcion;
    }

    
    // Validando el campo Email
    $input_cx = trim($_POST["cx"]);
    if(empty($input_cx)){
        $cx_err = "Por favor ingrese un correo electronico.";     
    } else{
        $cx = $input_cx;
    }

    // Validando el campo Telefono
    $input_cy = trim($_POST["cy"]);
    if(empty($input_cy)){
        $cy_err = "Por favor ingrese un numero telefonico.";     
    } else{
        $cy = $input_cy;
    }

    // Validando el campo Tipo de Usuario
    $input_tipocombustible = trim($_POST["tipocombustible"]);
    if(empty($input_tipocombustible)){
        $tipocombustible_err = "Por favor ingrese un tipo de usuario.";     
    } else{
        $tipocombustible = $input_tipocombustible;
    }


    // Validar el campo Usuario
    $input_costocombustible = trim($_POST["costocombustible"]);
    if(empty($input_costocombustible)){
        $costocombustible_err = "Por favor ingrese un usuario.";     
    } else{
        $costocombustible = $input_costocombustible;
    }

  
    // Check input errors before inserting in database
    if(empty($nombre_err) && empty($descripcion_err) && empty($cx_err) 
        && empty($cy_err) && empty($tipocombustible_err) && empty($costocombustible_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO t_estaciones (nombre, descripcion, cx, cy, tipocombustible, costocombustible) VALUES (?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param( $stmt, "ssssss", $param_nombre, $param_descripcion, $param_cx, 
                $param_cy, $param_tipocombustible, $param_costocombustible);

            
            // Set parameters
            $param_nombre = $nombre;
            $param_descripcion = $descripcion;
            $param_cx = $cx;
            $param_cy = $cy;
            $param_tipocombustible = $tipocombustible;
            $param_costocombustible = $costocombustible;
            

            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                
                header("location: index.php");
                exit();
            } else{
                echo "Algo salio mal. Intentelo mas tarde.";
            }

        }
         
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
    <title>Agregar Estaciones</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
                            <style>
        #mapa{ 
            width: 470px;
            height: 300px;
            float: left;
            background: #CCC ;
        }
        #infor{
            width: 800px;
            height: 50px;
            float: left;
        }
        .titulo {
    background-color: #F5F5F5;
    letter-spacing: normal;
    word-spacing: normal;
    margin: 10px;
    padding: 5px;
    border-radius:10px;
    alignment-adjust:central;
}
.titulo:hover{
    opacity: .9;
    background-color: #E5E5E5;}
    
.barra {
    background-color: #90C;
    border-radius:10px;
    text-align:right;
    color:#FFF;
    padding:10px;
    font-size:16px;
}
    #art-main .art-sheet.clearfix .art-layout-wrapper .art-content-layout .art-content-layout-row .art-layout-cell.art-content .art-post.art-article .art-postcontent.art-postcontent-0.clearfix .art-content-layout .art-content-layout-row .art-layout-cell.layout-item-0 #formulario table tr td div {
    font-weight: bold;
}
 </style>

</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Agregar Estacion</h2>
                    </div>
                    <p>Favor de llenar el siguiente formulario, para agregar el usuario.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" name="formulario" id="formulario">
                        
                        <div class="form-group <?php echo (!empty($nombre_err)) ? 'has-error' : ''; ?>">
                            <label>Nombre de la Estacion:</label>
                            <input type="text" name="nombre" class="form-control" value="<?php echo $nombre; ?>">
                            <span class="help-block"><?php echo $nombre_err;?></span>
                        </div>
                        
                        <div class="form-group <?php echo (!empty($descripcion_err)) ? 'has-error' : ''; ?>">
                            <label>Descripcion:</label>
                            <input type="text" name="descripcion" class="form-control" value="<?php echo $descripcion; ?>">
                            <span class="help-block"><?php echo $descripcion_err;?></span>
                        </div>

                        <div class="form-mapa <?php echo (!empty($ubicacionlatitud_err)) ? 'has-error' : ''; ?>">
                            


<div id="mapa" > </div>
                                  <table>
                                    <tr>
                                    <td>Coordenada X</td>
                                    <td>
                                    <input type="text" class="form-control" readonly  name="cx" id="cx" autocomplete="off"/></td>
                                    <td>Coordenada Y</td>
                                    <td>
                                    <input type="text" class="form-control"  readonly name="cy" id="cy" autocomplete="off"/></td>                                      
                                    </tr>
                                  </table>   

<?php 
?>
<?php   ?>

                            
                        </div>

                        <div class="form-group <?php echo (!empty($tipocombustible_err)) ? 'has-error' : ''; ?>">
                            <label>Tipo de Combustible:</label>
                            <input type="text" name="tipocombustible" class="form-control" value="<?php echo $tipocombustible; ?>">
                            <span class="help-block"><?php echo $tipocombustible_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($costocombustible_err)) ? 'has-error' : ''; ?>">
                            <label>Costo Combustible:</label>
                            <input type="text" name="costocombustible" class="form-control" value="<?php echo $costocombustible; ?>">
                            <span class="help-block"><?php echo $costocombustible_err;?></span>
                        </div>
                        
                       
                        <input type="submit" class="btn btn-primary" value="Agregar" >
                        <a href="index.php" class="btn btn-default">Cancelar</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"> </script>

<!--IMPORTANTE RESPETAR EL ORDEN -->

<link href="css/bootstrap.min.css" rel="stylesheet" /> 
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"> </script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1aE0WtuiVtGobAxmOxnlDFAT_c1DM0ZE"type="text/javascript"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-2.0.3.min.js" ></script>

<script type="text/javascript" src="js/bootstrap.min.js" ></script>
<script>
    //VARIABLES GENERALES
        //declaras fuera del ready de jquery
    var nuevos_marcadores = [];
    var marcadores_bd= [];
    var mapa = null; //VARIABLE GENERAL PARA EL MAPA
    //FUNCION PARA QUITAR MARCADORES DE MAPA
    function limpiar_marcadores(lista)
        {for(i in lista)
            { lista[i].setMap(null);//QUITAR MARCADOR DEL MAPA
        }}
    $(document).on("ready", function(){
        
        //VARIABLE DE FORMULARIO
        var formulario = $("#formulario");
        
        var punto = new google.maps.LatLng( 19.257234615675644,-99.57647178649902);
        var config = {
            zoom:14,
            center:punto,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        mapa = new google.maps.Map( $("#mapa")[0], config );

        google.maps.event.addListener(mapa, "click", function(event){
           var coordenadas = event.latLng.toString();
           
           coordenadas = coordenadas.replace("(", "");
           coordenadas = coordenadas.replace(")", "");
           
           var lista = coordenadas.split(",");
           
           var direccion = new google.maps.LatLng(lista[0], lista[1]);
           //PASAR LA INFORMACI?N AL FORMULARIO
           
           formulario.find("input[name='cx']").val(lista[0]);
           formulario.find("input[name='cy']").val(lista[1]);
           
           
           var marcador = new google.maps.Marker({
               //titulo:prompt("Titulo del marcador?"),
               position:direccion,
               map: mapa, 
               animation:google.maps.Animation.DROP,
               draggable:false
           });
           //VIDEO 15
           //$("#collapseOne").collapse('show');
           //$("#collapseTwo").collapse('hide');
           //ALMACENAR UN MARCADOR EN EL ARRAY nuevos_marcadores
           nuevos_marcadores.push(marcador);
           
           google.maps.event.addListener(marcador, "click", function(){

           });
           
           //BORRAR MARCADORES NUEVOS
           limpiar_marcadores(nuevos_marcadores);
           marcador.setMap(mapa);
        });
        $("#btn_grabar").on("click", function(){
            //INSTANCIAR EL FORMULARIO
            var f = $("#formulario");
            
            //VALIDAR CAMPO TITULO
            //if(f.find("input[name='titulo']").val().trim()=="")
            {
                alert("Falta título");
                return false;
            }
            //VALIDAR CAMPO CX
            if(f.find("input[name='cx']").val().trim()=="")
            {
                alert("Falta Coordenada X");
                return false;
            }
            //VALIDAR CAMPO CY
            if(f.find("input[name='cy']").val().trim()=="")
            {
                alert("Falta Coordenada Y");
                return false;
            }
            //FIN VALIDACIONES
            
            if(f.hasClass("busy"))
            {
                //Cuando se haga clic en el boton grabar
                //se le marcar? con una clase 'busy' indicando
                //que ya se ha presionado, y no permitir que se
                //realiCe la misma operaci?n hasta que esta termine
                //SI TIENE LA CLASE BUSY, YA NO HARA NADA
                return false;
            }
            //SI NO TIENE LA CLASE BUSY, SE LA PONDREMOS AHORA
            f.addClass("busy");
            //Y CUANDO QUITAR LA CLASE BUSY?
            //CUANDO SE TERMINE DE PROCESAR ESTA SOLICITUD
            //ES DECIR EN EL EVENTO COMPLETE
            
            var loader_grabar = $("#loader_grabar");
           $.ajax({
               type:"POST",
               url:"iajax.php",
               dataType:"JSON",
               data:f.serialize()+"&tipo=grabar",
               success:function(data){
                   //alert(data.mensaje);
                   
                   listar();
               },
               beforeSend:function(){
                   //Notificar al usuario mientras que se procesa su solicitud
                   loader_grabar.removeClass("label-success").addClass("label label-warning")
                   .text("Procesando...").slideDown();
               },
               complete:function(){
                   //QUITAR LA CLASE BUSY
                   f.removeClass("busy");
                   f[0].reset();
                   //[0] jquery trabaja con array de elementos javascript no
                   //asi que se debe especificar cual elemento se har? reset
                   //capricho de javascript
                   //AHORA PERMITIR? OTRA VEZ QUE SE REALICE LA ACCION
                   //Notificar que se ha terminado de procesar
                   loader_grabar.removeClass("label-warning").addClass("label-success")
                   .text("Grabado OK").delay(4000).slideUp();
               }
           });
           return false;
        });
        //BORRAR
        $("#btn_borrar").on("click", function(){
            var f_eliminar = $("#formulario_eliminar");
            $.ajax({
               type:"POST",
               url:"iajax.php",
               data:"id="+f_eliminar.find("input[name='id']").val()+"&tipo=borrar",
               dataType:"JSON",
               success:function(data){
                   if(data.estado=="ok")
                    {
                        limpiar_marcadores(nuevos_marcadores);
                        alert(data.mensaje);
                        f_eliminar[0].reset();
                        listar();
                    }
                    else
                    {
                        alert(data.mensaje);
                    }
               },
               beforeSend:function(){
                   
               },
               complete:function(){
                   
               }
            });
        });

        //ACTUALIZAR
        $("#btn_actualizar").on("click", function(){
            var f_eliminar = $("#formulario_eliminar");
            $.ajax({
               type:"POST",
               url:"iajax.php",
               data:f_eliminar.serialize()+"&tipo=actualizar",
               dataType:"JSON",
               success:function(data){
                   if(data.estado=="ok")
                    {
                        limpiar_marcadores(nuevos_marcadores);
                        alert(data.mensaje);
                        f_eliminar[0].reset();
                        listar();
                    }
                    else
                    {
                        alert(data.mensaje);
                    }
               },
               beforeSend:function(){
                   
               },
               complete:function(){
                   
               }
            });
        });
        //CARGAR PUNTOS AL TERMINAR DE CARGAR LA P?GINA
        listar();//FUNCIONA, AHORA A GRAFICAR LOS PUNTOS EN EL MAPA
    });
    //FUERA DE READY DE JQUERY
    //FUNCTION PARA RECUPERAR PUNTOS DE LA BD
    function listar()
    {
        //ANTES DE LISTAR MARCADORES
        //SE DEBEN QUITAR LOS ANTERIORES DEL MAPA
       limpiar_marcadores(marcadores_bd);
       var f_eliminar = $("#formulario_eliminar");
       $.ajax({
               type:"POST",
               url:"iajax.php",
               dataType:"JSON",
               data:"&tipo=listar",
               success:function(data){
                   if(data.estado=="ok")
                    {
                        //alert("Hay puntos en la BD");
                        $.each(data.mensaje, function(i, item){
                            //OBTENER LAS COORDENADAS DEL PUNTO
                            var posi = new google.maps.LatLng(item.cx, item.cy);//bien
                            //CARGAR LAS PROPIEDADES AL MARCADOR
                            var marca = new google.maps.Marker({
                                idMarcador:item.IdPunto,
                                position:posi,
                                titulo: item.Titulo,
                                cx:item.cx,
                                cy:item.cy
                            });
                            //AGREGAR EVENTO CLICK AL MARCADOR
                            google.maps.event.addListener(marca, "click", function(){
                                $("#collapseOne").collapse('hide');
                                $("#collapseTwo").collapse('show');
                               //alert("Hiciste click en "+marca.idMarcador + " - " + marca.titulo) ;
                               //SOLO MOVER CUANDO SE MARQUE EL CHECKBOX DEL FORMULARIO
                               if($("#opc_edicion").prop("checked"))
                               
                               {
                                    //HACER UN MARCADOR DRAGGABLE
                                    marca.setOptions({draggable: true});

                                    google.maps.event.addListener(marca, 'dragend', function(event) { 
                                        //AL FINAL DE MOVE EL MARCADOR
                                        //ESTE MISMO YA SE ACTUALIZA CON LAS NUEVAS COORDENADAS
                                        //alert(marca.position);
                                        var coordenadas = event.latLng.toString();
                                        coordenadas = coordenadas.replace("(", "");
                                        coordenadas = coordenadas.replace(")", "");
                                        var lista = coordenadas.split(",");
                                        f_eliminar.find("input[name='cx']").val(lista[0]);
                                        f_eliminar.find("input[name='cy']").val(lista[1]);
                                    } );
                                }
                                else
                                {
                                    
                                    f_eliminar.find("input[name='titulo']").val(marca.titulo);
                                    f_eliminar.find("input[name='cx']").val(marca.cx);
                                    f_eliminar.find("input[name='cy']").val(marca.cy);
                                    f_eliminar.find("input[name='id']").val(marca.idMarcador);
                                }
                                limpiar_marcadores(nuevos_marcadores);
                            });
                            //AGREGAR EL MARCADOR A LA VARIABLE MARCADORES_BD
                            marcadores_bd.push(marca);
                            //UBICAR EL MARCADOR EN EL MAPA
                            marca.setMap(mapa);
                        });
                    }
                else
                    {
                        alert("NO hay puntos en la BD");
                    }
               },
               beforeSend:function(){
                   
               },
               complete:function(){
                   
               }
           });
    }
    //PLANTILLA AJAX
     -->
</script>
