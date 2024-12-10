<?php 
include('../../config.php');

$id_academic_programs = $_POST['id_academic_programs'];
$management_id = $_POST['management_id'];
$programs_name = $_POST['programs_name'];
$programs_name = mb_strtoupper($programs_name, 'UTF-8'); // Convierte a mayúsculas
$shift = $_POST['shift'];
$programs_state = $_POST['programs_state'];

// Convertir el estado a valores numéricos
$programs_state = ($programs_state == "ACTIVO") ? 1 : 0;

// Establecer la fecha y hora de actualización
$fyh_update = date('Y-m-d H:i:s');

if ($programs_name == "") {
    session_start();
    $_SESSION['message'] = "Error en actualización, campo vacío";
    $_SESSION['icon'] = "error";
    header('Location: ' . APP_URL . "/admin/academic_programs/edit.php");
    exit(); 
} else {
    // Preparar la sentencia SQL de actualización
    $judgment = $pdo->prepare("UPDATE academic_programs 
                SET management_id = :management_id, 
                    programs_name = :programs_name, 
                    shift = :shift, 
                    programs_state = :programs_state,
                    fyh_update = :fyh_update
                WHERE id_academic_programs = :id_academic_programs"
    );

    // Vinculación de parámetros
    $judgment->bindParam(':programs_name', $programs_name);
    $judgment->bindParam(':management_id', $management_id, PDO::PARAM_INT);
    $judgment->bindParam(':fyh_update', $fyh_update);
    $judgment->bindParam(':shift', $shift);
    $judgment->bindParam(':programs_state', $programs_state, PDO::PARAM_INT);
    $judgment->bindParam(':id_academic_programs', $id_academic_programs, PDO::PARAM_INT);

    try {
        if ($judgment->execute()) {
            session_start();
            $_SESSION['message'] = "Actualización Exitosa.";
            $_SESSION['icon'] = "success";
            header('Location: ' . APP_URL . "/admin/academic_programs");
            exit(); 
        } else {
            session_start();
            $_SESSION['message'] = "Error en actualización, comuníquese con el administrador";
            $_SESSION['icon'] = "error";
            header('Location: ' . APP_URL . "/admin/academic_programs/edit.php");
            exit(); 
        }
    } catch (Exception $exception) {
        session_start();
        $_SESSION['message'] = "Este PNF ya se encuentra registrado";
        $_SESSION['icon'] = "error";
        header('Location: ' . APP_URL . "/admin/academic_programs/edit.php");
        exit(); 
    }
}
?>
