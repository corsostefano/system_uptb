<?php 
$sql_institutions = "
    SELECT *
    FROM institutions_configuration
    WHERE institution_state = '1'
";

$query_institutions = $pdo->prepare($sql_institutions);
$query_institutions->execute();
$institutions = $query_institutions->fetchAll(PDO::FETCH_ASSOC);
?>
