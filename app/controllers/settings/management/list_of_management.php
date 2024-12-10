<?php 
$sql_managements = "
    SELECT *
    FROM managements
";

$query_managements = $pdo->prepare($sql_managements);
$query_managements->execute();
$managements = $query_managements->fetchAll(PDO::FETCH_ASSOC);
?>
