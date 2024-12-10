<?php 
include('../../app/config.php');
include('../../admin/layout/part_1.php');
include('../../app/controllers/courses/list_of_courses.php');
include('../../app/controllers/years_levels/list_of_years_levels.php');

?>

<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h1>Asociar Materia con Nivel</h1>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Formulario para asociar</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?=APP_URL;?>/app/controllers/courses/associate.php" method="post">
                                <!-- Selección de Materia -->
                                <div class="form-group mb-3">
                                    <label for="course_id">Materia</label>
                                    <select name="course_id" id="course_id" class="form-control" required>
                                        <option value="">Seleccione una materia</option>
                                        <?php foreach ($courses as $course): ?>
                                            <option value="<?=$course['id_courses'];?>"><?=$course['name_course'];?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <!-- Selección de Nivel -->
                                <div class="form-group mb-3">
                                    <label for="level_id">Nivel o año</label>
                                    <select name="level_id" id="level_id" class="form-control" required>
                                        <option value="">Seleccione un nivel</option>
                                        <?php foreach ($levels as $level): ?>
                                            <option value="<?=$level['id_levels'];?>"><?=$level['years_level'].' - '.$level['programs_name'].' - sección '.$level['section'];?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <!-- Estado -->
                                <div class="form-group mb-3">
                                    <label for="level_courses_state">Estado</label>
                                    <select name="level_courses_state" id="level_courses_state" class="form-control" required>
                                        <option value="ACTIVO">ACTIVO</option>
                                        <option value="INACTIVO">INACTIVO</option>
                                    </select>
                                </div>

                                <!-- Botones de Acción -->
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Asociar</button>
                                    <a href="<?=APP_URL;?>/admin/courses/list_associate.php" class="btn btn-secondary">Cancelar</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include ('../../admin/layout/part_2.php');
include ('../../layout/messages.php');
?>