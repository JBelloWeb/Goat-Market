 <?php 
    session_start();
    require_once "clases/Conexion.php";
    require_once "funcs/config.php";
    require_once "clases/Secciones.php";
    require_once "clases/Usuario.php";

    $usuario = null;
    if(isset($_SESSION['usuario_id'])){
        $usuario = Usuario::get_x_id($_SESSION['usuario_id']);
    }

    $secciones_menu = Secciones::secciones_menu();
    $secciones = Secciones::secciones_del_sitio();
    $seccion_solicitada = isset($_GET['sec']) ? $_GET['sec'] : 'inicio';

    $vista = '404';
    $seccion_titulo = 'Página no encontrada';

    foreach ($secciones as $value){
        if($value -> getVinculo() == $seccion_solicitada) {
            if($value->getSerAdministrador() && (!$usuario || $usuario->getEsAdministrador() <= 0)){
                break;
            }
            $vista = $seccion_solicitada;
            $seccion_titulo = $value -> getTitulo();
            break;
        }
    }
?>
<!DOCTYPE html>
<html lang="es-AR"> 
        <?php require_once("layout/head.php"); ?>
<body>
    <?php require_once("layout/header.php") ?>
    <main>
        <?php require_once("vistas/$vista.php") ?>
    </main>
    <?php require_once("layout/footer.php") ?>
</body>
</html>