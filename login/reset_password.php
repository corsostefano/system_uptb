<?php include('../app/config.php'); ?>

<!DOCTYPE html>
<html lang="en">
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
    <!--Sweetalert2-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../public/css/style_login.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <center>
        <img src="<?php echo APP_URL;?>/public/images/upt_logo.png" alt="" width="150px" class="rounded">
    </center>
    <br>
    <div class="login-logo">
        <h3><b>Restablecer Contraseña</b></h3>
    </div>
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Ingrese su nueva contraseña.</p>
            <form id="resetPasswordForm" action="process_reset_password.php" method="post">
                <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token']); ?>">
                <div class="input-group mb-3">
                    <input type="password" name="new_password" id="new_password" class="form-control" placeholder="Nueva Contraseña" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirmar Contraseña" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <button class="btn btn-primary btn-block" type="submit">Restablecer Contraseña</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="../public/js/validate_password.js"></script>
</body>
</html>