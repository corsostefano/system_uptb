<?php 
include('../../config.php');


$name_url  = $_POST['name_url'];
$url  = $_POST['url'];



// Verificamos si el nombre del programa está vacío
if (($name_url == "") && ($url == "") ) {
    session_start();
    $_SESSION['message'] = "Error en Registro, campo vacío";
    $_SESSION['icon'] = "error";
    header('Location: ' . APP_URL . "/admin/roles/permissions.php");
    exit(); 
} else {
    // Preparar la sentencia SQL
    $judgment = $pdo->prepare("INSERT INTO permissions (name_url, url, fyh_creation) 
    VALUES (:name_url, :url, :fyh_creation)");

    // Enlazar parámetros

    $judgment->bindParam(':name_url', $name_url);
    $judgment->bindParam(':url', $url);
    $judgment->bindParam(':fyh_creation', $fyh_creation);


    try {
        // Ejecutar la sentencia
        if ($judgment->execute()) {
            session_start();
            $_SESSION['message'] = "Registro Exitoso.";
            $_SESSION['icon'] = "success";
            header('Location: ' . APP_URL . "/admin/roles/permissions.php");
            exit(); 
        } else {
            session_start();
            $_SESSION['message'] = "Error en Registro, comuníquese con el administrador";
            $_SESSION['icon'] = "error";
            header('Location: ' . APP_URL . "/admin/roles/permissions.php");
            exit(); 
        }
    } catch (Exception $exception) {
        session_start();
        $_SESSION['message'] = "Error al registrar permiso";
        $_SESSION['icon'] = "error";
        header('Location: ' . APP_URL . "/admin/roles/permissions.php");
        exit(); 
    }
}
?>
