<?php
include('../../config.php'); // Configuración de base de datos y variables globales
session_start(); // Inicia la sesión

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Decodificar los datos enviados desde el frontend
    $input = json_decode(file_get_contents('php://input'), true);

    $roleId = $input['roleId'];
    $permissions = $input['permissions'];

    // Validar los datos
    if (empty($roleId) || empty($permissions)) {
        echo json_encode([
            'success' => false,
            'message' => "Datos inválidos. No se pudieron asignar los permisos."
        ]);
        exit();
    }

    try {
        // Preparar la sentencia para insertar permisos
        $judgment = $pdo->prepare("INSERT INTO roles_permissions (rol_id, permission_id, fyh_creation) 
            VALUES (:rol_id, :permission_id, :fyh_creation)");

        // Iterar sobre cada permiso y registrar
        foreach ($permissions as $permission) {
            $judgment->bindParam(':rol_id', $roleId, PDO::PARAM_INT);
            $judgment->bindParam(':permission_id', $permission['id'], PDO::PARAM_INT);
            $judgment->bindParam(':fyh_creation', $fyh_creation, PDO::PARAM_STR);

            // Ejecutar la consulta
            $judgment->execute();
        }

        // Respuesta exitosa
        echo json_encode([
            'success' => true,
            'message' => "Permisos asignados correctamente."
        ]);
    } catch (Exception $exception) {
        // Capturar y manejar errores
        echo json_encode([
            'success' => false,
            'message' => "Error al asignar permisos: " . $exception->getMessage()
        ]);
    }
    exit();
} else {
    // Respuesta para métodos que no son POST
    echo json_encode([
        'success' => false,
        'message' => "Método no permitido."
    ]);
    exit();
}
?>
