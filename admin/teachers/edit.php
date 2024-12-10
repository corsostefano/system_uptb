<?php
$id_user = $_GET['id'];

include ('../../app/config.php');
include ('../../admin/layout/part_1.php');
include ('../../app/controllers/teachers/data_teachers.php');
include ('../../app/controllers/roles/list_of_roles.php');
?>

<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h1>Modificar Usuario: <?=$first_name .' '. $last_name;?></h1>
            </div>
            <br>
            <div class="row">
                <br>
                <div class="col-md-12">
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title">Rellene el formulario</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?=APP_URL;?>/app/controllers/teachers/update.php" method="post" enctype="multipart/form-data" id="user-form">
                                
                                <div class="row mb-3">
                                        <!-- Columna de la imagen de perfil actual -->
                                        <div class="col-md-6 text-center">
                                            <label>Foto de perfil actual:</label>
                                            <div class="mb-3">
                                                <img src="<?= APP_URL . $profile_picture; ?>" 
                                                    class="img-fluid rounded" 
                                                    alt="User Image" 
                                                    style="max-width: 120px;">
                                            </div>
                                        </div>

                                        <!-- Columna para cambiar la foto de perfil -->
                                        <div class="col-md-6 d-flex flex-column align-items-center justify-content-center">
                                            <label for="profile_picture">Cambiar foto de perfil (opcional):</label>
                                            <input type="file" class="form-control" name="profile_picture" id="profile_picture" accept="image/*">
                                        </div>
                                </div>

                                
                                <h4 class="mb-3 text-center">Información Personal</h4>
                                <div class="row mb-3">
                                   
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="id_user" value="<?=$id_user;?>" hidden>
                                            <label for="first_name">Nombre (s)</label>
                                            <input type="text" class="form-control" name="first_name" value="<?=$first_name?>" placeholder="Introduce tu nombre (s)" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="last_name">Apellido (s)</label>
                                            <input type="text" class="form-control" name="last_name" value="<?=$last_name?>" placeholder="Introduce tu apellido (s)" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="birth_date">Fecha de nacimiento</label>
                                            <input type="date" class="form-control" name="birth_date" id="birth_date" value="<?=$birth_date?>" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" name="email" placeholder="Introduce tu correo electrónico" required value="<?=$email?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="identification_type">Tipo de identificación</label>
                                            <select name="identification_type" id="identification_type" class="form-control" required>
                                                <option value="V" <?php echo ($identification_type == 'V') ? 'selected' : ''; ?>>V - Venezolano</option>
                                                <option value="E" <?php echo ($identification_type == 'E') ? 'selected' : ''; ?>>E - Extranjero</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="cedula">Cédula</label>
                                            <input type="text" class="form-control" id="cedula" name="cedula" placeholder="Introduce tu cédula" required minlength="7" maxlength="10" value="<?=$cedula?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                  
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="marital_status">Estado Civil</label>
                                            <select name="marital_status" id="marital_status" class="form-control" required>
                                                <option value="Soltero" <?php echo ($marital_status == 'Soltero') ? 'selected' : '';?>>Soltero</option>
                                                <option value="Casado" <?php echo ($marital_status == 'Casado') ? 'selected' : '';?>>Casado</option>
                                                <option value="Divorciado" <?php echo ($marital_status == 'Divorciado') ? 'selected' : '';?>>Divorciado</option>
                                                <option value="Viudo" <?php echo ($marital_status == 'Viudo') ? 'selected' : '';?>>Viudo</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="identification_type">Sexo</label>
                                            <select name="sex" id="identification_type" class="form-control" required>
                                                <option value="">Seleccione un sexo</option>
                                                <option value="M" <?php echo ($sex == 'M') ? 'selected' : ''; ?>>Masculino</option>
                                                <option value="F" <?php echo ($sex == 'F') ? 'selected' : ''; ?>>Femenino</option>
                                                <option value="O" <?php echo ($sex == 'O') ? 'selected' : ''; ?>>Otros</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="phone">Teléfono</label>
                                            <input type="tel" class="form-control" name="phone" id="phone" placeholder="Introduce tu número de teléfono" value="<?=$phone?>"  required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="mobile">Celular</label>
                                            <input type="tel" class="form-control" name="mobile" id="mobile" placeholder="Introduce tu número de celular" value="<?=$mobile?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="emergency_contact">Contacto de emergencia</label>
                                            <input type="tel" class="form-control" name="emergency_contact" id="emergency_contact" placeholder="Introduce tu número de emergencia" value="<?=$emergency_contact?>" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <h4 class="mb-3 text-center">Información Académica y Laboral</h4>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                    <div class="form-group">
                                            <label for="rol_id">Nombre del rol</label>
                                            <div class="form-inline">
                                                <select name="rol_id" id="rol_id" class="form-control" onchange="updateCategory()">
                                                    <?php foreach ($roles as $role): ?>
                                                        <?php if ($role['name_rol'] == 'DOCENTE'): // Mostrar solo "docente" ?>
                                                            <option value="<?=$role['id_rol'];?>" 
                                                                    data-category="<?=$role['category'];?>" 
                                                                    <?= ($name_rol == $role['name_rol']) ? 'selected="selected"' : ''; ?>>
                                                                <?=$role['name_rol'];?>
                                                            </option>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </select>
                                                <input type="hidden" name="rol_category" id="rol_category" value="<?= isset($role['category']) ? $role['category'] : ''; ?>">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="profession">Profesión u Oficio</label>
                                            <select name="profession" id="profession" class="form-control" required>
                                                <option value="">Seleccione su profesión u oficio</option>
                                                <option value="Administrador" <?php echo ($profession == 'Administrador') ? 'selected' : ''; ?>>Administrador</option>
                                                <option value="Abogado" <?php echo ($profession == 'Abogado') ? 'selected' : ''; ?>>Abogado</option>
                                                <option value="Albañil" <?php echo ($profession == 'Albañil') ? 'selected' : ''; ?>>Albañil</option>
                                                <option value="Arquitecto" <?php echo ($profession == 'Arquitecto') ? 'selected' : ''; ?>>Arquitecto</option>
                                                <option value="Carpintero" <?php echo ($profession == 'Carpintero') ? 'selected' : ''; ?>>Carpintero</option>
                                                <option value="Chef" <?php echo ($profession == 'Chef') ? 'selected' : ''; ?>>Chef</option>
                                                <option value="Contador" <?php echo ($profession == 'Contador') ? 'selected' : ''; ?>>Contador</option>
                                                <option value="Docente" <?php echo ($profession == 'Docente') ? 'selected' : ''; ?>>Docente</option>
                                                <option value="Electricista" <?php echo ($profession == 'Electricista') ? 'selected' : ''; ?>>Electricista</option>
                                                <option value="Enfermero" <?php echo ($profession == 'Enfermero') ? 'selected' : ''; ?>>Enfermero</option>
                                                <option value="Estudiante" <?php echo ($profession == 'Estudiante') ? 'selected' : ''; ?>>Estudiante</option>
                                                <option value="Ingeniero" <?php echo ($profession == 'Ingeniero') ? 'selected' : ''; ?>>Ingeniero</option>
                                                <option value="Médico" <?php echo ($profession == 'Médico') ? 'selected' : ''; ?>>Médico</option>
                                                <option value="Mecánico" <?php echo ($profession == 'Mecánico') ? 'selected' : ''; ?>>Mecánico</option>
                                                <option value="Plomero" <?php echo ($profession == 'Plomero') ? 'selected' : ''; ?>>Plomero</option>
                                                <option value="Policía" <?php echo ($profession == 'Policía') ? 'selected' : ''; ?>>Policía</option>
                                                <option value="Psicólogo" <?php echo ($profession == 'Psicólogo') ? 'selected' : ''; ?>>Psicólogo</option>
                                                <option value="Secretario" <?php echo ($profession == 'Secretario') ? 'selected' : ''; ?>>Secretario</option>
                                                <option value="Soldador" <?php echo ($profession == 'Soldador') ? 'selected' : ''; ?>>Soldador</option>
                                                <option value="Tecnólogo" <?php echo ($profession == 'Tecnólogo') ? 'selected' : ''; ?>>Tecnólogo</option>
                                                <option value="Vendedor" <?php echo ($profession == 'Vendedor') ? 'selected' : ''; ?>>Vendedor</option>
                                                <option value="Otros" <?php echo ($profession == 'Otros') ? 'selected' : ''; ?>>Otros</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="education">Estudios</label>
                                            <select class="form-control" name="education" id="education" required>
                                                <option value="">Seleccione su nivel de estudios</option>
                                                <option value="Primaria" <?php echo ($education == 'Primaria') ? 'selected' : ''; ?>>Primaria</option>
                                                <option value="Bachiller" <?php echo ($education == 'Bachiller') ? 'selected' : ''; ?>>Bachiller</option>
                                                <option value="Técnico" <?php echo ($education == 'Técnico') ? 'selected' : ''; ?>>Técnico</option>
                                                <option value="Universitario" <?php echo ($education == 'Universitario') ? 'selected' : ''; ?>>Universitario</option>
                                                <option value="Postgrado" <?php echo ($education == 'Postgrado') ? 'selected' : ''; ?>>Postgrado</option>
                                                <option value="Doctorado" <?php echo ($education == 'Doctorado') ? 'selected' : ''; ?>>Doctorado</option>
                                                <option value="Otros" <?php echo ($education == 'Otros') ? 'selected' : ''; ?>>Otros</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="university_campus">Sede Universitaria</label>
                                            <select name="university_campus" id="university_campus" class="form-control" required>
                                                <option value="">Seleccione una sede</option>
                                                <option value="Barinas" <?php echo ($university_campus == 'Barinas') ? 'selected' : ''; ?>>Barinas</option>
                                                <option value="Barinitas" <?php echo ($university_campus == 'Barinitas') ? 'selected' : ''; ?>>Barinitas</option>
                                                <option value="Pedraza" <?php echo ($university_campus == 'Pedraza') ? 'selected' : ''; ?>>Pedraza</option>
                                                <option value="Socopó" <?php echo ($university_campus == 'Socopó') ? 'selected' : ''; ?>>Socopó</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="specialty">Especialidad</label>
                                            <input type="text" class="form-control" name="specialty" placeholder="Ingresa la especialidad" value="<?=$specialty?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label  for="seniority">Antigüedad (en años):</label>
                                            <input type="number" class="form-control" id="seniority" name="seniority" min="0" max="50" value="<?=$seniority?>" placeholder="Años de antigüedad">
                                        </div>
                                    </div>
                                </div>
                                <h4 class="mb-3 text-center">Ubicación</h4>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="address_user">Dirección</label>
                                            <input type="text" class="form-control" name="address_user"  value="<?=$address_user;?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="state_of_residence">Estado de Residencia</label>
                                            <select name="state_of_residence" id="state_of_residence" class="form-control" required onchange="updateMunicipios()">
                                                <option value="">Seleccione su estado de residencia</option>
                                                <option value="Amazonas" <?= ($state_of_residence == "Amazonas") ? 'selected' : ''; ?>>Amazonas</option>
                                                <option value="Anzoátegui" <?= ($state_of_residence == "Anzoátegui") ? 'selected' : ''; ?>>Anzoátegui</option>
                                                <option value="Apure" <?= ($state_of_residence == "Apure") ? 'selected' : ''; ?>>Apure</option>
                                                <option value="Aragua" <?= ($state_of_residence == "Aragua") ? 'selected' : ''; ?>>Aragua</option>
                                                <option value="Barinas" <?= ($state_of_residence == "Barinas") ? 'selected' : ''; ?>>Barinas</option>
                                                <option value="Bolívar" <?= ($state_of_residence == "Bolívar") ? 'selected' : ''; ?>>Bolívar</option>
                                                <option value="Carabobo" <?= ($state_of_residence == "Carabobo") ? 'selected' : ''; ?>>Carabobo</option>
                                                <option value="Cojedes" <?= ($state_of_residence == "Cojedes") ? 'selected' : ''; ?>>Cojedes</option>
                                                <option value="Delta Amacuro" <?= ($state_of_residence == "Delta Amacuro") ? 'selected' : ''; ?>>Delta Amacuro</option>
                                                <option value="Distrito Capital" <?= ($state_of_residence == "Distrito Capital") ? 'selected' : ''; ?>>Distrito Capital</option>
                                                <option value="Falcón" <?= ($state_of_residence == "Falcón") ? 'selected' : ''; ?>>Falcón</option>
                                                <option value="Guárico" <?= ($state_of_residence == "Guárico") ? 'selected' : ''; ?>>Guárico</option>
                                                <option value="Lara" <?= ($state_of_residence == "Lara") ? 'selected' : ''; ?>>Lara</option>
                                                <option value="Mérida" <?= ($state_of_residence == "Mérida") ? 'selected' : ''; ?>>Mérida</option>
                                                <option value="Miranda" <?= ($state_of_residence == "Miranda") ? 'selected' : ''; ?>>Miranda</option>
                                                <option value="Monagas" <?= ($state_of_residence == "Monagas") ? 'selected' : ''; ?>>Monagas</option>
                                                <option value="Nueva Esparta" <?= ($state_of_residence == "Nueva Esparta") ? 'selected' : ''; ?>>Nueva Esparta</option>
                                                <option value="Portuguesa" <?= ($state_of_residence == "Portuguesa") ? 'selected' : ''; ?>>Portuguesa</option>
                                                <option value="Sucre" <?= ($state_of_residence == "Sucre") ? 'selected' : ''; ?>>Sucre</option>
                                                <option value="Táchira" <?= ($state_of_residence == "Táchira") ? 'selected' : ''; ?>>Táchira</option>
                                                <option value="Trujillo" <?= ($state_of_residence == "Trujillo") ? 'selected' : ''; ?>>Trujillo</option>
                                                <option value="Vargas" <?= ($state_of_residence == "Vargas") ? 'selected' : ''; ?>>Vargas</option>
                                                <option value="Yaracuy" <?= ($state_of_residence == "Yaracuy") ? 'selected' : ''; ?>>Yaracuy</option>
                                                <option value="Zulia" <?= ($state_of_residence == "Zulia") ? 'selected' : ''; ?>>Zulia</option>
                                                <option value="Dependencias Federales" <?= ($state_of_residence == "Dependencias Federales") ? 'selected' : ''; ?>>Dependencias Federales</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="municipality">Municipio</label>
                                        <select name="municipality" id="municipality" class="form-control"  required>
                                            <option value="">Seleccione su municipio</option>
                                            <!-- Opciones de municipios se llenarán dinámicamente -->
                                        </select>
                                    </div>
                                </div>
                                </div>
                                </div>
                                <div class="row row mb-3 text-center">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success">Actualizar</button>
                                            <a href="<?=APP_URL;?>/admin/teachers" class="btn btn-secondary">Cancelar</a>
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

<script src="../../public/js/edit_user.js"></script>


<?php
include ('../../admin/layout/part_2.php');
include ('../../layout/messages.php')
?>
  