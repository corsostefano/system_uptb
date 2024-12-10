<?php
$id_level_courses= $_GET['id'];
include ('../../app/config.php');
include ('../../admin/layout/part_1.php');
include ('../../app/controllers/courses/data_courses_associate.php');


?>

<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container-fluid">
            <!-- Título de la Materia -->
            <div class="row">
                <div class="col-12 text-center">
                    <h1>Materia: <?=$name_course;?></h1>
                </div>
            </div>
            <br>

            <!-- Tarjeta de Datos Registrados -->
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Datos Registrados</h3>
                        </div>
                        <div class="card-body">

                            <!-- Información de materia -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="management">Nombre de la materia</label>
                                        <p class="text-muted"><?=$name_course?></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="management">Estado</label>
                                        <div class="text-center">
                                            <?php if($level_courses_state == '1') { ?>
                                                <button class="btn btn-success btn-sm" style="border-radius: 20px;">ACTIVO</button>
                                            <?php } else { ?>
                                                <button class="btn btn-danger btn-sm" style="border-radius: 20px;">INACTIVO</button>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                              <!-- Información de materia -->
                              <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="management">PNF</label>
                                        <p class="text-muted"><?=$programs_name?></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="management">Nivel o año</label>
                                        <p class="text-muted"><?=$years_level?></p>
                                    </div>
                                </div>
                            </div>
                                 <!-- Información de materia -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="management">Sección</label>
                                        <p class="text-muted"><?=$section?></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="management">Turno</label>
                                        <p class="text-muted"><?=$shift;?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="management">Gestión</label>
                                        <p class="text-muted"><?=$management;?></p>
                                    </div>
                                </div>
                            </div>

                            <!-- Fechas de Registro y Actualización -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="management">Fecha y hora de Registro</label>
                                        <p class="text-muted"><?=$fyh_creation;?></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="management">Fecha y hora de Actualización</label>
                                        <p class="text-muted"><?=$fyh_update;?></p>
                                    </div>
                                </div>
                            </div>

                            <!-- Botón de Acción -->
                            <div class="row mb-3 text-center">
                                <div class="col-md-12">
                                    <a href="<?=APP_URL;?>/admin/courses/list_associate.php" class="btn btn-secondary">Volver</a>
                                </div>
                            </div>
                            
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
