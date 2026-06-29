<?php
    $id = $_GET['id'] ?? FALSE;

    require_once __DIR__ . "/../clases/Jugadores.php";

    $jugador = Jugadores::get_x_id($id);
?>

<?php if($jugador): ?>

<h2>Borrar Jugador</h2>

<div class="borrar-card">
    <?php if($jugador->getImagen()): ?>
        <figure>
            <img src="assets/img/<?= rawurlencode($jugador->getImagen()) ?>" alt="<?= htmlspecialchars($jugador->getNombre()) ?>">
        </figure>
    <?php endif; ?>

    <div class="detalles">
        <div class="detalle-row">
            <span class="label">Nombre</span>
            <span class="valor"><?= htmlspecialchars($jugador->getNombre()) ?></span>
        </div>
        <div class="detalle-row">
            <span class="label">Descripción</span>
            <span class="valor"><?= htmlspecialchars($jugador->getDescripcion()) ?></span>
        </div>
        <div class="detalle-row">
            <span class="label">Precio</span>
            <span class="valor">€<?= number_format($jugador->getPrecio() * 1000000, 0, ',', '.') ?></span>
        </div>
        <div class="detalle-row">
            <span class="label">Edad</span>
            <span class="valor"><?= $jugador->getEdad() ?> años</span>
        </div>
        <div class="detalle-row">
            <span class="label">País</span>
            <span class="valor"><?= htmlspecialchars($jugador->getPais()) ?></span>
        </div>
    </div>

    <p class="confirm-text">¿Estás seguro de que deseas eliminar este jugador?</p>

    <div class="acciones">
        <a class="btn-peligro" href="actions/borrar_jugador_acc.php?id=<?= $jugador->getId() ?>">Eliminar</a>
        <a class="btn-cancelar" href="?sec=panel_administrador">Cancelar</a>
    </div>
</div>

<?php else: ?>
    <div>
        <h3>No se encontró el jugador</h3>
        <a href="?sec=panel_administrador">Volver</a>
    </div>
<?php endif; ?>