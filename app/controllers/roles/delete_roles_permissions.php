<?php
session_start();
include ('../../../app/config.php');

$id_rol_permission  = $_POST['id_rol_permission'];


if (!isset($id_rol_permission ) || empty($id_rol_permission )) {
    $_SESSION['message'] = "ID del permiso no válido.";
    $_SESSION['icon'] = "error";
    ?><script>window.history.back();</script><?php
    exit;
}


$judgment = $pdo->prepare("DELETE FROM roles_permissions WHERE id_rol_permission  = :id_rol_permission");
$judgment->bindParam(':id_rol_permission', $id_rol_permission);

try {

    if ($judgment->execute()) {
        $_SESSION['message'] = "Se eliminó correctamente.";
        $_SESSION['icon'] = "success";
        ?><script>window.history.back();</script><?php
          exit;
    } else {
      
        $_SESSION['message'] = "Error en Registro, comuníquese con el administrador";
        $_SESSION['icon'] = "error";
    }
} catch (PDOException $e) {
  
    $_SESSION['message'] = "Error no se puede eliminar ya que se encuentra asignado en otras tablas";
    $_SESSION['icon'] = "error";
}


?><script>window.history.back();</script><?php
          exit;
?>
