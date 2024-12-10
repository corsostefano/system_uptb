<?php
include ('../../../app/config.php');

session_start();
$id_user = $_POST['id_user'];
$first_name = mb_convert_case($_POST['first_name'], MB_CASE_TITLE, "UTF-8");
$last_name = mb_convert_case($_POST['last_name'], MB_CASE_TITLE, "UTF-8");
$rol_id = $_POST['rol_id'];
$email = $_POST['email'];
$identification_type = $_POST['identification_type'];
$cedula = $_POST['cedula'];
$sex = $_POST['sex'];
$marital_status = $_POST['marital_status'];
$birth_date = $_POST['birth_date'];
$university_campus = $_POST['university_campus'];
$education = $_POST['education'];
$profession = $_POST['profession'];
$address_user = $_POST['address_user'];
$state_of_residence = $_POST['state_of_residence'];
$municipality = $_POST['municipality'];
$specialty = $_POST['specialty'];
$seniority = $_POST['seniority'];
$user_state = isset($_POST['user_state']) && $_POST['user_state'] == 0 ? 0 : 1; // Establecer el estado de usuario como 1 (activo) o 0 (inactivo)
$rol_category = $_POST['rol_category'];
$phone = $_POST['phone'];
$mobile = $_POST['mobile'];
$emergency_contact = $_POST['emergency_contact'];
// Inicializa la variable para la nueva contraseña
$new_password = null;

// Hash de la contraseña si está presente y coincide

    $new_password = password_hash($cedula, PASSWORD_DEFAULT);


// Consultar la imagen actual del usuario 

try {
    $query = $pdo->prepare('SELECT profile_picture FROM users WHERE id_user = :id_user');
    $query->bindParam(':id_user', $id_user);
    $query->execute();
    $user = $query->fetch(PDO::FETCH_ASSOC);

    $current_picture = $user ? $user['profile_picture'] : null;
} catch (\Throwable $th) {
    $_SESSION['message'] = "Error al obtener la imagen actual.";
    $_SESSION['icon'] = "error";
    ?><script>window.history.back();</script><?php
    exit;
}

// Proceso para subir la imagen de perfil
$profile_picture = null;
if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == UPLOAD_ERR_OK) {
    $target_dir = __DIR__ . '/../../../uploads/profile_pictures/';

    // Generar un nombre único para el archivo
    $image_file_type = strtolower(pathinfo($_FILES["profile_picture"]["name"], PATHINFO_EXTENSION));
    $unique_file_name = uniqid('profile_', true) . '.' . $image_file_type; // Prefijo único para evitar nombres duplicados
    $target_file = $target_dir . $unique_file_name;

    // Validación de tamaño (2 MB máximo)
    $max_file_size = 2 * 1024 * 1024; // 2 MB en bytes
    if ($_FILES["profile_picture"]["size"] > $max_file_size) {
        $_SESSION['message'] = "La imagen supera el tamaño máximo permitido de 2MB.";
        $_SESSION['icon'] = "error";
        ?><script>window.history.back();</script><?php
        exit;
    }

      // Validaciones de la imagen
      $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
      if ($check !== false) {
          // Eliminar la imagen anterior si existe
          if ($current_picture && file_exists(__DIR__ . '/../../../' . $current_picture)) {
              unlink(__DIR__ . '/../../../' . $current_picture);
          }
  
          // Subir el nuevo archivo
          if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
              // Guardar la URL relativa en la base de datos
              $profile_picture = "uploads/profile_pictures/" . $unique_file_name;
          } else {
              $_SESSION['message'] = "Error al subir la imagen.";
              $_SESSION['icon'] = "error";
              ?><script>window.history.back();</script><?php
              exit;
          }
      } else {
          $_SESSION['message'] = "El archivo no es una imagen válida.";
          $_SESSION['icon'] = "error";
          ?><script>window.history.back();</script><?php
          exit;
      }
}


