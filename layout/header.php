<header>
    <nav>
        <h1>
            <img src="favicon.svg" alt="GOAT Market" class="header-logo">
            <a href="?sec=inicio">Goat Market</a>
        </h1>

        <input type="checkbox" id="menu-toggle" hidden>
        <label for="menu-toggle" class="hamburger">&#9776;</label>

        <div class="nav-menu">
            <ul>
                <?php
                    foreach($secciones as $value){
                        if($value -> getInMenu()){
                            $activo = $value -> getVinculo() === $seccion_solicitada ? 'active' : '';
                            ?> 
                                <li>
                                    <a href="?sec=<?= $value -> getVinculo(); ?>" class="<?= $activo; ?>"><?= $value -> getTitulo(); ?></a>
                                </li>
                            <?php
                        }
                    }
                ?>
            </ul>

            <ul>
                <?php if($usuario): ?>
                    <li><a href="?sec=carrito"<?= $seccion_solicitada === 'carrito' ? ' class="active"' : ''; ?>>Carrito</a></li>
                    <li><a href="?sec=mis-compras"<?= $seccion_solicitada === 'mis-compras' ? ' class="active"' : ''; ?>>Mis Compras</a></li>
                    <?php if($usuario->getEsAdministrador() > 0): ?>
                        <li><a href="?sec=panel_administrador"<?= $seccion_solicitada === 'panel_administrador' ? ' class="active"' : ''; ?>>Panel Admin</a></li>
                    <?php endif; ?>
                    <li><a style="color: #d72638;" href="actions/logout_acc.php">Cerrar sesión</a></li>
                <?php else: ?>
                    <li><a href="?sec=login"<?= $seccion_solicitada === 'login' ? ' class="active"' : ''; ?>>Iniciar sesión</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
</header>
