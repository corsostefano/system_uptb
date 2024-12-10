<?php 
$sql_roles_permissions = "SELECT * FROM  roles_permissions  as rolper
                            INNER JOIN permissions as per ON per.id_permission = rolper.permission_id
                            INNER JOIN roles as rol ON rol.id_rol = rolper.rol_id
                            where rolper.roles_permissions_state = '1' ORDER BY per.name_url ASC
                            ";
$query_roles_permissions = $pdo->prepare($sql_roles_permissions);
$query_roles_permissions->execute();
$roles_permissions = $query_roles_permissions->fetchAll(PDO::FETCH_ASSOC);
?>