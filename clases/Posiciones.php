<?php
require_once "Conexion.php";

class Posiciones
{
    public static function todas(): array
    {
        $conexion = Conexion::getConexion();
        $query = "SELECT posicion FROM posiciones WHERE posicion != 'global' ORDER BY posicion";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute();
        return $PDOStatement->fetchAll(PDO::FETCH_COLUMN);
    }

    public static function jugadores_x_posicion(string $posicion): array
    {
        $conexion = Conexion::getConexion();
        $query = "SELECT DISTINCT j.*, p.nombre AS pais_nombre, p.color AS pais_color FROM jugadores j
                  JOIN paises p ON j.pais_id = p.id
                  JOIN posicion_x_jugador pxj ON j.id = pxj.jugador_id
                  JOIN posiciones pos ON pxj.posicion_id = pos.id
                  WHERE pos.posicion = :posicion";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, 'Jugadores');
        $PDOStatement->execute(['posicion' => $posicion]);
        return $PDOStatement->fetchAll();
    }

    public static function getPosicionesPorJugador(int $jugador_id): array
    {
        $conexion = Conexion::getConexion();
        $query = "SELECT pos.posicion FROM posicion_x_jugador pxj
                  JOIN posiciones pos ON pxj.posicion_id = pos.id
                  WHERE pxj.jugador_id = :jugador_id
                  ORDER BY pos.posicion";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute(['jugador_id' => $jugador_id]);
        return $PDOStatement->fetchAll(PDO::FETCH_COLUMN);
    }

    public static function todasConId(): array
    {
        $conexion = Conexion::getConexion();
        $query = "SELECT id, posicion FROM posiciones WHERE posicion != 'global' ORDER BY posicion";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute();
        return $PDOStatement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function guardarPosicionesJugador(int $jugador_id, array $posiciones_ids): void
    {
        $conexion = Conexion::getConexion();

        $query = "DELETE FROM posicion_x_jugador WHERE jugador_id = :jugador_id";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute(['jugador_id' => $jugador_id]);

        if (!empty($posiciones_ids)) {
            $query = "INSERT INTO posicion_x_jugador (posicion_id, jugador_id) VALUES (:posicion_id, :jugador_id)";
            $PDOStatement = $conexion->prepare($query);
            foreach ($posiciones_ids as $posicion_id) {
                $PDOStatement->execute([
                    'posicion_id' => (int) $posicion_id,
                    'jugador_id' => $jugador_id
                ]);
            }
        }
    }
}
