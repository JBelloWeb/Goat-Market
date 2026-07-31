<?php
    require_once "clases/Jugadores.php";
    require_once "clases/Posiciones.php";
    require_once "clases/Carrito.php";
    $id = isset($_GET["id"]) ? $_GET["id"] : null;

    if(is_null($id)){
        header('Location: ?sec=404');
        exit;
    }

    $jugador = Jugadores::get_x_id($id);

    if(!is_null($jugador)){
        $posicionesJugador = Posiciones::getPosicionesPorJugador($jugador->getId());
        $ya_en_carrito = isset($_SESSION['usuario_id']) && in_array($jugador->getId(), Carrito::idsEnCarrito($_SESSION['usuario_id']));

        $ids_comprados = [];
        if (isset($_SESSION['usuario_id'])) {
            $cnx = Conexion::getConexion();
            $s = $cnx->prepare("SELECT DISTINCT jugador_id FROM detalle_compra dc JOIN compras c ON dc.compra_id = c.id WHERE c.usuario_id = :uid");
            $s->execute(['uid' => $_SESSION['usuario_id']]);
            $ids_comprados = $s->fetchAll(PDO::FETCH_COLUMN);
        }
        $ya_comprado = in_array($jugador->getId(), $ids_comprados);
        ?>
        <h2>Detalles de <?= $jugador->getNombre() ?></h2>

        <div class="detalle">
            <?php if ($jugador->getImagen()): ?>
                <figure>
                    <img src="assets/img/<?= rawurlencode($jugador->getImagen()) ?>" alt="<?= htmlspecialchars($jugador->getNombre()) ?>">
                </figure>
            <?php endif; ?>
            <div>
                <p><?= htmlspecialchars($jugador->getDescripcion()) ?></p>
                <div>
                    <span><?= htmlspecialchars($jugador->getPais()) ?> <?= str_repeat('★', $jugador->getPaisEstrellas()) ?></span>
                    <span><?= $jugador->getEdad() ?> años</span>
                    <?php if (!empty($posicionesJugador)): ?>
                        <?php foreach($posicionesJugador as $pos): ?>
                            <span class="posicion-tag"><?= htmlspecialchars($pos) ?></span>
                        <?php endforeach; ?>
                    <?php endif; ?>
                        </div>
                <div>
                    <strong>€<?= number_format($jugador->getPrecio() * 1000000, 0, ',', '.') ?></strong>
                    <?php if ($ya_en_carrito): ?>
                        <span class="button disabled">Ya está en tu carrito</span>
                    <?php elseif ($ya_comprado): ?>
                        <span class="button disabled">Ya comprado</span>
                    <?php else: ?>
                        <a href="actions/agregar_carrito_acc.php?id=<?= $jugador->getId() ?>" class="button">Al Carrito</a>
                    <?php endif; ?>
                        </div>
            </div>
        </div>

<?php } else { ?>
        <div>
            <span>404</span>
            <p>Jugador no encontrado</p>
            <a href="?sec=inicio">Volver al catálogo</a>
        </div>
<?php }?>