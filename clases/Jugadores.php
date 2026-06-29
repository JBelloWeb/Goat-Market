<?php
require_once "Conexion.php";

class Jugadores
{
  private $id;
  private $nombre_apellido;
  private $descripcion;
  private $fecha_nacimiento;
  private $imagen;
  private $pais_id;
  private $pais_nombre;
  private $pais_color;
  private $pais_estrellas;

  public function getId(){
    return $this -> id;
  }

  public function getNombre(){
    return $this -> nombre_apellido;
  }

  public function getDescripcion(){
    return $this -> descripcion;
  }

  public function getFechaNacimiento(){
    return $this -> fecha_nacimiento;
  }

  public function getPrecio(){
    return $this -> precio;
  }

  public function getImagen(){
    return $this -> imagen;
  }
  
  public function getPais(){
    return $this -> pais_nombre ?? $this -> pais_id;
  }

  public function getPaisId(){
    return $this -> pais_id;
  }

  public function getPaisColor(){
    return $this -> pais_color;
  }

  public function getPaisEstrellas(){
    return $this -> pais_estrellas;
  }

  public function getEdad(): int {
    $nacimiento = new DateTime($this->fecha_nacimiento);
    $hoy = new DateTime();
    return (int) $nacimiento->diff($hoy)->y;
  }

  public function setId($id){
    $this -> id = $id;
  }

  public function setNombre($nombre_apellido){
    $this -> nombre_apellido = $nombre_apellido;  
  }

  public function setDescripcion($descripcion){
    $this -> descripcion = $descripcion;  
  }

  public function setFechaNacimiento($fecha_nacimiento){
    $this -> fecha_nacimiento = $fecha_nacimiento;  
  } 

  public function setPrecio($precio){
    $this -> precio = $precio;
  }

  public function setImagen($imagen){
    $this -> imagen = $imagen;  
  }

  public function setPais($pais_id){
    $this -> pais_id = $pais_id;
  }

  public static function todosLosJugadores():array{
    $conexion = (new Conexion()) -> getConexion();

    $query = "SELECT j.*, p.nombre AS pais_nombre, p.color AS pais_color, p.estrellas AS pais_estrellas FROM jugadores j JOIN paises p ON j.pais_id = p.id";

    $PDOStatement = $conexion -> prepare($query);
    $PDOStatement -> setFetchMode(PDO::FETCH_CLASS, self::class);
    $PDOStatement -> execute();
    
    $lista = $PDOStatement -> fetchAll();

    return $lista;
  }

  public static function todosLosPaises():array
  {
    $conexion = (new Conexion()) -> getConexion();
    $query = "SELECT nombre FROM paises ORDER BY nombre";
    $PDOStatement = $conexion -> prepare($query);
    $PDOStatement -> execute();
    return $PDOStatement -> fetchAll(PDO::FETCH_COLUMN);
  }

  public static function jugadores_x_pais(string $pais):array
  {
    $conexion = (new Conexion()) -> getConexion();
    $query = "SELECT j.*, p.nombre AS pais_nombre, p.color AS pais_color, p.estrellas AS pais_estrellas FROM jugadores j
              JOIN paises p ON j.pais_id = p.id
              WHERE p.nombre = :pais";
    $PDOStatement = $conexion -> prepare($query);
    $PDOStatement -> setFetchMode(PDO::FETCH_CLASS, self::class);
    $PDOStatement -> execute(['pais' => $pais]);
    return $PDOStatement -> fetchAll();
  }

  public static function jugadores_x_precio(string $orden = 'asc'): array
  {
    $jugadores = self::todosLosJugadores();

    usort($jugadores, function($a, $b) use ($orden) {
      if($orden === 'desc') {return $b -> getPrecio() <=> $a -> getPrecio();} else {return $a -> getPrecio() <=> $b -> getPrecio();}
    });

    return $jugadores;
  }

  public static function insert(string $nombre, string $descripcion, float $precio, string $fecha_nacimiento, string $imagen, int $pais_id){
    $conexion = (new Conexion()) -> getConexion();
    $query = "INSERT INTO jugadores (`nombre_apellido`, `descripcion`, `precio`, `fecha_nacimiento`, `imagen`, `pais_id`) VALUES (:nombre, :descripcion, :precio, :fecha_nacimiento, :imagen, :pais_id)";

    $PDOStatement = $conexion -> prepare($query);
    $PDOStatement -> execute([
      'nombre' => $nombre,
      'descripcion' => $descripcion,
      'precio' => $precio,
      'fecha_nacimiento' => $fecha_nacimiento,
      'imagen' => $imagen,
      'pais_id' => $pais_id
    ]);

    return $conexion->lastInsertId();
  }

  public static function get_x_id(int $id): ?Jugadores
  {
    $conexion = (new Conexion()) -> getConexion();

    $query = "SELECT j.*, p.nombre AS pais_nombre, p.color AS pais_color, p.estrellas AS pais_estrellas FROM jugadores j JOIN paises p ON j.pais_id = p.id WHERE j.id = :id LIMIT 1";

    $PDOStatement = $conexion -> prepare($query);
    $PDOStatement -> setFetchMode(PDO::FETCH_CLASS, self::class);
    $PDOStatement -> execute(["id" => $id]);

    $lista = $PDOStatement -> fetch();

    return !empty($lista) ? $lista : null;
  }

  public function edit($nombre, $descripcion, $precio, $fecha_nacimiento, $imagen, $pais_id)
  {
    $conexion = (new Conexion()) -> getConexion();
    $query = "UPDATE jugadores SET nombre_apellido = :nombre, descripcion = :descripcion, precio = :precio, fecha_nacimiento = :fecha_nacimiento, imagen = :imagen, pais_id = :pais_id 
    WHERE id = :id_jugador";

    $PDOStatement = $conexion -> prepare($query);
    $PDOStatement -> execute([
      "nombre" => $nombre,
      "descripcion" => $descripcion,
      "precio" => $precio,
      "fecha_nacimiento" => $fecha_nacimiento,
      "imagen" => $imagen,
      "pais_id" => $pais_id,
      "id_jugador" => $this ->  id
    ]);
  }

  public function delete()
  {
    $conexion = (new Conexion()) -> getConexion();
    $query = "DELETE FROM jugadores WHERE id = :id";
    $PDOStatement = $conexion -> prepare($query);
    $PDOStatement -> execute([
      "id" => $this -> id
    ]);
  }
}
?>