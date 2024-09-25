<?php
include ('../../app/config.php');
include ('../../admin/layout/part_1.php');

?>

<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h1>Creación de un nuevo rol</h1>
            </div>
            <br>
            <div class="row">
                <br>
                <div class="col-md-6">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Rellene el formulario</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?=APP_URL;?>app/controllers/roles/create.php" method="post" >
                                <div class="row">
                                    <div class="col-md-12">
                                      <div class="form-group">
                                          <label for="">Nombre del rol</label>
                                          <input type="text"  id="name_rol" name="name_rol" class="form-control" required >
                                      </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <button type="submit" class="btn btn-primary" >Registrar</button>
                                        <a href="<?=APP_URL;?>admin/roles" class="btn btn-secondary" >Cancelar</a>
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


<?php
include ('../../admin/layout/part_2.php');
include ('../../layout/messages.php')
?>
  