<?php
session_start();

$cart = $_SESSION["cart"] ?? [];
$cartCount = 0;
foreach ($cart as $it) $cartCount += (int)$it["qty"];

$flash = $_SESSION["flash"] ?? "";
unset($_SESSION["flash"]);

/* Produit “drop” */
$drop = [
  "id" => "airmax_rb",
  "name" => "Nike Air Max Red/Black",
  "price" => 154.90,
  "img" => "assets/airmax.png", // ✅ corrige l'extension (mets le vrai nom si différent)
  "desc" => "Drop exclusif. Design bold, finitions premium, confort Max."
];
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Nouveautés - SneakVerse</title>
  <link rel="stylesheet" href="style.css">
</head>

<body class="drop-page">

<header class="nav">
  <div class="wrap nav-inner">
    <a class="logo" href="index.php">SneakVerse</a>

    <nav class="menu">
      <a href="index.php">Accueil</a>
      <a href="produit.php">Produits</a>

      <a href="nouveautes.php" class="active">
        Nouveautés <span class="nav-new">NEW</span>
      </a>

      <a href="index.php#about">À propos</a>
      <a href="index.php#avis">Avis</a>
    </nav>

    <div class="nav-actions">
      <a class="icon-btn cart-btn" href="panier.php" aria-label="Panier">
        <svg viewBox="0 0 24 24" aria-hidden="true">
          <path d="M7 7V6a5 5 0 0110 0v1h3v15H4V7h3zm2 0h6V6a3 3 0 00-6 0v1zm-3 2v11h12V9H6z"/>
        </svg>
        <?php if ($cartCount > 0): ?>
          <span class="cart-badge"><?= (int)$cartCount ?></span>
        <?php endif; ?>
      </a>
    </div>
  </div>
</header>

<?php if (!empty($flash)): ?>
  <div class="toast"><?= htmlspecialchars($flash) ?></div>
<?php endif; ?>

<main class="drop-wrap">

  <section class="drop-hero">
    <div class="drop-watermark">VERSE</div>

    <div class="drop-grid">
    
      <!-- GAUCHE -->
      <div>
        <div class="drop-kicker">DROP EXCLUSIF</div>
        <h1 class="drop-title">
          NIKE AIR MAX<br>BLACK
        </h1>

        <div class="drop-sub"><?= htmlspecialchars($drop["desc"]) ?></div>

        <div class="drop-cta">
          <div class="drop-price"><?= number_format($drop["price"], 2, ",", " ") ?> €</div>

          <form action="panier.php" method="post" style="margin:0;">
            <input type="hidden" name="action" value="add">
            <input type="hidden" name="id" value="<?= htmlspecialchars($drop["id"]) ?>">
            <input type="hidden" name="name" value="<?= htmlspecialchars($drop["name"]) ?>">
            <input type="hidden" name="price" value="<?= htmlspecialchars((string)$drop["price"]) ?>">
            <input type="hidden" name="img" value="<?= htmlspecialchars($drop["img"]) ?>">
            <input type="hidden" name="redirect" value="nouveautes.php">
            <button class="drop-add" type="submit">Ajouter au panier</button>
            <div class="drop-rating">★★★★☆ <span>4.8 (127 avis)</span></div>
          </form>
        </div>

        <div class="drop-tags">
          <span class="drop-tag">Limité</span>
          <span class="drop-tag">Premium</span>
          <span class="drop-tag">2026</span>
          <div class="drop-badge">LIMITED DROP</div>
        </div>
      </div>

      <!-- CENTRE -->
      <div class="drop-shoe">
        <img
          src="<?= htmlspecialchars($drop["img"]) ?>"
          alt="<?= htmlspecialchars($drop["name"]) ?>"
          loading="eager"
          decoding="async"
        >
      </div>
    </div>
  </section>

</main>
</body>
</html>