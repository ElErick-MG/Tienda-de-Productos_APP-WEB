<?php
session_start();
if (isset($_POST["nombre"]) && isset($_POST["clave"])) {
    $nombre = $_POST['nombre'];
    $clave = $_POST['clave'];
    $recordarme = isset($_POST['recordarme']);
    
    if($nombre == "test" && $clave == "test123"){
        $_SESSION["nombre"] = $nombre;
        $_SESSION["clave"] = $clave;
        
        if ($recordarme) {
            setcookie('nombre', $nombre, 0);
            setcookie('clave', $clave, 0);
            setcookie('recordarme', '1', 0);
        } else {
            foreach ($_COOKIE as $name => $value) {
                setcookie($name, '', 0);
            }
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