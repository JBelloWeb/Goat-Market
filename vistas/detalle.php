<?php
    require_once "clases/Jugadores.php";
    $id = isset($_GET["id"]) ? $_GET["id"] : null;

    if(is_null($id)){
        header('Location: ?sec=404');
        exit;
    }

    $jugador = Jugadores::get_x_id($id);

    if(!is_null($jugador)){
        ?>
        <h1>Detalles de <?= $jugador -> getNombre() ;?></h1>

        <div>
            <!-- Componente de imagen -->

            <div>
                <p><?= htmlspecialchars($jugador -> getDescripcion()); ?></p>
                <div>
                    <span>€<?= number_format(($jugador -> getPrecio() * 1000000), 0, ',', '.') ?></span>
                    <button>Agregar al Carrito</button>
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