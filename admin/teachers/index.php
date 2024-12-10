<?php
include ('../../app/config.php');
include ('../../admin/layout/part_1.php');
include ('../../app/controllers/teachers/list_of_teachers.php');
?>

<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h1>Listado de Personal Docente</h1>
            </div>
            <br>
            <div class="row">
                <br>
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Personal Docente Registrado</h3>
                            <div class="card-tools">
                               <a href="create.php" class="btn btn-success"><i class="bi bi-person-plus"></i>  Crear nuevo docente</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive-sm">
                                <table id="example1" border="1" class="table table-striped table-bordered table-hover table-sm">
                                    <thead>
                                        <tr>
                                            <th class="text_center">Nro</th> 
                                            <th class="text_center">Nombre del usuario</th> 
                                            <th class="text_center d-none d-md-table-cell">Cédula de identidad</th> 
                                            <th class="text_center d-none d-md-table-cell">Rol</th> 
                                            <th class="text_center d-none d-md-table-cell">Email</th> 
                                            <th class="text_center d-none d-lg-table-cell">Especialidad</th> 
                                            <th class="text_center d-none d-md-table-cell">Estado</th> 
                                            <th class="text_center">Acciones</th> 
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $counter_users_teachers = 0; 
                                            foreach ($users_teachers as $users_teacher){
                                                $counter_users_teachers++;
                                        ?>
                                        <tr>
                                            <td class="text_center"><?=$counter_users_teachers;?></td> 
                                            <td class="text_center"><?=$users_teacher['first_name'].' '.$users_teacher['last_name'] ;?></td> 
                                            <td class="text_center d-none d-md-table-cell"><?= $users_teacher['identification_type'].'-'. $users_teacher['cedula'];?></td> 
                                            <td class="text_center d-none d-md-table-cell"><?=$users_teacher['name_rol'];?></td> 
                                            <td class="text_center d-none d-md-table-cell"><?=$users_teacher['email'];?></td> 
                                            <td class="text_center d-none d-lg-table-cell"><?=$users_teacher['specialty'];?></td> 
                                            
                                            <td class="text_center d-none d-md-table-cell">
                                                <?php if($users_teacher['user_state'] == '1' ){ ?>
                                                    <button class="btn btn-success btn-sm" style="border-radius: 20px; " style="background-image: linear-gradient(to top, #0fd850 0%, #f9f047 100%);" >ACTIVO</button>
                                                    <?php
                                                } else{ ?>
                                                         <button class="btn btn-danger btn-sm" style="border-radius: 20px;" >INACTIVO</button>
                                                <?php }  
                                                
                                                ?>
                                                
                                            </td>
                                            
                                            
                                            <td class="text_center">
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a href="show.php?id=<?=$users_teacher['id_user'];?>" type="button" class="btn btn-info btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Ver"><i class="bi bi-search"></i></a>
                                                    <a href="edit.php?id=<?=$users_teacher['id_user'];?>" type="button" class="btn btn-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar"><i class="bi bi-pencil-square"></i></a>
                                                    <form action="<?=APP_URL;?>/app/controllers/teachers/delete.php" method="post" onsubmit="return confirmDeletion(event, this);">
                                                        <input type="text" name="id_user" value="<?=$users_teacher['id_user'];?>" hidden>
                                                        <button type="submit" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Borrar"><i class="bi bi-trash3"></i></button>
                                                    </form>
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
include ('../../admin/layout/part_2.php');
include ('../../layout/messages.php')
?>
