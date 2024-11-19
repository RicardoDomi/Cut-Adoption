<?php
// Iniciar la sesión
session_start(); // Iniciar la sesión

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['admin_id'])) {
    // Si no ha iniciado sesión, redirigir al login
    header("Location: index.html");
    exit(); // Detener la ejecución del script
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
	<title>Registro</title>
	<meta charset="UTF-8">
	<meta name="viewport"
		content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="./css/main.css">
</head>

<body>
	<!-- SideBar -->
	<section class="full-box cover dashboard-sideBar">
		<div class="full-box dashboard-sideBar-bg btn-menu-dashboard"></div>
		<div class="full-box dashboard-sideBar-ct">
			<!--SideBar Title -->
			<div class="full-box text-uppercase text-center text-titles dashboard-sideBar-title">
				Adopta cut <i class="zmdi zmdi-close btn-menu-dashboard visible-xs"></i>
			</div>
			<!-- SideBar User info -->
			<div class="full-box dashboard-sideBar-UserInfo">
				<figure class="full-box">
					<img src="./assets/img/avatar.jpg" alt="UserIcon">
					<figcaption class="text-center text-titles">User Name</figcaption>
				</figure>
				<ul class="full-box list-unstyled text-center">
					<li>
						<a href="#!">
							<i class="zmdi zmdi-settings"></i>
						</a>
					</li>
					<li>
						<a href="#!" class="btn-exit-system">
							<i class="zmdi zmdi-power"></i>
						</a>
					</li>
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
					<!-- <a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-case zmdi-hc-fw"></i> Administracion <i
							class="zmdi zmdi-caret-down pull-right"></i>
					</a> -->
					<ul class="list-unstyled full-box">
						<li>
							<a href="period.html"><i class="zmdi zmdi-timer zmdi-hc-fw"></i> Period</a>
						</li>
						<li>
							<a href="subject.html"><i class="zmdi zmdi-book zmdi-hc-fw"></i> Subject</a>
						</li>
						<li>
							<a href="section.php"><i class="zmdi zmdi-graduation-cap zmdi-hc-fw"></i> Section</a>
						</li>
						<li>
							<a href="salon.html"><i class="zmdi zmdi-font zmdi-hc-fw"></i> Salon</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-account-add zmdi-hc-fw"></i> Usuarios <i
							class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="admin.php"><i class="zmdi zmdi-account zmdi-hc-fw"></i> Admin</a>
						</li>
						<li>
							<a href="adoptante.php"><i class="zmdi zmdi-male-alt zmdi-hc-fw"></i> Adoptante</a>
						</li>
						<!-- <li>
							<a href="student.html"><i class="zmdi zmdi-face zmdi-hc-fw"></i> Student</a>
						</li>
						<li>
							<a href="representative.html"><i class="zmdi zmdi-male-female zmdi-hc-fw"></i>
								Representative</a>
						</li> -->
					</ul>
				</li>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-card zmdi-hc-fw"></i> Adopcion <i
							class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="registro.php"><i class="zmdi zmdi-money-box  zmdi-hc-fw"></i> Registro</a>
						</li>
						<!-- <li>
							<a href="Adopcion.html"><i class="zmdi zmdi-money zmdi-hc-fw"></i> Adopcion</a>
						</li> -->
					</ul>
				</li>
			</ul>
		</div>
	</section>

	<!-- Content page-->
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
				<li>
					<a href="#!" class="btn-search">
						<i class="zmdi zmdi-search"></i>
					</a>
				</li>
				<li>
					<a href="#!" class="btn-modal-help">
						<i class="zmdi zmdi-help-outline"></i>
					</a>
				</li>
			</ul>
		</nav>
		<!-- Content page -->
		<div class="container-fluid">
			<div class="page-header">
				<h1 class="text-titles"><i class="zmdi zmdi-money-box zmdi-hc-fw"></i> Adopcion <small>Registro</small>
				</h1>
			</div>
			<p class="lead">Esta pagina sirve para registrar mascotas en la base de datos ademas de permitir administrar
				los existentes.
			</p>
		</div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12">
					<ul class="nav nav-tabs" style="margin-bottom: 15px;">
						<li class="active"><a href="#new" data-toggle="tab">Nuevo</a></li>
						<li><a href="#list" data-toggle="tab">Lista</a></li>
					</ul>
					<div id="myTabContent" class="tab-content">
						<div class="tab-pane fade active in" id="new">
							<!-- <div class="container-fluid">
								<div class="row">
									<div class="col-xs-12 col-md-10 col-md-offset-1">
									    <form action="">
									    	<div class="form-group label-floating">
											  <label class="control-label">Payment</label>
											  <input class="form-control" type="text">
											</div>
											<div class="form-group label-floating">
											  <label class="control-label">Amount</label>
											  <input class="form-control" type="text">
											</div>
											<div class="form-group label-floating">
											  <label class="control-label">Student Code</label>
											  <textarea class="form-control"></textarea>
											</div>
											<div class="form-group">
										        <label class="control-label">Section</label>
										        <select class="form-control">
										          <option>1 grade</option>
										          <option>2 grade</option>
										          <option>3 grade</option>
										          <option>4 grade</option>
										          <option>5 grade</option>
										        </select>
										    </div>
											<div class="form-group">
										        <label class="control-label">Year</label>
										        <select class="form-control">
										          <option>2017</option>
										          <option>2016</option>
										          <option>2015</option>
										          <option>2014</option>
										          <option>2013</option>
										        </select>
										    </div>
										    <p class="text-center">
										    	<button href="#!" class="btn btn-info btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> Save</button>
										    </p>
									    </form>
									</div>
								</div>
							</div> -->
							<form action="php/registro.php" method="POST" enctype="multipart/form-data">
								<div class="form-group">
									<label for="nombre">Nombre del Perro:</label>
									<input type="text" class="form-control" id="Nombre" name="Nombre" required>
								</div>

								<div class="form-group">
									<label for="edad">Edad:</label>
									<input type="number" class="form-control" id="Edad" name="Edad" required>
								</div>

								<div class="form-group">
									<label for="raza">Raza:</label>
									<input type="text" class="form-control" id="Raza" name="Raza">
								</div>

								<div class="form-group">
									<label for="sexo">Sexo:</label>
									<select class="form-control" id="Sexo" name="Sexo" required>
										<option value="Macho">Macho</option>
										<option value="Hembra">Hembra</option>
									</select>
								</div>

								<div class="form-group">
									<label for="Descripcion">Descripción:</label>
									<textarea class="form-control" id="Descripcion" name="Descripcion"
										rows="4"></textarea>
								</div>

								<!-- <div class="form-group">
									<label for="imagen">Imagen del Perro:</label>
									<input type="file" class="form-control-file" id="imagen" name="imagen">
								</div> -->
								<div class="form-group">
									<label class="control-label">Imagen del Perro:</label>
									<div>
									  <input type="text" readonly="" class="form-control" placeholder="Browse...">
									  <input type="file" class="form-control-file" id="imagen" name="Imagen" >
									</div>
								  </div>

								<div class="form-group">
									<label for="fecha_ingreso">Fecha de Ingreso:</label>
									<input type="date" class="form-control" id="FechaIngreso" name="FechaIngreso"
										required>
								</div>

								<p class="text-center">
									<button type="submit" class="btn btn-info btn-raised btn-sm">
										<i class="zmdi zmdi-floppy"></i> Registrar Perro
									</button>
								</p>
							</form>

						</div>
						<div class="tab-pane fade" id="list">
							<!-- <div class="table-responsive">
								<table class="table table-hover text-center">
									<thead>
										<tr>
											<th class="text-center">#</th>
											<th class="text-center">Payment</th>
											<th class="text-center">Amount</th>
											<th class="text-center">Pending</th>
											<th class="text-center">Student</th>
											<th class="text-center">Section</th>
											<th class="text-center">Year</th>
											<th class="text-center">Update</th>
											<th class="text-center">Delete</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>1</td>
											<td>$70</td>
											<td>$40</td>
											<td>$30</td>
											<td>Carlos Alfaro</td>
											<td>Section</td>
											<td>2017</td>
											<td><a href="#!" class="btn btn-success btn-raised btn-xs"><i
														class="zmdi zmdi-refresh"></i></a></td>
											<td><a href="#!" class="btn btn-danger btn-raised btn-xs"><i
														class="zmdi zmdi-delete"></i></a></td>
										</tr>
										<tr>
											<td>2</td>
											<td>$70</td>
											<td>$70</td>
											<td>$0</td>
											<td>Claudia Rodriguez</td>
											<td>Section</td>
											<td>2017</td>
											<td><a href="#!" class="btn btn-success btn-raised btn-xs"><i
														class="zmdi zmdi-refresh"></i></a></td>
											<td><a href="#!" class="btn btn-danger btn-raised btn-xs"><i
														class="zmdi zmdi-delete"></i></a></td>
										</tr>
										<tr>
											<td>3</td>
											<td>$70</td>
											<td>$70</td>
											<td>$0</td>
											<td>Alicia Melendez</td>
											<td>Section</td>
											<td>2017</td>
											<td><a href="#!" class="btn btn-success btn-raised btn-xs"><i
														class="zmdi zmdi-refresh"></i></a></td>
											<td><a href="#!" class="btn btn-danger btn-raised btn-xs"><i
														class="zmdi zmdi-delete"></i></a></td>
										</tr>
										<tr>
											<td>4</td>
											<td>$70</td>
											<td>$70</td>
											<td>$0</td>
											<td>Alba Bonilla</td>
											<td>Section</td>
											<td>2017</td>
											<td><a href="#!" class="btn btn-success btn-raised btn-xs"><i
														class="zmdi zmdi-refresh"></i></a></td>
											<td><a href="#!" class="btn btn-danger btn-raised btn-xs"><i
														class="zmdi zmdi-delete"></i></a></td>
										</tr>
									</tbody>
								</table>
								<ul class="pagination pagination-sm">
									<li class="disabled"><a href="#!">«</a></li>
									<li class="active"><a href="#!">1</a></li>
									<li><a href="#!">2</a></li>
									<li><a href="#!">3</a></li>
									<li><a href="#!">4</a></li>
									<li><a href="#!">5</a></li>
									<li><a href="#!">»</a></li>
								</ul>
							</div> -->
							<div class="table-responsive">
								<table class="table table-hover text-center">
									<thead>
										<tr>
											<th class="text-center">#</th>
											<th class="text-center">Nombre</th>
											<th class="text-center">Edad</th>
											<th class="text-center">Raza</th>
											<th class="text-center">Sexo</th>
											<th class="text-center">Descripción</th>
											<th class="text-center">Imagen</th>
											<th class="text-center">Fecha de Ingreso</th>
											<th class="text-center">Actualizar</th>
											<th class="text-center">Eliminar</th>
										</tr>
									</thead>
									<tbody>
										<!-- Ejemplo de perro 1 -->
										<tr>
											<td>1</td>
											<td>Max</td>
											<td>3</td>
											<td>Labrador</td>
											<td>Macho</td>
											<td>Activo y juguetón</td>
											<td><img src="ruta/a/imagen1.jpg" alt="Imagen de Max" width="50" height="50"></td>
											<td>2024-11-16</td>
											<td>
												<a href="#!" class="btn btn-success btn-raised btn-xs">
													<i class="zmdi zmdi-refresh"></i>
												</a>
											</td>
											<td>
												<a href="#!" class="btn btn-danger btn-raised btn-xs">
													<i class="zmdi zmdi-delete"></i>
												</a>
											</td>
										</tr>
										<!-- Ejemplo de perro 2 -->
										<tr>
											<td>2</td>
											<td>Rex</td>
											<td>5</td>
											<td>Pastor Alemán</td>
											<td>Hembra</td>
											<td>Amistosa con los niños</td>
											<td><img src="ruta/a/imagen2.jpg" alt="Imagen de Rex" width="50" height="50"></td>
											<td>2023-08-15</td>
											<td>
												<a href="#!" class="btn btn-success btn-raised btn-xs">
													<i class="zmdi zmdi-refresh"></i>
												</a>
											</td>
											<td>
												<a href="#!" class="btn btn-danger btn-raised btn-xs">
													<i class="zmdi zmdi-delete"></i>
												</a>
											</td>
										</tr>
										<!-- Ejemplo de perro 3 -->
										<tr>
											<td>3</td>
											<td>Bolita</td>
											<td>2</td>
											<td>Chihuahua</td>
											<td>Macho</td>
											<td>Muy cariñoso</td>
											<td><img src="ruta/a/imagen3.jpg" alt="Imagen de Bolita" width="50" height="50"></td>
											<td>2024-01-22</td>
											<td>
												<a href="#!" class="btn btn-success btn-raised btn-xs">
													<i class="zmdi zmdi-refresh"></i>
												</a>
											</td>
											<td>
												<a href="#!" class="btn btn-danger btn-raised btn-xs">
													<i class="zmdi zmdi-delete"></i>
												</a>
											</td>
										</tr>
										<!-- Ejemplo de perro 4 -->
										<tr>
											<td>4</td>
											<td>Simba</td>
											<td>4</td>
											<td>Golden Retriever</td>
											<td>Hembra</td>
											<td>Le gusta nadar</td>
											<td><img src="ruta/a/imagen4.jpg" alt="Imagen de Simba" width="50" height="50"></td>
											<td>2023-12-10</td>
											<td>
												<a href="#!" class="btn btn-success btn-raised btn-xs">
													<i class="zmdi zmdi-refresh"></i>
												</a>
											</td>
											<td>
												<a href="#!" class="btn btn-danger btn-raised btn-xs">
													<i class="zmdi zmdi-delete"></i>
												</a>
											</td>
										</tr>
									</tbody>
								</table>
								<ul class="pagination pagination-sm">
									<li class="disabled"><a href="#!">«</a></li>
									<li class="active"><a href="#!">1</a></li>
									<li><a href="#!">2</a></li>
									<li><a href="#!">3</a></li>
									<li><a href="#!">4</a></li>
									<li><a href="#!">5</a></li>
									<li><a href="#!">»</a></li>
								</ul>
							</div>
							
						</div>
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
			<div class="list-group">
				<div class="list-group-item">
					<div class="row-action-primary">
						<i class="zmdi zmdi-alert-triangle"></i>
					</div>
					<div class="row-content">
						<div class="least-content">17m</div>
						<h4 class="list-group-item-heading">Tile with a label</h4>
						<p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus.</p>
					</div>
				</div>
				<div class="list-group-separator"></div>
				<div class="list-group-item">
					<div class="row-action-primary">
						<i class="zmdi zmdi-alert-octagon"></i>
					</div>
					<div class="row-content">
						<div class="least-content">15m</div>
						<h4 class="list-group-item-heading">Tile with a label</h4>
						<p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus.</p>
					</div>
				</div>
				<div class="list-group-separator"></div>
				<div class="list-group-item">
					<div class="row-action-primary">
						<i class="zmdi zmdi-help"></i>
					</div>
					<div class="row-content">
						<div class="least-content">10m</div>
						<h4 class="list-group-item-heading">Tile with a label</h4>
						<p class="list-group-item-text">Maecenas sed diam eget risus varius blandit.</p>
					</div>
				</div>
				<div class="list-group-separator"></div>
				<div class="list-group-item">
					<div class="row-action-primary">
						<i class="zmdi zmdi-info"></i>
					</div>
					<div class="row-content">
						<div class="least-content">8m</div>
						<h4 class="list-group-item-heading">Tile with a label</h4>
						<p class="list-group-item-text">Maecenas sed diam eget risus varius blandit.</p>
					</div>
				</div>
			</div>

		</div>
	</section>

	<!-- Dialog help -->
	<div class="modal fade" tabindex="-1" role="dialog" id="Dialog-Help">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
							aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Ayuda</h4>
				</div>
				<div class="modal-body">
					<p>
						Este dashboard funciona para proporcionar control sobre la pagina web
					</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary btn-raised" data-dismiss="modal"><i
							class="zmdi zmdi-thumb-up"></i> Ok</button>
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
	</script>
</body>
</html>