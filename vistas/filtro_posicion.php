<?php 
    require_once __DIR__ . "/../clases/Jugadores.php";
    require_once __DIR__ . "/../clases/Posiciones.php";
    $filtro = isset($_GET['filtro']) ? $_GET['filtro'] : '';
    $posiciones = Posiciones::todas();
    $paises = Jugadores::todosLosPaises();

    if (empty($filtro) || !in_array($filtro, $posiciones)) {
        header('Location: ?sec=404');
        exit;
    }

    $jugadoresFiltrados = Posiciones::jugadores_x_posicion($filtro);
    $filtro_posicion = $filtro;
    $filtro = '';
?>

<h1>Posición: <?= htmlspecialchars($filtro_posicion); ?></h1>

<div id="catalogo">

    <?php require __DIR__ . "/../componentes/barra-navegacion.php"; ?>

    <div id="jugadores"> 
        <?php foreach($jugadoresFiltrados as $jugador){
            require __DIR__ . "/../componentes/carta-jugador.php" ;   
        ?>
        <?php }; ?>
    </div>
</div>
