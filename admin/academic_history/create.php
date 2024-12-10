<?php
$id_teacher = filter_input(INPUT_GET, 'id_teacher', FILTER_SANITIZE_NUMBER_INT);
$level_courses_id = filter_input(INPUT_GET, 'level_courses_id', FILTER_SANITIZE_NUMBER_INT);
$course_id = filter_input(INPUT_GET, 'course_id', FILTER_SANITIZE_NUMBER_INT);
$id_assignment = filter_input(INPUT_GET, 'id_assignment', FILTER_SANITIZE_NUMBER_INT);

include('../../app/config.php');
include('../../admin/layout/part_1.php');

// Incluimos los controladores
include('../../app/controllers/grades/data_student_courses_level.php');
include('../../app/controllers/grades/list_of_grades.php');
?>

<?php if (!empty($students)): ?>
    <div class="content-wrapper">
        <br>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <h1>Listado de Estudiantes de la materia: <?=$name_course;?> - sección: <?=$section;?></h1>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Estudiantes Registrados</h3>
                            </div>
                            <div class="card-body">
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
                                            <th class="text-center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $counter_students = 0;
                                        foreach ($students as $student):
                                            $id_student = $student['id_student'];
                                            $counter_students++;
                                            
                                            // Consulta para obtener las observaciones y notas del estudiante
                                            $sql_report_student = "
                                            SELECT observations, note
                                            FROM academic_history
                                            WHERE academic_history_state = 1
                                              AND level_courses_id = :level_courses_id
                                              AND student_id = :student_id
                                              AND assignment_id = :assignment_id
                                            ";
                                            
                                            $query_report_student = $pdo->prepare($sql_report_student);
                                            $query_report_student->bindParam(':level_courses_id', $level_courses_id, PDO::PARAM_INT);
                                            $query_report_student->bindParam(':student_id', $id_student, PDO::PARAM_INT);
                                            $query_report_student->bindParam(':assignment_id', $id_assignment, PDO::PARAM_INT);
                                            $query_report_student->execute();
                                            
                                            $report_student = $query_report_student->fetch(PDO::FETCH_ASSOC);
                                        ?>
                                            <tr>
                                                <td class="text-center"><?=$counter_students;?></td>
                                                <input type="text" id="student_<?=$counter_students;?>" value="<?=$id_student;?>" hidden>
                                                <td class="text-center"><?=$student['first_name'].' '.$student['last_name'];?></td>
                                                <td class="text-center"><?=$student['identification_type'].'-'.$student['cedula'];?></td>
                                                <td class="text-center"><?=$student['programs_name'];?></td>
                                                <td class="text-center"><?=$student['years_level'];?></td>
                                                <td class="text-center"><?=$student['name_course'];?></td>
                                                <td class="text-center"><?=$student['section'];?></td>
                                                <td class="text-center">
                                                    <!-- Botón para abrir el modal -->
                                                    <button type="button" class="btn btn-sm" style="background-color: #dd3e6d; color:white" data-toggle="modal" data-target="#modal_grades<?=$id_student;?>">
                                                        <i class="bi bi-exclamation-triangle"></i> Reportar
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="modal_grades<?=$id_student;?>" tabindex="-1" aria-labelledby="modalLabel<?=$id_student;?>" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header" style="background-image: linear-gradient(60deg, #29323c 0%, #485563 100%); color: white">
                                                                    <h5 class="modal-title" id="modalLabel<?=$id_student;?>">Reportar estudiante</h5>
                                                                    <button type="button"  style="color:red" class="btn btn-sm close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true"><i class="bi bi-x-square-fill"></i></span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <h4><b><?=$student['first_name'].' '.$student['last_name'].' '.$student['identification_type'].'-'.$student['cedula'];?></b></h4>
                                                                    <hr>
                                                                    <form action="../../app/controllers/academic_history/create_update_report.php" method="POST">
                                                                        <input type="hidden" name="student_id" value="<?=$id_student;?>">
                                                                        <input type="hidden" name="level_courses_id" value="<?=$level_courses_id;?>">
                                                                        <input type="hidden" name="assignment_id" value="<?=$id_assignment;?>">

                                                                        <div class="form-group">
                                                                            <label for="observations<?=$id_student;?>">Observaciones:</label>
                                                                            <input type="text" class="form-control" id="observations<?=$id_student;?>" name="observations" 
                                                                                value="<?= isset($report_student['observations']) ? htmlspecialchars($report_student['observations']) : ''; ?>" 
                                                                                maxlength="255" placeholder="Ingrese observaciones">
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label for="notes<?=$id_student;?>">Notas:</label>
                                                                            <textarea class="form-control" id="notes<?=$id_student;?>" name="notes" rows="4" placeholder="Ingrese notas detalladas">
                                                                                <?= isset($report_student['note']) ? htmlspecialchars($report_student['note']) : ''; ?>
                                                                            </textarea>
                                                                        </div>

                                                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                                                        <button type="button" class="btn btn-secondary" class="close" data-dismiss="modal" aria-label="Close">Cerrar</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Reportes de Estudiantes</h3>
                    </div>
                    <div class="card-body">
                        <table id="example1" border="1" class="table table-striped table-bordered table-hover table-sm">
                            <thead>
                                <tr class="text-center">
                                    <th class="text-center">Nro</th>
                                    <th class="text-center">Nombre y Apellido</th>
                                    <th class="text-center">cédula</th>
                                    <th class="text-center">Fecha</th>
                                    <th class="text-center">Observaciones</th>
                                    <th class="text-center">Notas</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $counter_reports = 0;

                                foreach ($students as $student):
                                    $id_student = $student['id_student'];

                                    // Consulta para obtener las observaciones y notas del estudiante
                                    $sql_report_student = "
                                    SELECT id_academic_history, observations, note, fyh_creation 
                                    FROM academic_history
                                    WHERE academic_history_state = 1
                                    AND level_courses_id = :level_courses_id
                                    AND student_id = :student_id
                                    AND assignment_id = :assignment_id
                                    ";

                                    $query_report_student = $pdo->prepare($sql_report_student);
                                    $query_report_student->bindParam(':level_courses_id', $level_courses_id, PDO::PARAM_INT);
                                    $query_report_student->bindParam(':student_id', $id_student, PDO::PARAM_INT);
                                    $query_report_student->bindParam(':assignment_id', $id_assignment, PDO::PARAM_INT);
                                    

                                    try {
                                        $query_report_student->execute();
                                        $report_student = $query_report_student->fetch(PDO::FETCH_ASSOC);

                                        if ($report_student):
                                            $counter_reports++;
                                            $report_id = $report_student['id_academic_history'];
                                ?>
                                            <tr>
                                                <td class="text-center"><?=$counter_reports;?></td>
                                                <td class="text-center"><?=$student['first_name'].' '.$student['last_name'];?></td>
                                                <td class="text-center"><?=$student['identification_type'].'-'.$student['cedula'];?></td>
                                                <td class="text-center"><?=$student['fyh_creation'];?></td>
                                                <td class="text-center">
                                                    <?= htmlspecialchars($report_student['observations'] ?? 'Sin observaciones'); ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= htmlspecialchars($report_student['note'] ?? 'Sin notas'); ?>
                                                </td>
                                                <td class="text-center">
                                                    <!-- Botón Delete -->
                                                   
                                                    <form action="<?=APP_URL;?>/app/controllers/academic_history/delete.php" method="post" onsubmit="return confirmDeletion(event, this);" >
                                                            <input type="text" name="report_id" value="<?=$report_id;?>" hidden>
                                                            <button type="submit" class="btn btn-danger btn-sm" style="border-radius: 0px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Borrar"><i class="bi bi-trash3"></i></button>
                                                        </form>
                                                </td>
                                            </tr>
                                <?php 
                                        endif; // Fin del if $report_student
                                    } catch (PDOException $e) {
                                        // Manejo de errores
                                        echo '<tr><td colspan="6" class="text-center text-danger">Error al obtener reportes: ' . htmlspecialchars($e->getMessage()) . '</td></tr>';
                                    }
                                endforeach;

                                // Si no hay reportes encontrados
                                if ($counter_reports === 0): ?>
                                    <tr>
                                        <td colspan="6" class="text-center">No hay reportes disponibles.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>

                        </table>
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
                <div class="row">
                    <h1>No se encontraron estudiantes inscritos en esta materia.</h1>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php
include('../../admin/layout/part_2.php');
include('../../layout/messages.php');
?>
