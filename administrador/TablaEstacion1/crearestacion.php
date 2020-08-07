<?php
// Incluimos nuestro archivo config 
require_once "config.php";
 
// Definimos las variables a utilizar 
$titulo = $cx = $cy = $direccion = "";


$titulo_err = $cx_err = $cy_err = $direccion_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validando el campo Nombre de Estacion
    $input_titulo = trim($_POST["titulo"]);
    if(empty($input_titulo)){
        $titulo_err = "Favor de ingresar el nombre de la Estacion.";     
    } else{
        $titulo = $input_titulo;
    }

    // Validando el campo Email
    $input_cx = trim($_POST["cx"]);
    if(empty($input_cx)){
        $cx_err = "Favor de ingresar la ubicacion dentro del mapa.";     
    } else{
        $cx = $input_cx;
    }

    // Validando el campo Telefono
    $input_cy = trim($_POST["cy"]);
    if(empty($input_cy)){
        $cy_err = "Favor de ingresar la ubicacion dentro del mapa.";     
    } else{
        $cy = $input_cy;
    }

     // Validar el campo Usuario
    $input_direccion = trim($_POST["direccion"]);
    if(empty($input_direccion)){
        $direccion_err = "Favor de ingresar la direccion de la Estacion.";     
    } else{
        $direccion = $input_direccion;
    }

    // Check input errors before inserting in database
    if(empty($titulo_err) && empty($cx_err) && empty($cy_err) && empty($direccion_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO estaciones (titulo, cx, cy, direccion) 
      VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param( $stmt, "ssss", $param_titulo, $param_cx, $param_cy, $param_direccion);

            
            // Set parameters
            $param_titulo = $titulo;
            $param_cx = $cx;
            $param_cy = $cy;
            $param_direccion = $direccion;
            
                    
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                
                header("location: inicioestacion.php");
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
    <title>Agregar Nuevas Estaciones</title>
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
                        <h2>Agregar Nuevas Estacion</h2>
                    </div>
                    <p>Favor de llenar el siguiente formulario, para agregar una nueva estacion de servicio.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" name="formulario" id="formulario">
                        
                        <div class="form-group <?php echo (!empty($titulo_err)) ? 'has-error' : ''; ?>">
                            <label>Nombre de la Estacion:</label>
                            <input placeholder="NOMBRE DE LA ESTACION" type="text" name="titulo" class="form-control" value="<?php echo $titulo; ?>">
                            <span class="help-block"><?php echo $titulo_err;?></span>
                        </div>
                        
                        <div class="form-mapa <?php echo (!empty($ubicacionlatitud_err)) ? 'has-error' : ''; ?>">
                            <label>Ubicacion de la Estacion:</label>
                            <p>Favor de seleccionar la ubicacion en el mapa</p>
                            <div id="mapa" > </div>
                                  <table>
                                    <tr>
                                    <td></td>
                                    <td>
                                    <input type="text" style="display:none" class="form-control" readonly  name="cx" id="cx" autocomplete="off"/></td>
                                    <td></td>
                                    <td>
                                    <input type="text" style="display:none" class="form-control"  readonly name="cy" id="cy" autocomplete="off"/></td>           
                                    </tr>
                                  </table>   
                                  <?php 
                                  ?>
                                  <?php   ?>
                              </div>

                        
                        <div class="form-group <?php echo (!empty($direccion_err)) ? 'has-error' : ''; ?>">
                            <label>Direccion de la Estacion:</label>
                            <input placeholder="DIRECCION DE LA ESTACION" type="text" name="direccion" class="form-control" value="<?php echo $direccion; ?>">
                            <span class="help-block"><?php echo $direccion_err;?></span>
                        </div>

                           
                       
                        <input type="submit" class="btn btn-primary" value="Agregar Nueva Estacion" >
                        <a href="inicioestacion.php" class="btn btn-success">Regresar a la Pantalla Principal</a>
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

