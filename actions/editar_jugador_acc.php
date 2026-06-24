<?php
    require_once "../clases/Conexion.php";
    require_once "../clases/Jugadores.php";

    $datos = $_POST;
    var_dump($datos);

    $datosArchivo = $_FILES['foto'];
    $archivoSubido = false;

    if(!empty($datosArchivo['name'])){
        $nombreOriginal = (explode(".", $datosArchivo['name']));
        $extension = end($nombreOriginal);
        $nombreNuevo = time() . rand(01,99) . ".$extension";
        $archivoSubido = move_uploaded_file($datosArchivo['tmp_name'], "../assets/img/$nombreNuevo");
    }

    $jugador = Jugadores::get_x_id($datos['id']);
    $imagenAnterior = $jugador -> getImagen();
    
    if($archivoSubido){
        try{
            $jugador->edit(
                $datos["nombre"],
                $datos["descripcion"],
                (float) $datos["precio"],
                $datos["fecha_nacimiento"],
                $nombreNuevo,
                $datos["pais"]
            );
        } catch (Exception $e){
            die("<p>No se pudo editar el producto</p>");
        }

        if(!empty($imagenAnterior)){
            $archivo = "../assets/img/" . $imagenAnterior;

            if(file_exists($archivo)){

                $fileDelete = unlink($archivo);
                
                if(!$fileDelete){
                    throw new Exception("No se pudo eliminar la imagen");
                }
            } else {
                throw new Exception("No existe el archivo");
            }
        }

        header('Location: ../index.php?sec=inicio');

    } else {
        try{
            $jugador->edit(
                $datos["nombre"],
                $datos["descripcion"],
                (float) $datos["precio"],
                $datos["fecha_nacimiento"],
                $imagenAnterior,
                $datos["pais"]
            );
        } catch (Exception $e){
            die("<p>No se pudo editar el producto</p>");
        }
    }
    header('Location: ../index.php?sec=inicio');
?>