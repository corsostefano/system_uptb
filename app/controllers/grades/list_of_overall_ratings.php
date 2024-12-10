<?php 

// Consulta SQL para obtener toda la información de cada tabla relacionada con assignment
$sql_general_assignments = "
   SELECT 
    asi.*,              
    CONCAT(us.first_name, ' ', us.last_name) AS teacher_name, -- Nombre completo del profesor
    tea.*,               
    us.*,                
    aca.*,
    ma.*,              
    lev.*,              
    cou.*,              
    lc.*                
FROM 
    assignment AS asi
INNER JOIN 
    teachers AS tea ON tea.id_teacher = asi.teacher_id
INNER JOIN 
    users AS us ON us.id_user = tea.user_id
INNER JOIN 
    academic_programs AS aca ON aca.id_academic_programs = asi.academic_programs_id
INNER JOIN 
   managements AS ma ON ma.id_management = aca.management_id
INNER JOIN 
    level_courses AS lc ON lc.id_level_courses = asi.level_courses_id
INNER JOIN 
    levels AS lev ON lev.id_levels = lc.level_id
INNER JOIN 
    courses AS cou ON cou.id_courses = lc.course_id
WHERE 
    asi.assignment_state = 1";  

// Preparar la consulta
$query_general_assignments = $pdo->prepare($sql_general_assignments);

// Ejecutar la consulta
$query_general_assignments->execute();

// Obtener los resultados como un arreglo asociativo
$general_assignments = $query_general_assignments->fetchAll(PDO::FETCH_ASSOC);

?>