<?php
$id_config_institution = $_GET['id'];
include ('../../../app/config.php');
include ('../../../admin/layout/part_1.php');

include('../../../app/controllers/settings/institution/data_institution.php');
?>
<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container">
            <!-- Título de la Institución -->
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <h1>Institución: <?= $name_institution; ?></h1>
                </div>
            </div>

            <!-- Card de Datos Registrados -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-info">
                        <div class="card-header text-center">
                            <h3 class="card-title">Datos Registrados</h3>
                        </div>
                        <div class="card-body">

                            <!-- Sección: Imagen de Perfil -->
                            <div class="row mb-4 justify-content-center">
                                <div class="col-12 col-md-3 text-center">
                                    <img src="<?= APP_URL . $profile_picture; ?>" 
                                         class="img-fluid mx-auto rounded" 
                                         alt="User Image" 
                                         style="max-width: 150px; height: auto;">
                                </div>
                            </div>

                            <!-- Sección: Información Personal -->
                            <h4 class="mb-3 text-center">Información Institucional</h4>
                            
                            <!-- Información Básica -->
                            <div class="row mb-3 text-center">
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label><strong>Nombre de la Institución:</strong></label>
                                        <p class="text-muted"><?= $name_institution; ?></p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label><strong>Correo Electrónico:</strong></label>
                                        <p class="text-muted"><?= $email_institution; ?></p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label><strong>Teléfono:</strong></label>
                                        <p class="text-muted"><?= $phone_institution; ?></p>
                                    </div>
                                </div>
                            </div>

                            <!-- Información Adicional -->
                            <div class="row mb-3 text-center">
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label><strong>Celular:</strong></label>
                                        <p class="text-muted"><?= $cellular_institution; ?></p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label><strong>Dirección:</strong></label>
                                        <p class="text-muted"><?= $address_institution; ?></p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label><strong>Fecha de registro:</strong></label>
                                        <p class="text-muted"><?= $fyh_creation; ?></p>
                                    </div>
                                </div>
                            </div>

                            <!-- Estado de la Institución -->
                            <div class="row mb-3 text-center">
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label><strong>Estado:</strong></label>
                                        <p class="text-muted"><?= ($institution_state == '1') ? 'ACTIVO' : 'INACTIVO'; ?></p>
                                    </div>
                                </div>
                            </div>

                            <!-- Botón de Retorno -->
                            <div class="row mb-3 text-center">
                                <div class="col-12 mt-4">
                                    <a href="<?= APP_URL; ?>/admin/settings/institution" class="btn btn-secondary">Volver</a>
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
include ('../../../admin/layout/part_2.php');
include ('../../../layout/messages.php');
?>
