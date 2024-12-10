<?php 
include ('../../config.php');



$sql_courses = "
SELECT * FROM courses WHERE id_courses = :id_courses ";

$query_courses = $pdo->prepare($sql_courses);
$query_courses->bindParam(':id_courses', $id_courses, PDO::PARAM_INT);

if ($query_courses->execute()) {
    $institutions = $query_courses->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($institutions as $course) {
        $name_course = $course['name_course'];
        $course_state = $course['course_state'];
        $fyh_creation = $course['fyh_creation'];
        $fyh_update = $course['fyh_update'];
      
    }
} else {
    session_start();
    $_SESSION['message'] = "Error en la consulta";
    $_SESSION['icon'] = "error";
    header('Location: ' . APP_URL . "/admin/courses/");
    exit(); 
}
?>
