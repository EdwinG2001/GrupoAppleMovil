<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Dashboard de Gestión de Personas - Grupo Apple' ?></title>
    <!-- Google Fonts: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

    <style>
        :root {
            --primary-cyan: #00a2d3;
            --primary-cyan-hover: #0088b3;
            --dark-cyan: #0284c7;
            --vibrant-purple: #8b5cf6;
            --deep-purple: #6366f1;
            --vibrant-pink: #ec4899;
            --vibrant-yellow: #f59e0b;
            --bg-canvas: #edf3f8;
            --card-bg: #ffffff;
            --text-dark: #1e293b;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
            --radius-card: 24px;
            --radius-pill: 50px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #eaf2f8 0%, #f4f8fc 50%, #ffffff 100%);
            color: var(--text-dark);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Contenedor general estilo ventana redondeada */
        .app-wrapper {
            display: flex;
            min-height: 100vh;
            width: 100%;
        }

        /* ===================================================
           BARRA DE NAVEGACIÓN VERTICAL IZQUIERDA (image_4.png)
           =================================================== */
        .sidebar-vertical {
            width: 110px;
            min-width: 110px;
            background-color: var(--primary-cyan);
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 24px 0;
            position: sticky;
            top: 0;
            height: 100vh;
            z-index: 100;
            box-shadow: 4px 0 20px rgba(0, 162, 211, 0.15);
        }

        .sidebar-brand {
            width: 52px;
            height: 52px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            font-size: 1.6rem;
            margin-bottom: 28px;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .sidebar-brand:hover {
            background: #ffffff;
            color: var(--primary-cyan);
            transform: scale(1.06);
        }

        .sidebar-nav {
            list-style: none;
            padding: 0;
            margin: 0;
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 12px;
            overflow-y: auto;
            scrollbar-width: none; /* Firefox */
        }
        .sidebar-nav::-webkit-scrollbar {
            display: none; /* Chrome/Safari */
        }

        .sidebar-item {
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .sidebar-link {
            width: 88px;
            height: 68px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            color: rgba(255, 255, 255, 0.85);
            border-radius: 18px;
            transition: all 0.25s ease;
            padding: 6px 4px;
        }

        .sidebar-link i {
            font-size: 1.35rem;
            margin-bottom: 3px;
            transition: transform 0.2s ease;
        }

        .sidebar-link span {
            font-size: 0.52rem;
            font-weight: 600;
            letter-spacing: 0.2px;
            text-transform: uppercase;
            text-align: center;
            line-height: 1.1;
            white-space: nowrap;
        }

        .sidebar-link:hover {
            color: #ffffff;
            background: rgba(255, 255, 255, 0.18);
            transform: translateY(-2px);
        }

        .sidebar-link:hover i {
            transform: scale(1.1);
        }

        /* Elemento Activo (Igual que "HOME" en image_4.png) */
        .sidebar-link.active {
            color: #ffffff;
            background: rgba(255, 255, 255, 0.28);
            box-shadow: inset 0 0 12px rgba(255, 255, 255, 0.2), 0 4px 12px rgba(0, 0, 0, 0.08);
            position: relative;
        }

        .sidebar-link.active::before {
            content: '';
            position: absolute;
            left: 2px;
            top: 25%;
            height: 50%;
            width: 3px;
            background-color: #ffffff;
            border-radius: 0 4px 4px 0;
        }

        /* ===================================================
           ÁREA CENTRAL DE CONTENIDO
           =================================================== */
        .main-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
            padding: 24px 32px 40px 32px;
        }

        /* ENCABEZADO SUPERIOR (Search + User + Notification) */
        .top-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
            gap: 20px;
        }

        .search-pill-container {
            flex: 1;
            max-width: 580px;
            position: relative;
        }

        .search-pill-input {
            width: 100%;
            height: 48px;
            background: #ffffff;
            border: 1.5px solid #a3e0f5;
            border-radius: var(--radius-pill);
            padding: 0 50px 0 24px;
            font-size: 0.88rem;
            font-weight: 500;
            color: var(--text-dark);
            outline: none;
            transition: all 0.25s ease;
            box-shadow: 0 2px 8px rgba(0, 162, 211, 0.04);
        }

        .search-pill-input:focus {
            border-color: var(--primary-cyan);
            box-shadow: 0 0 0 4px rgba(0, 162, 211, 0.15);
        }

        .search-pill-btn {
            position: absolute;
            right: 8px;
            top: 6px;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: none;
            background: transparent;
            color: var(--primary-cyan);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.15rem;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .search-pill-btn:hover {
            transform: scale(1.15);
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .btn-circle-action {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            cursor: pointer;
            border: none;
            transition: all 0.25s ease;
            background: #ffffff;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
        }

        .btn-circle-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.09);
        }

        .btn-user-avatar {
            background: linear-gradient(135deg, #a855f7, #7c3aed);
            color: #ffffff;
            font-size: 1.1rem;
        }

        .btn-user-avatar .badge-dot {
            position: absolute;
            top: 0;
            right: 0;
            width: 14px;
            height: 14px;
            background-color: var(--primary-cyan);
            color: #ffffff;
            border-radius: 50%;
            border: 2px solid #ffffff;
            font-size: 0.55rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-notification {
            color: var(--primary-cyan);
            font-size: 1.25rem;
        }

        .btn-notification .badge-bell {
            position: absolute;
            top: 3px;
            right: 3px;
            width: 13px;
            height: 13px;
            background-color: #f59e0b;
            border-radius: 50%;
            border: 2px solid #ffffff;
        }

        .btn-menu-bars {
            color: #475569;
            font-size: 1.35rem;
        }

        /* ===================================================
           ESTILOS GENERALES DE TARJETAS Y COMPONENTES UI
           =================================================== */
        .card-custom {
            background: #ffffff;
            border-radius: var(--radius-card);
            border: 1.5px solid #e7edf3;
            box-shadow: 0 8px 24px rgba(15, 34, 58, 0.04);
            transition: all 0.25s ease;
            padding: 24px;
            position: relative;
        }

        .card-custom:hover {
            box-shadow: 0 12px 30px rgba(0, 162, 211, 0.08);
            border-color: #d2e4f3;
        }

        .card-title-cyan {
            font-size: 0.85rem;
            font-weight: 700;
            letter-spacing: 1.2px;
            color: var(--primary-cyan);
            text-transform: uppercase;
            margin-bottom: 18px;
        }

        /* Botones estilo Pill */
        .btn-pill {
            border-radius: var(--radius-pill);
            font-weight: 600;
            padding: 9px 22px;
            font-size: 0.86rem;
            transition: all 0.25s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: none;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
        }

        .btn-pill:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.12);
        }

        .btn-pill-cyan {
            background: linear-gradient(135deg, #00b4d8, #0099cc);
            color: #ffffff;
        }
        .btn-pill-cyan:hover {
            color: #ffffff;
            background: linear-gradient(135deg, #0099cc, #0088b3);
        }

        .btn-pill-purple {
            background: linear-gradient(135deg, #8b5cf6, #6366f1);
            color: #ffffff;
        }
        .btn-pill-purple:hover {
            color: #ffffff;
            background: linear-gradient(135deg, #7c3aed, #4f46e5);
        }

        .btn-pill-pink {
            background: linear-gradient(135deg, #f43f5e, #ec4899);
            color: #ffffff;
        }
        .btn-pill-pink:hover {
            color: #ffffff;
        }

        .btn-pill-amber {
            background: linear-gradient(135deg, #f59e0b, #fbbf24);
            color: #ffffff;
        }
        .btn-pill-amber:hover {
            color: #ffffff;
        }

        .btn-pill-outline {
            background: transparent;
            border: 1.5px solid #cbd5e1;
            color: #475569;
        }
        .btn-pill-outline:hover {
            border-color: var(--primary-cyan);
            color: var(--primary-cyan);
            background: rgba(0, 162, 211, 0.04);
        }

        /* Botón estilo ON/OFF de image_4.png */
        .btn-on-off {
            border-radius: var(--radius-pill);
            padding: 4px 14px;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            border: 1.5px solid #dbeafe;
            color: var(--primary-cyan);
            background: #f0f9ff;
            text-decoration: none;
            display: inline-block;
            transition: all 0.2s;
        }
        .btn-on-off:hover {
            background: var(--primary-cyan);
            color: #ffffff;
            border-color: var(--primary-cyan);
        }

        /* Badges redondeados */
        .badge-pill-custom {
            border-radius: var(--radius-pill);
            padding: 6px 14px;
            font-size: 0.76rem;
            font-weight: 600;
            letter-spacing: 0.3px;
        }

        /* Tablas redondeadas y limpias */
        .table-custom-container {
            background: #ffffff;
            border-radius: var(--radius-card);
            border: 1.5px solid #e7edf3;
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(15, 34, 58, 0.04);
        }

        .table-custom {
            margin-bottom: 0;
            width: 100%;
        }

        .table-custom thead th {
            background: #f8fafc;
            color: #475569;
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            padding: 16px 20px;
            border-bottom: 1.5px solid #edf2f7;
        }

        .table-custom tbody td {
            padding: 16px 20px;
            vertical-align: middle;
            font-size: 0.88rem;
            border-bottom: 1px solid #f1f5f9;
        }

        .table-custom tbody tr:hover {
            background-color: #f8fafc;
        }

        /* Modales modernos */
        .modal-content {
            border-radius: 26px;
            border: none;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }

        .modal-header {
            background: linear-gradient(135deg, var(--primary-cyan), var(--dark-cyan));
            color: #ffffff;
            border-bottom: none;
            padding: 20px 28px;
        }

        .modal-header .btn-close {
            filter: brightness(0) invert(1);
        }

        .modal-body {
            padding: 28px;
        }

        .modal-footer {
            border-top: 1px solid #edf2f7;
            padding: 16px 28px;
        }

        .form-control, .form-select {
            border-radius: 14px;
            border: 1.5px solid #e2e8f0;
            padding: 10px 16px;
            font-size: 0.88rem;
            transition: all 0.2s;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-cyan);
            box-shadow: 0 0 0 3px rgba(0, 162, 211, 0.15);
        }

        /* Alertas flotantes redondeadas */
        .alert-custom {
            border-radius: 18px;
            border: none;
            padding: 14px 20px;
            font-weight: 500;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.05);
            margin-bottom: 24px;
        }

        /* Responsive */
        @media (max-width: 991px) {
            .app-wrapper {
                flex-direction: column;
            }
            .sidebar-vertical {
                width: 100%;
                height: auto;
                position: relative;
                flex-direction: row;
                padding: 12px 18px;
                justify-content: space-between;
            }
            .sidebar-brand {
                margin-bottom: 0;
            }
            .sidebar-nav {
                flex-direction: row;
                gap: 6px;
                width: auto;
            }
            .sidebar-link {
                width: 65px;
                height: 56px;
                padding: 4px;
            }
            .sidebar-link span {
                display: none;
            }
            .main-wrapper {
                padding: 18px;
            }
        }

        /* ===================================================
           SOBREESCRITURA GLOBAL PARA TODAS LAS VISTAS CRUD
           =================================================== */
        .card {
            background: #ffffff !important;
            border-radius: var(--radius-card) !important;
            border: 1.5px solid #e7edf3 !important;
            box-shadow: 0 8px 24px rgba(15, 34, 58, 0.04) !important;
        }

        .card-header {
            background: #ffffff !important;
            border-bottom: 1.5px solid #edf2f7 !important;
            font-weight: 700 !important;
            color: #1e293b !important;
            border-radius: var(--radius-card) var(--radius-card) 0 0 !important;
            padding: 18px 24px !important;
        }

        .card-body {
            padding: 24px !important;
        }

        .btn-primary {
            background: linear-gradient(135deg, #00b4d8, #0099cc) !important;
            border: none !important;
            border-radius: var(--radius-pill) !important;
            font-weight: 600 !important;
            padding: 9px 22px !important;
            box-shadow: 0 4px 12px rgba(0, 162, 211, 0.2) !important;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #0099cc, #0088b3) !important;
            transform: translateY(-2px);
        }

        .btn-sm.btn-warning {
            border-radius: 50% !important;
            width: 36px !important;
            height: 36px !important;
            padding: 0 !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            background: #fef3c7 !important;
            border: 1px solid #fde68a !important;
            color: #d97706 !important;
        }

        .btn-sm.btn-warning:hover {
            background: #f59e0b !important;
            color: #ffffff !important;
        }

        .btn-sm.btn-danger {
            border-radius: 50% !important;
            width: 36px !important;
            height: 36px !important;
            padding: 0 !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            background: #fee2e2 !important;
            border: 1px solid #fecaca !important;
            color: #dc2626 !important;
        }

        .btn-sm.btn-danger:hover {
            background: #ef4444 !important;
            color: #ffffff !important;
        }

        .table {
            margin-bottom: 0 !important;
        }

        .table thead th {
            background-color: #f8fafc !important;
            color: #475569 !important;
            font-size: 0.78rem !important;
            font-weight: 700 !important;
            letter-spacing: 0.8px !important;
            text-transform: uppercase !important;
            padding: 16px 20px !important;
            border-bottom: 1.5px solid #edf2f7 !important;
        }

        .table tbody td {
            padding: 16px 20px !important;
            vertical-align: middle !important;
            font-size: 0.88rem !important;
            border-bottom: 1px solid #f1f5f9 !important;
        }

        .table tbody tr:hover {
            background-color: #f8fafc !important;
        }

        .badge {
            border-radius: var(--radius-pill) !important;
            padding: 6px 14px !important;
            font-weight: 600 !important;
            font-size: 0.78rem !important;
            letter-spacing: 0.3px !important;
        }

        .badge.bg-primary {
            background: #e0f2fe !important;
            color: #0284c7 !important;
            border: 1px solid #bae6fd;
        }

        .badge.bg-success {
            background: #dcfce7 !important;
            color: #16a34a !important;
            border: 1px solid #bbf7d0;
        }

        .badge.bg-info {
            background: #ede9fe !important;
            color: #7c3aed !important;
            border: 1px solid #ddd6fe;
        }

        .badge.bg-warning {
            background: #fef3c7 !important;
            color: #d97706 !important;
            border: 1px solid #fde68a;
        }

        .badge.bg-danger {
            background: #ffe4e6 !important;
            color: #e11d48 !important;
            border: 1px solid #fecdd3;
        }

        .badge.bg-secondary {
            background: #f1f5f9 !important;
            color: #475569 !important;
            border: 1px solid #e2e8f0;
        }
    </style>
</head>
<body>
    <div class="app-wrapper">
        <!-- =============================================
             BARRA DE NAVEGACIÓN VERTICAL IZQUIERDA
             ============================================= -->
        <aside class="sidebar-vertical">
            <!-- Brand Logo -->
            <a href="/" class="sidebar-brand" title="Grupo Apple - Dashboard">
                <i class="bi bi-apple"></i>
            </a>

            <!-- Navegación con Iconos y Etiquetas Minimalistas -->
            <?php 
                $uri = service('uri')->getPath(); 
                $uri = trim($uri, '/');
            ?>
            <ul class="sidebar-nav">
                <!-- Estadísticas (Dashboard Inicio) -->
                <li class="sidebar-item">
                    <a href="/" class="sidebar-link <?= ($uri === '' || $uri === 'index.php') ? 'active' : '' ?>" title="Estadísticas">
                        <i class="bi bi-pie-chart-fill"></i>
                        <span>Estadísticas</span>
                    </a>
                </li>

                <!-- Personas -->
                <li class="sidebar-item">
                    <a href="/persona" class="sidebar-link <?= (str_starts_with($uri, 'persona')) ? 'active' : '' ?>" title="Personas">
                        <i class="bi bi-people-fill"></i>
                        <span>Personas</span>
                    </a>
                </li>

                <!-- Géneros -->
                <li class="sidebar-item">
                    <a href="/genero" class="sidebar-link <?= (str_starts_with($uri, 'genero')) ? 'active' : '' ?>" title="Géneros">
                        <i class="bi bi-gender-ambiguous"></i>
                        <span>Géneros</span>
                    </a>
                </li>

                <!-- Sexos -->
                <li class="sidebar-item">
                    <a href="/sexo" class="sidebar-link <?= (str_starts_with($uri, 'sexo')) ? 'active' : '' ?>" title="Sexos">
                        <i class="bi bi-person-badge-fill"></i>
                        <span>Sexos</span>
                    </a>
                </li>

                <!-- Estado Civil -->
                <li class="sidebar-item">
                    <a href="/estadocivil" class="sidebar-link <?= (str_starts_with($uri, 'estadocivil')) ? 'active' : '' ?>" title="Estado Civil">
                        <i class="bi bi-heart-fill"></i>
                        <span>Est. Civil</span>
                    </a>
                </li>

                <!-- Teléfonos -->
                <li class="sidebar-item">
                    <a href="/telefono" class="sidebar-link <?= (str_starts_with($uri, 'telefono')) ? 'active' : '' ?>" title="Teléfonos">
                        <i class="bi bi-telephone-fill"></i>
                        <span>Teléfonos</span>
                    </a>
                </li>

                <!-- Direcciones -->
                <li class="sidebar-item">
                    <a href="/direccion" class="sidebar-link <?= (str_starts_with($uri, 'direccion')) ? 'active' : '' ?>" title="Direcciones">
                        <i class="bi bi-geo-alt-fill"></i>
                        <span>Dirección</span>
                    </a>
                </li>

                <!-- Correos -->
                <li class="sidebar-item">
                    <a href="/correo" class="sidebar-link <?= (str_starts_with($uri, 'correo')) ? 'active' : '' ?>" title="Correos">
                        <i class="bi bi-envelope-at-fill"></i>
                        <span>Correos</span>
                    </a>
                </li>
            </ul>
        </aside>

        <!-- =============================================
             CONTENIDO PRINCIPAL
             ============================================= -->
        <main class="main-wrapper">
            <!-- Encabezado Superior (Barra de Búsqueda y Botón de Red Móvil) -->
            <header class="top-header">
                <!-- Barra de Búsqueda tipo Píldora -->
                <div class="search-pill-container">
                    <input type="text" id="globalSearchInput" class="search-pill-input" placeholder="SEARCH / Buscar en el sistema...">
                    <button class="search-pill-btn" type="button" title="Buscar">
                        <i class="bi bi-search"></i>
                    </button>
                </div>

                <!-- Botón de Conexión Móvil / Red con Indicador 0.0.0.0 (Estilo image_4.png) -->
                <button type="button" class="btn-pill btn-pill-purple d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#modalConexionRed" title="Servidor configurado en host 0.0.0.0 - Clic para ver IPs">
                    <span class="d-inline-block rounded-circle bg-success" style="width: 9px; height: 9px; box-shadow: 0 0 8px #22c55e;"></span>
                    <span style="font-size: 0.82rem;">Host: <strong>0.0.0.0</strong></span>
                    <i class="bi bi-broadcast ms-1"></i>
                </button>
            </header>

            <!-- Mensajes Flash de Notificación -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-custom alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2 text-success"></i><?= session()->getFlashdata('success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger alert-custom alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2 text-danger"></i><?= session()->getFlashdata('error') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <!-- Inyección de la vista del módulo actual -->
            <?= $this->renderSection('content') ?>
        </main>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script de búsqueda rápida en tablas -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('globalSearchInput');
            if (searchInput) {
                searchInput.addEventListener('keyup', function () {
                    const query = this.value.toLowerCase();
                    const tableRows = document.querySelectorAll('tbody tr');
                    tableRows.forEach(row => {
                        const rowText = row.textContent.toLowerCase();
                        if (rowText.includes(query)) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                });
            }
        });
    </script>

    <!-- ========================================================
         MODAL: CONEXIÓN MÓVIL Y CONFIGURACIÓN DE RED (0.0.0.0)
         ======================================================== -->
    <div class="modal fade" id="modalConexionRed" tabindex="-1" aria-labelledby="modalConexionRedLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold text-white" id="modalConexionRedLabel">
                        <i class="bi bi-broadcast-pin me-2"></i>Conexión Móvil y Acceso en Red
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <!-- Estado Actual -->
                    <div class="alert alert-success d-flex align-items-center mb-4 rounded-4" role="alert">
                        <i class="bi bi-check-circle-fill fs-3 text-success me-3"></i>
                        <div>
                            <div class="fw-bold">Servidor habilitado para toda la red (0.0.0.0:8080)</div>
                            <small class="text-muted">Acepta peticiones de esta PC, cable USB y celulares conectados por Wi-Fi o Zona Móvil (Hotspot) hasta que apagues el servidor con <code>Ctrl + C</code>.</small>
                        </div>
                    </div>

                    <h6 class="fw-bold text-dark mb-3"><i class="bi bi-phone me-2 text-primary"></i>¿Qué dirección IP colocar en la App Móvil?</h6>

                    <div class="row g-3">
                        <!-- Opción 1: Hotspot de Laptop -->
                        <div class="col-md-6">
                            <div class="p-3 border rounded-4 bg-light h-100">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="badge bg-primary rounded-pill">📶 Opción Recomendada</span>
                                    <small class="text-muted">Zona Móvil</small>
                                </div>
                                <div class="fw-bold text-dark">Si compartes internet desde tu Laptop:</div>
                                <p class="small text-muted mb-2">Windows asigna la IP fija <code>192.168.137.1</code>.</p>
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control font-monospace" value="http://192.168.137.1:8080/api" readonly id="ipHotspot">
                                    <button class="btn btn-outline-primary" type="button" onclick="copiarAlPortapapeles('http://192.168.137.1:8080/api', this)">
                                        <i class="bi bi-clipboard"></i> Copiar
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Opción 2: Wi-Fi de la Casa o Universidad -->
                        <div class="col-md-6">
                            <div class="p-3 border rounded-4 bg-light h-100">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="badge bg-info rounded-pill">🏠 Misma Red Wi-Fi</span>
                                    <small class="text-muted">IP Local</small>
                                </div>
                                <div class="fw-bold text-dark">Si ambos están en el mismo Wi-Fi:</div>
                                <p class="small text-muted mb-2">IP detectada de esta Laptop en tu red.</p>
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control font-monospace" value="http://<?= gethostbyname(gethostname()) ?>:8080/api" readonly id="ipLocal">
                                    <button class="btn btn-outline-info" type="button" onclick="copiarAlPortapapeles('http://<?= gethostbyname(gethostname()) ?>:8080/api', this)">
                                        <i class="bi bi-clipboard"></i> Copiar
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Opción 3: Cable USB o Navegador Web -->
                        <div class="col-12">
                            <div class="p-3 border rounded-4 bg-light">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="badge bg-secondary rounded-pill">🔌 Cable USB / Navegador PC</span>
                                    <small class="text-muted">Localhost</small>
                                </div>
                                <div class="fw-bold text-dark">Para pruebas en Edge/Chrome o con cable USB (adb reverse):</div>
                                <div class="input-group input-group-sm mt-2">
                                    <input type="text" class="form-control font-monospace" value="http://localhost:8080/api" readonly id="ipLocalhost">
                                    <button class="btn btn-outline-secondary" type="button" onclick="copiarAlPortapapeles('http://localhost:8080/api', this)">
                                        <i class="bi bi-clipboard"></i> Copiar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- Explicación Técnica y Comando de Inicio -->
                    <div class="bg-light p-3 rounded-4 mb-3 border">
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-info-circle-fill text-primary me-2"></i>
                            <span class="fw-bold text-dark small">¿Se puede cambiar a 0.0.0.0 en caliente desde un botón web?</span>
                        </div>
                        <p class="text-muted small mb-2" style="line-height: 1.45;">
                            A nivel de sistema operativo en Windows, un servidor PHP que ya está corriendo en un puerto no puede reasignar su socket de red sin reiniciarse. <strong>¡Pero ya no necesitas hacer nada manual!</strong> Modificamos el núcleo de CodeIgniter para que el comando por defecto siempre use <code>--host 0.0.0.0</code>. Desde el segundo que lo enciendes, ya acepta todas las conexiones hasta que lo apagues con <code>Ctrl + C</code> en la terminal.
                        </p>
                    </div>

                    <div class="d-flex flex-wrap align-items-center justify-content-between p-3 rounded-4 bg-white border gap-2">
                        <div>
                            <div class="fw-bold small text-dark"><i class="bi bi-terminal me-2 text-primary"></i>Comando clave para iniciar el servidor:</div>
                            <code class="small text-primary font-monospace">C:\php\php.exe spark serve --host 0.0.0.0</code>
                        </div>
                        <div class="d-flex gap-2">
                            <button class="btn btn-sm btn-outline-dark rounded-pill px-3" type="button" onclick="copiarAlPortapapeles('C:\\php\\php.exe spark serve --host 0.0.0.0', this)">
                                <i class="bi bi-clipboard"></i> Copiar Comando
                            </button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Entendido</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Script de copiado al portapapeles -->
    <script>
        function copiarAlPortapapeles(texto, btn) {
            navigator.clipboard.writeText(texto).then(function() {
                const originalHtml = btn.innerHTML;
                btn.innerHTML = '<i class="bi bi-check2"></i> ¡Copiado!';
                btn.classList.add('btn-success');
                setTimeout(function() {
                    btn.innerHTML = originalHtml;
                    btn.classList.remove('btn-success');
                }, 2000);
            });
        }
    </script>

    <?= $this->renderSection('scripts') ?>
</body>
</html>
