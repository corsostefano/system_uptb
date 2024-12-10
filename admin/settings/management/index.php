<?php
include ('../../../app/config.php');
include ('../../../admin/layout/part_1.php');
include ('../../../app/controllers/settings/management/list_of_management.php');

?>

<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h1>Listado de Gestiones</h1>
            </div>
            <br>
            <div class="row">
                <br>
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Gestiones registradas</h3>
                            <div class="card-tools">
                               <a href="create.php" class="btn btn-success"><i class="bi bi-plus-square"></i>  Crear nueva gestión</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-striped table-bordered table-hover table-sm">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Nro</th> 
                                            <th class="text-center">Nombre de la gestión</th> 
                                            <th class="text-center d-none d-md-table-cell">Fecha y hora de Registro</th> 
                                            <th class="text-center d-none d-md-table-cell">Estado</th> 
                                            <th class="text-center">Acciones</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $counter_management = 0; 
                                            foreach ($managements as $management) {
                                                $counter_management++;
                                        ?>
                                        <tr>
                                            <td class="text-center"><?=$counter_management;?></td> 
                                            <td class="text-center text-wrap" style="max-width: 150px; word-wrap: break-word;">
                                                <?=$management['management'];?>
                                            </td>
                                            <td class="text-center d-none d-md-table-cell">
                                                <?=$management['fyh_creation'];?>
                                            </td>
                                            <td class="text-center d-none d-md-table-cell">
                                                <button class="btn btn-<?= $management['management_state'] == '1' ? 'success' : 'danger'; ?> btn-sm" style="border-radius: 20px;">
                                                    <?= $management['management_state'] == '1' ? 'ACTIVO' : 'INACTIVO'; ?>
                                                </button>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a href="show.php?id=<?=$management['id_management'];?>" class="btn btn-info btn-sm" data-bs-toggle="tooltip" title="Ver">
                                                        <i class="bi bi-search"></i>
                                                    </a>
                                                    <a href="edit.php?id=<?=$management['id_management'];?>" class="btn btn-success btn-sm" data-bs-toggle="tooltip" title="Editar">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                </div>
                                            </td> 
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php
include ('../../../admin/layout/part_2.php');
include ('../../../layout/messages.php')
?>
