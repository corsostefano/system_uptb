<?php 
include ('../../app/config.php');
include ('../../admin/layout/part_1.php');

if (isset($_GET['id'])) {
    $id_rol = $_GET['id']; 
} else {
    echo "Error: No se recibió el id_rol en la URL.";
    exit; 
}

include ('../../app/controllers/roles/data_rol.php');  // Aquí obtenemos los datos del rol a editar
?>

<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h1>Editar el rol: <?=$name_rol;?> </h1>
            </div>
            <br>
            <div class="row">
                <br>
                <div class="col-md-6">
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title">Datos Registrados</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?=APP_URL;?>/app/controllers/roles/update.php" method="post">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name_rol">Nombre del rol</label>
                                            <input type="text" name="id_rol" value="<?=$id_rol;?>" hidden>
                                            <input type="text" id="name_rol" class="form-control" value="<?=$name_rol;?>" name="name_rol" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="category">Categoría</label>
                                            <select id="category" name="category" class="form-control" required>
                                                <option value="admin" <?=($category == 'admin' ? 'selected' : '')?>>Administrativo</option>
                                                <option value="teacher" <?=($category == 'teacher' ? 'selected' : '')?>>Docente</option>
                                                <option value="student" <?=($category == 'student' ? 'selected' : '')?>>Estudiante</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success">Actualizar</button>
                                            <a href="<?=APP_URL;?>/admin/roles" class="btn btn-secondary">Cancelar</a>
                                        </div>
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

<?php
include ('../../admin/layout/part_2.php');
include ('../../layout/messages.php');
?>
