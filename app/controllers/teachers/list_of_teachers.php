<?php
    $sql_users = "
        SELECT users.*, roles.name_rol, teachers.*
        FROM users
        JOIN roles ON users.rol_id = roles.id_rol
        JOIN teachers ON users.id_user = teachers.user_id
        WHERE users.user_state = '1' 
        AND teachers.teacher_state = 1
    ";

    $query_users = $pdo->prepare($sql_users);
    $query_users->execute();
    $users_teachers = $query_users->fetchAll(PDO::FETCH_ASSOC);
    
?>
