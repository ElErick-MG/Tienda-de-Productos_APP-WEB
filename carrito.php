<?php
session_start();

//Validar que las sesiones existen
if (!isset($_SESSION['nombre']) || !isset($_SESSION['clave'])) {
    header("Location:index.php");
}

?>

<html>
    <head>
    </head>
    <body>
        <h1>Llegaste al carrito</h1><br>
        <h2>Bienvenido: <?php echo $_SESSION['nombre']; ?></h2><br>
        <a href="panelprincipal.php">Panel Principal</a><br>
        <a href="carrito.php">Carrito de Compra</a><br>
        <a href="panelprincipal.php?logout=1">Cerrar Sesion</a>
    </body>
</html>