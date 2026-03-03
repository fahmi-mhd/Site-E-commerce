<?php
session_start();
require __DIR__ . "/config/db.php";

$errors = [];
$old = [
  "name" => "",
  "email" => ""
];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $name = trim($_POST["name"] ?? "");
  $email = trim($_POST["email"] ?? "");
  $pass = (string)($_POST["password"] ?? "");
  $pass2 = (string)($_POST["password_confirm"] ?? "");

  $old["name"] = $name;
  $old["email"] = $email;

  if ($name === "" || mb_strlen($name) < 2) $errors[] = "Nom invalide (minimum 2 caractères).";
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Email invalide.";
  if (strlen($pass) < 8) $errors[] = "Mot de passe trop court (minimum 8 caractères).";
  if ($pass !== $pass2) $errors[] = "Les mots de passe ne correspondent pas.";

  if (!$errors) {
    try {
      $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
      $stmt->execute([$email]);
      if ($stmt->fetch()) {
        $errors[] = "Cet email est déjà utilisé.";
      } else {
        $hash = password_hash($pass, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)");
        $stmt->execute([$name, $email, $hash]);

        $_SESSION["user"] = [
          "id" => (int)$pdo->lastInsertId(),
          "username" => $name,
          "email" => $email,
          "role" => "user"
        ];

        $_SESSION["flash"] = "Compte créé avec succès. Bienvenue !";
        header("Location: index.php");
        exit;
      }
    } catch (PDOException $e) {
      if ((string)$e->getCode() === "23000") {
        $errors[] = "Cet email est déjà utilisé.";
      } else {
        $errors[] = "Erreur serveur (BDD). Réessaie plus tard.";
      }
    }
  }
}

$flash = $_SESSION["flash"] ?? "";
unset($_SESSION["flash"]);
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Créer un compte — SneakVerse</title>
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
      <a class="icon-btn" href="login.php" aria-label="Compte">
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
    <h1 class="auth-title">Inscription</h1>

    <div class="glass-soft auth-card">
    <?php if ($errors): ?>
      <div class="glass" style="border-radius:14px;padding:12px 14px;margin-bottom:12px;">
        <strong style="display:block;margin-bottom:6px;">Erreur</strong>
        <ul style="margin:0;padding-left:18px;">
          <?php foreach ($errors as $e): ?>
            <li><?= htmlspecialchars($e) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    <form method="post" action="" class="review-form" style="padding:0;box-shadow:none;border:0;background:transparent;">
      <label>
        Nom
        <input name="name" type="text" autocomplete="name" required
               value="<?= htmlspecialchars($old["name"]) ?>">
      </label>

      <label>
        Email
        <input name="email" type="email" autocomplete="email" required
               value="<?= htmlspecialchars($old["email"]) ?>">
      </label>

      <label>
        Mot de passe
        <input name="password" type="password" autocomplete="new-password" required minlength="8">
      </label>

      <label>
        Confirmer le mot de passe
        <input name="password_confirm" type="password" autocomplete="new-password" required minlength="8">
      </label>

      <button type="submit">Créer le compte</button>

      <p style="margin:12px 0 0;color:rgba(17,19,24,.65);font-weight:600;">
        Déjà un compte ? <a href="login.php" style="font-weight:900;">Connexion</a>
      </p>
    </form>
  </div>
</main>

</body>
</html>