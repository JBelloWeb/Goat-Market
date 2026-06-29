<?php
    session_start();
    require_once "../clases/Conexion.php";
    require_once "../clases/Pais.php";
    require_once "../clases/Usuario.php";

    if(!isset($_SESSION['usuario_id'])){
        header('Location: ../?sec=login');
        exit;
    }

    $usuario = Usuario::get_x_id($_SESSION['usuario_id']);
    if(!$usuario || $usuario->getEsAdministrador() <= 0){
        header('Location: ../?sec=login');
        exit;
    }

    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
    $estrellas = isset($_POST['estrellas']) ? (int) $_POST['estrellas'] : 0;
    $color = isset($_POST['color']) ? $_POST['color'] : '#67b7fd';

    if($nombre === ''){
        die("El nombre del país es obligatorio.");
    }

    if($estrellas < 0 || $estrellas > 5){
        die("Las estrellas deben estar entre 0 y 5.");
    }

    try{
        Pais::insert($nombre, $estrellas, $color);
    } catch (Exception $e){
        die("No se pudo cargar el país");
    }

    header('Location: ../?sec=panel_paises');
    exit;
