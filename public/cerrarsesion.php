<?php
session_start();

$selecRecordarme = isset($_COOKIE['recordarme']) && $_COOKIE['recordarme'] === '1';

session_destroy();

if (!$selecRecordarme) {
    // Borrar todas las cookies del sitio
    foreach (['nombre', 'clave', 'recordarme', 'lang'] as $cookieName) {
        setcookie($cookieName, '', time() - 3600, '/');
    }
}

header('Location: index.php');
exit;