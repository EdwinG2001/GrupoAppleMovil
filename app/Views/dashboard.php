<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<style>
    /* Estilos específicos del Dashboard estilo image_4.png */
    
    /* 1. Banner de Bienvenida con Gradiente y Avatar */
    .welcome-banner {
        background: linear-gradient(135deg, #00b4d8 0%, #6366f1 55%, #8b5cf6 100%);
        border-radius: 26px;
        padding: 30px 36px;
        color: #ffffff;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 12px 30px rgba(99, 102, 241, 0.22);
        margin-bottom: 28px;
    }

    .welcome-banner::before {
        content: '';
        position: absolute;
        width: 220px;
        height: 220px;
        background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0) 70%);
        top: -60px;
        left: -40px;
        border-radius: 50%;
    }

    .welcome-text h2 {
        font-weight: 800;
        font-size: 1.85rem;
        letter-spacing: -0.5px;
        margin-bottom: 8px;
        text-transform: uppercase;
    }

    .welcome-text p {
        font-size: 0.92rem;
        opacity: 0.92;
        max-width: 520px;
        margin-bottom: 0;
        font-weight: 400;
        line-height: 1.5;
    }

    .welcome-avatar-box {
        width: 110px;
        height: 110px;
        background: rgba(255, 255, 255, 0.18);
        border: 3px solid rgba(255, 255, 255, 0.4);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }

    .welcome-avatar-box svg {
        width: 82px;
        height: 82px;
    }

    /* 2. Tarjetas tipo Medidor / Gauge (TEMPERATURE / TOTAL PERSONAS) */
    .gauge-card {
        text-align: center;
        padding: 24px 20px;
    }

    .circular-meter {
        width: 170px;
        height: 170px;
        border-radius: 50%;
        background: #ffffff;
        border: 8px solid #f1f5f9;
        box-shadow: 0 8px 24px rgba(0, 162, 211, 0.08), inset 0 2px 10px rgba(0,0,0,0.02);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin: 10px auto 18px auto;
        position: relative;
    }

    .circular-meter::after {
        content: '';
        position: absolute;
        inset: -8px;
        border-radius: 50%;
        border: 8px solid transparent;
        border-top-color: var(--primary-cyan);
        border-right-color: var(--vibrant-purple);
        transform: rotate(45deg);
    }

    .circular-meter .number {
        font-size: 2.8rem;
        font-weight: 800;
        color: var(--text-dark);
        line-height: 1;
        letter-spacing: -1px;
    }

    .circular-meter .label {
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 1px;
        color: var(--primary-cyan);
        text-transform: uppercase;
        margin-top: 4px;
    }

    .meter-slider {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        margin-top: 8px;
        color: #94a3b8;
    }

    .meter-slider .bar {
        width: 120px;
        height: 6px;
        background: #e2e8f0;
        border-radius: 10px;
        position: relative;
    }

    .meter-slider .bar-fill {
        height: 100%;
        width: 70%;
        background: linear-gradient(90deg, var(--primary-cyan), var(--vibrant-yellow));
        border-radius: 10px;
    }

    /* 3. Tarjeta de Gráfico Circular STATISTICS / GÉNERO */
    .chart-container-box {
        position: relative;
        width: 100%;
        max-width: 210px;
        height: 210px;
        margin: 0 auto 16px auto;
    }

    .legend-grid {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 10px 16px;
        font-size: 0.75rem;
        font-weight: 600;
        color: #64748b;
        margin-top: 10px;
    }

    .legend-item {
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .legend-dot {
        width: 10px;
        height: 10px;
        border-radius: 3px;
        display: inline-block;
    }

    /* 4. Tarjetas de Dispositivos / Módulos (MY DEVICES style) */
    .section-header-cyan {
        font-size: 1.15rem;
        font-weight: 800;
        letter-spacing: 0.8px;
        color: #0284c7;
        text-transform: uppercase;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .device-card-row {
        display: flex;
        align-items: stretch;
        gap: 12px;
        margin-bottom: 16px;
    }

    .device-card {
        flex: 1;
        background: #ffffff;
        border: 1.5px solid #e7edf3;
        border-radius: 20px;
        padding: 16px 20px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        min-height: 110px;
        transition: all 0.25s ease;
    }

    .device-card:hover {
        border-color: #a3e0f5;
        box-shadow: 0 8px 20px rgba(0, 162, 211, 0.08);
        transform: translateY(-2px);
    }

    .device-card .title {
        font-size: 0.74rem;
        font-weight: 700;
        letter-spacing: 1px;
        color: #0284c7;
        text-transform: uppercase;
    }

    .device-card .icon-illustration {
        font-size: 2.2rem;
        color: #64748b;
        margin: 6px 0;
    }

    .device-add-btn {
        width: 82px;
        background: #ffffff;
        border: 1.5px solid #e7edf3;
        border-radius: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: #94a3b8;
        font-size: 0.78rem;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.25s ease;
        padding: 10px;
        gap: 4px;
    }

    .device-add-btn i {
        font-size: 1.4rem;
        color: var(--primary-cyan);
    }

    .device-add-btn:hover {
        background: #f0f9ff;
        border-color: var(--primary-cyan);
        color: var(--primary-cyan);
        transform: translateY(-2px);
    }

    /* 5. Pills de Categorías (MY ROOMS style) */
    .room-pills-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 24px;
    }

    .room-pill {
        border-radius: var(--radius-pill);
        padding: 8px 20px;
        font-size: 0.78rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        text-decoration: none;
        transition: all 0.25s ease;
        box-shadow: 0 4px 12px rgba(0,0,0,0.04);
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .room-pill:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(0,0,0,0.1);
    }

    .room-pill-purple {
        background: linear-gradient(135deg, #a855f7, #6366f1);
        color: #ffffff;
    }
    .room-pill-cyan {
        background: linear-gradient(135deg, #00b4d8, #0ea5e9);
        color: #ffffff;
    }
    .room-pill-pink {
        background: linear-gradient(135deg, #f43f5e, #ec4899);
        color: #ffffff;
    }
    .room-pill-amber {
        background: linear-gradient(135deg, #f59e0b, #fbbf24);
        color: #ffffff;
    }
    .room-pill-teal {
        background: linear-gradient(135deg, #10b981, #06b6d4);
        color: #ffffff;
    }

    /* 6. Card LIGHT INTENSITY (Arco semicircular) */
    .intensity-card {
        padding: 20px;
        text-align: center;
    }

    .arc-gauge {
        width: 140px;
        height: 75px;
        margin: 10px auto;
        position: relative;
        overflow: hidden;
    }

    .arc-track {
        width: 140px;
        height: 140px;
        border-radius: 50%;
        border: 10px solid #f1f5f9;
        border-top-color: var(--primary-cyan);
        border-left-color: var(--vibrant-pink);
        position: absolute;
        top: 0;
        left: 0;
        transform: rotate(-45deg);
    }

    .arc-percent {
        font-size: 1.6rem;
        font-weight: 800;
        color: var(--text-dark);
        margin-top: 15px;
        line-height: 1;
    }
</style>

<!-- ========================================================
     1. BANNER SUPERIOR DE BIENVENIDA (Estilo image_4.png)
     ======================================================== -->
<div class="welcome-banner">
    <div class="welcome-text">
        <h2>Welcome Back, Grupo Apple</h2>
        <p>Dashboard de gestión de personas, entidades demográficas y estadísticas en tiempo real.</p>
    </div>
    <div class="welcome-avatar-box">
        <!-- Avatar Ilustrado SVG minimalista idéntico al estilo cartoon de image_4.png -->
        <svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
            <!-- Cuello y camiseta -->
            <path d="M30 85 C30 70, 70 70, 70 85 L70 95 L30 95 Z" fill="#0284c7" />
            <path d="M42 70 L58 70 L55 77 L45 77 Z" fill="#fbd38d" />
            <!-- Cabeza -->
            <circle cx="50" cy="48" r="22" fill="#fed7aa" />
            <!-- Cabello oscuro -->
            <path d="M28 45 C28 26, 72 26, 72 45 C66 30, 36 32, 28 45 Z" fill="#1e293b" />
            <path d="M33 35 C42 22, 60 22, 68 35 C60 28, 40 28, 33 35 Z" fill="#0f172a" />
            <!-- Ojos y Sonrisa -->
            <circle cx="43" cy="48" r="2.5" fill="#1e293b" />
            <circle cx="57" cy="48" r="2.5" fill="#1e293b" />
            <path d="M45 56 Q50 60 55 56" stroke="#1e293b" stroke-width="2" stroke-linecap="round" fill="none" />
            <!-- Mejillas sonrosadas -->
            <circle cx="39" cy="53" r="3" fill="#fca5a5" opacity="0.6" />
            <circle cx="61" cy="53" r="3" fill="#fca5a5" opacity="0.6" />
        </svg>
    </div>
</div>

<!-- ========================================================
     DISTRIBUCIÓN EN 2 COLUMNAS (Estilo image_4.png)
     ======================================================== -->
<div class="row g-4">
    <!-- COLUMNA IZQUIERDA: Tarjetas Estadísticas y Gráficos -->
    <div class="col-lg-5">
        <div class="row g-4">
            <!-- WIDGET 1: TOTAL PERSONAS (Estilo "TEMPERATURE 21°C") -->
            <div class="col-md-6 col-lg-6">
                <div class="card-custom gauge-card h-100">
                    <div class="card-title-cyan">Total Personas</div>
                    
                    <div class="circular-meter">
                        <span class="number"><?= $counts['persona'] ?? 0 ?></span>
                        <span class="label">Registrados</span>
                    </div>

                    <div class="meter-slider">
                        <i class="bi bi-dash-lg"></i>
                        <div class="bar">
                            <div class="bar-fill" style="width: <?= min(100, max(15, ($counts['persona'] ?? 0) * 10)) ?>%;"></div>
                        </div>
                        <i class="bi bi-plus-lg"></i>
                    </div>
                    
                    <div class="mt-3">
                        <a href="/persona" class="btn-on-off">VER LISTA</a>
                    </div>
                </div>
            </div>

            <!-- WIDGET 2: DISTRIBUCIÓN POR GÉNERO (Estilo "STATISTICS" Pastel 4 cuadrantes) -->
            <div class="col-md-6 col-lg-6">
                <div class="card-custom text-center h-100">
                    <div class="card-title-cyan">Statistics</div>
                    
                    <div class="chart-container-box">
                        <canvas id="generoChart"></canvas>
                    </div>

                    <!-- Leyenda interactiva con colores de image_4.png -->
                    <div class="legend-grid" id="generoLegend">
                        <!-- Generado por JS -->
                    </div>
                </div>
            </div>

            <!-- WIDGET 3: ESTADO CIVIL (Distribución Demográfica) -->
            <div class="col-12">
                <div class="card-custom">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="card-title-cyan mb-0">Distribución Estado Civil</div>
                        <span class="badge bg-light text-primary rounded-pill px-3 py-1"><?= $counts['estadocivil'] ?? 0 ?> Categorías</span>
                    </div>

                    <div class="row align-items-center">
                        <div class="col-sm-5 text-center">
                            <div style="height: 150px; width: 150px; margin: 0 auto;">
                                <canvas id="estadoCivilChart"></canvas>
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="d-flex flex-column gap-2" id="estadoCivilList">
                                <?php if (!empty($estadoCivilStats)): ?>
                                    <?php 
                                        $coloresEC = ['#00b4d8', '#8b5cf6', '#ec4899', '#f59e0b', '#10b981'];
                                        $i = 0;
                                        foreach ($estadoCivilStats as $ec): 
                                            $color = $coloresEC[$i % count($coloresEC)];
                                            $i++;
                                    ?>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <span class="small font-monospace text-muted d-flex align-items-center gap-2">
                                                <span class="legend-dot" style="background-color: <?= $color ?>;"></span>
                                                <?= esc($ec['nombre']) ?>
                                            </span>
                                            <span class="fw-bold small"><?= $ec['total'] ?></span>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <p class="text-muted small mb-0">No hay datos suficientes para graficar.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- COLUMNA DERECHA: My Devices & My Rooms & Intensity -->
    <div class="col-lg-7">
        <!-- SECCIÓN "MY DEVICES" (Teléfonos, Direcciones, Correos, Sexos) -->
        <div class="section-header-cyan">
            <i class="bi bi-grid-3x3-gap-fill"></i> Módulos del Sistema
        </div>

        <div class="row g-3 mb-4">
            <!-- Fila 1: Teléfonos & Direcciones -->
            <div class="col-md-6">
                <div class="device-card-row">
                    <div class="device-card">
                        <div class="title">Teléfonos</div>
                        <div class="icon-illustration">
                            <i class="bi bi-telephone-outbound text-info"></i>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold text-dark fs-5"><?= $counts['telefono'] ?? 0 ?></span>
                            <a href="/telefono" class="btn-on-off">VER</a>
                        </div>
                    </div>
                    <a href="/telefono" class="device-add-btn" title="Nuevo Teléfono">
                        <i class="bi bi-plus-circle-fill"></i>
                        <span>ADD</span>
                    </a>
                </div>
            </div>

            <div class="col-md-6">
                <div class="device-card-row">
                    <div class="device-card">
                        <div class="title">Direcciones</div>
                        <div class="icon-illustration">
                            <i class="bi bi-geo-alt-fill text-danger"></i>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold text-dark fs-5"><?= $counts['direccion'] ?? 0 ?></span>
                            <a href="/direccion" class="btn-on-off">VER</a>
                        </div>
                    </div>
                    <a href="/direccion" class="device-add-btn" title="Nueva Dirección">
                        <i class="bi bi-plus-circle-fill"></i>
                        <span>ADD</span>
                    </a>
                </div>
            </div>

            <!-- Fila 2: Correos & Sexo Biológico -->
            <div class="col-md-6">
                <div class="device-card-row">
                    <div class="device-card">
                        <div class="title">Correos</div>
                        <div class="icon-illustration">
                            <i class="bi bi-envelope-at text-primary"></i>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold text-dark fs-5"><?= $counts['correo'] ?? 0 ?></span>
                            <a href="/correo" class="btn-on-off">VER</a>
                        </div>
                    </div>
                    <a href="/correo" class="device-add-btn" title="Nuevo Correo">
                        <i class="bi bi-plus-circle-fill"></i>
                        <span>ADD</span>
                    </a>
                </div>
            </div>

            <div class="col-md-6">
                <div class="device-card-row">
                    <div class="device-card">
                        <div class="title">Sexos</div>
                        <div class="icon-illustration">
                            <i class="bi bi-person-badge-fill text-success"></i>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold text-dark fs-5"><?= $counts['sexo'] ?? 0 ?></span>
                            <a href="/sexo" class="btn-on-off">VER</a>
                        </div>
                    </div>
                    <a href="/sexo" class="device-add-btn" title="Nuevo Sexo">
                        <i class="bi bi-plus-circle-fill"></i>
                        <span>ADD</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- SECCIÓN "MY ROOMS" (Accesos Rápidos con Pills de Gradiente) -->
        <div class="section-header-cyan">
            <i class="bi bi-lightning-charge-fill"></i> Accesos Rápidos
        </div>

        <div class="row align-items-center mb-4">
            <div class="col-md-8">
                <div class="room-pills-container">
                    <a href="/persona" class="room-pill room-pill-purple">
                        <i class="bi bi-person-plus-fill"></i> + Nueva Persona
                    </a>
                    <a href="/telefono" class="room-pill room-pill-cyan">
                        <i class="bi bi-telephone-plus-fill"></i> + Nuevo Teléfono
                    </a>
                    <a href="/correo" class="room-pill room-pill-pink">
                        <i class="bi bi-envelope-plus-fill"></i> + Nuevo Correo
                    </a>
                    <a href="/direccion" class="room-pill room-pill-amber">
                        <i class="bi bi-geo-alt-fill"></i> + Dirección
                    </a>
                    <a href="/genero" class="room-pill room-pill-teal">
                        <i class="bi bi-gender-ambiguous"></i> Géneros
                    </a>
                    <a href="/estadocivil" class="room-pill room-pill-purple">
                        <i class="bi bi-heart-fill"></i> Estados Civiles
                    </a>
                </div>
            </div>

            <!-- CARD "LIGHT INTENSITY" (Contactabilidad con Arco Semicircular) -->
            <div class="col-md-4">
                <div class="card-custom intensity-card">
                    <div class="card-title-cyan">Contactabilidad</div>
                    
                    <div class="arc-gauge">
                        <div class="arc-track"></div>
                        <div class="arc-percent"><?= $contactabilidad ?>%</div>
                    </div>

                    <div class="meter-slider mt-1">
                        <i class="bi bi-dash"></i>
                        <div class="bar">
                            <div class="bar-fill" style="width: <?= max(10, $contactabilidad) ?>%;"></div>
                        </div>
                        <i class="bi bi-plus"></i>
                    </div>

                    <div class="mt-2">
                        <span class="btn-on-off">ACTIVO</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ========================================================
     3. TABLA DE ÚLTIMAS PERSONAS REGISTRADAS
     ======================================================== -->
<div class="row mt-2">
    <div class="col-12">
        <div class="card-custom">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h5 class="fw-bold mb-1 text-dark"><i class="bi bi-people-fill text-primary me-2"></i>Últimas Personas Registradas</h5>
                    <p class="text-muted small mb-0">Vista previa de las personas recientemente incorporadas al sistema</p>
                </div>
                <a href="/persona" class="btn-pill btn-pill-cyan">
                    <i class="bi bi-arrow-right-circle-fill"></i> Ver Todas
                </a>
            </div>

            <div class="table-responsive">
                <table class="table-custom">
                    <thead>
                        <tr>
                            <th>Persona</th>
                            <th>Fecha Nacimiento</th>
                            <th>Género</th>
                            <th>Sexo</th>
                            <th>Estado Civil</th>
                            <th class="text-end">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($ultimasPersonas)): ?>
                            <?php foreach ($ultimasPersonas as $p): ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="btn-circle-action btn-user-avatar" style="width: 38px; height: 38px; font-size: 0.9rem;">
                                                <?= strtoupper(substr($p['nombres'], 0, 1)) ?>
                                            </div>
                                            <div>
                                                <div class="fw-bold text-dark"><?= esc($p['nombres']) ?> <?= esc($p['apellidos']) ?></div>
                                                <small class="text-muted">ID: #<?= $p['idpersona'] ?></small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <i class="bi bi-calendar3 text-muted me-1"></i><?= $p['fecha_nacimiento'] ?>
                                    </td>
                                    <td>
                                        <span class="badge badge-pill-custom bg-info-subtle text-info border border-info-subtle">
                                            <?= esc($p['genero'] ?? 'No especificado') ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge badge-pill-custom bg-success-subtle text-success border border-success-subtle">
                                            <?= esc($p['sexo'] ?? 'No especificado') ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge badge-pill-custom bg-warning-subtle text-warning-emphasis border border-warning-subtle">
                                            <?= esc($p['estado_civil'] ?? 'No especificado') ?>
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <a href="/persona" class="btn btn-sm btn-light rounded-pill px-3 fw-bold text-primary">
                                            <i class="bi bi-pencil-square"></i> Detalle
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                    No hay personas registradas todavía. <a href="/persona" class="text-primary fw-bold">Registrar primera persona</a>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // ========================================================
        // 1. GRÁFICO CIRCULAR STATISTICS / GÉNERO (Estilo image_4.png)
        // Colores de la imagen: Cian (#00b4d8), Morado (#8b5cf6), Naranja (#ffb703), Rosa (#ec4899)
        // ========================================================
        const generoCanvas = document.getElementById('generoChart');
        if (generoCanvas) {
            // Datos desde PHP o muestra demostrativa si BD está vacía
            let generoData = <?= json_encode($generoStats ?? []) ?>;
            
            let labels = [];
            let data = [];
            let colors = ['#00b4d8', '#8b5cf6', '#ffb703', '#ec4899', '#10b981'];

            if (generoData.length > 0 && generoData.some(g => g.total > 0)) {
                generoData.forEach(g => {
                    labels.push(g.nombre);
                    data.push(g.total);
                });
            } else {
                // Si aún no hay datos en la BD, mostramos proporción demostrativa estilo image_4.png (50%, 25%, 15%, 10%)
                labels = ['Masculino', 'Femenino', 'No Binario', 'Otro'];
                data = [50, 25, 15, 10];
            }

            const chart = new Chart(generoCanvas, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        data: data,
                        backgroundColor: colors.slice(0, labels.length),
                        borderWidth: 2,
                        borderColor: '#ffffff',
                        hoverOffset: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    let total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    let value = context.parsed;
                                    let percentage = total > 0 ? Math.round((value / total) * 100) : 0;
                                    return ` ${context.label}: ${value} (${percentage}%)`;
                                }
                            }
                        }
                    }
                }
            });

            // Generar leyenda personalizada debajo del gráfico
            const legendContainer = document.getElementById('generoLegend');
            if (legendContainer) {
                let legendHtml = '';
                labels.forEach((label, idx) => {
                    let total = data.reduce((a, b) => a + b, 0);
                    let pct = total > 0 ? Math.round((data[idx] / total) * 100) : 0;
                    legendHtml += `
                        <div class="legend-item">
                            <span class="legend-dot" style="background-color: ${colors[idx % colors.length]};"></span>
                            <span>${label} (${pct}%)</span>
                        </div>
                    `;
                });
                legendContainer.innerHTML = legendHtml;
            }
        }

        // ========================================================
        // 2. GRÁFICO DONUT ESTADO CIVIL
        // ========================================================
        const ecCanvas = document.getElementById('estadoCivilChart');
        if (ecCanvas) {
            let ecData = <?= json_encode($estadoCivilStats ?? []) ?>;
            let ecLabels = [];
            let ecValues = [];
            let ecColors = ['#00b4d8', '#8b5cf6', '#ec4899', '#f59e0b', '#10b981'];

            if (ecData.length > 0 && ecData.some(e => e.total > 0)) {
                ecData.forEach(e => {
                    ecLabels.push(e.nombre);
                    ecValues.push(e.total);
                });
            } else {
                ecLabels = ['Soltero(a)', 'Casado(a)', 'Unión Libre', 'Divorciado(a)'];
                ecValues = [40, 30, 20, 10];
            }

            new Chart(ecCanvas, {
                type: 'doughnut',
                data: {
                    labels: ecLabels,
                    datasets: [{
                        data: ecValues,
                        backgroundColor: ecColors.slice(0, ecLabels.length),
                        borderWidth: 2,
                        borderColor: '#ffffff',
                        cutout: '65%'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    }
                }
            });
        }
    });
</script>
<?= $this->endSection() ?>
