<?php
$id_teacher = filter_input(INPUT_GET, 'id_teacher', FILTER_SANITIZE_NUMBER_INT);
$level_courses_id = filter_input(INPUT_GET, 'level_courses_id', FILTER_SANITIZE_NUMBER_INT);
$course_id = filter_input(INPUT_GET, 'course_id', FILTER_SANITIZE_NUMBER_INT);
$id_assignment = filter_input(INPUT_GET, 'id_assignment', FILTER_SANITIZE_NUMBER_INT);

include('../../app/config.php');
include('../../admin/layout/part_1.php');
include('../../app/controllers/grades/data_student_courses_level.php');
include('../../app/controllers/grades/list_of_grades.php');
?>

<?php if (!empty($students)): ?>
<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <h1>Listado de Estudiantes de la materia: <?= $name_course; ?> - sección: <?= $section; ?></h1>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Estudiantes Registrados</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive-sm">
                                <table id="example1" border="1" class="table table-striped table-bordered table-hover table-sm">
                                    <thead>
                                        <tr class="text-center">
                                            <th class="text-center">Nro</th>
                                            <th class="text-center">Nombre y Apellido</th>
                                            <th class="text-center">Cédula</th>
                                            <th class="text-center">PNF</th>
                                            <th class="text-center">Nivel</th>
                                            <th class="text-center">Materia</th>
                                            <th class="text-center">Sección</th>
                                            <th class="text-center">Asistencia (%)</th>
                                            <th class="text-center">Nota Final (%)</th>
                                            <th class="text-center">Nota Escala 0-20</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        foreach ($students as $student) {
                                            $id_student = $student['id_student'];
                                            $counter_students++;

                                            // Valores predeterminados
                                            $attendance_percentage = 0;
                                            $final_grade_percentage = 0;
                                            $final_grade_scaled = 0;

                                            // Buscar datos de calificaciones
                                            foreach ($grades as $grade) {
                                                if ($grade['assignment_id'] == $id_assignment && $grade['student_id'] == $id_student && $grade['level_courses_id'] == $level_courses_id) {
                                                    $attendance_percentage = $grade['attendance_percentage'];
                                                    $final_grade_percentage = $grade['final_grade_percentage'];
                                                    $final_grade_scaled = ($final_grade_percentage / 100) * 20;
                                                    break;
                                                }
                                            }

                                            // Verificar si el estudiante está reprobado
                                            $is_failed = false;
                                            $failure_reason = "";
                                            if ($attendance_percentage < 75) {
                                                $is_failed = true;
                                                $failure_reason = "Reprobado por asistencia baja.";
                                            } elseif ($final_grade_scaled < 12) {
                                                $is_failed = true;
                                                $failure_reason = "Reprobado por nota final baja.";
                                            }
                                        ?>
                                        <tr>
                                            <td class="text-center"><?= $counter_students; ?></td>
                                            <td class="text-center"><?= $student['first_name'] . ' ' . $student['last_name']; ?></td>
                                            <td class="text-center"><?= $student['identification_type'] . '-' . $student['cedula']; ?></td>
                                            <td class="text-center"><?= $student['programs_name']; ?></td>
                                            <td class="text-center"><?= $student['years_level']; ?></td>
                                            <td class="text-center"><?= $student['name_course']; ?></td>
                                            <td class="text-center"><?= $student['section']; ?></td>
                                            <td class="text-center"><?= htmlspecialchars($attendance_percentage); ?>%</td>
                                            <td class="text-center"><?= htmlspecialchars($final_grade_percentage); ?>%</td>
                                            <td class="text-center"><?= number_format($final_grade_scaled, 2); ?></td>
                                            <td class="text-center">
                                                <?php if ($is_failed): ?>
                                                    <span class="text-danger"><?= $failure_reason; ?></span>
                                                <?php else: ?>
                                                    <span class="text-success">Aprobado</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php else: ?>
    <div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="alert alert-warning text-center" role="alert">
                        <h3><strong>¡Advertencia!</strong></h3>
                        <p>No se encontraron estudiantes inscritos en esta materia.</p>
                        <hr>
                        <p class="mb-0">Por favor, verifica que los filtros sean correctos o intenta con otra búsqueda.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?php
include('../../admin/layout/part_2.php');
include('../../layout/messages.php');
?>
