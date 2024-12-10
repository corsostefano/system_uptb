<?php 
include ('../../config.php');

// Consulta SQL con JOIN para traer el campo management desde la tabla managements
$sql_academic_programs = "
SELECT ap.*, m.management
FROM academic_programs AS ap
JOIN managements AS m ON ap.management_id = m.id_management
WHERE ap.id_academic_programs = :id_academic_programs";

$query_academic_programs = $pdo->prepare($sql_academic_programs);
$query_academic_programs->bindParam(':id_academic_programs', $id_academic_programs, PDO::PARAM_INT);

if ($query_academic_programs->execute()) {
    $academic_programs = $query_academic_programs->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($academic_programs as $academic_program) {
        $programs_name = $academic_program['programs_name'];
        $shift = $academic_program['shift'];
        $fyh_creation = $academic_program['fyh_creation'];
        $fyh_update = $academic_program['fyh_update'];
        $programs_state = $academic_program['programs_state'];
        $management = $academic_program['management']; // Trae el nombre de la gestión educativa
        $management_id = $academic_program['management_id']; 
    }
} else {
    session_start();
    $_SESSION['message'] = "Error en la consulta";
    $_SESSION['icon'] = "error";
    header('Location: ' . APP_URL . "/admin/academic_programs/");
    exit(); 
}
?>
