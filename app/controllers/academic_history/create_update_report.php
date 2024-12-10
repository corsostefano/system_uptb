<?php
include ('../../../app/config.php');

session_start();

// Recibir las variables POST
$observations = $_POST['observations'];
$notes = $_POST['notes'];
$student_id = $_POST['student_id'];
$assignment_id = $_POST['assignment_id'];
$level_courses_id = $_POST['level_courses_id'];

// Validación de que los campos no estén vacíos
if (empty($observations) || empty($notes) || empty($student_id) || empty($assignment_id) || empty($level_courses_id)) {
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
        SELECT * FROM academic_history 
        WHERE student_id = :student_id AND assignment_id = :assignment_id AND level_courses_id = :level_courses_id
    ";

    $stmt = $pdo->prepare($sql_check);
    $stmt->execute([
        ':student_id' => $student_id,
        ':assignment_id' => $assignment_id,
        ':level_courses_id' => $level_courses_id
    ]);

    $existing_report = $stmt->fetch();

    if ($existing_report) {
        // Si el registro ya existe, se actualiza
        $sql_update = "
            UPDATE academic_history 
            SET observations = :observations, note = :notes
            WHERE student_id = :student_id AND assignment_id = :assignment_id AND level_courses_id = :level_courses_id
        ";

        $stmt = $pdo->prepare($sql_update);
        $stmt->execute([
            ':observations' => $observations,
            ':notes' => $notes,
            ':student_id' => $student_id,
            ':assignment_id' => $assignment_id,
            ':level_courses_id' => $level_courses_id
        ]);

        $_SESSION['message'] = "Los datos se han actualizado correctamente.";
        $_SESSION['icon'] = "success";
    } else {
        // Si el registro no existe, se inserta un nuevo registro
        $sql_insert = "
            INSERT INTO academic_history (observations, note, student_id, assignment_id, level_courses_id)
            VALUES (:observations, :notes, :student_id, :assignment_id, :level_courses_id)
        ";

        $stmt = $pdo->prepare($sql_insert);
        $stmt->execute([
            ':observations' => $observations,
            ':notes' => $notes,
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
