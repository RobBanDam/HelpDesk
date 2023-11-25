<?php
	require_once("../../config/conexion.php");
	if(isset($_SESSION["usuid"])){
?>

<!DOCTYPE html>
<html>
    <?php require_once("../MainHead/header.php"); ?>
	<title>HelpDesk</> - Home</title>
</head>
<body class="with-side-menu">

	<?php require_once("../MainHeader/header.php") ;?>

	<div class="mobile-menu-left-overlay"></div>
	<?php require_once("../MainNav/mainnav.php") ;?>

	<!-- Contenido -->
	<div class="page-content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xl-12">
					<div class="row">
						<div class="col-sm-4">
							<article class="statistic-box green">
								<div>
									<div class="number" id="lbltotal"></div>
									<div class="caption"><div>Total de Tickets</div></div>
								</div>
							</article>
						</div>
						<div class="col-sm-4">
							<article class="statistic-box yellow">
								<div>
									<div class="number" id="lbltotalAbiertos"></div>
									<div class="caption"><div>Total de Tickets Abiertos</div></div>
								</div>
							</article>
						</div>
						<div class="col-sm-4">
							<article class="statistic-box red">
								<div>
									<div class="number" id="lbltotalCerrados"></div>
									<div class="caption"><div>Total de Tickets Cerrados</div></div>
								</div>
							</article>
						</div>						
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php require_once("../MainJs/js.php"); ?>

	<script src="../Home/home.js"></script>
</body>
</html>

<?php
	}else{
		header("Location:".Conectar::ruta()."index.php");
	}
?>