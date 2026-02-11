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
        <a href="accueil" class="active">Accueil</a>
        <a href="produit.php">Produits</a>
        <a href="hommes.php">Homme</a>
        <a href="femmes.php">Femme</a>
        <a href="contact.php">Contact</a>
      </nav>

      <div class="nav-actions">
    <button class="icon-btn" aria-label="Compte">
        <svg viewBox="0 0 24 24" aria-hidden="true">
       <path d="M12 12a4 4 0 1 0-4-4 4 4 0 0 0 4 4zm0 2c-4.418 0-8 2.239-8 5v1h16v-1c0-2.761-3.582-5-8-5z"/>
       </svg>
    </button>
        <button class="icon-btn" aria-label="Panier">
          <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M7 7V6a5 5 0 0110 0v1h3v15H4V7h3zm2 0h6V6a3 3 0 00-6 0v1zm-3 2v11h12V9H6z"/></svg>
        </button>
      </div>
    </div>
  </header>

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
    <div class="hero-cta">
        <button 
         class="btn primary buy-now"
         data-buy-hero
         aria-label="Acheter Air Max 95">
         Acheter
        </button>
     </div>

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
      <img src="assets/aj4.png" alt="Air Jordan 4 Metallic Purple">
      <h3>Air Jordan 4 Metallic Purple</h3>
      <p class="product-price">189,99 €</p>
      <button class="add-btn" aria-label="Ajouter au panier">+</button>
    </article>

    <article class="product-card">
      <img src="assets/af1.png" alt="Air Force 1">
      <h3>Air Force 1</h3>
      <p class="product-price">119,99 €</p>
      <button class="add-btn" aria-label="Ajouter au panier">+</button>
    </article>

    <article class="product-card">
      <img src="assets/aj1ts.png" alt="Air Jordan 1 Retro Travis Scott">
      <h3>AJ1 Retro Travis Scott</h3>
      <p class="product-price">199,99 €</p>
      <button class="add-btn" aria-label="Ajouter au panier">+</button>
    </article>

    <article class="product-card">
      <img src="assets/vomero5.png" alt="Nike Zoom Vomero 5 Blue">
      <h3>Nike Zoom Vomero 5 Blue</h3>
      <p class="product-price">159,99 €</p>
      <button class="add-btn" aria-label="Ajouter au panier">+</button>
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
    <!-- Formulaire avis -->
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
      <p class="form-hint">Les avis sont enregistrés et affichés sur la page “Avis”.</p>
    </form>

    <!-- Aperçu (statique pour l’instant) -->
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
    </div>
  </div>
</section>

  </main>
</body>
</html>