try {
    // Comienza una transacción para garantizar que ambas operaciones se completen exitosamente
    $pdo->beginTransaction();
    
    // Actualizar los datos básicos del usuario en la tabla `users`
    $sql = 'UPDATE users SET 
                first_name = :first_name,
                last_name = :last_name,
                rol_id = :rol_id,
                email = :email,
                identification_type = :identification_type,
                cedula = :cedula,
                sex = :sex,
                birth_date = :birth_date,
                marital_status = :marital_status,
                university_campus = :university_campus,
                education = :education,
                profession = :profession,
                address_user = :address_user,
                state_of_residence = :state_of_residence,
                municipality = :municipality,
                phone = :phone,
                mobile = :mobile,
                emergency_contact = :emergency_contact,
                user_password = COALESCE(:user_password, user_password),
                profile_picture = COALESCE(:profile_picture, profile_picture),
                fyh_update = NOW(),
                user_state = :user_state
            WHERE id_user = :id_user';

    $judgment = $pdo->prepare($sql);

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
    $judgment->bindParam(':university_campus', $university_campus);
    $judgment->bindParam(':education', $education);
    $judgment->bindParam(':profession', $profession);
    $judgment->bindParam(':address_user', $address_user);
    $judgment->bindParam(':state_of_residence', $state_of_residence);
    $judgment->bindParam(':municipality', $municipality);
    $judgment->bindParam(':user_password', $new_password);
    $judgment->bindParam(':profile_picture', $profile_picture);
    $judgment->bindParam(':user_state', $user_state);
    $judgment->bindParam(':id_user', $id_user);
    $judgment->bindParam(':phone', $phone);
    $judgment->bindParam(':mobile', $mobile);
    $judgment->bindParam(':emergency_contact', $emergency_contact);

    // Ejecutar la actualización
    if ($judgment->execute()) {
        
        // Eliminar relaciones anteriores en tablas relacionadas
        $deleteAdmin = $pdo->prepare('DELETE FROM administrative WHERE user_id = :id_user');
        $deleteTeacher = $pdo->prepare('DELETE FROM teachers WHERE user_id = :id_user');
        $deleteStudent = $pdo->prepare('DELETE FROM students WHERE user_id = :id_user');
        
        $deleteAdmin->bindParam(':id_user', $id_user);
        $deleteTeacher->bindParam(':id_user', $id_user);
        $deleteStudent->bindParam(':id_user', $id_user);
        
        $deleteAdmin->execute();
        $deleteTeacher->execute();
        $deleteStudent->execute();

        // Insertar en la tabla correspondiente según el rol
        if ($rol_category == 'admin') {
            $stmt = $pdo->prepare('INSERT INTO administrative (user_id, fyh_creation, administrative_state) VALUES (:user_id, NOW(), "1")');
        } elseif ($rol_category == 'teacher') {
            $stmt = $pdo->prepare('INSERT INTO teachers (user_id, fyh_creation, teacher_state,  specialty, seniority) VALUES (:user_id, NOW(), "1", :specialty, :seniority)');
            $stmt->bindParam(':specialty', $specialty);
            $stmt->bindParam(':seniority', $seniority);

        } elseif ($rol_category == 'student') {
            $stmt = $pdo->prepare('INSERT INTO students (user_id, fyh_creation, student_state) VALUES (:user_id, NOW(), "1")');
        }

        // Ejecutar la sentencia para la tabla correspondiente
        $stmt->bindParam(':user_id', $id_user);
        if ($stmt->execute()) {
            // Confirmar transacción
            $pdo->commit();
            session_start();
                $_SESSION['message'] = "Registro Exitoso.";
                $_SESSION['icon'] = "success";
                header('Location: ' . APP_URL . "/admin/teachers/");
            exit(); 
        } else {
            // Si falla la inserción en tabla relacionada, revertir cambios
            $pdo->rollBack();
            $_SESSION['message'] = "Error en la vinculación con la tabla correspondiente.";
            $_SESSION['icon'] = "error";
        }
    } else {
        $_SESSION['message'] = "Error en Actualización, comuníquese con el administrador";
        $_SESSION['icon'] = "error";
    }
} catch (\Throwable $th) {
    $pdo->rollBack();
    $_SESSION['message'] = "Error en el proceso de actualización.";
    $_SESSION['icon'] = "error";
}

// Redirección o retroceso después de la ejecución
?><script>window.history.back();</script><?php
?>
