<?php
	require_once("../../config/conexion.php");
	if(isset($_SESSION["usuid"])){
?>

<!DOCTYPE html>
<html>
    <?php require_once("../MainHead/header.php"); ?>
	<title>HelpDesk</> - Perfil</title>
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
							<h3>Perfil</h3>
							<ol class="breadcrumb breadcrumb-simple">
								<li><a href="../Home/index.php">Home</a></li>
								<li class="active">Cambio de Contraseña</li>
							</ol>
						</div>
					</div>
				</div>
			</header>

			<div class="box-typical box-typical-padding">
				<div class="row">
					    <div class="col-lg-6">
							<fieldset class="form-group">
								<label class="form-label semibold" for="exampleInput">Nueva Contraseña</label>
								<input type="password" class="form-control" name="txtpass" id="txtpass" placeholder="Ingresa tu nueva contraseña">
							</fieldset>
					    </div>

						<div class="col-lg-6">
							<fieldset class="form-group">
								<label class="form-label semibold" for="exampleInput">Confirmar Contraselña</label>
                                <input type="password" class="form-control" name="txtpassnew" id="txtpassnew" placeholder="Confirma tu nueva contraseña">
                            </fieldset>
						</div>
						
						<div class="col-lg-12">
							<button type="button" id="btnactualizar" class="btn btn-rounded btn-inline btn-primary">Actualizar</button>
						</div>
				</div>
			</div>
		</div>
	</div>

	<?php require_once("../MainJs/js.php"); ?>

	<script src="../MntPerfil/mntperfil.js"></script>
</body>
</html>

<?php
	}else{
		header("Location:".Conectar::ruta()."index.php");
	}
?>