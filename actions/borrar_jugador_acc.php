<?php 
    require_once "../clases/Conexion.php";
    require_once "../clases/Jugadores.php";

    $id = $_GET['id'] ?? FALSE;

    $jugador = Jugadores::get_x_id($id);

    try{
        $jugador -> delete();
    } catch (Exception $e){
        die("No se pudo encontrar el jugador");
    }
    header ('Location: ../index.php?sec=inicio');
?>