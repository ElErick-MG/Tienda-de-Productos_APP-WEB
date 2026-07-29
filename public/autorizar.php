<?php
session_start();

if (!isset($_POST['nombre'], $_POST['clave'])) {
    header('Location: index.php');
    exit;
}

$nombre    = trim($_POST['nombre']);
$clave     = trim($_POST['clave']);
$recordarme = isset($_POST['recordarme']);

// Validación de credenciales (hardcoded para demo)
if ($nombre === 'test' && $clave === 'test123') {
    $_SESSION['nombre'] = $nombre;
    $_SESSION['clave']  = $clave;

    if ($recordarme) {
        setcookie('nombre',     $nombre, 0, '/');
        setcookie('clave',      $clave,  0, '/');
        setcookie('recordarme', '1',     0, '/');
    } else {
        // Limpiar cookies de sesión anteriores
        foreach (['nombre', 'clave', 'recordarme', 'lang'] as $cookieName) {
            setcookie($cookieName, '', time() - 3600, '/');
        }
    }

    header('Location: mipanel.php');
    exit;
}

// Credenciales incorrectas: redirigir con indicador de error
header('Location: index.php?error=1');
exit;