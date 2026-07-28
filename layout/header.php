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
                    <li><a href="?sec=mis-compras">Mis Compras</a></li>
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
