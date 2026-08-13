<?php
require_once __DIR__ . '/../config/db.config.php';

/**
 * Clase de conexión y consulta a la base de datos MySQL.
 * Usa las constantes definidas en app/config/db.config.php.
 */
class DBConnection {
    private $conexion;

    public function __construct() {
        if (defined('DEMO_MODE') && DEMO_MODE === true) {
            return; // Omitir conexión real a la base de datos en modo demo
        }
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
        if (defined('DEMO_MODE') && DEMO_MODE === true) {
            return $this->getMockData($tabla, $condicion);
        }
        $sql = "SELECT * FROM $tabla WHERE $condicion";
        $resultado = $this->conexion->query($sql);
        if ($resultado) {
            return $resultado->fetch_all(MYSQLI_ASSOC);
        }
        return false;
    }

    public function close(): void {
        if (defined('DEMO_MODE') && DEMO_MODE === true) return;
        $this->conexion->close();
    }

    /**
     * Devuelve datos estáticos de prueba (Mock) cuando no hay MySQL.
     */
    private function getMockData(string $tabla, string $condicion): array {
        $data = [];
        if ($tabla === 'productoses') {
            $data = [
                ['id' => 1, 'nombre' => 'Camiseta básica', 'descripcion' => 'Camiseta de algodón 100% color blanco', 'precio' => '9.99'],
                ['id' => 2, 'nombre' => 'Pantalón de mezclilla', 'descripcion' => 'Pantalón de jean azul para hombre', 'precio' => '24.50'],
                ['id' => 3, 'nombre' => 'Zapatillas deportivas', 'descripcion' => 'Zapatillas ligeras para correr', 'precio' => '39.90'],
                ['id' => 4, 'nombre' => 'Reloj digital', 'descripcion' => 'Reloj resistente al agua con cronómetro', 'precio' => '19.75'],
                ['id' => 5, 'nombre' => 'Mochila escolar', 'descripcion' => 'Mochila con múltiples compartimientos', 'precio' => '15.20'],
                ['id' => 6, 'nombre' => 'Gorra ajustable', 'descripcion' => 'Gorra de color negro con logotipo bordado', 'precio' => '8.99'],
                ['id' => 7, 'nombre' => 'Audífonos Bluetooth', 'descripcion' => 'Auriculares inalámbricos con micrófono', 'precio' => '29.99']
            ];
        } else if ($tabla === 'productosen') {
            $data = [
                ['id' => 1, 'nombre' => 'Basic T-Shirt', 'descripcion' => '100% cotton white t-shirt', 'precio' => '9.99'],
                ['id' => 2, 'nombre' => 'Denim Jeans', 'descripcion' => 'Blue jeans for men', 'precio' => '24.50'],
                ['id' => 3, 'nombre' => 'Running Sneakers', 'descripcion' => 'Lightweight sneakers for running', 'precio' => '39.90'],
                ['id' => 4, 'nombre' => 'Digital Watch', 'descripcion' => 'Waterproof watch with stopwatch', 'precio' => '19.75'],
                ['id' => 5, 'nombre' => 'School Backpack', 'descripcion' => 'Backpack with multiple compartments', 'precio' => '15.20'],
                ['id' => 6, 'nombre' => 'Adjustable Cap', 'descripcion' => 'Black cap with embroidered logo', 'precio' => '8.99'],
                ['id' => 7, 'nombre' => 'Bluetooth Headphones', 'descripcion' => 'Wireless earbuds with microphone', 'precio' => '29.99']
            ];
        }

        // Si la condición busca un ID específico (ej. "id = 1")
        if (preg_match('/id\s*=\s*(\d+)/i', $condicion, $matches)) {
            $id = (int)$matches[1];
            foreach ($data as $item) {
                if ($item['id'] === $id) {
                    return [$item];
                }
            }
            return [];
        }

        return $data;
    }
}
