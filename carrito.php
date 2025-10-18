<?php
session_start();

//Validar que las sesiones existen
if (!isset($_SESSION['nombre']) || !isset($_SESSION['clave'])) {
    header("Location:index.php");
}else {
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


?>

<html>
    <head>
    </head>
    <body>
        <h1>Llegaste al carrito</h1><br>
        <h2>Bienvenido: <?php echo $_SESSION['nombre']; ?></h2><br>
        <h3>Productos en el carrito:</h3>
        <ul>
            <?php
            if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0) {
                foreach ($_SESSION['carrito'] as $item) {
                    echo "<li>{$item['nombre']} - \${$item['precio']}</li>";
                }
            } else {
                echo "<li>No hay productos en el carrito.</li>";
            }
            ?>
        </ul>
        <a href="mipanel.php">Panel Principal</a><br>
        <a href="carrito.php">Carrito de Compra</a><br>
        <a href="panelprincipal.php?logout=1">Cerrar Sesion</a>
    </body>
</html>