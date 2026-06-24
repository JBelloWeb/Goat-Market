<?php
    session_start();
    require_once "../clases/Carrito.php";

    if(!isset($_SESSION['usuario_id'])){
        header('Location: ../?sec=login');
        exit;
    }

    $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

    if($id > 0){
        Carrito::quitar($_SESSION['usuario_id'], $id);
    }

    header('Location: ../?sec=carrito');
    exit;
