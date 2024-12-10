<?php 

$sql_permissions = "SELECT * FROM permissions where permission_state= '1' AND id_permission = '$id_permission' ";
$query_permissions = $pdo->prepare($sql_permissions);
$query_permissions->execute();
$permissions = $query_permissions->fetchAll(PDO::FETCH_ASSOC);

foreach($permissions as $permission){
    $name_url = $permission['name_url'];         
    $url = $permission['url'];      
};

?>