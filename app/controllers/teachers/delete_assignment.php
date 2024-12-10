<?php
include('../../../app/config.php');

session_start();

if (isset($_POST['id_assignment']) && filter_var($_POST['id_assignment'], FILTER_VALIDATE_INT)) {
    $id_assignment = $_POST['id_assignment'];

    // Prepara la consulta SQL
    $judgment = $pdo->prepare("DELETE FROM assignment WHERE id_assignment = :id_assignment");
    $judgment->bindParam(':id_assignment', $id_assignment, PDO::PARAM_INT);

    try {
        if ($judgment->execute()) {
            $_SESSION['message'] = "Se eliminó la asignación de la base de datos de forma correcta";
            $_SESSION['icon'] = "success";
        } else {
            $_SESSION['message'] = "Error al eliminar la asignación de la base de datos";
            $_SESSION['icon'] = "error";
        }
    } catch (PDOException $e) {
        $_SESSION['message'] = "Error: " . $e->getMessage();
        $_SESSION['icon'] = "error";
    }

    header('Location: ' . APP_URL . "/admin/teachers/assignment.php");
    exit();
} else {
    $_SESSION['message'] = "ID de asignación no válido o no proporcionado";
    $_SESSION['icon'] = "error";
    header('Location: ' . APP_URL . "/admin/teachers/assignment.php");
    exit();
}
?>
