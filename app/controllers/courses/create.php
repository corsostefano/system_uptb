<?php 
include('../../config.php');


$name_course  = $_POST['name_course'];
$name_course  = mb_strtoupper($name_course , 'UTF-8'); // convierte a mayúscula
$course_state = $_POST['course_state'];

// Convertimos el estado a un valor numérico
$course_state = ($course_state == "ACTIVO") ? 1 : 0;

// Verificamos si el nombre del programa está vacío
if ($name_course == "") {
    session_start();
    $_SESSION['message'] = "Error en Registro, campo vacío";
    $_SESSION['icon'] = "error";
    header('Location: ' . APP_URL . "/admin/courses/create.php");
    exit(); 
} else {
    // Preparar la sentencia SQL
    $judgment = $pdo->prepare("INSERT INTO courses (name_course, fyh_creation, course_state) 
    VALUES (:name_course,:fyh_creation, :course_state)");

    // Enlazar parámetros

    $judgment->bindParam(':name_course', $name_course);
    $judgment->bindParam(':fyh_creation', $fyh_creation);
    $judgment->bindParam(':course_state', $course_state);

    try {
        // Ejecutar la sentencia
        if ($judgment->execute()) {
            session_start();
            $_SESSION['message'] = "Registro Exitoso.";
            $_SESSION['icon'] = "success";
            header('Location: ' . APP_URL . "/admin/courses/");
            exit(); 
        } else {
            session_start();
            $_SESSION['message'] = "Error en Registro, comuníquese con el administrador";
            $_SESSION['icon'] = "error";
            header('Location: ' . APP_URL . "/admin/courses/create.php");
            exit(); 
        }
    } catch (Exception $exception) {
        session_start();
        $_SESSION['message'] = "Esta materia ya se encuentra registrado";
        $_SESSION['icon'] = "error";
        header('Location: ' . APP_URL . "/admin/courses/create.php");
        exit(); 
    }
}
?>
