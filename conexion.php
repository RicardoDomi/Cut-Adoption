<?php
$host = 'localhost';
$db   = 'adopta_cut';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Error de conexión: ' . $conn->connect_error]);
    exit();
}

// Traer TODOS los campos que necesita el app.js
$sql = "SELECT ID_Mascota, Nombre, Edad, Raza, Sexo, Descripcion, ImagenURL FROM mascotas";
$result = $conn->query($sql);

$mascotas = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $mascotas[] = $row;
    }
}

// Mascotas en proceso de adopción
$adopciones_en_proceso = [];
$result_adopciones = $conn->query("SELECT ID_Mascota FROM adopciones WHERE Estado = 'Pendiente'");
if ($result_adopciones && $result_adopciones->num_rows > 0) {
    while ($row = $result_adopciones->fetch_assoc()) {
        $adopciones_en_proceso[] = $row['ID_Mascota'];
    }
}

// Marcar cuáles están en proceso
foreach ($mascotas as &$mascota) {
    $mascota['en_proceso'] = in_array($mascota['ID_Mascota'], $adopciones_en_proceso);
}

header('Content-Type: application/json');
echo json_encode($mascotas);

$conn->close();
?>
