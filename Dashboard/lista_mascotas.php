<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: index.html");
    exit();
}

// Conexión a BD
$conn = new mysqli('localhost', 'root', '', 'adopta_cut');
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener mascotas
$mascotas = $conn->query("SELECT * FROM mascotas ORDER BY ID_Mascota DESC");
$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Lista de Mascotas</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="./css/main.css">
</head>
<body>

	<!-- SideBar -->
	<section class="full-box cover dashboard-sideBar">
		<div class="full-box dashboard-sideBar-bg btn-menu-dashboard"></div>
		<div class="full-box dashboard-sideBar-ct">
			<div class="full-box text-uppercase text-center text-titles dashboard-sideBar-title">
				Adopta cut <i class="zmdi zmdi-close btn-menu-dashboard visible-xs"></i>
			</div>
			<div class="full-box dashboard-sideBar-UserInfo">
				<figure class="full-box">
					<img src="./assets/img/avatar.jpg" alt="UserIcon">
					<figcaption class="text-center text-titles">User Name</figcaption>
				</figure>
				<ul class="full-box list-unstyled text-center">
					<li><a href="#!"><i class="zmdi zmdi-settings"></i></a></li>
					<li><a href="#!" class="btn-exit-system"><i class="zmdi zmdi-power"></i></a></li>
				</ul>
			</div>
			<!-- SideBar Menu -->
			<ul class="list-unstyled full-box dashboard-sideBar-Menu">
				<li>
					<a href="home.php">
						<i class="zmdi zmdi-view-dashboard zmdi-hc-fw"></i> Dashboard
					</a>
				</li>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-account-add zmdi-hc-fw"></i> Usuarios
						<i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li><a href="admin.php"><i class="zmdi zmdi-account zmdi-hc-fw"></i> Admin</a></li>
						<li><a href="adoptante.php"><i class="zmdi zmdi-male-alt zmdi-hc-fw"></i> Adoptante</a></li>
					</ul>
				</li>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-card zmdi-hc-fw"></i> Adopcion
						<i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li><a href="registro.php"><i class="zmdi zmdi-money-box zmdi-hc-fw"></i> Registro</a></li>
					</ul>
				</li>
				<!-- MENÚ MASCOTAS -->
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-nature-people zmdi-hc-fw"></i> Mascotas
						<i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="agregar_mascota.php">
								<i class="zmdi zmdi-plus-circle zmdi-hc-fw"></i> Agregar Mascota
							</a>
						</li>
						<li>
							<a href="lista_mascotas.php">
								<i class="zmdi zmdi-delete zmdi-hc-fw"></i> Eliminar Mascota
							</a>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</section>

	<!-- Content page -->
	<section class="full-box dashboard-contentPage">
		<!-- NavBar -->
		<nav class="full-box dashboard-Navbar">
			<ul class="full-box list-unstyled text-right">
				<li class="pull-left">
					<a href="#!" class="btn-menu-dashboard"><i class="zmdi zmdi-more-vert"></i></a>
				</li>
				<li>
					<a href="#!" class="btn-Notifications-area">
						<i class="zmdi zmdi-notifications-none"></i>
						<span class="badge">7</span>
					</a>
				</li>
				<li><a href="#!" class="btn-search"><i class="zmdi zmdi-search"></i></a></li>
				<li><a href="#!" class="btn-modal-help"><i class="zmdi zmdi-help-outline"></i></a></li>
			</ul>
		</nav>

		<!-- Encabezado -->
		<div class="container-fluid">
			<div class="page-header">
				<h1 class="text-titles">
					<i class="zmdi zmdi-nature-people zmdi-hc-fw"></i> Mascotas <small>Lista</small>
				</h1>
			</div>
			<p class="lead">Aquí puedes ver y eliminar las mascotas registradas en el sistema.</p>
		</div>

		<!-- Alerta de resultado -->
		<?php if (isset($_GET['status'])): ?>
		<div class="container-fluid">
			<?php if ($_GET['status'] === 'deleted'): ?>
				<div class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong><i class="zmdi zmdi-check-circle"></i></strong> Mascota eliminada correctamente.
				</div>
			<?php elseif ($_GET['status'] === 'error'): ?>
				<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong><i class="zmdi zmdi-alert-triangle"></i></strong> Ocurrió un error al eliminar.
				</div>
			<?php endif; ?>
		</div>
		<?php endif; ?>

		<!-- Botón agregar -->
		<div class="container-fluid" style="margin-bottom:10px;">
			<a href="agregar_mascota.php" class="btn btn-info btn-raised btn-sm">
				<i class="zmdi zmdi-plus"></i> Agregar nueva mascota
			</a>
		</div>

		<!-- Tabla de mascotas -->
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12">
					<div class="table-responsive">
						<table class="table table-striped table-hover table-bordered">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">Foto</th>
									<th class="text-center">Nombre</th>
									<th class="text-center">Edad</th>
									<th class="text-center">Raza</th>
									<th class="text-center">Sexo</th>
									<th class="text-center">Descripción</th>
									<th class="text-center">Fecha Ingreso</th>
									<th class="text-center">Eliminar</th>
								</tr>
							</thead>
							<tbody>
							<?php if ($mascotas && $mascotas->num_rows > 0): ?>
								<?php while ($row = $mascotas->fetch_assoc()): ?>
								<tr>
									<td class="text-center"><?php echo $row['ID_Mascota']; ?></td>
									<td class="text-center">
										<?php if ($row['ImagenURL']): ?>
											<img src="../<?php echo htmlspecialchars($row['ImagenURL']); ?>"
												alt="<?php echo htmlspecialchars($row['Nombre']); ?>"
												width="60" height="60"
												style="object-fit:cover; border-radius:6px; border:1px solid #ddd;">
										<?php else: ?>
											<span class="text-muted">Sin foto</span>
										<?php endif; ?>
									</td>
									<td><?php echo htmlspecialchars($row['Nombre']); ?></td>
									<td class="text-center"><?php echo $row['Edad']; ?> años</td>
									<td><?php echo htmlspecialchars($row['Raza'] ?? '-'); ?></td>
									<td class="text-center"><?php echo $row['Sexo']; ?></td>
									<td><?php echo htmlspecialchars($row['Descripcion'] ?? '-'); ?></td>
									<td class="text-center"><?php echo $row['FechaIngreso']; ?></td>
									<td class="text-center">
										<a href="php/eliminar_mascota.php?id=<?php echo $row['ID_Mascota']; ?>"
										   class="btn btn-danger btn-raised btn-xs btn-eliminar"
										   data-nombre="<?php echo htmlspecialchars($row['Nombre']); ?>">
											<i class="zmdi zmdi-delete"></i> Eliminar
										</a>
									</td>
								</tr>
								<?php endwhile; ?>
							<?php else: ?>
								<tr>
									<td colspan="9" class="text-center text-muted">
										No hay mascotas registradas.
										<a href="agregar_mascota.php">¡Agregar una ahora!</a>
									</td>
								</tr>
							<?php endif; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Notifications area -->
	<section class="full-box Notifications-area">
		<div class="full-box Notifications-bg btn-Notifications-area"></div>
		<div class="full-box Notifications-body">
			<div class="Notifications-body-title text-titles text-center">
				Notifications <i class="zmdi zmdi-close btn-Notifications-area"></i>
			</div>
		</div>
	</section>

	<!-- Dialog help -->
	<div class="modal fade" tabindex="-1" role="dialog" id="Dialog-Help">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
					<h4 class="modal-title">Ayuda</h4>
				</div>
				<div class="modal-body">
					<p>Este dashboard funciona para proporcionar control sobre la pagina web</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary btn-raised" data-dismiss="modal">
						<i class="zmdi zmdi-thumb-up"></i> Ok
					</button>
				</div>
			</div>
		</div>
	</div>

	<!--====== Scripts -->
	<script src="./js/jquery-3.1.1.min.js"></script>
	<script src="./js/sweetalert2.min.js"></script>
	<script src="./js/bootstrap.min.js"></script>
	<script src="./js/material.min.js"></script>
	<script src="./js/ripples.min.js"></script>
	<script src="./js/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="./js/main.js"></script>
	<script>
		$.material.init();

		// Confirmación antes de eliminar con SweetAlert2
		$(document).on('click', '.btn-eliminar', function (e) {
			e.preventDefault();
			var url    = $(this).attr('href');
			var nombre = $(this).data('nombre');

			swal({
				title: '¿Eliminar a ' + nombre + '?',
				text: 'Esta acción no se puede deshacer.',
				type: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Sí, eliminar',
				cancelButtonText: 'Cancelar',
				confirmButtonColor: '#f44336',
				cancelButtonColor: '#757575'
			}).then(function (result) {
				if (result.value) {
					window.location.href = url;
				}
			});
		});
	</script>
</body>
</html>
