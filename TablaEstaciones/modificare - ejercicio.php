<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
// Definimos las variables a utilizar 
$nombre = $descripcion =  $cx = $cy = $razonsocial = $rfc =$zona =$supervisor = $prioridad = $direccion= $telefono= $correo = $activo= 
$enservicio = "";

$nombre_err = $descripcion_err = $cx_err = $cy_err = $razonsocial_err = $rfc_err = $zona_err = $supervisor_err = $prioridad_err = $direccion_err = $telefono_err = $correo_err = $activo_err = $enservicio_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    // Validando el campo Nombre(s) 
    $input_nombre = trim($_POST["nombre"]);
    if(empty($input_nombre)){
        $nombre_err = "favor de ingresar el nuevo nombre de la Estacion.";     
    } else{
        $nombre = $input_nombre;
    }

    // Validando el campo Apellido(s)
    $input_descripcion = trim($_POST["descripcion"]);
    if(empty($input_descripcion)){
        $descripcion_err = "Favor de ingresar la nueva descripcion de la Estacion.";     
    } else{
        $descripcion = $input_descripcion;
    }

    
    // Validando el campo Email
    $input_cx = trim($_POST["cx"]);
    if(empty($input_cx)){
        $cx_err = "Favor de ingresar la nueva ubicacion de la Estacion.";     
    } else{
        $cx = $input_cx;
    }

    // Validando el campo Telefono
    $input_cy = trim($_POST["cy"]);
    if(empty($input_cy)){
        $cy_err = "Favor de ingresar la nueva ubicacion de la Estacion.";     
    } else{
        $cy = $input_cy;
    }

    // Validando el campo Tipo de Usuario
    $input_razonsocial = trim($_POST["razonsocial"]);
    if(empty($input_razonsocial)){
        $razonsocial_err = "Favor de ingresar la nueva razon social de la Estacion.";     
    } else{
        $razonsocial = $input_razonsocial;
    }


    // Validar el campo Usuario
    $input_rfc = trim($_POST["rfc"]);
    if(empty($input_rfc)){
        $rfc_err = "Favor de ingresar el nuevo RFC de la Estacion.";     
    } else{
        $rfc = $input_rfc;
    }
    
    // Validar el campo Usuario
    $input_zona = trim($_POST["zona"]);
    if(empty($input_zona)){
        $zona_err = "Favor de ingresar la nueva zona de la Estacion.";     
    } else{
        $zona = $input_zona;
    }

     // Validar el campo Usuario
    $input_supervisor = trim($_POST["supervisor"]);
    if(empty($input_supervisor)){
        $supervisor_err = "Favor de ingresar el nuevo supervisor de la Estacion.";     
    } else{
        $supervisor = $input_supervisor;
    }

     // Validar el campo Usuario
    $input_prioridad = trim($_POST["prioridad"]);
    if(empty($input_prioridad)){
        $prioridad_err = "Favor de ingresar la nueva prioridad de la Estacion.";     
    } else{
        $prioridad = $input_prioridad;
    }

     // Validar el campo Usuario
    $input_direccion = trim($_POST["direccion"]);
    if(empty($input_direccion)){
        $direccion_err = "Favor de ingresar la nueva direccion de la Estacion.";     
    } else{
        $direccion = $input_direccion;
    }
 // Validar el campo Usuario
    $input_telefono = trim($_POST["telefono"]);
    if(empty($input_telefono)){
        $telefono_err = "Favor de ingresar el nuevo telefono de la Estacion.";     
    } else{
        $telefono = $input_telefono;
    }

     // Validar el campo Usuario
    $input_correo = trim($_POST["correo"]);
    if(empty($input_correo)){
        $correo_err = "Favor de ingresar el nuevo correo de la Estacion.";     
    } else{
        $correo = $input_correo;
    }

     // Validar el campo Usuario
    $input_activo = trim($_POST["activo"]);
    if(empty($input_activo)){
        $activo_err = "Favor de ingresar el nuevo estatus de la Estacion.";     
    } else{
        $activo = $input_activo;
    }

     // Validar el campo Usuario
    $input_enservicio = trim($_POST["enservicio"]);
    if(empty($input_enservicio)){
        $enservicio_err = "Favor de ingresar el nuevo estado actual de la Estacion.";     
    } else{
        $enservicio = $input_enservicio;
    }

    
    // Check input errors before inserting in database
     if(empty($nombre_err) && empty($descripcion_err)  && empty($cx_err) && empty($cy_err) && empty($razonsocial_err) && empty($rfc_err) 
                          && empty($zona_err) && empty($supervisor_err) && empty($prioridad_err) && empty($direccion_err) && empty($telefono_err)           && empty($correo_err) && empty($activo_err) && empty($enservicio_err)){

        // Prepare an update statement
        $sql = "UPDATE t_estaciones SET nombre=?, descripcion=?, cx=?, cy=?, razonsocial=?, rfc=?, zona=?, supervisor=?, prioridad=?, direccion=?, telefono=?, correo=?, activo=?, enservicio=? WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssssssssssi", $param_nombre, $param_descripcion, $param_cx, $param_cy, 
                $param_razonsocial, $param_rfc, $param_zona, $param_supervisor, $param_prioridad, $param_direccion, 
                $param_telefono, $param_correo, $param_activo, $param_enservicio, $param_id);
            
            // Set parameters
            $param_nombre = $nombre;
            $param_descripcion = $descripcion;
            $param_cx = $cx;
            $param_cy = $cy;
            $param_razonsocial = $razonsocial;
            $param_rfc = $rfc;
            $param_zona = $zona;
            $param_supervisor = $supervisor;
            $param_prioridad = $prioridad;
            $param_direccion = $direccion;
            $param_telefono = $telefono;
            $param_correo = $correo;
            $param_activo = $activo;
            $param_enservicio = $enservicio;
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: inicioe.php");
                exit();
            } else{
                echo "Ocurrio un error. Intentelo mas tarde.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM t_estaciones WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $nombre = $row["nombre"];
                    $descripcion = $row["descripcion"];
                    $cx = $row["cx"];
                    $cy = $row["cy"];
                    $razonsocial = $row["razonsocial"];
                    $rfc = $row["rfc"];
                    $zona = $row["zona"];
                    $supervisor = $row["supervisor"];
                    $prioridad = $row["prioridad"];
                    $direccion = $row["direccion"];
                    $telefono = $row["telefono"];
                    $correo = $row["correo"];
                    $activo = $row["activo"];
                    $enservicio = $row["enservicio"];
                                      
                   
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: errore.php");
                    exit();
                }
                
            } else{
                echo "Oops! Ocurrio un error. Porfavor intentelo mas tarde.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($link);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: errore.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Obtener coordenadas de un marcador </title>
    <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        width: 100%;
        height: 80%;
      }
      #coords{width: 500px;}
    </style>
  </head>
  <body >
    <div id="map"></div>

    <input type="text" id="coords" />
    <script>


