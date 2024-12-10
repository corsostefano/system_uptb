<?php
$id_student = isset($_GET['id_student']) ? intval($_GET['id_student']) : 0;

if ($id_student === 0) {
    die('ID de estudiante no válido.');
}

include('../../app/config.php');
include('../../admin/layout/part_1.php');

// Incluimos controladores si son necesarios
include('../../app/controllers/grades/list_of_grades.php');
?>

<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <h1>Calificaciones del Estudiante</h1>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Calificaciones</h3>
                        </div>
                        <div class="card-body">
                            <table id="grades_table" border="1" class="table table-striped table-bordered table-hover table-sm">
                                <thead>
                                    <tr class="text-center">
                                        <th>Nro</th>
                                        <th>Curso</th>
                                        <th>Nivel</th>
                                        <th>Nota Final (%)</th>
                                        <th>Asistencia (%)</th>
                                        <th>Fecha de Registro</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $sql_grades = "
                                        SELECT 
                                            g.id_grade,
                                            c.name_course AS course_name,
                                            CONCAT(l.years_level, ' ', l.section) AS level_name,
                                            g.final_grade_percentage,
                                            g.attendance_percentage,
                                            g.fyh_creation
                                        FROM grades g
                                        INNER JOIN level_courses lc ON g.level_courses_id = lc.id_level_courses
                                        INNER JOIN courses c ON lc.course_id = c.id_courses
                                        INNER JOIN levels l ON lc.level_id = l.id_levels
                                        WHERE g.student_id = :student_id
                                          AND g.grade_state = 1
                                    ";

                                    $query_grades = $pdo->prepare($sql_grades);
                                    $query_grades->bindParam(':student_id', $id_student, PDO::PARAM_INT);

                                    try {
                                        $query_grades->execute();
                                        $grades = $query_grades->fetchAll(PDO::FETCH_ASSOC);

                                        if (count($grades) > 0):
                                            $counter = 0;
                                            foreach ($grades as $grade):
                                                $counter++;
                                    ?>
                                                <tr>
                                                    <td class="text-center"><?= $counter; ?></td>
                                                    <td class="text-center"><?= htmlspecialchars($grade['course_name']); ?></td>
                                                    <td class="text-center"><?= htmlspecialchars($grade['level_name']); ?></td>
                                                    <td class="text-center"><?= htmlspecialchars($grade['final_grade_percentage']); ?>%</td>
                                                    <td class="text-center"><?= htmlspecialchars($grade['attendance_percentage']); ?>%</td>
                                                    <td class="text-center"><?= htmlspecialchars($grade['fyh_creation']); ?></td>
                                                </tr>
                                    <?php 
                                            endforeach;
                                        else: ?>
                                            <tr>
                                                <td colspan="6" class="text-center">No hay calificaciones registradas para este estudiante.</td>
                                            </tr>
                                    <?php 
                                        endif;
                                    } catch (PDOException $e) {
                                        echo '<tr><td colspan="6" class="text-center text-danger">Error al obtener las calificaciones: ' . htmlspecialchars($e->getMessage()) . '</td></tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('../../admin/layout/part_2.php');
?>
