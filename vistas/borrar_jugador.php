<?php
    require_once "../clases/Jugadores.php";

    $id = $_GET['id'] ?? FALSE;
    $jugador = Jugadores::get_x_id($id);
?>

<h2>Borrar Jugador</h2>
<div>
    <?php if(!is_null($jugador)) {?>

    <div>
        <h3>Jugador</h3>
        <p><?= $jugador -> getNombre(); ?></p>
    </div>
    <div>
        <h3>Descripción</h3>
        <p><?= $jugador -> getDescripcion(); ?></p>
    </div>
    <div>
        <h3>Precio</h3>
        <p><?= $jugador -> getPrecio(); ?></p>
    </div>
    <div>
        <h3>Fecha de Nacimiento</h3>
        <p><?= $jugador -> getFechaNacimiento(); ?></p>
    </div>
    <div>
        <h3>Pais</h3>
        <p><?= $jugador -> getPais(); ?></p>
    </div>

    <div>
        <a href="actions/borrar_jugador_acc.php?id=<?= $jugador -> getId(); ?>">Eliminar</a>
        <a href="?sec=inicio">Cancelar</a>
    </div>
    <? } else { ;?>
        <div>
            <h3>No se encontró el jugador</h3>
            <a href="?sec=inicio">Volver</a>
        </div>
    <? } ;?>
</div>