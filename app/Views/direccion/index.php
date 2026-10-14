<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="row mb-3">
    <div class="col">
        <h3 class="fw-bold"><i class="bi bi-geo-alt me-2"></i>Gestión de Direcciones</h3>
    </div>
    <div class="col-auto">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalDireccion" onclick="limpiarFormulario()">
            <i class="bi bi-plus-lg me-1"></i>Nueva Dirección
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
                        <th>Dirección</th>
                        <th>Ciudad</th>
                        <th>Referencia</th>
                        <th width="150" class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($direcciones)): ?>
                        <?php foreach ($direcciones as $d): ?>
                        <tr>
                            <td><?= $d['iddireccion'] ?></td>
                            <td><?= esc($d['persona_nombre'] ?? 'ID: ' . $d['idpersona']) ?></td>
                            <td><?= esc($d['direccion']) ?></td>
                            <td><span class="badge bg-info"><?= esc($d['ciudad']) ?></span></td>
                            <td><?= esc($d['referencia'] ?? '-') ?></td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-warning me-1" onclick="editar(<?= $d['iddireccion'] ?>, <?= $d['idpersona'] ?>, '<?= esc($d['direccion']) ?>', '<?= esc($d['ciudad']) ?>', '<?= esc($d['referencia'] ?? '') ?>')">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <a href="/direccion/eliminar/<?= $d['iddireccion'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar esta dirección?')">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="6" class="text-center text-muted py-4">No hay direcciones registradas</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Crear/Editar -->
<div class="modal fade" id="modalDireccion" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="formDireccion" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle"><i class="bi bi-plus-lg me-2"></i>Nueva Dirección</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="iddireccion" id="iddireccion">
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
                        <label for="direccion" class="form-label fw-semibold">Dirección</label>
                        <input type="text" class="form-control" id="direccion" name="direccion" required maxlength="255" placeholder="Ingrese la dirección">
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="ciudad" class="form-label fw-semibold">Ciudad</label>
                            <input type="text" class="form-control" id="ciudad" name="ciudad" required maxlength="100" placeholder="Ciudad">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="referencia" class="form-label fw-semibold">Referencia</label>
                            <input type="text" class="form-control" id="referencia" name="referencia" maxlength="255" placeholder="Referencia (opcional)">
                        </div>
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
    document.getElementById('formDireccion').action = '/direccion/crear';
    document.getElementById('modalTitle').innerHTML = '<i class="bi bi-plus-lg me-2"></i>Nueva Dirección';
    document.getElementById('iddireccion').value = '';
    document.getElementById('idpersona_select').value = '';
    document.getElementById('direccion').value = '';
    document.getElementById('ciudad').value = '';
    document.getElementById('referencia').value = '';
}

function editar(id, idpersona, direccion, ciudad, referencia) {
    document.getElementById('formDireccion').action = '/direccion/actualizar/' + id;
    document.getElementById('modalTitle').innerHTML = '<i class="bi bi-pencil me-2"></i>Editar Dirección';
    document.getElementById('iddireccion').value = id;
    document.getElementById('idpersona_select').value = idpersona;
    document.getElementById('direccion').value = direccion;
    document.getElementById('ciudad').value = ciudad;
    document.getElementById('referencia').value = referencia;
    new bootstrap.Modal(document.getElementById('modalDireccion')).show();
}
</script>
<?= $this->endSection() ?>
