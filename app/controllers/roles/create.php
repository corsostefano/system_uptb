<?php 
include ('../../../app/config.php');

$name_rol = $_POST['name_rol'];
$name_rol = mb_strtoupper($name_rol, 'UTF-8'); //convierte a mayúscula

if($name_rol == ""){
    session_start();
    $_SESSION['message'] = "Error en Registro, campo vació";
    $_SESSION['icon'] = "error";
    header(header: 'Location: ' . APP_URL . "/admin/roles/create.php");
    exit(); 
}else{
    //sentencia
    $judgment = $pdo->prepare("INSERT INTO roles(name_rol, fyh_creation, rol_state ) 
    VALUES (:name_rol, :fyh_creation, :rol_state )");
    
    $judgment->bindParam('name_rol', $name_rol);
    $judgment->bindParam('fyh_creation', $dateTime);
    $judgment->bindParam('rol_state', $registration_status);
    
    try {
        if($judgment->execute()){
            session_start();
            $_SESSION['message'] = "Registro Exitoso.";
            $_SESSION['icon'] = "success";
            header(header: 'Location: ' . APP_URL . "/admin/roles/");
            exit(); 
        }else{
            session_start();
            $_SESSION['message'] = "Error en Registro, comuníquese con el administrador";
            $_SESSION['icon'] = "error";
            header(header: 'Location: ' . APP_URL . "/admin/roles/create.php");
            exit(); 
        };
    } catch (Exception $exception) {
        session_start();
            $_SESSION['message'] = "Este rol ya se encuentra registrado";
            $_SESSION['icon'] = "error";
            header(header: 'Location: ' . APP_URL . "/admin/roles/create.php");
            exit(); 
    }

};


?>