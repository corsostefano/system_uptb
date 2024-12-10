<?php
include ('../../../app/config.php');

session_start();

// Recibir las variables POST
$attendance_percentage = $_POST['attendance_percentage'];
$final_grade_percentage = $_POST['final_grade_percentage'];
$student_id = $_POST['student_id'];
$assignment_id = $_POST['assignment_id'];
$level_courses_id = $_POST['level_courses_id'];

// Validación de que los campos no estén vacíos
if (empty($attendance_percentage) || empty($final_grade_percentage) || empty($student_id) || empty($assignment_id) || empty($level_courses_id)) {
    $_SESSION['message'] = "Todos los campos son obligatorios.";
    $_SESSION['icon'] = "error";
    header('Location: ' . APP_URL . '/admin/grades/');
    exit();
}

// Habilitar el modo de excepciones de PDO
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
    // Verificar si ya existe un registro para este estudiante, asignatura y curso
    $sql_check = "
        SELECT * FROM grades 
        WHERE student_id = :student_id AND assignment_id = :assignment_id AND level_courses_id = :level_courses_id
    ";

    $stmt = $pdo->prepare($sql_check);
    $stmt->execute([
        ':student_id' => $student_id,
        ':assignment_id' => $assignment_id,
        ':level_courses_id' => $level_courses_id
    ]);

    $existing_grade = $stmt->fetch();

    if ($existing_grade) {
        // Si el registro ya existe, se actualiza
        $sql_update = "
            UPDATE grades 
            SET attendance_percentage = :attendance_percentage, final_grade_percentage = :final_grade_percentage
            WHERE student_id = :student_id AND assignment_id = :assignment_id AND level_courses_id = :level_courses_id
        ";

        $stmt = $pdo->prepare($sql_update);
        $stmt->execute([
            ':attendance_percentage' => $attendance_percentage,
            ':final_grade_percentage' => $final_grade_percentage,
            ':student_id' => $student_id,
            ':assignment_id' => $assignment_id,
            ':level_courses_id' => $level_courses_id
        ]);

        $_SESSION['message'] = "Los datos se han actualizado correctamente.";
        $_SESSION['icon'] = "success";
    } else {
        // Si el registro no existe, se inserta un nuevo registro
        $sql_insert = "
            INSERT INTO grades (attendance_percentage, final_grade_percentage, student_id, assignment_id, level_courses_id)
            VALUES (:attendance_percentage, :final_grade_percentage, :student_id, :assignment_id, :level_courses_id)
        ";

        $stmt = $pdo->prepare($sql_insert);
        $stmt->execute([
            ':attendance_percentage' => $attendance_percentage,
            ':final_grade_percentage' => $final_grade_percentage,
            ':student_id' => $student_id,
            ':assignment_id' => $assignment_id,
            ':level_courses_id' => $level_courses_id
        ]);

        $_SESSION['message'] = "Los datos se han guardado correctamente.";
        $_SESSION['icon'] = "success";
    }

    // Redirigir después de la operación
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
} catch (PDOException $e) {
    // Capturar y mostrar el error de la base de datos
    $_SESSION['message'] = "Error: " . $e->getMessage();
    $_SESSION['icon'] = "error";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}
?>
