<?php
include('../../config.php');

// Obtener los valores del formulario
$course_id = $_POST['course_id'];
$level_id = $_POST['level_id'];
$level_courses_state = $_POST['level_courses_state'];
$id_level_courses = $_POST['id_level_courses']; // ID del registro a actualizar

// Convertimos el estado a un valor numérico
$level_courses_state = ($level_courses_state == "ACTIVO") ? 1 : 0;



// Actualizar los datos en la tabla level_courses
$fyh_update = date('Y-m-d H:i:s'); // Fecha y hora actual para la actualización
$sql = "UPDATE level_courses 
        SET course_id = :course_id, 
            level_id = :level_id, 
            level_courses_state = :level_courses_state, 
            fyh_update = :fyh_update
        WHERE id_level_courses = :id_level_courses";

$query = $pdo->prepare($sql);

// Asignar los valores a los parámetros
$query->bindParam(':course_id', $course_id);
$query->bindParam(':level_id', $level_id);
$query->bindParam(':level_courses_state', $level_courses_state);
$query->bindParam(':fyh_update', $fyh_update);
$query->bindParam(':id_level_courses', $id_level_courses, PDO::PARAM_INT);

try {
    // Ejecutar la consulta
    if ($query->execute()) {
        session_start();
        $_SESSION['message'] = "Asociación actualizada con éxito.";
        $_SESSION['icon'] = "success";
        header('Location: ' . APP_URL . "/admin/courses/list_associate.php");
        exit();
    } else {
        session_start();
        $_SESSION['message'] = "Error al actualizar la asociación.";
        $_SESSION['icon'] = "error";
        header('Location: ' . APP_URL . "/admin/courses/edit_association.php?id=" . $id_level_courses);
        exit();
    }
} catch (Exception $e) {
    session_start();
    $_SESSION['message'] = "Error: " . $e->getMessage();
    $_SESSION['icon'] = "error";
    header('Location: ' . APP_URL . "/admin/courses/edit_association.php?id=" . $id_level_courses);
    exit();
}
?>
