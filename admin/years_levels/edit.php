<?php
$id_levels = $_GET['id'];
include ('../../app/config.php');
include ('../../admin/layout/part_1.php');
include ('../../app/controllers/academic_programs/list_of_programs.php');
include ('../../app/controllers/years_levels/data_years_levels.php');
?>

<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-center">
                    <h1>Modificar o nivel: <?=$years_level;?></h1>
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
                            <form action="<?=APP_URL;?>/app/controllers/years_levels/update.php" method="post">
                                <!-- Nombre de la Gestión -->
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" name="id_levels" value="<?=$id_levels;?>" hidden>
                                            <label for="academic_programs_id">PNF<b>*</b></label>
                                            <select name="academic_programs_id" id="" class="form-control" >
                                                <?php
                                                    foreach($programs as $program){ 
                                                        if($program['programs_state'] == '1'){?>
                                                        
                                                        <option value="<?=$program['id_academic_programs'];?>" 
                                                        <?php if($academic_programs_id == $program['id_academic_programs']){?> selected = "selected" <?php } ?>>
                                                            <?=$program['programs_name'];?>
                                                        </option>    
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
                                            <label for="years_level">Nombre de año o nivel<b>*</b></label>
                                            <input type="text" class="form-control" name="years_level" placeholder="Introduce nombre del nuevo PNF" id="uppercase_field" value="<?=$years_level?>" required>
                                        </div>
                                    </div>
                                </div>
                                <!--Seleccionar Sección-->
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="section">Sección<b>*</b></label>
                                            <select name="section" id="" class="form-control"requiere >
                                                <option value="A" <?php if($section  == 'A'){?> selected="selected" <?php }?> >A</option>
                                                <option value="B" <?php if($section  == 'B'){?> selected="selected" <?php }?>>B</option>
                                                <option value="C" <?php if($section  == 'C'){?> selected="selected" <?php }?>>C</option>
                                                <option value="D" <?php if($section  == 'D'){?> selected="selected" <?php }?>>D</option>
                                                <option value="E" <?php if($section  == 'E'){?> selected="selected" <?php }?>>E</option>
                                                <option value="F" <?php if($section  == 'F'){?> selected="selected" <?php }?>>F</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="levels_state">Estado</label>
                                            <select name="levels_state" id="" class="form-control">
                                                <option value="ACTIVO" <?= ($levels_state == '1') ? 'selected' : ''; ?> >ACTIVO</option>
                                                <option value="INACTIVO" <?= ($levels_state!= '1') ? 'selected' : ''; ?> >INACTIVO</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Botones de Acción -->
                                <div class="row mb-3 text-center">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-success">Registrar</button>
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
