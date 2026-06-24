<h2>Iniciar sesión</h2>

<?php if(isset($_GET['error'])): ?>
    <p style="color:red;">Usuario o contraseña incorrectos.</p>
<?php endif; ?>

<form action="actions/login_acc.php" method="post">
    <div>
        <label for="nombre">Usuario</label>
        <input type="text" id="nombre" name="nombre" required>
    </div>
    <div>
        <label for="contraseña">Contraseña</label>
        <input type="password" id="contraseña" name="contraseña" required>
    </div>
    <input type="submit" value="Ingresar">
</form>
