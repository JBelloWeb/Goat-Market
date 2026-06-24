<div class="card" style="--main-color: <?= $jugador->getPaisColor() ?>">
    <figure>
        <?php if ($jugador->getImagen()): ?>
            <img src="assets/img/<?= $jugador->getImagen() ?>" alt="<?= $jugador->getNombre() ?>">
        <?php endif; ?>
        <figcaption>
            <a href="?sec=detalle&id=<?= $jugador -> getId(); ?>" class="detalle">Detalle</a>
            <a href="actions/agregar_carrito_acc.php?id=<?= $jugador->getId() ?>" class="carrito">Agregar al carrito</a>
        </figcaption>
    </figure>
    <div class="content">
        <h3><?= $jugador->getNombre() ?></h3>
        <p><?= "€" . $jugador->getPrecio() . " Millones" ?></p>
    </div>
    <div class="to-hide">
        <h4><?= $jugador->getEdad() ?> años</h4>
        <p><?= $jugador->getDescripcion() . " - " . $jugador->getPais() ?></p>
    </div>
</div>
