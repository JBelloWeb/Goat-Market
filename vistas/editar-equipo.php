<?php
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ?sec=login');
    exit;
}

require_once __DIR__ . "/../clases/Conexion.php";
require_once __DIR__ . "/../clases/Equipo.php";

$es_admin = $usuario && $usuario->getEsAdministrador() > 0;

$conexion = Conexion::getConexion();

$equipo = Equipo::getPorUsuario($_SESSION['usuario_id']);
$formacion_guardada = $equipo ? $equipo['formacion'] : '4-3-3';
$jugadores_equipo = $equipo ? $equipo['jugadores'] : [];

$ok = isset($_GET['ok']);

$ids_comprados = [];
$stmt = $conexion->prepare(
    "SELECT DISTINCT jugador_id FROM detalle_compra dc JOIN compras c ON dc.compra_id = c.id WHERE c.usuario_id = :uid"
);
$stmt->execute(['uid' => $_SESSION['usuario_id']]);
$ids_comprados = $stmt->fetchAll(PDO::FETCH_COLUMN);

$stmt = $conexion->prepare(
    "SELECT j.id, j.nombre_apellido, j.imagen, p.posicion
     FROM jugadores j
     JOIN posicion_x_jugador pxj ON j.id = pxj.jugador_id
     JOIN posiciones p ON pxj.posicion_id = p.id
     WHERE p.posicion != 'global'
     ORDER BY p.posicion, j.nombre_apellido"
);
$stmt->execute();
$todas_posiciones = $stmt->fetchAll(PDO::FETCH_ASSOC);

$mapa_categoria = [
    'ARQUERO' => 'ARQUERO', 'DEFENSOR' => 'DEFENSOR',
    'DEFENSOR CENTRAL' => 'DEFENSOR', 'LATERAL IZQUIERDO' => 'DEFENSOR',
    'LATERAL DERECHO' => 'DEFENSOR', 'MEDIOCAMPISTA' => 'MEDIOCAMPISTA',
    'MEDIOCAMPISTA DEFENSIVO' => 'MEDIOCAMPISTA', 'MEDIOCAMPISTA CENTRAL' => 'MEDIOCAMPISTA',
    'MEDIOCAMPISTA OFENSIVO' => 'MEDIOCAMPISTA', 'DELANTERO' => 'DELANTERO',
    'DELANTERO CENTRO' => 'DELANTERO', 'EXTREMO IZQUIERDO' => 'DELANTERO',
    'EXTREMO DERECHO' => 'DELANTERO',
];

$jugadores_por_categoria = ['ARQUERO' => [], 'DEFENSOR' => [], 'MEDIOCAMPISTA' => [], 'DELANTERO' => []];
$vistos = ['ARQUERO' => [], 'DEFENSOR' => [], 'MEDIOCAMPISTA' => [], 'DELANTERO' => []];

foreach ($todas_posiciones as $row) {
    $cat = $mapa_categoria[$row['posicion']] ?? null;
    if (!$cat) continue;
    if (in_array($row['id'], $vistos[$cat])) continue;
    $vistos[$cat][] = $row['id'];
    $jugadores_por_categoria[$cat][] = $row;
}

$etiqueta = [
    'ARQUERO' => 'Arquero', 'DEFENSOR' => 'Defensor',
    'MEDIOCAMPISTA' => 'Mediocampista', 'DELANTERO' => 'Delantero',
];
$categorias = ['ARQUERO', 'DEFENSOR', 'MEDIOCAMPISTA', 'DELANTERO'];

$formaciones = [
    ['id' => '433',  'nombre' => '4-3-3',   'label' => '4-3-3'],
    ['id' => '442',  'nombre' => '4-4-2',   'label' => '4-4-2'],
    ['id' => '4231', 'nombre' => '4-2-3-1', 'label' => '4-2-3-1'],
    ['id' => '343',  'nombre' => '3-4-3',   'label' => '3-4-3'],
    ['id' => '532',  'nombre' => '5-3-2',   'label' => '5-3-2'],
    ['id' => '451',  'nombre' => '4-5-1',   'label' => '4-5-1'],
];

