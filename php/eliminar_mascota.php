<?php
$conn = new mysqli('localhost', 'root', '', 'adopta_cut');
if ($conn->connect_error) {
    header("Location: ../eliminar_mascota.php?status=error");
    exit();
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    // Obtener imagen para borrarla del servidor
    $result = $conn->query("SELECT ImagenURL FROM mascotas WHERE ID_Mascota = $id");
    if ($result && $row = $result->fetch_assoc()) {
        $imagenPath = "../" . str_replace('\\', '/', $row['ImagenURL']);
        if ($row['ImagenURL'] && strpos($row['ImagenURL'], 'Resource/') === 0 && file_exists($imagenPath)) {
            unlink($imagenPath);
        }
    }

    $stmt = $conn->prepare("DELETE FROM mascotas WHERE ID_Mascota = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: ../eliminar_mascota.php?status=deleted");
    } else {
        header("Location: ../eliminar_mascota.php?status=error");
    }
    $stmt->close();
} else {
    header("Location: ../eliminar_mascota.php?status=error");
}

$conn->close();
exit();
?>
