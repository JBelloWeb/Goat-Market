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

    $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

    $pais = Pais::get_x_id($id);

    if($pais){
        $conexion = (new Conexion())->getConexion();

        if($pais->getNombre() === 'global'){
            try{
                $conexion->beginTransaction();

                $query = "INSERT INTO paises (nombre, estrellas, color) VALUES (:nombre, :estrellas, :color)";
                $stmt = $conexion->prepare($query);
                $stmt->execute(['nombre' => 'global', 'estrellas' => 0, 'color' => '#666666']);
                $nuevoId = $conexion->lastInsertId();

                $query = "UPDATE jugadores SET pais_id = :nuevo_id WHERE pais_id = :viejo_id";
                $stmt = $conexion->prepare($query);
                $stmt->execute(['nuevo_id' => $nuevoId, 'viejo_id' => $id]);

                $query = "DELETE FROM paises WHERE id = :id";
                $stmt = $conexion->prepare($query);
                $stmt->execute(['id' => $id]);

                $conexion->commit();
            } catch (Exception $e){
                $conexion->rollBack();
                die("No se pudo eliminar el país");
            }
        } else {
            try{
                $pais->delete();
            } catch (Exception $e){
                die("No se pudo eliminar el país");
            }
        }
    }

    header('Location: ../?sec=panel_paises');
    exit;
