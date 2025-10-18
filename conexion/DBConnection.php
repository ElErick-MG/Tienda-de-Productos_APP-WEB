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

    public function create($tabla, $datos) {
        $columnas = implode(", ", array_keys($datos));
        $valores = "'" . implode("', '", array_map([$this->conexion, 'real_escape_string'], array_values($datos))) . "'";
        $sql = "INSERT INTO $tabla ($columnas) VALUES ($valores)";
        return $this->conexion->query($sql);
    }

    public function read($tabla, $condicion = '1') {
        $sql = "SELECT * FROM $tabla WHERE $condicion";
        $resultado = $this->conexion->query($sql);
        if ($resultado) {
            return $resultado->fetch_all(MYSQLI_ASSOC);
        }
        return false;
    }

    public function update($tabla, $datos, $condicion) {
        $set = [];
        foreach ($datos as $col => $val) {
            $set[] = "$col='" . $this->conexion->real_escape_string($val) . "'";
        }
        $setStr = implode(", ", $set);
        $sql = "UPDATE $tabla SET $setStr WHERE $condicion";
        return $this->conexion->query($sql);
    }

    public function delete($tabla, $condicion) {
        $sql = "DELETE FROM $tabla WHERE $condicion";
        return $this->conexion->query($sql);
    }

    public function close() {
        $this->conexion->close();
    }
}

?>