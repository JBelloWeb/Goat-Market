<?php
    $id = $_GET['id'] ?? FALSE;

    require_once __DIR__ . "/../clases/Pais.php";

    $pais = Pais::get_x_id($id);
?>

<?php if($pais): ?>
    <h2>Borrar País</h2>

    <div>
        <p>¿Estás seguro de que deseas eliminar el país <strong><?= htmlspecialchars($pais->getNombre()) ?></strong>?</p>
        <p>Estrellas: <?= $pais->getEstrellas() ?></p>
        <p>Color: <span style="display:inline-block;width:20px;height:20px;background:<?= htmlspecialchars($pais->getColor()) ?>;border:1px solid #fff;vertical-align:middle;"></span> <?= htmlspecialchars($pais->getColor()) ?></p>
    </div>

    <div>
        <a href="actions/borrar_pais_acc.php?id=<?= $pais->getId() ?>">Eliminar</a>
        <a href="?sec=panel_paises">Cancelar</a>
    </div>
<?php else: ?>
    <div>
        <h3>No se encontró el país</h3>
        <a href="?sec=panel_paises">Volver</a>
    </div>
<?php endif; ?>
