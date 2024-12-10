<?php
include ('../../../app/config.php');
include ('../../../admin/layout/part_1.php');
?>

<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-center">
                    <h1>Registro de Datos de la Institución</h1>
                </div>
            </div>
            <br>
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Rellene el formulario</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?=APP_URL;?>/app/controllers/settings/institution/create.php" method="post" enctype="multipart/form-data" id="user-form">
                                <!-- Nombre de la Institución y Logo -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name_institution">Nombre de la institución <b>*</b></label>
                                            <input type="text" class="form-control" name="name_institution" placeholder="Introduce nombre de la institución" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email_institution">Email <b>*</b></label>
                                            <input type="email" class="form-control" name="email_institution" placeholder="Correo electrónico de la institución" required>
                                        </div>
                                    </div>
                                   
                                </div>

                                <!-- Email, Teléfono, y Celular -->
                                <div class="row mb-3">
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone_institution">Teléfono <b>*</b></label>
                                            <input type="number" class="form-control" name="phone_institution" placeholder="Introduce teléfono" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cellular_institution">Celular <b>*</b></label>
                                            <input type="number" class="form-control" id="cellphone" name="cellular_institution" placeholder="Introduce número celular" required minlength="7" maxlength="10">
                                        </div>
                                    </div>
                                </div>

                                <!-- Dirección -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address_institution">Dirección <b>*</b></label>
                                            <input type="text" class="form-control" name="address_institution" placeholder="Introduce tu dirección" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="profile_picture">Logo</label>
                                            <input type="file" class="form-control" name="profile_picture" id="profile_picture">
                                        </div>
                                    </div>
                                </div>
                               

                                <!-- Botones de Acción -->
                                <div class="row mb-3 text-center">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary">Registrar</button>
                                        <a href="<?=APP_URL;?>/admin/settings" class="btn btn-secondary">Cancelar</a>
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
    #image-preview {
        text-align: center;
    }
    #image-preview img {
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
