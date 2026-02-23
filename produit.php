<?php
session_start();

/* même mini-catalogue */
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

/* badge panier */
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
</head>
<body>

<header class="nav">
  <div class="wrap nav-inner">
    <a class="logo" href="index.php">SneakVerse</a>

  <nav class="menu">
      <a href="index.php">Accueil</a>
       <a href="produit.php">Produits</a>
      <a href="nouveautes.php">Nouveautés</a>
      <a href="index.php#about">À propos</a>
      <a href="contact.php">Contact</a>
  </nav>

    <div class="nav-actions">
      <a class="icon-btn cart-btn" href="panier.php" aria-label="Panier">
        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M7 7V6a5 5 0 0110 0v1h3v15H4V7h3zm2 0h6V6a3 3 0 00-6 0v1zm-3 2v11h12V9H6z"/></svg>
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

          <!-- ajout rapide -->
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
