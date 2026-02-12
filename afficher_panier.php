<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Panier - SneakVerse</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<header class="nav">
  <div class="wrap nav-inner">
    <a class="logo" href="index.php">SneakVerse</a>

    <nav class="menu">
      <a href="index.php">Accueil</a>
      <a href="panier.php" class="active">Panier</a>
    </nav>
  </div>
</header>

<main class="page">
  <h1 class="cart-title">Mon panier</h1>

  <?php if (empty($cart)): ?>
    <p class="cart-empty">Ton panier est vide.</p>
    <a class="buy-now" href="index.php#produits">Voir les best sellers</a>

  <?php else: ?>

    <div class="cart-list">
      <?php foreach ($cart as $id => $item): ?>
        <article class="cart-item">
          <img class="cart-img" src="<?= htmlspecialchars($item["img"]) ?>" alt="">
          
          <div class="cart-info">
            <div class="cart-name"><?= htmlspecialchars($item["name"]) ?></div>
            <div class="cart-meta">
              <?= number_format($item["price"], 2, ",", " ") ?> €
              <span class="cart-x">×</span>
              <?= (int)$item["qty"] ?>
            </div>
          </div>

          <div class="cart-actions">
            <form method="post" action="panier.php">
              <input type="hidden" name="action" value="remove">
              <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
              <button type="submit" class="btn ghost">Supprimer</button>
            </form>
          </div>
        </article>
      <?php endforeach; ?>
    </div>

    <div class="cart-summary">
      <div class="cart-total">
        <span>Total</span>
        <strong><?= number_format($total, 2, ",", " ") ?> €</strong>
      </div>

      <form method="post" action="panier.php">
        <input type="hidden" name="action" value="clear">
        <button class="buy-now" type="submit">Vider le panier</button>
      </form>
    </div>

  <?php endif; ?>
</main>

</body>
</html>
