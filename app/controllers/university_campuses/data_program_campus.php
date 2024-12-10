<?php 
include ('../../../app/config.php');
// Suponiendo que estás usando PDO para la conexión a la base de datos
if (isset($_GET['academic_program_id'])) {
    $programId = $_GET['academic_program_id'];
    
    // Consulta SQL para obtener las sedes asociadas
    $query = "
        SELECT c.id_campus, c.name_campus
        FROM university_campuses c
        JOIN program_campus pc ON c.id_campus = pc.campus_id
        WHERE pc.academic_program_id = :programId
    ";
    
    $stmt = $pdo->prepare($query);
    $stmt->execute(['programId' => $programId]);
    
    $campuses = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Retornar las sedes como JSON
    echo json_encode($campuses);
    exit;
}

?>
