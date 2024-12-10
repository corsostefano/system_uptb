<?php
    $sql_users = "
        SELECT users.*, roles.name_rol, students.*,  university_campuses.*, academic_programs.*, levels.*
        FROM users
        JOIN roles ON users.rol_id = roles.id_rol
        JOIN students ON users.id_user = students.user_id
        JOIN university_campuses ON students.campus_id = university_campuses.id_campus
        JOIN academic_programs ON students.academic_program_id = academic_programs.id_academic_programs
        JOIN levels ON students.level_id = levels.id_levels
        WHERE users.user_state = '1' 
        AND students.student_state = 1
    ";

    $query_users = $pdo->prepare($sql_users);
    $query_users->execute();
    $users_students = $query_users->fetchAll(PDO::FETCH_ASSOC);
    
?>