$pitch_slots = [
    '4-3-3' => [
        ['t'=>93,'l'=>50,'p'=>'ARQUERO'],
        ['t'=>67,'l'=>10,'p'=>'DEFENSOR'], ['t'=>70,'l'=>33,'p'=>'DEFENSOR'],
        ['t'=>70,'l'=>67,'p'=>'DEFENSOR'], ['t'=>67,'l'=>90,'p'=>'DEFENSOR'],
        ['t'=>41,'l'=>15,'p'=>'MEDIOCAMPISTA'], ['t'=>37,'l'=>50,'p'=>'MEDIOCAMPISTA'],
        ['t'=>41,'l'=>85,'p'=>'MEDIOCAMPISTA'],
        ['t'=>17,'l'=>15,'p'=>'DELANTERO'], ['t'=>12,'l'=>50,'p'=>'DELANTERO'],
        ['t'=>17,'l'=>85,'p'=>'DELANTERO'],
    ],
    '4-4-2' => [
        ['t'=>93,'l'=>50,'p'=>'ARQUERO'],
        ['t'=>67,'l'=>10,'p'=>'DEFENSOR'], ['t'=>70,'l'=>33,'p'=>'DEFENSOR'],
        ['t'=>70,'l'=>67,'p'=>'DEFENSOR'], ['t'=>67,'l'=>90,'p'=>'DEFENSOR'],
        ['t'=>39,'l'=>12,'p'=>'MEDIOCAMPISTA'], ['t'=>35,'l'=>38,'p'=>'MEDIOCAMPISTA'],
        ['t'=>35,'l'=>62,'p'=>'MEDIOCAMPISTA'], ['t'=>39,'l'=>88,'p'=>'MEDIOCAMPISTA'],
        ['t'=>13,'l'=>35,'p'=>'DELANTERO'], ['t'=>13,'l'=>65,'p'=>'DELANTERO'],
    ],
    '4-2-3-1' => [
        ['t'=>93,'l'=>50,'p'=>'ARQUERO'],
        ['t'=>67,'l'=>10,'p'=>'DEFENSOR'], ['t'=>70,'l'=>33,'p'=>'DEFENSOR'],
        ['t'=>70,'l'=>67,'p'=>'DEFENSOR'], ['t'=>67,'l'=>90,'p'=>'DEFENSOR'],
        ['t'=>49,'l'=>35,'p'=>'MEDIOCAMPISTA'], ['t'=>49,'l'=>65,'p'=>'MEDIOCAMPISTA'],
        ['t'=>25,'l'=>15,'p'=>'DELANTERO'], ['t'=>23,'l'=>50,'p'=>'MEDIOCAMPISTA'],
        ['t'=>25,'l'=>85,'p'=>'DELANTERO'], ['t'=>12,'l'=>50,'p'=>'DELANTERO'],
    ],
    '3-4-3' => [
        ['t'=>93,'l'=>50,'p'=>'ARQUERO'],
        ['t'=>70,'l'=>23,'p'=>'DEFENSOR'], ['t'=>73,'l'=>50,'p'=>'DEFENSOR'],
        ['t'=>70,'l'=>77,'p'=>'DEFENSOR'],
        ['t'=>41,'l'=>12,'p'=>'MEDIOCAMPISTA'], ['t'=>37,'l'=>38,'p'=>'MEDIOCAMPISTA'],
        ['t'=>37,'l'=>62,'p'=>'MEDIOCAMPISTA'], ['t'=>41,'l'=>88,'p'=>'MEDIOCAMPISTA'],
        ['t'=>17,'l'=>15,'p'=>'DELANTERO'], ['t'=>12,'l'=>50,'p'=>'DELANTERO'],
        ['t'=>17,'l'=>85,'p'=>'DELANTERO'],
    ],
    '5-3-2' => [
        ['t'=>93,'l'=>50,'p'=>'ARQUERO'],
        ['t'=>65,'l'=>7,'p'=>'DEFENSOR'], ['t'=>67,'l'=>27,'p'=>'DEFENSOR'],
        ['t'=>69,'l'=>50,'p'=>'DEFENSOR'], ['t'=>67,'l'=>73,'p'=>'DEFENSOR'],
        ['t'=>65,'l'=>93,'p'=>'DEFENSOR'],
        ['t'=>40,'l'=>16,'p'=>'MEDIOCAMPISTA'], ['t'=>36,'l'=>50,'p'=>'MEDIOCAMPISTA'],
        ['t'=>40,'l'=>84,'p'=>'MEDIOCAMPISTA'],
        ['t'=>14,'l'=>33,'p'=>'DELANTERO'], ['t'=>14,'l'=>67,'p'=>'DELANTERO'],
    ],
    '4-5-1' => [
        ['t'=>92,'l'=>50,'p'=>'ARQUERO'],
        ['t'=>67,'l'=>10,'p'=>'DEFENSOR'], ['t'=>70,'l'=>33,'p'=>'DEFENSOR'],
        ['t'=>70,'l'=>67,'p'=>'DEFENSOR'], ['t'=>67,'l'=>90,'p'=>'DEFENSOR'],
        ['t'=>34,'l'=>10,'p'=>'MEDIOCAMPISTA'], ['t'=>30,'l'=>33,'p'=>'MEDIOCAMPISTA'],
        ['t'=>28,'l'=>50,'p'=>'MEDIOCAMPISTA'], ['t'=>30,'l'=>67,'p'=>'MEDIOCAMPISTA'],
        ['t'=>34,'l'=>90,'p'=>'MEDIOCAMPISTA'],
        ['t'=>12,'l'=>50,'p'=>'DELANTERO'],
    ],
];
?>
<h2>Editar Equipo</h2>

