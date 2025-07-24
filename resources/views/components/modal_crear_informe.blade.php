<div class="modal fade" id="modalCrearInforme" role="dialog" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog">
        <form class="modal-content" id="formCrearInforme">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitulo">Crear informe</h5>
                <button class="close" data-dismiss="modal" type="button" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label" for="selectProyecto">Seleccionar proyecto</label>
                    <select class="form-control" id="selectProyecto" name="proyecto_id">
                        <option value="">Todos los proyectos</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="selectUsuario">Seleccionar usuario</label>
                    <select class="form-control" id="selectUsuario" name="usuario_id">
                        <option value="">Todos los usuarios</option>
                        @foreach ($usuarios as $usuario)
                            <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="fecha_inicio_informe">Fecha de inicio</label>
                    <input class="form-control" id="fecha_inicio_informe" name="inicio" type="date">
                </div>

                <div class="mb-3">
                    <label class="form-label" for="fecha_fin_informe">Fecha de fin</label>
                    <input class="form-control" id="fecha_fin_informe" name="fin" type="date">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="submit">Generar PDF</button>
                <button class="btn btn-secondary" data-dismiss="modal" type="button">Cancelar</button>
            </div>
        </form>
    </div>
</div>
