<?php 
// Consulta SQL para obtener el conteo de estudiantes por año y mes
$sql_students_by_month = "
SELECT 
    YEAR(fyh_creation) AS year,
    MONTH(fyh_creation) AS month,
    COUNT(id_student) AS total_students
FROM students
WHERE student_state = 1  -- Solo contar estudiantes activos
GROUP BY YEAR(fyh_creation), MONTH(fyh_creation)
ORDER BY year, month;
";

// Preparar la consulta utilizando PDO
$query_students_by_month = $pdo->prepare($sql_students_by_month);

// Ejecutar la consulta
if ($query_students_by_month->execute()) {
    $students_by_month = $query_students_by_month->fetchAll(PDO::FETCH_ASSOC);

    // Procesar los datos para el gráfico o visualización
    $years = [];
    $months = [];
    $total_students = [];
    
    foreach ($students_by_month as $row) {
        // Almacenar los resultados por año y mes
        $years[] = $row['year'];
        $months[] = $row['month'];
        $total_students[] = $row['total_students'];
    }

    // Opcional: puedes hacer más procesamiento si es necesario, como convertir los meses a nombres, etc.
} else {
    echo "Error en la consulta de estudiantes por mes.";
    exit();
}

// Aquí puedes continuar con el uso de los datos procesados, por ejemplo, para mostrar o graficar.
?>
