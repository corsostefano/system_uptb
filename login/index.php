<?php
include('../app/config.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="<?php echo APP_URL;?>/public/images/upt_logo.png" />
  <title><?php echo APP_NAME;?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo APP_URL;?>/public/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo APP_URL;?>/public/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo APP_URL;?>/public/dist/css/adminlte.min.css">
  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="../public/css/style_login.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="text-center">
    <img src="<?php echo APP_URL;?>/public/images/upt_logo.png" alt="" width="150px" class="rounded mb-3">
  </div>
  <div class="login-logo">
    <h3><?php echo APP_NAME;?></h3>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Inicio de sesión</p>
      <hr>
      <form action="controller_login.php" method="post">
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="user_password" class="form-control" placeholder="Contraseña" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <button class="btn btn-primary btn-block" type="submit">Ingresar</button>
        </div>
        <div class="text-center">
          <a href="forgot_password.php" class="btn btn-link">¿Olvidaste tu contraseña?</a>
        </div>
      </form>
      <?php
        session_start();
        if(isset($_SESSION['message'])){
          $message = $_SESSION['message'];
          $icon = $_SESSION['icon'];
      ?>
        <script>
          Swal.fire({
            position: "center",
            icon: '<?=$icon?>',
            title: '<?=$message?>',
            showConfirmButton: false,
            timer: 5000
          });
        </script>
      <?php
          session_destroy();
        }
      ?>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?php echo APP_URL;?>/public/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo APP_URL;?>/public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo APP_URL;?>/public/dist/js/adminlte.min.js"></script>
</body>
</html>
