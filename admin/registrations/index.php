<?php
include ('../../app/config.php');
include ('../../admin/layout/part_1.php');

?>

<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h1>Inscripciones: <?=$currentYear?></h1>
            </div>
            <br>
            <div class="row">
            <div class="col-md-3 col-sm-6 col-12" bis_skin_checked="1">
            <div class="info-box" bis_skin_checked="1">
              <span class="info-box-icon bg-primary"><i class="bi bi-person-video"></i></span>
              <div class="info-box-content" bis_skin_checked="1">
                <span class="info-box-text">Inscripciones</span>
                <a href="create.php" class="btn btn-primary btn-sm">Nuevo Estudiante</a>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          </div>
        </div>
    </div>
</div>


<?php
include ('../../admin/layout/part_2.php');
include ('../../layout/messages.php')
?>
