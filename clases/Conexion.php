<?php 
class Conexion
{
    private const DB_SERVER = "localhost";
    private const DB_USER = "root";
    private const DB_PASS = "";
    private const DB_NAME = "goat_market";
    private const DB_CHARSET = "utf8mb4";

    private const DB_DSN = "mysql:host=" . self::DB_SERVER . ";dbname=" . self::DB_NAME . ";charset=" . self::DB_CHARSET;

    private static ?PDO $db = null;

    public static function getConexion(): PDO
    {
        if (self::$db === null) {
            try {
                self::$db = new PDO(self::DB_DSN, self::DB_USER, self::DB_PASS);
                self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (Exception $e) {
                die('Error al conectar con MySQL.');
            }
        }
        return self::$db;
    }
}
?>
