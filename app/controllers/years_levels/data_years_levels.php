<?php 
include ('../../config.php');

// Consulta SQL para obtener los datos de la tabla principal levels y su relación con academic_programs
$sql_levels = "
SELECT l.*, ap.programs_name
    FROM levels AS l
    LEFT JOIN academic_programs AS ap ON l.academic_programs_id = ap.id_academic_programs
    WHERE l.id_levels = :id_levels";

$query_levels = $pdo->prepare($sql_levels);
$query_levels->bindParam(':id_levels', $id_levels, PDO::PARAM_INT);

if ($query_levels->execute()) {
    $levels = $query_levels->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($levels as $level) {
        $years_level = $level['years_level'];
        $section = $level['section'];
        $fyh_creation = $level['fyh_creation'];
        $fyh_update = $level['fyh_update'];
        $levels_state = $level['levels_state'];
        $programs_name = $level['programs_name']; // Nombre del programa académico
        $academic_programs_id = $level['academic_programs_id']; 
    }
} else {
    session_start();
    $_SESSION['message'] = "Error en la consulta";
    $_SESSION['icon'] = "error";
    header('Location: ' . APP_URL . "/admin/years_levels/");
    exit(); 
}
?>
