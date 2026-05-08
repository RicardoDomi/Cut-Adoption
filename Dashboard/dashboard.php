<?php

$conn = new mysqli("localhost", "root", "", "adopta_cut");

$totalMascotas = $conn->query("SELECT COUNT(*) as total FROM mascotas")->fetch_assoc()['total'];

$disponibles = $conn->query("SELECT COUNT(*) as total FROM mascotas WHERE ID_Mascota NOT IN (
    SELECT ID_Mascota FROM adopciones WHERE Estado='Pendiente'
)")->fetch_assoc()['total'];

$proceso = $conn->query("SELECT COUNT(*) as total FROM adopciones WHERE Estado='Pendiente'")
->fetch_assoc()['total'];

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>

    <style>

        body{
            font-family: Arial;
            background:#f4f4f4;
            padding:40px;
        }

        .cards{
            display:flex;
            gap:20px;
            flex-wrap:wrap;
        }

        .card{
            background:white;
            padding:30px;
            border-radius:15px;
            width:250px;
            box-shadow:0 0 10px rgba(0,0,0,.1);
        }

        h1{
            margin-bottom:30px;
        }

        .numero{
            font-size:40px;
            font-weight:bold;
            color:#00b894;
        }

    </style>

</head>

<body>

    <h1>Dashboard de Adopciones</h1>

    <div class="cards">

        <div class="card">
            <h2>Total Mascotas</h2>
            <div class="numero"><?php echo $totalMascotas; ?></div>
        </div>

        <div class="card">
            <h2>Disponibles</h2>
            <div class="numero"><?php echo $disponibles; ?></div>
        </div>

        <div class="card">
            <h2>En Proceso</h2>
            <div class="numero"><?php echo $proceso; ?></div>
        </div>

    </div>

</body>
</html>