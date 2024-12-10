<?php 
$sql_users = "
SELECT users.*, roles.name_rol
FROM users
JOIN roles On users.rol_id = roles.id_rol
WHERE users.user_state = '1'

";

$query_users = $pdo->prepare($sql_users);
$query_users->execute();
$users = $query_users->fetchAll(PDO::FETCH_ASSOC);
?>