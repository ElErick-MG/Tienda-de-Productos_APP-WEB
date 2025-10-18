<html>
    <head>
        <title>Mi sistema</title>
    </head>
    <body>
        <h1>LOGIN</h1>
        <?php
        // Prefill from cookies if present
        $stored_nombre = isset($_COOKIE['nombre']) ? htmlspecialchars($_COOKIE['nombre']) : '';
        $stored_clave = isset($_COOKIE['clave']) ? htmlspecialchars($_COOKIE['clave']) : '';
        $remember_checked = ($stored_nombre !== '' || $stored_clave !== '') ? 'checked' : '';
        ?>
        <form action="autorizar.php" method="POST">
            Usuario:<br>
            <input type="text" name="nombre" value="<?php echo $stored_nombre; ?>"/><br>
            Clave:<br>
            <input type="password" name="clave" value="<?php echo $stored_clave; ?>"/><br>
            <input type="checkbox" name="recordar" <?php echo $remember_checked; ?>/>Recordar<br>
            <input type="submit" name="btnEnviar"/>
        </form>
    </body>
</html>