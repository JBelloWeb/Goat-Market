<?php
    $id = $_GET['id'] ?? FALSE;

    require_once "../clases/Jugadores.php";

    $jugador = new Jugadores();
    $jugador = Jugadores::get_x_id($id);
?>

<h2>Editar Jugador</h2>

<form action="actions/editar_jugador_acc.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $jugador -> getId(); ?>">

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
    <?php
        $fotoJugador = !empty($jugador -> getImagen()) ? $jugador -> getImagen() : "defecto.webp";
    ?>
    <div>
        <p>Foto actual</p>
        <img src="../assets/img/<?= $fotoJugador; ?>" alt="<?= $jugador -> getNombre(); ?>">
        <div>
            <label for="foto">Actualizar Foto</label>
            <input type="file" id="foto" name="foto">
        </div>
    </div>

    <input type="submit" value="Crear">
    
    <a href="?sec=inicio">Cancelar</a>

</form>