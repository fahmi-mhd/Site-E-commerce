<?php
session_start();
require __DIR__ . "/config/db.php";

if (empty($_SESSION["user"]["id"])) {
  header("Location: login.php");
  exit;
}

$userId = (int)$_SESSION["user"]["id"];

$stmt = $pdo->prepare("SELECT id, username, email, role, created_at FROM users WHERE id = ?");
$stmt->execute([$userId]);
$user = $stmt->fetch();

if (!$user) {
  $_SESSION = [];
  session_destroy();
  header("Location: login.php");
  exit;
}

$flash = $_SESSION["flash"] ?? "";
unset($_SESSION["flash"]);
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mon compte — SneakVerse</title>
  <link rel="stylesheet" href="style.css">
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
      </a>

      <a class="icon-btn is-accent" href="profil.php" aria-label="Mon compte">
        <svg viewBox="0 0 24 24" aria-hidden="true">
          <path d="M12 12a5 5 0 10-5-5 5 5 0 005 5zm0 2c-4.42 0-8 2-8 4.5V21h16v-2.5C20 16 16.42 14 12 14z"/>
        </svg>
      </a>
    </div>
  </div>
</header>

<?php if ($flash): ?>
  <div class="toast"><?= htmlspecialchars($flash) ?></div>
<?php endif; ?>

<main class="page auth-page">
  <div class="auth-stack">
    <h1 class="auth-title">Mon compte</h1>

    <div class="glass-soft auth-card">
      <p><strong>Nom :</strong> <?= htmlspecialchars($user["username"]) ?></p>
      <p><strong>Email :</strong> <?= htmlspecialchars($user["email"]) ?></p>
        <?php if ($user["role"] === "admin"): ?>
        <p><strong>Rôle :</strong> <?= htmlspecialchars($user["role"]) ?></p>
        <?php endif; ?>
      <div style="margin-top:16px; display:flex; gap:10px; flex-wrap:wrap;">
        <a class="btn" href="logout.php" style="text-decoration:none;">Se déconnecter</a>

        <?php if ($user["role"] === "admin"): ?>
          <a class="btn" href="admin.php" style="text-decoration:none;">Admin</a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</main>

</body>
</html>