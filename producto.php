<?php
session_start();
include_once __DIR__ . '/conexion/DBConnection.php';

if (!isset($_SESSION['nombre']) || !isset($_SESSION['clave'])) {
    header("Location:index.php");
    exit();
}

// Validate id
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    http_response_code(400);
    echo "ID de producto inválido.";
    exit;
}

$id = (int) $_GET['id'];

// Obtener idioma de cookie, por defecto 'es'
$lang = isset($_COOKIE['lang']) ? $_COOKIE['lang'] : 'es';
$lang = ($lang === 'en') ? 'en' : 'es';

// Seleccionar tabla según idioma
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

// Textos según idioma
$textos = [
    'es' => [
        'producto' => 'PRODUCTO',
        'bienvenido' => 'Bienvenido',
        'volver' => 'Volver al Panel',
        'carrito' => 'Ir al Carrito 🛒',
        'cerrar' => 'Cerrar Sesión',
        'descripcion' => 'Descripción',
        'precio' => 'Precio',
        'agregar' => 'Agregar al Carrito 🛒'
    ],
    'en' => [
        'producto' => 'PRODUCT',
        'bienvenido' => 'Welcome',
        'volver' => 'Back to Panel',
        'carrito' => 'Go to Cart 🛒',
        'cerrar' => 'Log Out',
        'descripcion' => 'Description',
        'precio' => 'Price',
        'agregar' => 'Add to Cart 🛒'
    ]
];

$t = $textos[$lang];
?>
<!doctype html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="utf-8">
    <title><?php echo $t['producto']; ?> - <?php echo $prod['nombre']; ?></title>
</head>
<body>
    <h1><?php echo $t['producto']; ?></h1>
    <h2><?php echo $t['bienvenido']; ?>: <?php echo $_SESSION["nombre"]; ?></h2>
    <nav>
        <ul>
            <li><a href="mipanel.php"><?php echo $t['volver']; ?></a></li>
            <li><a href="carrito.php"><?php echo $t['carrito']; ?></a></li>
            <li><a href="cerrarsesion.php"><?php echo $t['cerrar']; ?></a></li>
        </ul>
    </nav>
    <h3><?php echo "Id: " . $id . " - " . $prod['nombre']; ?></h3>
    <p><strong><?php echo $t['descripcion']; ?>:</strong> <?php echo nl2br($prod['descripcion']); ?></p>
    <p><strong><?php echo $t['precio']; ?>:</strong> $<?php echo number_format($prod['precio'], 2); ?></p>

    <form action="carrito.php" method="post">
        <input type="hidden" name="product_id" value="<?php echo $id; ?>">
        <input type="hidden" name="product_name" value="<?php echo $prod['nombre']; ?>">
        <input type="hidden" name="product_price" value="<?php echo $prod['precio']; ?>">
        <button type="submit"><?php echo $t['agregar']; ?></button>
    </form>
</body>
</html>