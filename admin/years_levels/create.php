<?php
include ('../../app/config.php');
include ('../../admin/layout/part_1.php');
include ('../../app/controllers/academic_programs/list_of_programs.php');

?>

<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-center">
                    <h1>Registro de un nuevo año o nivel</h1>
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
                            <form action="<?=APP_URL;?>/app/controllers/years_levels/create.php" method="post">
                                <!-- Nombre del año -->
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="academic_programs_id">PNF<b>*</b></label>
                                            <select name="academic_programs_id" id="" class="form-control" >
                                                <?php
                                                    foreach($programs as $program){ 
                                                        if($program['programs_state'] == '1'){?>
                                                        <option value="<?=$program['id_academic_programs'];?>" ><?=$program['programs_name'];?></option>    
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
                                            <label for="years_level">Nuevo año o nivel<b>*</b></label>
                                            <input type="text" class="form-control" name="years_level" placeholder="Introduce nombre del nuevo año" id="uppercase_field" required>
                                        </div>
                                    </div>
                                </div>
                                <!--Seleccionar PNF-->
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="section">Sección<b>*</b></label>
                                            <select name="section" id="" class="form-control"requiere >
                                                <option value="">Seleccione una Sección</option>
                                                <option value="A">A</option>
                                                <option value="B">B</option>
                                                <option value="C">C</option>
                                                <option value="D">D</option>
                                                <option value="E">E</option>
                                                <option value="F">F</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="levels_state">Estado</label>
                                            <select name="levels_state" id="" class="form-control">
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
                                        <a href="<?=APP_URL;?>/admin/years_levels" class="btn btn-secondary">Cancelar</a>
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
