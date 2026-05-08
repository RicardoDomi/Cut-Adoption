<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 0);

$conn = new mysqli("localhost", "root", "", "adopta_cut");

if ($conn->connect_error) {
    echo json_encode(["success" => false, "error" => "Error de conexión: " . $conn->connect_error]);
    exit;
}

$input = json_decode(file_get_contents("php://input"), true);

$id_mascota = $input["id_mascota"] ?? 1;
$nombre = $input["nombre"] ?? "";
$correo = $input["correo"] ?? "";
$telefono = $input["telefono"] ?? "";
$direccion = $input["direccion"] ?? "";
$vivienda = $input["vivienda"] ?? "";
$motivo = $input["motivo"] ?? "";
$experiencia = $input["experiencia"] ?? "";

if ($nombre == "" || $correo == "" || $telefono == "" || $direccion == "" || $vivienda == "" || $motivo == "" || $experiencia == "") {
    echo json_encode(["success" => false, "error" => "Faltan datos del formulario"]);
    exit;
}

$fecha = date("Y-m-d");

$sqlAdoptante = "INSERT INTO adoptantes (Nombre, Telefono, Correo, Direccion, FechaRegistro)
                 VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sqlAdoptante);

if (!$stmt) {
    echo json_encode(["success" => false, "error" => $conn->error]);
    exit;
}

$stmt->bind_param("sssss", $nombre, $telefono, $correo, $direccion, $fecha);

if (!$stmt->execute()) {
    echo json_encode(["success" => false, "error" => $stmt->error]);
    exit;
}

$id_adoptante = $conn->insert_id;

$sqlAdopcion = "INSERT INTO adopciones (ID_Mascota, ID_Adoptante, FechaAdopcion, Estado)
                VALUES (?, ?, ?, 'Pendiente')";

$stmt2 = $conn->prepare($sqlAdopcion);
$stmt2->bind_param("iis", $id_mascota, $id_adoptante, $fecha);

if (!$stmt2->execute()) {
    echo json_encode(["success" => false, "error" => $stmt2->error]);
    exit;
}

$mensaje = "Vivienda: $vivienda | Motivo: $motivo | Experiencia: $experiencia";

$sqlInteraccion = "INSERT INTO interacciones (ID_Mascota, ID_Adoptante, Mensaje, FechaSolicitud)
                   VALUES (?, ?, ?, ?)";

$stmt3 = $conn->prepare($sqlInteraccion);
$stmt3->bind_param("iiss", $id_mascota, $id_adoptante, $mensaje, $fecha);

if (!$stmt3->execute()) {
    echo json_encode(["success" => false, "error" => $stmt3->error]);
    exit;
}

echo json_encode(["success" => true]);
$conn->close();
?>