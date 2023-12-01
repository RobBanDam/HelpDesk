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
                                <h3 id="lblnomidtick"></h3>
                                <span id="lblestado"></span>
                                <span class="label label-pill label-primary" id="lblnomusuario"></span>
                                <span class="label label-pill label-default" id="lblfechcrea"></span>
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
                        <div class="col-lg-12">
                            <fieldset class="form-group">
                                <label class="form-label semibold" for="ticktitulo">Título</label>
                                <input type="text" class="form-control" id="ticktitulo" name="ticktitulo" readonly>
                            </fieldset>
                        </div>

                        <div class="col-lg-6">
                            <fieldset class="form-group">
                                <label class="form-label semibold" for="catnom">Categoría</label>
                                <input type="text" class="form-control" id="catnom" name="catnom" readonly>
                            </fieldset>
                        </div>
                        <div class="col-lg-6">
                            <fieldset class="form-group">
                                <label class="form-label semibold" for="catnom">SubCategoría</label>
                                <input type="text" class="form-control" id="cats_nom" name="cats_nom" readonly>
                            </fieldset>
                        </div>
                        
                        <div class="col-lg-12">
                            <fieldset class="form-group">
                                <label class="form-label semibold" for="ticktitulo">Documentos Adicionales</label>
                                <table id="documentos_data" class="table table-bordered table-striped table-vcenter js-dataTable-full">
                                    <thead>
                                        <tr>
                                            <th style="width: 90%;">Nombre</th>
                                            <th class="text-center" style="width: 10%;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </fieldset>
                        </div>
                        <div class="col-lg-12">
                            <fieldset class="form-group">
                                <label class="form-label semibold" for="tickid_descusu">Descripción</label>
                                <div class="summernote-theme-1">
                                    <textarea id="tickid_descusu" class="summernote" name="tickid_descusu"></textarea>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>

                <section class="activity-line" id="lbldetalle">
                </section><!--.activity-line-->

                <div class="box-typical box-typical-padding" id="pnldetalle">
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
                            <button type="button" id="btnenviar" class="btn btn-rounded btn-inline btn-primary">Enviar</button>
                            <button type="button" id="btncerrar" class="btn btn-rounded btn-inline btn-danger">Cerrar Ticket</button>
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