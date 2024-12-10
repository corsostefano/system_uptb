<?php
$id_student = isset($_GET['id_student']) ? intval($_GET['id_student']) : 0;

if ($id_student === 0) {
    die('ID de estudiante no válido.');
}

include('../../app/config.php');
include('../../admin/layout/part_1.php');

// Incluimos los controladores si son necesarios para otras partes del código
include('../../app/controllers/grades/data_student_courses_level.php');
include('../../app/controllers/grades/list_of_grades.php');
?>

<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <h1>Reportes del Estudiante</h1>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Reportes del Estudiante</h3>
                        </div>
                        <div class="card-body">
                            <table id="example1" border="1" class="table table-striped table-bordered table-hover table-sm">
                                <thead>
                                    <tr class="text-center">
                                        <th class="text-center">Nro</th>
                                        <th class="text-center">Nombre y Apellido</th>
                                        <th class="text-center">Cédula</th>
                                        <th class="text-center">Fecha</th>
                                        <th class="text-center">Observaciones</th>
                                        <th class="text-center">Notas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $sql_report_student = "
                                   SELECT 
                                        ah.id_academic_history, 
                                        ah.observations, 
                                        ah.note, 
                                        ah.fyh_creation, 
                                        u.first_name, 
                                        u.last_name, 
                                        u.identification_type, 
                                        u.cedula
                                    FROM 
                                        academic_history ah
                                    INNER JOIN 
                                        students s ON ah.student_id = s.id_student
                                    INNER JOIN 
                                        users u ON s.user_id = u.id_user
                                    WHERE 
                                        ah.academic_history_state = 1
                                        AND ah.student_id = :student_id
                                     
                                    ";

                                    $query_report_student = $pdo->prepare($sql_report_student);
                                    $query_report_student->bindParam(':student_id', $id_student, PDO::PARAM_INT);
                                   

                                    try {
                                        $query_report_student->execute();
                                        $reports = $query_report_student->fetchAll(PDO::FETCH_ASSOC);

                                        if (count($reports) > 0):
                                            $counter_reports = 0;
                                            foreach ($reports as $report_student):
                                                $counter_reports++;
                                    ?>
                                                <tr>
                                                    <td class="text-center"><?= $counter_reports; ?></td>
                                                    <td class="text-center"><?= htmlspecialchars($report_student['first_name'].' '.$report_student['last_name']); ?></td>
                                                    <td class="text-center"><?= htmlspecialchars($report_student['identification_type'].'-'.$report_student['cedula']); ?></td>
                                                    <td class="text-center"><?= htmlspecialchars($report_student['fyh_creation']); ?></td>
                                                    <td class="text-center"><?= htmlspecialchars($report_student['observations'] ?? 'Sin observaciones'); ?></td>
                                                    <td class="text-center"><?= htmlspecialchars($report_student['note'] ?? 'Sin notas'); ?></td>
                                                </tr>
                                    <?php 
                                            endforeach;
                                        else: ?>
                                            <tr>
                                                <td colspan="6" class="text-center">No hay reportes disponibles para este estudiante.</td>
                                            </tr>
                                    <?php 
                                        endif;
                                    } catch (PDOException $e) {
                                        echo '<tr><td colspan="6" class="text-center text-danger">Error al obtener reportes: ' . htmlspecialchars($e->getMessage()) . '</td></tr>';
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
include('../../layout/messages.php');
?>
