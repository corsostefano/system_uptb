<?php 
include('../../config.php');

$academic_programs_id = $_POST['academic_programs_id'];
$years_level = $_POST['years_level'];
$years_level = mb_strtoupper($years_level, 'UTF-8'); // convierte a mayúscula
$section = $_POST['section'];
$levels_state = $_POST['levels_state'];

// Convertimos el estado a un valor numérico
$levels_state = ($levels_state == "ACTIVO") ? 1 : 0;

// Verificamos si el nombre del programa está vacío
if ($years_level == "") {
    session_start();
    $_SESSION['message'] = "Error en Registro, campo vacío";
    $_SESSION['icon'] = "error";
    header('Location: ' . APP_URL . "/admin/years_levels/create.php");
    exit(); 
} else {
    // Preparar la sentencia SQL
    $judgment = $pdo->prepare("INSERT INTO levels (academic_programs_id, years_level, section, fyh_creation, levels_state) 
    VALUES (:academic_programs_id, :years_level, :section, :fyh_creation, :levels_state)");

    // Enlazar parámetros
    $judgment->bindParam(':academic_programs_id', $academic_programs_id);
    $judgment->bindParam(':years_level', $years_level);
    $judgment->bindParam(':section', $section);
    $judgment->bindParam(':fyh_creation', $fyh_creation);
    $judgment->bindParam(':levels_state', $levels_state);

    try {
        // Ejecutar la sentencia
        if ($judgment->execute()) {
            session_start();
            $_SESSION['message'] = "Registro Exitoso.";
            $_SESSION['icon'] = "success";
            header('Location: ' . APP_URL . "/admin/years_levels/");
            exit(); 
        } else {
            session_start();
            $_SESSION['message'] = "Error en Registro, comuníquese con el administrador";
            $_SESSION['icon'] = "error";
            header('Location: ' . APP_URL . "/admin/years_levels/create.php");
            exit(); 
        }
    } catch (Exception $exception) {
        session_start();
        $_SESSION['message'] = "Este año o nivel ya se encuentra registrado";
        $_SESSION['icon'] = "error";
        header('Location: ' . APP_URL . "/admin/years_levels/create.php");
        exit(); 
    }
}
?>
