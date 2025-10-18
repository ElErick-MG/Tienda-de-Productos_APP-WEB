<?php
session_start();

$selecRecordarme = isset($_COOKIE['recordarme']) && $_COOKIE['recordarme'];

session_destroy();
if (!$selecRecordarme) {
    //borro las cookies y navego al index.php
    foreach ($_COOKIE as $name => $value) {
        setcookie($name, '', 1);
    }
}
header("Location:index.php");
?>