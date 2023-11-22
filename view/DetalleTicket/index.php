<?php
    require_once("../../config/conexion.php");
    if (isset($_SESSION["usuid"])) {
?>

    <!DOCTYPE html>
    <html>
        <?php require_once("../MainHead/header.php"); ?>
        <title>HelpDesk</> - Detalles Tickets</title>
    </head>

    <body class="with-side-menu">

        <?php require_once("../MainHeader/header.php"); ?>
        <div class="mobile-menu-left-overlay"></div>
        <?php require_once("../MainNav/mainnav.php"); ?>

        <!-- Contenido -->
        <div class="page-content">
            <div class="container-fluid">
                <header class="section-header">
                    <div class="tbl">
                        <div class="tbl-row">
                            <div class="tbl-cell">
                                <h3>Detalle Ticket - 1</h3>
                                <span class="label label-pill label-danger">Cerrado</span>
                                <span class="label label-pill label-primary">Nombre del Usuario</span>
                                <span class="label label-pill label-default">99/99/9999</span>
                                <ol class="breadcrumb breadcrumb-simple">
                                    <li><a href="../Home/index.php">Home</a></li>
                                    <li class="active">Detalle Ticket</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </header>

                <div class="box-typical box-typical-padding">
                    <div class="row">
                        <div class="col-lg-6">
                            <fieldset class="form-group">
                                <label class="form-label semibold" for="catnom">Categoría</label>
                                <input type="text" class="form-control" id="catnom" name="catnom" readonly>
                            </fieldset>
                        </div>
                        <div class="col-lg-6">
                            <fieldset class="form-group">
                                <label class="form-label semibold" for="ticktitulo">Título</label>
                                <input type="text" class="form-control" id="ticktitulo" name="ticktitulo" readonly>
                            </fieldset>
                        </div>
                        <div class="col-lg-12">
                            <fieldset class="form-group">
                                <label class="form-label semibold" for="tickdesc">Descripción</label>
                                <input type="text" class="form-control" id="tickdesc" name="tickdesc">
                            </fieldset>
                        </div>
                    </div>
                </div>

                <section class="activity-line" id="lbldetalle">
                </section><!--.activity-line-->

                <div class="box-typical box-typical-padding">
                    <p>Por favor, ingrese su comentario:</p>
                    <div class="row">
                        <div class="col-lg-12">
                            <fieldset class="form-group">
                                <label class="form-label semibold" for="tickid_desc">Descripción</label>
                                <div class="summernote-theme-1">
                                    <textarea id="tickid_desc" class="summernote" name="tickid_desc"></textarea>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" name="action" value="add" class="btn btn-rounded btn-inline btn-primary">Enviar</button>
                            <button type="submit" name="action" value="add" class="btn btn-rounded btn-inline btn-danger">Cerrar Ticket</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contenido -->

        <?php require_once("../MainJs/js.php"); ?>

        <script src="../DetalleTicket/detalleticket.js"></script>
    </body>

    </html>

<?php
} else {
    header("Location:" . Conectar::ruta() . "index.php");
}
?>