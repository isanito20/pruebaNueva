<?php

class Vehiculo
{
    public $matricula;
    public $marca;
    public $modelo;
    public $color;
    public $plazas;
    public $fecha_ultima_revision;
    

    public function __construct($matricula = '', $marca = '', $modelo = '', $color = '', $plazas = 0, $fecha_ultima_revision = '')
    {
        $this->matricula = $matricula;
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->color = $color;
        $this->plazas = $plazas;
        $this->fecha_ultima_revision = $fecha_ultima_revision;
    }


    public function __get($name)
    {
        return $this->$name;
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }
}

?>