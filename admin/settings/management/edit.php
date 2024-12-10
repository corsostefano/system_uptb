<?php
$id_management = $_GET['id'];
include ('../../../app/config.php');
include ('../../../admin/layout/part_1.php');
include ('../../../app/controllers/settings/management/data_management.php')
?>

<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-center">
                    <h1>Modificación de: <?=$management_name?> </h1>
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
                            <form action="<?=APP_URL;?>/app/controllers/settings/management/update.php" method="post">
                                <!-- Nombre de la Gestión -->
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" name="id_management" value="<?=$id_management;?>" hidden>
                                            <label for="management">Gestión Educativa<b>*</b></label>
                                            <input type="text" class="form-control" name="management" placeholder="Introduce nombre de la gestión" id="uppercase_field" value="<?=$management_name;?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="management">Estado</label>
                                            <select name="management_state" id="" class="form-control">
                                                <option value="ACTIVO" <?= ($management['management_state'] == '1') ? 'selected' : ''; ?> >ACTIVO</option>
                                                <option value="INACTIVO" <?= ($management['management_state'] != '1') ? 'selected' : ''; ?> >INACTIVO</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Botones de Acción -->
                                <div class="row mb-3 text-center">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-success">Actualizar</button>
                                        <a href="<?=APP_URL;?>/admin/settings/management" class="btn btn-secondary">Cancelar</a>
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
<script src="../../../public/js/create_management.js"></script>

<?php
include ('../../../admin/layout/part_2.php');
include ('../../../layout/messages.php');
?>
