<?php
    require_once "../clases/Conexion.php";
    require_once "../clases/Pais.php";

    $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

    $pais = Pais::get_x_id($id);

    if($pais){
        try{
            $pais->delete();
        } catch (Exception $e){
            die("No se pudo eliminar el país");
        }
    }

    header('Location: ../?sec=panel_paises');
