<?php
session_start();

require __DIR__ . "/config/db.php";

$products = $pdo->query("SELECT sku, name, price, image FROM products ORDER BY id DESC")->fetchAll();

$products = [
  "aj4" => ["name"=>"Air Jordan 4 Metallic Purple","price"=>189.99,"img"=>"assets/aj4.png"],
  "af1" => ["name"=>"Air Force 1","price"=>119.99,"img"=>"assets/af1.png"],
  "aj1ts" => ["name"=>"AJ1 Retro Travis Scott","price"=>199.99,"img"=>"assets/aj1ts.png"],
  "vomero5" => ["name"=>"Nike Zoom Vomero 5 Blue","price"=>159.99,"img"=>"assets/vomero5.png"],
  "nb550" => ["name" => "New Balance 550 White Green","price" => 139.99,"img" => "assets/nb550.png"],
  "dunklow" => ["name" => "Nike Dunk Low Panda","price" => 129.99,"img" => "assets/dunklow.png"],
  "gazelle" => ["name" => "Adidas Gazelle Black","price" => 109.99,"img" => "assets/gazelle.png"],
  "yeezy350" => ["name" => "Yeezy Boost 350 V2","price" => 219.99,"img" => "assets/yeezy350.png"]
];

$cartCount = 0;
if (!empty($_SESSION["cart"])) {
  foreach ($_SESSION["cart"] as $it) $cartCount += (int)$it["qty"];
}

$flash = $_SESSION["flash"] ?? "";
unset($_SESSION["flash"]);
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Produits - SneakVerse</title>
  <link rel="stylesheet" href="style.css">
  <script src="script.js"></script>
</head>
<body>

<header class="nav">
  <div class="wrap nav-inner">
    <a class="logo" href="index.php">SneakVerse</a>

  <nav class="menu">
      <a href="index.php">Accueil</a>
      <a href="produit.php">Produits</a>
      <a href="nouveautes.php">Nouveautés <span class="nav-new">NEW</span></a> 
      <a href="index.php#about">À propos</a>
      <a href="index.php#avis">Avis</a>
  </nav>

          <div class="nav-actions">
        <?php if (!empty($_SESSION["user"])): ?>
          <a class="icon-btn is-accent" href="profil.php" aria-label="Mon compte">
            <svg viewBox="0 0 24 24" aria-hidden="true">
              <path d="M12 12a5 5 0 10-5-5 5 5 0 005 5zm0 2c-4.42 0-8 2-8 4.5V21h16v-2.5C20 16 16.42 14 12 14z"/>
            </svg>
          </a>
        <?php else: ?>
          <a class="icon-btn" href="login.php" aria-label="Connexion">
            <svg viewBox="0 0 24 24" aria-hidden="true">
              <path d="M12 12a5 5 0 10-5-5 5 5 0 005 5zm0 2c-4.42 0-8 2-8 4.5V21h16v-2.5C20 16 16.42 14 12 14z"/>
            </svg>
          </a>
        <?php endif; ?>

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

<main class="page">
  <h1 class="section-title">Produits</h1>

  <section class="best-sellers" style="margin-top:12px;">
    <div class="products-grid">
      <?php foreach ($products as $id => $p): ?>
        <article class="product-card">
          <a class="product-link" href="product.php?id=<?= htmlspecialchars($id) ?>" aria-label="Voir <?= htmlspecialchars($p["name"]) ?>">
            <img src="<?= htmlspecialchars($p["img"]) ?>" alt="<?= htmlspecialchars($p["name"]) ?>">
            <h3><?= htmlspecialchars($p["name"]) ?></h3>
            <p class="product-price"><?= number_format($p["price"], 2, ",", " ") ?> €</p>
          </a>

          <form action="panier.php" method="post">
            <input type="hidden" name="action" value="add">
            <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
            <input type="hidden" name="name" value="<?= htmlspecialchars($p["name"]) ?>">
            <input type="hidden" name="price" value="<?= htmlspecialchars((string)$p["price"]) ?>">
            <input type="hidden" name="img" value="<?= htmlspecialchars($p["img"]) ?>">
            <input type="hidden" name="redirect" value="produit.php">
            <button class="add-btn" type="submit" aria-label="Ajouter au panier">+</button>
          </form>
        </article>
      <?php endforeach; ?>
    </div>
  </section>
</main>

</body>
</html>
