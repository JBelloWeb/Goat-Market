<?php
require_once __DIR__ . "/../clases/Compra.php";

if (!isset($_SESSION['usuario_id'])) {
  header('Location: ?sec=login');
  exit;
}

$compras = Compra::getPorUsuario($_SESSION['usuario_id']);
?>

<h2>Mis Compras</h2>

<?php if (empty($compras)): ?>
  <div class="borrar-card">
    <div class="detalles">
      <p class="confirm-text">Todavía no realizaste ninguna compra.</p>
    </div>
    <div class="acciones">
      <a class="btn-cancelar" href="?sec=inicio">Ver jugadores</a>
    </div>
  </div>
<?php else: ?>
  <?php foreach ($compras as $compra): ?>
    <?php $detalles = Compra::getDetalles($compra->getId()); ?>
    <div class="compra-card">
      <table class="tabla">
        <thead>
          <tr>
            <th>Jugador</th>
            <th>Precio unitario</th>
            <th>Fecha</th>
            <th>Detalle</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($detalles as $d): ?>
            <tr>
              <td>
                <?php if ($d['imagen']): ?>
                  <figure>
                    <img src="assets/img/<?= rawurlencode($d['imagen']) ?>" alt="<?= htmlspecialchars($d['nombre_apellido']) ?>" width="50">
                  </figure>
                <?php endif; ?>
                <?= htmlspecialchars($d['nombre_apellido']) ?>
              </td>
              <td>€<?= number_format($d['precio_unitario'] * 1000000, 0, ',', '.') ?></td>
              <td><?= date('d/m/Y H:i', strtotime($compra->getFecha())) ?></td>
              <td><a href="?sec=detalle&id=<?= $d['jugador_id'] ?>">Ver detalle</a></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endforeach; ?>
<?php endif; ?>
