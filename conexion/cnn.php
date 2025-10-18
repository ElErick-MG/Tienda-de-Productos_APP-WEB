<?php

$host = 'localhost';
$usuario = "root";
$clave = "";
$db = "tienda";

$conexion = new mysqli($host, $usuario, $clave, $db);
if ($conexion->connect_errno) {
    echo "Error de conexión ({$conexion->connect_errno}): " . htmlspecialchars($conexion->connect_error);
    exit;
}

// Determine language from cookie (set in mipanel.php). Default to 'es'.
if (isset($idioma)) {
    $lang = ($idioma === 'es') ? 'es' : 'en';
} elseif (isset($_GET['lang'])) {
    $lang = ($_GET['lang'] === 'es') ? 'es' : 'en';
} elseif (isset($_COOKIE['lang'])) {
    $lang = ($_COOKIE['lang'] === 'es') ? 'es' : 'en';
} else {
    // Por defecto cuando no hay GET ni cookie ni variable proporcionada
    $lang = 'es';
}

// Choose table based on language
$table = ($lang === 'es') ? 'productoses' : 'productosen';

// Check if table exists
$checkTable = "SHOW TABLES LIKE '" . $conexion->real_escape_string($table) . "'";
$resCheck = $conexion->query($checkTable);
if (!$resCheck) {
    echo "Error comprobando tablas: " . htmlspecialchars($conexion->error);
    $conexion->close();
    exit;
}

if ($resCheck->num_rows === 0) {
    echo "La tabla '$table' no existe en la base de datos '$db'.\n";
    echo "Comprueba que importaste 'conexion/tienda.sql' o que el nombre de la tabla es correcto.";
    $conexion->close();
    exit;
}

$sql = "SELECT id, nombre, descripcion, precio FROM $table";
$resultado = $conexion->query($sql);
if ($resultado === false) {
    echo "La consulta falló: " . htmlspecialchars($conexion->error);
    $conexion->close();
    exit;
}

if ($resultado->num_rows === 0) {
    echo "No existen resultados";
} else {
    while ($producto = $resultado->fetch_assoc()) {
        $id = (int)$producto['id'];
        $nombre = htmlspecialchars($producto['nombre'], ENT_QUOTES, 'UTF-8');
        // Relative link to the product page (mipanel.php includes this file from project root)
        echo "<a href=\"producto.php?id={$id}\">{$nombre}</a><br>";
    }
}

$conexion->close();

?>