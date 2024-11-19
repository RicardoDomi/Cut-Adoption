<?php
session_start(); // Iniciar la sesión

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['admin_id'])) {
    // Si no ha iniciado sesión, redirigir al login
    header("Location: ../index.html");
    exit(); // Detener la ejecución del script
}

// Establecer la conexión con la base de datos
$host = 'localhost';
$db = 'adopta_cut';
$user = 'root';
$pass = '';

// Crear la conexión
$conn = new mysqli($host, $user, $pass, $db);

// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Si el formulario se envía (con método POST), insertamos los datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Nombre = $_POST['Nombre'];
    $Correo = $_POST['Correo'];
    $Telefono = $_POST['Telefono'];
    $Direccion = $_POST['Direccion'];
    $FechaRegistro = $_POST['FechaRegistro'];

    // Usar consultas preparadas para evitar inyecciones SQL
    $sql = $conn->prepare("INSERT INTO adoptantes (Nombre, Correo, Telefono, Direccion, FechaRegistro) VALUES (?, ?, ?, ?, ?)");
    $sql->bind_param("sssss", $Nombre, $Correo, $Telefono, $Direccion, $FechaRegistro); // Tipo de datos: s = string

    // Intentamos ejecutar la consulta
    if ($sql->execute()) {
        // Si los datos se guardan correctamente, redirigimos al usuario
        header('Location: ../adoptante.php');
        exit;  // Detener la ejecución del script
    } else {
        // Si ocurre un error, mostramos el mensaje de error
        echo "Error: " . $sql->error;
    }
}

//buscar tabla
// Consultar todos los registros de la tabla 'adoptantes'
$sql = "SELECT * FROM adoptantes";
$result = $conn->query($sql);

// Verificar si hay resultados
if ($result->num_rows > 0) {
    // Recorrer los resultados y construir las filas de la tabla
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['Nombre'] . "</td>";
        echo "<td>" . $row['Direccion'] . "</td>";
        echo "<td>" . $row['Correo'] . "</td>";
        echo "<td>" . $row['Telefono'] . "</td>";
        echo "<td>" . $row['FechaRegistro'] . "</td>";
        echo "<td><a href='actualizar.php?id=" . $row['id'] . "'>Actualizar</a></td>";
        echo "<td><a href='borrar.php?id=" . $row['id'] . "'>Borrar</a></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='8'>No hay registros</td></tr>";
}
// Cerrar la conexión a la base de datos
$conn->close();
?>
