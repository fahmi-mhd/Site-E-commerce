<?php
session_start();
$cart = $_SESSION["cart"] ?? [];
$cartCount = 0;
foreach ($cart as $it) $cartCount += (int)$it["qty"];
$flash = $_SESSION["flash"] ?? "";
unset($_SESSION["flash"]);
?>

<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>SneakVerse</title>
  <meta name="description" content="SneakVerse" />
  <link rel="stylesheet" href="style.css">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body>
  <header class="nav">
    <div class="wrap nav-inner">
      <div class="logo">SneakVerse</div>

      <nav class="menu">
        <a href="index.php" class="active">Accueil</a>
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
      <span class="cart-badge"><?= $cartCount ?></span>
    <?php endif; ?>
  </a>

</div>
    </div>
  </header>
    <?php if (!empty($flash)): ?>
       <div class="toast"><?= htmlspecialchars($flash) ?></div>
    <?php endif; ?>


  <main class="page" id="accueil">
    <section class="hero-card">
      <div class="hero-bg-text" aria-hidden="true">SNEAK</div>

      <div class="hero-grid">
        <div class="hero-left">
          <div class="hero-kicker">Walk your Vision</div>
          <h1 class="hero-title">Air Max 95</h1>
          <p class="hero-desc">
            Inspirée du corps humain, une silhouette iconique. Confort, style et amorti Max Air.
          </p>

          <form action="panier.php" method="post" class="hero-cta">
            <input type="hidden" name="action" value="add">
            <input type="hidden" name="id" value="airmax95">
            <input type="hidden" name="name" value="Nike Air Max 95">
            <input type="hidden" name="price" value="129.99">
            <input type="hidden" name="img" value="assets/airmax95.png">
            <button class="buy-now" type="submit">Acheter</button>
          </form>
        </div>

        <div class="hero-center">
          <img class="hero-shoe" src="assets/airmax95.png" alt="Sneaker Air Max 95">
        </div>

        <aside class="hero-right">
          <div class="price-box">
            <div class="price-label">NIKE AIR MAX 95</div>
            <div class="price">129,99€</div>
            <div class="rating" aria-label="4.8 sur 5">
              <span class="stars">★★★★★</span>
              <span class="rate">4.8</span>
            </div>
          </div>
        </aside>
      </div>

      <section class="best-sellers">
        <h2 class="section-title">Best Sellers</h2>

        <div class="products-grid">

 <article class="product-card">
  <a class="product-link" href="product.php?id=aj4" aria-label="Voir Air Jordan 4 Metallic Purple">
    <img src="assets/aj4.png" alt="Air Jordan 4 Metallic Purple">
    <h3>Air Jordan 4 Metallic Purple</h3>
    <p class="product-price">189,99 €</p>
  </a>

  <form action="panier.php" method="post">
    <input type="hidden" name="action" value="add">
    <input type="hidden" name="id" value="aj4">
    <input type="hidden" name="name" value="Air Jordan 4 Metallic Purple">
    <input type="hidden" name="price" value="189.99">
    <input type="hidden" name="img" value="assets/aj4.png">
    <input type="hidden" name="redirect" value="index.php#product">
    <button class="add-btn" type="submit" aria-label="Ajouter au panier">+</button>
  </form>
</article>

  <article class="product-card">
  <a class="product-link" href="product.php?id=af1" aria-label="Voir Air Force 1">
    <img src="assets/af1.png" alt="Air Force 1">
    <h3>Air Force 1</h3>
    <p class="product-price">119,99 €</p>
  </a>

  <form action="panier.php" method="post">
    <input type="hidden" name="action" value="add">
    <input type="hidden" name="id" value="af1">
    <input type="hidden" name="name" value="Air Force 1">
    <input type="hidden" name="price" value="119.99">
    <input type="hidden" name="img" value="assets/af1.png">
    <input type="hidden" name="redirect" value="index.php#produits">
    <button class="add-btn" type="submit" aria-label="Ajouter au panier">+</button>
  </form>
</article>


