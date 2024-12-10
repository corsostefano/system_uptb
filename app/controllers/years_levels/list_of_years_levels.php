<?php 
$sql_levels = "
    SELECT ap.*, l.*
    FROM levels AS l
    JOIN academic_programs AS ap ON l.academic_programs_id = ap.id_academic_programs
";
$query_levels = $pdo->prepare($sql_levels);
$query_levels->execute();
$levels = $query_levels->fetchAll(PDO::FETCH_ASSOC);
?>
