<?php
include ('../../app/config.php');
include ('../../admin/layout/part_1.php');
include ('../../app/controllers/roles/list_of_roles.php');

?>

<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h1>Creación de un nuevo usuario</h1>
            </div>
            <br>
            <div class="row">
                <br>
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Rellene el formulario</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?=APP_URL;?>/app/controllers/users/create.php" method="post" enctype="multipart/form-data" id="user-form">
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="profile_picture">Foto de perfil</label>
                                            <input type="file" class="form-control" name="profile_picture" id="profile_picture">
                                        </div>
                                    </div>
                                </div>
                                <h4 class="mb-3 text-center">Información Personal</h4>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="rol_id">Nombre del rol</label>
                                            <div class="form-inline">
                                                <select name="rol_id" id="rol_id" class="form-control" onchange="updateCategory()">
                                                    <?php foreach ($roles as $role) { ?>
                                                        <option value="<?=$role['id_rol'];?>" data-category="<?=$role['category'];?>"><?=$role['name_rol'];?></option>
                                                    <?php } ?>
                                                </select>
                                                <input type="hidden" name="rol_category" id="rol_category" value="">
                                                <a href="<?=APP_URL;?>/admin/roles/create.php" class="btn btn-primary btn-sm" style="margin-left: 5px" data-bs-toggle="tooltip" data-bs-placement="top" title="Crear nuevo rol">
                                                    <i class="bi bi-plus-square"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="first_name">Nombre (s)</label>
                                            <input type="text" class="form-control" name="first_name" placeholder="Introduce tu nombre" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="last_name">Apellidos (s)</label>
                                            <input type="text" class="form-control" name="last_name" placeholder="Introduce tu nombre" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" name="email" placeholder="Introduce tu correo electrónico" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="identification_type">Tipo de identificación</label>
                                            <select name="identification_type" id="identification_type" class="form-control" required>
                                                <option value="V">V - Venezolano</option>
                                                <option value="E">E - Extranjero</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="cedula">Cédula</label>
                                            <input type="text" class="form-control" id="cedula" name="cedula" placeholder="Introduce tu cédula" required minlength="7" maxlength="10">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="identification_type">Sexo</label>
                                            <select name="sex" id="identification_type" class="form-control" required>
                                                    <option value="">Seleccione un sexo</option>
                                                    <option value="M">Masculino</option>
                                                    <option value="F">Femenino</option>
                                                    <option value="O">Otros</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="marital_status">Estado Civil</label>
                                            <select name="marital_status" id="marital_status" class="form-control" required>
                                                <option value="Soltero">Soltero</option>
                                                <option value="Casado">Casado</option>
                                                <option value="Divorciado">Divorciado</option>
                                                <option value="Viudo">Viudo</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="birth_date">Fecha de nacimiento</label>
                                            <input type="date" class="form-control" name="birth_date" id="birth_date" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="phone">Teléfono</label>
                                            <input type="tel" class="form-control" name="phone" id="phone" placeholder="Introduce tu número de teléfono" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="mobile">Celular</label>
                                            <input type="tel" class="form-control" name="mobile" id="mobile" placeholder="Introduce tu número de celular" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="emergency_contact">Contacto de emergencia</label>
                                            <input type="tel" class="form-control" name="emergency_contact" id="emergency_contact" placeholder="Introduce tu número de emergencia" required>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="mb-3 text-center">Información Académica y Laboral</h4>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="education">Estudios</label>
                                            <select class="form-control" name="education" id="education" required>
                                                <option value="">Seleccione su nivel de estudios</option>
                                                <option value="Primaria">Primaria</option>
                                                <option value="Bachiller">Bachiller</option>
                                                <option value="Técnico">Técnico</option>
                                                <option value="Universitario">Universitario</option>
                                                <option value="Postgrado">Postgrado</option>
                                                <option value="Doctorado">Doctorado</option>
                                                <option value="Otros">Otros</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="university_campus">Sede Universitaria</label>
                                            <select name="university_campus" id="university_campus" class="form-control" required>
                                                <option value="">Seleccione una sede</option>
                                                <option value="Barinas">Barinas</option>
                                                <option value="Barinitas">Barinitas</option>
                                                <option value="Pedraza">Pedraza</option>
                                                <option value="Socopó">Socopó</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="profession">Profesión u Oficio</label>
                                            <select name="profession" id="profession" class="form-control" required>
                                                <option value="">Seleccione su profesión u oficio</option>
                                                <option value="Administrador">Administrador</option>
                                                <option value="Abogado">Abogado</option>
                                                <option value="Albañil">Albañil</option>
                                                <option value="Arquitecto">Arquitecto</option>
                                                <option value="Carpintero">Carpintero</option>
                                                <option value="Chef">Chef</option>
                                                <option value="Contador">Contador</option>
                                                <option value="Docente">Docente</option>
                                                <option value="Electricista">Electricista</option>
                                                <option value="Enfermero">Enfermero</option>
                                                <option value="Estudiante">Estudiante</option>
                                                <option value="Ingeniero">Ingeniero</option>
                                                <option value="Médico">Médico</option>
                                                <option value="Mecánico">Mecánico</option>
                                                <option value="Plomero">Plomero</option>
                                                <option value="Policía">Policía</option>
                                                <option value="Psicólogo">Psicólogo</option>
                                                <option value="Secretario">Secretario</option>
                                                <option value="Soldador">Soldador</option>
                                                <option value="Tecnólogo">Tecnólogo</option>
                                                <option value="Vendedor">Vendedor</option>
                                                <option value="Otros">Otros</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="mb-3 text-center">Ubicación</h4>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="address_user">Dirección</label>
                                            <input type="text" class="form-control" name="address_user" placeholder="Introduce tu dirección" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="state_of_residence">Estado de Residencia</label>
                                            <select name="state_of_residence" id="state_of_residence" class="form-control" required>
                                                <option value="">Seleccione su estado de residencia</option>
                                                <option value="Amazonas">Amazonas</option>
                                                <option value="Anzoátegui">Anzoátegui</option>
                                                <option value="Apure">Apure</option>
                                                <option value="Aragua">Aragua</option>
                                                <option value="Barinas">Barinas</option>
                                                <option value="Bolívar">Bolívar</option>
                                                <option value="Carabobo">Carabobo</option>
                                                <option value="Cojedes">Cojedes</option>
                                                <option value="Delta Amacuro">Delta Amacuro</option>
                                                <option value="Distrito Capital">Distrito Capital</option>
                                                <option value="Falcón">Falcón</option>
                                                <option value="Guárico">Guárico</option>
                                                <option value="Lara">Lara</option>
                                                <option value="Mérida">Mérida</option>
                                                <option value="Miranda">Miranda</option>
                                                <option value="Monagas">Monagas</option>
                                                <option value="Nueva Esparta">Nueva Esparta</option>
                                                <option value="Portuguesa">Portuguesa</option>
                                                <option value="Sucre">Sucre</option>
                                                <option value="Táchira">Táchira</option>
                                                <option value="Trujillo">Trujillo</option>
                                                <option value="Vargas">Vargas</option>
                                                <option value="Yaracuy">Yaracuy</option>
                                                <option value="Zulia">Zulia</option>
                                                <option value="Dependencias Federales">Dependencias Federales</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="municipality">Municipio</label>
                                            <select name="municipality" id="municipality" class="form-control" required>
                                                <option value="">Seleccione primero un estado</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <h4 class="mb-3 text-center">Contraseña</h4>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="user_password">Contraseña</label>
                                            <input type="password" class="form-control" name="user_password" placeholder="Introduce una contraseña" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="user_password_repeat">Confirma tu Contraseña</label>
                                            <input type="password" class="form-control" name="user_password_repeat" placeholder="Reingresa tu contraseña" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3 text-center">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Registrar</button>
                                            <a href="<?=APP_URL;?>/admin/users" class="btn btn-secondary">Cancelar</a>
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

<script src="../../public/js/create_user.js"></script>


<?php
include ('../../admin/layout/part_2.php');
include ('../../layout/messages.php')
?>
  