<?php
    require_once "clases/Jugadores.php";
    require_once "clases/Posiciones.php";
    $id = isset($_GET["id"]) ? $_GET["id"] : null;

    if(is_null($id)){
        header('Location: ?sec=404');
        exit;
    }

    $jugador = Jugadores::get_x_id($id);

    if(!is_null($jugador)){
        $posicionesJugador = Posiciones::getPosicionesPorJugador($jugador->getId());
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
                    <span><?= htmlspecialchars($jugador->getPais()) ?> <?= str_repeat('★', $jugador->getPaisEstrellas()) . str_repeat('☆', 5 - $jugador->getPaisEstrellas()) ?></span>
                    <span><?= $jugador->getEdad() ?> años</span>
                    <?php if (!empty($posicionesJugador)): ?>
                        <?php foreach($posicionesJugador as $pos): ?>
                            <span class="posicion-tag"><?= htmlspecialchars($pos) ?></span>
                        <?php endforeach; ?>
                    <?php endif; ?>
                        </div>
                <div>
                    <strong>€<?= number_format($jugador->getPrecio() * 1000000, 0, ',', '.') ?></strong>
                    <a href="actions/agregar_carrito_acc.php?id=<?= $jugador->getId() ?>" class="button">Agregar al carrito</a>
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