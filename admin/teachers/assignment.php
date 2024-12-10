<?php 
include('../../app/config.php');
include ('../../admin/layout/part_1.php');
include ('../../app/controllers/teachers/list_of_teachers.php');
include ('../../app/controllers/academic_programs/list_of_programs.php');
include ('../../app/controllers/courses/list_of_courses_associate.php');
include ('../../app/controllers/courses/list_of_courses.php');
include ('../../app/controllers/teachers/list_of_assignment.php');
?>
<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h1>Listado de Personal Docente</h1>
            </div>
            <br>
            <div class="row">
                <br>
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Docentes asignados</h3>
                            <div class="card-tools">
                               <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_assignment">
                                    <i class="bi bi-plus-square"></i>  Asignar materias
                               </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive-sm">
                                <table id="example1" border="1" class="table table-striped table-bordered table-hover table-sm">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Nro</th> 
                                            <th class="text-center">Nombre del docente</th> 
                                            <th class="text-center d-none d-md-table-cell">Cédula de identidad</th> 
                                            <th class="text-center d-none d-md-table-cell">Rol</th> 
                                            <th class="text-center d-none d-md-table-cell">Email</th> 
                                            <th class="text-center d-none d-lg-table-cell">Especialidad</th> 
                                            <th class="text-center d-none d-md-table-cell">Estado</th> 
                                            <th class="text-center">Materias Asignadas</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $counter_users_teachers = 0; 
                                            foreach ($users_teachers as $users_teacher){
                                                $counter_users_teachers++;
                                                $id_teacher = $users_teacher['id_teacher']; // Asumiendo que existe este campo
                                        ?>
                                        <tr>
                                            <td class="text-center"><?=$counter_users_teachers;?></td> 
                                            <td class="text-center"><?=$users_teacher['first_name'].' '.$users_teacher['last_name'] ;?></td> 
                                            <td class="text-center d-none d-md-table-cell"><?= $users_teacher['identification_type'].'-'. $users_teacher['cedula'];?></td> 
                                            <td class="text-center d-none d-md-table-cell"><?=$users_teacher['name_rol'];?></td> 
                                            <td class="text-center d-none d-md-table-cell"><?=$users_teacher['email'];?></td> 
                                            <td class="text-center d-none d-lg-table-cell"><?=$users_teacher['specialty'];?></td> 
                                            
                                            <td class="text-center d-none d-md-table-cell">
                                                <?php if($users_teacher['user_state'] == '1' ){ ?>
                                                    <button class="btn btn-success btn-sm" style="border-radius: 20px;">ACTIVO</button>
                                                <?php } else { ?>
                                                    <button class="btn btn-danger btn-sm" style="border-radius: 20px;">INACTIVO</button>
                                                <?php } ?>
                                            </td>
                                            
                                            <td class="text-center">
                                                <!-- Botón para abrir el modal -->
                                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal_courses<?=$id_teacher;?>">
                                                    <i class="bi bi-postcard"></i> Ver materias
                                                </button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="modal_courses<?=$id_teacher;?>" tabindex="-1" aria-labelledby="modalLabel<?=$id_teacher;?>" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-image: linear-gradient(60deg, #29323c 0%, #485563 100%); color: white" >
                                                                <h5 class="modal-title" id="modalLabel<?=$id_teacher;?>">Materias Asignadas</h5>
                                                                <button class="btn btn-danger btn-sm" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true"><i class="bi bi-x-square-fill"></i></span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <b>Docente: <?=$users_teacher['first_name'].' '.$users_teacher['last_name'];?></b>
                                                                <hr>
                                                                <table class="table table-striped table-bordered table-sm">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="text-center">Nro</th>
                                                                            <th class="text-center">PNF</th>
                                                                            <th class="text-center">Año</th>
                                                                            <th class="text-center">Sección</th>
                                                                            <th class="text-center">Materia</th>
                                                                            <th class="text-center">Turno</th>
                                                                            <th class="text-center">Acciones</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php 
                                                                            $counter_assignment = 0;
                                                                               foreach ($assignments as $assignment) {
                                                                                if ($assignment['teacher_id'] == $id_teacher){
                                                                                    $counter_assignment++;
                                                                                    $id_assignment = $assignment['id_assignment'];?>

                                                                                    <tr>
                                                                                        <td class="text-center"><?=$counter_assignment?></td>
                                                                                        <td class="text-center"><?=$assignment['programs_name'];?></td>
                                                                                        <td class="text-center"><?=$assignment['years_level'];?></td>
                                                                                        <td class="text-center"><?=$assignment['section'];?></td>
                                                                                        <td class="text-center"><?=$assignment['name_course'];?></td>
                                                                                        <td class="text-center"><?=$assignment['shift'];?></td>
                                                                                        <td class="text-center">
                                                                                            <div class="btn-group" role="group" aria-label="Acciones">
                                                                                                <form action="<?=APP_URL;?>/app/controllers/teachers/delete_assignment.php" method="post" onsubmit="return confirmDeletion(event, this);">
                                                                                                    <input type="text" name="id_assignment" value="<?=$id_assignment;?>" hidden>
                                                                                                    <button type="submit" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Borrar"><i class="bi bi-trash3"></i></button>
                                                                                                </form>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                        <?php }} ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php }?>
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
include('../../admin/layout/part_2.php');
include('../../layout/messages.php');
?>


<!-- Modal para asignar materias -->
<div class="modal fade" id="modal_assignment" tabindex="-1" aria-labelledby="modalAssignmentLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-image: linear-gradient(60deg, #29323c 0%, #485563 100%); color: white">
                <h5 class="modal-title" id="modalAssignmentLabel">Asignar Materias</h5>
                <button class="btn btn-danger btn-sm" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="bi bi-x-square-fill"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Contenido del modal para asignar materias aquí -->
                <form action="<?= APP_URL; ?>/app/controllers/teachers/create_assignment.php" method="post">
                    <div class="row">
                        <!-- Selección de Docente -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Docentes</label>
                                <select name="teacher_id" id="teacher_id" class="form-control" required>
                                    <?php foreach ($users_teachers as $teacher) { ?>
                                        <option value="<?= $teacher['id_teacher']; ?>">
                                            <?= $teacher['first_name'] . " " . $teacher['last_name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        
                        <!-- Selección de Materias -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Materias</label>
                                <select name="level_courses_id" id="level_courses_id" class="form-control" required>
                                    <?php foreach ($associations as $association) { ?>
                                        <option value="<?= $association['id_level_courses']; ?>">
                                            <?= $association['name_course'] . " - " . $association['years_level'] . " - " . $association['programs_name'] . " - Sección: " . $association['section'] . " - " . $association['shift']; ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">PNF</label>
                                        <select name="academic_programs_id" class="form-control">
                                            <?php foreach($programs as $program) {
                                                $academic_programs_id = $program['id_academic_programs']; ?>
                                                <option value="<?php echo $academic_programs_id; ?>"> <?php echo $program['programs_name'] ." ". $program['shift']; ?> </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                        </div>
                    </div>

                    <!-- Botones de Acción -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Registrar asignación</button>
                    </div>
                </form>
              
            </div>
        </div>
    </div>
</div>


