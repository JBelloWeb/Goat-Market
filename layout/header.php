<header>
    <nav>
        <div>
            <a href="?sec=inicio">Goat Market</a>

            <ul>
                <?php
                    foreach($secciones as $value){
                        if($value -> getInMenu()){
                            ?> 
                                <li>
                                    <a href="?sec=<?= $value -> getVinculo(); ?>"><?= $value -> getTitulo(); ?></a>
                                </li>
                            <?php
                        }
                    }
                ?>
            </ul>

            <ul>
                <?php if($usuario): ?>
                    <li><a href="?sec=carrito">Carrito</a></li>
                    <?php if($usuario->getEsAdministrador() > 0): ?>
                        <li><a href="?sec=panel_administrador">Panel Admin</a></li>
                    <?php endif; ?>
                    <li><a href="actions/logout_acc.php">Cerrar sesión</a></li>
                <?php else: ?>
                    <li><a href="?sec=login">Iniciar sesión</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
</header>
