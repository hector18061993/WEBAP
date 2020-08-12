<?php

require_once "config.php";
 
$titulo =  $cx = $cy = $direccion=  "";

$titulo_err = $cx_err = $cy_err = $direccion_err = "";
 
if(isset($_POST["id"]) && !empty($_POST["id"])){
    
    $id = $_POST["id"];
    
    $input_titulo = trim($_POST["titulo"]);
    if(empty($input_titulo)){
        $titulo_err = "favor de ingresar el nuevo nombre de la Estacion.";     
    } else{
        $titulo = $input_titulo;
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
 
       
    if(empty($nombre_err) && empty($cx_err) && empty($cy_err) && empty($direccion_err)){

        // Prepare an update statement
        $sql = "UPDATE estaciones SET titulo=?, cx=?, cy=?, direccion=? WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssi", $param_titulo, $param_cx, $param_cy, 
                $param_direccion, $param_id);
            
            // Set parameters
            $param_titulo = $titulo;
            $param_cx = $cx;
            $param_cy = $cy;
            $param_direccion = $direccion;
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
        
        
        $sql = "SELECT * FROM estaciones WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
          
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            
            $param_id = $id;
            
            
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    $titulo = $row["titulo"];
                    $cx = $row["cx"];
                    $cy = $row["cy"];
                    $direccion = $row["direccion"];
                                                          
                   
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
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<link href="../cssmapa/bootstrap.min.css" rel="stylesheet" />
<!-- Custom Theme files -->
<link href="../css/style.css" rel="stylesheet" type="text/css" media="all"/>
<!--icons-css-->
<link href="../css/font-awesome.css" rel="stylesheet"> 
<!--Google Fonts-->
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-2.0.3.min.js" ></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1aE0WtuiVtGobAxmOxnlDFAT_c1DM0ZE"type="text/javascript"></script>

<!--ARCHIVOS JAVASCRIPT DE BOOTSTRAP -->
<script type="text/javascript" src="../jsmapa/bootstrap.min.js" ></script>

    <style type="text/css">
    .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
                            <style>
        #mapa{ 
            width: 1350px;
            height: 350px;
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

     <div class="col-xs-12 col-sm-6 col-md-8">

    <div id="mapa" > 
            </div>
        </div>
    </div>
</div>

                <div class="col-md-12">
                    
                    <br><br>
                     <div class="col-md-12">
                    <div class="col-md-3">
                    <div class="form-group <?php echo (!empty($titulo_err)) ? 'has-error' : ''; ?>">
                        <h2><p class="form-control-static"><?php echo $row["titulo"]; ?></p></h2>
                        </div>                       

                        <div class="form-group <?php echo (!empty($direccion_err)) ? 'has-error' : ''; ?>">
                            <label>Direccion:</label>
                            <p class="form-control-static"><?php echo $row["direccion"]; ?></p>
                            <span class="help-block"><?php echo $direccion_err;?></span>
                        </div>

                    </div>
                    <div class="col-md-3">
                     <div class="form-group <?php echo (!empty($direccion_err)) ? 'has-error' : ''; ?>">
                            <label>Telefono:</label>
                            <p class="form-control-static"><?php echo $row["telefono"]; ?></p>
                            <span class="help-block"><?php echo $direccion_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($direccion_err)) ? 'has-error' : ''; ?>">
                            <label>Correo:</label>
                            <p class="form-control-static"><?php echo $row["correo"]; ?></p>
                            <span class="help-block"><?php echo $direccion_err;?></span>
                        </div>



                    </div>

                    <div class="col-md-3">
                    <div class="form-group <?php echo (!empty($direccion_err)) ? 'has-error' : ''; ?>">
                            <label>Servicios:</label>
                            <p class="form-control-static"><?php echo $row["servicios"]; ?></p>
                            <span class="help-block"><?php echo $direccion_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($direccion_err)) ? 'has-error' : ''; ?>">
                            <label>Horario:</label>
                            <p class="form-control-static"><?php echo $row["horarios"]; ?></p>
                            <span class="help-block"><?php echo $direccion_err;?></span>
                        </div>

                    </div>

                    <div class="col-md-3">
                    <div class="form-group <?php echo (!empty($direccion_err)) ? 'has-error' : ''; ?>">
                            <label>Combustibles:</label>
                            <p class="form-control-static"><?php echo $row["combustibles"]; ?></p>
                            <span class="help-block"><?php echo $direccion_err;?></span>
                        </div>

                    </div>

                        
                </div>
            </div>        
        </div>
    </div>
</body>
</html>


<!--IMPORTANTE RESPETAR EL ORDEN -->

<link href="css/bootstrap.min.css" rel="stylesheet" /> 

<script type="text/javascript" src="http://code.jquery.com/jquery-2.0.3.min.js" ></script>

<script type="text/javascript" src="js/bootstrap.min.js" ></script>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"> </script>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1aE0WtuiVtGobAxmOxnlDFAT_c1DM0ZE"type="text/javascript"></script>

    <script type="text/javascript">
        (function() { // generacion de mapa
            window.onload = function()
                {var sevilla = new google.maps.LatLng( <?php  echo $cx; ?>,<?php echo $cy;?>);
                 var opciones = {
                    zoom : 17,
                    center: sevilla,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                    };
                var div = document.getElementById('mapa');              
                var map = new google.maps.Map(div, opciones);   
                    var marcador = new google.maps.Marker({
                    position: new google.maps.LatLng(<?php echo $cx; ?>,<?php echo $cy;?>),
                    draggable: false,
                    map: map,
                    title: 'algo'});
                var markerLatLng = marcador.getPosition();
                document.getElementById('cx').value = markerLatLng.lat();
                document.getElementById('cy').value = markerLatLng.lng();   
                google.maps.event.addListener(
                marcador, 'dragend', function(){ markerLatLng = marcador.getPosition();
                document.getElementById('cx').value = markerLatLng.lat();
                document.getElementById('cy').value = markerLatLng.lng(); });
            }

        })();
    </script>





























     
                              











