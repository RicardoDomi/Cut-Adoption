<?php
$conn = new mysqli('localhost', 'root', '', 'adopta_cut');
if ($conn->connect_error) {
    header("Location: ../agregar_mascota.html?status=error&msg=" . urlencode("Error de conexión."));
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre       = trim($_POST['nombre']);
    $edad         = intval($_POST['edad']);
    $raza         = trim($_POST['raza']);
    $sexo         = $_POST['sexo'];
    $descripcion  = trim($_POST['descripcion']);
    $fechaIngreso = $_POST['fecha_ingreso'];

    $carpeta = "../Resource/uploads/";
    if (!is_dir($carpeta)) mkdir($carpeta, 0777, true);

    if (!isset($_FILES['imagen']) || $_FILES['imagen']['error'] !== 0) {
        header("Location: ../agregar_mascota.html?status=error&msg=" . urlencode("Debes seleccionar una imagen."));
        exit();
    }

    $ext = strtolower(pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, ['jpg','jpeg','png','gif'])) {
        header("Location: ../agregar_mascota.html?status=error&msg=" . urlencode("Solo JPG, PNG o GIF."));
        exit();
    }
    if ($_FILES['imagen']['size'] > 5000000) {
        header("Location: ../agregar_mascota.html?status=error&msg=" . urlencode("La imagen supera 5MB."));
        exit();
    }

    $nombreImagen = time() . "_" . preg_replace('/\s+/', '_', basename($_FILES['imagen']['name']));
    if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta . $nombreImagen)) {
        header("Location: ../agregar_mascota.html?status=error&msg=" . urlencode("No se pudo subir la imagen."));
        exit();
    }

    $imagenURL = "Resource/uploads/" . $nombreImagen;

    $stmt = $conn->prepare(
        "INSERT INTO mascotas (Nombre, Edad, Raza, Sexo, Descripcion, FechaIngreso, ImagenURL) VALUES (?, ?, ?, ?, ?, ?, ?)"
    );
    $stmt->bind_param("siissss", $nombre, $edad, $raza, $sexo, $descripcion, $fechaIngreso, $imagenURL);

    if ($stmt->execute()) {
        header("Location: ../agregar_mascota.html?status=success&msg=" . urlencode("¡Mascota registrada correctamente!"));
    } else {
        header("Location: ../agregar_mascota.html?status=error&msg=" . urlencode("Error al guardar: " . $stmt->error));
    }
    $stmt->close();
} else {
    header("Location: ../agregar_mascota.html");
}

$conn->close();
exit();
?>
