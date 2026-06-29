<?php
    session_start();
    require_once "../clases/Conexion.php";
    require_once "../clases/Jugadores.php";
    require_once "../clases/Posiciones.php";
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
    $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
    $precio = isset($_POST['precio']) ? (float) $_POST['precio'] : 0;
    $fecha_nacimiento = isset($_POST['fecha_nacimiento']) ? $_POST['fecha_nacimiento'] : '';
    $pais_id = isset($_POST['pais_id']) ? (int) $_POST['pais_id'] : 0;
    $posiciones = isset($_POST['posiciones']) ? $_POST['posiciones'] : [];

    if($nombre === ''){
        die("El nombre del jugador es obligatorio.");
    }

    if($precio <= 0){
        die("El precio debe ser mayor a cero.");
    }

    if($pais_id <= 0){
        die("Debe seleccionar un país válido.");
    }

    if($fecha_nacimiento === ''){
        die("La fecha de nacimiento es obligatoria.");
    }

    $nombreNuevo = null;

    if(!empty($_FILES['foto']['name'])){
        $datosArchivo = $_FILES['foto'];

        if($datosArchivo['error'] !== UPLOAD_ERR_OK){
            die("Error al subir el archivo.");
        }

        $allowedTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
        if(!in_array($datosArchivo['type'], $allowedTypes)){
            die("Solo se permiten imágenes (JPEG, PNG, WebP, GIF).");
        }

        $maxSize = 2 * 1024 * 1024;
        if($datosArchivo['size'] > $maxSize){
            die("La imagen no puede superar los 2MB.");
        }

        $nombreOriginal = explode(".", $datosArchivo['name']);
        $extension = end($nombreOriginal);
        $nombreNuevo = time() . rand(1, 99) . ".$extension";
        move_uploaded_file($datosArchivo['tmp_name'], "../assets/img/$nombreNuevo");
    }

    try{
        $jugador_id = Jugadores::insert(
            $nombre,
            $descripcion,
            $precio,
            $fecha_nacimiento,
            $nombreNuevo,
            $pais_id
        );

        if(!empty($posiciones)){
            Posiciones::guardarPosicionesJugador($jugador_id, $posiciones);
        }
    } catch(Exception $e){
        die("No se pudo cargar el jugador");
    }

    header('Location: ../?sec=panel_administrador');
    exit;
