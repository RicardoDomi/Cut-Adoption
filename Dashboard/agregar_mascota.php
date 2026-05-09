<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: index.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Agregar Mascota</title>
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
					<i class="zmdi zmdi-plus-circle zmdi-hc-fw"></i> Mascotas <small>Agregar</small>
				</h1>
			</div>
			<p class="lead">Registra una nueva mascota en el sistema y sube su fotografía.</p>
		</div>

		<!-- Alertas de resultado -->
		<?php if (isset($_GET['status'])): ?>
		<div class="container-fluid">
			<?php if ($_GET['status'] === 'success'): ?>
				<div class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong><i class="zmdi zmdi-check-circle"></i></strong>
					<?php echo htmlspecialchars(urldecode($_GET['msg'] ?? '¡Mascota registrada!')); ?>
				</div>
			<?php elseif ($_GET['status'] === 'error'): ?>
				<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong><i class="zmdi zmdi-alert-triangle"></i></strong>
					<?php echo htmlspecialchars(urldecode($_GET['msg'] ?? 'Ocurrió un error.')); ?>
				</div>
			<?php endif; ?>
		</div>
		<?php endif; ?>

		<!-- Formulario -->
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12 col-md-8 col-md-offset-2">
					<form action="php/agregar_mascota.php" method="POST" enctype="multipart/form-data">

						<div class="form-group">
							<label for="nombre">Nombre de la Mascota:</label>
							<input type="text" class="form-control" id="nombre" name="nombre" required placeholder="Ej: Max">
						</div>

						<div class="form-group">
							<label for="edad">Edad (años):</label>
							<input type="number" class="form-control" id="edad" name="edad" required min="0" max="30">
						</div>

						<div class="form-group">
							<label for="raza">Raza:</label>
							<input type="text" class="form-control" id="raza" name="raza" placeholder="Ej: Labrador">
						</div>

						<div class="form-group">
							<label for="sexo">Sexo:</label>
							<select class="form-control" id="sexo" name="sexo" required>
								<option value="Macho">Macho</option>
								<option value="Hembra">Hembra</option>
							</select>
						</div>

						<div class="form-group">
							<label for="descripcion">Descripción:</label>
							<textarea class="form-control" id="descripcion" name="descripcion" rows="4"
								placeholder="Escribe una descripción de la mascota..."></textarea>
						</div>

						<div class="form-group">
							<label for="imagen">Foto de la Mascota:</label>
							<input type="file" class="form-control" id="imagen" name="imagen"
								accept=".jpg,.jpeg,.png,.gif" required>
							<small class="text-muted">Formatos permitidos: JPG, PNG, GIF. Tamaño máximo: 5MB.</small>
							<!-- Vista previa -->
							<div id="preview-box" style="margin-top:10px; display:none;">
								<img id="preview-img" src="#" alt="Vista previa"
									style="max-width:180px; max-height:180px; border-radius:8px; border:1px solid #ddd; object-fit:cover;">
							</div>
						</div>

						<div class="form-group">
							<label for="fecha_ingreso">Fecha de Ingreso:</label>
							<input type="date" class="form-control" id="fecha_ingreso" name="fecha_ingreso" required>
						</div>

						<p class="text-center" style="margin-top:20px;">
							<button type="submit" class="btn btn-info btn-raised btn-sm">
								<i class="zmdi zmdi-floppy"></i> Guardar Mascota
							</button>
							<a href="lista_mascotas.php" class="btn btn-default btn-raised btn-sm">
								<i class="zmdi zmdi-list"></i> Ver Lista
							</a>
						</p>

					</form>
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

		// Vista previa de la imagen seleccionada
		document.getElementById('imagen').addEventListener('change', function () {
			var file = this.files[0];
			if (file) {
				var reader = new FileReader();
				reader.onload = function (e) {
					document.getElementById('preview-img').src = e.target.result;
					document.getElementById('preview-box').style.display = 'block';
				};
				reader.readAsDataURL(file);
			}
		});
	</script>
</body>
</html>
