<h2>Cargar nuevo País</h2>

<form action="actions/cargar_pais_acc.php" method="post">
    <div>
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" required>
    </div>
    <div>
        <label for="estrellas">Estrellas</label>
        <input type="number" id="estrellas" name="estrellas" min="0" max="5" required>
    </div>
    <div>
        <label for="color">Color</label>
        <input type="color" id="color" name="color" value="#67b7fd" required>
    </div>

    <input type="submit" value="Guardar">
    <a href="?sec=panel_paises">Cancelar</a>
</form>
