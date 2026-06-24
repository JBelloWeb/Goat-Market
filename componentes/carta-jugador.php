<div class="card" style="--main-color: <?= $jugador->getPaisColor() ?>">
    <figure>
        <?php if ($jugador->getImagen()): ?>
            <picture>
                <source srcset="assets/img/s/<?= $jugador->getImagen() ?>" media="(max-width: 480px)">
                <source srcset="assets/img/m/<?= $jugador->getImagen() ?>" media="(max-width: 768px)">
                <img src="assets/img/l/<?= $jugador->getImagen() ?>" alt="<?= $jugador->getNombre() ?>">
            </picture>
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
