<?php

class Citas
{
    private $matricula;
    private $id_itv;
    private $fecha;
    private $hora;
    private $ficha;

    public function __construct($matricula = '', $id_itv = 0, $fecha = '', $hora = '', $ficha = '')
    {
        $this->matricula = $matricula;
        $this->id_itv = $id_itv;
        $this->fecha = $fecha;
        $this->hora = $hora;
        $this->ficha = $ficha;
    }

    // Puedes agregar métodos adicionales según sea necesario

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