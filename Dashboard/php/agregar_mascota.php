<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../index.html");
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'adopta_cut');
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre       = trim($_POST['nombre']);
    $edad         = intval($_POST['edad']);
    $raza         = trim($_POST['raza']);
    $sexo         = $_POST['sexo'];
    $descripcion  = trim($_POST['descripcion']);
    $fechaIngreso = $_POST['fecha_ingreso'];

    // Carpeta destino (relativa a Dashboard/php/)
    $carpeta = "../../Resource/uploads/";
    if (!is_dir($carpeta)) {
        mkdir($carpeta, 0777, true);
    }

    // Validar que se envió imagen
    if (!isset($_FILES['imagen']) || $_FILES['imagen']['error'] !== 0) {
        header("Location: ../agregar_mascota.php?status=error&msg=" . urlencode("Debes seleccionar una imagen."));
        exit();
    }

    $ext = strtolower(pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
        header("Location: ../agregar_mascota.php?status=error&msg=" . urlencode("Solo se permiten JPG, PNG o GIF."));
        exit();
    }
    if ($_FILES['imagen']['size'] > 5000000) {
        header("Location: ../agregar_mascota.php?status=error&msg=" . urlencode("La imagen no debe superar 5MB."));
        exit();
    }

    // Nombre unico para evitar colisiones
    $nombreImagen = time() . "_" . preg_replace('/\s+/', '_', basename($_FILES['imagen']['name']));
    $rutaImagen   = $carpeta . $nombreImagen;

    if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaImagen)) {
        header("Location: ../agregar_mascota.php?status=error&msg=" . urlencode("No se pudo subir la imagen al servidor."));
        exit();
    }

    // Ruta relativa guardada en la BD
    $imagenURL = "Resource/uploads/" . $nombreImagen;

    // s=Nombre, i=Edad, s=Raza, s=Sexo, s=Descripcion, s=FechaIngreso, s=ImagenURL
    $stmt = $conn->prepare(
        "INSERT INTO mascotas (Nombre, Edad, Raza, Sexo, Descripcion, FechaIngreso, ImagenURL)
         VALUES (?, ?, ?, ?, ?, ?, ?)"
    );
    $stmt->bind_param("siissss", $nombre, $edad, $raza, $sexo, $descripcion, $fechaIngreso, $imagenURL);

    if ($stmt->execute()) {
        header("Location: ../agregar_mascota.php?status=success&msg=" . urlencode("Mascota registrada correctamente."));
    } else {
        header("Location: ../agregar_mascota.php?status=error&msg=" . urlencode("Error al guardar: " . $stmt->error));
    }
    $stmt->close();
} else {
    header("Location: ../agregar_mascota.php");
}

$conn->close();
exit();
?>
