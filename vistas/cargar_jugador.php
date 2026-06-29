<?php
    require_once __DIR__ . "/../clases/Pais.php";
    require_once __DIR__ . "/../clases/Posiciones.php";

    $paises = Pais::todos();
    $posiciones = Posiciones::todasConId();
?>

<h2>Agregar un nuevo Jugador</h2>

<form action="actions/cargar_jugador_acc.php" method="post" enctype="multipart/form-data">
    <div>
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" required>
    </div>
    <div>
        <label for="descripcion">Descripción</label>
        <textarea id="descripcion" name="descripcion"></textarea>
    </div>
    <div>
        <label for="precio">Precio (en millones)</label>
        <input type="number" id="precio" name="precio" min="0" required>
    </div>
    <div>
        <label for="fecha_nacimiento">Fecha de Nacimiento</label>
        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>
    </div>
    <div>
        <label for="pais_id">País</label>
        <select id="pais_id" name="pais_id" required>
            <option value="">Seleccionar país</option>
            <?php foreach($paises as $pais): ?>
                <option value="<?= $pais->getId() ?>"><?= htmlspecialchars($pais->getNombre()) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div>
        <label>Posiciones</label>
        <div class="checkboxes-group">
            <?php foreach($posiciones as $pos): ?>
                <label>
                    <input type="checkbox" name="posiciones[]" value="<?= $pos['id'] ?>">
                    <?= htmlspecialchars($pos['posicion']) ?>
                </label>
            <?php endforeach; ?>
        </div>
    </div>
    <div>
        <label for="foto">Foto</label>
        <input type="file" id="foto" name="foto">
    </div>

    <input type="submit" value="Crear">
    <a href="?sec=panel_administrador">Cancelar</a>
</form>