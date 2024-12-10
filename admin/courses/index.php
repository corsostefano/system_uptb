<?php
include ('../../app/config.php');
include ('../../admin/layout/part_1.php');
include ('../../app/controllers/courses/list_of_courses.php');

?>

<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h1>Listado de Materias</h1>
            </div>
            <br>
            <div class="row">
                <br>
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Materias registrados</h3>
                            <div class="card-tools">
                               <a href="create.php" class="btn btn-success"><i class="bi bi-plus-square"></i>  Crear nueva materia</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive-sm">
                                <table id="example1" border="1" class="table table-striped table-bordered table-hover table-sm">
                                    <thead>
                                        <tr>
                                            <th class="text_center">Nro</th> 
                                            <th class="text_center">Nombre de la materia</th> 
                                            <th class="text_center">Fecha de creación</th> 
                                            
                                            <th class="text_center d-none d-md-table-cell">Estado</th> 
                                            <th class="text_center">Acciones</th> 
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $counter_courses = 0; 
                                            foreach ($courses as $course){
                                                $counter_courses++;
                                        ?>
                                        <tr>
                                            <td class="text_center"><?=$counter_courses;?></td> 
                                            <td class="text-center text-wrap" style="max-width: 100px; white-space: normal;">
                                                <?=$course['name_course'];?>
                                            </td>
                                            <td class="text_center d-none d-md-table-cell"><?=$course['fyh_creation'];?></td>

                                            <td class="text_center d-none d-md-table-cell">
                                                <?php if($course['course_state'] == '1' ){ ?>
                                                    <button class="btn btn-success btn-sm" style="border-radius: 20px;" >ACTIVO</button>
                                                    <?php
                                                } else{ ?>
                                                         <button class="btn btn-danger btn-sm" style="border-radius: 20px;" >INACTIVO</button>
                                                <?php }  
                                                
                                                ?>
                                                
                                            </td>
                                            <td class="text_center">
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a href="show.php?id=<?=$course['id_courses'];?>" type="button" class="btn btn-info btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Ver"><i class="bi bi-search"></i></a>
                                                    <a href="edit.php?id=<?=$course['id_courses'];?>" type="button" class="btn btn-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar"><i class="bi bi-pencil-square"></i></a>
                                                    <form action="<?=APP_URL;?>/app/controllers/courses/delete.php" method="post" onsubmit="return confirmDeletion(event, this);">
                                                        <input type="text" name="id_courses" value="<?=$course['id_courses'];?>" hidden>
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
