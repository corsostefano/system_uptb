<?php
session_start();
include ('../../../config.php');

// Verificamos si se ha enviado el ID a través de POST
$id_config_institution = isset($_POST['id_config_institution']) ? $_POST['id_config_institution'] : null;

if (empty($id_config_institution)) {
    $_SESSION['message'] = "ID de la institución no es válido.";
    $_SESSION['icon'] = "error";
    header('Location: ' . APP_URL . "/admin/settings/institution");
    exit();
}

// Preparamos la consulta para eliminar la configuración de la institución
$judgment = $pdo->prepare("DELETE FROM institutions_configuration WHERE id_config_institution = :id_config_institution");
$judgment->bindParam(':id_config_institution', $id_config_institution, PDO::PARAM_INT); // Aseguramos que sea un entero

try {
    // Ejecutamos la consulta
    if ($judgment->execute()) {
        if ($judgment->rowCount() > 0) { // Verificamos si se eliminó alguna fila
            $_SESSION['message'] = "Se eliminó correctamente.";
            $_SESSION['icon'] = "success";
        } else {
            $_SESSION['message'] = "No se encontró ninguna institución con ese ID.";
            $_SESSION['icon'] = "warning"; // Cambié a "warning" por si no se elimina ninguna fila
        }
    } else {
        $_SESSION['message'] = "Error en Registro, comuníquese con el administrador.";
        $_SESSION['icon'] = "error";
    }
} catch (PDOException $e) {
    $_SESSION['message'] = "Error en la base de datos: " . $e->getMessage();
    $_SESSION['icon'] = "error";
}

// Redirigimos después de la operación
header('Location: ' . APP_URL . "/admin/settings/institution");
exit();
?>
