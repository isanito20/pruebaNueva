<?php

class Itvs
{
    private $id;
    private $provincia;
    private $localidad;
    private $direccion;
    private $telefono;

    public function __construct($id = 0, $provincia = '', $localidad = '', $direccion = '', $telefono = 0)
    {
        $this->id = $id;
        $this->provincia = $provincia;
        $this->localidad = $localidad;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
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