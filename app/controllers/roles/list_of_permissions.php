<?php 
$sql_permissions = "SELECT * FROM permissions where permission_state= '1' ORDER BY name_url asc";
$query_permissions = $pdo->prepare($sql_permissions);
$query_permissions->execute();
$permissions = $query_permissions->fetchAll(PDO::FETCH_ASSOC);
?>