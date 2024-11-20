<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Conexión a la base de datos
$host = 'localhost';
$db = 'adopta_cut';
$user = 'root';
$pass = '';

// Conexión a la base de datos
$conn = new mysqli($host, $user, $pass, $db);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener datos del POST (en formato JSON)
$input = json_decode(file_get_contents('php://input'), true);

if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode(['success' => false, 'error' => 'Error en la decodificación JSON: ' . json_last_error_msg()]);
    exit;
}

// Verificar si los datos están completos
if (isset($input['id_mascota'], $input['fecha_adopcion'], $input['estado_adopcion'])) {
    $id_mascota = $input['id_mascota'];
    $fecha_adopcion = $input['fecha_adopcion'];
    $estado_adopcion = $input['estado_adopcion'];

    // Definir los valores válidos para el campo ENUM
    $valid_estado_adopcion = ['Pendiente', 'Aprobada', 'Rechazada'];

    // Verificar si el valor de estado_adopcion es válido
    if (!in_array($estado_adopcion, $valid_estado_adopcion)) {
        echo json_encode(['success' => false, 'error' => 'Estado de adopción inválido']);
        exit;
    }

    // Preparar la consulta para insertar en la tabla adopciones
    $sql = "INSERT INTO adopciones (ID_mascota, FechaAdopcion, estado) VALUES (?, ?, ?)";

    // Preparar la sentencia
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $id_mascota, $fecha_adopcion, $estado_adopcion);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    }

    // Cerrar la sentencia
    $stmt->close();
} else {
    echo json_encode(['success' => false, 'error' => 'Datos incompletos']);
}

// Cerrar la conexión
$conn->close();
?>