<?php
require_once "Conexion.php";

class Pais
{
  private $id;
  private $nombre;
  private $estrellas;
  private $color;

  public function getId(){
    return $this -> id;
  }

  public function getNombre(){
    return $this -> nombre;
  }

  public function getEstrellas(){
    return $this -> estrellas;
  }

  public function getColor(){
    return $this -> color;
  }

  public function setId($id){
    $this -> id = $id;
  }

  public function setNombre($nombre){
    $this -> nombre = $nombre;
  }

  public function setEstrellas($estrellas){
    $this -> estrellas = $estrellas;
  }

  public function setColor($color){
    $this -> color = $color;
  }

  public static function get_x_id(int $id): ?Pais
  {
    $conexion = Conexion::getConexion();

    $query = "SELECT * FROM paises WHERE id = :id LIMIT 1";

    $PDOStatement = $conexion -> prepare($query);
    $PDOStatement -> setFetchMode(PDO::FETCH_CLASS, self::class);
    $PDOStatement -> execute(["id" => $id]);

    $lista = $PDOStatement -> fetch();

    return !empty($lista) ? $lista : null;
  }

  public static function todos():array
  {
    $conexion = Conexion::getConexion();

    $query = "SELECT * FROM paises ORDER BY nombre ASC";

    $PDOStatement = $conexion -> prepare($query);
    $PDOStatement -> setFetchMode(PDO::FETCH_CLASS, self::class);
    $PDOStatement -> execute();

    return $PDOStatement -> fetchAll();
  }

  public static function insert(string $nombre, int $estrellas, string $color){
    $conexion = Conexion::getConexion();

    $query = "INSERT INTO paises (`nombre`, `estrellas`, `color`) VALUES (:nombre, :estrellas, :color)";

    $PDOStatement = $conexion -> prepare($query);
    $PDOStatement -> execute([
      'nombre' => $nombre,
      'estrellas' => $estrellas,
      'color' => $color
    ]);
  }

  public function edit(string $nombre, int $estrellas, string $color){
    $conexion = Conexion::getConexion();

    $query = "UPDATE paises SET nombre = :nombre, estrellas = :estrellas, color = :color WHERE id = :id";

    $PDOStatement = $conexion -> prepare($query);
    $PDOStatement -> execute([
      'nombre' => $nombre,
      'estrellas' => $estrellas,
      'color' => $color,
      'id' => $this -> id
    ]);
  }

  public function delete(){
    $conexion = Conexion::getConexion();

    $query = "DELETE FROM paises WHERE id = :id";

    $PDOStatement = $conexion -> prepare($query);
    $PDOStatement -> execute([
      'id' => $this -> id
    ]);
  }
}
