
<?php 
include ('../../config.php');

$sql_courses_association = 
  "SELECT 
    lc.id_level_courses,
    lc.course_id,
    lc.level_id,
    lc.fyh_creation,
    lc.fyh_update,
    lc.level_courses_state,
    c.name_course,
    l.years_level,
    l.section,
    l.levels_state,
    a.programs_name,
    a.shift,
    m.management
FROM 
    level_courses AS lc
JOIN 
    courses AS c ON lc.course_id = c.id_courses
JOIN 
    levels AS l ON lc.level_id = l.id_levels
JOIN 
    academic_programs AS a ON l.academic_programs_id = a.id_academic_programs
JOIN
    managements AS m ON a.management_id = m.id_management
WHERE 
    lc.id_level_courses = :id_level_courses
    AND lc.level_courses_state = 1
    AND l.levels_state = 1
    AND c.course_state = 1
    AND a.programs_state = 1
    ";

$query_courses_association = $pdo->prepare($sql_courses_association);
$query_courses_association->bindParam(':id_level_courses', $id_level_courses, PDO::PARAM_INT);

if ($query_courses_association->execute()) {
    $level_courses_data = $query_courses_association->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($level_courses_data as $level_course) {
        $course_id = $level_course['course_id'];
        $level_id = $level_course['level_id'];
        $name_course = $level_course['name_course'];
        $years_level = $level_course['years_level'];
        $programs_name = $level_course['programs_name'];
        $level_courses_state = $level_course['level_courses_state'];
        $fyh_creation = $level_course['fyh_creation'];
        $fyh_update = $level_course['fyh_update'];
        $level_courses_state = $level_course['level_courses_state'];
        $section = $level_course['section'];
        $shift = $level_course['shift'];
        $management = $level_course['management'];
      
    }
} else {
    session_start();
    $_SESSION['message'] = "Error en la consulta";
    $_SESSION['icon'] = "error";
    header('Location: ' . APP_URL . "/admin/courses/");
    exit(); 
}
?>
