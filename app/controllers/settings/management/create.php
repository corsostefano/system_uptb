<?php 
include('../../../../app/config.php');

$management = $_POST['management'];
$management = mb_strtoupper($management, 'UTF-8'); //convierte a mayúscula
$management_state = $_POST['management_state'];

if($management_state == "ACTIVO"){
    $management_state = 1;
}else{
    $management_state = 0;
};

if($management == ""){
    session_start();
    $_SESSION['message'] = "Error en Registro, campo vació";
    $_SESSION['icon'] = "error";
    header(header: 'Location: ' . APP_URL . "/admin/management/create.php");
    exit(); 
}else{
    //sentencia
    $judgment = $pdo->prepare("INSERT INTO managements(management, fyh_creation, management_state ) 
    VALUES (:management, :fyh_creation, :management_state )");
    
    $judgment->bindParam('management', $management);
    $judgment->bindParam('fyh_creation', $fyh_creation);
    $judgment->bindParam('management_state', $management_state);
    
    try {
        if($judgment->execute()){
            session_start();
            $_SESSION['message'] = "Registro Exitoso.";
            $_SESSION['icon'] = "success";
            header(header: 'Location: ' . APP_URL . "/admin/settings/");
            exit(); 
        }else{
            session_start();
            $_SESSION['message'] = "Error en Registro, comuníquese con el administrador";
            $_SESSION['icon'] = "error";
            header(header: 'Location: ' . APP_URL . "/admin/management/create.php");
            exit(); 
        };
    } catch (Exception $exception) {
        session_start();
            $_SESSION['message'] = "Este rol ya se encuentra registrado";
            $_SESSION['icon'] = "error";
            header(header: 'Location: ' . APP_URL . "/admin/management/create.php");
            exit(); 
    }

};


?>