<?php
include_once 'conex.php';//INCLUIR CONEXION DE BASE DE DATOS

class puntosDao
{
    private $r;
    public function __construct()
    {
        $this->r = array();
    }


public function grabar($nombre, $lat,$lng)//METODO PARA GRABAR A LA BD
    {
        $con = conex::con();
        $nombre = mysqli_real_escape_string($con,$nombre);
        $lat = mysqli_real_escape_string($con,$lat);
        $lng = mysqli_real_escape_string($con,$lng);
        $q = "insert into estacion (nombre, lat, lng)".
             "values ('".addslashes($nombre)."','".addslashes($lat)."','".addslashes($lng)."')";
        $rpta = mysqli_query($con, $q);
        mysqli_close($con);
        if($rpta==1)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    public function listar_todo()
    {
        $q = "select * from estacion";
        $con = conex::con();
        $rpta = mysqli_query($con, $q);
        mysqli_close($con);
        while($fila = mysqli_fetch_assoc($rpta))
        {
            $this->r[] = $fila;
        }
        return $this->r;
    }
    public function borrar($idestacion)//METODO PARA BORRAR DE LA BD
    {
        $con = conex::con();
        $idestacion = mysqli_real_escape_string($con,$idestacion);
        $q = "delete from estacion where idestacion = ".(int)$idestacion;
        $rpta = mysqli_query($con, $q);
        mysqli_close($con);
        if($rpta==1)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    public function actualizar($id, $nombre, $lat,$lng)//METODO PARA ACTUALIZAR A LA BD
    {
        $con = conex::con();
        $id = mysqli_real_escape_string($con,$id);
        $nombre = mysqli_real_escape_string($con,$nombre);
        $lat = mysqli_real_escape_string($con,$lat);
        $lng = mysqli_real_escape_string($con,$lng);
        $q = "update estacion set nombre='".$nombre."', lat='".$lat."' , lng ='".$lng."' where idestacion =".$id;
        $rpta = mysqli_query($con, $q);
        mysqli_close($con);
        if($rpta==1)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function buscar($p)
    {
        $con = conex::con();
        //SEGURIDAD
        $p = mysqli_real_escape_string($con,$p);
        
        $q = "select * from estacion WHERE nombre LIKE '%".$p."%'";
        
        $rpta = mysqli_query($con, $q);
        mysqli_close($con);
        while($fila = mysqli_fetch_assoc($rpta))
        {
            $this->r[] = $fila;
        }
        return $this->r;
    }
}
?>