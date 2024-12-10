<?php 
include('../../../../app/config.php');

$id_management = $_POST['id_management'];
$management = $_POST['management'];
$management = mb_strtoupper($management, 'UTF-8'); // Convierte a mayúsculas
$management_state = $_POST['management_state'];

// Convertir el estado a valores numéricos
$management_state = ($management_state == "ACTIVO") ? 1 : 0;

if ($management == "") {
    session_start();
    $_SESSION['message'] = "Error en actualización, campo vacío";
    $_SESSION['icon'] = "error";
    header('Location: ' . APP_URL . "/admin/management/edit.php");
    exit(); 
} else {
    // Actualización de la sentencia SQL
    $judgment = $pdo->prepare("UPDATE managements SET management = :management, fyh_update = :fyh_update, management_state = :management_state WHERE id_management = :id_management");
    
    // Obtener la fecha y hora actual para `fyh_update`
    $fyh_update = date("Y-m-d H:i:s");

    $judgment->bindParam(':management', $management);
    $judgment->bindParam(':fyh_update', $fyh_update);
    $judgment->bindParam(':management_state', $management_state);
    $judgment->bindParam(':id_management', $id_management, PDO::PARAM_INT);

    try {
        if ($judgment->execute()) {
            session_start();
            $_SESSION['message'] = "Actualización Exitosa.";
            $_SESSION['icon'] = "success";
            header('Location: ' . APP_URL . "/admin/settings/management");
            exit(); 
        } else {
            session_start();
            $_SESSION['message'] = "Error en actualización, comuníquese con el administrador";
            $_SESSION['icon'] = "error";
            header('Location: ' . APP_URL . "/admin/management/edit.php");
            exit(); 
        }
    } catch (Exception $exception) {
        session_start();
        $_SESSION['message'] = "Este rol ya se encuentra registrado";
        $_SESSION['icon'] = "error";
        header('Location: ' . APP_URL . "/admin/management/edit.php");
        exit(); 
    }
}
?>
