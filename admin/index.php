<?php
include ('../app/config.php');
include ('../admin/layout/part_1.php');
include ('../app/controllers/roles/list_of_roles.php');
include ('../app/controllers/users/list_of_users.php');
include ('../app/controllers/academic_programs/list_of_programs.php');
include ('../app/controllers/years_levels/list_of_years_levels.php');
include ('../app/controllers/courses/list_of_courses.php');
include ('../app/controllers/administrative/list_of_administrative.php');
include ('../app/controllers/teachers/list_of_teachers.php');
include ('../app/controllers/students/list_of_students.php');
include ('../app/controllers/students/data_students_academic_programs.php');
include ('../app/controllers/students/data_students_years.php');
include ('../app/controllers/teachers/list_of_assignment.php');



?>
<div class="content-wrapper"">
    <br>
    <div class="container">
        <div class="container">
          <div class="row">
            <h1><?=APP_NAME;?></h1>
          </div>
          <br>
        <!--Vista estudiante--> 
        <?php 
          if($role_category_session == 'student'){
            foreach($users_students as $user_student){
              if($email_session_user == $user_student['email']){
                 $id_student = $user_student['id_student'];
                 $programs_name = $user_student['programs_name'];
                 $years_level = $user_student['years_level'];
                 $shift = $user_student['shift'];
                 $section = $user_student['section'];
              }
            }
            ?>

          <div class="row">
                <br>
                <div class="col-md-8">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Datos del Estudiante</h3>
                            <div class="card-tools"></div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive" >
                            <table class="table table-sm table-hover table-striped table-bordered">
                              <tr>
                                <td><b>Nombres y apellidos: </b></td>
                                <td><?=$name_session_user?></td> 
                              </tr>
                              <tr>
                                <td><b>Cédula de identidad</b></td>
                                <td><?=$identification_type_session_user.' '.$cedula_session_user?></td> 
                              </tr>
                              <tr>
                                <td><b>Email</b></td>
                                <td><?=$email_session_user?></td> 
                              </tr>
                              <tr>
                                <td><b>PNF o Carrera</b></td>
                                <td><?=$programs_name?></td> 
                              </tr>
                              <tr>
                                <td><b>Año o Nivel</b></td>
                                <td><?=$years_level?></td> 
                              </tr>
                              <tr>
                                <td><b>Sección</b></td>
                                <td><?=$section?></td> 
                              </tr>
                              <tr>
                                <td><b>Turno</b></td>
                                <td><?=$shift?></td> 
                              </tr>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
          </div>
          <br>
          <div class="row">
                <div class="col-md-4 col-sm-6 col-12">
                    <div class="info-box" bis_skin_checked="1">
                        <span class="info-box-icon bg-primary"><i class="bi bi-building"></i></span>

                        <div class="info-box-content" bis_skin_checked="1">
                            <span class="info-box-text"><b>Reportes</b></span>
                            <a href="<?=APP_URL?>/admin/academic_history/report_student.php?id_student=<?=$id_student?>" class="btn btn-primary btn-sm" >Ingresar</a>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                   
                </div>
                <div class="col-md-4 col-sm-6 col-12">
                    <div class="info-box" bis_skin_checked="1">
                        <span class="info-box-icon bg-info"><i class="bi bi-clipboard2-check"></i></span>

                        <div class="info-box-content" bis_skin_checked="1">
                            <span class="info-box-text"><b>Calificaciones</b></span>
                            <a href="<?=APP_URL?>/admin/grades/grades_per_student.php?id_student=<?=$id_student?>" class="btn btn-info btn-sm" >Ingresar</a>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                   
                </div>
          </div>
            <?php 
          }
        ?>
        <!--Vista Docente--> 

        <?php 
          if($role_category_session == 'teacher'){
            foreach($users_teachers as $user_teacher){
              if($email_session_user == $user_teacher['email']){
                 $user_teacher['id_teacher'];
                 $specialty = $user_teacher['specialty'];
                 $seniority = $user_teacher['seniority'];
                 $profession = $user_teacher['profession'];
                
                
              }
            }
            ?>

          <div class="row">
                <br>
                <div class="col-md-6">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Datos del Docente</h3>
                            <div class="card-tools"></div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive" >
                            <table class="table table-sm table-hover table-striped table-bordered">
                              <tr>
                                <td><b>Nombres y apellidos: </b></td>
                                <td><?=$name_session_user?></td> 
                              </tr>
                              <tr>
                                <td><b>Cédula de identidad</b></td>
                                <td><?=$identification_type_session_user.' '.$cedula_session_user?></td> 
                              </tr>
                              <tr>
                                <td><b>Email</b></td>
                                <td><?=$email_session_user?></td> 
                              </tr>
                              <tr>
                                <td><b>Especialidad</b></td>
                                <td><?=$specialty?></td> 
                              </tr>
                              <tr>
                                <td><b>Antigüedad</b></td>
                                <td><?=$seniority?></td> 
                              </tr>
                              <tr>
                                <td><b>Profesión</b></td>
                                <td><?=$profession?></td> 
                              </tr>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
          </div>
          <div class="row">
                <br>
                <div class="col-md-6">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Materias asignadas</h3>
                            <div class="card-tools"></div>
                        </div>
                        <div class="card-body">
                        <?php
                          // Inicializamos el contador y el array de nombres de cursos.
                          $contador_assignments = 0;
                          $courses = [];

                          foreach ($assignments as $assignment) {
                              // Verificamos si el correo coincide con el del usuario.
                              if ($email_session_user == $assignment['email']) {
                                  $contador_assignments++; // Aumentamos el contador de asignaciones.

                                  // Guardamos el nombre del curso en el array
                                  $courses[] = $assignment['name_course'];
                              }
                          }

                          // Mostramos el mensaje con el resultado.
                          if ($contador_assignments > 0) { ?>

                              <p>Tienes <?=$contador_assignments?> materias asignadas:</p>
                              <ul>
                                <?php
                              foreach ($courses as $course) {
                                ?>
                                  <li><?=$course?></li>
                                <?php
                              }?>
                              </ul>
                              <div class="info-box" bis_skin_checked="1">
                                  <span class="info-box-icon bg-info"><i class="bi bi-clipboard2-check"></i></span>

                                  <div class="info-box-content" bis_skin_checked="1">
                                      <span class="info-box-text"><b>Mas información</b></span>
                                      <a href="<?= APP_URL; ?>/admin/teachers/teacher_assignments.php" class="btn btn-info btn-sm" >Ingresar</a>
                                  </div>
                                  <!-- /.info-box-content -->
                              </div>
                            
                              <?php
                          } else { ?>
                             <p>No tienes materias asignadas.</p>

                              <?php
                          }
                        ?>

                      </div>

                    </div>
                </div>
          </div>
            <?php 
          }
        ?>
        
        <!--Vista Administrador--> 
          <?php 
           if($role_category_session == 'admin'){?>
          
            
          <!--Vista Administrador--> 
            <div class="row">
          
            <div class="col-lg-3 col-6" bis_skin_checked="1">
              <!-- small card -->
              <div class="small-box bs-danger bg-dark" style="background-image: linear-gradient(60deg, #29323c 0%, #485563 100%);" bis_skin_checked="1">
                <div class="inner" bis_skin_checked="1">
                  <?php 
                    $counter_roles = 0;
                    foreach($roles as $role){
                      $counter_roles = $counter_roles + 1;
                    };
                  ?>
                  <h3><?=$coun_roles;?></h3>
          
                  <p>Roles Registrados</p>
          
                </div>
                <div class="icon" bis_skin_checked="1">
                  <i class="fa text-light"><i class="bi bi-bookmarks-fill"></i></i>
                </div>
                <a href="<?=APP_URL;?>/admin/roles" class="small-box-footer">
                  Más información <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
          
            <div class="col-lg-3 col-6" bis_skin_checked="1">
              <!-- small card -->
              <div class="small-box bs-danger bg-dark" style="background-image: linear-gradient(to right, #b8cbb8 0%, #b8cbb8 0%, #b465da 0%, #cf6cc9 33%, #ee609c 66%, #ee609c 100%);" bis_skin_checked="1">
                <div class="inner" bis_skin_checked="1">
                  <?php 
                    $counter_user = 0;
                    foreach($users as $user){
                      $counter_user = $counter_user + 1;
                    };
                  ?>
                  <h3><?=$counter_user;?></h3>
                  <p>Usuarios Registrados</p>
                </div>
                <div class="icon" bis_skin_checked="1">
                  <i class="fa text-light"><i class="bi bi-person-plus-fill"></i></i></i>
                </div>
                <a href="<?=APP_URL;?>/admin/users" class="small-box-footer">
                  Más información <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
          
            <div class="col-lg-3 col-6" bis_skin_checked="1">
              <!-- small card -->
              <div class="small-box bs-danger bg-dark" style="background-image: linear-gradient(135deg, #667eea 0%, #764ba2 100%);" bis_skin_checked="1">
                <div class="inner" bis_skin_checked="1">
                  <?php 
                    $counter_programs = 0;
                    foreach($programs as $program){
                      $counter_programs = $counter_programs + 1;
                    };
                  ?>
                  <h3><?=$counter_programs;?></h3>
                  <p>PNF Registrados</p>
                </div>
                <div class="icon" bis_skin_checked="1">
                  <i class="fa text-light"><i class="bi bi-book-half"></i></i></i>
                </div>
                <a href="<?=APP_URL;?>/admin/academic_programs" class="small-box-footer">
                  Más información <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
          
            <div class="col-lg-3 col-6" bis_skin_checked="1">
              <!-- small card -->
              <div class="small-box bs-danger bg-dark" bis_skin_checked="1" style="background-image: linear-gradient(to top, #0fd850 0%, #f9f047 100%);" >
                <div class="inner" bis_skin_checked="1">
                  <?php 
                    $counter_levels = 0;
                    foreach($levels as $level){
                      $counter_levels = $counter_levels + 1;
                    };
                  ?>
                  <h3><?=$counter_levels;?></h3>
                  <p>Años o Niveles Registrados</p>
                </div>
                <div class="icon" bis_skin_checked="1">
                  <i class="fa text-light"><i class="bi bi-ladder"></i></i></i>
                </div>
                <a href="<?=APP_URL;?>/admin/years_levels" class="small-box-footer">
                  Más información <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
          
            <div class="col-lg-3 col-6" bis_skin_checked="1">
              <!-- small card -->
              <div class="small-box bs-danger bg-dark" style="background-image: linear-gradient(to right, #3ab5b0 0%, #3d99be 31%, #56317a 100%);" bis_skin_checked="1">
                <div class="inner" bis_skin_checked="1">
                  <?php 
                    $counter_courses = 0;
                    foreach($courses as $course){
                      $counter_courses = $counter_courses + 1;
                    };
                  ?>
                  <h3><?=$counter_courses;?></h3>
                  <p>Materias Registradas</p>
                </div>
                <div class="icon" bis_skin_checked="1">
                  <i class="fa text-light"><i class="bi bi-journal-text"></i></i></i>
                </div>
                <a href="<?=APP_URL;?>/admin/courses" class="small-box-footer">
                  Más información <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
          
            <div class="col-lg-3 col-6" bis_skin_checked="1">
              <!-- small card -->
              <div class="small-box bs-danger bg-dark" bis_skin_checked="1" style="background-image: linear-gradient(-20deg, #fc6076 0%, #ff9a44 100%);" >
                <div class="inner" bis_skin_checked="1">
                  <?php 
                    $counter_users_admin = 0;
                    foreach($users_admin as $user_admin){
                      $counter_users_admin = $counter_users_admin + 1;
                    };
                  ?>
                  <h3><?=$counter_users_admin;?></h3>
                  <p>Administrativos Registrados</p>
                </div>
                <div class="icon" bis_skin_checked="1">
                  <i class="fa text-light"><i class="bi bi-person-lines-fill"></i></i>
                </div>
                <a href="<?=APP_URL;?>/admin/administrative" class="small-box-footer">
                  Más información <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
          
            <div class="col-lg-3 col-6" bis_skin_checked="1">
              <!-- small card -->
              <div class="small-box bs-danger bg-dark bis_skin_checked="1" style="background-image: linear-gradient(to right, #243949 0%, #517fa4 100%);">
                <div class="inner" bis_skin_checked="1">
                  <?php 
                    $counter_users_teachers = 0;
                    foreach($users_teachers as $users_teacher){
                      $counter_users_teachers = $counter_users_teachers + 1;
                    };
                  ?>
                  <h3><?=$counter_users_teachers;?></h3>
                  <p>Docentes Registrados</p>
                </div>
                <div class="icon" bis_skin_checked="1">
                  <i class="fa text-light" ><i class="bi bi-person-video3"></i></i>
                </div>
                <a href="<?=APP_URL;?>/admin/teachers" class="small-box-footer">
                  Más información <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
          
            <div class="col-lg-3 col-6" bis_skin_checked="1">
              <!-- small card -->
              <div class="small-box bs-danger bg-dark" style="background-image: linear-gradient(to right, #ed6ea0 0%, #ec8c69 100%);" >
                <div class="inner" bis_skin_checked="1">
                  <?php 
                    $counter_users_students = 0;
                    foreach($users_students as $user_student){
                      $counter_users_students = $counter_users_students+ 1;
                    };
                  ?>
                  <h3><?=$counter_users_students;?></h3>
                  <p>Estudiantes Registrados</p>
                </div>
                <div class="icon" bis_skin_checked="1">
                  <i class="fa text-light" ><i class="bi bi-person-video"></i></i>
                </div>
                <a href="<?=APP_URL;?>/admin/students" class="small-box-footer">
                  Más información <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-md-6">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Estudiantes registrados en cada programa académico</h3>
                        <div class="card-tools"></div>
                    </div>
                    <div class="card-body">
                        <div>
                            <canvas id="programChart"></canvas>
                        </div> 
                    </div>
                </div>
                
                <script>
                    const ctxProgram = document.getElementById('programChart').getContext('2d');
                    const programChart = new Chart(ctxProgram, {
                        type: 'doughnut', // Cambiado a 'doughnut' en lugar de 'pie'
                        data: {
                            labels: <?php echo json_encode($program_names); ?>,
                            datasets: [{
                                label: 'Porcentaje de estudiantes',
                                data: <?php echo json_encode($percentages); ?>,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            cutout: '70%', // Controla el tamaño del agujero en el centro (ajústalo a tu gusto)
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'top', // Ubicación de la leyenda
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(tooltipItem) {
                                            return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(2) + '%'; // Formato personalizado del tooltip
                                        }
                                    }
                                }
                            }
                        }
                    });
                </script>
            </div>


            <div class="col-md-6">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title">Estudiantes Registrados en el Año</h3>
                        <div class="card-tools"></div>
                    </div>
                    <div class="card-body">
                        <div>
                            <canvas id="studentsChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                const ctxStudents = document.getElementById('studentsChart').getContext('2d');

                // Suponiendo que los datos de la consulta SQL se convierten en un array de objetos con 'year', 'month' y 'total_students'
                const data = <?php echo json_encode($students_by_month); ?>;

                const labels = data.map(item => `${item.month}/${item.year}`);  // Etiquetas del eje X
                const totalStudents = data.map(item => item.total_students);    // Datos para el eje Y

                const chart = new Chart(ctxStudents, {
                    type: 'bar',  // Gráfico de barras
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Número de Estudiantes Inscritos',
                            data: totalStudents,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>

        </div>

            <?php
          }
          ?>
        </div>
    </div>
</div>
<?php
include ('../admin/layout/part_2.php');
include ('../layout/messages.php')
?>
  