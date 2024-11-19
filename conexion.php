<?php
// Configuración de la base de datos
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

// Consulta para obtener las mascotas (corrigiendo la coma extra)
$sql = "SELECT Nombre, Edad, ImagenURL FROM mascotas";
$result = $conn->query($sql);

// Verificar si hay resultados
$mascotas = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $mascotas[] = $row;
    }
}

// Devolver los datos en formato JSON
header('Content-Type: application/json');
echo json_encode($mascotas);

// Cerrar conexión
$conn->close();
?>
