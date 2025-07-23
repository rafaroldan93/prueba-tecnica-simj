<div class="modal fade" id="modalUsuario" role="dialog" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog">
        <form class="modal-content" id="formUsuario">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitulo">Crear usuario</h5>
                <button class="close" data-dismiss="modal" type="button" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input id="usuarioId" name="id" type="hidden">
                <div class="form-group">
                    <label>Nombre</label>
                    <input class="form-control" id="name" name="name" type="text" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" id="email" name="email" type="email" required>
                </div>
                <div class="form-group">
                    <label>Contraseña</label>
                    <input class="form-control" id="password" name="password" type="password">
                </div>
                <div class="form-check">
                    <input class="form-check-input" id="is_admin" name="is_admin" type="checkbox">
                    <label class="form-check-label" for="is_admin">Administrador</label>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="submit">Guardar</button>
                <button class="btn btn-secondary" data-dismiss="modal" type="button">Cancelar</button>
            </div>
        </form>
    </div>
</div>
