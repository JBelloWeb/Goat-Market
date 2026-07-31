<?php 
    require_once __DIR__ . "/../clases/Jugadores.php";
    require_once __DIR__ . "/../clases/Posiciones.php";
    require_once __DIR__ . "/../clases/Carrito.php";
    $filtro = isset($_GET['filtro']) ? $_GET['filtro'] : '';
    $posiciones = Posiciones::todas();
    $paises = Jugadores::todosLosPaises();

    $ids_comprados = [];
    if (isset($_SESSION['usuario_id'])) {
        $cnx = Conexion::getConexion();
        $s = $cnx->prepare("SELECT DISTINCT jugador_id FROM detalle_compra dc JOIN compras c ON dc.compra_id = c.id WHERE c.usuario_id = :uid");
        $s->execute(['uid' => $_SESSION['usuario_id']]);
        $ids_comprados = $s->fetchAll(PDO::FETCH_COLUMN);
    }

    if (empty($filtro) || !in_array($filtro, $posiciones)) {
        header('Location: ?sec=404');
        exit;
    }

    $jugadoresFiltrados = Posiciones::jugadores_x_posicion($filtro);
    $jugadoresFiltrados = array_filter($jugadoresFiltrados, fn($j) => !in_array($j->getId(), $ids_comprados));
    $filtro_posicion = $filtro;
    $filtro = '';
?>

<div id="catalogo">

    <?php require __DIR__ . "/../componentes/barra-navegacion.php"; ?>

    <div id="jugadores"> 
        <?php foreach($jugadoresFiltrados as $jugador){
            require __DIR__ . "/../componentes/carta-jugador.php" ;   
        ?>
        <?php }; ?>
    </div>
</div>
