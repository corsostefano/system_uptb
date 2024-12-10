<?php

include('../../../app/config.php');
session_start(); // Asegúrate de llamar esto al inicio, antes de cualquier salida

// Recibir y validar datos
$teacher_id = $_POST['teacher_id'];
$level_courses_id = $_POST['level_courses_id'];
$academic_programs_id = $_POST['academic_programs_id'];

// Verificar que todos los datos estén presentes
if (!$teacher_id || !$level_courses_id || !$academic_programs_id ) {
    $_SESSION['message'] = 'Datos incompletos. Por favor, completa todos los campos.';
    $_SESSION['icon'] = 'error';
    header('Location: ' . APP_URL . "/admin/teachers/assignment.php");
    exit();
}



// Preparar la sentencia SQL
$judgment = $pdo->prepare('
    INSERT INTO assignment 
    (teacher_id, level_courses_id, academic_programs_id, fyh_creation, assignment_state) 
    VALUES 
    (:teacher_id, :level_courses_id, :academic_programs_id, :fyh_creation, :assignment_state)
');

// Asociar parámetros
$judgment->bindParam(':teacher_id', $teacher_id, PDO::PARAM_INT);
$judgment->bindParam(':level_courses_id', $level_courses_id, PDO::PARAM_INT);
$judgment->bindParam(':academic_programs_id', $academic_programs_id, PDO::PARAM_INT);
$judgment->bindParam(':fyh_creation', $fyh_creation, PDO::PARAM_STR);
$judgment->bindParam(':assignment_state', $registration_status, PDO::PARAM_STR);

try {
    // Ejecutar la sentencia SQL
    if ($judgment->execute()) {
        $_SESSION['message'] = "Se registró la asignación correctamente.";
        $_SESSION['icon'] = "success";
        header('Location: ' . APP_URL . "/admin/teachers/assignment.php");
    } else {
        $_SESSION['message'] = 'Error al registrar la asignación en la base de datos.';
        $_SESSION['icon'] = 'error';
        header('Location: ' . APP_URL . "/admin/teachers/assignment.php");
    }
} catch (Exception $exception) {
    $_SESSION['message'] = 'Error al registrar la asignación: ' . $exception->getMessage();
    $_SESSION['icon'] = 'error';
    header('Location: ' . APP_URL . "/admin/teachers/assignment.php");
}

exit(); // Terminar el script para evitar cualquier salida adicional
?>
