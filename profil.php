<?php
session_start();

if (empty($_SESSION["user"])) {
  header("Location: login.php");
  exit;
}

$user = $_SESSION["user"];
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Mon compte — SneakVerse</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<header class="nav">
  <div class="wrap nav-inner">
    <a class="logo" href="index.php">SneakVerse</a>
  </div>
</header>

<main class="page">
  <h1 class="section-title" style="font-size:36px;">Mon compte</h1>

  <div class="glass-soft" style="padding:20px;border-radius:18px;max-width:500px;">
    <p><strong>Nom :</strong> <?= htmlspecialchars($user["name"]) ?></p>
    <p><strong>Email :</strong> <?= htmlspecialchars($user["email"]) ?></p>

    <a href="logout.php" class="buy-now" style="margin-top:16px;">Se déconnecter</a>
  </div>
</main>

</body>
</html>