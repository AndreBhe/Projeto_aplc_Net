<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}

if (isset($_SESSION['ultimo_acesso']) && time() - $_SESSION['ultimo_acesso'] > 120) {
  session_destroy();
  header("Location: login.php?timeout=1");
  exit;
}
$_SESSION['ultimo_acesso'] = time();
?>
