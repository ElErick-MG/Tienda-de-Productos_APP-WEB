<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

// Cerrar Sesion
if (isset($_GET['logout'])) {
    session_destroy();
    foreach($_COOKIE as $name => $value){
        setcookie($name, '', 1); 
    } 
    header("Location:login.php");
    exit();
}

?>

<html>
    <head>
    </head>
    <body>
        <h2>Bienvenido: <?php echo $_SESSION['usuario']; ?></h2><br>
        <a href="panelprincipal.php">Panel Principal</a><br>
        <a href="carrito.php">Carrito de Compra</a><br>
        <a href="panelprincipal.php?logout=1">Cerrar Sesion</a>
    </body>
</html>