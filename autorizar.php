<?php
#para iniciar sesión se usa session_start()
session_start();

// Only accept POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $clave = isset($_POST['clave']) ? $_POST['clave'] : '';

    // Set session values
    $_SESSION['nombre'] = $nombre;
    $_SESSION['clave'] = $clave;

    // Handle "recordar" checkbox: set cookies for 24 hours if checked
    if (isset($_POST['recordar'])) {
        // setcookie(name, value, expire)
        setcookie('nombre', $nombre, time() + 24 * 3600, "/");
        setcookie('clave', $clave, time() + 24 * 3600, "/");
    } else {
        // clear cookies if exist
        if (isset($_COOKIE['nombre'])) {
            setcookie('nombre', '', time() - 3600, "/");
        }
        if (isset($_COOKIE['clave'])) {
            setcookie('clave', '', time() - 3600, "/");
        }
    }

    header("Location:mipanel.php");
    exit;
} else {
    header("Location:index.php");
    exit;
}

?>