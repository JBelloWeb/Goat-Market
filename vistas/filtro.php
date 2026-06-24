<?php 
    require_once __DIR__ . "/../clases/Jugadores.php";
    $filtro = isset($_GET['filtro']) ? $_GET['filtro'] : '';
    $paises = Jugadores::todosLosPaises();

    if (empty($filtro) || !in_array($filtro, $paises)) {
        header('Location: ?sec=404');
        exit;
    }

    $jugadoresFiltrados = Jugadores::jugadores_x_pais($filtro);
?>

<h1>Categoría: <?= htmlspecialchars($filtro); ?></h1>

<div id="catalogo">

    <?php require __DIR__ . "/../componentes/barra-navegacion.php"; ?>

    <div id="jugadores"> 
    <?php foreach($jugadoresFiltrados as $jugador){
        require __DIR__ . "/../componentes/carta-jugador.php" ;   
    ?>
    <?php }; ?>
    </div>
</div>
