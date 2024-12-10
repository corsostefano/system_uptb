<?php
session_start();
include ('../../config.php');

$id_courses = $_POST['id_courses'];


if (!isset($id_courses) || empty($id_courses)) {
    $_SESSION['message'] = "ID de la materia no válido.";
    $_SESSION['icon'] = "error";
    header('Location: ' . APP_URL . "/admin/courses/");
    exit();
}


$judgment = $pdo->prepare("DELETE FROM courses WHERE id_courses = :id_courses");
$judgment->bindParam(':id_courses', $id_courses);

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


header('Location: ' . APP_URL . "/admin/courses/");
exit();
?>
