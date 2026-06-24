<?php
    session_start();
    require_once "../clases/Usuario.php";

    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $contraseña = isset($_POST['contraseña']) ? $_POST['contraseña'] : '';

    $usuario = Usuario::login($nombre, $contraseña);

    if($usuario){
        $_SESSION['usuario_id'] = $usuario->getId();
        header('Location: ../?sec=inicio');
    } else {
        header('Location: ../?sec=login&error=1');
    }

    exit;
