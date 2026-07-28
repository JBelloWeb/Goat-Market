<?php
session_start();
require_once __DIR__ . "/../clases/Equipo.php";

if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../?sec=login');
    exit;
}

$formacion = $_POST['formacion'] ?? '4-3-3';
$slots_raw = $_POST['slots'] ?? '[]';
$slots = json_decode($slots_raw, true);

if (!is_array($slots)) {
    $slots = [];
}

// Normalize: only keep entries with valid jugador
$slots = array_filter($slots, fn($s) => isset($s['slot'], $s['jugador']) && $s['jugador'] > 0);
$slots = array_values($slots);

try {
    Equipo::guardar((int) $_SESSION['usuario_id'], $formacion, $slots);
    header('Location: ../?sec=editar-equipo&ok=1');
} catch (Exception $e) {
    header('Location: ../?sec=editar-equipo&error=1');
}
