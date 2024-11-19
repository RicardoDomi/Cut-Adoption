<?php
session_start(); // Iniciar la sesión para almacenar el estado del usuario

// Configuración de la base de datos
$host = 'localhost';
$db = 'adopta_cut';
$user = 'root';
$pass = '';

// Conexión a la base de datos
$conn = new mysqli($host, $user, $pass, $db);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $Correo = $_POST['UserEmail'];
    $Contrasena = $_POST['UserPass'];

    // Consulta para verificar el correo y la contraseña
    $sql = "SELECT * FROM administrador WHERE Correo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $Correo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Si el correo existe, obtener los datos
        $row = $result->fetch_assoc();

        // Verificar si la contraseña es correcta
        if (password_verify($Contrasena, $row['Contrasena'])) {
            // Si la contraseña es correcta, iniciar sesión y redirigir al usuario
            $_SESSION['admin_id'] = $row['ID_Admin']; // Guardar el ID de administrador en la sesión
            $_SESSION['admin_name'] = $row['Nombre']; // Guardar el nombre del administrador
            $_SESSION['admin_email'] = $row['Correo']; // Guardar el correo del administrador

            header("Location: ../home.php"); // Redirigir al usuario a la página principal
            exit();
        } else {
            // Contraseña incorrecta
            echo "<script>alert('Contraseña incorrecta'); window.location.href='../index.html';</script>";
        }
    } else {
        // El correo no está registrado
        echo "<script>alert('Correo no registrado'); window.location.href='../index.html';</script>";
    }
}

// Cerrar la conexión
$conn->close();
?>