<?php if ($ok): ?>
<p class="aviso-ok">Equipo guardado correctamente.</p>
<?php endif; ?>

<div class="formacion-selector">
<?php foreach ($formaciones as $f): ?>
    <input type="radio" name="formacion" id="form-<?= $f['id'] ?>"
           <?= $formacion_guardada === $f['nombre'] ? 'checked' : '' ?> hidden>
<?php endforeach; ?>

    <nav class="formacion-nav">
    <?php foreach ($formaciones as $f): ?>
        <button type="button" class="formacion-btn" data-formacion="<?= $f['nombre'] ?>"><?= $f['label'] ?></button>
    <?php endforeach; ?>
    </nav>

<?php foreach ($pitch_slots as $fnombre => $slots): ?>
    <?php $fid = str_replace('-', '', $fnombre); ?>
    <div class="pitch pitch-<?= $fid ?>">
    <?php foreach ($slots as $i => $s):
        $asignado = $formacion_guardada === $fnombre && isset($jugadores_equipo[$i]);
        $j = $asignado ? $jugadores_equipo[$i] : null;
    ?>
        <div class="player <?= $asignado ? 'ocupado' : '' ?>"
             style="top:<?= $s['t'] ?>%;left:<?= $s['l'] ?>%"
             data-posicion="<?= $s['p'] ?>"
             data-asignado-id="<?= $j['id'] ?? '' ?>">
            <div class="player-circulo">
                <?php if ($asignado && $j['imagen']): ?>
                <img src="assets/img/<?= rawurlencode($j['imagen']) ?>" alt="">
                <?php endif; ?>
            </div>
            <?php if ($asignado): ?>
            <span class="player-nombre"><?= htmlspecialchars($j['nombre_apellido']) ?></span>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
    </div>
<?php endforeach; ?>
</div>

<form class="equipo-acciones" method="POST" action="actions/guardar_equipo_acc.php">
    <input type="hidden" name="formacion" id="formacion-input">
    <input type="hidden" name="slots" id="slots-input">
    <button class="button" type="submit">Guardar Equipo</button>
    <button class="btn-cancelar" type="button" id="btn-reset-equipo">Resetear equipo</button>
