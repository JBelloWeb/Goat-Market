<?php
    require_once "../clases/Conexion.php";
    require_once "../clases/Jugadores.php";

    $postData = $_POST;
    $datosArchivo = $_FILES['foto'];

    echo "<pre>";
    print_r($postData);
    echo "</pre>";

    echo "<pre>";
    print_r($datosArchivo);
    echo"</pre>";

    $nombreOriginal = (explode(".", $datosArchivo['name']));
    var_dump($nombreOriginal);
    $extension = end($nombreOriginal);
    echo $extension;
    $nombreNuevo = time() . rand(01,99). ".$extension";
    echo "<p>" . $nombreNuevo . "</p>";
    $archivoSubido = move_uploaded_file($datosArchivo['tmp_name'], "../assets/img/l/$nombreNuevo");
  
    $fecha_creacion = date("Y-m-d");

    if($archivoSubido){
        $foto = $nombreNuevo;
        var_dump($foto);

        try{
            Jugadores::insert(
                $postData['nombre'],
                $postData['descripcion'],
                (float) $postData['precio'],
                $postData['fecha_nacimiento'],
                $nombreNuevo,
                $postData['pais']
            );
        } catch(Exception $e){
            die("No se pudo cargar el jugador");
        }
    } else {
        die("No se pudo subir la foto");
    }
?>