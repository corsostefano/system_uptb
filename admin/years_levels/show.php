<?php
$id_levels = $_GET['id'];
include ('../../app/config.php');
include ('../../admin/layout/part_1.php');

include ('../../app/controllers/years_levels/data_years_levels.php')
?>

<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container-fluid">
            <!-- Título del año o nivel -->
            <div class="row">
                <div class="col-12 text-center">
                    <h1>Año o Nivel: <?=$years_level;?></h1>
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

                            <!-- Información de Gestión Educativa y Estado -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="management">Nombre del año o nivel</label>
                                        <p class="text-muted"><?=$years_level?></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="management">Estado</label>
                                        <div class="text-center">
                                            <?php if($levels_state  == '1') { ?>
                                                <button class="btn btn-success btn-sm" style="border-radius: 20px;">ACTIVO</button>
                                            <?php } else { ?>
                                                <button class="btn btn-danger btn-sm" style="border-radius: 20px;">INACTIVO</button>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="management">Nombre del PNF</label>
                                        <p class="text-muted"><?=$programs_name?></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="management">Sección</label>
                                        <p class="text-muted"><?=$section;?></p>
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
                                    <a href="<?=APP_URL;?>/admin/years_levels" class="btn btn-secondary">Volver</a>
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
