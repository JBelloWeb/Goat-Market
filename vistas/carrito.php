<?php
    require_once __DIR__ . "/../clases/Carrito.php";

    if(!isset($_SESSION['usuario_id'])){
        header('Location: ?sec=login');
        exit;
    }

    $jugadores = Carrito::listar($_SESSION['usuario_id']);
    $mostrar_acciones = true;
    $tipo_acciones = 'carrito';

    $total = 0;
    foreach($jugadores as $j){
        $total += $j->getPrecio() * $j->getCantidad();
    }
?>

<h2>Mi Carrito</h2>

<?php if(isset($_GET['error']) && $_GET['error'] === 'duplicado'): ?>
    <div class="borrar-card">
        <div class="detalles">
            <p class="confirm-text" style="color: #e74c3c;">Este jugador ya está en tu carrito.</p>
        </div>
    </div>
<?php endif; ?>

<?php if(empty($jugadores)): ?>
    <div class="borrar-card">
        <div class="detalles">
            <p class="confirm-text">El carrito está vacío.</p>
        </div>
        <div class="acciones">
            <a class="btn-cancelar" href="?sec=inicio">Ver jugadores</a>
        </div>
    </div>
<?php else: ?>
    <?php require __DIR__ . "/../componentes/tabla-jugadores.php"; ?>
    <p><strong>Total: €<?= number_format($total * 1000000, 0, ',', '.') ?></strong></p>
<?php endif; ?>
