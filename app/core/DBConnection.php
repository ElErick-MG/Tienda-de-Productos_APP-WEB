<?php
require_once __DIR__ . '/../config/db.config.php';

/**
 * Clase de conexión y consulta a la base de datos MySQL.
 * Usa las constantes definidas en app/config/db.config.php.
 */
class DBConnection {
    private $conexion;

    public function __construct() {
        $this->conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($this->conexion->connect_errno) {
            die('Error de conexión: ' . $this->conexion->connect_error);
        }
        $this->conexion->set_charset('utf8mb4');
    }

    /**
     * Lee registros de una tabla con condición opcional.
     *
     * @param string $tabla     Nombre de la tabla
     * @param string $condicion Cláusula WHERE (por defecto devuelve todo)
     * @return array|false      Array asociativo de resultados o false en error
     */
    public function read(string $tabla, string $condicion = '1'): array|false {
        $sql = "SELECT * FROM $tabla WHERE $condicion";
        $resultado = $this->conexion->query($sql);
        if ($resultado) {
            return $resultado->fetch_all(MYSQLI_ASSOC);
        }
        return false;
    }

    public function close(): void {
        $this->conexion->close();
    }
}
