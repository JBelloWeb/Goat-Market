<table>
    <thead>
        <tr>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Precio</th>
            <?php if($mostrar_acciones): ?>
                <th>Acciones</th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach($jugadores as $jugador): ?>
            <tr>
                <td>
                    <?php if($jugador->getImagen()): ?>
                        <picture>
                            <source srcset="assets/img/s/<?= $jugador->getImagen() ?>" media="(max-width: 480px)">
                            <source srcset="assets/img/m/<?= $jugador->getImagen() ?>" media="(max-width: 768px)">
                            <img src="assets/img/l/<?= $jugador->getImagen() ?>" alt="<?= $jugador->getNombre() ?>" width="50">
                        </picture>
                    <?php endif; ?>
                </td>
                <td><?= htmlspecialchars($jugador->getNombre()) ?></td>
                <td>€<?= number_format($jugador->getPrecio() * 1000000, 0, ',', '.') ?></td>
                <?php if($mostrar_acciones): ?>
                    <td>
                        <?php if($tipo_acciones === 'carrito'): ?>
                            <a href="actions/quitar_carrito_acc.php?id=<?= $jugador->getId() ?>">Quitar</a>
                        <?php elseif($tipo_acciones === 'admin'): ?>
                            <a href="?sec=editar_jugador&id=<?= $jugador->getId() ?>">Editar</a>
                            <a href="?sec=borrar_jugador&id=<?= $jugador->getId() ?>">Borrar</a>
                        <?php endif; ?>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
