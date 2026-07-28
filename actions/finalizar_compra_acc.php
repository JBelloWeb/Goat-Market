<?php
session_start();
require_once "../clases/Compra.php";

if (!isset($_SESSION['usuario_id'])) {
  header('Location: ../?sec=login');
  exit;
}

$compra_id = Compra::crear((int) $_SESSION['usuario_id']);

if ($compra_id) {
  header('Location: ../?sec=compra-exitosa&id=' . $compra_id);
} else {
  header('Location: ../?sec=carrito&error=vacio');
}
exit;
