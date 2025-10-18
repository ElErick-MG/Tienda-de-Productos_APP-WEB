<?php
session_start();

//Validar que las sesiones existen
if (!isset($_SESSION['nombre']) || !isset($_SESSION['clave'])) {
    header("Location:index.php");
    exit();
} else {
    // Agregar producto al carrito
    $product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
    $product_name = isset($_POST['product_name']) ? $_POST['product_name'] : '';
    $product_price = isset($_POST['product_price']) ? (float)$_POST['product_price'] : 0.0;

    if ($product_id > 0 && $product_name !== '' && $product_price > 0) {
        // Inicializar carrito si no existe
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = [];
        }

        // Agregar producto al carrito
        $_SESSION['carrito'][] = [
            'id' => $product_id,
            'nombre' => $product_name,
            'precio' => $product_price
        ];
    }
}

// Obtener idioma para textos
$lang = isset($_COOKIE['lang']) ? $_COOKIE['lang'] : 'es';
$lang = ($lang === 'en') ? 'en' : 'es';

$textos = [
    'es' => [
        'titulo' => 'Carrito',
        'llegaste' => 'Llegaste al carrito',
        'bienvenido' => 'Bienvenido',
        'volver' => 'Volver al Panel',
        'ir_carrito' => 'Ir al Carrito 🛒',
        'cerrar' => 'Cerrar Sesión',
        'productos_carrito' => 'Productos en el carrito:',
        'no_productos' => 'No hay productos en el carrito.'
    ],
    'en' => [
        'titulo' => 'Cart',
        'llegaste' => 'You reached the cart',
        'bienvenido' => 'Welcome',
        'volver' => 'Back to Panel',
        'ir_carrito' => 'Go to Cart 🛒',
        'cerrar' => 'Log Out',
        'productos_carrito' => 'Products in cart:',
        'no_productos' => 'No products in cart.'
    ]
];

$t = $textos[$lang];
?>

<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo $t['titulo']; ?></title>
    </head>
    <body>
        <h1><?php echo $t['llegaste']; ?></h1>
        <h2><?php echo $t['bienvenido']; ?>: <?php echo $_SESSION["nombre"]; ?></h2>
        <nav>
            <ul>
                <li><a href="mipanel.php"><?php echo $t['volver']; ?></a></li>
                <li><a href="carrito.php"><?php echo $t['ir_carrito']; ?></a></li>
                <li><a href="cerrarsesion.php"><?php echo $t['cerrar']; ?></a></li>
            </ul>
        </nav>
        <h3><?php echo $t['productos_carrito']; ?></h3>
        <ul>
            <?php
            if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0) {
                foreach ($_SESSION['carrito'] as $item) {
                    echo "<li>" . $item['nombre'] . " - $" . number_format($item['precio'], 2) . "</li>";
                }
            } else {
                echo "<li>{$t['no_productos']}</li>";
            }
            ?>
        </ul>
        <br>
    </body>
</html>