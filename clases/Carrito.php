<?php
require_once "Conexion.php";
require_once "Jugadores.php";

class Carrito
{
  public static function agregar(int $usuario_id, int $jugador_id): bool
  {
    $conexion = Conexion::getConexion();

    $check = "SELECT COUNT(*) FROM carrito WHERE usuario_id = :usuario_id AND jugador_id = :jugador_id";
    $stmt = $conexion->prepare($check);
    $stmt->execute(['usuario_id' => $usuario_id, 'jugador_id' => $jugador_id]);
    if ($stmt->fetchColumn() > 0) {
      return false;
    }

    $query = "INSERT INTO carrito (`usuario_id`, `jugador_id`, `cantidad`) VALUES (:usuario_id, :jugador_id, 1)";

    $PDOStatement = $conexion -> prepare($query);
    $PDOStatement -> execute([
      'usuario_id' => $usuario_id,
      'jugador_id' => $jugador_id
    ]);

    return true;
  }

  public static function quitar(int $usuario_id, int $jugador_id){
    $conexion = Conexion::getConexion();

    $query = "DELETE FROM carrito WHERE usuario_id = :usuario_id AND jugador_id = :jugador_id";

    $PDOStatement = $conexion -> prepare($query);
    $PDOStatement -> execute([
      'usuario_id' => $usuario_id,
      'jugador_id' => $jugador_id
    ]);
  }

  public static function listar(int $usuario_id):array
  {
    $conexion = Conexion::getConexion();

    $query = "SELECT j.*, c.cantidad, p.nombre AS pais_nombre
              FROM carrito c
              JOIN jugadores j ON c.jugador_id = j.id
              LEFT JOIN paises p ON j.pais_id = p.id
              WHERE c.usuario_id = :usuario_id";

    $PDOStatement = $conexion -> prepare($query);
    $PDOStatement -> setFetchMode(PDO::FETCH_CLASS, 'Jugadores');
    $PDOStatement -> execute(['usuario_id' => $usuario_id]);
    return $PDOStatement -> fetchAll();
  }

  public static function vaciar(int $usuario_id){
    $conexion = Conexion::getConexion();

    $query = "DELETE FROM carrito WHERE usuario_id = :usuario_id";

    $PDOStatement = $conexion -> prepare($query);
    $PDOStatement -> execute(['usuario_id' => $usuario_id]);
  }
}
