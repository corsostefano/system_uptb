<?php 
include('../../config.php');
session_start();

$id_levels = $_POST['id_levels'];
$academic_programs_id = $_POST['academic_programs_id'];
$years_level = $_POST['years_level']; // Asegúrate de que el nombre coincide en el formulario
$years_level = mb_strtoupper($years_level, 'UTF-8'); // Convierte a mayúsculas
$section = $_POST['section'];
$levels_state = $_POST['levels_state'];

// Convertir el estado a valores numéricos
$levels_state = ($levels_state == "ACTIVO") ? 1 : 0;

// Establecer la fecha y hora de actualización a la fecha actual
$fyh_update = date("Y-m-d H:i:s");

if ($years_level == "") {
    $_SESSION['message'] = "Error en actualización, campo vacío";
    $_SESSION['icon'] = "error";
    header('Location: ' . APP_URL . "/admin/years_levels/edit.php");
    exit(); 
} else {
    // Preparar la sentencia SQL de actualización
    $judgment = $pdo->prepare("UPDATE levels 
                SET academic_programs_id = :academic_programs_id, 
                    years_level = :years_level, 
                    section = :section, 
                    levels_state = :levels_state,
                    fyh_update = :fyh_update
                WHERE id_levels = :id_levels"
    );

    // Vinculación de parámetros
    $judgment->bindParam(':years_level', $years_level);
    $judgment->bindParam(':academic_programs_id', $academic_programs_id, PDO::PARAM_INT);
    $judgment->bindParam(':fyh_update', $fyh_update);
    $judgment->bindParam(':section', $section);
    $judgment->bindParam(':levels_state', $levels_state, PDO::PARAM_INT);
    $judgment->bindParam(':id_levels', $id_levels, PDO::PARAM_INT);

    try {
        if ($judgment->execute()) {
            $_SESSION['message'] = "Actualización Exitosa.";
            $_SESSION['icon'] = "success";
            header('Location: ' . APP_URL . "/admin/years_levels");
            exit(); 
        } else {
            $_SESSION['message'] = "Error en actualización, comuníquese con el administrador";
            $_SESSION['icon'] = "error";
            header('Location: ' . APP_URL . "/admin/years_levels/edit.php");
            exit(); 
        }
    } catch (Exception $exception) {
        $_SESSION['message'] = "Este PNF ya se encuentra registrado";
        $_SESSION['icon'] = "error";
        header('Location: ' . APP_URL . "/admin/years_levels/edit.php");
        exit(); 
    }
}
?>
