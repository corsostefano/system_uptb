<?php
session_start();
include ('../../../app/config.php');

$id_rol = $_POST['id_rol'];


if (!isset($id_rol) || empty($id_rol)) {
    $_SESSION['message'] = "ID de rol no válido.";
    $_SESSION['icon'] = "error";
    header('Location: ' . APP_URL . "/admin/roles/");
    exit();
}


$judgment = $pdo->prepare("DELETE FROM roles WHERE id_rol = :id_rol");
$judgment->bindParam(':id_rol', $id_rol);

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


header('Location: ' . APP_URL . "/admin/roles/");
exit();
?>
