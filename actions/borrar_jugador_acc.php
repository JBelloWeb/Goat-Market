<?php
    session_start();
    require_once "../clases/Conexion.php";
    require_once "../clases/Jugadores.php";
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

    $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

    $jugador = Jugadores::get_x_id($id);

    if($jugador){
        try{
            $imagen = $jugador->getImagen();
            $jugador->delete();

            if(!empty($imagen)){
                $archivo = "../assets/img/" . $imagen;
                if(file_exists($archivo)){
                    unlink($archivo);
                }
            }
        } catch (Exception $e){
            die("No se pudo eliminar el jugador");
        }
    }

    header('Location: ../?sec=panel_administrador');
    exit;
