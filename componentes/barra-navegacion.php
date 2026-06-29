<aside id="navFiltro">
    <div>
        <h3>Paises</h3>
        <select class="filtro-select" onchange="window.location=this.value ? '?sec=filtro&filtro='+this.value : '?sec=inicio'">
            <option value="">Todos</option>
            <?php foreach($paises as $p): ?>
                <option value="<?= htmlspecialchars($p) ?>" <?= $p === ($filtro ?? '') ? 'selected' : '' ?>><?= htmlspecialchars($p) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <h3>Posiciones</h3>
        <select class="filtro-select" onchange="window.location=this.value ? '?sec=filtro_posicion&filtro='+this.value : '?sec=inicio'">
            <option value="">Todas</option>
            <?php foreach($posiciones as $pos): ?>
                <option value="<?= htmlspecialchars($pos) ?>" <?= $pos === ($filtro_posicion ?? '') ? 'selected' : '' ?>><?= htmlspecialchars($pos) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <h3>Precio</h3>
        <ul class="filtros">
            <li><a href="?sec=precio&orden=asc">+$</a></li>
            <li><a href="?sec=precio&orden=desc">-$</a></li>
        </ul>
    </div>
    
</aside>