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

//Resultados de la consulta
$sql = "SELECT id, nombre, descripcion, precio FROM $table";
$resultado = $conexion->query($sql);
if ($resultado === false) {
    echo "La consulta falló: ";
    $conexion->close();
    exit;
}else if ($resultado->num_rows === 0) {
    echo "No existen resultados";
} else {
    while ($producto = $resultado->fetch_assoc()) { #trae datos [fetch]- array[associated]
        $id = (int)$producto['id'];
        $nombre = $producto['nombre'];
        echo "<a href=\"producto.php?id={$id}\">{$nombre}</a><br>";
    }
}

$conexion->close();

?>