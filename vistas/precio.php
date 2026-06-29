<?php
    require_once __DIR__ . "/../clases/Jugadores.php";
    require_once __DIR__ . "/../clases/Posiciones.php";

    $orden = isset($_GET['orden']) ? $_GET['orden'] : 'asc';
    $lista = Jugadores::jugadores_x_precio($orden);
    $paises = Jugadores::todosLosPaises();
    $posiciones = Posiciones::todas();
    $filtro = '';
?>

<h2>Jugadores por precio (<?= $orden === 'asc' ? 'menor a mayor' : 'mayor a menor' ?>)</h2>

<div id="catalogo">
    <?php require __DIR__ . "/../componentes/barra-navegacion.php"; ?>

    <div id="jugadores">
    <?php foreach($lista as $jugador){
        require __DIR__ . "/../componentes/carta-jugador.php";
    ?>
    <?php } ?>
    </div>
</div>
