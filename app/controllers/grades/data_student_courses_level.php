<?php 
$sql = "
SELECT 
    s.id_student,
    s.user_id,
    s.academic_program_id, 
    s.level_id, 
    s.campus_id, 
    s.fyh_creation, 
    s.fyh_update, 
    s.student_state,
    c.name_course,
    l.section,
    u.first_name,
    u.last_name,
    u.email,
    u.identification_type,
    u.cedula,
    ap.programs_name,
    ap.shift,
    l.years_level
FROM 
    students s
INNER JOIN users u ON s.user_id = u.id_user
INNER JOIN levels l ON s.level_id = l.id_levels
INNER JOIN level_courses lc ON l.id_levels = lc.level_id
INNER JOIN courses c ON lc.course_id = c.id_courses
INNER JOIN academic_programs ap ON s.academic_program_id = ap.id_academic_programs
WHERE 
    lc.id_level_courses = :level_courses_id;
";

// Preparar y ejecutar la consulta
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':level_courses_id', $level_courses_id, PDO::PARAM_INT);

$stmt->execute(); 
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($students as $student){
    $name_course = $student['name_course'];
    $section = $student['section'];
}


?>