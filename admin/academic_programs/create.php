<?php
include ('../../app/config.php');
include ('../../admin/layout/part_1.php');
include ('../../app/controllers/settings/management/list_of_management.php');
include ('../../app/controllers/university_campuses/list_of_campuses.php');
?>

<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-center">
                    <h1>Registro de un nuevo programa de formación</h1>
                </div>
            </div>
            <br>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Rellene el formulario</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?=APP_URL;?>/app/controllers/academic_programs/create.php" method="post">
                                <!-- Nombre de la Gestión -->
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="management_id">Gestión Educativa<b>*</b></label>
                                            <select name="management_id" id="" class="form-control" >
                                                <?php
                                                    foreach($managements as $management){ 
                                                        if($management['management_state'] == '1'){?>
                                                        <option value="<?=$management['id_management'];?>" ><?=$management['management'];?></option>    
                                                        <?php
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--Nombre del pnf-->
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="programs_name">Nuevo PNF<b>*</b></label>
                                            <input type="text" class="form-control" name="programs_name" placeholder="Introduce nombre del nuevo PNF" id="uppercase_field" required>
                                        </div>
                                    </div>
                                </div>
                                <!--Seleccionar PNF-->
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="shift">turnos<b>*</b></label>
                                            <select name="shift" id="" class="form-control"requiere >
                                                <option value="">Seleccione un Turno</option>
                                                <option value="MAÑANA">MAÑANA</option>
                                                <option value="TARDE">TARDE</option>
                                                <option value="NOCHE">NOCHE</option>
                                                <option value="INTEGRAL O COMPLETO">INTEGRAL O COMPLETO</option>
                                                <option value="FIN DE SEMANA">FIN DE SEMANA</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="campuses">Sedes donde se impartirá<b>*</b></label>
                                            <div>
                                                <?php foreach ($campuses as $campus): ?>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="campuses[]" value="<?= $campus['id_campus']; ?>" id="campus_<?= $campus['id_campus']; ?>">
                                                        <label class="form-check-label" for="campus_<?= $campus['id_campus']; ?>">
                                                            <?= $campus['name_campus']; ?>
                                                        </label>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="programs_state">Estado</label>
                                            <select name="programs_state" id="" class="form-control">
                                                <option value="ACTIVO">ACTIVO</option>
                                                <option value="INACTIVO">INACTIVO</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Botones de Acción -->
                                <div class="row mb-3 text-center">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary">Registrar</button>
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
<script src="../../public/js/create_management.js"></script>

<?php
include ('../../admin/layout/part_2.php');
include ('../../layout/messages.php');
?>
