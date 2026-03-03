<?php
session_start();

$cart = $_SESSION["cart"] ?? [];

$_SESSION = [];
$_SESSION["cart"] = $cart;

session_regenerate_id(true);

header("Location: index.php");
exit;