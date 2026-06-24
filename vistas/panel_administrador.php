<?php
    require_once __DIR__ . "/../clases/Jugadores.php";
    require_once __DIR__ . "/../clases/Pais.php";

    $jugadores = Jugadores::todosLosJugadores();
    $paises = Pais::todos();
    $mostrar_acciones = true;
    $tipo_acciones = 'admin';
?>

<h2>Panel de Administrador</h2>

<div>
    <h3>Gestión de Jugadores</h3>
    <a href="?sec=cargar_jugador">Cargar nuevo jugador</a>
    <?php require __DIR__ . "/../componentes/tabla-jugadores.php"; ?>
</div>

<hr>

<div>
    <h3>Gestión de Países</h3>
    <a href="?sec=cargar_pais">Cargar nuevo país</a>
    <?php require __DIR__ . "/../componentes/tabla-paises.php"; ?>
</div>
