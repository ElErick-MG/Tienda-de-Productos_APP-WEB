<?php
require_once __DIR__ . '/../app/helpers/session.helper.php';
require_once __DIR__ . '/../app/core/DBConnection.php';

requireSession();

$lang   = resolveLanguage();
$texts  = loadTexts($lang, 'panel');
$table  = productsTable($lang);
$count  = cartCount();

$db       = new DBConnection();
$products = $db->read($table);
$db->close();

$icons = ['👕','👖','👟','⌚','🎒','🧢','🎧','💻','📱','🛍️'];
?>
<!doctype html>
<html lang="<?php echo $lang; ?>">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Panel principal de la Tienda de Productos — explora el catálogo.">
  <title><?php echo $texts['titulo_pagina']; ?></title>
  <meta id="cart-count-meta" name="cart-count" content="<?php echo $count; ?>">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

  <!-- NAVBAR -->
  <nav class="navbar" role="navigation" aria-label="Navegación principal">
    <div class="navbar-brand">
      <div class="brand-icon">🛍️</div>
      <span>Tienda de Productos</span>
    </div>

    <ul class="navbar-nav">
      <li>
        <a href="mipanel.php" class="nav-link active" id="nav-panel">
          🏠 <?php echo $texts['nav_panel']; ?>
        </a>
      </li>
      <li>
        <a href="carrito.php" class="nav-link" id="nav-cart">
          🛒 <?php echo $texts['nav_carrito']; ?>
          <span id="cart-count-badge" class="cart-badge" style="display:none">0</span>
        </a>
      </li>
    </ul>

    <div style="display:flex;align-items:center;gap:0.5rem">
      <!-- Selector de idioma -->
      <div class="nav-lang">
        <a href="mipanel.php?lang=es" class="lang-btn <?php echo $lang === 'es' ? 'active' : ''; ?>">ES</a>
        <a href="mipanel.php?lang=en" class="lang-btn <?php echo $lang === 'en' ? 'active' : ''; ?>">EN</a>
      </div>
      <div class="nav-divider"></div>
      <a href="cerrarsesion.php" class="btn-logout" id="nav-logout">
        🔓 <?php echo $texts['nav_cerrar']; ?>
      </a>
    </div>
  </nav>

  <!-- CONTENIDO -->
  <main class="page-wrapper" role="main">

    <header class="page-header">
      <h1><?php echo $texts['lista_productos']; ?></h1>
      <p><?php echo $texts['bienvenido']; ?>, <strong><?php echo htmlspecialchars($_SESSION['nombre']); ?></strong></p>
    </header>

    <section aria-label="Catálogo de productos">
      <?php if ($products === false): ?>
        <div class="alert alert-error">
          <span>⚠️</span><span><?php echo $texts['error_consulta']; ?></span>
        </div>
      <?php elseif (count($products) === 0): ?>
        <div class="alert alert-error">
          <span>📭</span><span><?php echo $texts['sin_resultados']; ?></span>
        </div>
      <?php else: ?>
        <div class="products-grid">
          <?php foreach ($products as $i => $producto):
            $id     = (int)$producto['id'];
            $nombre = htmlspecialchars($producto['nombre']);
            $icon   = $icons[$i % count($icons)];
            $iconClass = 'icon-' . ($i % 7);
          ?>
          <article class="product-card" id="product-card-<?php echo $id; ?>">
            <div class="product-card-icon <?php echo $iconClass; ?>"><?php echo $icon; ?></div>
            <div class="product-card-name"><?php echo $nombre; ?></div>
            <div class="product-card-footer">
              <a href="producto.php?id=<?php echo $id; ?>" class="product-card-link" id="link-product-<?php echo $id; ?>">
                <?php echo $texts['ver_detalle']; ?> →
              </a>
            </div>
          </article>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </section>

  </main>

  <script src="assets/js/main.js"></script>
</body>
</html>