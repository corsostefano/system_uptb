<?php
include('../app/config.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['token'];
    $new_password = $_POST['new_password'];

    // Verificar si el token es válido y no ha expirado
    $sql = "SELECT * FROM users WHERE reset_token = :token AND reset_token_expiry > NOW()";
    $query = $pdo->prepare($sql);
    $query->bindParam(':token', $token);
    $query->execute();

    if ($query->rowCount() > 0) {
        // Obtener el usuario asociado al token
        $user = $query->fetch(PDO::FETCH_ASSOC);
        $userId = $user['id_user'];

        // Hash de la nueva contraseña
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Actualizar la contraseña y limpiar el token
        $update = $pdo->prepare("UPDATE users SET user_password = :password, reset_token = NULL, reset_token_expiry = NULL WHERE id_user = :id_user");
        $update->bindParam(':password', $hashed_password);
        $update->bindParam(':id_user', $userId);

        if ($update->execute()) {
            $_SESSION['message'] = "Contraseña restablecida con éxito. Puede iniciar sesión con su nueva contraseña.";
            $_SESSION['icon'] = "success";
            header('Location: ' . APP_URL . "/login");
            exit();
        } else {
            $_SESSION['message'] = "Error al restablecer la contraseña. Inténtelo de nuevo más tarde.";
            $_SESSION['icon'] = "error";
            header('Location: ' . APP_URL . "/reset_password.php?token=" . $token);
            exit();
        }
    } else {
        $_SESSION['message'] = "El enlace de restablecimiento de contraseña no es válido o ha expirado.";
        $_SESSION['icon'] = "error";
        header('Location: ' . APP_URL . "/login");
        exit();
    }
} else {
    // Redirigir si no es una solicitud POST
    header('Location: ' . APP_URL . "/login");
    exit();
}
?>