<article class="product-card">
  <a class="product-link" href="product.php?id=aj1ts" aria-label="Voir AJ1 Retro Travis Scott">
    <img src="assets/aj1ts.png" alt="AJ1 Retro Travis Scott">
    <h3>AJ1 Retro Travis Scott</h3>
    <p class="product-price">199,99 €</p>
  </a>

  <form action="panier.php" method="post">
    <input type="hidden" name="action" value="add">
    <input type="hidden" name="id" value="aj1ts">
    <input type="hidden" name="name" value="AJ1 Retro Travis Scott">
    <input type="hidden" name="price" value="199.99">
    <input type="hidden" name="img" value="assets/aj1ts.png">
    <input type="hidden" name="redirect" value="index.php#produits">
    <button class="add-btn" type="submit" aria-label="Ajouter au panier">+</button>
  </form>
</article>


<article class="product-card">
  <a class="product-link" href="product.php?id=vomero5" aria-label="Voir Nike Zoom Vomero 5 Blue">
    <img src="assets/vomero5.png" alt="Nike Zoom Vomero 5 Blue">
    <h3>Nike Zoom Vomero 5 Blue</h3>
    <p class="product-price">159,99 €</p>
  </a>

  <form action="panier.php" method="post">
    <input type="hidden" name="action" value="add">
    <input type="hidden" name="id" value="vomero5">
    <input type="hidden" name="name" value="Nike Zoom Vomero 5 Blue">
    <input type="hidden" name="price" value="159.99">
    <input type="hidden" name="img" value="assets/vomero5.png">
    <input type="hidden" name="redirect" value="index.php#produits">
    <button class="add-btn" type="submit" aria-label="Ajouter au panier">+</button>
  </form>
</article>

        </div>
      </section>

      <div class="dots" aria-hidden="true">
        <span></span><span class="on"></span><span></span>
      </div>
    </section>

    <section class="about-band" id="about">
      <div class="wrap about-grid">

        <div class="about-text">
          <h2 class="about-title">À propos de SneakVerse</h2>

          <p class="about-lead">
            SneakVerse est né d’une idée simple : créer un univers où chaque paire raconte une histoire.
          </p>

          <p>
            En 2026, nous ouvrons officiellement notre boutique en ligne avec une sélection centrée sur les essentiels — Air Max, Jordan, Dunk — mais aussi les silhouettes qui façonnent la culture street actuelle.
          </p>

          <p>
            SneakVerse n’est pas seulement une boutique. C’est un espace dédié aux passionnés, aux créatifs, aux rêveurs.
          </p>

          <p class="about-signature">
            SneakVerse — Walk your vision.
          </p>
        </div>

        <div class="about-image">
          <img src="assets/nocta.png" alt="Sneaker SneakVerse">
        </div>

      </div>
    </section>

    <section class="reviews" id="avis">
      <h2 class="section-title">Avis</h2>

      <div class="reviews-grid">
        <form class="review-form" action="submit_avis.php" method="post">
          <label>
            Nom
            <input type="text" name="name" required placeholder="Ex: Fahmi">
          </label>

          <label>
            Note
            <select name="rating" required>
              <option value="5">★★★★★ (5)</option>
              <option value="4">★★★★☆ (4)</option>
              <option value="3">★★★☆☆ (3)</option>
              <option value="2">★★☆☆☆ (2)</option>
              <option value="1">★☆☆☆☆ (1)</option>
            </select>
          </label>

          <label>
            Ton avis
            <textarea name="message" rows="5" required placeholder="Ex: Livraison rapide, site propre, chaussures clean !"></textarea>
          </label>

          <button class="btn primary" type="submit">Envoyer mon avis</button>
        </form>

        <div class="review-preview">
          <div class="preview-title">Pourquoi laisser un avis ?</div>
          <p>
            Ton retour nous aide à améliorer SneakVerse : sélection, prix, expérience et services.
            Merci pour la force 👟
          </p>
          <div class="preview-badges">
            <span class="pill">Rapide</span>
            <span class="pill">Simple</span>
            <span class="pill">Utile</span>
          </div>

          <a class="btn ghost" href="avis.php">Voir tous les avis</a>
          <script src="script.js"></script>
        </div>
      </div>
    </section>

  </main>
</body>
</html>
