<?php
require_once __DIR__ . '/conexion/DBConnection.php';

// Validate id
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    http_response_code(400);
    echo "ID de producto inválido.";
    exit;
}

$id = (int) $_GET['id'];

$lang = isset($_COOKIE['lang']) ? $_COOKIE['lang'] : 'en';
$lang = ($lang === 'es') ? 'es' : 'en';

// Select table depending on language
$table = ($lang === 'es') ? 'productoses' : 'productosen';

$db = new DBConnection();
$results = $db->read($table, "id = $id");
$db->close();

if (!$results || count($results) === 0) {
    http_response_code(404);
    echo "Producto no encontrado.";
    exit;
}

$prod = $results[0];
?>
<!doctype html>
<html lang="<?php echo $lang === 'es' ? 'es' : 'en'; ?>">
<head>
    <meta charset="utf-8">
    <title>Producto - <?php echo htmlspecialchars($prod['nombre'], ENT_QUOTES, 'UTF-8'); ?></title>
</head>
<body>
    <h1><?php echo htmlspecialchars($prod['nombre'], ENT_QUOTES, 'UTF-8'); ?></h1>
    <p><strong>Descripción:</strong> <?php echo nl2br(htmlspecialchars($prod['descripcion'], ENT_QUOTES, 'UTF-8')); ?></p>
    <p><strong>Precio:</strong> $<?php echo htmlspecialchars($prod['precio'], ENT_QUOTES, 'UTF-8'); ?></p>

    <a href="carrito.php">Carrito</a>
    <p><a href="mipanel.php">Volver al Panel</a></p>
</body>
</html>