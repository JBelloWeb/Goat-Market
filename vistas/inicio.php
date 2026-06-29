<?php
    require_once __DIR__ . "/../clases/Jugadores.php";
    require_once __DIR__ . "/../clases/Posiciones.php";

    $j = new Jugadores;
    $lista = $j->todosLosJugadores();
    $paises = Jugadores::todosLosPaises();
    $posiciones = Posiciones::todas();
    $filtro = '';
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
