<?php

if (isset($id_rol)) {
    var_dump($id_rol); 
} else {
    echo "Error: id_rol no está definido.";
}


$sql_roles = "SELECT * FROM roles WHERE rol_state = '1' AND id_rol = :id_rol";
$query_roles = $pdo->prepare($sql_roles);
$query_roles->bindParam(':id_rol', $id_rol, PDO::PARAM_INT); 
$query_roles->execute();
$data_roles = $query_roles->fetchAll(PDO::FETCH_ASSOC);

if (!empty($data_roles)) {
    foreach($data_roles as $data_rol) {
        $name_rol = $data_rol['name_rol'];
        $category = $data_rol['category'];
    }
} else {
    echo "No se encontró ningún rol con id_rol = $id_rol.";
}
?>