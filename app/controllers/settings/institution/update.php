<?php
include('../../../../app/config.php');
session_start();

$id_config_institution = $_POST['id_config_institution'];
$name_institution = $_POST['name_institution'];
$email_institution = $_POST['email_institution'];
$phone_institution = $_POST['phone_institution'];
$cellular_institution = $_POST['cellular_institution'];
$address_institution = $_POST['address_institution'];

if (empty($id_config_institution) || empty($name_institution) || empty($email_institution) || empty($phone_institution) || empty($cellular_institution) || empty($address_institution)) {
    $_SESSION['message'] = "Error en actualización, por favor complete todos los campos";
    $_SESSION['icon'] = "error";
    header('Location: ' . APP_URL . "/admin/settings/institution/edit.php?id=" . $id_config_institution);
    exit();
}

$profile_picture = null;
if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == UPLOAD_ERR_OK) {
    $target_dir = __DIR__ . '/../../../../uploads/profile_pictures/';
    $image_file_type = strtolower(pathinfo($_FILES["profile_picture"]["name"], PATHINFO_EXTENSION));
    $unique_file_name = uniqid('profile_', true) . '.' . $image_file_type;
    $target_file = $target_dir . $unique_file_name;

    $max_file_size = 2 * 1024 * 1024;
    if ($_FILES["profile_picture"]["size"] > $max_file_size) {
        $_SESSION['message'] = "La imagen supera el tamaño máximo permitido de 2MB.";
        $_SESSION['icon'] = "error";
        header('Location: ' . APP_URL . "/admin/settings/institution/edit.php?id=" . $id_config_institution);
        exit();
    }

    $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
    if ($check !== false) {
        if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
            $profile_picture = "uploads/profile_pictures/" . $unique_file_name;
        } else {
            $_SESSION['message'] = "Error al subir la imagen.";
            $_SESSION['icon'] = "error";
            header('Location: ' . APP_URL . "/admin/settings/institution/edit.php?id=" . $id_config_institution);
            exit();
        }
    } else {
        $_SESSION['message'] = "El archivo no es una imagen válida.";
        $_SESSION['icon'] = "error";
        header('Location: ' . APP_URL . "/admin/settings/institution/edit.php?id=" . $id_config_institution);
        exit();
    }
}

$fyh_update = date('Y-m-d H:i:s');

try {
    if ($profile_picture) {
        $judgment = $pdo->prepare('
            UPDATE institutions_configuration 
            SET name_institution = :name_institution, 
                email_institution = :email_institution, 
                phone_institution = :phone_institution, 
                cellular_institution = :cellular_institution, 
                address_institution = :address_institution, 
                profile_picture = :profile_picture, 
                fyh_update = :fyh_update 
            WHERE id_config_institution = :id_config_institution
        ');
        $judgment->bindParam(':profile_picture', $profile_picture);
    } else {
        $judgment = $pdo->prepare('
            UPDATE institutions_configuration 
            SET name_institution = :name_institution, 
                email_institution = :email_institution, 
                phone_institution = :phone_institution, 
                cellular_institution = :cellular_institution, 
                address_institution = :address_institution, 
                fyh_update = :fyh_update 
            WHERE id_config_institution = :id_config_institution
        ');
    }

    $judgment->bindParam(':name_institution', $name_institution);
    $judgment->bindParam(':email_institution', $email_institution);
    $judgment->bindParam(':phone_institution', $phone_institution);
    $judgment->bindParam(':cellular_institution', $cellular_institution);
    $judgment->bindParam(':address_institution', $address_institution);
    $judgment->bindParam(':fyh_update', $fyh_update);
    $judgment->bindParam(':id_config_institution', $id_config_institution);

    if ($judgment->execute()) {
        $_SESSION['message'] = "Actualización Exitosa.";
        $_SESSION['icon'] = "success";
        header('Location: ' . APP_URL . "/admin/settings/institution/");
        exit();
    } else {
        $_SESSION['message'] = "Error en actualización, comuníquese con el administrador";
        $_SESSION['icon'] = "error";
        header('Location: ' . APP_URL . "/admin/settings/institution/edit.php?id=" . $id_config_institution);
        exit();
    }
} catch (Exception $e) {
    $_SESSION['message'] = "Error en la actualización: " . $e->getMessage();
    $_SESSION['icon'] = "error";
    header('Location: ' . APP_URL . "/admin/settings/institution/edit.php?id=" . $id_config_institution);
    exit();
}
?>
