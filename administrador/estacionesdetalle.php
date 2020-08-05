<?php

require_once "conexion.php";
 
$nombre =  $cx = $cy = $direccion= $telefono= $correo = $activo= $enservicio = $imagen = "";

$nombre_err = $cx_err = $cy_err = $direccion_err = $telefono_err = $correo_err = $activo_err = $enservicio_err = $imagen_err = "";
 
if(isset($_POST["idPunto"]) && !empty($_POST["idPunto"])){
    
    $id = $_POST["idPunto"];
    
    $input_nombre = trim($_POST["nombre"]);
    if(empty($input_nombre)){
        $nombre_err = "favor de ingresar el nuevo nombre de la Estacion.";     
    } else{
        $nombre = $input_nombre;
    }

    $input_cx = trim($_POST["cx"]);
    if(empty($input_cx)){
        $cx_err = "Favor de ingresar la nueva ubicacion de la Estacion.";     
    } else{
        $cx = $input_cx;
    }

    $input_cy = trim($_POST["cy"]);
    if(empty($input_cy)){
        $cy_err = "Favor de ingresar la nueva ubicacion de la Estacion.";     
    } else{
        $cy = $input_cy;
    }

    
    $input_direccion = trim($_POST["direccion"]);
    if(empty($input_direccion)){
        $direccion_err = "Favor de ingresar la nueva direccion de la Estacion.";     
    } else{
        $direccion = $input_direccion;
    }
 
    $input_telefono = trim($_POST["telefono"]);
    if(empty($input_telefono)){
        $telefono_err = "Favor de ingresar el nuevo telefono de la Estacion.";     
    } else{
        $telefono = $input_telefono;
    }

     
    $input_correo = trim($_POST["correo"]);
    if(empty($input_correo)){
        $correo_err = "Favor de ingresar el nuevo correo de la Estacion.";     
    } else{
        $correo = $input_correo;
    }

    
    $input_activo = trim($_POST["activo"]);
    if(empty($input_activo)){
        $activo_err = "Favor de ingresar el nuevo estatus de la Estacion.";     
    } else{
        $activo = $input_activo;
    }

    
    $input_enservicio = trim($_POST["enservicio"]);
    if(empty($input_enservicio)){
        $enservicio_err = "Favor de ingresar el nuevo estado actual de la Estacion.";     
    } else{
        $enservicio = $input_enservicio;
    }

    $input_imagen = trim($_POST["imagen"]);
    if(empty($input_imagen)){
        $imagen_err = "Favor de ingresar el nuevo estado actual de la Estacion.";     
    } else{
        $imagen = $input_imagen;
    }


    
    if(empty($nombre_err) && empty($cx_err) && empty($cy_err) && empty($direccion_err) 
                          && empty($telefono_err) && empty($correo_err) && empty($activo_err) && empty($enservicio_err)){

        // Prepare an update statement
        $sql = "UPDATE estaciones SET nombre=?, cx=?, cy=?, direccion=?, telefono=?, correo=?, activo=?, enservicio=?, imagen=? WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssssssi", $param_nombre, $param_cx, $param_cy, 
                $param_direccion, $param_telefono, $param_correo, $param_activo, $param_enservicio, $param_imagen, $param_id);
            
            // Set parameters
            $param_nombre = $nombre;
            $param_cx = $cx;
            $param_cy = $cy;
            $param_direccion = $direccion;
            $param_telefono = $telefono;
            $param_correo = $correo;
            $param_activo = $activo;
            $param_enservicio = $enservicio;
            $param_imagen = $imagen;
            $param_id = $id;
            
            if(mysqli_stmt_execute($stmt)){
                
                header("location: inicioestacion.php");
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
        
        
        $sql = "SELECT * FROM t_estaciones WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
          
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            
            $param_id = $id;
            
            
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    $nombre = $row["nombre"];
                    $cx = $row["cx"];
                    $cy = $row["cy"];
                    $direccion = $row["direccion"];
                    $telefono = $row["telefono"];
                    $correo = $row["correo"];
                    $activo = $row["activo"];
                    $enservicio = $row["enservicio"];
                    $imagen = $row["imagen"];
                                      
                   
                } else{
                    header("location: errorestacion.php");
                    exit();
                }
                
            } else{
                echo "Oops! Ocurrio un error. Porfavor intentelo mas tarde.";
            }
        }
        
        mysqli_stmt_close($stmt);
 
        mysqli_close($link);
    }  else{
        
        header("location: errorestacion.php");
        exit();
    }
}
?>


<!DOCTYPE HTML>
<html>
<head>
<title>Sistema Web Administrador | Usuario Administrador: Estaciones</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<link href="cssmapa/bootstrap.min.css" rel="stylesheet" />
<!-- Custom Theme files -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<!--icons-css-->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!--Google Fonts-->
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-2.0.3.min.js" ></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1aE0WtuiVtGobAxmOxnlDFAT_c1DM0ZE"type="text/javascript"></script>

<!--ARCHIVOS JAVASCRIPT DE BOOTSTRAP -->
<script type="text/javascript" src="jsmapa/bootstrap.min.js" ></script>

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



