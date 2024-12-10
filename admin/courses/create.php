<?php
include ('../../app/config.php');
include ('../../admin/layout/part_1.php');

?>

<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-center">
                    <h1>Registro de una nueva materia</h1>
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
                            <form action="<?=APP_URL;?>/app/controllers/courses/create.php" method="post">
                                <!-- Nombre de la Materia -->
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name_course">Nueva Materia<b>*</b></label>
                                            <input type="text" class="form-control" name="name_course" placeholder="Introduce nombre de la materia" id="uppercase_field" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="course_state">Estado</label>
                                            <select name="course_state" id="" class="form-control">
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
                                        <a href="<?=APP_URL;?>/admin/courses" class="btn btn-secondary">Cancelar</a>
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
