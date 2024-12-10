<?php
$id_rol = isset($_GET['id']) ? $_GET['id'] : null;
include ('../../app/config.php');
include ('../../admin/layout/part_1.php');
include ('../../app/controllers/roles/data_rol.php');
include ('../../app/controllers/roles/list_of_permissions.php');
include ('../../app/controllers/roles/list_roles_permissions.php');


?>

<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container-fluid">
            <!-- Título de la sección -->
            <div class="row justify-content-center">
                <h1>Asignación de permisos a rol: <?= $name_rol; ?></h1>
            </div>
            <br>

            <!-- Formulario de asignación de permisos -->
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Rellene el formulario</h3>
                        </div>
                        <div class="card-body">
                            <form>
                                <!-- Campo oculto con el ID del rol -->
                                <input type="hidden" name="rol_id" id="rol_id<?= $id_rol; ?>" value="<?= $id_rol; ?>">

                                <!-- Fila con el nombre del rol y el selector de permisos -->
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Rol: <?= $name_rol; ?></label>
                                    </div>
                                    <div class="col-md-6">
                                        <select name="id_permission" id="select_permission<?= $id_rol; ?>" class="form-control">
                                            <option value="" disabled selected>Seleccione un permiso</option>
                                            <?php foreach ($permissions as $permission): ?>
                                                <option value="<?= $permission['id_permission']; ?>"><?= $permission['name_url']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="button" class="btn btn-primary mb-2" onclick="addPermission(<?= $id_rol; ?>)">Asignar</button>
                                    </div>
                                </div>

                                <!-- Separador -->
                                <hr>

                                <!-- Tabla de permisos asignados -->
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Permiso</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="permissions_table<?= $id_rol; ?>">
                                        <!-- Las filas se agregarán dinámicamente -->
                                    </tbody>
                                </table>
                            </form>

                            <!-- Botones de acción -->
                            <div class="text-center" >
                                <a href="<?=APP_URL;?>/admin/roles" class="btn btn-secondary" >Regresar</a>
                                <button type="button" class="btn btn-success" onclick="submitPermissions(<?= $id_rol; ?>)">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row justify-content-center" >
                <div class="col-md-8" >
                    <div class="card card-outline card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Listado de permisos ya asignados previamente</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">Nro</th>
                                        <th class="text-center">Rol</th>
                                        <th class="text-center">Permiso</th>
                                        <th class="text-center">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                $counter_roles_permissions = 0;

                                // Recorremos los permisos asociados a los roles
                                foreach ($roles_permissions as $role_permission) {
                                    $rol_id = $role_permission['rol_id'];
                                    
                                    // Comparamos el rol actual con el id del rol
                                    if ($id_rol == $rol_id) {
                                        $id_rol_permission = $role_permission['id_rol_permission'];
                                        $name_url = $role_permission['name_url'];
                                        $name_rol = $role_permission['name_rol'];
                                        $counter_roles_permissions++;
                                        ?>
                                        <tr>
                                            <td class="text_center"><?= $counter_roles_permissions; ?></td>
                                            <td><?= htmlspecialchars($name_rol); ?></td>
                                            <td><?= htmlspecialchars($name_url); ?></td>
                                            <td class="text_center">
                                                <div>
                                                    <!-- Formulario para eliminar -->
                                                    <form action="<?= APP_URL; ?>/app/controllers/roles/delete_roles_permissions.php" method="post" class="d-inline" onsubmit="return confirmDeletion(event, this);">
                                                        <input type="hidden" name="id_rol_permission" value="<?= htmlspecialchars($id_rol_permission); ?>">
                                                        <button type="submit" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Borrar">
                                                            <i class="bi bi-trash3"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                    // Mostrar mensaje si no hay permisos registrados
                                    if ($counter_roles_permissions === 0) {
                                        ?>
                                        <tr>
                                            <td colspan="4" class="text_center">No hay permisos registrados para este rol.</td>
                                        </tr>
                                        <?php
                                    }
                                ?>
                                

                                </tbody>

                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    let permissionsData = {};

    function addPermission(roleId) {
        const select = document.getElementById(`select_permission${roleId}`);
        const table = document.getElementById(`permissions_table${roleId}`);
        const selectedValue = select.value;
        const selectedText = select.options[select.selectedIndex].text;

        if (!selectedValue) {
            Swal.fire({
                icon: "warning",
                title: "Seleccione un permiso válido."
            });
            return;
        }

        // Verifica si el permiso ya fue agregado
        if (!permissionsData[roleId]) {
            permissionsData[roleId] = [];
        }
        if (permissionsData[roleId].some(p => p.id === selectedValue)) {
            Swal.fire({
                icon: "info",
                title: "Este permiso ya fue asignado."
            });
            return;
        }

        // Agrega al array y a la tabla
        permissionsData[roleId].push({ id: selectedValue, name: selectedText });

        const newRow = `
            <tr>
                <td>${permissionsData[roleId].length}</td>
                <td>${selectedText}</td>
                <td><button class="btn btn-danger btn-sm" onclick="removePermission(${roleId}, '${selectedValue}', this)">Eliminar</button></td>
            </tr>
        `;
        table.innerHTML += newRow;

        // Resetear el select
        select.selectedIndex = 0;
    }

    function removePermission(roleId, permissionId, button) {
        // Remover del array
        permissionsData[roleId] = permissionsData[roleId].filter(p => p.id !== permissionId);

        // Remover de la tabla
        const row = button.parentElement.parentElement;
        row.remove();
    }

    function submitPermissions(roleId) {
        const permissions = permissionsData[roleId] || [];
        if (permissions.length === 0) {
            Swal.fire({
                icon: "warning",
                title: "No hay permisos asignados para enviar."
            });
            return;
        }

        fetch("<?=APP_URL;?>/app/controllers/roles/create_roles_permissions.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ roleId, permissions }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
            Swal.fire({
                icon: "success",
                title: data.message,
                showConfirmButton: false,
                timer: 1500 // Mostrar por 1.5 segundos antes de recargar
            }).then(() => {
                location.reload(); // Recarga la página
            });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: data.message
                });
            }
        })
        .catch(error => {
            console.error("Error:", error);
            Swal.fire({
                icon: "error",
                title: "Error de conexión",
                text: "No se pudo conectar con el servidor."
            });
        });
    }
</script>

<?php
include ('../../admin/layout/part_2.php');
include ('../../layout/messages.php');
?>
