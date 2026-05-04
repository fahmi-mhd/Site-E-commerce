<?php
session_start();

require __DIR__ . "/config/db.php";

$stmt = $pdo->query("
  SELECT name, rating, message, created_at
  FROM reviews
  ORDER BY created_at DESC
");

$avis = $stmt->fetchAll();

$flash = $_SESSION["flash"] ?? "";
unset($_SESSION["flash"]);
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SneakVerse — Avis</title>
  <link rel="stylesheet" href="style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body>

<header class="nav">
  <div class="wrap nav-inner">
    <a class="logo" href="index.php">SneakVerse</a>

    <nav class="menu">
      <a href="index.php#accueil">Accueil</a>
      <a href="produit.php">Produits</a>
      <a href="nouveautes.php">Nouveautés <span class="nav-new">NEW</span></a>
      <a href="index.php#about">À propos</a>
      <a href="index.php#avis" class="active">Avis</a>
    </nav>
  </div>
</header>

<?php if (!empty($flash)): ?>
  <div class="toast"><?= htmlspecialchars($flash) ?></div>
<?php endif; ?>

<main class="page">
  <section class="hero-card">
    <h1 class="cart-title">Avis clients</h1>

    <?php if (empty($avis)): ?>

      <p class="cart-empty">Aucun avis pour le moment. Sois le premier 👟</p>
      <a class="btn primary" href="index.php#avis">Laisser un avis</a>

    <?php else: ?>

      <div class="avis-list">
        <?php foreach ($avis as $a): ?>
          <?php
            $rating = (int)$a["rating"];
            $date = date("d/m/Y H:i", strtotime($a["created_at"]));
          ?>

          <article class="avis-item">
            <div class="avis-top">
              <strong><?= htmlspecialchars($a["name"]) ?></strong>
              <span class="avis-date"><?= htmlspecialchars($date) ?></span>
            </div>

            <div class="avis-stars">
              <?= str_repeat("★", $rating) . str_repeat("☆", 5 - $rating) ?>
            </div>

            <p class="avis-msg"><?= htmlspecialchars($a["message"]) ?></p>
          </article>
        <?php endforeach; ?>
      </div>

    <?php endif; ?>
  </section>
</main>

</body>
</html>
