<?php
session_start();

require __DIR__ . "/config/db.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  header("Location: index.php#avis");
  exit;
}

$name = trim($_POST["name"] ?? "");
$rating = (int)($_POST["rating"] ?? 5);
$message = trim($_POST["message"] ?? "");

if ($name === "" || $message === "") {
  $_SESSION["flash"] = "Merci de remplir tous les champs.";
  header("Location: index.php#avis");
  exit;
}

$rating = max(1, min(5, $rating));

try {
  $stmt = $pdo->prepare("
    INSERT INTO reviews (name, rating, message)
    VALUES (:name, :rating, :message)
  ");

  $stmt->execute([
    "name" => $name,
    "rating" => $rating,
    "message" => $message
  ]);

  $_SESSION["flash"] = "Merci pour ton avis !";
  header("Location: avis.php");
  exit;

} catch (PDOException $e) {
  $_SESSION["flash"] = "Erreur lors de l'envoi de l'avis.";
  header("Location: index.php#avis");
  exit;
}