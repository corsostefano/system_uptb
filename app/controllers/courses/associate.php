<?php
include('../../config.php');

$course_id = $_POST['course_id'];
$level_id = $_POST['level_id'];
$level_courses_state = $_POST['level_courses_state'];

// Convertimos el estado a un valor numérico
$level_courses_state = ($level_courses_state == "ACTIVO") ? 1 : 0;


// Verificar si los campos están vacíos
if (empty($course_id) || empty($level_id) || empty($level_courses_state)) {
    session_start();
    $_SESSION['message'] = "Error: Todos los campos son obligatorios";
    $_SESSION['icon'] = "error";
    header('Location: ' . APP_URL . "/admin/courses/create_association.php");
    exit();
}

// Insertar la relación en la tabla level_courses
$sql = "INSERT INTO level_courses (course_id, level_id, fyh_creation, level_courses_state) 
        VALUES (:course_id, :level_id, :fyh_creation, :level_courses_state)";

$query = $pdo->prepare($sql);
$query->bindParam(':course_id', $course_id);
$query->bindParam(':level_id', $level_id);
$query->bindParam(':fyh_creation', $fyh_creation);
$query->bindParam(':level_courses_state', $level_courses_state);

try {
    if ($query->execute()) {
        session_start();
        $_SESSION['message'] = "Asociación creada con éxito.";
        $_SESSION['icon'] = "success";
        header('Location: ' . APP_URL . "/admin/courses/list_associate.php");
        exit();
    } else {
        session_start();
        $_SESSION['message'] = "Error al crear la asociación.";
        $_SESSION['icon'] = "error";
        header('Location: ' . APP_URL . "/admin/courses/create_association.php");
        exit();
    }
} catch (Exception $e) {
    session_start();
    $_SESSION['message'] = "Error: " . $e->getMessage();
    $_SESSION['icon'] = "error";
    header('Location: ' . APP_URL . "/admin/courses/create_association.php");
    exit();
}
?>
