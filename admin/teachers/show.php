<?php
$id_user = $_GET['id'];

include ('../../app/config.php');
include ('../../admin/layout/part_1.php');
include ('../../app/controllers/teachers/data_teachers.php');

//Transformar el formato de fecha creación
$dateAndTime = new DateTime($fyh_creation);
$dateformat = $dateAndTime -> format('d-m-y h:i:s a');

//Transformar el formato de la fecha de nacimiento
// Crear objeto DateTime con la fecha de nacimiento
$birth_date_obj = new DateTime($birth_date);

// Formatear la fecha para que muestre día, mes en palabras y año completo
$birth_date_format = $birth_date_obj->format('j \d\e F \d\e\l Y');

// Convertir el nombre del mes a español
setlocale(LC_TIME, 'es_ES.UTF-8');
$birth_date_format = strftime('%d de %B del %Y', strtotime($birth_date));

//Calcular la edad en base a la fecha de nacimiento
$birth_date_obj = new DateTime($birth_date);
$today = new DateTime();
$age = $today->diff($birth_date_obj)->y;
?>

<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container">
            <!-- Título del Usuario -->
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <h1>Usuario Docente: <?=$first_name . ' ' . $last_name;?></h1>
                </div>
            </div>

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
                            <h4 class="mb-3 text-center">Información Personal</h4>
                            <div class="row mb-3 text-center">
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label><strong>Nombre (s):</strong></label>
                                        <p class="text-muted"><?=$first_name?></p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label><strong>Apellido (s):</strong></label>
                                        <p class="text-muted"><?=$last_name?></p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label><strong>Email:</strong></label>
                                        <p class="text-muted"><?=$email;?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3 text-center">
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label><strong>Cédula:</strong></label>
                                        <p class="text-muted"><?=$identification_type.'-'.$cedula;?></p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label><strong>Fecha de Nacimiento:</strong></label>
                                        <p class="text-muted"><?=$birth_date_format;?></p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label><strong>Sexo:</strong></label>
                                        <p class="text-muted"><?=$sex;?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3 text-center">
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label><strong>Edad:</strong></label>
                                        <p class="text-muted"><?=$age;?></p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label><strong>Estado Civil:</strong></label>
                                        <p class="text-muted"><?=$marital_status;?></p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label><strong>Fecha de Registro:</strong></label>
                                        <p class="text-muted"><?=$dateformat;?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3 text-center">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="phone">Teléfono</label>
                                            <p class="text-muted"><?=$phone;?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="mobile">Celular</label>
                                            <p class="text-muted"><?=$mobile;?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="emergency_contact">Contacto de emergencia</label>
                                            <p class="text-muted"><?=$emergency_contact;?></p>
                                        </div>
                                    </div>
                            </div>


                            <!-- Sección: Información Académica y Laboral -->
                            <h4 class="mb-3 text-center">Información Académica y Laboral</h4>
                            <div class="row mb-3 text-center">
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label><strong>Rol o Cargo:</strong></label>
                                        <p class="text-muted"><?=$name_rol;?></p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label><strong>Profesión u Ocupación:</strong></label>
                                        <p class="text-muted"><?=$profession;?></p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label><strong>Estado:</strong></label>
                                        <p class="text-muted"><?=( $user_state == '1') ? 'ACTIVO' : 'INACTIVO'; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3 text-center">
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label><strong>Sede Universitaria:</strong></label>
                                        <p class="text-muted"><?=$university_campus;?></p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label><strong>Especialidad:</strong></label>
                                        <p class="text-muted"><?=$specialty;?></p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label><strong>Antigüedad:</strong></label>
                                        <p class="text-muted"><?=$seniority;?> año</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Sección: Ubicación -->
                            <h4 class="mb-3 text-center">Ubicación</h4>
                            <div class="row mb-3 text-center">
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label><strong>Dirección:</strong></label>
                                        <p class="text-muted"><?=$address_user?></p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label><strong>Municipio de Residencia:</strong></label>
                                        <p class="text-muted"><?=$municipality;?></p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label><strong>Estado de Residencia:</strong></label>
                                        <p class="text-muted"><?=$state_of_residence;?></p>
                                    </div>
                                </div>
                            </div>

                            <!-- Botón de Retorno -->
                            <div class="row mb-3 text-center">
                                <div class="col-12 text-center mt-4">
                                    <a href="<?=APP_URL;?>/admin/teachers" class="btn btn-secondary">Volver</a>
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
  