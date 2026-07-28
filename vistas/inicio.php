<?php
    require_once __DIR__ . "/../clases/Jugadores.php";
    require_once __DIR__ . "/../clases/Posiciones.php";
    require_once __DIR__ . "/../clases/Carrito.php";

    $j = new Jugadores;
    $lista = $j->todosLosJugadores();
    $paises = Jugadores::todosLosPaises();
    $posiciones = Posiciones::todas();
    $filtro = '';
    $ids_en_carrito = isset($_SESSION['usuario_id']) ? Carrito::idsEnCarrito($_SESSION['usuario_id']) : [];

    $ids_comprados = [];
    if (isset($_SESSION['usuario_id'])) {
        $conexion = Conexion::getConexion();
        $stmt = $conexion->prepare("SELECT DISTINCT jugador_id FROM detalle_compra dc JOIN compras c ON dc.compra_id = c.id WHERE c.usuario_id = :uid");
        $stmt->execute(['uid' => $_SESSION['usuario_id']]);
        $ids_comprados = $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
    $lista = array_filter($lista, fn($j) => !in_array($j->getId(), $ids_comprados));
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
