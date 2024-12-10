<?php
include('../app/config.php');
include('../layout/messages.php')
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="<?php echo APP_URL;?>/public/images/upt_logo.png" />
  <link rel="stylesheet" href="../public/css/style_login.css">
  <title><?php echo APP_NAME;?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo APP_URL;?>/public/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo APP_URL;?>/public/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo APP_URL;?>/public/dist/css/adminlte.min.css">
  <!--Sweetalert2-->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <center>
            <img src="<?php echo APP_URL;?>/public/images/upt_logo.png" alt="" width="150px" class="rounded">
        </center>
        <br>
        <div class="login-logo">
            <h3><b>Recuperar Contraseña</b></h3>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Ingrese su correo electrónico para recibir un enlace de recuperación.</p>
                <form action="process_forgot_password.php" method="post">
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Correo Electrónico" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <button class="btn mb-3 btn-primary btn-block" type="submit">Enviar enlace de recuperación</button>
                        <a href="<?=APP_URL;?>/login" class="btn btn-secondary btn-block">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- jQuery -->
    <script src="<?php echo APP_URL;?>/public/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo APP_URL;?>/public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo APP_URL;?>/public/dist/js/adminlte.min.js"></script>
</body>
</html>
