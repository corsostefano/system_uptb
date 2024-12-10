<?php
$id_config_institution = $_GET['id'];
include ('../../../app/config.php');
include ('../../../admin/layout/part_1.php');

include('../../../app/controllers/settings/institution/data_institution.php');
?>

<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-center">
                    <h1>Modificar Datos de la Institución: <?=$name_institution;?> </h1>
                </div>
            </div>
            <br>
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title">Rellene el formulario</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?=APP_URL;?>/app/controllers/settings/institution/update.php" method="post" enctype="multipart/form-data" id="user-form">
                            <input type="hidden" name="id_config_institution" value="<?=$id_config_institution;?>">
                                <!-- Nombre de la Institución y Email -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name_institution">Nombre de la institución <b>*</b></label>
                                            <input type="text" class="form-control" name="name_institution" placeholder="Introduce nombre de la institución" value="<?=$name_institution;?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email_institution">Email <b>*</b></label>
                                            <input type="email" class="form-control" name="email_institution" placeholder="Correo electrónico de la institución" value="<?=$email_institution;?>" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Teléfono y Celular -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone_institution">Teléfono <b>*</b></label>
                                            <input type="number" class="form-control" name="phone_institution" placeholder="Introduce teléfono" value="<?=$phone_institution;?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cellular_institution">Celular <b>*</b></label>
                                            <input type="number" class="form-control" id="cellphone" name="cellular_institution" placeholder="Introduce número celular" value="<?=$cellular_institution;?>" required minlength="7" maxlength="10">
                                        </div>
                                    </div>
                                </div>

                                <!-- Dirección -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address_institution">Dirección <b>*</b></label>
                                            <input type="text" class="form-control" name="address_institution" placeholder="Introduce tu dirección" value="<?=$address_institution;?>" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Mostrar Imagen de Logo Actual -->
                                <div class="row mb-3 justify-content-center">
                                    <div class="col-md-6 text-center">
                                        <label>Logo Actual</label>
                                        <?php if (!empty($profile_picture)) : ?>
                                            <div id="current-logo">
                                                <img src="<?= APP_URL . $profile_picture; ?>" class="img-fluid rounded" alt="Logo Actual" style="max-width: 150px; height: auto;">
                                            </div>
                                        <?php else : ?>
                                            <p>No se ha cargado un logo aún.</p>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <!-- Logo Nuevo -->
                                <div class="row mb-3">
                                    <div class="col-md-6 offset-md-3">
                                        <div class="form-group">
                                            <label for="profile_picture">Nuevo Logo (Opcional)</label>
                                            <input type="file" class="form-control" name="profile_picture" id="profile_picture">
                                            <!-- Previsualización del nuevo logo -->
                                            <div id="image-preview" class="mt-2"></div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Botones de Acción -->
                                <div class="row mb-3 text-center">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-success">Actualizar</button>
                                        <a href="<?=APP_URL;?>/admin/settings/institution" class="btn btn-secondary">Cancelar</a>
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

<!-- Script de previsualización de imagen -->
<script>
function archivo(evt) {
    var files = evt.target.files;
    for (var i = 0, f; f = files[i]; i++) {
        if (!f.type.match('image.*')) {
            continue;
        }
        var reader = new FileReader();
        reader.onload = (function(theFile) {
            return function(e) {
                document.getElementById("image-preview").innerHTML = '<img class="thumb thumbnail" src="' + e.target.result + '" width="150px" title="' + theFile.name + '"/>';
            };
        })(f);
        reader.readAsDataURL(f);
    }
}

document.getElementById('profile_picture').addEventListener('change', archivo, false);
</script>

<!-- Estilos adicionales -->
<style>
    #image-preview, #current-logo {
        text-align: center;
    }
    #image-preview img, #current-logo img {
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 5px;
        width: 75px;
        margin-top: 10px;
    }
</style>

<?php
include ('../../../admin/layout/part_2.php');
include ('../../../layout/messages.php');
?>
