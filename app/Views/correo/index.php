<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="row mb-3">
    <div class="col">
        <h3 class="fw-bold"><i class="bi bi-envelope me-2"></i>Gestión de Correos</h3>
    </div>
    <div class="col-auto">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCorreo" onclick="limpiarFormulario()">
            <i class="bi bi-plus-lg me-1"></i>Nuevo Correo
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
                        <th>Correo</th>
                        <th width="150" class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($correos)): ?>
                        <?php foreach ($correos as $c): ?>
                        <tr>
                            <td><?= $c['idcorreo'] ?></td>
                            <td><?= esc($c['persona_nombre'] ?? 'ID: ' . $c['idpersona']) ?></td>
                            <td><i class="bi bi-envelope me-1"></i><?= esc($c['correo']) ?></td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-warning me-1" onclick="editar(<?= $c['idcorreo'] ?>, <?= $c['idpersona'] ?>, '<?= esc($c['correo']) ?>')">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <a href="/correo/eliminar/<?= $c['idcorreo'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este correo?')">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="4" class="text-center text-muted py-4">No hay correos registrados</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Crear/Editar -->
<div class="modal fade" id="modalCorreo" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formCorreo" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle"><i class="bi bi-plus-lg me-2"></i>Nuevo Correo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="idcorreo" id="idcorreo">
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
                        <label for="correo" class="form-label fw-semibold">Correo Electrónico</label>
                        <input type="email" class="form-control" id="correo" name="correo" required maxlength="150" placeholder="ejemplo@correo.com">
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
    document.getElementById('formCorreo').action = '/correo/crear';
    document.getElementById('modalTitle').innerHTML = '<i class="bi bi-plus-lg me-2"></i>Nuevo Correo';
    document.getElementById('idcorreo').value = '';
    document.getElementById('idpersona_select').value = '';
    document.getElementById('correo').value = '';
}

function editar(id, idpersona, correo) {
    document.getElementById('formCorreo').action = '/correo/actualizar/' + id;
    document.getElementById('modalTitle').innerHTML = '<i class="bi bi-pencil me-2"></i>Editar Correo';
    document.getElementById('idcorreo').value = id;
    document.getElementById('idpersona_select').value = idpersona;
    document.getElementById('correo').value = correo;
    new bootstrap.Modal(document.getElementById('modalCorreo')).show();
}
</script>
<?= $this->endSection() ?>
