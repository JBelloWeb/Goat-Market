<?php
require_once __DIR__ . "/../clases/Compra.php";

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$compra = Compra::getXId($id);
$detalles = $compra ? Compra::getDetalles($id) : [];
?>

<h2>Compra realizada</h2>

<div class="compra-exitosa">
  <div class="borrar-card">
    <div class="detalles">
      <p class="confirm-text">¡Gracias por tu compra!</p>
      <?php if ($compra): ?>
        <p><strong>Compra #<?= $compra->getId() ?></strong></p>
        <p>Total: <strong>€<?= number_format($compra->getTotal() * 1000000, 0, ',', '.') ?></strong></p>
        <p>Fecha: <?= date('d/m/Y H:i', strtotime($compra->getFecha())) ?></p>
      <?php endif; ?>
    </div>
    <div class="acciones">
      <a class="btn-cancelar" href="?sec=inicio">Seguir comprando</a>
      <a class="button" href="?sec=mis-compras">Ver mis compras</a>
    </div>
  </div>

  
</div>
