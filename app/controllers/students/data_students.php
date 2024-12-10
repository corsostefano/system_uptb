<?php 
include ('../../../app/config.php');

$id_user = isset($id_user) ? $id_user : null;

$sql_users = "
SELECT 
    users.*, 
    roles.name_rol, 
    students.*, 
    university_campuses.name_campus, 
    university_campuses.address AS campus_address,
    academic_programs.programs_name,
    academic_programs.shift,
    levels.years_level,
    levels.section
FROM users
JOIN roles ON users.rol_id = roles.id_rol
JOIN students ON users.id_user = students.user_id
JOIN university_campuses ON students.campus_id = university_campuses.id_campus
JOIN academic_programs ON students.academic_program_id = academic_programs.id_academic_programs
JOIN levels ON students.level_id = levels.id_levels
WHERE users.user_state = '1' 
AND users.id_user = :id_user
AND students.student_state = 1
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

        // Nuevos campos de la tabla 'students', 'university_campuses', 'academic_programs' y 'levels'
        $academic_program_id = $user['academic_program_id'];
        $level_id = $user['level_id'];
        $campus_id = $user['campus_id'];
        $fyh_creation_student = $user['fyh_creation'];  // De la tabla 'students'
        $fyh_update_student = $user['fyh_update'];      // De la tabla 'students'
        $student_state = $user['student_state'];        // De la tabla 'students'

        // Información del campus
        $campus_name = $user['name_campus'];
        $campus_address = $user['campus_address'];  // Dirección del campus

        // Información del programa académico y nivel
        $programs_name = $user['programs_name'];  
        $shift = $user['shift'];
        $years_level = $user['years_level']; 
        $section = $user['section'];
    }
}else{
    session_start();
    $_SESSION['message'] = "Error en la consulta";
    $_SESSION['icon'] = "error";
    header('Location: ' . APP_URL . "/admin/users/list_of_users.php");
    exit(); 
}


?>
