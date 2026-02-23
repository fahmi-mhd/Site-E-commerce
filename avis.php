<?php
$avisFile = __DIR__ . "/data/avis.json";
$avis = [];

if (file_exists($avisFile)) {
  $avis = json_decode(file_get_contents($avisFile), true);
  if (!is_array($avis)) $avis = [];
}

// afficher les plus récents en premier
$avis = array_reverse($avis);
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
        <a href="index.php#about">À propos</a>
        <a href="index.php#avis" class="active">Avis</a>
      </nav>
    </div>
  </header>

  <main class="page">
    <section class="hero-card">
      <h1 class="cart-title">Avis clients</h1>

      <?php if (empty($avis)): ?>
        <p class="cart-empty">Aucun avis pour le moment. Sois le premier 👟</p>
        <a class="btn primary" href="index.php#avis">Laisser un avis</a>
      <?php else: ?>
        <div class="avis-list">
          <?php foreach ($avis as $a): ?>
            <article class="avis-item">
              <div class="avis-top">
                <strong><?= $a["name"] ?></strong>
                <span class="avis-date"><?= $a["date"] ?></span>
              </div>
              <div class="avis-stars"><?= str_repeat("★", (int)$a["rating"]) . str_repeat("☆", 5-(int)$a["rating"]) ?></div>
              <p class="avis-msg"><?= $a["message"] ?></p>
            </article>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </section>
  </main>
</body>
</html>
