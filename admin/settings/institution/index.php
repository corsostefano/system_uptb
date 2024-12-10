<?php
include ('../../../app/config.php');
include ('../../../admin/layout/part_1.php');
include ('../../../app/controllers/settings/institution/list_of_institution.php');

?>

<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h1>Listado de Instituciones</h1>
            </div>
            <br>
            <div class="row">
                <br>
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Instituciones registradas</h3>
                            <div class="card-tools">
                               <a href="create.php" class="btn btn-success"><i class="bi bi-plus-square"></i>  Crear nueva institución</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive-sm">
                                <table id="example1" border="1" class="table table-striped table-bordered table-hover table-sm">
                                    <thead>
                                        <tr>
                                            <th class="text_center">Nro</th> 
                                            <th class="text_center">Nombre de la institución</th> 
                                            <th class="text_center d-none d-md-table-cell">Logo</th> 
                                            <th class="text_center d-none d-md-table-cell">Dirección</th> 
                                            <th class="text_center d-none d-md-table-cell">Teléfono</th> 
                                            <th class="text_center d-none d-lg-table-cell">Email</th> 
                                            <th class="text_center d-none d-md-table-cell">Estado</th> 
                                            <th class="text_center">Acciones</th> 
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $counter_institution = 0; 
                                            foreach ($institutions as $institution){
                                                $counter_institution++;
                                        ?>
                                        <tr>
                                            <td class="text_center"><?=$counter_institution;?></td> 
                                            <td class="text-center text-wrap" style="max-width: 100px; white-space: normal;">
                                                <?=$institution['name_institution'];?>
                                            </td>
                                            <td class="text_center d-none d-md-table-cell"> <img src="<?=APP_URL;?><?=$institution['profile_picture'];?>" alt="" width="50"></td> 
                                            <td class="text_center d-none d-md-table-cell"><?=$institution['address_institution'];?></td> 
                                            <td class="text_center d-none d-md-table-cell"><?=$institution['phone_institution'];?></td> 
                                            <td class="text_center d-none d-lg-table-cell"><?=$institution['email_institution'];?></td> 
                                            <td class="text_center d-none d-md-table-cell">
                                                <?php if($institution['institution_state'] == '1' ){ ?>
                                                    <button class="btn btn-success btn-sm" style="border-radius: 20px;" >ACTIVO</button>
                                                    <?php
                                                } else{ ?>
                                                         <button class="btn btn-danger btn-sm" style="border-radius: 20px;" >INACTIVO</button>
                                                <?php }  
                                                
                                                ?>
                                                
                                            </td>
                                            <td class="text_center">
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a href="show.php?id=<?=$institution['id_config_institution'];?>" type="button" class="btn btn-info btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Ver"><i class="bi bi-search"></i></i></a>
                                                    <a href="edit.php?id=<?=$institution['id_config_institution'];?>" type="button" class="btn btn-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar"><i class="bi bi-pencil-square"></i></a>
                                                    <form action="<?=APP_URL;?>/app/controllers/settings/institution/delete.php" method="post" onsubmit="return confirmDeletion(event, this);">
                                                        <input type="text" name="id_config_institution" value="<?=$institution['id_config_institution'];?>" hidden>
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
include ('../../../admin/layout/part_2.php');
include ('../../../layout/messages.php')
?>
