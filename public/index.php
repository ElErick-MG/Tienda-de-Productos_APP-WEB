<?php
require_once __DIR__ . '/../app/helpers/session.helper.php';

$lang  = isset($_COOKIE['lang']) && in_array($_COOKIE['lang'], ['es','en']) ? $_COOKIE['lang'] : 'es';
$texts = loadTexts($lang, 'login');

$stored_nombre  = isset($_COOKIE['nombre'])    ? htmlspecialchars($_COOKIE['nombre'])    : '';
$stored_clave   = isset($_COOKIE['clave'])     ? htmlspecialchars($_COOKIE['clave'])     : '';
$remember_checked = (isset($_COOKIE['recordarme']) && $_COOKIE['recordarme'] === '1') ? 'checked' : '';
$show_error = isset($_GET['error']) && $_GET['error'] === '1';
?>
<!doctype html>
<html lang="<?php echo $lang; ?>">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Inicia sesión en la Tienda de Productos para explorar nuestro catálogo.">
  <title><?php echo $texts['titulo']; ?></title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="login-page">

  <main class="login-card" role="main">

    <div class="login-logo">
      <div class="login-logo-icon">🛍️</div>
    </div>

    <div class="login-heading">
      <h1><?php echo $texts['encabezado']; ?></h1>
      <p><?php echo $texts['subtitulo']; ?></p>
    </div>

    <?php if ($show_error): ?>
    <div class="alert alert-error" role="alert">
      <span>⚠️</span>
      <span><?php echo $texts['error']; ?></span>
    </div>
    <?php endif; ?>

    <form id="login-form" action="autorizar.php" method="POST" novalidate>

      <div class="form-group">
        <label class="form-label" for="input-nombre"><?php echo $texts['usuario']; ?></label>
        <input
          id="input-nombre"
          class="form-input"
          type="text"
          name="nombre"
          required
          autocomplete="username"
          placeholder="test"
          value="<?php echo $stored_nombre; ?>"
        >
      </div>

      <div class="form-group">
        <label class="form-label" for="input-clave"><?php echo $texts['clave']; ?></label>
        <input
          id="input-clave"
          class="form-input"
          type="password"
          name="clave"
          required
          autocomplete="current-password"
          placeholder="••••••••"
          value="<?php echo $stored_clave; ?>"
        >
      </div>

      <label class="form-check" for="input-recordarme">
        <input id="input-recordarme" type="checkbox" name="recordarme" <?php echo $remember_checked; ?>>
        <span class="form-check-label"><?php echo $texts['recordarme']; ?></span>
      </label>

      <button id="btn-login" class="btn btn-primary btn-full btn-lg" type="submit">
        <?php echo $texts['btn_entrar']; ?> →
      </button>

    </form>

  </main>

  <script src="assets/js/main.js"></script>
</body>
</html>
