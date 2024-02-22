<?php
class Conexion extends PDO {
    private $dsn = "mysql: host=localhost; dbname=itv; charset=utf8mb4";
    private $user = "dwes";
    private $pass = "abc123.";
    private $opt = array(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_OBJ);

    public function __construct() {
        parent::__construct($this->dsn, $this->user, $this->pass, $this->opt);
    }

    public function __get($name) {
        return $this->$name;
    }

    public function __set($name, $value) {
        $this->$name = $value;
    }
}



