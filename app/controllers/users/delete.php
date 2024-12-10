<?php
session_start();
include ('../../../app/config.php');

$id_user = $_POST['id_user'];

if (!isset($id_user) || empty($id_user)) {
    $_SESSION['message'] = "ID de usuario no válido.";
    $_SESSION['icon'] = "error";
    header('Location: ' . APP_URL . "/admin/users/");
    exit();
}

// Obtener la URL de la imagen de perfil del usuario
$judgment = $pdo->prepare("SELECT profile_picture FROM users WHERE id_user = :id_user");
$judgment->bindParam(':id_user', $id_user);
$judgment->execute();
$user = $judgment->fetch(PDO::FETCH_ASSOC);

// Verificar si el usuario tiene una imagen de perfil
if ($user && !empty($user['profile_picture'])) {
    $profile_picture_path = __DIR__ . '/../../../' . $user['profile_picture'];

    // Verificar si la imagen existe y eliminarla
    if (file_exists($profile_picture_path)) {
        unlink($profile_picture_path);
    }
}

// Eliminar el usuario de la base de datos
$judgment = $pdo->prepare("DELETE FROM users WHERE id_user = :id_user");
$judgment->bindParam(':id_user', $id_user);

try {
    if ($judgment->execute()) {
        $_SESSION['message'] = "Se eliminó correctamente.";
        $_SESSION['icon'] = "success";
    } else {
        $_SESSION['message'] = "Error en Registro, comuníquese con el administrador";
        $_SESSION['icon'] = "error";
    }
} catch (PDOException $e) {
    $_SESSION['message'] = "Error en la base de datos: el usuario se encuentra relacionado a otra tabla SQL";
    $_SESSION['icon'] = "error";
}

header('Location: ' . APP_URL . "/admin/users/");
exit();
?>
