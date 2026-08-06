<?php
require_once "Conexion.php";

class Usuario
{
  private $id;
  private $nombre;
  private $email;
  private $contraseña;
  private $es_administrador;

  public function getId(){
    return $this -> id;
  }

  public function getNombre(){
    return $this -> nombre;
  }

  public function getEmail(){
    return $this -> email;
  }

  public function getEsAdministrador(){
    return $this -> es_administrador;
  }

  public function setId($id){
    $this -> id = $id;
  }

  public function setNombre($nombre){
    $this -> nombre = $nombre;
  }

  public function setEmail($email){
    $this -> email = $email;
  }

  public function setContraseña($contraseña){
    $this -> contraseña = $contraseña;
  }

  public function setEsAdministrador($es_administrador){
    $this -> es_administrador = $es_administrador;
  }

  public static function get_x_id(int $id): ?Usuario
  {
    $conexion = Conexion::getConexion();

    $query = "SELECT * FROM usuarios WHERE id = :id LIMIT 1";

    $PDOStatement = $conexion -> prepare($query);
    $PDOStatement -> setFetchMode(PDO::FETCH_CLASS, self::class);
    $PDOStatement -> execute(["id" => $id]);

    $lista = $PDOStatement -> fetch();

    return !empty($lista) ? $lista : null;
  }

  public static function login(string $nombre, string $contraseña): ?Usuario
  {
    $conexion = Conexion::getConexion();

    $query = "SELECT * FROM usuarios WHERE nombre = :nombre LIMIT 1";

    $PDOStatement = $conexion -> prepare($query);
    $PDOStatement -> setFetchMode(PDO::FETCH_CLASS, self::class);
    $PDOStatement -> execute(["nombre" => $nombre]);

    $usuario = $PDOStatement -> fetch();

    if(empty($usuario) || !password_verify($contraseña, $usuario -> contraseña)){
      return null;
    }

    return $usuario;
  }

  public static function insert(string $nombre, string $email, string $contraseña, int $es_administrador){
    $conexion = Conexion::getConexion();

    $hash = password_hash($contraseña, PASSWORD_DEFAULT);

    $query = "INSERT INTO usuarios (`nombre`, `email`, `contraseña`, `es_administrador`) VALUES (:nombre, :email, :contraseña, :es_administrador)";

    $PDOStatement = $conexion -> prepare($query);
    $PDOStatement -> execute([
      'nombre' => $nombre,
      'email' => $email,
      'contraseña' => $hash,
      'es_administrador' => $es_administrador
    ]);
  }
}
