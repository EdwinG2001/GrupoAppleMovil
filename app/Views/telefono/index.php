<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="row mb-3">
    <div class="col">
        <h3 class="fw-bold"><i class="bi bi-telephone me-2"></i>Gestión de Teléfonos</h3>
    </div>
    <div class="col-auto">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTelefono" onclick="limpiarFormulario()">
            <i class="bi bi-plus-lg me-1"></i>Nuevo Teléfono
        </button>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="60">ID</th>
                        <th>Persona</th>
                        <th>Teléfono</th>
                        <th>Tipo</th>
                        <th width="150" class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($telefonos)): ?>
                        <?php foreach ($telefonos as $t): ?>
                        <tr>
                            <td><?= $t['idtelefono'] ?></td>
                            <td><?= esc($t['persona_nombre'] ?? 'ID: ' . $t['idpersona']) ?></td>
                            <td><i class="bi bi-telephone me-1"></i><?= esc($t['telefono']) ?></td>
                            <td><span class="badge bg-secondary"><?= esc($t['tipo'] ?? 'N/A') ?></span></td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-warning me-1" onclick="editar(<?= $t['idtelefono'] ?>, <?= $t['idpersona'] ?>, '<?= esc($t['telefono']) ?>', '<?= esc($t['tipo'] ?? '') ?>')">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <a href="/telefono/eliminar/<?= $t['idtelefono'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este teléfono?')">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="5" class="text-center text-muted py-4">No hay teléfonos registrados</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Crear/Editar -->
<div class="modal fade" id="modalTelefono" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formTelefono" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle"><i class="bi bi-plus-lg me-2"></i>Nuevo Teléfono</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="idtelefono" id="idtelefono">
                    <div class="mb-3">
                        <label for="idpersona" class="form-label fw-semibold">Persona</label>
                        <select class="form-select" id="idpersona_select" name="idpersona" required>
                            <option value="">-- Seleccionar Persona --</option>
                            <?php foreach ($personas as $p): ?>
                                <option value="<?= $p['idpersona'] ?>"><?= esc($p['nombres'] . ' ' . $p['apellidos']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label fw-semibold">Teléfono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" required maxlength="20" placeholder="Ej: 0991234567">
                    </div>
                    <div class="mb-3">
                        <label for="tipo" class="form-label fw-semibold">Tipo</label>
                        <select class="form-select" id="tipo" name="tipo">
                            <option value="">-- Seleccionar --</option>
                            <option value="Personal">Personal</option>
                            <option value="Trabajo">Trabajo</option>
                            <option value="Casa">Casa</option>
                            <option value="Otro">Otro</option>
                        </select>
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
    document.getElementById('formTelefono').action = '/telefono/crear';
    document.getElementById('modalTitle').innerHTML = '<i class="bi bi-plus-lg me-2"></i>Nuevo Teléfono';
    document.getElementById('idtelefono').value = '';
    document.getElementById('idpersona_select').value = '';
    document.getElementById('telefono').value = '';
    document.getElementById('tipo').value = '';
}

function editar(id, idpersona, telefono, tipo) {
    document.getElementById('formTelefono').action = '/telefono/actualizar/' + id;
    document.getElementById('modalTitle').innerHTML = '<i class="bi bi-pencil me-2"></i>Editar Teléfono';
    document.getElementById('idtelefono').value = id;
    document.getElementById('idpersona_select').value = idpersona;
    document.getElementById('telefono').value = telefono;
    document.getElementById('tipo').value = tipo;
    new bootstrap.Modal(document.getElementById('modalTelefono')).show();
}
</script>
<?= $this->endSection() ?>
