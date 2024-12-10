<?php
session_start();
include('../../../../app/config.php');

$id_management = $_POST['id_management'];


if (!isset($id_management) || empty($id_management)) {
    $_SESSION['message'] = "ID de rol no válido.";
    $_SESSION['icon'] = "error";
    header('Location: ' . APP_URL . "/admin/settings");
    exit();
}


$judgment = $pdo->prepare("DELETE FROM managements WHERE id_management = :id_management");
$judgment->bindParam(':id_management', $id_management);

try {

    if ($judgment->execute()) {
        $_SESSION['message'] = "Se eliminó correctamente.";
        $_SESSION['icon'] = "success";
    } else {
      
        $_SESSION['message'] = "Error en Registro, comuníquese con el administrador";
        $_SESSION['icon'] = "error";
    }
} catch (PDOException $e) {
  
    $_SESSION['message'] = "Error no se puede eliminar ya que se encuentra asignado en otras tablas";
    $_SESSION['icon'] = "error";
}


header('Location: ' . APP_URL . "/admin/settings/management/");
exit();
?>
