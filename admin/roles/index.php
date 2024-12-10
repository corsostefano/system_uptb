<?php
include ('../../app/config.php');
include ('../../admin/layout/part_1.php');
include ('../../app/controllers/roles/list_of_roles.php');
include ('../../app/controllers/roles/list_of_permissions.php');
?>

<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h1>Listado de Roles</h1>
            </div>
            <br>
            <div class="row">
                <br>
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Roles registrados</h3>
                            <div class="card-tools">
                               <a href="create.php" class="btn btn-success"><i class="bi bi-plus-square"></i>  Crear nuevo rol</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive" >
                                <table id="example1" border="1" class="table table-striped table-bordered table-hover table-sm">
                                    <thead>
                                        <tr>
                                            <th>Nro</th>
                                            <th>Nombre del rol</th>
                                            <th>Categoría</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $counter_rol = 0;
                                            foreach ($roles as $role){
                                                $id_rol = $role['id_rol'];
                                                $name_rol = $role['name_rol'];
                                                $category = $role['category'];
                                                $counter_rol++;
                                        ?>
                                            <tr>
                                                <td class="text_center"><?=$counter_rol;?></td>
                                                <td><?=$name_rol?></td>
                                                <td><?=$category?></td>
                                                <td class="text_center" >
                                                        <div>
                                                        <a href="create_roles_permissions.php?id=<?=$id_rol;?>" class="btn btn-warning btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Permisos">
                                                        <i class="bi bi-unlock"></i>
                                                        </a>
                                                        <!-- Botón para ver -->
                                                        <a href="show.php?id=<?=$id_rol;?>" class="btn btn-info btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Ver">
                                                            <i class="bi bi-search"></i>
                                                        </a>

                                                        <!-- Botón para editar -->
                                                        <a href="edit.php?id=<?=$id_rol;?>" class="btn btn-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </a>

                                                        <!-- Formulario para eliminar -->
                                                        <form action="<?=APP_URL;?>/app/controllers/roles/delete.php" method="post" class="d-inline" onsubmit="return confirmDeletion(event, this);">
                                                            <input type="text" name="id_rol" value="<?=$id_rol;?>" hidden>
                                                            <button type="submit" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Borrar">
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
