<?php

class DBConnection {
    private $host = 'localhost';
    private $usuario = 'root';
    private $clave = '';
    private $db = 'tienda';
    private $conexion;

    public function __construct() {
        $this->conexion = new mysqli($this->host, $this->usuario, $this->clave, $this->db);
        if ($this->conexion->connect_errno) {
            die('Error de conexión: ' . $this->conexion->connect_error);
        }
    }

    public function read($tabla, $condicion = '1') {
        $sql = "SELECT * FROM $tabla WHERE $condicion";
        $resultado = $this->conexion->query($sql);
        if ($resultado) {
            return $resultado->fetch_all(MYSQLI_ASSOC);
        }
        return false;
    }

    public function close() {
        $this->conexion->close();
    }
}

?>