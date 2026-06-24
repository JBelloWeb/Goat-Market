<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Estrellas</th>
            <th>Color</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($paises as $pais): ?>
            <tr>
                <td><?= $pais->getId() ?></td>
                <td><?= htmlspecialchars($pais->getNombre()) ?></td>
                <td><?= $pais->getEstrellas() ?></td>
                <td><span style="display:inline-block;width:20px;height:20px;background:<?= htmlspecialchars($pais->getColor()) ?>;border:1px solid #fff;vertical-align:middle;"></span> <?= htmlspecialchars($pais->getColor()) ?></td>
                <td>
                    <a href="?sec=editar_pais&id=<?= $pais->getId() ?>">Editar</a>
                    <a href="?sec=borrar_pais&id=<?= $pais->getId() ?>">Borrar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
