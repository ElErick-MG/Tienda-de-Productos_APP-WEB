<?php
session_start();

//Validar que las sesiones existen
if (!isset($_SESSION['nombre']) || !isset($_SESSION['clave'])) {
    header("Location:index.php");
}

$selecRecordarme = isset($_COOKIE['recordarme']) && $_COOKIE['recordarme'];
$idioma = 'es';

if (isset($_GET['lang'])) {
    $idioma = $_GET['lang'];
    if ($selecRecordarme) {
        setcookie('lang', $idioma, 0);
    }
} elseif (isset($_COOKIE['lang'])) {
    $idioma = $_COOKIE['lang'];
} else {
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
        <h2>Bienvenido: <?php echo $_SESSION["nombre"] ?></h2>
        <a href="mipanel.php?lang=es">ES (Español)</a> |
        <a href="mipanel.php?lang=en">EN (English)</a>
        <br>
        <nav>
            <ul>
                <li><a href="mipanel.php">Panel Principal</a></li>
                <li><a href="carrito.php">Ir al Carrito 🛒</a></li>
                <li><a href="cerrarsesion.php">Cerrar Sesion</a></li>
            </ul>
        </nav>
        <h2><?php echo $titulo_productos; ?></h2>
        <div>
            <?php
            require_once __DIR__ . '/conexion/DBConnection.php';
            
            $lang = $idioma;
            $table = ($lang === 'es') ? 'productoses' : 'productosen';
            
            $db = new DBConnection();
            $productos = $db->read($table);
            $db->close();
            
            if ($productos === false) {
                echo "La consulta falló: ";
            } elseif (count($productos) === 0) {
                echo "No existen resultados";
            } else {
                foreach ($productos as $producto) {
                    $id = (int)$producto['id'];
                    $nombre = $producto['nombre'];
                    echo "<a href=\"producto.php?id={$id}\">{$nombre}</a><br>";
                }
            }
            ?>
        </div>
        <br>
        <br>
    </body>
</html>