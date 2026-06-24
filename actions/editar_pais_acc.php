<?php
    require_once "../clases/Conexion.php";
    require_once "../clases/Pais.php";

    $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $estrellas = isset($_POST['estrellas']) ? (int) $_POST['estrellas'] : 0;
    $color = isset($_POST['color']) ? $_POST['color'] : '#67b7fd';

    $pais = Pais::get_x_id($id);

    if($pais){
        try{
            $pais->edit($nombre, $estrellas, $color);
        } catch (Exception $e){
            die("No se pudo editar el país");
        }
    }

    header('Location: ../?sec=panel_paises');
