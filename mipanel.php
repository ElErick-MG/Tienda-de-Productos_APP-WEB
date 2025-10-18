<?php
#crear sesión o reiniciar una preexistente
session_start();

#Validar que las sesiones existen y no son vacías (También para SESSION[clave])
if($_SESSION["nombre"]=="" || $_SESSION["nombre"]== null){
    header("Location:index.php");
}

?>

<html>
    <head>
    </head>
    <body>
        <h1>PANEL PRINCIPAL</h1>
        <h3>Bienvenido Usuario: <?php echo htmlspecialchars($_SESSION["nombre"]);  ?></h3>

        <!-- Language selector form -->
        <?php
        // handle language change form
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['lang'])) {
            $lang = $_POST['lang'] === 'es' ? 'es' : 'en';
            // set language cookie for 24 hours
            setcookie('lang', $lang, time() + 24 * 3600, "/");
            // reload to apply
            header("Location: mipanel.php");
            exit;
        }

        $current_lang = isset($_COOKIE['lang']) ? $_COOKIE['lang'] : 'en';
        ?>

        <form method="POST" action="cnn.php">
            Seleccione idioma:
            <select name="lang">
                <option value="en" <?php echo ($current_lang === 'en') ? 'selected' : ''; ?>>EN</option>
                <option value="es" <?php echo ($current_lang === 'es') ? 'selected' : ''; ?>>ES</option>
            </select>
            <input type="submit" value="Guardar" />
        </form>

        <p><a href="cerrarsesion.php">Cerrar Sesion</a></p>

        <h2>Categorías</h2>
        <div>
            <?php include 'leer.php'; ?>
        </div>
    </body>
</html>