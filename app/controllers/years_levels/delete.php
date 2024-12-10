<?php
session_start();
include ('../../config.php');

$id_levels = $_POST['id_levels'];

// Verificar que $id_levels esté definido, no esté vacío y sea un número
if (!isset($id_levels) || !is_numeric($id_levels)) {
    $_SESSION['message'] = "ID de rol no válido.";
    $_SESSION['icon'] = "error";
    header('Location: ' . APP_URL . "/admin/years_levels/");
    exit();
}

$judgment = $pdo->prepare("DELETE FROM levels WHERE id_levels = :id_levels");
$judgment->bindParam(':id_levels', $id_levels, PDO::PARAM_INT);

try {
    if ($judgment->execute()) {
        $_SESSION['message'] = "Se eliminó correctamente.";
        $_SESSION['icon'] = "success";
    } else {
        $_SESSION['message'] = "Error en Registro, comuníquese con el administrador";
        $_SESSION['icon'] = "error";
    }
} catch (PDOException $e) {
    // Registrar el error para depuración si es necesario
    error_log("Error al eliminar el nivel: " . $e->getMessage());

    $_SESSION['message'] = "No se puede eliminar ya que se encuentra asignado en otras tablas.";
    $_SESSION['icon'] = "error";
}

// Redirigir al usuario al final del bloque try/catch
header('Location: ' . APP_URL . "/admin/years_levels/");
exit();
?>
