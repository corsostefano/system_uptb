<?php
include ('../../app/config.php');
include ('../../admin/layout/part_1.php');

?>

<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h1>Configuraciones del Sistema</h1>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4 col-sm-6 col-12">
                    <div class="info-box" bis_skin_checked="1">
                        <span class="info-box-icon bg-primary"><i class="bi bi-building"></i></span>

                        <div class="info-box-content" bis_skin_checked="1">
                            <span class="info-box-text"><b>Datos de la Institución</b></span>
                            <a href="<?=APP_URL;?>/admin/settings/institution" class="btn btn-primary btn-sm" >Configuración</a>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                   
                </div>
                <div class="col-md-4 col-sm-6 col-12">
                    <div class="info-box" bis_skin_checked="1">
                        <span class="info-box-icon bg-info"><i class="bi bi-clipboard2-check"></i></span>

                        <div class="info-box-content" bis_skin_checked="1">
                            <span class="info-box-text"><b>Gestión Universitaria</b></span>
                            <a href="<?=APP_URL;?>/admin/settings/management" class="btn btn-info btn-sm" >Configuración</a>
                        </div>
                        <!-- /.info-box-content -->
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
