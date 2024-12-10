<?php 
include('../../config.php');

$management_id = $_POST['management_id'];
$programs_name = $_POST['programs_name'];
$programs_name = mb_strtoupper($programs_name, 'UTF-8'); // convierte a mayúscula
$shift = $_POST['shift'];
$programs_state = $_POST['programs_state'];
$campuses = isset($_POST['campuses']) ? $_POST['campuses'] : []; // Verificar si se seleccionaron campus

// Convertimos el estado a un valor numérico
$programs_state = ($programs_state == "ACTIVO") ? 1 : 0;

// Verificamos si el nombre del programa está vacío
if ($programs_name == "") {
    session_start();
    $_SESSION['message'] = "Error en Registro, campo vacío";
    $_SESSION['icon'] = "error";
    header('Location: ' . APP_URL . "/admin/academic_programs/create.php");
    exit(); 
} else {
    // Iniciar transacción
    $pdo->beginTransaction();
    try {
        // Insertar en academic_programs
        $judgment = $pdo->prepare("
            INSERT INTO academic_programs (management_id, programs_name, shift, fyh_creation, programs_state) 
            VALUES (:management_id, :programs_name, :shift, NOW(), :programs_state)
        ");
        $judgment->bindParam(':management_id', $management_id);
        $judgment->bindParam(':programs_name', $programs_name);
        $judgment->bindParam(':shift', $shift);
        $judgment->bindParam(':programs_state', $programs_state);
        
        if ($judgment->execute()) {
            // Obtener el ID del programa recién creado
            $program_id = $pdo->lastInsertId();
            
            // Insertar en la tabla intermedia program_campus
            $judgment_campuses = $pdo->prepare("
                INSERT INTO program_campus (academic_program_id, campus_id, fyh_creation) 
                VALUES (:academic_program_id, :campus_id, NOW())
            ");
            foreach ($campuses as $campus_id) {
                $judgment_campuses->bindParam(':academic_program_id', $program_id);
                $judgment_campuses->bindParam(':campus_id', $campus_id);
                $judgment_campuses->execute();
            }

            // Confirmar transacción
            $pdo->commit();

            session_start();
            $_SESSION['message'] = "Registro Exitoso.";
            $_SESSION['icon'] = "success";
            header('Location: ' . APP_URL . "/admin/academic_programs/");
            exit(); 
        } else {
            // Revertir transacción en caso de error
            $pdo->rollBack();
            session_start();
            $_SESSION['message'] = "Error en Registro, comuníquese con el administrador";
            $_SESSION['icon'] = "error";
            header('Location: ' . APP_URL . "/admin/academic_programs/create.php");
            exit(); 
        }
    } catch (Exception $exception) {
        // Revertir transacción en caso de excepción
        $pdo->rollBack();
        session_start();
        $_SESSION['message'] = "Error: " . $exception->getMessage();
        $_SESSION['icon'] = "error";
        header('Location: ' . APP_URL . "/admin/academic_programs/create.php");
        exit(); 
    }
}
?>
