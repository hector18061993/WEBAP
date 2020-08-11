<?php 
//ob_start();
//if (strlen(session_id()) < 1){
	//session_start();//Validamos si existe o no la sesión
//}
//if (!isset($_SESSION["nombre"]))
//{
  //header("Location: ../vistas/login.html");//Validamos el acceso solo a los usuarios logueados al sistema.
//}
//else
//{
//Validamos el acceso solo al usuario logueado y autorizado.
//if ($_SESSION['almacen']==1)
//{	
require_once "../modelos/Combustible.php";

$combustible=new Combustible();

$idcombustible=isset($_POST["idecombustible"])? limpiarCadena($_POST["idcombustible"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$imagen=isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";
$costo=isset($_POST["costo"])? limpiarCadena($_POST["costo"]):"";
$idestacion=isset($_POST["idestacion"])? limpiarCadena($_POST["idestacion"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':

		if (!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name']))
		{
			$imagen=$_POST["imagenactual"];
		}
		else 
		{
			$ext = explode(".", $_FILES["imagen"]["name"]);
			if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png")
			{
				$imagen = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/articulos/" . $imagen);
			}
		}

		if (empty($idcombustible)){
			$rspta=$combustible->insertar($idcombustible,$nombre,$imagen,$costo,$idestacion);
			echo $rspta ? "Combustible registrado" : "Combustible no se pudo registrar";
		}
		else {
			$rspta=$combustible->editar($idcombustible,$nombre,$imagen,$costo,$idestacion);
			echo $rspta ? "Combustible actualizado" : "Combustible no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$combustible->desactivar($idcombustible);
 		echo $rspta ? "Combustible Desactivado" : "Combustible no se puede desactivar";
	break;

	case 'activar':
		$rspta=$combustible->activar($idcombustible);
 		echo $rspta ? "Combustible activado" : "Combustible no se puede activar";
	break;

	case 'mostrar':
		$rspta=$combustible->mostrar($idcombustible);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$combustible->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idcombustible.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idcombustible.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->idcombustible.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idcombustible.')"><i class="fa fa-check"></i></button>',
 				"1"=>$reg->nombre,
 				"2"=>"<img src='../files/articulos/".$reg->imagen."' height='50px' width='50px' >",
 				"3"=>$reg->costo,
 				"4"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':
 				'<span class="label bg-red">Desactivado</span>'
 				);
 				
 				
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case "selectCombustible":
		require_once "../modelos/Combustible.php";
		$combustible = new Combustible();

		$rspta = $combustible->select();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idcombustible . '>' . $reg->nombre . '</option>';
				}
	break;
}
//Fin de las validaciones de acceso
}
else
{
  require 'noacceso.php';
}
}
ob_end_flush();
?>