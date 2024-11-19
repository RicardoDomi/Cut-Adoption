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
    $Edad = $_POST['Edad'];
    $Raza = $_POST['Raza'];
    $Sexo = $_POST['Sexo'];
    $Descripcion = $_POST['Descripcion'];
    $FechaIngreso = $_POST['FechaIngreso'];

    // Manejo de la imagen
    $imagen = $_FILES['Imagen']; // Obtener el archivo de la imagen
    $imagenNombre = $imagen['name']; // Nombre del archivo
    $imagenTmpName = $imagen['tmp_name']; // Nombre temporal en el servidor
    $imagenSize = $imagen['size']; // Tamaño del archivo
    $imagenError = $imagen['error']; // Error si hubo alguno
    $imagenTipo = $imagen['type']; // Tipo de archivo

    // Validar imagen (solo archivos de imagen)
    $imagenExt = strtolower(pathinfo($imagenNombre, PATHINFO_EXTENSION));
    $extensionesValidas = ['jpg', 'jpeg', 'png', 'gif'];

    if (in_array($imagenExt, $extensionesValidas)) {
        if ($imagenError === 0) {
            if ($imagenSize < 5000000) { // Limitar a 5MB
                // Crear un nombre único para la imagen
                $imagenNuevoNombre = uniqid('', true) . "." . $imagenExt;
                $imagenDestino = "../../Resource/" . $imagenNuevoNombre;

                // Mover la imagen al directorio destino
                if (move_uploaded_file($imagenTmpName, $imagenDestino)) {
                    // Guardar la ruta de la imagen
                    $ImagenURL = "Resource/" . $imagenNuevoNombre;

                    // Usar consultas preparadas para evitar inyecciones SQL
                    $sql = $conn->prepare("INSERT INTO mascotas (Nombre, Edad, Raza, Sexo, Descripcion, FechaIngreso, ImagenURL) VALUES (?, ?, ?, ?, ?, ?, ?)");
                    $sql->bind_param("sssssss", $Nombre, $Edad, $Raza, $Sexo, $Descripcion, $FechaIngreso, $ImagenURL); // Tipo de datos: s = string

                    // Intentamos ejecutar la consulta
                    if ($sql->execute()) {
                        // Si los datos se guardan correctamente, redirigimos al usuario
                        header('Location: ../registro.php');
                        exit;  // Detener la ejecución del script
                    } else {
                        // Si ocurre un error en la ejecución de la consulta, mostramos el error
                        echo "Error al guardar los datos: " . $sql->error;
                    }
                } else {
                    echo "Error al mover la imagen al servidor.";
                }
            } else {
                echo "La imagen es demasiado grande. El tamaño máximo permitido es 5MB.";
            }
        } else {
            echo "Hubo un error al subir la imagen.";
        }
    } else {
        echo "Solo se permiten imágenes con extensión JPG, JPEG, PNG o GIF.";
    }
}

// Cerrar conexión
$conn->close();
?>
