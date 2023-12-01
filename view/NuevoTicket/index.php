<?php
	require_once("../../config/conexion.php");
	if(isset($_SESSION["usuid"])){
?>

<!DOCTYPE html>
<html>
    <?php require_once("../MainHead/header.php"); ?>
	<title>HelpDesk</> - NuevoTicket</title>
</head>
<body class="with-side-menu">

	<?php require_once("../MainHeader/header.php") ;?>

	<div class="mobile-menu-left-overlay"></div>
	<?php require_once("../MainNav/mainnav.php") ;?>

	<div class="page-content">
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3>Nuevo Ticket</h3>
							<ol class="breadcrumb breadcrumb-simple">
								<li><a href="../Home/index.php">Home</a></li>
								<li class="active">Nuevo Ticket</li>
							</ol>
						</div>
					</div>
				</div>
			</header>

			<div class="box-typical box-typical-padding">
				<p> Desde esta ventana podrá generar los tickets para la pronta atención.</p>

				<p>Por favor ingrese los datos: </p>

				<div class="row">
					<form method="post" id="ticket_form">

						<input type="hidden" id="usuid" name="usuid" value="<?php echo $_SESSION["usuid"]?>">

						<div class="col-lg-12">
							<fieldset class="form-group">
								<label class="form-label semibold" for="ticktitulo">Título</label>
								<input type="text" class="form-control" id="ticktitulo" name="ticktitulo" placeholder="Ingresa el título">
							</fieldset>
						</div>
						<div class="col-lg-4">
							<fieldset class="form-group">
								<label class="form-label semibold" for="catid">Categoría</label>
								<select id="catid" name="catid" class="form-control" data-placeholder="Seleccionar">
								</select>
							</fieldset>
						</div>
						<div class="col-lg-4">
							<fieldset class="form-group">
								<label class="form-label semibold" for="catid">SubCategoría</label>
								<select id="cats_id" name="cats_id" class="form-control" data-placeholder="Seleccionar">
									<option label="Seleccionar"></option>
								</select>
							</fieldset>
						</div>

						<div class="col-lg-4">
							<fieldset class="form-group">
								<label class="form-label semibold" for="exampleInput">Documentos Adicionales</label>
								<input type="file" name="fileElem" id="fileElem" class="form-control" multiple>
							</fieldset>
						</div>
						
						<div class="col-lg-12">
							<fieldset class="form-group">
								<label class="form-label semibold" for="tickdesc">Descripción</label>
								<div class="summernote-theme-1">
									<textarea id="tickdesc" class="summernote" name="tickdesc"></textarea>
								</div>
							</fieldset>
						</div>
						<div class="col-lg-12">
							<button type="submit" name="action" value="add" class="btn btn-rounded btn-inline btn-primary">Guardar</button>
						</div>
					</form>
				</div>

			</div>
		</div>
	</div>

	<?php require_once("../MainJs/js.php"); ?>

	<script src="../NuevoTicket/nuevoticket.js"></script>
</body>
</html>

<?php
	}else{
		header("Location:".Conectar::ruta()."index.php");
	}
?>