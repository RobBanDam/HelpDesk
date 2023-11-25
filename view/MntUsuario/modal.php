<div id="modalnuevo" class="modal fade bd-example-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
                    <i class="font-icon-close-2"></i>
                </button>
                <h4 class="modal-title" id="mdltitulo"></h4>
            </div>
            <form id="usuario_form" method="post">
                <div class="modal-body">
                    <input type="hidden" id="usuid" name="usuid">
                    <fieldset class="form-group">
                        <label class="form-label" for="usunom">Nombre</label>
                        <input type="text" class="form-control" id="usunom" name="usunom" placeholder="Ingrese el Nombre:" required>
                    </fieldset>
                    <fieldset class="form-group">
                        <label class="form-label" for="usuape">Apellido</label>
                        <input type="text" class="form-control" id="usuape" name="usuape" placeholder="Ingrese el Apellido:" required>
                    </fieldset>
                    <fieldset class="form-group">
                        <label class="form-label" for="usucorreo">Correo electrónico</label>
                        <input type="email" class="form-control" id="usucorreo" name="usucorreo" placeholder="Ingrese el email:" required>
                    </fieldset>
                    <fieldset class="form-group">
                        <label class="form-label" for="usupass">Contraseña</label>
                        <input type="password" class="form-control" id="usupass" name="usupass" placeholder="*******:" required>
                    </fieldset>
                    <fieldset class="form-group">
                        <label class="form-label" for="rolid">Rol Agregado</label>
                        <select class="select2" id="rolid" name="rolid">
                            <option value="1">Usuario</option>
                            <option value="2">Soporte</option>
                        </select>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" name="action" id="#" value="add" class="btn btn-rounded btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div><!--.modal-->