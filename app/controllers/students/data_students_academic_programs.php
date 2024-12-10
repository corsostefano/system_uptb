<?php 
$sql_programs = "
SELECT 
    ap.programs_name, 
    COUNT(s.id_student) AS student_count,
    (COUNT(s.id_student) * 100.0 / (SELECT COUNT(*) FROM students WHERE student_state = 1)) AS percentage
FROM students s
JOIN academic_programs ap ON s.academic_program_id = ap.id_academic_programs
WHERE s.student_state = 1
GROUP BY ap.programs_name;
";

$query_programs = $pdo->prepare($sql_programs);

if ($query_programs->execute()) {
    $programs = $query_programs->fetchAll(PDO::FETCH_ASSOC);

    // Procesar datos para el gráfico
    $program_names = [];
    $percentages = [];
    foreach ($programs as $program) {
        $program_names[] = $program['programs_name'];
        $percentages[] = $program['percentage'];
    }
} else {
    echo "Error en la consulta de programas académicos.";
    exit();
}



?>