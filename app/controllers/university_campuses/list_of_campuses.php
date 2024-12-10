<?php 
$sql_campuses = "SELECT * FROM university_campuses WHERE campus_state = '1'";
$query_campuses = $pdo->prepare($sql_campuses);
$query_campuses->execute();
$campuses = $query_campuses->fetchAll(PDO::FETCH_ASSOC);
?>