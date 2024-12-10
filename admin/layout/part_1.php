<?php 
session_start();

if (isset($_SESSION['session_email'])) {
    $email_session = $_SESSION['session_email'];

    // Mejor usar parámetros vinculados para evitar inyección SQL
    $query_session = $pdo->prepare("SELECT * 
                                    FROM users as usu
                                    INNER JOIN roles as rol ON rol.id_rol = usu.rol_id  
                                    WHERE usu.email = :email_session AND usu.user_state = 1");

    // Bind the parameter to the query
    $query_session->bindParam(':email_session', $email_session, PDO::PARAM_STR);

    // Ejecutamos la consulta
    $query_session->execute();

    // Usamos fetch para obtener solo un resultado (un único usuario)
    $data_session_user = $query_session->fetch(PDO::FETCH_ASSOC);

    if ($data_session_user) {
        // Asignamos los valores de la sesión
        $name_session_user = $data_session_user['first_name'] . ' ' . $data_session_user['last_name'];
        $id_rol_session_user = $data_session_user['id_rol'];
        $profile_picture = $data_session_user['profile_picture'];
        $role_name = $data_session_user['name_rol']; // Nombre del rol
        $role_category_session = $data_session_user['category']; // Nombre del rol
        $cedula_session_user = $data_session_user['cedula'];
        $identification_type_session_user = $data_session_user['identification_type'];
        $email_session_user = $data_session_user['email'];
        $id_user_session_user = $data_session_user['id_user'];

        if($role_name == 'ESTUDIANTE'){
          //header('Location: ' . APP_URL . "/login");
        }
      
        $url = $_SERVER["PHP_SELF"];
  
        $rest = substr($url, 12); // Ajusta según el formato esperado en tu sistema

        // Consulta para obtener los permisos del rol activo
        $sql_roles_permissions = "
            SELECT per.url 
            FROM roles_permissions AS rolper
            INNER JOIN permissions AS per ON per.id_permission = rolper.permission_id
            WHERE rolper.roles_permissions_state = 1
              AND per.permission_state = 1
              AND rolper.rol_id = :rol_id";
              
        $query_roles_permissions = $pdo->prepare($sql_roles_permissions);
        $query_roles_permissions->bindParam(':rol_id', $id_rol_session_user, PDO::PARAM_INT);
        $query_roles_permissions->execute();

        $permissions = $query_roles_permissions->fetchAll(PDO::FETCH_COLUMN); // Obtén solo las URLs permitidas

        // Verifica si la URL actual está en los permisos asignados
        if (in_array($rest, $permissions)) {
            //echo "Permiso autorizado";
        } else {
          header('Location: ' . APP_URL . "/admin/unauthorized_access.php");
        }
        
    } else {
        // Redirige si no se encuentra el usuario
        header('Location: ' . APP_URL . "/login");
        exit();
    }
} else {
    header('Location: ' . APP_URL . "/login");
    exit(); 
}

// Obtener la URL completa
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
$host = $_SERVER['HTTP_HOST'];
$request_uri = $_SERVER['REQUEST_URI'];
$current_url = $protocol . $host . $request_uri;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?= APP_URL;?>/public/images/upt_logo.png" type="image/x-icon" />
    <title><?= APP_NAME;?></title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= APP_URL;?>/public/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= APP_URL; ?>/public/dist/css/adminlte.min.css">
    <!--Datatables-->
     <!-- DataTables -->
    <link rel="stylesheet" href="<?= APP_URL;?>/public/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= APP_URL;?>/public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= APP_URL;?>/public/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!--Dropzonejs-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css">
     <!--Chart JS-->
     <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!--CSS-->
    <link rel="stylesheet" href="<?= APP_URL;?>/public/css/style.css"  > 
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?= APP_URL;?>/admin" class="nav-link"><?= APP_NAME;?></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-image: linear-gradient(60deg, #29323c 0%, #485563 100%);" >
    <a href="<?= APP_URL;?>/admin" class="brand-link">
      <img src="<?= APP_URL;?>/public/images/upt_logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Control de Estudios</span>
    </a>

    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex flex-column align-items-center ">
          <?php if (!empty($profile_picture)) :?>
            <img src="<?= APP_URL . $profile_picture; ?>" class="img-fluid mx-auto rounded" alt="User Image" style="width: 100px;">
          <?php else : ?>
            <i class="bi bi-person bg-white" style="font-size: 100px;"></i>
          <?php endif;?>
      </div>
      <div class="info mt-2">
          <a href="#" class="d-flex flex-column align-items-center justify-content-center">
              <?= $name_session_user; ?>
              <span class="text-muted"><?= $role_name; ?></span> <!-- Mostrar el rol aquí -->
          </a>
      </div>
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <?php 
          if (($role_category_session== "admin") && (($role_name == "ADMINISTRADOR") || ($role_name == "DIRECTOR ACADÉMICO") || ($role_name == "DIRECTOR ADMINISTRATIVO") ) ) {
            
            ?>
               <li class="nav-item ">
            <a href="#" class="nav-link <?=(
                ($current_url === APP_URL . '/admin/settings/') ||  
                ($current_url === APP_URL . '/admin/settings/institution/') ||
                ($current_url === APP_URL . '/admin/settings/institution/create.php') ||
                ($current_url === APP_URL . '/admin/settings/management/') ||
                ($current_url === APP_URL . '/admin/settings/management/create.php')
              ) ? 'active' : '' ?>">
              <i class="nav-icon fas"><i class="bi bi-sliders"></i></i></i></i>
              <p>
                Configuraciones
              </p>
              <i class=" right fas fa-angle-left"></i>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= APP_URL;?>/admin/settings" class="nav-link <?= ($current_url === APP_URL . '/admin/settings/') ? 'active' : '' ?>">
                  <?= ($current_url === APP_URL . '/admin/settings/') ? '<i class="bi bi-check-circle-fill"></i>' : '<i class="bi bi-circle"></i>' ?>
                  <p> Configurar</p>
                </a>
              </li>
            </ul>
          </li>
            <?php
          }
        ?>
          <?php 
          if (($role_category_session== "admin") && (($role_name == "ADMINISTRADOR") || ($role_name == "DIRECTOR ACADÉMICO") ) ) {
            
            ?>
             <!--Academic Programs-->
          <li class="nav-item">
            <a href="#" class="nav-link <?= (
              ($current_url === APP_URL . '/admin/academic_programs/') || 
              ($current_url === APP_URL . '/admin/academic_programs/create.php') 
              ) ? 'active' : '' ?>">
              <i class="nav-icon fas"><i class="bi bi-book-half"></i></i></i></i></i>
              <p>
                PNF
              </p>
              <i class=" right fas fa-angle-left"></i>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= APP_URL;?>/admin/academic_programs" class="nav-link <?= ($current_url === APP_URL . '/admin/academic_programs/') ? 'active' : '' ?>">
                  <?= ($current_url === APP_URL . '/admin/academic_programs/') ? '<i class="bi bi-check-circle-fill"></i>' : '<i class="bi bi-circle"></i>' ?>
                  <p>PNF</p>
                </a>
              </li>
            </ul>
          </li>

           <!--Años Universitarios-->
           <li class="nav-item">
            <a href="#" class="nav-link <?= (
              ($current_url === APP_URL . '/admin/years_levels/') || 
              ($current_url === APP_URL . '/admin/years_levels/create.php')
              ) ? 'active' : '' ?> ">
              <i class="nav-icon fas"><i class="bi bi-ladder"></i></i>
              <p>
                Años o Niveles
              </p>
              <i class=" right fas fa-angle-left"></i>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= APP_URL;?>/admin/years_levels" class="nav-link <?= ($current_url === APP_URL . '/admin/years_levels/') ? 'active' : '' ?>">
                  <?= ($current_url === APP_URL . '/admin/years_levels/') ? '<i class="bi bi-check-circle-fill"></i>' : '<i class="bi bi-circle"></i>' ?>
                  <p>Años o Niveles</p>
                </a>
              </li>
            </ul>
          </li>
         
            <!--Materias-->
            <li class="nav-item">
            <a href="#" class="nav-link <?= (
              ($current_url === APP_URL . '/admin/courses/') || 
              ($current_url === APP_URL . '/admin/courses/create.php') || 
              ($current_url === APP_URL . '/admin/courses/list_associate.php') ||
              ($current_url === APP_URL . '/admin/courses/create_association.php')
              ) ? 'active' : '' ?> ">
              <i class="nav-icon fas"><i class="bi bi-journal-text"></i></i></i></i></i></i>
              <p>
                Materias
              </p>
              <i class=" right fas fa-angle-left"></i>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= APP_URL;?>/admin/courses" class="nav-link <?= ($current_url === APP_URL . '/admin/courses/') ? 'active' : '' ?>">
                  <?= ($current_url === APP_URL . '/admin/courses/') ? '<i class="bi bi-check-circle-fill"></i>' : '<i class="bi bi-circle"></i>' ?>
                  <p>Materias</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= APP_URL;?>/admin/courses/list_associate.php" class="nav-link <?= ($current_url === APP_URL . '/admin/courses/list_associate.php') ? 'active' : '' ?>">
                  <?= ($current_url === APP_URL . '/admin/courses/list_associate.php') ? '<i class="bi bi-check-circle-fill"></i>' : '<i class="bi bi-circle"></i>' ?>
                  <p>Asociación de materias</p>
                </a>
              </li>
            </ul>
          </li>
            <?php
          }
        ?>

        <?php 
          if (($role_category_session== "admin") && ($role_name == "ADMINISTRADOR")  ) {
            
            ?>
               <!--Roles-->
           <li class="nav-item">
            <a href="#" class="nav-link <?= (
              ($current_url === APP_URL . '/admin/roles/') || 
              ($current_url === APP_URL . '/admin/roles/create.php') || 
              ($current_url === APP_URL . '/admin/roles/permissions.php') ||
              ($current_url === APP_URL . '/admin/roles/create_permissions.php')
              ) ? 'active' : '' ?>">
              <i class="nav-icon fas"><i class="bi bi-bookmarks-fill"></i></i></i>
              <p>
                Roles
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= APP_URL; ?>/admin/roles" class="nav-link <?= ($current_url === APP_URL . '/admin/roles/') ? 'active' : '' ?>">
                  <?= ($current_url === APP_URL . '/admin/roles/') ? '<i class="bi bi-check-circle-fill"></i>' : '<i class="bi bi-circle"></i>' ?>
                  <p>Listado de roles</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= APP_URL; ?>/admin/roles/permissions.php" class="nav-link <?= ($current_url === APP_URL . '/admin/roles/permissions.php') ? 'active' : '' ?>">
                  <?= ($current_url === APP_URL . '/admin/roles/permissions.php') ? '<i class="bi bi-check-circle-fill"></i>' : '<i class="bi bi-circle"></i>' ?>
                  <p>Permisos</p>
                </a>
              </li>
            </ul>
          </li>

           <!--Users-->
           <li class="nav-item">
            <a href="#" class="nav-link <?= (
              ($current_url === APP_URL . '/admin/users/') || 
              ($current_url === APP_URL . '/admin/users/create.php')
              ) ? 'active' : '' ?> ">
              <i class="nav-icon fas"><i class="bi bi-people-fill"></i></i></i>
              <p>
                Usuarios
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= APP_URL; ?>/admin/users" class="nav-link <?= ($current_url === APP_URL . '/admin/users/') ? 'active' : '' ?>">
                  <?= ($current_url === APP_URL . '/admin/users/') ? '<i class="bi bi-check-circle-fill"></i>' : '<i class="bi bi-circle"></i>' ?>
                  <p>Listado de usuarios</p>
                </a>
              </li>
            </ul>
          </li>
            <?php
          }
        ?>

        <?php 
          if (($role_category_session== "admin") && (($role_name == "ADMINISTRADOR") || ($role_name == "DIRECTOR ACADÉMICO") || ($role_name == "DIRECTOR ADMINISTRATIVO") || ($role_name == "SECRETARIA") ) ) {
            
            ?>
           
           <!--Administrative-->
           <li class="nav-item">
            <a href="#" class="nav-link <?= (
              ($current_url === APP_URL . '/admin/administrative/') || 
              ($current_url === APP_URL . '/admin/administrative/create.php')
              ) ? 'active' : '' ?> ">
              <i class="nav-icon fas"><i class="bi bi-person-lines-fill"></i></i>
              <p>
                Administrativos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= APP_URL; ?>/admin/administrative" class="nav-link <?= ($current_url === APP_URL . '/admin/administrative/') ? 'active' : '' ?>">
                  <?= ($current_url === APP_URL . '/admin/administrative/') ? '<i class="bi bi-check-circle-fill"></i>' : '<i class="bi bi-circle"></i>' ?>
                  <p>Personal Administrativo</p>
                </a>
              </li>
            </ul>
          </li>
            <?php
          }
        ?>

        <?php 
          if (($role_category_session== "admin") && (($role_name == "ADMINISTRADOR") || ($role_name == "DIRECTOR ACADÉMICO") || ($role_name == "SECRETARIA") ) ) {
            
            ?>
           
            <!--Teachers-->
          <li class="nav-item">
            <a href="#" class="nav-link <?= (
              ($current_url === APP_URL . '/admin/teachers/') || 
              ($current_url === APP_URL . '/admin/teachers/create.php') ||
              ($current_url === APP_URL . '/admin/teachers/assignment.php')
              )  ? 'active' : '' ?> ">
              <i class="nav-icon fas"><i class="bi bi-person-video3"></i></i>
              <p>
                Docentes
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= APP_URL; ?>/admin/teachers" class="nav-link <?= ($current_url === APP_URL . '/admin/teachers/') ? 'active' : '' ?>">
                  <?= ($current_url === APP_URL . '/admin/teachers/') ? '<i class="bi bi-check-circle-fill"></i>' : '<i class="bi bi-circle"></i>' ?>
                  <p>Personal Docente</p>
                </a>
              </li>  <li class="nav-item">
                <a href="<?= APP_URL; ?>/admin/teachers/assignment.php" class="nav-link <?= ($current_url === APP_URL . '/admin/teachers/assignment.php') ? 'active' : '' ?>">
                  <?= ($current_url === APP_URL . '/admin/teachers/assignment.php') ? '<i class="bi bi-check-circle-fill"></i>' : '<i class="bi bi-circle"></i>' ?>
                  <p>Asignaciones</p>
                </a>
              </li>
            </ul>
          </li>

           <!--Students-->
           <li class="nav-item">
            <a href="#" class="nav-link <?= (
              ($current_url === APP_URL . '/admin/registrations/') || 
              ($current_url === APP_URL . '/admin/registrations/create.php') || 
              ($current_url === APP_URL . '/admin/students/')
              )  ? 'active' : '' ?> ">
              <i class="nav-icon fas"><i class="bi bi-person-video"></i></i></i>
              <p>
                Estudiantes
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= APP_URL; ?>/admin/registrations" class="nav-link <?= ($current_url === APP_URL . '/admin/registrations/') ? 'active' : '' ?>">
                  <?= ($current_url === APP_URL . '/admin/registrations/') ? '<i class="bi bi-check-circle-fill"></i>' : '<i class="bi bi-circle"></i>' ?>
                  <p>Inscripciones</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= APP_URL; ?>/admin/students" class="nav-link <?= ($current_url === APP_URL . '/admin/students/') ? 'active' : '' ?>">
                  <?= ($current_url === APP_URL . '/admin/students/') ? '<i class="bi bi-check-circle-fill"></i>' : '<i class="bi bi-circle"></i>' ?>
                  <p>Estudiantes</p>
                </a>
              </li>
            </ul>
          </li>
            <?php
          }
        ?>

        <?php 
          if ((($role_category_session== "teacher") || ($role_category_session== "admin" )) && (($role_name == "DOCENTE") || ($role_name == "ADMINISTRADOR")) ) {
            
            ?>
           
            <!-Materias Asignadas-->
            <li class="nav-item">
            <a href="#" class="nav-link <?= ($current_url === APP_URL . '/admin/teachers/teacher_assignments.php') ? 'active' : '' ?> ">
              <i class="nav-icon fas"><i class="bi bi-clipboard-check"></i></i>
              <p>
                Materias Asignadas
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= APP_URL; ?>/admin/teachers/teacher_assignments.php" class="nav-link <?= ($current_url === APP_URL . '/admin/teachers/teacher_assignments.php') ? 'active' : '' ?>">
                  <?= ($current_url === APP_URL . '/admin/teachers/teacher_assignments.php') ? '<i class="bi bi-check-circle-fill"></i>' : '<i class="bi bi-circle"></i>' ?>
                  <p>Listado de Materias</p>
                </a>
            </ul>
          </li>

            <!--Historial Académico-->
            <li class="nav-item">
            <a href="#" class="nav-link <?= ($current_url === APP_URL . '/admin/academic_history/') ? 'active' : '' ?> ">
              <i class="nav-icon fas"><i class="bi bi-clipboard-check"></i></i>
              <p>
                Historial Académico
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= APP_URL; ?>/admin/academic_history" class="nav-link <?= ($current_url === APP_URL . '/admin/academic_history/') ? 'active' : '' ?>">
                  <?= ($current_url === APP_URL . '/admin/academic_history/') ? '<i class="bi bi-check-circle-fill"></i>' : '<i class="bi bi-circle"></i>' ?>
                  <p>Generar Reporte</p>
                </a>
            </ul>
          </li>

            <!--calificaciones-->
            <li class="nav-item">
            <a href="#" class="nav-link <?= ($current_url === APP_URL . '/admin/grades/') || ($current_url === APP_URL . '/admin/grades/')  ? 'active' : '' ?> ">
              <i class="nav-icon fas"><i class="bi bi-check2-square"></i></i></i>
              <p>
                Calificaciones
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= APP_URL; ?>/admin/grades" class="nav-link <?= ($current_url === APP_URL . '/admin/grades/') ? 'active' : '' ?>">
                  <?= ($current_url === APP_URL . '/admin/grades/') ? '<i class="bi bi-check-circle-fill"></i>' : '<i class="bi bi-circle"></i>' ?>
                  <p>Calificaciones</p>
                </a>
            </ul>
          </li>

            <?php
          }
        ?>
          <li class="nav-item" >
            <a href="<?= APP_URL ?>/login/logout.php" class="nav-link" style="background-color: #dd3e6d">
              <i class="nav-icon fas"><i class="bi bi-door-open-fill"></i></i>
              <p>
                Cerrar sesión
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
