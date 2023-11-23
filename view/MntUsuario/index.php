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
				<table id="ticket_data" class="table table-bordered table-striped table-vcenter js-dataTable-full">
					<thead>
						<tr>
							<th style="width: 5%;">Nro.Ticket</th>
							<th style="width: 15%;">Categoría</th>
							<th class="d-none d-sm-table-cell" style="width: 40%;">Título</th>
							<th class="d-none d-sm-table-cell" style="width: 5%;">Estado</th>
							<th class="d-none d-sm-table-cell" style="width: 10%;">Fecha Creación</th>
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

	<?php require_once("../MainJs/js.php"); ?>

	<script src="../../view/MntUsuario/mntusuario.js"></script>
</body>
</html>

<?php
	}else{
		header("Location:".Conectar::ruta()."index.php");
	}
?>