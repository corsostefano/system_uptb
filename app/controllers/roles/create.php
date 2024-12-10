<?php 
include ('../../../app/config.php');

// Obtener datos del formulario
$name_rol = $_POST['name_rol'];
$category = $_POST['category']; // Recibimos la categoría
$name_rol = mb_strtoupper($name_rol, 'UTF-8'); // Convierte a mayúsculas

if($name_rol == ""){
    session_start();
    $_SESSION['message'] = "Error en Registro, campo vacío";
    $_SESSION['icon'] = "error";
    header('Location: ' . APP_URL . "/admin/roles/create.php");
    exit(); 
}else{
    // Preparamos la sentencia SQL para insertar el nuevo rol
    $judgment = $pdo->prepare("INSERT INTO roles (name_rol, category, fyh_creation, rol_state) 
    VALUES (:name_rol, :category, :fyh_creation, :rol_state)");

    // Asignamos los parámetros
    $judgment->bindParam('name_rol', $name_rol);
    $judgment->bindParam('category', $category); // Añadimos la categoría
    $judgment->bindParam('fyh_creation', $fyh_creation);
    $judgment->bindParam('rol_state', $registration_status);

    try {
        // Ejecutamos la sentencia SQL
        if($judgment->execute()){
            session_start();
            $_SESSION['message'] = "Registro Exitoso.";
            $_SESSION['icon'] = "success";
            header('Location: ' . APP_URL . "/admin/roles/");
            exit(); 
        } else {
            session_start();
            $_SESSION['message'] = "Error en Registro, comuníquese con el administrador";
            $_SESSION['icon'] = "error";
            header('Location: ' . APP_URL . "/admin/roles/create.php");
            exit(); 
        }
    } catch (Exception $exception) {
        session_start();
        $_SESSION['message'] = "Este rol ya se encuentra registrado";
        $_SESSION['icon'] = "error";
        header('Location: ' . APP_URL . "/admin/roles/create.php");
        exit(); 
    }
};
?>
