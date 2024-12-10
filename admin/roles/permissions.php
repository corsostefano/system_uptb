<?php
include ('../../app/config.php');
include ('../../admin/layout/part_1.php');
include ('../../app/controllers/roles/list_of_permissions.php')
?>

<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h1>Listado de Permisos</h1>
            </div>
            <br>
            <div class="row">
                <br>
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Permisos registrados</h3>
                            <div class="card-tools">
                               <a href="create_permissions.php" class="btn btn-success"><i class="bi bi-plus-square"></i>  Crear nuevo Permiso</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive" >
                                <table id="example1" border="1" class="table table-striped table-bordered table-hover table-sm">
                                    <thead>
                                        <tr>
                                            <th>Nro</th>
                                            <th>Nombre del rol</th>
                                            <th>Nombre de la url</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $counter_permission = 0;
                                            foreach ($permissions as $permission){
                                                $id_permission = $permission['id_permission'];
                                                $name_url= $permission['name_url'];
                                                $url= $permission['url'];
                                                $counter_permission++;
                                        ?>
                                            <tr>
                                                <td class="text_center"><?=$counter_permission;?></td>
                                                <td><?=$name_url?></td>
                                                <td><?=$url?></td>
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center align-items-center gap-2">
                                                        <!-- Botón para Editar -->
                                                        <a href="edit_permissions.php?id=<?=$id_permission;?>" class="btn btn-success btn-sm d-flex align-items-center justify-content-center" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </a>

                                                        <!-- Botón para Borrar dentro del formulario -->
                                                        <form action="<?=APP_URL;?>/app/controllers/roles/delete_permissions.php" method="post" onsubmit="return confirmDeletion(event, this);" class="m-0">
                                                            <input type="hidden" name="id_permission" value="<?=$id_permission;?>">
                                                            <button type="submit" class="btn btn-danger btn-sm d-flex align-items-center justify-content-center" data-bs-toggle="tooltip" data-bs-placement="top" title="Borrar">
                                                                <i class="bi bi-trash3"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>


                                            </tr>
                                        <?php
                                        }
                                        ?>
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
include ('../../admin/layout/part_2.php');
include ('../../layout/messages.php')
?>
