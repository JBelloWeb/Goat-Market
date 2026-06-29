<?php
    session_start();
    require_once "../clases/Carrito.php";

    if(!isset($_SESSION['usuario_id'])){
        header('Location: ../?sec=login');
        exit;
    }

    $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

    $duplicado = false;
    if($id > 0){
        if (!Carrito::agregar($_SESSION['usuario_id'], $id)) {
            $duplicado = true;
        }
    }

    header('Location: ../?sec=carrito' . ($duplicado ? '&error=duplicado' : ''));
    exit;
