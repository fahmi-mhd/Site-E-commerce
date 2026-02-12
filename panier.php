<?php
session_start();

if (!isset($_SESSION["cart"])) $_SESSION["cart"] = [];
$cart =& $_SESSION["cart"];

// --- helper : retour à la page précédente (sans sortir de ton site) ---
function safe_back_url(): string {
  $back = $_SERVER["HTTP_REFERER"] ?? "index.php#produits";
  // sécurité simple : si ça contient un domaine externe, on force index
  if (preg_match('~^https?://~i', $back) && !str_contains($back, $_SERVER["HTTP_HOST"] ?? "")) {
    return "index.php#produits";
  }
  return $back;
}

// --- TRAITEMENT ---
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $action = $_POST["action"] ?? "";

  if ($action === "add") {
    $id    = $_POST["id"] ?? "";
    $name  = $_POST["name"] ?? "";
    $price = (float)($_POST["price"] ?? 0);
    $img   = $_POST["img"] ?? "";

    if ($id !== "" && $name !== "" && $price > 0 && $img !== "") {
      if (!isset($cart[$id])) {
        $cart[$id] = ["name"=>$name, "price"=>$price, "img"=>$img, "qty"=>0];
      }
      $cart[$id]["qty"] += 1;
    }

    // ✅ on revient sur la page d’où tu as cliqué (index.php), pas sur panier.php
    header("Location: " . safe_back_url());
    exit;
  }

  if ($action === "remove") {
    $id = $_POST["id"] ?? "";
    if ($id !== "" && isset($cart[$id])) unset($cart[$id]);
    header("Location: panier.php");
    exit;
  }

  if ($action === "clear") {
    $_SESSION["cart"] = [];
    header("Location: panier.php");
    exit;
  }
}

// --- CALCUL TOTAL + NB ARTICLES ---
$total = 0;
$count = 0;
foreach ($cart as $item) {
  $total += $item["price"] * $item["qty"];
  $count += (int)$item["qty"];
}

// ✅ on inclut une vue PHP (pas .html)
include "afficher_panier.php";
