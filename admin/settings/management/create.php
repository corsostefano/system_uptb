<?php
include ('../../../app/config.php');
include ('../../../admin/layout/part_1.php');
?>

<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-center">
                    <h1>Registro de nueva gestión universitaria</h1>
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
                            <form action="<?=APP_URL;?>/app/controllers/settings/management/create.php" method="post">
                                <!-- Nombre de la Gestión -->
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="management">Gestión Educativa<b>*</b></label>
                                            <input type="text" class="form-control" name="management" placeholder="Introduce nombre de la gestión" id="uppercase_field" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="management">Estado</label>
                                            <select name="management_state" id="" class="form-control">
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
