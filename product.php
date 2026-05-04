<?php
session_start();

$products = [
  "aj4" => [
    "name" => "Air Jordan 4 Metallic Purple",
    "price" => 189.99,
    "img" => "assets/aj4.png",
    "desc" => "Un classique Jordan avec une touche Metallic Purple. Silhouette iconique, confortable et intemporelle."
  ],
  "af1" => [
    "name" => "Air Force 1",
    "price" => 119.99,
    "img" => "assets/af1.png",
    "desc" => "La paire essentielle : clean, polyvalente et indémodable. Parfaite au quotidien."
  ],
  "aj1ts" => [
    "name" => "AJ1 Retro Travis Scott",
    "price" => 199.99,
    "img" => "assets/aj1ts.png",
    "desc" => "Une collab culte : détails premium, vibe street et une silhouette qui fait la diff."
  ],
  "vomero5" => [
    "name" => "Nike Zoom Vomero 5 Blue",
    "price" => 159.99,
    "img" => "assets/vomero5.png",
    "desc" => "Confort running + look tech. Une paire ultra agréable avec un style moderne."
  ],
  "nb550" => [
    "name" => "New Balance 550 White Green",
    "price" => 139.99,
    "img" => "assets/nb550.png",
    "desc" => "Un modèle rétro basket revisité. Minimaliste et ultra tendance."
  ],
  "dunklow" => [
    "name" => "Nike Dunk Low Panda",
    "price" => 129.99,
    "img" => "assets/dunklow.png",
    "desc" => "Noir et blanc intemporel, facile à porter avec toutes tes tenues street."
  ],
  "gazelle" => [
    "name" => "Adidas Gazelle Black",
    "price" => 109.99,
    "img" => "assets/gazelle.png",
    "desc" => "Design vintage et silhouette élégante."
  ],
  "yeezy350" => [
    "name" => "Yeezy Boost 350 V2",
    "price" => 219.99,
    "img" => "assets/yeezy350.png",
    "desc" => "Technologie Boost ultra confortable. Design futuriste."
  ],
];

$id = $_GET["id"] ?? "";

if (!isset($products[$id])) {
  header("Location: produit.php");
  exit;
}

$p = $products[$id];

$cartCount = 0;
if (!empty($_SESSION["cart"])) {
  foreach ($_SESSION["cart"] as $item) {
    $cartCount += (int)$item["qty"];
  }
}

$added = isset($_GET["added"]) && $_GET["added"] === "1";
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= htmlspecialchars($p["name"]) ?> - SneakVerse</title>
  <link rel="stylesheet" href="style.css">
  <script src="script.js" defer></script>
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

  <?php if ($added): ?>
    <div class="toast">Ajouté au panier ✅</div>
  <?php endif; ?>

  <section class="p-focus">
    <div class="p-focus-img">
      <img src="<?= htmlspecialchars($p["img"]) ?>" alt="<?= htmlspecialchars($p["name"]) ?>">
    </div>

    <div class="p-focus-info">
      <h1><?= htmlspecialchars($p["name"]) ?></h1>

      <div class="price">
        <?= number_format($p["price"], 2, ",", " ") ?> €
      </div>

      <p><?= htmlspecialchars($p["desc"]) ?></p>

      <form action="panier.php" method="post">
        <input type="hidden" name="action" value="add">
        <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
        <input type="hidden" name="name" value="<?= htmlspecialchars($p["name"]) ?>">
        <input type="hidden" name="price" value="<?= htmlspecialchars((string)$p["price"]) ?>">
        <input type="hidden" name="img" value="<?= htmlspecialchars($p["img"]) ?>">
        <input type="hidden" name="redirect" value="<?= htmlspecialchars("product.php?id=".$id."&added=1") ?>">
        <button class="buy-now" type="submit">AJOUTER AU PANIER</button>
      </form>
    </div>
  </section>

</main>

</body>
</html>