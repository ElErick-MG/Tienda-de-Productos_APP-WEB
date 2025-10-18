<?php
session_start();

//Validar que las sesiones existen
if (!isset($_SESSION['nombre']) || !isset($_SESSION['clave'])) {
    header("Location:index.php");
}

$idiomaDefecto = 'es';
$selecRecordarme = isset($_COOKIE['recordarme']) && $_COOKIE['recordarme'];

// Determinar idioma: GET > cookie > por defecto
$idioma = $idiomaDefecto;
if (isset($_GET['lang'])) {
    $idioma = $_GET['lang'];
    if ($selecRecordarme) {
        // guardar preferencia en cookie
        setcookie('lang', $idioma, 0);

    }
} elseif (!isset($_GET['lang']) && isset($_COOKIE['lang'])) {
    $idioma = $_COOKIE['lang'] ? $_COOKIE['lang'] : $idiomaDefecto;
}else {
    // No hay GET ni cookie: usar por defecto y, si eligió "recordarme", guardar 'es'
    if ($selecRecordarme) {
        setcookie('lang', $idioma, 0);
    }
}
//definir titulo segun idioma
$titulo_productos = ($idioma === 'en') ? 'Product List' : 'Lista de Productos';
?>

<html>
    <head>
        <title>Tienda de Productos</title>
    </head>
    <body>
        <h1>PANEL PRINCIPAL</h1>
        <h3>Bienvenido Usuario: <?php echo $_SESSION["nombre"] ?></h3>

        <a href="mipanel.php?lang=es">ES (Español)</a> |
        <a href="mipanel.php?lang=en">EN (English)</a>
        <br>
        <p><a href="cerrarsesion.php">Cerrar Sesion</a></p>

        <h2><?php echo $titulo_productos; ?></h2>
        <div>
            <?php include __DIR__ . '/conexion/cnn.php'; ?>
        </div>
        <br>
        <br>
        <a href="carrito.php">Ir al Carrito 🛒</a>
    </body>
</html>