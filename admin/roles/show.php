<?php 
include ('../../app/config.php');
include ('../../admin/layout/part_1.php');


if (isset($_GET['id'])) {
    $id_rol = $_GET['id']; 
} else {
    echo "Error: No se recibió el id_rol en la URL.";
    exit; 
}

include ('../../app/controllers/roles/data_rol.php');
?>

<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h1>Rol: <?=$name_rol;?> </h1>
            </div>
            <br>
            <div class="row">
                <br>
                <div class="col-md-6">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Datos Registrados</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Nombre del rol</label>
                                        <p><?=$name_rol;?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <a href="<?=APP_URL;?>/admin/roles" class="btn btn-secondary" >Regresar</a>
                                    </div>
                                </div>
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
  