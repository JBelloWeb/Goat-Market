<h2>Iniciar sesión</h2>

<?php if(isset($_GET['error'])): ?>
    <p class="error-msg">Usuario o contraseña incorrectos.</p>
<?php endif; ?>

<form id="loginForm" action="actions/login_acc.php" method="post">
    <div class="form-item">
        <label for="nombre">Usuario</label>
        <input type="text" id="nombre" name="nombre" required>
    </div>
    <div class="form-item">
        <label for="contraseña">Contraseña</label>
        <input type="password" id="contraseña" name="contraseña" required>
    </div>
    <input class="button btn-submit" type="submit" value="Ingresar">
</form>

<div class="acciones" style="justify-content: center; margin-top: 1rem;">
    <a class="btn-cancelar" href="?sec=inicio">Volver al inicio</a>
</div>
