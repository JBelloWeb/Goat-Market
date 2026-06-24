<?php
    require_once __DIR__ . "/../clases/Jugadores.php";

    $orden = isset($_GET['orden']) ? $_GET['orden'] : 'asc';
    $lista = Jugadores::jugadores_x_precio($orden);
    $paises = Jugadores::todosLosPaises();
?>

<h2>Jugadores por precio (<?= $orden === 'asc' ? 'menor a mayor' : 'mayor a menor' ?>)</h2>

<?php require __DIR__ . "/../componentes/barra-navegacion.php"; ?>

<div id="catalogo">
    <?php foreach($lista as $j){ ?>
        <div class="card" style="--main-color: <?= $j->getPaisColor() ?>">
            <figure>
                <?php if ($j->getImagen()): ?>
                    <img src="assets/img/<?= $j->getImagen() ?>" alt="<?= $j->getNombre() ?>">
                <?php endif; ?>
                <figcaption>
                    <a class="carrito"></a>
                    <a class="fav"></a>
                </figcaption>
            </figure>
            <div class="content">
                <h3><?= $j->getNombre() ?></h3>
                <p><?= "€" . $j->getPrecio() . " Millones" ?></p>
            </div>
            <div class="to-hide">
                <h4><?= $j->getEdad() ?> años</h4>
                <p><?= $j->getDescripcion() . " - " . $j->getPais() ?></p>
            </div>
        </div>
    <?php } ?>
</div>
