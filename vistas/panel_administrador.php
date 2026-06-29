<?php
    require_once __DIR__ . "/../clases/Jugadores.php";
    require_once __DIR__ . "/../clases/Pais.php";

    $jugadores = Jugadores::todosLosJugadores();
    $paises = Pais::todos();
    $mostrar_acciones = true;
    $tipo_acciones = 'admin';
?>

<h2>Panel de Administrador</h2>

<div class="tab-panel">
    <input type="radio" name="admin-tab" id="tab-jugadores" checked hidden>
    <input type="radio" name="admin-tab" id="tab-paises" hidden>

    <nav class="tab-nav">
        <label for="tab-jugadores">Jugadores</label>
        <label for="tab-paises">Países</label>
    </nav>

    <div class="tab-pane" id="pane-jugadores">
        <div class="tab-header">
            <h3>Gestión de Jugadores</h3>
            <a href="?sec=cargar_jugador">+ Nuevo jugador</a>
        </div>
        <?php require __DIR__ . "/../componentes/tabla-jugadores.php"; ?>
    </div>

    <div class="tab-pane" id="pane-paises">
        <div class="tab-header">
            <h3>Gestión de Países</h3>
            <a href="?sec=cargar_pais">+ Nuevo país</a>
        </div>
        <?php require __DIR__ . "/../componentes/tabla-paises.php"; ?>
    </div>
</div>
