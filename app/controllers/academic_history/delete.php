<?php
session_start();
include('../../config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $report_id = filter_input(INPUT_POST, 'report_id', FILTER_SANITIZE_NUMBER_INT);

    if ($report_id) {
        $sql = "DELETE FROM academic_history WHERE id_academic_history = :id_academic_history";
        $query = $pdo->prepare($sql);
        $query->bindParam(':id_academic_history', $report_id, PDO::PARAM_INT);

        try {
            if ($query->execute()) {
                $_SESSION['message'] = 'Reporte eliminado exitosamente.';
                $_SESSION['icon'] = "success";
            } else {
                $_SESSION['message'] = "Error al eliminar el reporte.";
                $_SESSION['icon'] = "error";
            }
        } catch (PDOException $e) {
            $_SESSION['message'] = "Ocurrió un error al eliminar el reporte: " . $e->getMessage();
            $_SESSION['icon'] = "error";
        }
    } else {
        $_SESSION['message'] = "ID de reporte inválido.";
        $_SESSION['icon'] = "error";
    }

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
} else {
    $_SESSION['message'] = "Método no permitido.";
    $_SESSION['icon'] = "warning";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}
?>
