<?php 
//Incluímos inicialmente la conexión a la base de datos
//require "../config/Conexion.php";

Class Combustible
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($idcombustible,$nombre,$imagen,$costo)
	{
		$sql="INSERT INTO combustible (idcombustible,nombre,imagen,costo,activo)
		VALUES ('$idcombustible','$nombre','$imagen','$costo','1')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idcombustible,$nombre,$imagen,$costo,$idestacion)
	{
		$sql="UPDATE combustible SET idcombustible='$idcombustible',nombre='$nombre',imagen='$imagen',costo='$costo'
		WHERE idcombustible='$idcombustible'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar registros
	public function desactivar($idcombustible)
	{
		$sql="UPDATE combustible SET activo='0' WHERE idcombustible='$idcombustible'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar registros
	public function activar($idarticulo)
	{
		$sql="UPDATE combustible SET activo='1' WHERE idcombustible='$idcombustible'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idcombustible)
	{
		$sql="SELECT * FROM combustible WHERE idcombustible='$idcombustible'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT a.idarticulo,a.idcategoria,c.nombre as categoria,a.codigo,a.nombre,a.stock,a.descripcion,a.imagen,a.condicion FROM articulo a INNER JOIN categoria c ON a.idcategoria=c.idcategoria";
		return ejecutarConsulta($sql);		
	}

	//Implementar un método para listar los registros activos
	public function listarActivos()
	{
		$sql="SELECT a.idarticulo,a.idcategoria,c.nombre as categoria,a.codigo,a.nombre,a.stock,a.descripcion,a.imagen,a.condicion FROM articulo a INNER JOIN categoria c ON a.idcategoria=c.idcategoria WHERE a.condicion='1'";
		return ejecutarConsulta($sql);		
	}

	}

?>