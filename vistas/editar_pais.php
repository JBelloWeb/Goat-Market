<?php
    $id = $_GET['id'] ?? FALSE;

    require_once __DIR__ . "/../clases/Pais.php";

    $pais = Pais::get_x_id($id);
?>

<?php if($pais): ?>
    <h2>Editar País</h2>

    <form action="actions/editar_pais_acc.php" method="post">
        <input type="hidden" name="id" value="<?= $pais->getId() ?>">

        <div>
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($pais->getNombre()) ?>" required>
        </div>
        <div>
            <label for="estrellas">Estrellas</label>
            <input type="number" id="estrellas" name="estrellas" min="0" max="5" value="<?= $pais->getEstrellas() ?>" required>
        </div>
        <div>
            <label for="color">Color</label>
            <input type="color" id="color" name="color" value="<?= htmlspecialchars($pais->getColor()) ?>" required>
        </div>

        <input type="submit" value="Guardar">
        <a href="?sec=panel_paises">Cancelar</a>
    </form>
<?php else: ?>
    <div>
        <h3>No se encontró el país</h3>
        <a href="?sec=panel_paises">Volver</a>
    </div>
<?php endif; ?>
