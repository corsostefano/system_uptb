<?php
include('../../../../app/config.php');

$name_institution = $_POST['name_institution'];
$email_institution = $_POST['email_institution'];
$phone_institution = $_POST['phone_institution'];
$cellular_institution = $_POST['cellular_institution'];
$address_institution = $_POST['address_institution'];

// Verifica que todos los campos obligatorios estén completos
if (empty($name_institution) || empty($email_institution) || empty($phone_institution) || empty($cellular_institution) || empty($address_institution))  {
    session_start();
    $_SESSION['message'] = "Error en Registro, por favor complete todos los campos";
    $_SESSION['icon'] = "error";
    header('Location: ' . APP_URL . "/admin/settings/institution/create.php");
    exit(); 
} else {

    // Proceso para subir la imagen de perfil
    $profile_picture = null;
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == UPLOAD_ERR_OK) {
        $target_dir = __DIR__ . '/../../../../uploads/profile_pictures/';  // Ruta física para guardar las imágenes
        
        // Generar un nombre único para el archivo
        $image_file_type = strtolower(pathinfo($_FILES["profile_picture"]["name"], PATHINFO_EXTENSION));
        $unique_file_name = uniqid('profile_', true) . '.' . $image_file_type; // Cambiar 'profile_' por un prefijo que prefieras
        $target_file = $target_dir . $unique_file_name;
        
        // Validación de tamaño (2 MB máximo)
        $max_file_size = 2 * 1024 * 1024; // 2 MB en bytes
        if ($_FILES["profile_picture"]["size"] > $max_file_size){
            session_start();
            $_SESSION['message'] = "La imagen supera el tamaño máximo permitido de 2MB.";
            $_SESSION['icon'] = "error";
            header('Location: ' . APP_URL . "/admin/settings/institution/create.php");
            exit();
        }

        // Validaciones de la imagen
        $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
        if ($check !== false) {
            // Subir el archivo
            if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
                // Guardar la URL relativa en la base de datos
                $profile_picture = "/uploads/profile_pictures/" . $unique_file_name; // Guardar el nombre único
            } else {
                session_start();
                $_SESSION['message'] = "Error al subir la imagen.";
                $_SESSION['icon'] = "error";
                header('Location: ' . APP_URL . "/admin/settings/institution/create.php");
                exit();
            }
        } else {
            session_start();
            $_SESSION['message'] = "El archivo no es una imagen válida.";
            $_SESSION['icon'] = "error";
            header('Location: ' . APP_URL . "/admin/settings/institution/create.php");
            exit();
        }
    }



    // Prepara la sentencia SQL para la inserción de datos
    $fyh_creation = date('Y-m-d H:i:s'); // Agregar la fecha y hora de creación
    $judgment = $pdo->prepare('INSERT INTO institutions_configuration(name_institution, email_institution, phone_institution, cellular_institution, address_institution, profile_picture, fyh_creation) VALUES (:name_institution, :email_institution, :phone_institution, :cellular_institution, :address_institution, :profile_picture, :fyh_creation)');

    // Enlazar los valores
    $judgment->bindParam(':name_institution', $name_institution);
    $judgment->bindParam(':email_institution', $email_institution);
    $judgment->bindParam(':phone_institution', $phone_institution);
    $judgment->bindParam(':cellular_institution', $cellular_institution);
    $judgment->bindParam(':address_institution', $address_institution);
    $judgment->bindParam(':profile_picture', $profile_picture);
    $judgment->bindParam(':fyh_creation', $fyh_creation);

    try {
        // Ejecutar la sentencia SQL
        if ($judgment->execute()) {
            session_start();
            $_SESSION['message'] = "Registro Exitoso.";
            $_SESSION['icon'] = "success";
            header('Location: ' . APP_URL . "/admin/settings/institution/");
            exit(); 
        } else {
            session_start();
            $_SESSION['message'] = "Error en Registro, comuníquese con el administrador";
            $_SESSION['icon'] = "error";
            header('Location: ' . APP_URL . "/admin/settings/institution/create.php");
            exit(); 
        }

    } catch (\Throwable $th) {
        session_start();
        $_SESSION['message'] = "Este rol ya se encuentra registrado";
        $_SESSION['icon'] = "error";
        header('Location: ' . APP_URL . "/admin/settings/institution/create.php");
        exit(); 
    }
}
?>