</form>

<div class="modal-overlay" id="modal-confirmar-formacion">
    <div class="modal-inner modal-chico">
        <h3>¿Cambiar formación?</h3>
        <p>Se perderán los jugadores asignados. ¿Continuar?</p>
        <div class="modal-acciones">
            <button class="btn-cancelar" data-cerrar-confirm>Cancelar</button>
            <button class="button" id="btn-confirmar-formacion">Cambiar</button>
        </div>
    </div>
</div>

<?php foreach ($categorias as $cat): ?>
<div class="modal-overlay" id="modal-<?= $cat ?>">
    <div class="modal-inner">
        <button class="modal-cerrar" data-cerrar-modal>&times;</button>
        <h3><?= $etiqueta[$cat] ?></h3>
        <ul class="modal-lista">
            <?php $jugadores = $jugadores_por_categoria[$cat]; ?>
            <?php if (empty($jugadores)): ?>
                <li class="modal-vacio">No hay jugadores disponibles</li>
            <?php else: ?>
                <?php foreach ($jugadores as $j):
                    $es_comprado = $es_admin || in_array($j['id'], $ids_comprados);
                ?>
                <li class="modal-jugador <?= $es_comprado ? 'comprado' : 'no-comprado' ?>"
                    data-player-id="<?= $j['id'] ?>"
                    data-player-name="<?= htmlspecialchars($j['nombre_apellido'], ENT_QUOTES) ?>"
                    data-player-image="<?= htmlspecialchars($j['imagen'], ENT_QUOTES) ?>">
                    <?php if ($j['imagen']): ?>
                        <img src="assets/img/<?= rawurlencode($j['imagen']) ?>" alt="" width="40" height="40" loading="lazy">
                    <?php endif; ?>
                    <span><?= htmlspecialchars($j['nombre_apellido']) ?></span>
                    <?php if (!$es_comprado): ?>
                        <span class="modal-bloqueado">Bloqueado</span>
                    <?php endif; ?>
                </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </div>
</div>
<?php endforeach; ?>

