<?php
session_start();
if (isset($_POST["nombre"]) && isset($_POST["clave"])) {
    $nombre = $_POST['nombre'];
    $clave = $_POST['clave'];
    $recordarme = isset($_POST['recordar']);
    
    if($nombre == "test" && $clave == "test123"){
        $_SESSION["nombre"] = $nombre;
        $_SESSION["clave"] = $clave;
        
        if ($recordarme) {
            setcookie('nombre', $nombre, 0, '/');
            setcookie('clave', $clave, 0, '/');
            setcookie('recordarme', '1', 0, '/');
        } else {
            setcookie('nombre', '', time() - 3600, '/');
            setcookie('clave', '', time() - 3600, '/');
            setcookie('recordarme', '', time() - 3600, '/');
        }
        
        header("Location: mipanel.php");
        exit;
    } else {
        header("Location: index.php");
        exit;
    }
} else {
    header("Location: index.php");
    exit;
}
?>