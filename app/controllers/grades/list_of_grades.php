<?php
 $sql_grades = "
 SELECT gra.*, cou.name_course
FROM grades AS gra
INNER JOIN level_courses AS lc ON lc.id_level_courses = gra.level_courses_id
INNER JOIN courses AS cou ON cou.id_courses = lc.course_id
WHERE gra.grade_state = 1;
 ";
 
 // Prepara la consulta
 $query_grades = $pdo->prepare($sql_grades);

 // Ejecuta la consulta
 $query_grades->execute();

 // Obtiene los resultados como un array asociativo
 $grades = $query_grades->fetchAll(PDO::FETCH_ASSOC);
?>
