<aside id="navFiltro">
    <div>
        <h3>Paises</h3>
        <ul class="filtros">
            <li><a href="?sec=inicio">Todos los jugadores</a></li>
            <?php foreach($paises as $p): ?>
                <li  class=" <?= $p === $filtro ? "selected" : "unselected" ; ?>" >
                    <a href="?sec=filtro&filtro=<?= urlencode($p); ?>" > <?= htmlspecialchars($p); ?></a>
                </li>
                <?php endforeach;?>
        </ul>
    </div>

    <div>
        <h3>Precio</h3>
        <ul class="filtros">
            <li><a href="?sec=precio&orden=asc">Menor a Mayor</a></li>
            <li><a href="?sec=precio&orden=desc">Mayor a Menor</a></li>
        </ul>
    </div>
    
</aside>