<?php
require_once "Conexion.php";

class Equipo
{
    public static function getPorUsuario(int $usuario_id): ?array
    {
        $conexion = Conexion::getConexion();

        $query = "SELECT id, formacion FROM equipos_guardados WHERE usuario_id = :uid LIMIT 1";
        $stmt = $conexion->prepare($query);
        $stmt->execute(['uid' => $usuario_id]);
        $equipo = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$equipo) return null;

        $query = "SELECT ej.slot_index, ej.jugador_id, j.nombre_apellido, j.imagen
                  FROM equipo_jugadores ej
                  JOIN jugadores j ON ej.jugador_id = j.id
                  WHERE ej.equipo_id = :eid
                  ORDER BY ej.slot_index";
        $stmt = $conexion->prepare($query);
        $stmt->execute(['eid' => $equipo['id']]);
        $jugadores = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $map = [];
        foreach ($jugadores as $j) {
            $map[(int) $j['slot_index']] = [
                'id' => (int) $j['jugador_id'],
                'nombre_apellido' => $j['nombre_apellido'],
                'imagen' => $j['imagen'],
            ];
        }

        return [
            'id' => (int) $equipo['id'],
            'formacion' => $equipo['formacion'],
            'jugadores' => $map,
        ];
    }

    public static function guardar(int $usuario_id, string $formacion, array $slots): void
    {
        $conexion = Conexion::getConexion();
        $conexion->beginTransaction();

        try {
            $query = "INSERT INTO equipos_guardados (usuario_id, formacion)
                      VALUES (:uid, :formacion)
                      ON DUPLICATE KEY UPDATE formacion = :formacion2, fecha_guardado = NOW()";
            $stmt = $conexion->prepare($query);
            $stmt->execute([
                'uid' => $usuario_id,
                'formacion' => $formacion,
                'formacion2' => $formacion,
            ]);

            $equipo_id = $conexion->lastInsertId();
            if ($equipo_id === 0) {
                $stmt = $conexion->prepare("SELECT id FROM equipos_guardados WHERE usuario_id = :uid LIMIT 1");
                $stmt->execute(['uid' => $usuario_id]);
                $equipo_id = (int) $stmt->fetchColumn();
            }

            $stmt = $conexion->prepare("DELETE FROM equipo_jugadores WHERE equipo_id = :eid");
            $stmt->execute(['eid' => $equipo_id]);

            if (!empty($slots)) {
                $query = "INSERT INTO equipo_jugadores (equipo_id, slot_index, jugador_id)
                          VALUES (:eid, :slot, :jugador)";
                $stmt = $conexion->prepare($query);
                foreach ($slots as $s) {
                    $stmt->execute([
                        'eid' => $equipo_id,
                        'slot' => (int) $s['slot'],
                        'jugador' => (int) $s['jugador'],
                    ]);
                }
            }

            $conexion->commit();
        } catch (Exception $e) {
            $conexion->rollBack();
            throw $e;
        }
    }

    public static function eliminar(int $usuario_id): void
    {
        $conexion = Conexion::getConexion();
        $query = "DELETE FROM equipos_guardados WHERE usuario_id = :uid";
        $stmt = $conexion->prepare($query);
        $stmt->execute(['uid' => $usuario_id]);
    }
}
