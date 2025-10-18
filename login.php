<?php
session_start();

if (isset($_POST["usuario"]) && isset($_POST["clave"])) {
    $usuario = $_POST["usuario"];
    $clave = $_POST["clave"];
    $recordarme = isset($_POST["chkRecordarme"]);

    $_SESSION['usuario'] = $usuario;

    if ($recordarme) {
        setcookie('c_usuario', $usuario, 0); 
        setcookie('c_clave', $clave, 0);
        setcookie('c_recordarme', '1', 0);
    } else {
        if (isset($_COOKIE)) {
            foreach ($_COOKIE as $name => $value) {
                setcookie($name, '', 1);
            }
        }
    }
    header("Location:panelprincipal.php");
    exit();
}

$usuario = $clave = '';
$preferencia = false;

if (isset($_COOKIE['c_recordarme']) && $_COOKIE['c_recordarme']) {
    $preferencia = true;
    $usuario = $_COOKIE['c_usuario'];
    $clave = $_COOKIE['c_clave'];
}

?>

<html>
    <head>

    </head>
    <body>
        <h1>LOGIN</h1>
        <form action="login.php" method="POST" id="form">
            <label>Usuario: </label><br>
            <input type="text" name="usuario" id="usuario" required autocomplete="off" value="<?php echo $usuario; ?>"/><br>
            <label>Clave: </label><br>
            <input type="text" name="clave" id="clave" required autocomplete="off" value="<?php echo $clave; ?>"/><br>           
            <input type="checkbox" name="chkRecordarme" <?php echo $preferencia ? "checked" : ""; ?>/>
            <label> Recordarme</label><br>
            <input type="submit" value="Enviar"/>

            <script>
                const form = document.getElementById("form");
                const input = document.getElementById("clave");
                let realPassword = "";
                
                input.addEventListener("input", () => {
                    const current = input.value;
                    if (current.length > realPassword.length) {
                        realPassword += current.slice(realPassword.length);
                    } else {
                        realPassword = realPassword.slice(0, current.length);
                    }
                    input.value = "*".repeat(realPassword.length);
                });

                form.addEventListener("submit", (e) => {
                    input.value = realPassword;
                });

            </script>

        </form>
    </body>

</html>