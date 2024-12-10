<?php
include('../../config.php');

$name_url  = $_POST['name_url'] ?? '';
$url  = $_POST['url'] ?? '';
$id_permission = $_POST['id_permission'] ?? '';

// Verificar si los campos están vacíos
if (empty($name_url) || empty($url)) {
    session_start();
    $_SESSION['message'] = "Error en Registro: campos vacíos.";
    $_SESSION['icon'] = "error";
    header('Location: ' . APP_URL . "/admin/roles/permissions.php");
    exit();
}



// Preparar la sentencia SQL
$judgment = $pdo->prepare("
    UPDATE permissions
    SET name_url = :name_url, 
        url = :url, 
        fyh_update = :fyh_update 
    WHERE id_permission = :id_permission
");

// Enlazar parámetros
$judgment->bindParam(':name_url', $name_url);
$judgment->bindParam(':url', $url);
$judgment->bindParam(':fyh_update', $fyh_update);
$judgment->bindParam(':id_permission', $id_permission);

try {
    // Ejecutar la consulta
    if ($judgment->execute()) {
        session_start();
        $_SESSION['message'] = "Registro actualizado exitosamente.";
        $_SESSION['icon'] = "success";
    } else {
        session_start();
        $_SESSION['message'] = "Error al actualizar el registro.";
        $_SESSION['icon'] = "error";
    }
} catch (Exception $exception) {
    session_start();
    $_SESSION['message'] = "Error: " . $exception->getMessage();
    $_SESSION['icon'] = "error";
}

// Redirigir
header('Location: ' . APP_URL . "/admin/roles/permissions.php");
exit();
?>
