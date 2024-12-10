<?php
// Incluir configuraciones y archivos necesarios
include ('../../app/config.php'); // Configuración de la base de datos
include ('../../admin/layout/part_1.php'); // Cabecera del layout
include ('../../app/controllers/courses/list_of_courses_associate.php'); // Controlador para obtener datos
?>

<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h1>Listado de materias asignadas por año o nivel</h1>
            </div>
            <br>
            <div class="row">
                <br>
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Materias Registradas</h3>
                            <div class="card-tools">
                               <a href="create_association.php" class="btn btn-success"><i class="bi bi-plus-square"></i>  Asignar materia a nivel o año</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive-sm">
                                <table id="example1" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text_center">Materia</th>
                                            <th class="text_center">Nivel</th>
                                            <th class="text_center">Programa Académico</th> <!-- Nueva columna para el programa -->
                                            <th class="text_center">Sección</th>    <!-- Nueva columna -->
                                            <th class="text_center">Turno</th>      <!-- Nueva columna -->
                                            <th class="text_center">Fecha de Creación</th>
                                            <th class="text_center">Estado</th>
                                            <th class="text_center">Acciones</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($associations as $association): ?>
                                            <tr>
                                                <td class="text_center"><?= htmlspecialchars($association['name_course']); ?></td>
                                                <td class="text_center"><?= htmlspecialchars($association['years_level']); ?></td>
                                                <td class="text_center"><?= htmlspecialchars($association['programs_name']); ?></td> <!-- Mostrar el nombre del programa académico -->
                                                <td class="text_center"><?= htmlspecialchars($association['section']); ?></td>    <!-- Mostrar sección -->
                                                <td class="text_center"><?= htmlspecialchars($association['shift']); ?></td>      <!-- Mostrar turno -->
                                                <td class="text_center"><?= htmlspecialchars($association['fyh_creation']); ?></td>

                                                <td class="text_center d-none d-md-table-cell">
                                                    <?php if($association['level_courses_state'] == '1' ){ ?>
                                                        <button class="btn btn-success btn-sm" style="border-radius: 20px;" >ACTIVO</button>
                                                        <?php
                                                    } else{ ?>
                                                            <button class="btn btn-danger btn-sm" style="border-radius: 20px;" >INACTIVO</button>
                                                    <?php }  
                                                    
                                                    ?>
                                                </td>
                                                <td class="text_center">
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a href="show_association.php?id=<?=$association['id_level_courses'];?>" type="button" class="btn btn-info btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Ver"><i class="bi bi-search"></i></a>
                                                    <a href="edit_association.php?id=<?=$association['id_level_courses'];?>" type="button" class="btn btn-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar"><i class="bi bi-pencil-square"></i></a>
                                                    <form action="<?=APP_URL;?>/app/controllers/courses/delete_associate.php" method="post" onsubmit="return confirmDeletion(event, this);">
                                                        <input type="text" name="id_level_courses" value="<?=$association['id_level_courses'];?>" hidden>
                                                        <button type="submit" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Borrar"><i class="bi bi-trash3"></i></button>
                                                    </form>
                                                </div>
                                            </td> 

                                               
                                            </tr>
                                        <?php endforeach; ?>
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
// Incluir pie de página y otros recursos
include ('../../admin/layout/part_2.php');
include ('../../layout/messages.php');
?>
