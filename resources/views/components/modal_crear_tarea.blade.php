<div class="modal fade" id="modalCrearTarea" role="dialog" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog">
        <form class="modal-content" id="formCrearTarea">
            <div class="modal-header">
                <h5 class="modal-title">Crear tarea</h5>
                <button class="close" data-dismiss="modal" type="button" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input id="proyecto_id" name="id" type="hidden">
                <div class="mb-3">
                    <label class="form-label" for="inicio_tarea">Fecha de inicio</label>
                    <input class="form-control" id="inicio_tarea" name="inicio" type="datetime-local" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="fin_tarea">Fecha de fin</label>
                    <input class="form-control" id="fin_tarea" name="fin" type="datetime-local" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="descripcion_tarea">Descripción</label>
                    <textarea class="form-control" id="descripcion_tarea" name="descripcion"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="submit">Guardar</button>
            </div>
        </form>
    </div>
</div>
