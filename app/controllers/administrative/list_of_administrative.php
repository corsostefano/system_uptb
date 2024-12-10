<?php 
$sql_users = "
SELECT users.*, roles.name_rol, administrative.*
FROM users
JOIN roles ON users.rol_id = roles.id_rol
JOIN administrative ON users.id_user = administrative.user_id
WHERE users.user_state = '1' 
AND administrative.administrative_state = 1
";

$query_users = $pdo->prepare($sql_users);
$query_users->execute();
$users_admin = $query_users->fetchAll(PDO::FETCH_ASSOC);
?>
