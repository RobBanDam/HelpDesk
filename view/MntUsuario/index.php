<?php
	require_once("../../config/conexion.php");
	if(isset($_SESSION["usuid"])){
?>

<!DOCTYPE html>
<html>
    <?php require_once("../MainHead/header.php"); ?>
	<title>HelpDesk</> - Mantenimiento Usuario</title>
</head>
<body class="with-side-menu">

	<?php require_once("../MainHeader/header.php") ;?>

	<div class="mobile-menu-left-overlay"></div>
	<?php require_once("../MainNav/mainnav.php") ;?>

	<!-- Contenido -->
	<div class="page-content">
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3>Mantenimiento Usuario</h3>
							<ol class="breadcrumb breadcrumb-simple">
								<li><a href="../Home/index.php">Home</a></li>
								<li class="active">Mantenimiento Usuario</li>
							</ol>
						</div>
					</div>
				</div>
			</header>
			
			<div class="box-typical box-typical-padding">
				<button type="button" id="btnnuevo" class="btn btn-inline btn-primary">Nuevo Usuario</button>

				<table id="usuario_data" class="table table-bordered table-striped table-vcenter js-dataTable-full">
					<thead>
						<tr>
							<th style="width: 15%;">Nombre</th>
							<th style="width: 15%;">Apellido</th>
							<th class="d-none d-sm-table-cell" style="width: 25%;">Correo</th>
							<th class="d-none d-sm-table-cell" style="width: 5%;">Contraseña</th>
							<th class="d-none d-sm-table-cell" style="width: 5%;">Rol</th>
							<th class="text-center" style="width: 5%;"></th>
							<th class="text-center" style="width: 5%;"></th>
						</tr>
					</thead>
					<tbody>

					</tbody>
				</table>
			</div>
		</div>
	</div>
	<!-- Contenido -->
	<?php require_once("../../view/MntUsuario/modal.php") ;?>

	<?php require_once("../MainJs/js.php"); ?>

	<script src="../../view/MntUsuario/mntusuario.js"></script>
</body>
</html>

<?php
	}else{
		header("Location:".Conectar::ruta()."index.php");
	}
?>