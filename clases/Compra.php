<?php
require_once "Conexion.php";
require_once "Carrito.php";
require_once "Jugadores.php";

class Compra
{
  private $id;
  private $usuario_id;
  private $total;
  private $fecha;

  public function getId() { return $this->id; }
  public function getUsuarioId() { return $this->usuario_id; }
  public function getTotal() { return $this->total; }
  public function getFecha() { return $this->fecha; }

  public static function crear(int $usuario_id): ?int
  {
    $conexion = Conexion::getConexion();
    $items = Carrito::listar($usuario_id);

    if (empty($items)) return null;

    $total = 0;
    foreach ($items as $item) {
      $total += $item->getPrecio();
    }

    $conexion->beginTransaction();
    try {
      $query = "INSERT INTO compras (usuario_id, total) VALUES (:usuario_id, :total)";
      $stmt = $conexion->prepare($query);
      $stmt->execute(['usuario_id' => $usuario_id, 'total' => $total]);
      $compra_id = $conexion->lastInsertId();

      $query = "INSERT INTO detalle_compra (compra_id, jugador_id, precio_unitario) VALUES (:compra_id, :jugador_id, :precio)";
      $stmt = $conexion->prepare($query);

      foreach ($items as $item) {
        $stmt->execute([
          'compra_id' => $compra_id,
          'jugador_id' => $item->getId(),
          'precio' => $item->getPrecio()
        ]);
      }

      Carrito::vaciar($usuario_id);
      $conexion->commit();
      return (int) $compra_id;
    } catch (Exception $e) {
      $conexion->rollBack();
      return null;
    }
  }

  public static function getPorUsuario(int $usuario_id): array
  {
    $conexion = Conexion::getConexion();
    $query = "SELECT * FROM compras WHERE usuario_id = :usuario_id ORDER BY fecha DESC";
    $stmt = $conexion->prepare($query);
    $stmt->setFetchMode(PDO::FETCH_CLASS, self::class);
    $stmt->execute(['usuario_id' => $usuario_id]);
    return $stmt->fetchAll();
  }

  public static function getDetalles(int $compra_id): array
  {
    $conexion = Conexion::getConexion();
    $query = "SELECT dc.*, j.nombre_apellido, j.imagen
              FROM detalle_compra dc
              JOIN jugadores j ON dc.jugador_id = j.id
              WHERE dc.compra_id = :compra_id";
    $stmt = $conexion->prepare($query);
    $stmt->execute(['compra_id' => $compra_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function getXId(int $id): ?Compra
  {
    $conexion = Conexion::getConexion();
    $query = "SELECT * FROM compras WHERE id = :id LIMIT 1";
    $stmt = $conexion->prepare($query);
    $stmt->setFetchMode(PDO::FETCH_CLASS, self::class);
    $stmt->execute(['id' => $id]);
    $result = $stmt->fetch();
    return $result ?: null;
  }
}
