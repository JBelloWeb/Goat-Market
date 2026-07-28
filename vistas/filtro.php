<?php 
    require_once __DIR__ . "/../clases/Jugadores.php";
    require_once __DIR__ . "/../clases/Posiciones.php";
    require_once __DIR__ . "/../clases/Carrito.php";
    $filtro = isset($_GET['filtro']) ? $_GET['filtro'] : '';
    $paises = Jugadores::todosLosPaises();
    $posiciones = Posiciones::todas();
    $filtro_posicion = '';
    $ids_en_carrito = isset($_SESSION['usuario_id']) ? Carrito::idsEnCarrito($_SESSION['usuario_id']) : [];

    $ids_comprados = [];
    if (isset($_SESSION['usuario_id'])) {
        $cnx = Conexion::getConexion();
        $s = $cnx->prepare("SELECT DISTINCT jugador_id FROM detalle_compra dc JOIN compras c ON dc.compra_id = c.id WHERE c.usuario_id = :uid");
        $s->execute(['uid' => $_SESSION['usuario_id']]);
        $ids_comprados = $s->fetchAll(PDO::FETCH_COLUMN);
    }
    $jugadoresFiltrados = array_filter($jugadoresFiltrados, fn($j) => !in_array($j->getId(), $ids_comprados));

    if (empty($filtro) || !in_array($filtro, $paises)) {
        header('Location: ?sec=404');
        exit;
    }

    $jugadoresFiltrados = Jugadores::jugadores_x_pais($filtro);
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
