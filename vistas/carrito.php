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
        $total += $j->getPrecio();
    }
?>

<h2>Mi Carrito</h2>

<?php if(empty($jugadores)): ?>
    <p>El carrito está vacío.</p>
    <a href="?sec=inicio">Ver jugadores</a>
<?php else: ?>
    <?php require __DIR__ . "/../componentes/tabla-jugadores.php"; ?>
    <p><strong>Total: €<?= number_format($total * 1000000, 0, ',', '.') ?></strong></p>
<?php endif; ?>
