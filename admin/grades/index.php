<?php
include ('../../app/config.php');
include ('../../admin/layout/part_1.php');
include ('../../app/controllers/teachers/list_of_assignment.php');
include ('../../app/controllers/grades/list_of_overall_ratings.php');
?>
    <!-- Vista Docente -->
    <?php 
          if($role_category_session == 'teacher'){
            ?>
            <div class="content-wrapper">
                <br>
                <div class="content">
                    <div class="container">
                        <div class="row">
                            <h1>Grados asignados para calificaciones</h1>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-outline card-primary">
                                    <div class="card-body">
                                        <div class="table-responsive-sm">
                                            <table id="example1" border="1" class="table table-striped table-bordered table-hover table-sm">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Nro</th> 
                                                        <th class="text-center">PNF</th> 
                                                        <th class="text-center d-none d-md-table-cell">Año</th> 
                                                        <th class="text-center d-none d-md-table-cell">Sección</th> 
                                                        <th class="text-center d-none d-lg-table-cell">Materia</th> 
                                                        <th class="text-center">Acciones</th> 
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        $contador_assignments = 0;
                                                        foreach ($assignments as $assignment) {
                                                            if ($email_session_user == $assignment['email']) {
                                                                $contador_assignments++;
                                                                // Verificación de existencia de datos y construcción de parámetros
                                                                $params = [
                                                                    'id_teacher' => $assignment['teacher_id'] ?? 'undefined',
                                                                    'id_academic_programs' => $assignment['academic_programs_id'] ?? 'undefined',
                                                                    'level_courses_id' => $assignment['level_courses_id'] ?? 'undefined',
                                                                    'id_assignment' => $assignment['id_assignment'] ?? 'undefined',
                                                                ];
                                                                $queryString = http_build_query($params);
                                                    ?>
                                                                <tr>
                                                                    <td style="text-align:center"><?php echo $contador_assignments; ?></td>
                                                                    <td style="text-align:center"><?php echo $assignment['programs_name']; ?></td>
                                                                    <td style="text-align:center"><?php echo $assignment['years_level']; ?></td>
                                                                    <td style="text-align:center"><?php echo $assignment['section']; ?></td>
                                                                    <td style="text-align:center"><?php echo $assignment['name_course']; ?></td>
                                                                    <td style="text-align:center">
                                                                        <a href="create.php?<?php echo htmlspecialchars($queryString); ?>" class="btn btn-primary btn-sm">
                                                                            <i class="bi bi-clipboard-check"></i> Subir notas
                                                                        </a>
                                                                        <a href="list_course_grades.php?<?php echo htmlspecialchars($queryString);?>" class="btn btn-success btn-sm">
                                                                            <i class="bi bi-clipboard-check"></i> Listado
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                    <?php 
                                                            }
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
            </div>
        <?php 
        }
    ?>
    <!-- Vista Personal Administrativo -->
    <?php 
          if($role_category_session == 'admin'){
            ?>
            <div class="content-wrapper">
                <br>
                <div class="content">
                    <div class="container">
                        <div class="row">
                            <h1>Calificaciones Generales</h1>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-outline card-primary">
                                    <div class="card-body">
                                        <div class="table-responsive-sm">
                                            <table id="example1" border="1" class="table table-striped table-bordered table-hover table-sm">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Nro</th> 
                                                        <th class="text-center">PNF</th> 
                                                        <th class="text-center">Gestión o año académico</th> 
                                                        <th class="text-center d-none d-md-table-cell">Año o nivel</th> 
                                                        <th class="text-center d-none d-md-table-cell">Sección</th> 
                                                        <th class="text-center d-none d-lg-table-cell">Materia</th> 
                                                        <th class="text-center d-none d-lg-table-cell">Docente</th> 
                                                        <th class="text-center">Acciones</th> 
                                                    </tr>
                                                </thead>
                                                
                                                <tbody>
                                                    <?php 
                                                    $contador_assignments = 0;
                                                    foreach ($general_assignments as $assignment) {
                                                        // Incrementar el contador por cada fila
                                                        $contador_assignments++;

                                                        // Construir la query string para enviar datos
                                                        $params = [                                            
                                                            'id_teacher' => $assignment['teacher_id'] ?? 'undefined',
                                                            'id_academic_programs' => $assignment['academic_programs_id'] ?? 'undefined',
                                                            'level_courses_id' => $assignment['level_courses_id'] ?? 'undefined',
                                                            'id_assignment' => $assignment['id_assignment'] ?? 'undefined',
                                                        ];
                                                        $queryString = http_build_query($params);
                                                    ?>
                                                        <tr>
                                                    
                                                            <td style="text-align:center"><?php echo $contador_assignments; ?></td>
                                                 
                                                            <td style="text-align:center"><?php echo htmlspecialchars($assignment['programs_name']); ?></td>

                                                            <td style="text-align:center"><?php echo htmlspecialchars($assignment['management']); ?></td>
                                                 
                                                            <td style="text-align:center"><?php echo htmlspecialchars($assignment['years_level']); ?></td>
                                                   
                                                            <td style="text-align:center"><?php echo htmlspecialchars($assignment['section']); ?></td>
                                                         
                                                            <td style="text-align:center"><?php echo htmlspecialchars($assignment['name_course']); ?></td>

                                                            <td style="text-align:center"><?php echo htmlspecialchars($assignment['teacher_name']); ?></td>

                                                           
                                                       
                                                            <td style="text-align:center">
                                                            
                                                                <a href="list_course_grades.php?<?php echo htmlspecialchars($queryString);?>" class="btn btn-success btn-sm">
                                                                            <i class="bi bi-clipboard-check"></i> Listado
                                                                </a>
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
            </div>
        <?php 
        }
    ?>
<?php
include ('../../admin/layout/part_2.php');
include ('../../layout/messages.php');
?>
