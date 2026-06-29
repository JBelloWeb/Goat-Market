<?php
    $id = $_GET['id'] ?? FALSE;

    require_once __DIR__ . "/../clases/Jugadores.php";
    require_once __DIR__ . "/../clases/Pais.php";
    require_once __DIR__ . "/../clases/Posiciones.php";

    $jugador = Jugadores::get_x_id($id);
    $paises = Pais::todos();
    $posiciones = Posiciones::todasConId();
    $posicionesJugador = $jugador ? Posiciones::getPosicionesPorJugador($jugador->getId()) : [];
?>

<?php if($jugador): ?>

<h2>Editar Jugador</h2>

<form action="actions/editar_jugador_acc.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $jugador->getId(); ?>">

    <div>
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($jugador->getNombre()) ?>" required>
    </div>
    <div>
        <label for="descripcion">Descripción</label>
        <textarea id="descripcion" name="descripcion"><?= htmlspecialchars($jugador->getDescripcion()) ?></textarea>
    </div>
    <div>
        <label for="precio">Precio (en millones)</label>
        <input type="number" id="precio" name="precio" min="0" value="<?= $jugador->getPrecio() ?>" required>
    </div>
    <div>
        <label for="fecha_nacimiento">Fecha de Nacimiento</label>
        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="<?= $jugador->getFechaNacimiento() ?>" required>
    </div>
    <div>
        <label for="pais_id">País</label>
        <select id="pais_id" name="pais_id" required>
            <option value="">Seleccionar país</option>
            <?php foreach($paises as $pais): ?>
                <option value="<?= $pais->getId() ?>" <?= $pais->getId() == $jugador->getPaisId() ? 'selected' : '' ?>>
                    <?= htmlspecialchars($pais->getNombre()) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div>
        <label>Posiciones</label>
        <div class="checkboxes-group">
            <?php foreach($posiciones as $pos): ?>
                <label>
                    <input type="checkbox" name="posiciones[]" value="<?= $pos['id'] ?>" <?= in_array($pos['posicion'], $posicionesJugador) ? 'checked' : '' ?>>
                    <?= htmlspecialchars($pos['posicion']) ?>
                </label>
            <?php endforeach; ?>
        </div>
    </div>
    <?php if($jugador->getImagen()): ?>
    <div>
        <p>Foto actual</p>
        <picture>
            <img src="assets/img/<?= rawurlencode($jugador->getImagen()) ?>" alt="<?= htmlspecialchars($jugador->getNombre()) ?>" width="150">
        </picture>
        <div>
            <label for="foto">Actualizar Foto</label>
            <input type="file" id="foto" name="foto">
        </div>
    </div>
    <?php else: ?>
    <div>
        <label for="foto">Foto</label>
        <input type="file" id="foto" name="foto">
    </div>
    <?php endif; ?>

    <input type="submit" value="Guardar">

    <a href="?sec=panel_administrador">Cancelar</a>

</form>

<?php else: ?>
    <div>
        <h3>No se encontró el jugador</h3>
        <a href="?sec=panel_administrador">Volver</a>
    </div>
<?php endif; ?>