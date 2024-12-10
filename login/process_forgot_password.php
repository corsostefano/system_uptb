<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
include('../app/config.php');
include('../layout/messages.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener el correo y generar un token único
    $email = $_POST['email'];
    $token = bin2hex(random_bytes(50)); // Generar un token único

    // Verificar si el usuario existe
    $sql = "SELECT * FROM users WHERE email = :email AND user_state = 1";
    $query = $pdo->prepare($sql);
    $query->bindParam(':email', $email);
    $query->execute();

    if ($query->rowCount() > 0) {
        // Guardar el token en la base de datos
        $update = $pdo->prepare("UPDATE users SET reset_token = :token, reset_token_expiry = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE email = :email");
        $update->bindParam(':token', $token);
        $update->bindParam(':email', $email);

        if ($update->execute()) {
            // Enlace de recuperación
            $reset_link = APP_URL . "/login/reset_password.php?token=" . $token;

            // Configuración del correo usando PHPMailer
            $mail = new PHPMailer(true);

            try {
                // Configuración del servidor SMTP
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; // Servidor SMTP de Gmail
                $mail->SMTPAuth = true;
                $mail->Username = 'sistemauptb@gmail.com'; // Tu correo de Gmail
                $mail->Password = TOKEN_APP_GMAIL; // Asegúrate de usar una contraseña de aplicación
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                // Configuración del correo
                $mail->setFrom('sistemauptb@gmail.com', 'Soporte');
                $mail->addAddress($email);
                $mail->isHTML(true);
                $mail->CharSet = 'UTF-8'; // Establecer la codificación a UTF-8
                $mail->Subject = 'Recuperación de Contraseña';
                $mail->Body = "
                    <html>
                        <body>
                            <h2>¡Hola!</h2>
                            <p>Hemos recibido una solicitud para restablecer la <strong>contraseña</strong> de su cuenta en el sistema de gestión de la Universidad Politécnica Territorial del Estado Barinas 'José Félix Ribas'.</p>
                            <p>Si usted no realizó esta solicitud, puede ignorar este correo. Sin embargo, si desea restablecer su <strong>contraseña</strong>, haga clic en el siguiente enlace:</p>
                            <p><a href='$reset_link'>$reset_link</a></p>
                            <p>Recuerde que este enlace expirará en 1 hora.</p>
                            <p>¡Saludos cordiales!</p>
                            <p>Equipo de Soporte<br>Universidad Politécnica Territorial del Estado Barinas 'José Félix Ribas'</p>
                        </body>
                    </html>
                ";

                // Enviar correo
                $mail->send();
                $_SESSION['message'] = "Enlace de recuperación enviado. Verifique su correo.";
                $_SESSION['icon'] = "success";
                header('Location: ' . APP_URL . "/login");
                exit();
            } catch (Exception $e) {
                $_SESSION['message'] = "Error al enviar el correo: " . htmlspecialchars($e->getMessage());
                $_SESSION['icon'] = "error";
                header('Location: ' . APP_URL . "/login");
                exit();
            }
        } else {
            $_SESSION['message'] = "Error al actualizar el token. Inténtelo de nuevo más tarde.";
            $_SESSION['icon'] = "error";
            header('Location: ' . APP_URL . "/login");
            exit();
        }
    } else {
        $_SESSION['message'] = "Correo no registrado.";
        $_SESSION['icon'] = "error";
        header("Location: " . APP_URL . "/login");
        exit();
    }
}
?> 