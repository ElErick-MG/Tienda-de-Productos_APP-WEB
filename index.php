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
        <form action="autorizar.php" method="POST" id="form">
            Usuario:<br>
            <input type="text" name="nombre" required value="<?php echo $stored_nombre; ?>"/><br>
            Clave:<br>
            <input type="text" id="clave" required/><br>
            <input type="hidden" name="clave" id="clave_real"/>
            <input type="checkbox" name="recordar" <?php echo $remember_checked; ?>/>Recordarme<br>
            <script>
                const form = document.getElementById("form");
                const input = document.getElementById("clave");
                const inputReal = document.getElementById("clave_real");
                let realPassword = "<?php echo $stored_clave; ?>";  
                
                if (realPassword.length > 0) {
                    input.value = "*".repeat(realPassword.length);
                }

                input.addEventListener("input", () => {
                    const current = input.value;
                    if (current.length > realPassword.length) {
                        realPassword += current.slice(realPassword.length);
                    } else {
                        realPassword = realPassword.slice(0, current.length);
                    }
                    inputReal.value = realPassword;
                    input.value = "*".repeat(realPassword.length);
                });

                form.addEventListener("submit", (e) => {
                    input.disabled = true;
                });
            </script>
            <input type="submit" name="btnEnviar" value="Enviar"/>
        </form>
    </body>
</html>