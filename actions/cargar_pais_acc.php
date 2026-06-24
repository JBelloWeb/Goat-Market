<?php
    require_once "../clases/Conexion.php";
    require_once "../clases/Pais.php";

    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $estrellas = isset($_POST['estrellas']) ? (int) $_POST['estrellas'] : 0;
    $color = isset($_POST['color']) ? $_POST['color'] : '#67b7fd';

    try{
        Pais::insert($nombre, $estrellas, $color);
    } catch (Exception $e){
        die("No se pudo cargar el país");
    }

    header('Location: ../?sec=panel_paises');
