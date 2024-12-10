<?php 
$sql_programs = "
    SELECT  ap.*, m.management
    FROM academic_programs AS ap
    JOIN managements AS m ON ap.management_id = m.id_management
   
";
$query_programs = $pdo->prepare($sql_programs);
$query_programs->execute();
$programs = $query_programs->fetchAll(PDO::FETCH_ASSOC);
?>