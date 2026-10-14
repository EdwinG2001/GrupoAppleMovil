<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="row mb-3">
    <div class="col">
        <h3 class="fw-bold"><i class="bi bi-person-badge me-2"></i>Gestión de Sexo</h3>
    </div>
    <div class="col-auto">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalSexo" onclick="limpiarFormulario()">
            <i class="bi bi-plus-lg me-1"></i>Nuevo Sexo
        </button>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th width="80">ID</th>
                    <th>Nombre</th>
                    <th width="150" class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($sexos)): ?>
                    <?php foreach ($sexos as $s): ?>
                    <tr>
                        <td><?= $s['idsexo'] ?></td>
                        <td><?= esc($s['nombre']) ?></td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-warning me-1" onclick="editar(<?= $s['idsexo'] ?>, '<?= esc($s['nombre']) ?>')">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <a href="/sexo/eliminar/<?= $s['idsexo'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Está seguro de eliminar este sexo?')">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="3" class="text-center text-muted py-4">No hay registros de sexo</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Crear/Editar -->
<div class="modal fade" id="modalSexo" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formSexo" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle"><i class="bi bi-plus-lg me-2"></i>Nuevo Sexo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="idsexo" id="idsexo">
                    <div class="mb-3">
                        <label for="nombre" class="form-label fw-semibold">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required maxlength="50" placeholder="Ingrese el nombre">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
function limpiarFormulario() {
    document.getElementById('formSexo').action = '/sexo/crear';
    document.getElementById('modalTitle').innerHTML = '<i class="bi bi-plus-lg me-2"></i>Nuevo Sexo';
    document.getElementById('idsexo').value = '';
    document.getElementById('nombre').value = '';
}

function editar(id, nombre) {
    document.getElementById('formSexo').action = '/sexo/actualizar/' + id;
    document.getElementById('modalTitle').innerHTML = '<i class="bi bi-pencil me-2"></i>Editar Sexo';
    document.getElementById('idsexo').value = id;
    document.getElementById('nombre').value = nombre;
    new bootstrap.Modal(document.getElementById('modalSexo')).show();
}
</script>
<?= $this->endSection() ?>
