<?php
    $id = $_GET['id'] ?? FALSE;

    require_once __DIR__ . "/../clases/Pais.php";

    $pais = Pais::get_x_id($id);
?>

<?php if($pais): ?>

<h2>Borrar País</h2>

<div class="borrar-card">
    <div class="detalles">
        <div class="detalle-row">
            <span class="label">ID</span>
            <span class="valor"><?= $pais->getId() ?></span>
        </div>
        <div class="detalle-row">
            <span class="label">Nombre</span>
            <span class="valor"><?= htmlspecialchars($pais->getNombre()) ?></span>
        </div>
        <div class="detalle-row">
            <span class="label">Estrellas</span>
            <span class="valor"><?= $pais->getEstrellas() ?></span>
        </div>
        <div class="detalle-row">
            <span class="label">Color</span>
            <span class="valor"><span class="swatch" style="background:<?= htmlspecialchars($pais->getColor()) ?>"></span> <?= htmlspecialchars($pais->getColor()) ?></span>
        </div>
    </div>

    <p class="confirm-text">¿Estás seguro de que deseas eliminar este país?</p>

    <div class="acciones">
        <a class="btn-peligro" href="actions/borrar_pais_acc.php?id=<?= $pais->getId() ?>">Eliminar</a>
        <a class="btn-cancelar" href="?sec=panel_paises">Cancelar</a>
    </div>
</div>

<?php else: ?>
    <div>
        <h3>No se encontró el país</h3>
        <a href="?sec=panel_paises">Volver</a>
    </div>
<?php endif; ?>
