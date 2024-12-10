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
                            <h1>Listado de Estudiantes de la materia: <?=$name_course;?> - sección: <?=$section;?></h1>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-outline card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Estudiantes Registrados</h3>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-striped table-bordered table-hover table-sm">
                                            <thead>
                                                <tr class="text-center">
                                                    <th class="text-center">Nro</th>
                                                    <th class="text-center">Nombre y Apellido</th>
                                                    <th class="text-center">Cédula</th>
                                                    <th class="text-center">PNF</th>
                                                    <th class="text-center">Nivel</th>
                                                    <th class="text-center">materia</th>
                                                    <th class="text-center">Sección</th>
                                                    <th class="text-center">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $counter_students = 0;

                                                    foreach($students as $student){
                                                        $id_student = $student['id_student'];
                                                        $counter_students++;
                                                        ?>
                                                            <tr>
                                                                <td class="text-center"><?=$counter_students;?></td>
                                                                <input type="text" id="student_<?=$counter_students;?>" value="<?=$id_student;?>" hidden>
                                                                <td class="text-center"><?=$student['first_name'].' '.$student['last_name']?></td>
                                                                <td class="text-center"><?=$student['identification_type'].'-'. $student['cedula']?></td>
                                                                <td class="text-center"><?=$student['programs_name'];?></td>
                                                                <td class="text-center"><?=$student['years_level'];?></td>
                                                                <td class="text-center"><?=$student['name_course'];?></td>
                                                                <td class="text-center"><?=$student['section'];?></td>
                                                                <td class="text-center">
                                                                    <!-- Botón para abrir el modal -->
                                                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_grades<?=$id_student;?>">
                                                                    <i class="bi bi-award-fill"></i> Calificar
                                                                    </button>
                                                                    <!-- Modal -->
                                                                    <div class="modal fade" id="modal_grades<?=$id_student;?>" tabindex="-1" aria-labelledby="modalLabel<?=$id_student;?>" aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header" style="background-image: linear-gradient(60deg, #29323c 0%, #485563 100%); color: white" >
                                                                                    <h5 class="modal-title" id="modalLabel<?=$id_student;?>">Calificar estudiante</h5>
                                                                                    <button class="btn btn-danger btn-sm" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true"><i class="bi bi-x-square-fill"></i></span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body"><h4> <b><?=$student['first_name'].' '.$student['last_name'].' '.$student['identification_type'].'-'. $student['cedula'];?></b></h4>
                                                                                   
                                                                                    <hr>
                                                                                    <form method="POST" action="<?=APP_URL;?>/app/controllers/grades/update_grades.php">
                                                                                        <table class="table">
                                                                                            <thead>
                                                                                                <tr>
                                                                                                    <th>Asistencia %</th>
                                                                                                    <th>Calificación Final %</th>
                                                                                                    <th>Nota Escala 0-20</th>
                                                                                                </tr>
                                                                                            </thead>
                                                                                            <tbody>
                                                                                                <?php 
                                                                                                // Establecer los valores predeterminados antes del bucle
                                                                                                $final_grade_percentage = 0;     
                                                                                                $attendance_percentage = 0;
                                                                                                $final_grade_scaled = 0;

                                                                                                $found = false; // Para comprobar si se encontró información en la base de datos

                                                                                                // Cargar datos de la base de datos si existen
                                                                                                foreach ($grades as $grade) {
                                                                                                    if ($grade['assignment_id'] == $id_assignment && $grade['student_id'] == $id_student && $grade['level_courses_id'] == $level_courses_id) {
                                                                                                        $final_grade_percentage = $grade['final_grade_percentage'];     
                                                                                                        $attendance_percentage = $grade['attendance_percentage'];

                                                                                                        // Calcular la nota final en una escala de 0 a 20
                                                                                                        $final_grade_scaled = ($final_grade_percentage / 100) * 20;

                                                                                                        // Establecer que se encontraron datos
                                                                                                        $found = true;
                                                                                                        break; // No es necesario seguir buscando si ya encontramos los datos
                                                                                                    }
                                                                                                }

                                                                                                // Si no se encontró información, los valores predeterminados se mantendrán
                                                                                                if (!$found) {
                                                                                                    $final_grade_percentage = 0;
                                                                                                    $attendance_percentage = 0;
                                                                                                    $final_grade_scaled = 0;
                                                                                                }
                                                                                                ?>

                                                                                                <tr>
                                                                                                    <!-- Campo de Asistencia editable -->
                                                                                                    <td class="text-center">
                                                                                                        <input type="number" name="attendance_percentage" id="attendance_percentage" value="<?= htmlspecialchars($attendance_percentage) ?>" step="0.01" class="form-control" min="0" max="100">
                                                                                                    </td>

                                                                                                    <!-- Campo de Calificación Final editable -->
                                                                                                    <td class="text-center">
                                                                                                        <input type="number" name="final_grade_percentage" id="final_grade_percentage" value="<?= htmlspecialchars($final_grade_percentage) ?>" step="0.01" class="form-control" min="0" max="100">
                                                                                                    </td>

                                                                                                    <!-- Nota Escala 0-20 calculada automáticamente (readonly) -->
                                                                                                    <td class="text-center">
                                                                                                        <input type="text" id="final_grade_scaled" value="<?= number_format($final_grade_scaled, 2) ?>" class="form-control" readonly>
                                                                                                    </td>
                                                                                                </tr>

                                                                                            </tbody>
                                                                                        </table>
                                                                                        <p>Puedes modificar directamente asistencias y calificación</p>
                                                                                        <p>La nota final se calcula en base al porcentaje de calificación final</p>
                                                                                        <!-- Agregar un botón para enviar los cambios -->
                                                                                        <div class="modal-footer">
                                                                                            <input type="hidden" name="student_id" value="<?= htmlspecialchars($id_student) ?>">
                                                                                            <input type="hidden" name="assignment_id" value="<?= htmlspecialchars($id_assignment) ?>">
                                                                                            <input type="hidden" name="level_courses_id" value="<?= htmlspecialchars($level_courses_id) ?>">
                                                                                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                                                                            <button type="button" class="btn btn-secondary" class="close" data-dismiss="modal" aria-label="Close">Cerrar</button>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                    <?php
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
<script>
// Función para recalcular la Nota Escala 0-20 cada vez que se modifique la calificación final
function updateFinalGradeScaled() {
    const finalGradePercentage = parseFloat(document.getElementById('final_grade_percentage').value);
    const scaledGrade = (finalGradePercentage / 100) * 20;
    document.getElementById('final_grade_scaled').value = scaledGrade.toFixed(2); // Actualizar la nota en escala 0-20
}

// Agregar eventos para recalcular la nota cuando se cambian los campos
document.getElementById('final_grade_percentage').addEventListener('input', updateFinalGradeScaled);

// Inicializar la función para que se calcule la nota correctamente al cargar la página
window.onload = updateFinalGradeScaled;
</script>