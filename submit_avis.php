<?php
// submit_avis.php — enregistrement d'avis (simple)
session_start();

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  header("Location: index.php#avis");
  exit;
}

$name = trim($_POST["name"] ?? "");
$rating = (int)($_POST["rating"] ?? 5);
$message = trim($_POST["message"] ?? "");

if ($name === "" || $message === "") {
  header("Location: index.php#avis");
  exit;
}

$rating = max(1, min(5, $rating));

$avisFile = __DIR__ . "/data/avis.json";
if (!file_exists($avisFile)) {
  file_put_contents($avisFile, json_encode([]));
}

$avis = json_decode(file_get_contents($avisFile), true);
if (!is_array($avis)) $avis = [];

$avis[] = [
  "name" => htmlspecialchars($name, ENT_QUOTES, "UTF-8"),
  "rating" => $rating,
  "message" => htmlspecialchars($message, ENT_QUOTES, "UTF-8"),
  "date" => date("Y-m-d H:i")
];

file_put_contents($avisFile, json_encode($avis, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

// redirection vers page avis
header("Location: avis.php");
exit;
