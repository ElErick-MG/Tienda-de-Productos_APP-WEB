<?php
session_start();


if (isset($_POST["nombre"]) && isset($_POST["clave"])) {
    $nombre = $_POST['nombre'];
    $clave = $_POST['clave'];
    $recordarme = isset($_POST['recordar']);

    if($nombre == "test" && $clave == "test123"){
        // Set session values
        $_SESSION["nombre"] = $nombre;
        $_SESSION["clave"] = $clave;
        // Handle "recordar" checkbox: set cookies
        if ($recordarme) {
            setcookie('nombre', $nombre, 0);
            setcookie('clave', $clave, 0);
            setcookie('recordarme', $recordarme, 0);
        } else {
            // clear cookies if exist
            if (isset($_COOKIE['nombre'])) {
                setcookie('nombre', '', 0);
            }
            if (isset($_COOKIE['clave'])) {
                setcookie('clave', '', 0);
            }
        }
        header("Location:mipanel.php");
        exit;
    } else {
        // Credenciales incorrectas: volver al index
        header("Location: index.php");
        exit;
    }
} else {
    header("Location:index.php");
    exit;
}

?>