<!--map-->
</head>
<body>  
<div class="page-container">    
                <div class="header-main">
                    <div class="header-left">
                            <div class="logo-name">
                                     <a href="index.html"> <h1>Estaciones</h1> 
                                    <!--<img id="logo" src="" alt="Logo"/>--> 
                                  </a>                              
                            </div>
                            <div class="clearfix"> </div>
                         </div>
                         <div class="header-right">
                            <div class="profile_details_left"><!--notifications of menu start -->

                                <ul class="nofitications-dropdown">
                                    <li class="dropdown head-dpdn">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-envelope"></i><span class="badge">3</span></a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <div class="notification_header">
                                                    <h3>You have 3 new messages</h3>
                                                </div>
                                            </li>
                                            <li><a href="#">
                                               <div class="user_img"><img src="images/p4.png" alt=""></div>
                                               <div class="notification_desc">
                                                <p>Lorem ipsum dolor</p>
                                                <p><span>1 hour ago</span></p>
                                                </div>
                                               <div class="clearfix"></div> 
                                            </a></li>
                                            <li class="odd"><a href="#">
                                                <div class="user_img"><img src="images/p2.png" alt=""></div>
                                               <div class="notification_desc">
                                                <p>Lorem ipsum dolor </p>
                                                <p><span>1 hour ago</span></p>
                                                </div>
                                              <div class="clearfix"></div>  
                                            </a></li>
                                            <li><a href="#">
                                               <div class="user_img"><img src="images/p3.png" alt=""></div>
                                               <div class="notification_desc">
                                                <p>Lorem ipsum dolor</p>
                                                <p><span>1 hour ago</span></p>
                                                </div>
                                               <div class="clearfix"></div> 
                                            </a></li>
                                            <li>
                                                <div class="notification_bottom">
                                                    <a href="#">See all messages</a>
                                                </div> 
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="dropdown head-dpdn">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-bell"></i><span class="badge blue">3</span></a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <div class="notification_header">
                                                    <h3>You have 3 new notification</h3>
                                                </div>
                                            </li>
                                            <li><a href="#">
                                                <div class="user_img"><img src="images/p5.png" alt=""></div>
                                               <div class="notification_desc">
                                                <p>Lorem ipsum dolor</p>
                                                <p><span>1 hour ago</span></p>
                                                </div>
                                              <div class="clearfix"></div>  
                                             </a></li>
                                             <li class="odd"><a href="#">
                                                <div class="user_img"><img src="images/p6.png" alt=""></div>
                                               <div class="notification_desc">
                                                <p>Lorem ipsum dolor</p>
                                                <p><span>1 hour ago</span></p>
                                                </div>
                                               <div class="clearfix"></div> 
                                             </a></li>
                                             <li><a href="#">
                                                <div class="user_img"><img src="images/p7.png" alt=""></div>
                                               <div class="notification_desc">
                                                <p>Lorem ipsum dolor</p>
                                                <p><span>1 hour ago</span></p>
                                                </div>
                                               <div class="clearfix"></div> 
                                             </a></li>
                                             <li>
                                                <div class="notification_bottom">
                                                    <a href="#">See all notifications</a>
                                                </div> 
                                            </li>
                                        </ul>
                                    </li>   
                                    <li class="dropdown head-dpdn">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-tasks"></i><span class="badge blue1">9</span></a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <div class="notification_header">
                                                    <h3>You have 8 pending task</h3>
                                                </div>
                                            </li>
                                            <li><a href="#">
                                                <div class="task-info">
                                                    <span class="task-desc">Database update</span><span class="percentage">40%</span>
                                                    <div class="clearfix"></div>    
                                                </div>
                                                <div class="progress progress-striped active">
                                                    <div class="bar yellow" style="width:40%;"></div>
                                                </div>
                                            </a></li>
                                            <li><a href="#">
                                                <div class="task-info">
                                                    <span class="task-desc">Dashboard done</span><span class="percentage">90%</span>
                                                   <div class="clearfix"></div> 
                                                </div>
                                                <div class="progress progress-striped active">
                                                     <div class="bar green" style="width:90%;"></div>
                                                </div>
                                            </a></li>
                                            <li><a href="#">
                                                <div class="task-info">
                                                    <span class="task-desc">Mobile App</span><span class="percentage">33%</span>
                                                    <div class="clearfix"></div>    
                                                </div>
                                               <div class="progress progress-striped active">
                                                     <div class="bar red" style="width: 33%;"></div>
                                                </div>
                                            </a></li>
                                            <li><a href="#">
                                                <div class="task-info">
                                                    <span class="task-desc">Issues fixed</span><span class="percentage">80%</span>
                                                   <div class="clearfix"></div> 
                                                </div>
                                                <div class="progress progress-striped active">
                                                     <div class="bar  blue" style="width: 80%;"></div>
                                                </div>
                                            </a></li>
                                            <li>
                                                <div class="notification_bottom">
                                                    <a href="#">See all pending tasks</a>
                                                </div> 
                                            </li>
                                        </ul>
                                    </li>   
                                </ul>
                                <div class="clearfix"> </div>
                            </div>
                            <!--notification menu end -->
                            <div class="profile_details">       
                                <ul>
                                    <li class="dropdown profile_details_drop">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                            <div class="profile_img">   
                                                <span class="prfil-img"><img src="images/p1.png" alt=""> </span> 
                                                <div class="user-name">
                                                    <p>Malorum</p>
                                                    <span>Administrator</span>
                                                </div>
                                                <i class="fa fa-angle-down lnr"></i>
                                                <i class="fa fa-angle-up lnr"></i>
                                                <div class="clearfix"></div>    
                                            </div>  
                                        </a>
                                        <ul class="dropdown-menu drp-mnu">
                                            <li> <a href="#"><i class="fa fa-cog"></i> Settings</a> </li> 
                                            <li> <a href="#"><i class="fa fa-user"></i> Profile</a> </li> 
                                            <li> <a href="#"><i class="fa fa-sign-out"></i> Logout</a> </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="clearfix"> </div>               
                        </div>
                     <div class="clearfix"> </div>  
                </div>
