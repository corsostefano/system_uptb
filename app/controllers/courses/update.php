<?php 
include('../../config.php');
session_start();

$id_courses = $_POST['id_courses'];
$name_course  = $_POST['name_course'];
$name_course  = mb_strtoupper($name_course, 'UTF-8'); // convierte a mayúscula
$course_state = $_POST['course_state'];

// Convertimos el estado a un valor numérico
$course_state = ($course_state == "ACTIVO") ? 1 : 0;

// Verificamos si el nombre del curso está vacío
if ($name_course == "") {
    $_SESSION['message'] = "Error en Actualización, campo vacío";
    $_SESSION['icon'] = "error";
    header('Location: ' . APP_URL . "/admin/courses/create.php");
    exit(); 
} else {
    // Usar la fecha y hora de creación como fecha de actualización
    $fyh_update = $fyh_creation;

    // Preparar la sentencia SQL
    $judgment = $pdo->prepare("UPDATE courses SET name_course = :name_course, course_state = :course_state, fyh_update = :fyh_update WHERE id_courses = :id_courses");

    // Enlazar parámetros
    $judgment->bindParam(':name_course', $name_course);
    $judgment->bindParam(':fyh_update', $fyh_update);
    $judgment->bindParam(':course_state', $course_state);
    $judgment->bindParam(':id_courses', $id_courses, PDO::PARAM_INT);

    try {
        // Ejecutar la sentencia
        if ($judgment->execute()) {
            $_SESSION['message'] = "Actualización exitosa.";
            $_SESSION['icon'] = "success";
            header('Location: ' . APP_URL . "/admin/courses/");
            exit(); 
        } else {
            $_SESSION['message'] = "Error en Actualización, comuníquese con el administrador";
            $_SESSION['icon'] = "error";
            header('Location: ' . APP_URL . "/admin/courses/create.php");
            exit(); 
        }
    } catch (Exception $exception) {
        $_SESSION['message'] = "Error al actualizar";
        $_SESSION['icon'] = "error";
        header('Location: ' . APP_URL . "/admin/courses/create.php");
        exit(); 
    }
}
?>
