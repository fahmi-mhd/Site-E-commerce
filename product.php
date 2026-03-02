<?php
session_start();

/* petit "catalogue" en dur (simple) */
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
  "desc" => "Une des paires les plus iconiques du moment. Noir et blanc intemporel, facile à porter avec toutes tes tenues street."
],

"gazelle" => [
  "name" => "Adidas Gazelle Black",
  "price" => 109.99,
  "img" => "assets/gazelle.png",
  "desc" => "Un classique Adidas revisité. Design vintage, confort léger et silhouette élégante qui traverse les générations."
],

"yeezy350" => [
  "name" => "Yeezy Boost 350 V2",
  "price" => 219.99,
  "img" => "assets/yeezy350.png",
  "desc" => "Une silhouette futuriste avec technologie Boost ultra confortable. Design moderne et détails premium pour un style affirmé."
],
];

$id = $_GET["id"] ?? "";
if (!isset($products[$id])) {
  header("Location: index.php#produits");
  exit;
}

$p = $products[$id];

/* badge panier */
$cartCount = 0;
if (!empty($_SESSION["cart"])) {
  foreach ($_SESSION["cart"] as $it) $cartCount += (int)$it["qty"];
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
</head>
<body>

<header class="nav">
  <div class="wrap nav-inner">
    <a class="logo" href="index.php">SneakVerse</a>

    <nav class="menu">
      <a href="index.php">Accueil</a>
      <a href="produit.php">Produits</a>
      <a href="nouveautes.php" class="nav-new">Nouveautés <span class="new-badge">NEW</span></a>
      <a href="index.php#about">À propos</a>
      <a href="index.php#avis">Avis</a>
</nav>

    <div class="nav-actions">
      <a class="icon-btn cart-btn" href="panier.php" aria-label="Ouvrir le panier">
        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M7 7V6a5 5 0 0110 0v1h3v15H4V7h3zm2 0h6V6a3 3 0 00-6 0v1zm-3 2v11h12V9H6z"/></svg>
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

  <div class="cart-item" style="max-width: 980px; margin: 0 auto;">
    <img class="cart-img" src="<?= htmlspecialchars($p["img"]) ?>" alt="<?= htmlspecialchars($p["name"]) ?>">
    <div class="cart-info">
      <div class="cart-name"><?= htmlspecialchars($p["name"]) ?></div>
      <div class="cart-meta"><?= number_format($p["price"], 2, ",", " ") ?> €</div>
      <div style="max-width: 52ch; color: rgba(17,19,24,.70); font-weight: 600; line-height: 1.6;">
        <?= htmlspecialchars($p["desc"]) ?>
      </div>

      <div style="margin-top: 10px; display:flex; gap:10px; flex-wrap:wrap;">
        <form action="panier.php" method="post">
          <input type="hidden" name="action" value="add">
          <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
          <input type="hidden" name="name" value="<?= htmlspecialchars($p["name"]) ?>">
          <input type="hidden" name="price" value="<?= htmlspecialchars((string)$p["price"]) ?>">
          <input type="hidden" name="img" value="<?= htmlspecialchars($p["img"]) ?>">
          <input type="hidden" name="redirect" value="<?= htmlspecialchars("product.php?id=".$id."&added=1") ?>">
          <button class="buy-now" type="submit">Ajouter au panier</button>
        </form>

        <a class="btn ghost" href="index.php#produits">Retour</a>
      </div>
    </div>
  </div>
</main>

</body>
</html>
