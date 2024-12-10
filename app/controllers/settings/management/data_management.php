<?php 
include ('../../../config.php');

// Consulta SQL con el marcador de parámetro
$sql_managements = "
SELECT * FROM managements WHERE id_management = :id_management";

$query_managements = $pdo->prepare($sql_managements);
$query_managements->bindParam(':id_management', $id_management, PDO::PARAM_INT);

if ($query_managements->execute()) {
    $managements = $query_managements->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($managements as $management) {
        $management_name = $management['management'];
        $fyh_creation = $management['fyh_creation'];
        $fyh_update = $management['fyh_update'];
        $management_state  = $management['management_state '];
       
    }
} else {
    session_start();
    $_SESSION['message'] = "Error en la consulta";
    $_SESSION['icon'] = "error";
    header('Location: ' . APP_URL . "/admin/settings/institution/");
    exit(); 
}
?>
