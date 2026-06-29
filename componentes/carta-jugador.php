<?php
  $color = $jugador->getPaisColor();
  $hex = ltrim($color, '#');
  $r = hexdec(substr($hex, 0, 2));
  $g = hexdec(substr($hex, 2, 2));
  $b = hexdec(substr($hex, 4, 2));
  $luminancia = (0.299 * $r + 0.587 * $g + 0.114 * $b) / 255;
  $textColor = $luminancia > 0.5 ? '#1e1e1e' : '#fefefe';
?>
<div class="card" style="--main-color: <?= $color ?>; --text-color: <?= $jugador->getPais() === 'Argentina' ? '#fefefe' : $textColor ?>">
    <figure>
        <?php if ($jugador->getImagen()): ?>
                <img src="assets/img/<?= rawurlencode($jugador->getImagen()) ?>" alt="<?= htmlspecialchars($jugador->getNombre()) ?>">
        <?php endif; ?>
        <figcaption>
            <a href="?sec=detalle&id=<?= $jugador -> getId(); ?>" class="button">Detalle</a>
            <a href="actions/agregar_carrito_acc.php?id=<?= $jugador->getId() ?>" class="button">Al Carrito</a>
        </figcaption>
    </figure>
    <div class="content">
        <h3><?= $jugador->getNombre() ?></h3>
        <p><?= "€" . $jugador->getPrecio() . " Millones" ?></p>
    </div>
    <div class="to-hide">
        <h4><?= $jugador->getEdad() ?> años</h4>
        <p><?= $jugador->getDescripcion() . " - " . $jugador->getPais() ?></p>
        <span class="estrellas"><?= str_repeat('★', $jugador->getPaisEstrellas()) ?></span>
    </div>
</div>