var marker;          //variable del marcador
var coords = {};    //coordenadas obtenidas con la geolocalización

//Funcion principal
initMap = function () 
{

    //usamos la API para geolocalizar el usuario
        navigator.geolocation.getCurrentPosition(
          function (position){
            coords =  {
              lng: position.coords.longitude,
              lat: position.coords.latitude
            };
            setMapa(coords);  //pasamos las coordenadas al metodo para crear el mapa
            
           
          },function(error){console.log(error);});
    
}



function setMapa (coords)
{   
      //Se crea una nueva instancia del objeto mapa
      var map = new google.maps.Map(document.getElementById('map'),
      {
        zoom: 13,
        center:new google.maps.LatLng(coords.lat,coords.lng),

      });

      //Creamos el marcador en el mapa con sus propiedades
      //para nuestro obetivo tenemos que poner el atributo draggable en true
      //position pondremos las mismas coordenas que obtuvimos en la geolocalización
      marker = new google.maps.Marker({
        map: map,
        draggable: true,
        animation: google.maps.Animation.DROP,
        position: new google.maps.LatLng(coords.lat,coords.lng),

      });
      //agregamos un evento al marcador junto con la funcion callback al igual que el evento dragend que indica 
      //cuando el usuario a soltado el marcador
      marker.addListener('click', toggleBounce);
      
      marker.addListener( 'dragend', function (event)
      {
        //escribimos las coordenadas de la posicion actual del marcador dentro del input #coords
        document.getElementById("coords").value = this.getPosition().lat()+","+ this.getPosition().lng();
      });
}

//callback al hacer clic en el marcador lo que hace es quitar y poner la animacion BOUNCE
function toggleBounce() {
  if (marker.getAnimation() !== null) {
    marker.setAnimation(null);
  } else {
    marker.setAnimation(google.maps.Animation.BOUNCE);
  }
}

// Carga de la libreria de google maps 

    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?callback=initMap"></script>
  </body>
</html>