<?php
    $stored_nombre = isset($_COOKIE['nombre']) ? ($_COOKIE['nombre']) : '';
    $stored_clave = isset($_COOKIE['clave']) ? ($_COOKIE['clave']) : '';
    $remember_checked = (isset($_COOKIE['recordarme']) && $_COOKIE['recordarme'] === '1') ? 'checked' : '';
?>

<html>
    <head>
        <title>Tienda de Productos</title>
    </head>
    <body>
        <h1>LOGIN</h1>
        <form action="autorizar.php" method="POST">
            Usuario:<br>
            <input type="text" name="nombre" required value="<?php echo $stored_nombre; ?>"/><br>
            Clave:<br>
            <input type="password" name="clave" required value="<?php echo $stored_clave; ?>"/><br>
            <input type="checkbox" name="recordarme" <?php echo $remember_checked; ?>/>Recordarme<br>
            <input type="submit" name="btnEnviar" value="Enviar"/>
        </form>
    </body>
</html>