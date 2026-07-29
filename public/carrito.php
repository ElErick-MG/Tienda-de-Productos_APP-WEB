<?php
require_once __DIR__ . '/../app/helpers/session.helper.php';

requireSession();

// Agregar producto al carrito vía POST
$product_id    = isset($_POST['product_id'])    ? (int)$_POST['product_id']       : 0;
$product_name  = isset($_POST['product_name'])  ? trim($_POST['product_name'])     : '';
$product_price = isset($_POST['product_price']) ? (float)$_POST['product_price']  : 0.0;

if ($product_id > 0 && $product_name !== '' && $product_price > 0) {
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }
    $_SESSION['carrito'][] = [
        'id'     => $product_id,
        'nombre' => $product_name,
        'precio' => $product_price,
    ];
    // Redirigir de vuelta al producto con feedback visual
    header("Location: producto.php?id={$product_id}&added=1");
    exit();
}

// Vista del carrito
$lang  = resolveLanguage();
$texts = loadTexts($lang, 'carrito');
$count = cartCount();

// Calcular total
$total = 0.0;
if (!empty($_SESSION['carrito'])) {
    foreach ($_SESSION['carrito'] as $item) {
        $total += (float)$item['precio'];
    }
}

// Vaciar carrito
if (isset($_GET['vaciar'])) {
    $_SESSION['carrito'] = [];
    header('Location: carrito.php');
    exit();
}
?>
<!doctype html>
<html lang="<?php echo $lang; ?>">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Tu carrito de compras en la Tienda de Productos.">
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
        <a href="mipanel.php" class="nav-link" id="nav-panel">
          🏠 <?php echo $texts['volver']; ?>
        </a>
      </li>
      <li>
        <a href="carrito.php" class="nav-link active" id="nav-cart">
          🛒 <?php echo $texts['nav_carrito']; ?>
          <span id="cart-count-badge" class="cart-badge" style="display:none">0</span>
        </a>
      </li>
    </ul>

    <div style="display:flex;align-items:center;gap:0.5rem">
      <div class="nav-divider"></div>
      <a href="cerrarsesion.php" class="btn-logout" id="nav-logout">
        🔓 <?php echo $texts['nav_cerrar']; ?>
      </a>
    </div>
  </nav>

  <!-- CONTENIDO -->
  <main class="page-wrapper" role="main">

    <header class="page-header">
      <h1><?php echo $texts['titulo']; ?></h1>
      <p><?php echo $texts['bienvenido']; ?>, <strong><?php echo htmlspecialchars($_SESSION['nombre']); ?></strong></p>
    </header>

    <section class="cart-container" aria-label="Carrito de compras">

      <?php if (!empty($_SESSION['carrito'])): ?>

        <h2 style="font-size:0.85rem;font-weight:600;color:var(--text-secondary);text-transform:uppercase;letter-spacing:0.05em;margin-bottom:1rem;">
          <?php echo $texts['productos']; ?>
          <span class="chip" style="margin-left:0.5rem"><?php echo $count; ?></span>
        </h2>

        <ul class="cart-list" aria-label="Productos en el carrito">
          <?php foreach ($_SESSION['carrito'] as $i => $item): ?>
          <li class="cart-item" id="cart-item-<?php echo $i; ?>">
            <span class="cart-item-name">🛍️ <?php echo htmlspecialchars($item['nombre']); ?></span>
            <span class="cart-item-price">$<?php echo number_format((float)$item['precio'], 2); ?></span>
          </li>
          <?php endforeach; ?>
        </ul>

        <div class="cart-total">
          <span class="cart-total-label"><?php echo $texts['subtotal']; ?></span>
          <span class="cart-total-value" id="cart-total-value">$<?php echo number_format($total, 2); ?></span>
        </div>

        <div style="margin-top:1.5rem;display:flex;gap:0.75rem;flex-wrap:wrap">
          <a href="mipanel.php" class="btn btn-ghost" id="btn-continue-shopping">← <?php echo $texts['volver']; ?></a>
          <a href="carrito.php?vaciar=1" class="btn btn-danger" id="btn-clear-cart"
             onclick="return confirm('<?php echo $lang === 'en' ? 'Clear your cart?' : '¿Vaciar el carrito?'; ?>')">
            🗑️ <?php echo $texts['vaciar']; ?>
          </a>
        </div>

      <?php else: ?>

        <div class="cart-empty" id="cart-empty-state">
          <span class="empty-icon">🛒</span>
          <p><?php echo $texts['sin_productos']; ?></p>
          <a href="mipanel.php" class="btn btn-primary" style="margin-top:1.25rem" id="btn-go-catalog">
            Explorar catálogo →
          </a>
        </div>

      <?php endif; ?>

    </section>

  </main>

  <script src="assets/js/main.js"></script>
</body>
</html>