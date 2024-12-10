<?php 
include ('../../../config.php');

// Consulta SQL con el marcador de parámetro
$sql_institutions = "
SELECT * FROM institutions_configuration WHERE id_config_institution = :id_config_institution AND institution_state = '1'";

$query_institutions = $pdo->prepare($sql_institutions);
$query_institutions->bindParam(':id_config_institution', $id_config_institution, PDO::PARAM_INT);

if ($query_institutions->execute()) {
    $institutions = $query_institutions->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($institutions as $institution) {
        $name_institution = $institution['name_institution'];
        $profile_picture = $institution['profile_picture'];
        $address_institution = $institution['address_institution'];
        $phone_institution = $institution['phone_institution'];
        $cellular_institution = $institution['cellular_institution'];
        $email_institution = $institution['email_institution'];
        $fyh_creation = $institution['fyh_creation'];
        $fyh_update = $institution['fyh_update'];
        $institution_state = $institution['institution_state'];
    }
} else {
    session_start();
    $_SESSION['message'] = "Error en la consulta";
    $_SESSION['icon'] = "error";
    header('Location: ' . APP_URL . "/admin/settings/institution/");
    exit(); 
}
?>
