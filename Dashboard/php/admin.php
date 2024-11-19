<?php

session_start(); // Iniciar la sesión

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['admin_id'])) {
    // Si no ha iniciado sesión, redirigir al login
    header("Location: ../index.html");
    exit(); // Detener la ejecución del script
}

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $Nombre = $_POST['Nombre'];
    $Correo = $_POST['Correo'];
    $Contrasena = password_hash($_POST['Contrasena'], PASSWORD_DEFAULT);  // Encriptar la contraseña

    // Manejo de la imagen
    $foto = $_FILES['Foto'];
    $fotoNombre = $foto['name'];
    $fotoTmpName = $foto['tmp_name'];
    $fotoSize = $foto['size'];
    $fotoError = $foto['error'];
    
    // Verificar si se subió una foto
    $FotoURL = NULL;  // Valor por defecto si no se sube ninguna foto
    if ($fotoError === 0 && $fotoSize > 0) {
        // Crear un nombre único para la foto
        $fotoExt = strtolower(pathinfo($fotoNombre, PATHINFO_EXTENSION));
        $extensionesValidas = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($fotoExt, $extensionesValidas)) {
            $nuevoNombreFoto = uniqid('', true) . "." . $fotoExt;
            $rutaDestino = "../../Resource/admin/" . $nuevoNombreFoto;
            
            // Mover la imagen al directorio destino
            if (move_uploaded_file($fotoTmpName, $rutaDestino)) {
                $FotoURL = "Resource/admin/" . $nuevoNombreFoto;  // Guardar la ruta relativa de la foto
            }
        } else {
            echo "Solo se permiten imágenes de tipo JPG, JPEG, PNG o GIF.";
            exit;  // Detener la ejecución si la imagen no es válida
        }
    }

    // Asignar estado por defecto
    $Estado = 'Activo';

    // Insertar el administrador en la base de datos
    $sql = $conn->prepare("INSERT INTO administrador (Nombre, Correo, Contrasena, Estado, FotoURL) VALUES (?, ?, ?, ?, ?)");
    $sql->bind_param("sssss", $Nombre, $Correo, $Contrasena, $Estado, $FotoURL);

    if ($sql->execute()) {
        header('Location: ../admin.php');
    } else {
        echo "Error al registrar el administrador: " . $sql->error;
    }
}

// Cerrar la conexión
$conn->close();
?>
