<?php
session_start();
include ('../../../app/config.php');

$id_user = $_POST['id_user'];

if (!isset($id_user) || empty($id_user)) {
    $_SESSION['message'] = "ID de usuario no válido.";
    $_SESSION['icon'] = "error";
    header('Location: ' . APP_URL . "/admin/administrative/");
    exit();
}

// Iniciar una transacción
$pdo->beginTransaction();

try {
    // Eliminar el registro en la tabla 'administrative'
    $judgment = $pdo->prepare("DELETE FROM administrative WHERE user_id = :id_user");
    $judgment->bindParam(':id_user', $id_user);
    $judgment->execute();

    // Obtener la URL de la imagen de perfil del usuario
    $judgment = $pdo->prepare("SELECT profile_picture FROM users WHERE id_user = :id_user");
    $judgment->bindParam(':id_user', $id_user);
    $judgment->execute();
    $user = $judgment->fetch(PDO::FETCH_ASSOC);

    // Verificar si el usuario tiene una imagen de perfil y eliminarla
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
    $judgment->execute();

    // Si todo va bien, se confirma la transacción
    $pdo->commit();

    $_SESSION['message'] = "Se eliminó correctamente.";
    $_SESSION['icon'] = "success";

} catch (PDOException $e) {
    // Si ocurre algún error, revertimos la transacción
    $pdo->rollBack();

    $_SESSION['message'] = "Error en la base de datos: " . $e->getMessage();
    $_SESSION['icon'] = "error";
}

header('Location: ' . APP_URL . "/admin/administrative/");
exit();
?>
