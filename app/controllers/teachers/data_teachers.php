<?php 
include ('../../../app/config.php');

$id_user = isset($id_user) ? $id_user : null;

$sql_users = "
SELECT users.*, roles.name_rol, teachers.*
FROM users
JOIN roles ON users.rol_id = roles.id_rol
JOIN teachers ON users.id_user = teachers.user_id
WHERE users.user_state = '1' 
AND users.id_user = :id_user
AND teachers.teacher_state = 1
";

$query_users = $pdo->prepare($sql_users);
$query_users->bindParam('id_user', $id_user, PDO::PARAM_INT);

if($query_users->execute()){
    $users = $query_users->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($users as $user){
        // Datos del usuario
        $first_name = $user['first_name'];
        $last_name = $user['last_name'];
        $rol_id = $user['rol_id'];
        $name_rol = $user['name_rol'];
        $email = $user['email'];
        $identification_type = $user['identification_type'];
        $cedula = $user['cedula'];
        $birth_date = $user['birth_date'];
        $profile_picture = $user['profile_picture'];
        $fyh_creation = $user['fyh_creation'];
        $user_state = $user['user_state'];
        $sex = $user['sex'];
        $marital_status = $user['marital_status'];
        $university_campus = $user['university_campus'];
        $education = $user['education'];
        $profession = $user['profession'];
        $address_user = $user['address_user'];
        $state_of_residence = $user['state_of_residence'];
        $municipality = $user['municipality'];
        $user_password = $user['user_password'];
        $category = $user['category'];
        $phone = $user['phone'];
        $mobile = $user['mobile'];
        $emergency_contact = $user['emergency_contact'];

        // Datos del profesor (de la tabla 'teachers')
        $fyh_creation_teacher = $user['fyh_creation'];  // De la tabla 'teachers'
        $fyh_update_teacher = $user['fyh_update'];      // De la tabla 'teachers'
        $teacher_state = $user['teacher_state'];
        $specialty = $user['specialty'];  
        $seniority = $user['seniority'];      
    }
}else{
    session_start();
    $_SESSION['message'] = "Error en la consulta";
    $_SESSION['icon'] = "error";
    header('Location: ' . APP_URL . "/admin/users/list_of_users.php");
    exit(); 
}
?>
