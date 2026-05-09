<?php
$conn = new mysqli('localhost', 'root', '', 'adopta_cut');
if ($conn->connect_error) die("Error de conexión");

$mascotas = $conn->query("SELECT ID_Mascota, Nombre, Edad, Raza, Sexo, ImagenURL FROM mascotas ORDER BY ID_Mascota DESC");
$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Mascota - Adopta CUT</title>
    <link rel="stylesheet" href="CSS/estilos.css">
    <style>
        .mascotas-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 20px;
        }
        .card-eliminar {
            border: 1px solid #b2dfdb;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            width: 220px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            background: white;
        }
        .card-eliminar img {
            width: 100%;
            height: 160px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 10px;
        }
        .card-eliminar h3 { color: #00796b; margin: 8px 0 4px; }
        .card-eliminar p  { margin: 3px 0; font-size: 14px; color: #555; }
        .btn-eliminar {
            display: inline-block;
            margin-top: 12px;
            padding: 10px 20px;
            background: #e53935;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            cursor: pointer;
            transition: 0.3s;
            font-weight: bold;
            text-decoration: none;
        }
        .btn-eliminar:hover { background: #b71c1c; }
        .alerta {
            padding: 15px 20px;
            border-radius: 12px;
            margin: 20px auto;
            max-width: 600px;
            font-size: 16px;
            text-align: center;
        }
        .alerta-ok  { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alerta-err { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .sin-mascotas { text-align:center; color:#999; padding: 40px; font-size: 18px; }
        section h2 { text-align: center; color: #009688; margin-bottom: 10px; }
        section p.subtitulo { text-align: center; color: #555; margin-bottom: 20px; }
    </style>
</head>
<body>

    <!-- HEADER -->
    <header id="header">
        <h1>Adopta una Mascota</h1>
        <nav>
            <ul>
                <li><a href="index.html#inicio">Inicio</a></li>
                <li><a href="Nosotros/nosotros.html">Nosotros</a></li>
                <li><a href="index.html#mascotas">Mascotas Disponibles</a></li>
                <li><a href="index.html#solicitud">Solicitud</a></li>
                <li><a href="Contacto/contacto.html">Contacto</a></li>
                <li><a href="agregar_mascota.html" style="color:#009688; font-weight:bold;">➕ Agregar Mascota</a></li>
                <li><a href="eliminar_mascota.php" style="color:#e53935; font-weight:bold;">🗑 Eliminar Mascota</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section style="padding: 40px 20px;">
            <h2>🗑 Eliminar Mascota</h2>
            <p class="subtitulo">Selecciona la mascota que deseas eliminar del sistema.</p>

            <?php if (isset($_GET['status'])): ?>
                <?php if ($_GET['status'] === 'deleted'): ?>
                    <div class="alerta alerta-ok">✅ Mascota eliminada correctamente.</div>
                <?php else: ?>
                    <div class="alerta alerta-err">❌ Ocurrió un error al eliminar.</div>
                <?php endif; ?>
            <?php endif; ?>

            <div class="mascotas-grid">
                <?php if ($mascotas && $mascotas->num_rows > 0): ?>
                    <?php while ($m = $mascotas->fetch_assoc()): ?>
                    <div class="card-eliminar">
                        <?php
                            $img = str_replace('\\', '/', $m['ImagenURL'] ?? '');
                        ?>
                        <img src="<?php echo htmlspecialchars($img); ?>"
                             alt="<?php echo htmlspecialchars($m['Nombre']); ?>"
                             onerror="this.src='Resource/00004-2027063230.png'">
                        <h3><?php echo htmlspecialchars($m['Nombre']); ?></h3>
                        <p><strong>Edad:</strong> <?php echo $m['Edad']; ?> años</p>
                        <p><strong>Raza:</strong> <?php echo htmlspecialchars($m['Raza'] ?? 'No especificada'); ?></p>
                        <p><strong>Sexo:</strong> <?php echo $m['Sexo']; ?></p>
                        <a href="php/eliminar_mascota.php?id=<?php echo $m['ID_Mascota']; ?>"
                           class="btn-eliminar"
                           onclick="return confirm('¿Seguro que deseas eliminar a <?php echo htmlspecialchars($m['Nombre']); ?>?')">
                            🗑 Eliminar
                        </a>
                    </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p class="sin-mascotas">No hay mascotas registradas. <a href="agregar_mascota.html">¡Agregar una!</a></p>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <!-- FOOTER -->
    <footer>
        <p>&copy; 2025 Adopta una Mascota. Todos los derechos reservados.</p>
    </footer>

</body>
</html>
