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

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    // Obtener la ruta de la imagen para borrarla del servidor
    $result = $conn->query("SELECT ImagenURL FROM mascotas WHERE ID_Mascota = $id");
    if ($result && $row = $result->fetch_assoc()) {
        $imagenPath = "../../" . $row['ImagenURL'];
        // Solo borrar si existe y está dentro de Resource/
        if ($row['ImagenURL'] && strpos($row['ImagenURL'], 'Resource/') === 0 && file_exists($imagenPath)) {
            unlink($imagenPath);
        }
    }

    // Eliminar de la base de datos
    $stmt = $conn->prepare("DELETE FROM mascotas WHERE ID_Mascota = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: ../lista_mascotas.php?status=deleted");
    } else {
        header("Location: ../lista_mascotas.php?status=error");
    }
    $stmt->close();
} else {
    header("Location: ../lista_mascotas.php?status=error");
}

$conn->close();
exit();
?>
