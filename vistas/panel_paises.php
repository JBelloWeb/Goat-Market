<?php
    require_once __DIR__ . "/../clases/Pais.php";

    $paises = Pais::todos();
?>

<h2>Gestión de Países</h2>

<a href="?sec=cargar_pais">Cargar nuevo país</a>

<?php require __DIR__ . "/../componentes/tabla-paises.php"; ?>
