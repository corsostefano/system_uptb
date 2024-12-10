<?php 
include ('../../../app/config.php');

$id_rol = $_POST['id_rol'];
$name_rol = $_POST['name_rol'];
$category = $_POST['category']; // Se obtiene el valor de la categoría del formulario
$name_rol = mb_strtoupper($name_rol, 'UTF-8'); // Convierte a mayúscula

if($name_rol == ""){ 
    session_start();
    $_SESSION['message'] = "Error en Registro, campo vacío";
    $_SESSION['icon'] = "error";
    header('Location: ' . APP_URL . "/admin/roles/update.php?id=".$id_rol);
    exit(); 
}else{
    // Sentencia SQL para actualizar el rol y la categoría
    $judgment = $pdo->prepare("UPDATE roles 
        SET name_rol=:name_rol, 
            category=:category, 
            fyh_update=:fyh_update 
        WHERE id_rol=:id_rol");

    // Vinculamos los parámetros
    $judgment->bindParam(':name_rol', $name_rol);
    $judgment->bindParam(':category', $category); // Vinculamos la categoría
    $judgment->bindParam(':fyh_update', $fyh_creation);
    $judgment->bindParam(':id_rol', $id_rol);

    try {
        if($judgment->execute()){
            session_start();
            $_SESSION['message'] = "Actualización Exitosa.";
            $_SESSION['icon'] = "success";
            header('Location: ' . APP_URL . "/admin/roles/");
            exit(); 
        } else {
            session_start();
            $_SESSION['message'] = "Error en Actualización, comuníquese con el administrador";
            $_SESSION['icon'] = "error";
            header('Location: ' . APP_URL . "/admin/roles/edit.php?id=".$id_rol);
            exit(); 
        }
    } catch (Exception $exception) {
        session_start();
        $_SESSION['message'] = "Este rol ya se encuentra registrado";
        $_SESSION['icon'] = "error";
        header('Location: ' . APP_URL . "/admin/roles/edit.php?id=".$id_rol);
        exit(); 
    }
}
?>