<!--heder end here-->
<!--inner block start here-->
<div class="inner-block">

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

</div>
<div id="infor">
        <div class="list-group">
            <div class="accordion-group">
              <div class="accordion-heading">
                <!--<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                  Agregar
                </a>
              </div>
              <div>
              <div id="collapseOne" class="accordion-body collapse in">
                <div class="accordion-inner">
                    <form id="formulario">
                        <table>
                            <tr>
                                <td>Estacion:</td>
                                <td><input type="text" class="form-control"  name="titulo" autocomplete="off"/></td>
                            </tr>
                            <tr>
                                <td>Coordenada X</td>
                                <td><input type="text" class="form-control" readonly  name="cx" autocomplete="off"/></td>
                            </tr>
                            <tr>
                                <td>Coordenada Y</td>
                                <td><input type="text" class="form-control"  readonly name="cy" autocomplete="off"/></td>
                            </tr>
                            
                            <tr>
                                <td></td>
                                <td><span id="loader_grabar" class=""></span></td>
                            </tr>
                            <tr>
                                <td><button type="button" id="btn_grabar" class="btn btn-success btn-sm">Grabar</button></td>
                                <td><button type="button" class="btn btn-danger btn-sm">Cancelar</button></td>
                            </tr>
                        </table>
                    </form>
                </div>
              </div>
            </div>
            </div>-->
            <div class="accordion-group">
              <div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
                  <h2>Informacion de la Estacion</h2>
                  <hr></hr>
                </a>
              </div>


                <div class="accordion-inner">
                  <form id="formulario_eliminar">
                      <input type="hidden" class="form-control"  name="id"/>
                        <form>
                             <div class="form-group">
                             <label for="Estacion">Estacion</label>
                             <input type="text"  readonly="readonly" class="form-control" name="titulo" autocomplete="off">
                        </div>
                        <div class="form-group">
                             <label for="Estacion">Punto de Ubicacion "A"</label>
                             <input type="text" readonly="readonly" class="form-control" name="cx" autocomplete="off">
                        </div>
                        <div class="form-group">
                             <label for="Estacion">Punto de Ubicacion "B"</label>
                             <input type="text" readonly="readonly" class="form-control" name="cy" autocomplete="off">
                        </div>
                            
                            <tr>
                                <td><button type="button" id="btn_actualizar" class="btn btn-success btn-sm">Actualizar</button></td>
                                <td><button type="button" id="btn_borrar" class="btn btn-danger btn-sm">Borrar</button></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><label>
                                    
                                  </label>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
              </div>
            </div>
            <div class="accordion-group">
              <div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">
                  Buscar
                </a>
              </div>
              <div id="collapseThree" class="accordion-body collapse">
                <div class="accordion-inner">
                  <form id="formulario_buscar">
                    <table>
                      <TR>
                        <td>
                          <input type="text" id="palabra_buscar"  class="form-control" autocomplete="off" />
                        </td>
                        <td>
                          <button type="button" id="btn_buscar"  class="btn btn-success btn-sm" >Buscar</button>
                        </td>
                      </TR>

                      <TR>
                        <td>
                          <select id="select_resultados">
                            <option value="uno">uno</option>
                          </select>
                        </td>
                        <td></td>
                      </TR>

                    </table>
                  </form>
                </div>
              </div>
            </div>
          </div>

    </div>

</div>
</div>

<!--slide bar menu end here-->
<script>
var toggle = true;
            
$(".sidebar-icon").click(function() {                
  if (toggle)
  {
    $(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
    $("#menu span").css({"position":"absolute"});
  }
  else
  {
    $(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
    setTimeout(function() {
      $("#menu span").css({"position":"relative"});
    }, 400);
  }               
                toggle = !toggle;
            });
</script>
<!--scrolling js-->
        <script src="js/jquery.nicescroll.js"></script>
        <script src="js/scripts.js"></script>
        <!--//scrolling js-->
<script src="js/bootstrap.js"> </script>
<!-- mother grid end here-->
</body>
</html>        

     
                              