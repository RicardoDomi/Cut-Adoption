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

// Consulta para obtener las mascotas
$sql = "SELECT ID_Mascota, Nombre, Edad, ImagenURL FROM mascotas";
$result = $conn->query($sql);

// Verificar si hay resultados
$mascotas = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $mascotas[] = $row;
    }
}

// Obtener las adopciones que están en proceso (o en pendiente, según lo que uses)
$adopciones_en_proceso = [];
$sql_adopciones = "SELECT ID_Mascota FROM adopciones WHERE Estado = 'Pendiente'"; // Cambiar 'Pendiente' por 'En proceso' si es necesario
$result_adopciones = $conn->query($sql_adopciones);

if ($result_adopciones->num_rows > 0) {
    while ($row = $result_adopciones->fetch_assoc()) {
        $adopciones_en_proceso[] = $row['ID_Mascota']; // Asegúrate de que la columna se llama ID_Mascota
    }
}
// Incluir las adopciones en proceso en los datos de las mascotas
foreach ($mascotas as &$mascota) {
    // Marcar las mascotas cuya adopción esté en proceso
    if (in_array($mascota['ID_Mascota'], $adopciones_en_proceso)) {
        $mascota['en_proceso'] = true;  // Correctamente establecemos 'en_proceso'
    } else {
        $mascota['en_proceso'] = false;
    }
}

// Devolver los datos en formato JSON
header('Content-Type: application/json');
echo json_encode($mascotas);

// Cerrar conexión
$conn->close();
?>