<script>
(function() {
    var slotActual = null;
    var formacionPendiente = null;
    var selector = document.querySelector('.formacion-selector');

    function limpiarSlots() {
        document.querySelectorAll('.player.ocupado').forEach(function(p) {
            p.classList.remove('ocupado');
            p.removeAttribute('data-asignado-id');
            var img = p.querySelector('.player-circulo img');
            if (img) img.remove();
            var name = p.querySelector('.player-nombre');
            if (name) name.remove();
        });
    }

    function getFormacionActiva() {
        return document.querySelector('.formacion-selector input[type="radio"]:checked');
    }

    function getIdFormacion(nombre) {
        return 'form-' + nombre.replace(/-/g, '');
    }

    function activarFormacion(nombre) {
        var radio = document.getElementById(getIdFormacion(nombre));
        if (radio) radio.checked = true;
    }

    document.querySelectorAll('.formacion-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var destino = this.getAttribute('data-formacion');
            var actualRadio = getFormacionActiva();
            var actualNombre = actualRadio ? actualRadio.id.replace('form-', '') : '433';
            var actualFormateado = actualNombre.replace(/(\d)(\d)(\d)/, '$1-$2-$3').replace(/-(\d)-(\d)/, function(m,a,b){return '-'+a+'-'+b;});
            // Try both patterns: 433 and 4231
            var actualNormalizado = '';
            if (actualNombre === '433') actualNormalizado = '4-3-3';
            else if (actualNombre === '442') actualNormalizado = '4-4-2';
            else if (actualNombre === '4231') actualNormalizado = '4-2-3-1';
            else if (actualNombre === '343') actualNormalizado = '3-4-3';
            else if (actualNombre === '532') actualNormalizado = '5-3-2';
            else if (actualNombre === '451') actualNormalizado = '4-5-1';
            else actualNormalizado = actualNombre;

            if (destino === actualNormalizado) return;

            var hayOcupados = document.querySelectorAll('.player.ocupado').length > 0;
            if (hayOcupados) {
                formacionPendiente = destino;
                document.getElementById('modal-confirmar-formacion').classList.add('show');
            } else {
                activarFormacion(destino);
            }
        });
    });

    document.getElementById('btn-confirmar-formacion').addEventListener('click', function() {
        if (formacionPendiente) {
            activarFormacion(formacionPendiente);
            limpiarSlots();
            formacionPendiente = null;
        }
        document.getElementById('modal-confirmar-formacion').classList.remove('show');
    });

    document.querySelectorAll('[data-cerrar-confirm]').forEach(function(btn) {
        btn.addEventListener('click', function() {
            document.getElementById('modal-confirmar-formacion').classList.remove('show');
            formacionPendiente = null;
        });
    });

    selector.addEventListener('click', function(e) {
        var player = e.target.closest('.player');
        if (!player) return;
        slotActual = player;
        var pos = player.getAttribute('data-posicion');
        var modal = document.getElementById('modal-' + pos);
        if (modal) modal.classList.add('show');
    });

    document.addEventListener('click', function(e) {
        var item = e.target.closest('.modal-jugador.comprado');
        if (!item || !slotActual) return;
        var id = item.getAttribute('data-player-id');
        var name = item.getAttribute('data-player-name');
        var image = item.getAttribute('data-player-image');
        if (!name || !image) return;
        var circulo = slotActual.querySelector('.player-circulo');
        if (!circulo) return;
        var oldImg = circulo.querySelector('img');
        if (oldImg) oldImg.remove();
        var oldName = slotActual.querySelector('.player-nombre');
        if (oldName) oldName.remove();
        var img = document.createElement('img');
        img.src = 'assets/img/' + encodeURIComponent(image);
        img.alt = name;
        circulo.appendChild(img);
        var span = document.createElement('span');
        span.className = 'player-nombre';
        span.textContent = name;
        slotActual.appendChild(span);
        slotActual.classList.add('ocupado');
        slotActual.setAttribute('data-asignado-id', id);
        var modal = item.closest('.modal-overlay');
        modal.classList.remove('show');
        slotActual = null;
    });

    document.querySelectorAll('[data-cerrar-modal]').forEach(function(btn) {
        btn.addEventListener('click', function() {
            this.closest('.modal-overlay').classList.remove('show');
            slotActual = null;
        });
    });

    document.querySelectorAll('.modal-overlay').forEach(function(overlay) {
        overlay.addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.remove('show');
                slotActual = null;
            }
        });
    });

    document.querySelector('.equipo-acciones').addEventListener('submit', function(e) {
        var radio = getFormacionActiva();
        if (!radio) return;
        var fid = radio.id.replace('form-', '');
        var formacionNombre = '';
        var fm = { '433':'4-3-3', '442':'4-4-2', '4231':'4-2-3-1', '343':'3-4-3', '532':'5-3-2', '451':'4-5-1' };
        formacionNombre = fm[fid] || fid;
        document.getElementById('formacion-input').value = formacionNombre;

        var pitchActivo = document.querySelector('.pitch-' + fid);
        if (!pitchActivo) return;
        var players = pitchActivo.querySelectorAll('.player');
        var slots = [];
        players.forEach(function(p, idx) {
            var oid = p.getAttribute('data-asignado-id');
            if (oid && parseInt(oid) > 0) {
                slots.push({slot: idx, jugador: parseInt(oid)});
            }
        });
        document.getElementById('slots-input').value = JSON.stringify(slots);
    });

    document.getElementById('btn-reset-equipo').addEventListener('click', function() {
        if (confirm('¿Eliminar el equipo guardado y resetear la cancha?')) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'actions/guardar_equipo_acc.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() { location.reload(); };
            xhr.send('formacion=4-3-3&slots=[]');
        }
    });
})();
</script>
