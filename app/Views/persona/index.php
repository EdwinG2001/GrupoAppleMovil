<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="row mb-3">
    <div class="col">
        <h3 class="fw-bold"><i class="bi bi-people me-2"></i>Gestión de Personas</h3>
    </div>
    <div class="col-auto">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalPersona" onclick="limpiarFormulario()">
            <i class="bi bi-plus-lg me-1"></i>Nueva Persona
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
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Fecha Nac.</th>
                        <th>Género</th>
                        <th>Sexo</th>
                        <th>Estado Civil</th>
                        <th width="150" class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($personas)): ?>
                        <?php foreach ($personas as $p): ?>
                        <tr>
                            <td><?= $p['idpersona'] ?></td>
                            <td><?= esc($p['nombres']) ?></td>
                            <td><?= esc($p['apellidos']) ?></td>
                            <td><?= $p['fecha_nacimiento'] ?></td>
                            <td><span class="badge bg-primary"><?= esc($p['genero'] ?? 'N/A') ?></span></td>
                            <td><span class="badge bg-success"><?= esc($p['sexo'] ?? 'N/A') ?></span></td>
                            <td><span class="badge bg-info"><?= esc($p['estado_civil'] ?? 'N/A') ?></span></td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-warning me-1" onclick="editar(<?= htmlspecialchars(json_encode($p), ENT_QUOTES, 'UTF-8') ?>)">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <a href="/persona/eliminar/<?= $p['idpersona'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar esta persona y todos sus datos asociados?')">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="8" class="text-center text-muted py-4">No hay personas registradas</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Crear/Editar -->
<div class="modal fade" id="modalPersona" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="formPersona" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle"><i class="bi bi-plus-lg me-2"></i>Nueva Persona</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="idpersona" id="idpersona">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nombres" class="form-label fw-semibold">Nombres</label>
                            <input type="text" class="form-control" id="nombres" name="nombres" required maxlength="100" placeholder="Nombres">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="apellidos" class="form-label fw-semibold">Apellidos</label>
                            <input type="text" class="form-control" id="apellidos" name="apellidos" required maxlength="100" placeholder="Apellidos">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="fecha_nacimiento" class="form-label fw-semibold">Fecha de Nacimiento</label>
                            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="idgenero" class="form-label fw-semibold">Género</label>
                            <select class="form-select" id="idgenero_select" name="idgenero">
                                <option value="">-- Seleccionar --</option>
                                <?php foreach ($generos as $g): ?>
                                    <option value="<?= $g['idgenero'] ?>"><?= esc($g['nombre']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="idsexo" class="form-label fw-semibold">Sexo</label>
                            <select class="form-select" id="idsexo_select" name="idsexo">
                                <option value="">-- Seleccionar --</option>
                                <?php foreach ($sexos as $s): ?>
                                    <option value="<?= $s['idsexo'] ?>"><?= esc($s['nombre']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="idestadocivil" class="form-label fw-semibold">Estado Civil</label>
                            <select class="form-select" id="idestadocivil_select" name="idestadocivil">
                                <option value="">-- Seleccionar --</option>
                                <?php foreach ($estadosciviles as $ec): ?>
                                    <option value="<?= $ec['idestadocivil'] ?>"><?= esc($ec['nombre']) ?></option>
                                <?php endforeach; ?>
                            </select>
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
    document.getElementById('formPersona').action = '/persona/crear';
    document.getElementById('modalTitle').innerHTML = '<i class="bi bi-plus-lg me-2"></i>Nueva Persona';
    document.getElementById('idpersona').value = '';
    document.getElementById('nombres').value = '';
    document.getElementById('apellidos').value = '';
    document.getElementById('fecha_nacimiento').value = '';
    document.getElementById('idgenero_select').value = '';
    document.getElementById('idsexo_select').value = '';
    document.getElementById('idestadocivil_select').value = '';
}

function editar(persona) {
    document.getElementById('formPersona').action = '/persona/actualizar/' + persona.idpersona;
    document.getElementById('modalTitle').innerHTML = '<i class="bi bi-pencil me-2"></i>Editar Persona';
    document.getElementById('idpersona').value = persona.idpersona;
    document.getElementById('nombres').value = persona.nombres;
    document.getElementById('apellidos').value = persona.apellidos;
    document.getElementById('fecha_nacimiento').value = persona.fecha_nacimiento;
    document.getElementById('idgenero_select').value = persona.idgenero || '';
    document.getElementById('idsexo_select').value = persona.idsexo || '';
    document.getElementById('idestadocivil_select').value = persona.idestadocivil || '';
    new bootstrap.Modal(document.getElementById('modalPersona')).show();
}
</script>
<?= $this->endSection() ?>
