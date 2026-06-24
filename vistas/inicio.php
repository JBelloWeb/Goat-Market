<?php
    require_once __DIR__ . "/../clases/Jugadores.php";

    $j = new Jugadores;
    $lista = $j->todosLosJugadores();
    $paises = Jugadores::todosLosPaises();
?>

<h2>Jugadores</h2>
<div id="catalogo">

    <?php require __DIR__ . "/../componentes/barra-navegacion.php"; ?>

    <div id="jugadores"> 
    <?php foreach($lista as $jugador){
        require __DIR__ . "/../componentes/carta-jugador.php" ;   
    ?>
    <?php }; ?>
    </div>
</div>

<a href="?sec=panel_administrador">Panel de Administrador</a>
