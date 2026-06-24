<h2>Agregar un nuevo Jugador</h2>
<form action="actions/cargar_jugador_acc.php" method="post" enctype="multipart/form-data">
    <div>
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre">
    </div>
    <div>
        <label for="descripcion">Descripcion</label>
        <input type="text-area" id="descripcion" name="descripcion">
    </div>
    <div>
        <label for="precio">Precio</label>
        <input type="number" id="precio" name="precio">
    </div>
    <div>
        <label for="fecha_nacimiento">Fecha Nacimiento</label>
        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento">
    </div>
    <div>
        <label for="pais">País</label>
        <input type="text" id="pais" name="pais">
    </div>
    <div>
        <label for="foto">Foto</label>
        <input type="file" id="foto" name="foto">
    </div>

    <input type="submit" value="Crear">
    <a href="?sec=inicio">Cancelar</a>
</form>