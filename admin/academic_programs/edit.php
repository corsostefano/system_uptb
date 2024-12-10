<?php
$id_academic_programs = $_GET['id'];
include ('../../app/config.php');
include ('../../admin/layout/part_1.php');
include ('../../app/controllers/settings/management/list_of_management.php');
include ('../../app/controllers/academic_programs/data_programs.php');
?>

<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-center">
                    <h1>Modificar PNF: <?=$programs_name;?></h1>
                </div>
            </div>
            <br>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title">Rellene el formulario</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?=APP_URL;?>/app/controllers/academic_programs/update.php" method="post">
                                <!-- ID del Programa Académico -->
                                <input type="hidden" name="id_academic_programs" value="<?=$id_academic_programs;?>">

                                <!-- Nombre de la Gestión -->
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="management_id">Gestión Educativa<b>*</b></label>
                                            <select name="management_id" id="management_id" class="form-control">
                                                <?php
                                                    foreach($managements as $management){ 
                                                        if($management['management_state'] == '1'){?>
                                                        <option value="<?=$management['id_management'];?>" 
                                                        <?php if($management_id == $management['id_management']){?> selected="selected" <?php } ?>>
                                                            <?=$management['management'];?>
                                                        </option>    
                                                        <?php
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Nombre del PNF -->
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="programs_name">Nombre del PNF<b>*</b></label>
                                            <input type="text" class="form-control" name="programs_name" placeholder="Introduce nombre del nuevo PNF" value="<?=$programs_name;?>" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Turnos -->
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="shift">Turnos<b>*</b></label>
                                            <select name="shift" id="shift" class="form-control">
                                                <option value="MAÑANA" <?= ($shift == 'MAÑANA') ? 'selected' : ''; ?>>MAÑANA</option>
                                                <option value="TARDE" <?= ($shift == 'TARDE') ? 'selected' : ''; ?>>TARDE</option>
                                                <option value="NOCHE" <?= ($shift == 'NOCHE') ? 'selected' : ''; ?>>NOCHE</option>
                                                <option value="INTEGRAL O COMPLETO" <?= ($shift == 'INTEGRAL O COMPLETO') ? 'selected' : ''; ?>>INTEGRAL O COMPLETO</option>
                                                <option value="FIN DE SEMANA" <?= ($shift == 'FIN DE SEMANA') ? 'selected' : ''; ?>>FIN DE SEMANA</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- Estado -->
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="programs_state">Estado</label>
                                            <select name="programs_state" id="programs_state" class="form-control">
                                                <option value="ACTIVO" <?= ($programs_state == 'ACTIVO') ? 'selected' : ''; ?>>ACTIVO</option>
                                                <option value="INACTIVO" <?= ($programs_state == 'INACTIVO') ? 'selected' : ''; ?>>INACTIVO</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Botones de Acción -->
                                <div class="row mb-3 text-center">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-success">Actualizar</button>
                                        <a href="<?=APP_URL;?>/admin/academic_programs" class="btn btn-secondary">Cancelar</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="../../public/js/edit_management.js"></script>

<?php
include ('../../admin/layout/part_2.php');
include ('../../layout/messages.php');
?>
