<?php 
$sql_courses = "SELECT * FROM courses ";
$query_courses = $pdo->prepare($sql_courses);
$query_courses->execute();
$courses = $query_courses->fetchAll(PDO::FETCH_ASSOC);
?>