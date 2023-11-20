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
			Blank page.
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