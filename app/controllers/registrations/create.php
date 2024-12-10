<?php
include ('../../../app/config.php');

$first_name_post = $_POST['first_name'];
$first_name = mb_convert_case($first_name_post, MB_CASE_TITLE, "UTF-8");
$last_name_post = $_POST['last_name'];
$last_name = mb_convert_case($last_name_post, MB_CASE_TITLE, "UTF-8");
$rol_id = $_POST['rol_id'];
$email = $_POST['email'];
$identification_type = $_POST['identification_type'];
$cedula = $_POST['cedula'];
$sex = $_POST['sex'];
$marital_status = $_POST['marital_status'];
$birth_date = $_POST['birth_date'];
$education = $_POST['education'];
$profession = $_POST['profession'];
$address_user = $_POST['address_user'];
$state_of_residence = $_POST['state_of_residence'];
$municipality = $_POST['municipality'];
$rol_category = $_POST['category']; // Nueva variable recibida desde el formulario
$phone = $_POST['phone'];
$mobile = $_POST['mobile'];
$emergency_contact = $_POST['emergency_contact'];
$academic_program_id = $_POST['academic_program_id']; 
$level_id = $_POST['level_id'];
$campus_id = $_POST['campus_id'];

// Verifica que todos los campos obligatorios estén completos
if ($first_name_post == '' || $last_name_post == '' || $rol_id == '' || $email == '' || $identification_type == '' || $cedula == '' || $sex == '' || $marital_status == '' || $education == '' || $profession == '' || $address_user == '' || $state_of_residence == '' || $municipality == '' || $rol_category == '' || $phone == '' || $mobile == '' || $emergency_contact == '' || $campus_id == '' ) {
    session_start();
    $_SESSION['message'] = "Error en Registro, por favor complete todos los campos";
    $_SESSION['icon'] = "error";
    header('Location: ' . APP_URL . "/admin/registrations/create.php");
    exit(); 
} else {
   
    // Hash de la contraseña
    $user_password_hashed = password_hash($cedula, PASSWORD_DEFAULT);
    
    // Proceso para subir la imagen de perfil
    $profile_picture = null;
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == UPLOAD_ERR_OK) {
        $target_dir = __DIR__ . '/../../../uploads/profile_pictures/';  // Ruta física para guardar las imágenes
        
        // Generar un nombre único para el archivo
        $image_file_type = strtolower(pathinfo($_FILES["profile_picture"]["name"], PATHINFO_EXTENSION));
        $unique_file_name = uniqid('profile_', true) . '.' . $image_file_type; // Cambiar 'profile_' por el prefijo que prefieras
        $target_file = $target_dir . $unique_file_name;
    
        // Validación de tamaño (2 MB máximo)
        $max_file_size = 2 * 1024 * 1024; // 2 MB en bytes
        if ($_FILES["profile_picture"]["size"] > $max_file_size) {
            session_start();
            $_SESSION['message'] = "La imagen supera el tamaño máximo permitido de 2MB.";
            $_SESSION['icon'] = "error";
            header('Location: ' . APP_URL . "/admin/registrations/create.php");
            exit();
        }
    
        // Validaciones de la imagen
        $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
        if ($check !== false) {
            // Subir el archivo
            if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
                // Guardar la URL relativa en la base de datos
                $profile_picture = "uploads/profile_pictures/" . $unique_file_name; // Guardar el nombre único
            } else {
                session_start();
                $_SESSION['message'] = "Error al subir la imagen.";
                $_SESSION['icon'] = "error";
                header('Location: ' . APP_URL . "/admin/registrations/create.php");
                exit();
            }
        } else {
            session_start();
            $_SESSION['message'] = "El archivo no es una imagen válida.";
            $_SESSION['icon'] = "error";
            header('Location: ' . APP_URL . "/admin/registrations/create.php");
            exit();
        }
    }

    // Prepara la sentencia SQL para la inserción de datos en la tabla 'users'
    $judgment = $pdo->prepare('INSERT INTO users(first_name, last_name, rol_id, email, identification_type, cedula, sex, birth_date, marital_status, education, profession, address_user, state_of_residence, municipality, user_password, profile_picture, fyh_creation, user_state,  phone, mobile, emergency_contact) 
    VALUES (:first_name, :last_name, :rol_id, :email, :identification_type, :cedula, :sex, :birth_date, :marital_status, :education, :profession, :address_user, :state_of_residence, :municipality, :user_password, :profile_picture, :fyh_creation, :user_state,  :phone, :mobile, :emergency_contact)');
    
    // Enlazar los valores
    $judgment->bindParam(':first_name', $first_name);
    $judgment->bindParam(':last_name', $last_name);
    $judgment->bindParam(':rol_id', $rol_id);
    $judgment->bindParam(':email', $email);
    $judgment->bindParam(':identification_type', $identification_type);
    $judgment->bindParam(':cedula', $cedula);
    $judgment->bindParam(':sex', $sex);
    $judgment->bindParam(':birth_date', $birth_date);
    $judgment->bindParam(':marital_status', $marital_status);
    $judgment->bindParam(':education', $education);
    $judgment->bindParam(':profession', $profession);
    $judgment->bindParam(':address_user', $address_user);
    $judgment->bindParam(':state_of_residence', $state_of_residence);
    $judgment->bindParam(':municipality', $municipality);
    $judgment->bindParam(':user_password', $user_password_hashed);
    $judgment->bindParam(':profile_picture', $profile_picture);
    $judgment->bindParam(':fyh_creation', $fyh_creation);
    $judgment->bindParam(':user_state', $registration_status);
    $judgment->bindParam(':phone', $phone);
    $judgment->bindParam(':mobile', $mobile);
    $judgment->bindParam(':emergency_contact', $emergency_contact);

    try {
        // Ejecutar la sentencia SQL
        if ($judgment -> execute()) {
            // Obtener el id_user del nuevo registro
            $user_id = $pdo->lastInsertId();

            // Según el rol recibido, insertar en la tabla correspondiente
            if ($rol_category == 'admin') {
                $stmt = $pdo->prepare('INSERT INTO administrative (user_id, fyh_creation, administrative_state) VALUES (:user_id, NOW(), "1")');
            } elseif ($rol_category == 'teacher') {
                $stmt = $pdo->prepare('INSERT INTO teachers (user_id, fyh_creation, teacher_state) VALUES (:user_id, NOW(), "1")');
            } elseif ($rol_category == 'student') {
                $stmt = $pdo->prepare('INSERT INTO students (user_id, academic_program_id, level_id, fyh_creation, student_state, campus_id) VALUES (:user_id, :academic_program_id, :level_id, NOW(), "1", :campus_id)');
                $stmt->bindParam(':academic_program_id', $academic_program_id);
                $stmt->bindParam(':level_id', $level_id);
                $stmt->bindParam(':campus_id', $campus_id);

            }

            // Ejecutar la sentencia para la tabla correspondiente
            $stmt->bindParam(':user_id', $user_id);
            if ($stmt->execute()) {
                session_start();
                $_SESSION['message'] = "Registro Exitoso.";
                $_SESSION['icon'] = "success";
                header('Location: ' . APP_URL . "/admin/registrations/");
                exit(); 
            } else {
                session_start();
                $_SESSION['message'] = "Error en la vinculación con la tabla correspondiente.";
                $_SESSION['icon'] = "error";
                header('Location: ' . APP_URL . "/admin/registrations/create.php");
                exit(); 
            }
        } else {
            session_start();
            $_SESSION['message'] = "Error en Registro, comuníquese con el administrador";
            $_SESSION['icon'] = "error";
            header('Location: ' . APP_URL . "/admin/registrations/create.php");
            exit(); 
        }
    } catch (\Throwable $th) {
        session_start();
        $_SESSION['message'] = "Este usuario ya se encuentra registrado";
        $_SESSION['icon'] = "error";
        header('Location: ' . APP_URL . "/admin/registrations/create.php");
        exit();
    }
}

?>
