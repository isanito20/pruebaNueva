<?php

require_once '../Model/Usuario.php';
require_once '../Model/Itvs.php';
require_once '../Model/Vehiculo.php';
require_once '../Model/Citas.php';

require_once 'Connection.php';

class UsuarioController {

 public static function buscarUsuarios($user) {//busco los usuarios por el usuariodni vaya el que pongo en el login que es ese $dni
        try {
            $conex = new Conexion();
            $stmt = $conex->prepare("SELECT * FROM usuario WHERE user = :user");//selecciono todos los datos de usuario where que es donde el dni
            //sea igual al dni que ponga yo en el login asi de facil
            $stmt->bindParam(':user', $user);
            $stmt->execute();

            $rowCount = $stmt->rowCount(); //resumo esto para abajo poner solo la variable, pero que vaya que lo copie de algun lado por eso ese resumen jaja

            if ($rowCount > 0) {
                $reg = $stmt->fetchObject();
                $c = new Usuario($reg->provincia, $reg->nombre, $reg->telefono, $reg->user, $reg->pass);
            } else {
                $c = false;
            }
        } catch (Exception $ex) {
            $c = false;
            echo $ex->getMessage();
        }
        return $c;
    }
    
    public static function buscarProvincias($cod) {

        try {
            $conex = new Conexion();
            $result = $conex->query("SELECT * FROM itvs WHERE provincia = '$cod'");

            if ($result->rowCount()) {
                while ($reg = $result->fetchObject()) {
                    $listarItv[] = new Itvs($reg->id, $reg->provincia, $reg->localidad, $reg->direccion, $reg->telefono);
                }
            } else {
                $listarItv = false;
            }
        } catch (Exception $ex) {
            $listarItv = false;
            echo $ex->getMessage();
        }
        return $listarItv;
    }
          public static function buscarCitas($cod) {

        try {
            $conex = new Conexion();
            $result = $conex->query("SELECT matricula FROM citas WHERE id_itv = '$cod'");

            if ($result->rowCount()) {
                while ($reg = $result->fetchObject()) {
                    $cita[] = $reg->matricula;
                }
            } else {
                $cita= false;
            }
        } catch (Exception $ex) {
            $cita = false;
            echo $ex->getMessage();
        }
        return $cita;
    }
    
    
     public static function buscarCitasParaExistir ($cod) {//busco los usuarios por el usuariodni vaya el que pongo en el login que es ese $dni
        try {
            $conex = new Conexion();
            $stmt = $conex->prepare("SELECT * FROM citas WHERE matricula = '$cod'");//selecciono todos los datos de usuario where que es donde el dni
            //sea igual al dni que ponga yo en el login asi de facil
            $stmt->execute();

            $rowCount = $stmt->rowCount(); //resumo esto para abajo poner solo la variable, pero que vaya que lo copie de algun lado por eso ese resumen jaja

            if ($rowCount > 0) {
                $reg = $stmt->fetchObject();
                $c = new Citas($reg->matricula, $reg->id_itv, $reg->fecha, $reg->hora, $reg->ficha);
            } else {
                $c = false;
            }
        } catch (Exception $ex) {
            $c = false;
            echo $ex->getMessage();
        }
        return $c;
    }
    
    
    
    
    public static function buscarProvinciaObjeto($cod) {//busco los usuarios por el usuariodni vaya el que pongo en el login que es ese $dni
        try {
            $conex = new Conexion();
            $stmt = $conex->prepare("SELECT * FROM itvs WHERE provincia = '$cod'");//selecciono todos los datos de usuario where que es donde el dni
            //sea igual al dni que ponga yo en el login asi de facil
            $stmt->execute();

            $rowCount = $stmt->rowCount(); //resumo esto para abajo poner solo la variable, pero que vaya que lo copie de algun lado por eso ese resumen jaja

            if ($rowCount > 0) {
                $reg = $stmt->fetchObject();
                $c = new Itvs($reg->id, $reg->provincia, $reg->localidad, $reg->direccion, $reg->telefono);
            } else {
                $c = false;
            }
        } catch (Exception $ex) {
            $c = false;
            echo $ex->getMessage();
        }
        return $c;
    }
    public static function buscarVehiculos($cod) {

        try {
            $conex = new Conexion();
            $result = $conex->query("SELECT * FROM vehiculo WHERE matricula = '$cod'");

            if ($result->rowCount()) {
                while ($reg = $result->fetchObject()) {
                    $vehiculo[] = new Vehiculo($reg->matricula, $reg->marca, $reg->modelo, $reg->color, $reg->plazas, $reg->fecha_ultima_revision);
                }
            } else {
                $vehiculo = false;
            }
        } catch (Exception $ex) {
            $vehiculo = false;
            echo $ex->getMessage();
        }
        return $vehiculo;
    }
    
     public static function buscarVehiculoObjeto($cod) {//busco los usuarios por el usuariodni vaya el que pongo en el login que es ese $dni
        try {
            $conex = new Conexion();
            $stmt = $conex->prepare("SELECT * FROM vehiculo WHERE matricula = '$cod'");//selecciono todos los datos de usuario where que es donde el dni
            //sea igual al dni que ponga yo en el login asi de facil
            $stmt->execute();

            $rowCount = $stmt->rowCount(); //resumo esto para abajo poner solo la variable, pero que vaya que lo copie de algun lado por eso ese resumen jaja

            if ($rowCount > 0) {
                $reg = $stmt->fetchObject();
                $c = new Vehiculo($reg->matricula, $reg->marca, $reg->modelo, $reg->color, $reg->plazas, $reg->fecha_ultima_revision);
            } else {
                $c = false;
            }
        } catch (Exception $ex) {
            $c = false;
            echo $ex->getMessage();
        }
        return $c;
    }
    
    
    
 public static function buscarVehiculos2($cod) {
    try {
        $conex = new Conexion();
        $result = $conex->query("SELECT v.matricula, v.marca, v.modelo, c.fecha, c.hora 
                                FROM vehiculo v
                                INNER JOIN citas c ON v.matricula = c.matricula
                                WHERE c.id_itv = '$cod'");

        if ($result->rowCount()) {
            while ($reg = $result->fetchObject()) {
                $cita[] = array(
                    'matricula' => $reg->matricula,
                    'marca' => $reg->marca,
                    'modelo' => $reg->modelo,
                    'fecha' => $reg->fecha,
                    'hora' => $reg->hora
                );
            }
        } else {
            $cita = false;
        }
    } catch (Exception $ex) {
        $cita = false;
        echo $ex->getMessage();
    }
    return $cita;
}


    
    
}


