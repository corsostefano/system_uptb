<?php
// Conexion a la base de datos (configuración ya incluida en config.php)
include('../../app/config.php');


    // Consulta SQL para obtener las materias asociadas
    $sql_courses = " 
    SELECT 
        c.name_course, 
        l.years_level, 
        l.academic_programs_id, 
        ap.programs_name, 
        l.section,      
        ap.shift,        
        lc.fyh_creation, 
        lc.level_courses_state,
        lc.id_level_courses
    FROM level_courses AS lc
    JOIN courses AS c ON lc.course_id = c.id_courses
    JOIN levels AS l ON lc.level_id = l.id_levels
    JOIN academic_programs AS ap ON l.academic_programs_id = ap.id_academic_programs
";

    $query_courses = $pdo->prepare($sql_courses);
    $query_courses->execute();

    // Obtener los resultados en un array asociativo
    $associations = $query_courses->fetchAll(PDO::FETCH_ASSOC);

  

?>
