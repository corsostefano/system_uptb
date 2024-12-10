<?php
session_start();
include ('../../../app/config.php');

$id_permission  = $_POST['id_permission'];


if (!isset($id_permission ) || empty($id_permission )) {
    $_SESSION['message'] = "ID del permiso no válido.";
    $_SESSION['icon'] = "error";
    header('Location: ' . APP_URL . "/admin/roles/permissions.php");
    exit();
}


$judgment = $pdo->prepare("DELETE FROM permissions WHERE id_permission  = :id_permission");
$judgment->bindParam(':id_permission', $id_permission );

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


header('Location: ' . APP_URL . "/admin/roles/permissions.php");
exit();
?>
