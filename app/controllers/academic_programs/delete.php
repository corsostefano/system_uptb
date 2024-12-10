<?php
session_start();
include ('../../config.php');

$id_academic_programs = $_POST['id_academic_programs'];


if (!isset($id_academic_programs) || empty($id_academic_programs)) {
    $_SESSION['message'] = "ID de rol no válido.";
    $_SESSION['icon'] = "error";
    header('Location: ' . APP_URL . "/admin/academic_programs/");
    exit();
}


$judgment = $pdo->prepare("DELETE FROM academic_programs WHERE id_academic_programs = :id_academic_programs");
$judgment->bindParam(':id_academic_programs', $id_academic_programs);

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


header('Location: ' . APP_URL . "/admin/academic_programs/");
exit();
?>
