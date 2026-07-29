<?php
require_once __DIR__ . '/../app/helpers/session.helper.php';
require_once __DIR__ . '/../app/core/DBConnection.php';

requireSession();

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    http_response_code(400);
    exit('ID de producto inválido.');
}

$id    = (int)$_GET['id'];
$lang  = resolveLanguage();
$texts = loadTexts($lang, 'producto');
$table = productsTable($lang);
$count = cartCount();

$db      = new DBConnection();
$results = $db->read($table, "id = $id");
$db->close();

if (!$results || count($results) === 0) {
    http_response_code(404);
    exit($texts['no_encontrado']);
}

$prod   = $results[0];
$nombre = htmlspecialchars($prod['nombre']);
$desc   = htmlspecialchars($prod['descripcion']);
$precio = number_format((float)$prod['precio'], 2);

$icons = ['👕','👖','👟','⌚','🎒','🧢','🎧','💻','📱','🛍️'];
$icon  = $icons[($id - 1) % count($icons)];
?>
<!doctype html>
<html lang="<?php echo $lang; ?>">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="<?php echo $desc; ?>">
  <title><?php echo $nombre; ?> — <?php echo $texts['titulo']; ?></title>
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
        <a href="carrito.php" class="nav-link" id="nav-cart">
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

    <a href="mipanel.php" class="back-link" id="back-to-panel">← <?php echo $texts['volver']; ?></a>

    <div class="detail-card">

      <div class="detail-badge">
        <span><?php echo $icon; ?></span>
        <span>ID #<?php echo $id; ?></span>
      </div>

      <h1 class="detail-title"><?php echo $nombre; ?></h1>

      <p class="detail-description">
        <strong><?php echo $texts['descripcion']; ?>:</strong><br>
        <?php echo nl2br($desc); ?>
      </p>

      <div class="detail-price">
        <span class="price-label"><?php echo $texts['precio']; ?>:</span>
        <span class="price-value">$<?php echo $precio; ?></span>
      </div>

      <form id="add-to-cart-form" action="carrito.php" method="POST">
        <input type="hidden" name="product_id"    value="<?php echo $id; ?>">
        <input type="hidden" name="product_name"  value="<?php echo $nombre; ?>">
        <input type="hidden" name="product_price" value="<?php echo $prod['precio']; ?>">
        <button
          id="btn-add-cart"
          type="submit"
          class="btn btn-primary btn-full btn-lg"
          data-label="<?php echo $texts['agregar']; ?>"
        >
          🛒 <?php echo $texts['agregar']; ?>
        </button>
      </form>

    </div>

  </main>

  <script src="assets/js/main.js"></script>
</body>
</html>