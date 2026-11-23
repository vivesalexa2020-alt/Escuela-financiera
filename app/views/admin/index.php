<?php
$csrf = \App\Core\Csrf::generateToken();
$config = array_merge([
    'nombre_plataforma'     => 'Educación Financiera',
    'correo_soporte'        => '',
    'moneda'                => 'MXN',
    'zona_horaria'          => 'America/Mexico_City',
    'permitir_registro'     => '1',
    'login_max_intentos'    => '5',
    'login_ventana_minutos' => '15',
    'modo_mantenimiento'    => '0',
    'mensaje_mantenimiento' => '',
    'anuncio_activo'        => '0',
    'anuncio_texto'         => '',
    'anuncio_tipo'          => 'info',
], $config ?? []);

$adminName = htmlspecialchars($user['name'] ?? 'Administrador');
$totalUsuarios = (int)($stats['usuarios'] ?? 0);
$totalAdmins   = (int)($stats['admins'] ?? 0);
$totalCursos   = (int)($stats['cursos'] ?? 0);
$totalCursosActivos = (int)($stats['cursos_activos'] ?? 0);
$totalMembresias = (int)($stats['membresias'] ?? 0);
$totalInscripciones = (int)($stats['inscripciones'] ?? 0);
$totalProgresos = (int)($stats['progresos'] ?? 0);
$totalLogros = (int)($stats['logros'] ?? 0);
$totalEstudiantes = max(0, $totalUsuarios - $totalAdmins);
$totalLecciones = array_sum(array_map(fn($c) => (int)($c['total_lecciones'] ?? 0), $cursos ?? []));
$totalEjercicios = array_sum(array_map(fn($c) => (int)($c['total_ejercicios'] ?? 0), $cursos ?? []));
$totalAudios = array_sum(array_map(fn($c) => (int)($c['total_audios'] ?? 0), $cursos ?? []));
$totalLibros = array_sum(array_map(fn($c) => (int)($c['total_libros'] ?? 0), $cursos ?? []));

$memPorTipo = ['gratis' => 0, 'pro' => 0, 'premium' => 0];
foreach (($membresias ?? []) as $m) {
    if (!empty($m['activa']) && isset($memPorTipo[$m['tipo_membresia']])) {
        $memPorTipo[$m['tipo_membresia']]++;
    }
}

$selectedCursoId = (int)($selectedCursoId ?? 0);
$selectedCurso   = $selectedCurso ?? null;
$leccionesCurso  = $leccionesCurso ?? [];
$librosCurso     = $librosCurso ?? [];
$audiosCurso     = $audiosCurso ?? [];
$ejerciciosCurso = $ejerciciosCurso ?? [];
?>
<style>
:root{
  --adm-bg:#f8fafc;
  --adm-card-bg:#ffffff;
  --adm-text:#0f172a;
  --adm-muted:#64748b;
  --adm-border:#e2e8f0;
  --adm-sidebar:#04291d;
  --adm-sidebar-border:#084d37;
  --adm-sidebar-title:#a7f3d0;
  --adm-sidebar-link:#d1fae5;
  --adm-sidebar-active:#fabb15;
  --adm-primary:#00703c;
  --adm-primary-grad:linear-gradient(135deg, #00703c, #10b981);
  --adm-accent:#fabb15;
  --adm-focus:rgba(0,112,60,0.35);
}
[data-theme="fintech"]{
  --adm-bg:#f8fafc;
  --adm-card-bg:#ffffff;
  --adm-text:#0f172a;
  --adm-muted:#64748b;
  --adm-border:#e2e8f0;
  --adm-sidebar:#0f172a;
  --adm-sidebar-border:#1e293b;
  --adm-sidebar-title:#94a3b8;
  --adm-sidebar-link:#cbd5e1;
  --adm-sidebar-active:#38bdf8;
  --adm-primary:#0284c7;
  --adm-primary-grad:linear-gradient(135deg, #0284c7, #38bdf8);
  --adm-accent:#38bdf8;
  --adm-focus:rgba(2,132,199,0.35);
}
[data-theme="dark"]{
  --adm-bg:#0b1120;
  --adm-card-bg:#1e293b;
  --adm-text:#f1f5f9;
  --adm-muted:#94a3b8;
  --adm-border:#334155;
  --adm-sidebar:#030712;
  --adm-sidebar-border:#1f2937;
  --adm-sidebar-title:#9ca3af;
  --adm-sidebar-link:#94a3b8;
  --adm-sidebar-active:#22c55e;
  --adm-primary:#16a34a;
  --adm-primary-grad:linear-gradient(135deg, #15803d, #22c55e);
  --adm-accent:#22c55e;
  --adm-focus:rgba(34,197,94,0.35);
}

/* Base & Typography */
.admin-page, .admin-page button, .admin-page input, .admin-page select, .admin-page textarea{
  margin:0;padding:0;background:var(--adm-bg);color:var(--adm-text);font-family:'Poppins',-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif
}
*:focus-visible{
  outline:2px solid var(--adm-primary) !important;
  outline-offset:2px !important;
}

/* Topbar */
.adm-topbar{
  position:fixed;top:0;left:0;right:0;z-index:1100;height:62px;
  background:var(--adm-card-bg);border-bottom:2px solid var(--adm-primary);
  display:flex;align-items:center;justify-content:space-between;
  padding:0 20px;box-shadow:0 2px 10px rgba(0,0,0,0.04);
}
.adm-topbar-left{display:flex;align-items:center;gap:12px}
.adm-menu-toggle{
  display:none;background:#f1f5f9;border:1px solid #cbd5e1;border-radius:8px;
  width:38px;height:38px;align-items:center;justify-content:center;
  font-size:18px;cursor:pointer;color:#0f172a;transition:all .15s;
}
.adm-menu-toggle:hover{background:#e2e8f0}
.adm-topbar-badge{
  background:var(--adm-primary-grad);color:#fff;padding:6px 14px;border-radius:8px;
  font-size:12.5px;font-weight:800;letter-spacing:.04em;display:flex;align-items:center;gap:7px;
  box-shadow:0 2px 6px rgba(0,112,60,0.2);
}
.adm-topbar-center{font-size:13.5px;color:var(--adm-muted)}
.adm-topbar-right{display:flex;align-items:center;gap:10px}
.adm-theme-picker{display:flex;align-items:center;gap:5px;background:#f1f5f9;padding:3px 8px;border-radius:20px;border:1px solid #e2e8f0}
[data-theme="dark"] .adm-theme-picker{background:#0f172a;border-color:#334155}
.adm-theme-btn{width:20px;height:20px;border-radius:50%;border:2px solid #fff;cursor:pointer;outline:none;transition:transform .15s}
.adm-theme-btn:hover{transform:scale(1.2)}
.adm-theme-emerald{background:#00703c}
.adm-theme-fintech{background:#0284c7}
.adm-theme-dark{background:#111827}

.adm-btn-student,.adm-btn-logout{
  padding:7px 14px;border-radius:8px;font-size:12.5px;font-weight:600;
  text-decoration:none;cursor:pointer;border:1px solid;display:inline-flex;
  align-items:center;gap:6px;transition:all .15s;
}
.adm-btn-student{background:#ecfdf5;color:#065f46;border-color:#a7f3d0}
.adm-btn-student:hover{background:#d1fae5}
.adm-btn-logout{background:#fef2f2;color:#991b1b;border-color:#fecaca}
.adm-btn-logout:hover{background:#fee2e2}

/* Sidebar Drawer & Backdrop */
.adm-sidebar-backdrop{
  display:none;position:fixed;top:0;left:0;right:0;bottom:0;
  background:rgba(15,23,42,0.55);backdrop-filter:blur(3px);z-index:1050;
  transition:opacity .2s ease;
}
.adm-sidebar-backdrop.active{display:block}

.adm-sidebar{
  position:fixed;top:62px;left:0;bottom:0;width:250px;
  background:var(--adm-sidebar);border-right:1px solid var(--adm-sidebar-border);
  overflow-y:auto;display:flex;flex-direction:column;
  box-shadow:2px 0 8px rgba(0,0,0,0.04);z-index:1060;transition:transform .25s cubic-bezier(0.4,0,0.2,1);
}
.adm-sidebar-nav{flex:1;padding:16px 0}
.adm-sidebar-title{padding:12px 20px 6px;font-size:10.5px;font-weight:800;color:var(--adm-sidebar-title);letter-spacing:.08em}
.adm-sidebar-link{
  display:flex;align-items:center;gap:10px;padding:11px 20px;
  color:var(--adm-sidebar-link);font-size:13.5px;text-decoration:none;
  border-left:4px solid transparent;cursor:pointer;transition:all .15s;
}
.adm-sidebar-link:hover{background:rgba(255,255,255,0.08);color:#fff}
.adm-sidebar-link.active{
  background:rgba(255,255,255,0.13);color:var(--adm-sidebar-active);
  border-left-color:var(--adm-sidebar-active);font-weight:700;
}
.adm-icon{width:22px;text-align:center;font-size:16px;display:inline-flex;align-items:center;justify-content:center}
.adm-sidebar-footer{
  padding:14px 20px;border-top:1px solid var(--adm-sidebar-border);
  display:flex;align-items:center;gap:10px;background:rgba(0,0,0,0.15);
}
.adm-sidebar-avatar{
  width:36px;height:36px;border-radius:50%;background:var(--adm-accent);
  color:#06402d;display:flex;align-items:center;justify-content:center;font-weight:800;
}
.adm-sidebar-user-name{color:#e2e8f0;font-size:13px;font-weight:600}
.adm-sidebar-user-role{font-size:10.5px;color:#06402d;background:#fabb15;padding:2px 8px;border-radius:99px;font-weight:800}

/* Main Layout */
.adm-main{margin-left:250px;margin-top:62px;padding:28px 32px 64px;min-height:calc(100vh - 62px)}
.adm-page-header{
  display:flex;justify-content:space-between;align-items:center;
  margin-bottom:22px;flex-wrap:wrap;gap:14px;
}
.adm-page-header h2{font-size:1.55rem;font-weight:800;color:var(--adm-text);margin:0;display:flex;align-items:center;gap:8px}
.adm-page-header p{font-size:.88rem;color:var(--adm-muted);margin:4px 0 0}

/* Flash Messages */
.adm-flash{
  padding:14px 18px;border-radius:10px;margin-bottom:22px;font-size:.9rem;
  font-weight:600;display:flex;align-items:center;justify-content:space-between;
}
.adm-flash.ok{background:#dcfce7;color:#166534;border:1px solid #bbf7d0}
.adm-flash.error{background:#fee2e2;color:#991b1b;border:1px solid #fecaca}
.adm-flash-close{background:none;border:none;cursor:pointer;font-size:16px;color:inherit;opacity:0.7}
.adm-flash-close:hover{opacity:1}

/* KPI Cards */
.adm-kpi-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(210px,1fr));gap:16px;margin-bottom:28px}
.adm-kpi{
  background:var(--adm-card-bg);border-radius:14px;padding:20px;
  border:1px solid var(--adm-border);position:relative;
  box-shadow:0 3px 12px rgba(6,64,45,0.03);transition:transform .15s,box-shadow .15s;
}
.adm-kpi:hover{transform:translateY(-2px);box-shadow:0 6px 16px rgba(6,64,45,0.08)}
.adm-kpi::before{content:'';position:absolute;top:0;left:0;right:0;height:4px;border-radius:14px 14px 0 0}
.adm-kpi.green::before{background:linear-gradient(90deg, #00703c, #10b981)}
.adm-kpi.purple::before{background:linear-gradient(90deg, #7c3aed, #a855f7)}
.adm-kpi.blue::before{background:linear-gradient(90deg, #0284c7, #38bdf8)}
.adm-kpi.gold::before{background:linear-gradient(90deg, #d97706, #fabb15)}
.adm-kpi-icon{font-size:22px;margin-bottom:6px;display:inline-flex;align-items:center;justify-content:center}
.adm-kpi-number{font-size:1.85rem;font-weight:800;color:var(--adm-text)}
.adm-kpi-label{font-size:.82rem;color:var(--adm-muted);margin-top:4px}

/* Tables & Cards */
.adm-table-card{
  background:var(--adm-card-bg);border:1px solid var(--adm-border);
  border-radius:14px;overflow:hidden;margin-bottom:24px;box-shadow:0 3px 12px rgba(0,0,0,0.02);
}
.adm-table-header{
  padding:16px 20px;display:flex;align-items:center;justify-content:space-between;
  gap:12px;border-bottom:1px solid var(--adm-border);flex-wrap:wrap;background:rgba(0,0,0,0.015);
}
.adm-table-header h3{font-size:1.02rem;font-weight:700;color:var(--adm-text);margin:0;display:flex;align-items:center;gap:6px}
.adm-table-actions{display:flex;gap:10px;align-items:center;flex-wrap:wrap}

/* Responsive Table Wrapper */
.adm-table-responsive{
  width:100%;overflow-x:auto;-webkit-overflow-scrolling:touch;
}
table.adm-table{width:100%;border-collapse:collapse;font-size:.85rem}
table.adm-table th,table.adm-table td{padding:12px 14px;text-align:left;border-bottom:1px solid var(--adm-border);vertical-align:middle}
table.adm-table th{background:rgba(0,0,0,0.025);color:var(--adm-muted);font-size:.73rem;font-weight:700;text-transform:uppercase;letter-spacing:.04em}
table.adm-table tr:hover td{background:rgba(0,0,0,0.015)}

/* Badges */
.adm-badge{display:inline-flex;align-items:center;gap:4px;padding:3px 10px;border-radius:999px;font-size:.72rem;font-weight:700}
.adm-badge.admin{background:#fef3c7;color:#92400e}.adm-badge.estudiante{background:#e0f2fe;color:#0369a1}
.adm-badge.activo{background:#dcfce7;color:#16a34a}.adm-badge.inactivo{background:#fee2e2;color:#dc2626}
.adm-badge.gratis{background:#f1f5f9;color:#475569}.adm-badge.pro{background:#fef3c7;color:#b45309}.adm-badge.premium{background:#ede9fe;color:#7c3aed}
.adm-badge.pill{background:#e2e8f0;color:#334155;border-radius:6px;padding:2px 8px;font-size:.74rem}
[data-theme="dark"] .adm-badge.pill{background:#334155;color:#e2e8f0}

/* User Avatars */
.adm-user-cell{display:flex;align-items:center;gap:10px}
.adm-user-avatar{width:32px;height:32px;border-radius:50%;background:#e0f2fe;color:#0369a1;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:700}
.adm-user-avatar.is-admin{background:#ede9fe;color:#7c3aed}

/* Inputs, Selects & Buttons */
.adm-role-select,.adm-input,.adm-search-input,.adm-filter-select,.adm-select{
  padding:8px 12px;border-radius:8px;border:1px solid #cbd5e1;background:#fff;
  font-size:.84rem;font-family:inherit;color:var(--adm-text);transition:border-color .15s,box-shadow .15s;
}
[data-theme="dark"] .adm-role-select,
[data-theme="dark"] .adm-input,
[data-theme="dark"] .adm-search-input,
[data-theme="dark"] .adm-filter-select,
[data-theme="dark"] .adm-select{
  background:#0f172a;border-color:#334155;color:#f1f5f9;
}
.adm-role-select:focus,.adm-input:focus,.adm-search-input:focus,.adm-filter-select:focus,.adm-select:focus{
  outline:none;border-color:var(--adm-primary);box-shadow:0 0 0 3px var(--adm-focus);
}
.adm-input{width:100%;box-sizing:border-box}

.adm-action-btn{
  display:inline-flex;align-items:center;gap:6px;padding:7px 14px;border-radius:8px;
  border:1px solid #cbd5e1;background:#fff;font-size:.8rem;font-weight:600;
  color:#334155;cursor:pointer;text-decoration:none;transition:all .15s;
}
[data-theme="dark"] .adm-action-btn{background:#0f172a;border-color:#334155;color:#e2e8f0}
.adm-action-btn:hover{background:#f8fafc;border-color:#94a3b8}
[data-theme="dark"] .adm-action-btn:hover{background:#1e293b}
.adm-action-btn.primary{
  background:var(--adm-primary-grad);color:#fff;border:none;box-shadow:0 2px 8px rgba(0,112,60,0.22);
}
.adm-action-btn.primary:hover{opacity:0.92;box-shadow:0 4px 12px rgba(0,112,60,0.3)}
.adm-action-btn.success{color:#15803d;border-color:#bbf7d0;background:#f0fdf4}
.adm-action-btn.success:hover{background:#dcfce7}
.adm-action-btn.danger{color:#b91c1c;border-color:#fecaca;background:#fef2f2}
.adm-action-btn.danger:hover{background:#fee2e2}
.adm-action-btn.warning{color:#b45309;border-color:#fde68a;background:#fffbeb}
.adm-action-btn.warning:hover{background:#fef3c7}

.adm-inline-form{display:inline-flex;gap:6px;flex-wrap:wrap;align-items:center;margin:0}
.adm-empty{text-align:center;color:var(--adm-muted);padding:32px;font-style:italic}
.adm-help{font-size:.78rem;color:var(--adm-muted);margin:6px 0 0}

/* Tab Panels */
.adm-tab-content{display:none}
.adm-tab-content.active{display:block}

/* Collapse / Form Box */
.adm-collapse-box{
  background:var(--adm-card-bg);border:2px dashed var(--adm-primary);
  border-radius:12px;padding:20px;margin-bottom:22px;box-shadow:0 4px 14px rgba(0,0,0,0.03);
}
.adm-form-group{margin-bottom:14px}
.adm-form-group label{display:block;font-size:.82rem;font-weight:700;color:var(--adm-text);margin-bottom:5px}
.adm-form-row{display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:12px}

/* Course Card Details */
.adm-course-card{
  display:flex;align-items:center;gap:18px;background:var(--adm-card-bg);
  border:1px solid var(--adm-border);border-radius:14px;padding:16px 20px;
  margin-bottom:20px;flex-wrap:wrap;box-shadow:0 3px 10px rgba(0,0,0,0.02);
}
.adm-course-thumb{
  width:95px;height:70px;border-radius:10px;object-fit:cover;
  background:#e2e8f0;display:flex;align-items:center;justify-content:center;
  color:var(--adm-muted);font-size:26px;border:1px solid var(--adm-border);
}
.adm-subtabs{display:flex;gap:8px;border-bottom:2px solid var(--adm-border);margin-bottom:20px;overflow-x:auto}
.adm-subtab-btn{
  padding:10px 16px;font-size:.86rem;font-weight:600;color:var(--adm-muted);
  background:none;border:none;border-bottom:3px solid transparent;cursor:pointer;
  white-space:nowrap;transition:color .15s;
}
.adm-subtab-btn:hover{color:var(--adm-primary)}
.adm-subtab-btn.active{color:var(--adm-primary);border-bottom-color:var(--adm-primary);font-weight:700}
.adm-subcontent{display:none}
.adm-subcontent.active{display:block}
.adm-edit-details summary{cursor:pointer;color:var(--adm-primary);font-weight:700;font-size:.82rem;padding:4px 0}

/* Memberships and Config */
.adm-mem-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:16px}
.adm-mem-card{
  background:var(--adm-card-bg);border:1px solid var(--adm-border);border-radius:14px;
  padding:22px;text-align:center;box-shadow:0 2px 8px rgba(0,0,0,0.02);
}
.mem-icon{font-size:32px;margin-bottom:8px}
.mem-desc{font-size:.82rem;color:var(--adm-muted)}
.adm-quick-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:12px;margin-top:16px}
.adm-quick-btn{
  display:flex;align-items:center;gap:10px;padding:14px 16px;border-radius:12px;
  background:var(--adm-card-bg);border:1px solid var(--adm-border);font-weight:600;
  color:var(--adm-text);cursor:pointer;text-decoration:none;transition:all .15s;
}
.adm-quick-btn:hover{border-color:var(--adm-primary);background:#f0fdf4;box-shadow:0 3px 10px rgba(0,112,60,0.08)}
[data-theme="dark"] .adm-quick-btn:hover{background:#1e293b}

.adm-config-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:20px;margin-bottom:24px}
.adm-config-card{background:var(--adm-card-bg);border:1px solid var(--adm-border);border-radius:14px;padding:22px;box-shadow:0 2px 8px rgba(0,0,0,0.02)}
.adm-config-card h3{font-size:1.05rem;font-weight:700;color:var(--adm-text);margin:0 0 16px;border-bottom:1px solid var(--adm-border);padding-bottom:10px}
.adm-check-row{
  display:flex;align-items:flex-start;gap:10px;padding:10px 12px;
  border:1px solid var(--adm-border);border-radius:10px;background:rgba(0,0,0,0.015);margin-bottom:12px;
}
.adm-check-row small{display:block;color:var(--adm-muted);font-weight:400}

/* Responsive Breakpoints */
@media(max-width:900px){
  .adm-menu-toggle{display:inline-flex}
  .adm-sidebar{
    transform:translateX(-100%);z-index:1200;width:270px;
  }
  .adm-sidebar.open{
    transform:translateX(0);box-shadow:4px 0 24px rgba(0,0,0,0.35);
  }
  .adm-main{margin-left:0;padding:20px 16px 48px}
  .adm-topbar-center{display:none}
}
@media(max-width:550px){
  .adm-topbar-badge span{display:none}
  .adm-page-header h2{font-size:1.3rem}
  .adm-btn-student span{display:none}
}
</style>

<!-- Backdrop overlay para sidebar en móviles -->
<div id="admSidebarBackdrop" class="adm-sidebar-backdrop" onclick="toggleAdminSidebar(false)" aria-hidden="true"></div>

<!-- Topbar -->
<header class="adm-topbar" role="banner">
  <div class="adm-topbar-left">
    <button class="adm-menu-toggle" id="admMenuToggle" onclick="toggleAdminSidebar()" aria-label="Abrir menú de navegación" aria-expanded="false">
      <i class="fi fi-rr-menu-burger"></i>
    </button>
    <div class="adm-topbar-badge">
      <svg viewBox="0 0 240 210" style="width:20px;height:18px" fill="none" aria-hidden="true"><rect x="26" y="162" width="188" height="30" rx="8" fill="#fabb15"/><path d="M120,14 L216,58 L120,102 L24,58 Z" fill="#ffffff"/></svg>
      <span>PANEL ADMINISTRATIVO</span>
    </div>
  </div>
  <div class="adm-topbar-center">Bienvenido, <strong><?= $adminName ?></strong> (Super Admin)</div>
  <div class="adm-topbar-right">
    <div class="adm-theme-picker" title="Cambiar tema visual" role="group" aria-label="Selector de tema">
      <span style="font-size:11px;font-weight:700;color:var(--adm-muted);margin-right:3px">Tema:</span>
      <button class="adm-theme-btn adm-theme-emerald" onclick="setAdminTheme('emerald')" title="Esmeralda & Oro" aria-label="Tema Esmeralda"></button>
      <button class="adm-theme-btn adm-theme-fintech" onclick="setAdminTheme('fintech')" title="Azul Fintech" aria-label="Tema Azul Fintech"></button>
      <button class="adm-theme-btn adm-theme-dark" onclick="setAdminTheme('dark')" title="Modo Oscuro" aria-label="Tema Modo Oscuro"></button>
    </div>
    <a href="index.php?page=aula" class="adm-btn-student" target="_blank" title="Abrir vista de estudiante en el aula virtual"><i class="fi fi-rr-graduation-cap"></i> <span>Ir al Aula</span></a>
    <button class="adm-btn-logout" onclick="adminLogout()" title="Cerrar sesión de administrador"><i class="fi fi-rr-sign-out-alt"></i> <span>Salir</span></button>
  </div>
</header>

<!-- Sidebar de Navegación -->
<aside class="adm-sidebar" id="admSidebar" aria-label="Menú principal de administración">
  <nav class="adm-sidebar-nav" role="tablist" aria-orientation="vertical">
    <div class="adm-sidebar-title">PANEL PRINCIPAL</div>
    <a class="adm-sidebar-link active" id="tab-btn-dashboard" role="tab" aria-selected="true" aria-controls="tab-dashboard" data-tab="dashboard" onclick="showAdminTab('dashboard')" tabindex="0">
      <i class="fi fi-rr-chart-pie adm-icon"></i> Resumen General
    </a>
    
    <div class="adm-sidebar-title">ACADÉMICO Y MULTIMEDIA</div>
    <a class="adm-sidebar-link" id="tab-btn-contenido" role="tab" aria-selected="false" aria-controls="tab-contenido" data-tab="contenido" onclick="showAdminTab('contenido')" tabindex="0">
      <i class="fi fi-rr-film adm-icon"></i> Cursos y Contenidos
    </a>
    <a class="adm-sidebar-link" id="tab-btn-inscripciones" role="tab" aria-selected="false" aria-controls="tab-inscripciones" data-tab="inscripciones" onclick="showAdminTab('inscripciones')" tabindex="0">
      <i class="fi fi-rr-document-signed adm-icon"></i> Inscripciones
    </a>
    <a class="adm-sidebar-link" id="tab-btn-progreso" role="tab" aria-selected="false" aria-controls="tab-progreso" data-tab="progreso" onclick="showAdminTab('progreso')" tabindex="0">
      <i class="fi fi-rr-chart-histogram adm-icon"></i> Progreso Alumnos
    </a>
    <a class="adm-sidebar-link" id="tab-btn-logros" role="tab" aria-selected="false" aria-controls="tab-logros" data-tab="logros" onclick="showAdminTab('logros')" tabindex="0">
      <i class="fi fi-rr-trophy adm-icon"></i> Logros y Medallas
    </a>
    
    <div class="adm-sidebar-title">USUARIOS Y ACCESOS</div>
    <a class="adm-sidebar-link" id="tab-btn-usuarios" role="tab" aria-selected="false" aria-controls="tab-usuarios" data-tab="usuarios" onclick="showAdminTab('usuarios')" tabindex="0">
      <i class="fi fi-rr-users-alt adm-icon"></i> Usuarios y Alumnos
    </a>
    <a class="adm-sidebar-link" id="tab-btn-membresias" role="tab" aria-selected="false" aria-controls="tab-membresias" data-tab="membresias" onclick="showAdminTab('membresias')" tabindex="0">
      <i class="fi fi-rr-credit-card adm-icon"></i> Membresías y Planes
    </a>
    
    <div class="adm-sidebar-title">SISTEMA Y CONTROL</div>
    <a class="adm-sidebar-link" id="tab-btn-auditoria" role="tab" aria-selected="false" aria-controls="tab-auditoria" data-tab="auditoria" onclick="showAdminTab('auditoria')" tabindex="0">
      <i class="fi fi-rr-shield-check adm-icon"></i> Auditoría de Seguridad
    </a>
    <a class="adm-sidebar-link" id="tab-btn-config" role="tab" aria-selected="false" aria-controls="tab-config" data-tab="config" onclick="showAdminTab('config')" tabindex="0">
      <i class="fi fi-rr-settings adm-icon"></i> Configuración Global
    </a>
  </nav>
  <div class="adm-sidebar-footer">
    <div class="adm-sidebar-avatar"><?= strtoupper(mb_substr($adminName,0,1)) ?></div>
    <div>
      <div class="adm-sidebar-user-name"><?= $adminName ?></div>
      <span class="adm-sidebar-user-role">Administrador</span>
    </div>
  </div>
</aside>

<!-- Contenido Principal -->
<main class="adm-main" id="adminMain">
  <?php if (!empty($flash)): ?>
    <div class="adm-flash <?= htmlspecialchars($flash['tipo']) ?>" role="alert">
      <div style="display:flex;align-items:center;gap:8px">
        <i class="fi <?= $flash['tipo'] === 'ok' ? 'fi-rr-check-circle' : 'fi-rr-exclamation' ?>"></i>
        <span><?= htmlspecialchars($flash['texto']) ?></span>
      </div>
      <button class="adm-flash-close" onclick="this.parentElement.remove()" aria-label="Cerrar notificación">&times;</button>
    </div>
  <?php endif; ?>

  <!-- ── 1. RESUMEN GENERAL ────────────────────────────────────────── -->
  <section id="tab-dashboard" class="adm-tab-content active" role="tabpanel" aria-labelledby="tab-btn-dashboard" tabindex="0">
    <div class="adm-page-header">
      <div>
        <h2><i class="fi fi-rr-chart-pie" style="color:var(--adm-primary)"></i> Resumen General</h2>
        <p>Visión completa de estudiantes, cursos, materiales multimedia y rendimiento académico</p>
      </div>
    </div>
    
    <div class="adm-kpi-grid">
      <div class="adm-kpi green"><div class="adm-kpi-icon"><i class="fi fi-rr-users-alt"></i></div><div class="adm-kpi-number"><?= $totalEstudiantes ?></div><div class="adm-kpi-label">Estudiantes registrados</div></div>
      <div class="adm-kpi purple"><div class="adm-kpi-icon"><i class="fi fi-rr-shield-check"></i></div><div class="adm-kpi-number"><?= $totalAdmins ?></div><div class="adm-kpi-label">Administradores</div></div>
      <div class="adm-kpi blue"><div class="adm-kpi-icon"><i class="fi fi-rr-book-alt"></i></div><div class="adm-kpi-number"><?= $totalCursosActivos ?> / <?= $totalCursos ?></div><div class="adm-kpi-label">Cursos activos</div></div>
      <div class="adm-kpi gold"><div class="adm-kpi-icon"><i class="fi fi-rr-video-camera-alt"></i></div><div class="adm-kpi-number"><?= $totalLecciones ?></div><div class="adm-kpi-label">Videos y Lecciones</div></div>
      <div class="adm-kpi green"><div class="adm-kpi-icon"><i class="fi fi-rr-book-open-cover"></i></div><div class="adm-kpi-number"><?= $totalLibros ?></div><div class="adm-kpi-label">Libros y Ebooks</div></div>
      <div class="adm-kpi purple"><div class="adm-kpi-icon"><i class="fi fi-rr-headphones"></i></div><div class="adm-kpi-number"><?= $totalAudios ?></div><div class="adm-kpi-label">Audios Educativos</div></div>
      <div class="adm-kpi blue"><div class="adm-kpi-icon"><i class="fi fi-rr-edit"></i></div><div class="adm-kpi-number"><?= $totalEjercicios ?></div><div class="adm-kpi-label">Ejercicios y Prácticas</div></div>
      <div class="adm-kpi gold"><div class="adm-kpi-icon"><i class="fi fi-rr-credit-card"></i></div><div class="adm-kpi-number"><?= $totalMembresias ?></div><div class="adm-kpi-label">Membresías activas</div></div>
    </div>

    <div class="adm-table-card">
      <div class="adm-table-header"><h3><i class="fi fi-sr-bolt" style="color:#f5b800"></i> Accesos Rápidos y Gestión Inmediata</h3></div>
      <div style="padding:18px 20px">
        <div class="adm-quick-grid" style="margin-top:0">
          <a class="adm-quick-btn" onclick="showAdminTab('contenido')"><i class="fi fi-rr-film" style="font-size:20px;color:var(--adm-primary)"></i> Gestionar Cursos y Videos</a>
          <a class="adm-quick-btn" onclick="showAdminTab('usuarios')"><i class="fi fi-rr-users-alt" style="font-size:20px;color:#0284c7"></i> Control de Alumnos</a>
          <a class="adm-quick-btn" href="index.php?page=admin/exportar-pdf&tipo=usuarios" target="_blank"><i class="fi fi-rr-file-pdf" style="font-size:20px;color:#ef4444"></i> Reporte Alumnos (PDF)</a>
          <a class="adm-quick-btn" href="index.php?page=admin/exportar-pdf&tipo=progreso" target="_blank"><i class="fi fi-rr-file-pdf" style="font-size:20px;color:#ef4444"></i> Reporte Avances (PDF)</a>
          <a class="adm-quick-btn" onclick="showAdminTab('config')"><i class="fi fi-rr-bullhorn" style="font-size:20px;color:#f59e0b"></i> Publicar Aviso Global</a>
        </div>
      </div>
    </div>
  </section>

  <!-- ── 2. GESTIÓN DE CURSOS Y CONTENIDOS MULTIMEDIA ─────────────── -->
  <section id="tab-contenido" class="adm-tab-content" role="tabpanel" aria-labelledby="tab-btn-contenido" tabindex="0">
    <div class="adm-page-header">
      <div>
        <h2><i class="fi fi-rr-film" style="color:var(--adm-primary)"></i> Cursos y Contenidos Multimedia</h2>
        <p>Administra los cursos, materias, videos, libros (PDF), audios y ejercicios de la escuela</p>
      </div>
      <div style="display:flex;gap:10px;align-items:center;flex-wrap:wrap">
        <button type="button" class="adm-action-btn primary" onclick="toggleElem('box-nuevo-curso')">
          <i class="fi fi-rr-plus"></i> + Crear Nuevo Curso
        </button>
        <form method="get" action="index.php" class="adm-inline-form">
          <input type="hidden" name="page" value="admin">
          <input type="hidden" name="tab" value="contenido">
          <label for="admSelectCurso" style="font-size:.85rem;font-weight:700;color:var(--adm-text)">Curso:</label>
          <select id="admSelectCurso" name="curso_id" class="adm-role-select" onchange="this.form.submit()" style="font-weight:600;min-width:240px">
            <?php foreach ($cursos as $cur): ?>
              <option value="<?= (int)$cur['id'] ?>" <?= (int)$cur['id'] === $selectedCursoId ? 'selected' : '' ?>>
                <?= htmlspecialchars($cur['titulo']) ?> (Sem. <?= (int)$cur['semestre'] ?>)
              </option>
            <?php endforeach; ?>
          </select>
        </form>
      </div>
    </div>

    <!-- Caja colapsable para CREAR NUEVO CURSO -->
    <div id="box-nuevo-curso" class="adm-collapse-box" style="display:none">
      <h3 style="margin:0 0 14px;color:var(--adm-text);font-size:1.1rem;display:flex;align-items:center;gap:8px">
        <i class="fi fi-rr-book-alt" style="color:var(--adm-primary)"></i> Crear Nuevo Curso / Materia
      </h3>
      <form method="post" action="index.php?page=admin/cursos/crear" enctype="multipart/form-data">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf) ?>">
        <div class="adm-form-row" style="margin-bottom:12px">
          <div class="adm-form-group">
            <label for="nc_codigo">Código Único (ej: FIN101)</label>
            <input id="nc_codigo" class="adm-input" name="codigo" required placeholder="FIN101">
          </div>
          <div class="adm-form-group">
            <label for="nc_titulo">Título del Curso</label>
            <input id="nc_titulo" class="adm-input" name="titulo" required placeholder="Ej: Fundamentos de Educación Financiera">
          </div>
          <div class="adm-form-group">
            <label for="nc_semestre">Semestre</label>
            <select id="nc_semestre" class="adm-select" name="semestre">
              <?php for ($s = 1; $s <= 8; $s++): ?>
                <option value="<?= $s ?>">Semestre <?= $s ?></option>
              <?php endfor; ?>
            </select>
          </div>
        </div>

        <div class="adm-form-row" style="margin-bottom:12px">
          <div class="adm-form-group">
            <label for="nc_categoria">Categoría</label>
            <input id="nc_categoria" class="adm-input" name="categoria" value="Finanzas Personales" required placeholder="Ahorro, Inversión, etc.">
          </div>
          <div class="adm-form-group">
            <label for="nc_nivel">Nivel</label>
            <select id="nc_nivel" class="adm-select" name="nivel">
              <option value="principiante" selected>Principiante</option>
              <option value="intermedio">Intermedio</option>
              <option value="avanzado">Avanzado</option>
            </select>
          </div>
          <div class="adm-form-group">
            <label for="nc_horas">Duración en Horas</label>
            <input id="nc_horas" class="adm-input" type="number" step="0.5" name="duracion_horas" value="12.0">
          </div>
          <div class="adm-form-group">
            <label for="nc_orden">Orden en Retícula</label>
            <input id="nc_orden" class="adm-input" type="number" name="orden" value="<?= count($cursos) + 1 ?>">
          </div>
        </div>

        <div class="adm-form-row" style="margin-bottom:12px">
          <div class="adm-form-group">
            <label for="nc_imagen">Imagen de Portada (JPG, PNG, WEBP)</label>
            <input id="nc_imagen" class="adm-input" type="file" name="imagen" accept="image/*">
          </div>
          <div class="adm-form-group" style="display:flex;align-items:center;padding-top:24px">
            <label style="display:flex;align-items:center;gap:8px;cursor:pointer">
              <input type="checkbox" name="activo" value="1" checked style="width:18px;height:18px">
              <strong>Curso Activo y Disponible para Alumnos</strong>
            </label>
          </div>
        </div>

        <div class="adm-form-group">
          <label for="nc_desc">Descripción General del Curso</label>
          <textarea id="nc_desc" class="adm-input" name="descripcion" rows="3" placeholder="Objetivos pedagógicos, competencias que desarrollará el alumno..."></textarea>
        </div>

        <div style="display:flex;gap:10px">
          <button type="submit" class="adm-action-btn primary"><i class="fi fi-rr-check"></i> Guardar Curso</button>
          <button type="button" class="adm-action-btn" onclick="toggleElem('box-nuevo-curso')">Cancelar</button>
        </div>
      </form>
    </div>

    <?php if ($selectedCurso): ?>
      <!-- Tarjeta resumen del curso seleccionado -->
      <div class="adm-course-card">
        <?php if (!empty($selectedCurso['imagen_url'])): ?>
          <img src="<?= htmlspecialchars($selectedCurso['imagen_url']) ?>" class="adm-course-thumb" alt="Portada de <?= htmlspecialchars($selectedCurso['titulo']) ?>">
        <?php else: ?>
          <div class="adm-course-thumb"><i class="fi fi-rr-book-alt"></i></div>
        <?php endif; ?>
        <div style="flex:1">
          <div style="font-size:1.18rem;font-weight:800;color:var(--adm-text)"><?= htmlspecialchars($selectedCurso['titulo']) ?></div>
          <div style="font-size:.84rem;color:var(--adm-muted);margin-top:3px">
            Código: <strong><?= htmlspecialchars($selectedCurso['codigo']) ?></strong> · 
            Semestre: <strong><?= (int)$selectedCurso['semestre'] ?></strong> · 
            Nivel: <strong><?= ucfirst(htmlspecialchars($selectedCurso['nivel'])) ?></strong> · 
            Categoría: <strong><?= htmlspecialchars($selectedCurso['categoria']) ?></strong> · 
            Estado: <span class="adm-badge <?= $selectedCurso['activo'] ? 'activo' : 'inactivo' ?>"><?= $selectedCurso['activo'] ? 'Activo' : 'Inactivo' ?></span>
          </div>
        </div>
        <div style="display:flex;gap:8px;flex-wrap:wrap">
          <button type="button" class="adm-action-btn warning" onclick="toggleElem('box-editar-curso')">
            <i class="fi fi-rr-edit"></i> Editar Curso
          </button>
          <form method="post" action="index.php?page=admin/cursos/eliminar" class="adm-inline-form" onsubmit="return confirm('¿Eliminar el curso <?= htmlspecialchars(addslashes($selectedCurso['titulo'])) ?> y todo su contenido?');">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf) ?>">
            <input type="hidden" name="id" value="<?= (int)$selectedCurso['id'] ?>">
            <button class="adm-action-btn danger" title="Eliminar este curso"><i class="fi fi-rr-trash"></i> Eliminar</button>
          </form>
          <a href="index.php?page=aula" target="_blank" class="adm-action-btn"><i class="fi fi-rr-eye"></i> Ver en Aula</a>
        </div>
      </div>

      <!-- Caja colapsable para EDITAR CURSO SELECCIONADO -->
      <div id="box-editar-curso" class="adm-collapse-box" style="display:none">
        <h3 style="margin:0 0 14px;color:var(--adm-text);font-size:1.1rem;display:flex;align-items:center;gap:8px">
          <i class="fi fi-rr-edit" style="color:#d97706"></i> Editar Datos del Curso #<?= (int)$selectedCurso['id'] ?>: <?= htmlspecialchars($selectedCurso['titulo']) ?>
        </h3>
        <form method="post" action="index.php?page=admin/cursos/actualizar" enctype="multipart/form-data">
          <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf) ?>">
          <input type="hidden" name="id" value="<?= (int)$selectedCurso['id'] ?>">
          <div class="adm-form-row" style="margin-bottom:12px">
            <div class="adm-form-group">
              <label>Código del Curso</label>
              <input class="adm-input" name="codigo" value="<?= htmlspecialchars($selectedCurso['codigo']) ?>" required>
            </div>
            <div class="adm-form-group">
              <label>Título del Curso</label>
              <input class="adm-input" name="titulo" value="<?= htmlspecialchars($selectedCurso['titulo']) ?>" required>
            </div>
            <div class="adm-form-group">
              <label>Semestre</label>
              <select class="adm-select" name="semestre">
                <?php for ($s = 1; $s <= 8; $s++): ?>
                  <option value="<?= $s ?>" <?= (int)$selectedCurso['semestre'] === $s ? 'selected' : '' ?>>Semestre <?= $s ?></option>
                <?php endfor; ?>
              </select>
            </div>
          </div>

          <div class="adm-form-row" style="margin-bottom:12px">
            <div class="adm-form-group">
              <label>Categoría</label>
              <input class="adm-input" name="categoria" value="<?= htmlspecialchars($selectedCurso['categoria']) ?>" required>
            </div>
            <div class="adm-form-group">
              <label>Nivel</label>
              <select class="adm-select" name="nivel">
                <option value="principiante" <?= $selectedCurso['nivel'] === 'principiante' ? 'selected' : '' ?>>Principiante</option>
                <option value="intermedio" <?= $selectedCurso['nivel'] === 'intermedio' ? 'selected' : '' ?>>Intermedio</option>
                <option value="avanzado" <?= $selectedCurso['nivel'] === 'avanzado' ? 'selected' : '' ?>>Avanzado</option>
              </select>
            </div>
            <div class="adm-form-group">
              <label>Duración en Horas</label>
              <input class="adm-input" type="number" step="0.5" name="duracion_horas" value="<?= htmlspecialchars((string)($selectedCurso['duracion_horas'] ?? 1.0)) ?>">
            </div>
            <div class="adm-form-group">
              <label>Orden</label>
              <input class="adm-input" type="number" name="orden" value="<?= (int)($selectedCurso['orden'] ?? 0) ?>">
            </div>
          </div>

          <div class="adm-form-row" style="margin-bottom:12px">
            <div class="adm-form-group">
              <label>Reemplazar Imagen de Portada</label>
              <input class="adm-input" type="file" name="imagen" accept="image/*">
            </div>
            <div class="adm-form-group" style="display:flex;align-items:center;padding-top:24px">
              <label style="display:flex;align-items:center;gap:8px;cursor:pointer">
                <input type="checkbox" name="activo" value="1" <?= $selectedCurso['activo'] ? 'checked' : '' ?> style="width:18px;height:18px">
                <strong>Curso Activo</strong>
              </label>
            </div>
          </div>

          <div class="adm-form-group">
            <label>Descripción</label>
            <textarea class="adm-input" name="descripcion" rows="3"><?= htmlspecialchars((string)$selectedCurso['descripcion']) ?></textarea>
          </div>

          <div style="display:flex;gap:10px">
            <button type="submit" class="adm-action-btn primary"><i class="fi fi-rr-disk"></i> Guardar Cambios del Curso</button>
            <button type="button" class="adm-action-btn" onclick="toggleElem('box-editar-curso')">Cancelar</button>
          </div>
        </form>
      </div>

      <!-- Sub-pestañas de contenidos del curso -->
      <div class="adm-subtabs" role="tablist" aria-label="Contenidos multimedia del curso">
        <button class="adm-subtab-btn active" data-sub="videos" onclick="showSubTab('videos')">
          <i class="fi fi-rr-video-camera-alt"></i> Videos y Lecciones (<?= count($leccionesCurso) ?>)
        </button>
        <button class="adm-subtab-btn" data-sub="libros" onclick="showSubTab('libros')">
          <i class="fi fi-rr-book-open-cover"></i> Libros y Ebooks (<?= count($librosCurso) ?>)
        </button>
        <button class="adm-subtab-btn" data-sub="audios" onclick="showSubTab('audios')">
          <i class="fi fi-rr-headphones"></i> Audios y Podcasts (<?= count($audiosCurso) ?>)
        </button>
        <button class="adm-subtab-btn" data-sub="ejercicios" onclick="showSubTab('ejercicios')">
          <i class="fi fi-rr-edit"></i> Ejercicios y Quizzes (<?= count($ejerciciosCurso) ?>)
        </button>
      </div>

      <!-- SUB-TAB: VIDEOS / LECCIONES -->
      <div id="sub-videos" class="adm-subcontent active">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:14px;flex-wrap:wrap;gap:8px">
          <h3 style="margin:0;font-size:1.05rem;color:var(--adm-text)">Lista de Lecciones y Clases Grabadas</h3>
          <button class="adm-action-btn primary" onclick="toggleElem('box-nueva-leccion')"><i class="fi fi-rr-plus"></i> Agregar Nueva Lección</button>
        </div>

        <div id="box-nueva-leccion" class="adm-collapse-box" style="display:none">
          <h4 style="margin:0 0 12px;color:var(--adm-text)">Nueva Lección en: <em><?= htmlspecialchars($selectedCurso['titulo']) ?></em></h4>
          <form method="post" action="index.php?page=admin/lecciones/crear">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf) ?>">
            <input type="hidden" name="curso_id" value="<?= (int)$selectedCurso['id'] ?>">
            <div class="adm-form-row" style="margin-bottom:10px">
              <div class="adm-form-group"><label>Título de la Lección</label><input class="adm-input" name="titulo" required placeholder="Ej: Fundamentos del Ahorro Inteligente"></div>
              <div class="adm-form-group"><label>Duración (ej: 14:30)</label><input class="adm-input" name="duracion" value="15:00"></div>
              <div class="adm-form-group"><label>Orden</label><input class="adm-input" type="number" name="orden" value="<?= count($leccionesCurso) + 1 ?>"></div>
            </div>
            <div class="adm-form-group">
              <label>URL del Video (YouTube, Vimeo o URL directa MP4)</label>
              <input class="adm-input" name="video_url" placeholder="https://www.youtube.com/watch?v=... o https://player.vimeo.com/video/...">
            </div>
            <div class="adm-form-group">
              <label>Notas / Resumen / Instrucciones de la clase</label>
              <textarea class="adm-input" name="contenido" rows="3" placeholder="Puntos clave de la lección, notas o resumen para el estudiante..."></textarea>
            </div>
            <div style="display:flex;gap:10px">
              <button class="adm-action-btn primary">Guardar Lección</button>
              <button type="button" class="adm-action-btn" onclick="toggleElem('box-nueva-leccion')">Cancelar</button>
            </div>
          </form>
        </div>

        <div class="adm-table-card">
          <div class="adm-table-responsive">
            <table class="adm-table">
              <thead>
                <tr>
                  <th style="width:70px">Orden</th>
                  <th>Lección</th>
                  <th>Duración</th>
                  <th>Video</th>
                  <th>Estado</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php if (empty($leccionesCurso)): ?>
                  <tr><td colspan="6" class="adm-empty">No hay lecciones registradas en este curso.</td></tr>
                <?php else: foreach ($leccionesCurso as $lec): ?>
                  <tr>
                    <td style="font-weight:700;color:var(--adm-muted)">#<?= (int)$lec['orden'] ?></td>
                    <td>
                      <div style="font-weight:700;color:var(--adm-text)"><?= htmlspecialchars($lec['titulo']) ?></div>
                      <div style="font-size:.78rem;color:var(--adm-muted);max-width:320px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">
                        <?= htmlspecialchars($lec['contenido'] ?: 'Sin notas') ?>
                      </div>
                    </td>
                    <td><span class="adm-badge pill">⏱ <?= htmlspecialchars($lec['duracion']) ?></span></td>
                    <td>
                      <?php if (!empty($lec['video_url'])): ?>
                        <a href="<?= htmlspecialchars($lec['video_url']) ?>" target="_blank" style="color:#0ea5e9;font-weight:600;font-size:.82rem" title="<?= htmlspecialchars($lec['video_url']) ?>">
                          ▶ Ver enlace
                        </a>
                      <?php else: ?>
                        <span style="color:#94a3b8;font-size:.8rem">Sin video</span>
                      <?php endif; ?>
                    </td>
                    <td><span class="adm-badge <?= $lec['activo'] ? 'activo' : 'inactivo' ?>"><?= $lec['activo'] ? 'Activa' : 'Inactiva' ?></span></td>
                    <td>
                      <div style="display:flex;gap:6px">
                        <details class="adm-edit-details">
                          <summary>Editar</summary>
                          <form method="post" action="index.php?page=admin/lecciones/actualizar" style="margin-top:8px;background:var(--adm-card-bg);border:1px solid var(--adm-border);padding:12px;border-radius:8px">
                            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf) ?>">
                            <input type="hidden" name="leccion_id" value="<?= (int)$lec['id'] ?>">
                            <input type="hidden" name="curso_id" value="<?= (int)$selectedCurso['id'] ?>">
                            <div class="adm-form-group"><label>Título</label><input class="adm-input" name="titulo" value="<?= htmlspecialchars($lec['titulo']) ?>" required></div>
                            <div class="adm-form-row" style="margin-bottom:8px">
                              <div class="adm-form-group"><label>Duración</label><input class="adm-input" name="duracion" value="<?= htmlspecialchars($lec['duracion']) ?>"></div>
                              <div class="adm-form-group"><label>Orden</label><input class="adm-input" type="number" name="orden" value="<?= (int)$lec['orden'] ?>"></div>
                              <div class="adm-form-group"><label>Activo</label><select class="adm-input" name="activo"><option value="1" <?= $lec['activo']?'selected':'' ?>>Sí</option><option value="0" <?= !$lec['activo']?'selected':'' ?>>No</option></select></div>
                            </div>
                            <div class="adm-form-group"><label>Video URL</label><input class="adm-input" name="video_url" value="<?= htmlspecialchars((string)($lec['video_url']??'')) ?>"></div>
                            <div class="adm-form-group"><label>Contenido</label><textarea class="adm-input" name="contenido" rows="2"><?= htmlspecialchars((string)$lec['contenido']) ?></textarea></div>
                            <button class="adm-action-btn success">Guardar Cambios</button>
                          </form>
                        </details>
                        <form method="post" action="index.php?page=admin/lecciones/eliminar" class="adm-inline-form" onsubmit="return confirm('¿Eliminar esta lección?');">
                          <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf) ?>">
                          <input type="hidden" name="leccion_id" value="<?= (int)$lec['id'] ?>">
                          <input type="hidden" name="curso_id" value="<?= (int)$selectedCurso['id'] ?>">
                          <button class="adm-action-btn danger" title="Eliminar"><i class="fi fi-rr-trash"></i></button>
                        </form>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- SUB-TAB: LIBROS / EBOOKS -->
      <div id="sub-libros" class="adm-subcontent">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:14px;flex-wrap:wrap;gap:8px">
          <h3 style="margin:0;font-size:1.05rem;color:var(--adm-text)">Libros, Ebooks y Manuales en PDF</h3>
          <button class="adm-action-btn primary" onclick="toggleElem('box-nuevo-libro')"><i class="fi fi-rr-plus"></i> Agregar Libro / Ebook</button>
        </div>

        <div id="box-nuevo-libro" class="adm-collapse-box" style="display:none">
          <h4 style="margin:0 0 12px;color:var(--adm-text)">Añadir Libro a: <em><?= htmlspecialchars($selectedCurso['titulo']) ?></em></h4>
          <form method="post" action="index.php?page=admin/libros/crear" enctype="multipart/form-data">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf) ?>">
            <input type="hidden" name="curso_id" value="<?= (int)$selectedCurso['id'] ?>">
            <div class="adm-form-row" style="margin-bottom:10px">
              <div class="adm-form-group"><label>Título del Libro</label><input class="adm-input" name="titulo" required placeholder="Ej: La Psicología del Dinero"></div>
              <div class="adm-form-group"><label>Autor</label><input class="adm-input" name="autor" placeholder="Morgan Housel"></div>
              <div class="adm-form-group"><label>Tipo</label>
                <select class="adm-input" name="tipo">
                  <option value="ebook">Ebook / Libro digital</option>
                  <option value="manual">Manual de Trabajo</option>
                  <option value="guia">Guía Rápida / Resumen</option>
                  <option value="lectura">Lectura Complementaria</option>
                </select>
              </div>
              <div class="adm-form-group"><label>Orden</label><input class="adm-input" type="number" name="orden" value="<?= count($librosCurso) + 1 ?>"></div>
            </div>
            <div class="adm-form-row" style="margin-bottom:10px">
              <div class="adm-form-group">
                <label>Subir Archivo PDF</label>
                <input class="adm-input" type="file" name="archivo_file" accept=".pdf">
              </div>
              <div class="adm-form-group">
                <label>O Enlace URL Directo al PDF</label>
                <input class="adm-input" name="archivo_url" placeholder="https://... o ruta del archivo">
              </div>
            </div>
            <div class="adm-form-group">
              <label>Descripción / Sinopsis</label>
              <textarea class="adm-input" name="descripcion" rows="2" placeholder="Resumen del material para el alumno..."></textarea>
            </div>
            <div style="display:flex;gap:10px">
              <button class="adm-action-btn primary">Guardar Libro</button>
              <button type="button" class="adm-action-btn" onclick="toggleElem('box-nuevo-libro')">Cancelar</button>
            </div>
          </form>
        </div>

        <div class="adm-table-card">
          <div class="adm-table-responsive">
            <table class="adm-table">
              <thead>
                <tr>
                  <th style="width:70px">Orden</th>
                  <th>Libro / Material</th>
                  <th>Autor</th>
                  <th>Tipo</th>
                  <th>Archivo PDF</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php if (empty($librosCurso)): ?>
                  <tr><td colspan="6" class="adm-empty">No hay libros registrados en este curso.</td></tr>
                <?php else: foreach ($librosCurso as $lib): ?>
                  <tr>
                    <td style="font-weight:700;color:var(--adm-muted)">#<?= (int)$lib['orden'] ?></td>
                    <td>
                      <div style="font-weight:700;color:var(--adm-text)"><i class="fi fi-rr-file-pdf" style="color:#ef4444;margin-right:4px;"></i> <?= htmlspecialchars($lib['titulo']) ?></div>
                      <div style="font-size:.78rem;color:var(--adm-muted)"><?= htmlspecialchars($lib['descripcion'] ?: 'Sin descripción') ?></div>
                    </td>
                    <td><?= htmlspecialchars($lib['autor'] ?: 'Anónimo') ?></td>
                    <td><span class="adm-badge pill"><?= ucfirst(htmlspecialchars($lib['tipo'])) ?></span></td>
                    <td>
                      <?php if (!empty($lib['archivo_url'])): ?>
                        <a href="<?= htmlspecialchars($lib['archivo_url']) ?>" target="_blank" style="color:#0ea5e9;font-weight:600;font-size:.82rem">
                          <i class="fi fi-rr-download" style="margin-right:4px;"></i> Descargar PDF
                        </a>
                      <?php else: ?>
                        <span style="color:#94a3b8;font-size:.8rem">Sin archivo</span>
                      <?php endif; ?>
                    </td>
                    <td>
                      <div style="display:flex;gap:6px">
                        <details class="adm-edit-details">
                          <summary>Editar</summary>
                          <form method="post" action="index.php?page=admin/libros/actualizar" enctype="multipart/form-data" style="margin-top:8px;background:var(--adm-card-bg);border:1px solid var(--adm-border);padding:12px;border-radius:8px">
                            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf) ?>">
                            <input type="hidden" name="libro_id" value="<?= (int)$lib['id'] ?>">
                            <input type="hidden" name="curso_id" value="<?= (int)$selectedCurso['id'] ?>">
                            <div class="adm-form-group"><label>Título</label><input class="adm-input" name="titulo" value="<?= htmlspecialchars($lib['titulo']) ?>" required></div>
                            <div class="adm-form-row" style="margin-bottom:8px">
                              <div class="adm-form-group"><label>Autor</label><input class="adm-input" name="autor" value="<?= htmlspecialchars($lib['autor']) ?>"></div>
                              <div class="adm-form-group"><label>Tipo</label><input class="adm-input" name="tipo" value="<?= htmlspecialchars($lib['tipo']) ?>"></div>
                              <div class="adm-form-group"><label>Orden</label><input class="adm-input" type="number" name="orden" value="<?= (int)$lib['orden'] ?>"></div>
                            </div>
                            <div class="adm-form-group">
                              <label>Cambiar Archivo (PDF)</label>
                              <input class="adm-input" type="file" name="archivo_file" accept=".pdf" style="margin-bottom:4px">
                              <input class="adm-input" name="archivo_url" value="<?= htmlspecialchars((string)($lib['archivo_url']??'')) ?>" placeholder="O enlace URL">
                            </div>
                            <div class="adm-form-group"><label>Descripción</label><textarea class="adm-input" name="descripcion" rows="2"><?= htmlspecialchars((string)$lib['descripcion']) ?></textarea></div>
                            <button class="adm-action-btn success">Guardar Cambios</button>
                          </form>
                        </details>
                        <form method="post" action="index.php?page=admin/libros/eliminar" class="adm-inline-form" onsubmit="return confirm('¿Eliminar este libro?');">
                          <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf) ?>">
                          <input type="hidden" name="libro_id" value="<?= (int)$lib['id'] ?>">
                          <input type="hidden" name="curso_id" value="<?= (int)$selectedCurso['id'] ?>">
                          <button class="adm-action-btn danger" title="Eliminar"><i class="fi fi-rr-trash"></i></button>
                        </form>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- SUB-TAB: AUDIOS / PODCASTS -->
      <div id="sub-audios" class="adm-subcontent">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:14px;flex-wrap:wrap;gap:8px">
          <h3 style="margin:0;font-size:1.05rem;color:var(--adm-text)">Audios y Podcasts Educativos</h3>
          <button class="adm-action-btn primary" onclick="toggleElem('box-nuevo-audio')"><i class="fi fi-rr-plus"></i> Agregar Audio</button>
        </div>

        <div id="box-nuevo-audio" class="adm-collapse-box" style="display:none">
          <h4 style="margin:0 0 12px;color:var(--adm-text)">Añadir Audio a: <em><?= htmlspecialchars($selectedCurso['titulo']) ?></em></h4>
          <form method="post" action="index.php?page=admin/audios/crear" enctype="multipart/form-data">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf) ?>">
            <input type="hidden" name="curso_id" value="<?= (int)$selectedCurso['id'] ?>">
            <div class="adm-form-row" style="margin-bottom:10px">
              <div class="adm-form-group"><label>Título del Audio</label><input class="adm-input" name="titulo" required placeholder="Ej: Hábitos Financieros Explicados"></div>
              <div class="adm-form-group"><label>Duración (ej: 20:00)</label><input class="adm-input" name="duracion" value="20:00"></div>
              <div class="adm-form-group"><label>Orden</label><input class="adm-input" type="number" name="orden" value="<?= count($audiosCurso) + 1 ?>"></div>
            </div>
            <div class="adm-form-row" style="margin-bottom:10px">
              <div class="adm-form-group">
                <label>Subir Archivo de Audio (MP3, WAV, OGG, M4A)</label>
                <input class="adm-input" type="file" name="audio_file" accept="audio/*">
              </div>
              <div class="adm-form-group">
                <label>O Enlace URL del Audio</label>
                <input class="adm-input" name="audio_url" placeholder="https://... o ruta del archivo">
              </div>
            </div>
            <div class="adm-form-group">
              <label>Descripción / Notas</label>
              <textarea class="adm-input" name="descripcion" rows="2" placeholder="Resumen de los temas tratados..."></textarea>
            </div>
            <div style="display:flex;gap:10px">
              <button class="adm-action-btn primary">Guardar Audio</button>
              <button type="button" class="adm-action-btn" onclick="toggleElem('box-nuevo-audio')">Cancelar</button>
            </div>
          </form>
        </div>

        <div class="adm-table-card">
          <div class="adm-table-responsive">
            <table class="adm-table">
              <thead>
                <tr>
                  <th style="width:70px">Orden</th>
                  <th>Audio</th>
                  <th>Duración</th>
                  <th>Reproductor</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php if (empty($audiosCurso)): ?>
                  <tr><td colspan="5" class="adm-empty">No hay audios registrados en este curso.</td></tr>
                <?php else: foreach ($audiosCurso as $aud): ?>
                  <tr>
                    <td style="font-weight:700;color:var(--adm-muted)">#<?= (int)$aud['orden'] ?></td>
                    <td>
                      <div style="font-weight:700;color:var(--adm-text)"><i class="fi fi-rr-headphones"></i> <?= htmlspecialchars($aud['titulo']) ?></div>
                      <div style="font-size:.78rem;color:var(--adm-muted)"><?= htmlspecialchars($aud['descripcion'] ?: 'Sin notas') ?></div>
                    </td>
                    <td><span class="adm-badge pill">⏱ <?= htmlspecialchars($aud['duracion']) ?></span></td>
                    <td>
                      <?php if (!empty($aud['audio_url'])): ?>
                        <audio controls style="height:32px;max-width:220px">
                          <source src="<?= htmlspecialchars($aud['audio_url']) ?>">
                          Audio no soportado.
                        </audio>
                      <?php else: ?>
                        <span style="color:#94a3b8;font-size:.8rem">Sin audio</span>
                      <?php endif; ?>
                    </td>
                    <td>
                      <div style="display:flex;gap:6px">
                        <details class="adm-edit-details">
                          <summary>Editar</summary>
                          <form method="post" action="index.php?page=admin/audios/actualizar" enctype="multipart/form-data" style="margin-top:8px;background:var(--adm-card-bg);border:1px solid var(--adm-border);padding:12px;border-radius:8px">
                            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf) ?>">
                            <input type="hidden" name="audio_id" value="<?= (int)$aud['id'] ?>">
                            <input type="hidden" name="curso_id" value="<?= (int)$selectedCurso['id'] ?>">
                            <div class="adm-form-group"><label>Título</label><input class="adm-input" name="titulo" value="<?= htmlspecialchars($aud['titulo']) ?>" required></div>
                            <div class="adm-form-row" style="margin-bottom:8px">
                              <div class="adm-form-group"><label>Duración</label><input class="adm-input" name="duracion" value="<?= htmlspecialchars($aud['duracion']) ?>"></div>
                              <div class="adm-form-group"><label>Orden</label><input class="adm-input" type="number" name="orden" value="<?= (int)$aud['orden'] ?>"></div>
                            </div>
                            <div class="adm-form-group">
                              <label>Cambiar Archivo de Audio</label>
                              <input class="adm-input" type="file" name="audio_file" accept="audio/*" style="margin-bottom:4px">
                              <input class="adm-input" name="audio_url" value="<?= htmlspecialchars((string)($aud['audio_url']??'')) ?>">
                            </div>
                            <div class="adm-form-group"><label>Descripción</label><textarea class="adm-input" name="descripcion" rows="2"><?= htmlspecialchars((string)$aud['descripcion']) ?></textarea></div>
                            <button class="adm-action-btn success">Guardar Cambios</button>
                          </form>
                        </details>
                        <form method="post" action="index.php?page=admin/audios/eliminar" class="adm-inline-form" onsubmit="return confirm('¿Eliminar este audio?');">
                          <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf) ?>">
                          <input type="hidden" name="audio_id" value="<?= (int)$aud['id'] ?>">
                          <input type="hidden" name="curso_id" value="<?= (int)$selectedCurso['id'] ?>">
                          <button class="adm-action-btn danger" title="Eliminar"><i class="fi fi-rr-trash"></i></button>
                        </form>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- SUB-TAB: EJERCICIOS / QUIZZES -->
      <div id="sub-ejercicios" class="adm-subcontent">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:14px;flex-wrap:wrap;gap:8px">
          <h3 style="margin:0;font-size:1.05rem;color:var(--adm-text)">Ejercicios Prácticos, Evaluaciones y Simulaciones</h3>
          <button class="adm-action-btn primary" onclick="toggleElem('box-nuevo-ejercicio')"><i class="fi fi-rr-plus"></i> Agregar Ejercicio</button>
        </div>

        <div id="box-nuevo-ejercicio" class="adm-collapse-box" style="display:none">
          <h4 style="margin:0 0 12px;color:var(--adm-text)">Nuevo Ejercicio en: <em><?= htmlspecialchars($selectedCurso['titulo']) ?></em></h4>
          <form method="post" action="index.php?page=admin/ejercicios/crear">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf) ?>">
            <input type="hidden" name="curso_id" value="<?= (int)$selectedCurso['id'] ?>">
            <div class="adm-form-row" style="margin-bottom:10px">
              <div class="adm-form-group"><label>Título del Ejercicio</label><input class="adm-input" name="titulo" required placeholder="Ej: Simulación de Presupuesto Mensual"></div>
              <div class="adm-form-group"><label>Tipo de ejercicio</label>
                <select class="adm-input" name="tipo">
                  <option value="practica">Práctica interactiva</option>
                  <option value="quiz">Cuestionario / Quiz</option>
                  <option value="simulacion">Simulador Financiero</option>
                  <option value="reto">Reto semanal</option>
                </select>
              </div>
              <div class="adm-form-group"><label>Orden</label><input class="adm-input" type="number" name="orden" value="<?= count($ejerciciosCurso) + 1 ?>"></div>
            </div>
            <div class="adm-form-group">
              <label>Instrucciones y Desarrollo de la Actividad</label>
              <textarea class="adm-input" name="descripcion" rows="3" required placeholder="Instrucciones paso a paso de lo que debe realizar el estudiante..."></textarea>
            </div>
            <div style="display:flex;gap:10px">
              <button class="adm-action-btn primary">Guardar Ejercicio</button>
              <button type="button" class="adm-action-btn" onclick="toggleElem('box-nuevo-ejercicio')">Cancelar</button>
            </div>
          </form>
        </div>

        <div class="adm-table-card">
          <div class="adm-table-responsive">
            <table class="adm-table">
              <thead>
                <tr>
                  <th style="width:70px">Orden</th>
                  <th>Ejercicio</th>
                  <th>Tipo</th>
                  <th>Instrucciones</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php if (empty($ejerciciosCurso)): ?>
                  <tr><td colspan="5" class="adm-empty">No hay ejercicios registrados en este curso.</td></tr>
                <?php else: foreach ($ejerciciosCurso as $ej): ?>
                  <tr>
                    <td style="font-weight:700;color:var(--adm-muted)">#<?= (int)$ej['orden'] ?></td>
                    <td><div style="font-weight:700;color:var(--adm-text)"><i class="fi fi-rr-edit" style="color:#6366f1;margin-right:4px;"></i> <?= htmlspecialchars($ej['titulo']) ?></div></td>
                    <td><span class="adm-badge pill"><?= ucfirst(htmlspecialchars($ej['tipo'])) ?></span></td>
                    <td style="font-size:.82rem;color:var(--adm-muted);max-width:350px">
                      <?= htmlspecialchars(mb_strimwidth($ej['descripcion'], 0, 110, '...')) ?>
                    </td>
                    <td>
                      <div style="display:flex;gap:6px">
                        <details class="adm-edit-details">
                          <summary>Editar</summary>
                          <form method="post" action="index.php?page=admin/ejercicios/actualizar" style="margin-top:8px;background:var(--adm-card-bg);border:1px solid var(--adm-border);padding:12px;border-radius:8px">
                            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf) ?>">
                            <input type="hidden" name="ejercicio_id" value="<?= (int)$ej['id'] ?>">
                            <input type="hidden" name="curso_id" value="<?= (int)$selectedCurso['id'] ?>">
                            <div class="adm-form-group"><label>Título</label><input class="adm-input" name="titulo" value="<?= htmlspecialchars($ej['titulo']) ?>" required></div>
                            <div class="adm-form-row" style="margin-bottom:8px">
                              <div class="adm-form-group"><label>Tipo</label><input class="adm-input" name="tipo" value="<?= htmlspecialchars($ej['tipo']) ?>"></div>
                              <div class="adm-form-group"><label>Orden</label><input class="adm-input" type="number" name="orden" value="<?= (int)$ej['orden'] ?>"></div>
                            </div>
                            <div class="adm-form-group"><label>Instrucciones</label><textarea class="adm-input" name="descripcion" rows="3" required><?= htmlspecialchars($ej['descripcion']) ?></textarea></div>
                            <button class="adm-action-btn success">Guardar Cambios</button>
                          </form>
                        </details>
                        <form method="post" action="index.php?page=admin/ejercicios/eliminar" class="adm-inline-form" onsubmit="return confirm('¿Eliminar este ejercicio?');">
                          <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf) ?>">
                          <input type="hidden" name="ejercicio_id" value="<?= (int)$ej['id'] ?>">
                          <input type="hidden" name="curso_id" value="<?= (int)$selectedCurso['id'] ?>">
                          <button class="adm-action-btn danger" title="Eliminar"><i class="fi fi-rr-trash"></i></button>
                        </form>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    <?php else: ?>
      <div class="adm-table-card" style="padding:40px;text-align:center">
        <div style="font-size:42px;color:var(--adm-muted);margin-bottom:12px"><i class="fi fi-rr-book-alt"></i></div>
        <h3 style="color:var(--adm-text);margin-bottom:8px">No hay cursos registrados o ninguno ha sido seleccionado</h3>
        <p style="color:var(--adm-muted);margin-bottom:18px">Puedes crear tu primer curso o materia para estructurar los semestres de la escuela financiera.</p>
        <button class="adm-action-btn primary" onclick="toggleElem('box-nuevo-curso')"><i class="fi fi-rr-plus"></i> Crear Primer Curso</button>
      </div>
    <?php endif; ?>
  </section>

  <!-- ── 3. GESTIÓN DE USUARIOS Y ESTUDIANTES ──────────────────────── -->
  <section id="tab-usuarios" class="adm-tab-content" role="tabpanel" aria-labelledby="tab-btn-usuarios" tabindex="0">
    <div class="adm-page-header">
      <div>
        <h2><i class="fi fi-rr-users-alt" style="color:var(--adm-primary)"></i> Directorio de Usuarios y Alumnos</h2>
        <p><?= $totalUsuarios ?> cuentas registradas (<?= $totalEstudiantes ?> estudiantes, <?= $totalAdmins ?> administradores)</p>
      </div>
      <div style="display:flex;gap:8px;flex-wrap:wrap">
        <button type="button" class="adm-action-btn success" onclick="toggleElem('box-nuevo-usuario')">
          <i class="fi fi-rr-user-add"></i> + Registrar Nuevo Alumno
        </button>
        <a href="index.php?page=admin/exportar-pdf&tipo=usuarios" target="_blank" class="adm-action-btn primary">
          <i class="fi fi-rr-file-pdf"></i> Reporte en PDF
        </a>
        <a href="index.php?page=admin/exportar&tipo=usuarios" class="adm-action-btn" title="Descargar versión Excel CSV">
          <i class="fi fi-rr-file-spreadsheet"></i> Excel (.csv)
        </a>
      </div>
    </div>

    <!-- Formulario colapsable para crear usuario -->
    <div id="box-nuevo-usuario" class="adm-collapse-box" style="display:none">
      <h3 style="margin:0 0 12px;color:var(--adm-text);font-size:1.1rem;display:flex;align-items:center;gap:8px">
        <i class="fi fi-rr-user-add" style="color:#16a34a"></i> Registrar Nuevo Alumno o Administrador
      </h3>
      <form method="post" action="index.php?page=admin/usuarios/crear">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf) ?>">
        <div class="adm-form-row" style="margin-bottom:12px">
          <div class="adm-form-group">
            <label for="nu_nombre">Nombre Completo</label>
            <input id="nu_nombre" class="adm-input" name="nombre" required placeholder="Ej: Carlos Ramírez Morales">
          </div>
          <div class="adm-form-group">
            <label for="nu_email">Correo Electrónico</label>
            <input id="nu_email" class="adm-input" type="email" name="email" required placeholder="alumno@correo.com">
          </div>
          <div class="adm-form-group">
            <label for="nu_pass">Contraseña Inicial (mín. 6 caracteres)</label>
            <input id="nu_pass" class="adm-input" type="password" name="password" minlength="6" required placeholder="••••••••">
          </div>
        </div>
        <div class="adm-form-row" style="margin-bottom:14px">
          <div class="adm-form-group">
            <label for="nu_rol">Rol en la Plataforma</label>
            <select id="nu_rol" name="rol" class="adm-select">
              <option value="estudiante" selected>Estudiante (Acceso al Aula)</option>
              <option value="admin">Administrador (Acceso Total y Panel)</option>
            </select>
          </div>
          <div class="adm-form-group">
            <label for="nu_mem">Membresía Inicial</label>
            <select id="nu_mem" name="tipo_membresia" class="adm-select">
              <option value="gratis" selected>Gratis (1 mes de prueba con acceso inicial)</option>
              <option value="pro">Pro (Acceso ilimitado por semestres)</option>
              <option value="premium">Premium (Acceso total anual + tutorías)</option>
            </select>
          </div>
        </div>
        <div style="display:flex;gap:10px">
          <button type="submit" class="adm-action-btn success"><i class="fi fi-rr-check"></i> Registrar Usuario</button>
          <button type="button" class="adm-action-btn" onclick="toggleElem('box-nuevo-usuario')">Cancelar</button>
        </div>
      </form>
    </div>
    
    <div class="adm-table-card">
      <div class="adm-table-header">
        <h3>Lista General de Usuarios (<span id="userCountVisible"><?= count($usuarios) ?></span>)</h3>
        <div class="adm-table-actions">
          <input id="userSearch" class="adm-search-input" placeholder="Buscar por nombre o correo..." oninput="filtrarUsuarios()" aria-label="Buscar usuarios">
          <select id="rolFilter" class="adm-filter-select" onchange="filtrarUsuarios()" aria-label="Filtrar por rol">
            <option value="">Todos los roles</option>
            <option value="estudiante">Solo Estudiantes</option>
            <option value="admin">Solo Administradores</option>
          </select>
        </div>
      </div>
      <div class="adm-table-responsive">
        <table class="adm-table">
          <thead>
            <tr>
              <th style="width:60px">ID</th>
              <th>Usuario</th>
              <th>Email</th>
              <th>Rol</th>
              <th>Fecha Registro</th>
              <th>Estado</th>
              <th>Cambiar Rol</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody id="usersTableBody">
            <?php if (empty($usuarios)): ?>
              <tr><td colspan="8" class="adm-empty">No hay usuarios registrados en el sistema.</td></tr>
            <?php else: foreach ($usuarios as $u): 
              $ini = strtoupper(mb_substr($u['nombre'],0,1)); 
              $isAdmin = $u['rol'] === 'admin'; 
              $isSelf = (int)$u['id'] === (int)($user['id'] ?? 0); 
            ?>
              <tr class="user-row" data-nombre="<?= htmlspecialchars(strtolower($u['nombre'])) ?>" data-email="<?= htmlspecialchars(strtolower($u['email'])) ?>" data-rol="<?= htmlspecialchars($u['rol']) ?>">
                <td style="font-weight:700;color:var(--adm-muted)">#<?= (int)$u['id'] ?></td>
                <td>
                  <div class="adm-user-cell">
                    <div class="adm-user-avatar <?= $isAdmin ? 'is-admin' : '' ?>"><?= $ini ?></div>
                    <span style="font-weight:600;color:var(--adm-text)"><?= htmlspecialchars($u['nombre']) ?></span>
                  </div>
                </td>
                <td style="color:var(--adm-muted)"><?= htmlspecialchars($u['email']) ?></td>
                <td><span class="adm-badge <?= htmlspecialchars($u['rol']) ?>"><?= $isAdmin ? 'Admin' : 'Estudiante' ?></span></td>
                <td style="color:var(--adm-muted);font-size:.82rem"><?= date('d/m/Y H:i', strtotime($u['fecha_creacion'])) ?></td>
                <td><span class="adm-badge <?= $u['activo'] ? 'activo' : 'inactivo' ?>"><?= $u['activo'] ? 'Activo' : 'Inactivo' ?></span></td>
                <td>
                  <form method="post" action="index.php?page=admin/usuarios/rol" class="adm-inline-form">
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf) ?>">
                    <input type="hidden" name="usuario_id" value="<?= (int)$u['id'] ?>">
                    <select name="rol" class="adm-role-select" onchange="this.form.submit()" <?= $isSelf ? 'disabled' : '' ?>>
                      <option value="estudiante" <?= $u['rol']==='estudiante'?'selected':'' ?>>Estudiante</option>
                      <option value="admin" <?= $u['rol']==='admin'?'selected':'' ?>>Admin</option>
                    </select>
                  </form>
                </td>
                <td>
                  <div style="display:flex;gap:6px;align-items:center">
                    <button type="button" class="adm-action-btn" style="background:#0284c7;color:#fff;" onclick="toggleElem('edit-user-<?= (int)$u['id'] ?>')" title="Editar datos del usuario">
                      <i class="fi fi-rr-edit"></i> Editar
                    </button>
                    <form method="post" action="index.php?page=admin/usuarios/estado" class="adm-inline-form">
                      <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf) ?>">
                      <input type="hidden" name="usuario_id" value="<?= (int)$u['id'] ?>">
                      <input type="hidden" name="activo" value="<?= $u['activo'] ? '0' : '1' ?>">
                      <button class="adm-action-btn <?= $u['activo'] ? 'danger' : 'success' ?>" <?= $isSelf ? 'disabled' : '' ?>>
                        <?= $u['activo'] ? 'Desactivar' : 'Activar' ?>
                      </button>
                    </form>
                    <form method="post" action="index.php?page=admin/usuarios/eliminar" class="adm-inline-form" onsubmit="return confirm('¿Seguro que deseas eliminar definitivamente a <?= htmlspecialchars(addslashes($u['nombre'])) ?>?');">
                      <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf) ?>">
                      <input type="hidden" name="usuario_id" value="<?= (int)$u['id'] ?>">
                      <button class="adm-action-btn danger" <?= $isSelf ? 'disabled' : '' ?> title="Eliminar"><i class="fi fi-rr-trash"></i></button>
                    </form>
                  </div>
                </td>
              </tr>
              <!-- Formulario de edición expandible para el usuario -->
              <tr id="edit-user-<?= (int)$u['id'] ?>" style="display:none;background:rgba(0,0,0,0.02)">
                <td colspan="8" style="padding:16px;">
                  <form method="post" action="index.php?page=admin/usuarios/editar" style="background:var(--adm-card-bg);border:1px solid var(--adm-border);padding:18px;border-radius:10px;text-align:left;">
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf) ?>">
                    <input type="hidden" name="usuario_id" value="<?= (int)$u['id'] ?>">
                    <h4 style="margin:0 0 12px;color:var(--adm-text);font-size:0.98rem;display:flex;align-items:center;gap:6px">
                      <i class="fi fi-rr-edit" style="color:#0284c7"></i> Editar Usuario #<?= (int)$u['id'] ?>: <?= htmlspecialchars($u['nombre']) ?>
                    </h4>
                    <div class="adm-form-row" style="margin-bottom:10px">
                      <div class="adm-form-group">
                        <label>Nombre Completo</label>
                        <input class="adm-input" name="nombre" value="<?= htmlspecialchars($u['nombre']) ?>" required>
                      </div>
                      <div class="adm-form-group">
                        <label>Email</label>
                        <input class="adm-input" type="email" name="email" value="<?= htmlspecialchars($u['email']) ?>" required>
                      </div>
                      <div class="adm-form-group">
                        <label>Nueva Contraseña (dejar en blanco para conservar actual)</label>
                        <input class="adm-input" type="password" name="password" placeholder="Nueva contraseña (opcional)">
                      </div>
                    </div>
                    <div class="adm-form-row" style="margin-bottom:12px">
                      <div class="adm-form-group">
                        <label>Rol de Usuario</label>
                        <select name="rol" class="adm-select" <?= $isSelf ? 'disabled' : '' ?>>
                          <option value="estudiante" <?= $u['rol']==='estudiante'?'selected':'' ?>>Estudiante</option>
                          <option value="admin" <?= $u['rol']==='admin'?'selected':'' ?>>Administrador</option>
                        </select>
                      </div>
                    </div>
                    <div style="display:flex;gap:10px">
                      <button type="submit" class="adm-action-btn primary"><i class="fi fi-rr-disk"></i> Guardar Cambios</button>
                      <button type="button" class="adm-action-btn" onclick="toggleElem('edit-user-<?= (int)$u['id'] ?>')">Cancelar</button>
                    </div>
                  </form>
                </td>
              </tr>
            <?php endforeach; endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- ── 4. INSCRIPCIONES ─────────────────────────────────────────── -->
  <section id="tab-inscripciones" class="adm-tab-content" role="tabpanel" aria-labelledby="tab-btn-inscripciones" tabindex="0">
    <div class="adm-page-header">
      <div>
        <h2><i class="fi fi-rr-document-signed" style="color:var(--adm-primary)"></i> Inscripciones de Alumnos</h2>
        <p>Materias y asignaturas inscritas por los estudiantes en la retícula académica</p>
      </div>
      <div style="display:flex;gap:8px;flex-wrap:wrap">
        <a href="index.php?page=admin/exportar-pdf&tipo=inscripciones" target="_blank" class="adm-action-btn primary">
          <i class="fi fi-rr-file-pdf"></i> Reporte en PDF
        </a>
        <a href="index.php?page=admin/exportar&tipo=inscripciones" class="adm-action-btn" title="Descargar versión Excel">
          <i class="fi fi-rr-file-spreadsheet"></i> Excel (.csv)
        </a>
      </div>
    </div>
    
    <div class="adm-table-card">
      <div class="adm-table-header">
        <h3>Historial de Inscripciones (<span id="inscCountVisible"><?= $totalInscripciones ?></span>)</h3>
        <div class="adm-table-actions">
          <input id="inscSearch" class="adm-search-input" placeholder="Buscar por alumno o materia..." oninput="filtrarInscripciones()" aria-label="Buscar inscripciones">
        </div>
      </div>
      <div class="adm-table-responsive">
        <table class="adm-table">
          <thead>
            <tr>
              <th style="width:60px">ID</th>
              <th>Estudiante</th>
              <th>Email</th>
              <th>Materia / Clave</th>
              <th>Semestre</th>
              <th>Fecha Inscripción</th>
            </tr>
          </thead>
          <tbody id="inscTableBody">
            <?php if (empty($inscripciones)): ?>
              <tr><td colspan="6" class="adm-empty">No hay inscripciones registradas.</td></tr>
            <?php else: foreach ($inscripciones as $i): ?>
              <tr class="insc-row" data-estudiante="<?= htmlspecialchars(strtolower($i['usuario_nombre'])) ?>" data-materia="<?= htmlspecialchars(strtolower($i['materia_id'])) ?>">
                <td style="font-weight:700;color:var(--adm-muted)">#<?= (int)$i['id'] ?></td>
                <td style="font-weight:600;color:var(--adm-text)"><?= htmlspecialchars($i['usuario_nombre']) ?></td>
                <td style="color:var(--adm-muted)"><?= htmlspecialchars($i['usuario_email']) ?></td>
                <td><span class="adm-badge estudiante"><?= htmlspecialchars($i['materia_id']) ?></span></td>
                <td>Semestre <?= (int)$i['semestre'] ?></td>
                <td style="color:var(--adm-muted);font-size:.82rem"><?= date('d/m/Y H:i', strtotime($i['fecha_inscripcion'])) ?></td>
              </tr>
            <?php endforeach; endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- ── 5. PROGRESO DE ESTUDIANTES ───────────────────────────────── -->
  <section id="tab-progreso" class="adm-tab-content" role="tabpanel" aria-labelledby="tab-btn-progreso" tabindex="0">
    <div class="adm-page-header">
      <div>
        <h2><i class="fi fi-rr-chart-histogram" style="color:var(--adm-primary)"></i> Progreso y Rendimiento Académico</h2>
        <p>Monitorea qué porcentaje lleva completado cada alumno en los cursos matriculados</p>
      </div>
      <div style="display:flex;gap:8px;flex-wrap:wrap">
        <a href="index.php?page=admin/exportar-pdf&tipo=progreso" target="_blank" class="adm-action-btn primary">
          <i class="fi fi-rr-file-pdf"></i> Reporte en PDF
        </a>
        <a href="index.php?page=admin/exportar&tipo=progreso" class="adm-action-btn" title="Descargar versión Excel">
          <i class="fi fi-rr-file-spreadsheet"></i> Excel (.csv)
        </a>
      </div>
    </div>

    <div class="adm-table-card">
      <div class="adm-table-header">
        <h3>Avance por Curso y Alumno (<span id="progCountVisible"><?= $totalProgresos ?></span>)</h3>
        <div class="adm-table-actions">
          <input id="progSearch" class="adm-search-input" placeholder="Buscar por alumno o curso..." oninput="filtrarProgreso()" aria-label="Buscar avance">
        </div>
      </div>
      <div class="adm-table-responsive">
        <table class="adm-table">
          <thead>
            <tr>
              <th>Estudiante</th>
              <th>Curso</th>
              <th>Porcentaje de Avance</th>
              <th>Estado</th>
              <th>Última Actividad</th>
            </tr>
          </thead>
          <tbody id="progTableBody">
            <?php if (empty($progresos)): ?>
              <tr><td colspan="5" class="adm-empty">No hay registros de progreso aún.</td></tr>
            <?php else: foreach ($progresos as $p): 
              $pct = (float)$p['porcentaje']; 
              $done = $pct >= 100 || (int)$p['completado'] === 1; 
            ?>
              <tr class="prog-row" data-estudiante="<?= htmlspecialchars(strtolower($p['usuario_nombre'])) ?>" data-curso="<?= htmlspecialchars(strtolower($p['curso_titulo'])) ?>">
                <td>
                  <div style="font-weight:600;color:var(--adm-text)"><?= htmlspecialchars($p['usuario_nombre']) ?></div>
                  <div style="font-size:.75rem;color:var(--adm-muted)"><?= htmlspecialchars($p['usuario_email']) ?></div>
                </td>
                <td>
                  <div style="font-weight:600;color:var(--adm-text)"><?= htmlspecialchars($p['curso_titulo']) ?></div>
                  <div style="font-size:.75rem;color:var(--adm-muted)"><?= htmlspecialchars($p['curso_codigo']) ?></div>
                </td>
                <td style="min-width:140px">
                  <div style="font-weight:700;color:var(--adm-text);margin-bottom:4px"><?= number_format($pct,0) ?>%</div>
                  <div style="background:#e2e8f0;border-radius:99px;height:8px;overflow:hidden">
                    <div style="background:<?= $done ? '#10b981' : '#0284c7' ?>;height:100%;width:<?= min(100,max(0,$pct)) ?>%"></div>
                  </div>
                </td>
                <td><span class="adm-badge <?= $done ? 'activo' : 'estudiante' ?>"><?= $done ? 'Completado' : 'En curso' ?></span></td>
                <td style="color:var(--adm-muted);font-size:.82rem"><?= htmlspecialchars($p['fecha_actualizacion'] ?? '-') ?></td>
              </tr>
            <?php endforeach; endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- ── 6. LOGROS Y GAMIFICACIÓN ─────────────────────────────────── -->
  <section id="tab-logros" class="adm-tab-content" role="tabpanel" aria-labelledby="tab-btn-logros" tabindex="0">
    <div class="adm-page-header">
      <div>
        <h2><i class="fi fi-rr-trophy" style="color:#f59e0b"></i> Logros e Insignias (Gamificación)</h2>
        <p>Insignias y medallas que los alumnos desbloquean al completar retos y acumular puntos</p>
      </div>
      <div>
        <button class="adm-action-btn primary" onclick="toggleElem('box-nuevo-logro')"><i class="fi fi-rr-plus"></i> Crear Nuevo Logro</button>
      </div>
    </div>

    <!-- Formulario para crear logro -->
    <div id="box-nuevo-logro" class="adm-collapse-box" style="display:none">
      <h3 style="margin:0 0 12px;color:var(--adm-text)"><i class="fi fi-rr-trophy" style="color:#f5b800;margin-right:6px;"></i> Crear Nueva Insignia o Logro</h3>
      <form method="post" action="index.php?page=admin/logros/crear">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf) ?>">
        <div class="adm-form-row" style="margin-bottom:10px">
          <div class="adm-form-group"><label>Nombre del Logro</label><input class="adm-input" name="nombre" required placeholder="Ej: Maestro del Presupuesto"></div>
          <div class="adm-form-group"><label>Icono (ej: fi-rr-trophy, fi-rr-medal)</label><input class="adm-input" name="icono" value="fi-rr-medal" required></div>
          <div class="adm-form-group"><label>Puntos requeridos</label><input class="adm-input" type="number" name="puntos_requeridos" value="100" min="0"></div>
          <div class="adm-form-group"><label>Cursos completados requeridos</label><input class="adm-input" type="number" name="cursos_requeridos" placeholder="Opcional"></div>
        </div>
        <div class="adm-form-group">
          <label>Descripción del Logro</label>
          <textarea class="adm-input" name="descripcion" rows="2" required placeholder="Explica cómo se desbloquea esta medalla..."></textarea>
        </div>
        <div style="display:flex;gap:10px">
          <button class="adm-action-btn primary">Guardar Logro</button>
          <button type="button" class="adm-action-btn" onclick="toggleElem('box-nuevo-logro')">Cancelar</button>
        </div>
      </form>
    </div>

    <div class="adm-table-card">
      <div class="adm-table-header"><h3>Catálogo de Insignias y Logros (<?= count($logros) ?>)</h3></div>
      <div class="adm-table-responsive">
        <table class="adm-table">
          <thead>
            <tr>
              <th style="width:60px">ID</th>
              <th>Insignia y Nombre</th>
              <th>Requisitos</th>
              <th>Alumnos Desbloqueados</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php if (empty($logros)): ?>
              <tr><td colspan="6" class="adm-empty">No hay logros registrados.</td></tr>
            <?php else: foreach ($logros as $l): ?>
              <tr>
                <td style="font-weight:700;color:var(--adm-muted)">#<?= (int)$l['id'] ?></td>
                <td>
                  <div style="font-weight:700;color:var(--adm-text);font-size:.95rem">
                    <?php if (!empty($l['icono']) && strpos($l['icono'], 'fi-') !== false): ?>
                      <i class="fi <?= htmlspecialchars($l['icono']) ?>" style="color:#f59e0b;margin-right:4px"></i>
                    <?php else: ?>
                      <i class="fi fi-rr-medal" style="color:#f59e0b;margin-right:4px"></i>
                    <?php endif; ?> 
                    <?= htmlspecialchars($l['nombre']) ?>
                  </div>
                  <div style="font-size:.78rem;color:var(--adm-muted)"><?= htmlspecialchars($l['descripcion']) ?></div>
                </td>
                <td style="font-size:.82rem;color:var(--adm-text)">
                  <?= (int)$l['puntos_requeridos'] ?> pts
                  <?= !empty($l['cursos_requeridos']) ? ' · '.(int)$l['cursos_requeridos'].' cursos' : '' ?>
                </td>
                <td><span class="adm-badge estudiante"><?= (int)($l['total_desbloqueos'] ?? 0) ?> estudiantes</span></td>
                <td><span class="adm-badge <?= $l['activo'] ? 'activo' : 'inactivo' ?>"><?= $l['activo'] ? 'Activo' : 'Inactivo' ?></span></td>
                <td>
                  <div style="display:flex;gap:6px">
                    <form method="post" action="index.php?page=admin/logros/estado" class="adm-inline-form">
                      <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf) ?>">
                      <input type="hidden" name="logro_id" value="<?= (int)$l['id'] ?>">
                      <input type="hidden" name="activo" value="<?= $l['activo'] ? '0' : '1' ?>">
                      <button class="adm-action-btn <?= $l['activo'] ? 'warning' : 'success' ?>">
                        <?= $l['activo'] ? 'Desactivar' : 'Activar' ?>
                      </button>
                    </form>
                    <form method="post" action="index.php?page=admin/logros/eliminar" class="adm-inline-form" onsubmit="return confirm('¿Eliminar este logro?');">
                      <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf) ?>">
                      <input type="hidden" name="logro_id" value="<?= (int)$l['id'] ?>">
                      <button class="adm-action-btn danger" title="Eliminar"><i class="fi fi-rr-trash"></i></button>
                    </form>
                  </div>
                </td>
              </tr>
            <?php endforeach; endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- ── 7. MEMBRESÍAS Y SUSCRIPCIONES ────────────────────────────── -->
  <section id="tab-membresias" class="adm-tab-content" role="tabpanel" aria-labelledby="tab-btn-membresias" tabindex="0">
    <div class="adm-page-header">
      <div>
        <h2><i class="fi fi-rr-credit-card" style="color:var(--adm-primary)"></i> Planes y Membresías de Estudiantes</h2>
        <p>Control de planes activos, renovaciones y vencimientos de suscripción</p>
      </div>
    </div>
    
    <div class="adm-table-card">
      <div class="adm-table-header"><h3>Pagos pendientes de verificación (<?= count($pagosPendientes ?? []) ?>)</h3></div>
      <div class="adm-table-responsive">
        <table class="adm-table">
          <thead>
            <tr>
              <th>Estudiante</th>
              <th>Referencia</th>
              <th>Unidad</th>
              <th>Monto</th>
              <th>Método</th>
              <th>Fecha</th>
              <th>Revisión</th>
            </tr>
          </thead>
          <tbody>
            <?php if (empty($pagosPendientes)): ?>
              <tr><td colspan="7" class="adm-empty">No hay pagos pendientes de revisión.</td></tr>
            <?php else: foreach ($pagosPendientes as $p): ?>
              <tr>
                <td>
                  <div style="font-weight:600;color:var(--adm-text)"><?= htmlspecialchars($p['usuario_nombre']) ?></div>
                  <div style="font-size:.75rem;color:var(--adm-muted)"><?= htmlspecialchars($p['usuario_email']) ?></div>
                </td>
                <td><strong><?= htmlspecialchars($p['referencia']) ?></strong></td>
                <td>Unidad <?= (int)$p['unidad'] ?></td>
                <td>$<?= number_format((float)$p['monto'], 2) ?> MXN</td>
                <td><?= $p['metodo_pago'] === 'tarjeta' ? 'Tarjeta' : 'SPEI' ?></td>
                <td><?= htmlspecialchars($p['fecha_creacion']) ?></td>
                <td>
                  <form method="post" action="index.php?page=admin/pagos/actualizar" class="adm-inline-form" style="display:inline-flex;gap:6px;">
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf) ?>">
                    <input type="hidden" name="pago_id" value="<?= (int)$p['id'] ?>">
                    <input type="hidden" name="estado" value="aprobado">
                    <button class="adm-action-btn success" onclick="return confirm('¿Confirmar el pago de <?= htmlspecialchars($p['usuario_nombre'], ENT_QUOTES) ?> y activar su membresía?');">Aprobar</button>
                  </form>
                  <form method="post" action="index.php?page=admin/pagos/actualizar" class="adm-inline-form" style="display:inline-flex;gap:6px;">
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf) ?>">
                    <input type="hidden" name="pago_id" value="<?= (int)$p['id'] ?>">
                    <input type="hidden" name="estado" value="rechazado">
                    <button class="adm-action-btn danger" onclick="return confirm('¿Rechazar este pago?');">Rechazar</button>
                  </form>
                </td>
              </tr>
            <?php endforeach; endif; ?>
          </tbody>
        </table>
      </div>
    </div>

    <div class="adm-mem-grid" style="margin-top:20px">
      <div class="adm-mem-card"><div class="mem-icon" style="color:#10b981"><i class="fi fi-rr-leaf"></i></div><h4>Plan Gratis</h4><p class="mem-desc">Acceso básico inicial (1 mes)</p><span class="adm-badge gratis"><?= $memPorTipo['gratis'] ?> activas</span></div>
      <div class="adm-mem-card"><div class="mem-icon" style="color:#f59e0b"><i class="fi fi-rr-star"></i></div><h4>Plan Pro</h4><p class="mem-desc">Acceso ampliado de cursos</p><span class="adm-badge pro"><?= $memPorTipo['pro'] ?> activas</span></div>
      <div class="adm-mem-card"><div class="mem-icon" style="color:#8b5cf6"><i class="fi fi-rr-gem"></i></div><h4>Plan Premium</h4><p class="mem-desc">Acceso total anual + tutorías</p><span class="adm-badge premium"><?= $memPorTipo['premium'] ?> activas</span></div>
    </div>

    <div class="adm-table-card" style="margin-top:20px">
      <div class="adm-table-header"><h3>Asignación de Membresías a Alumnos (<?= count($membresias) ?>)</h3></div>
      <div class="adm-table-responsive">
        <table class="adm-table">
          <thead>
            <tr>
              <th>Usuario</th>
              <th>Plan y Vencimiento</th>
              <th>Estado</th>
            </tr>
          </thead>
          <tbody>
            <?php if (empty($membresias)): ?>
              <tr><td colspan="3" class="adm-empty">No hay membresías registradas.</td></tr>
            <?php else: foreach ($membresias as $m): ?>
              <tr>
                <td>
                  <div style="font-weight:600;color:var(--adm-text)"><?= htmlspecialchars($m['usuario_nombre']) ?></div>
                  <div style="font-size:.75rem;color:var(--adm-muted)"><?= htmlspecialchars($m['usuario_email']) ?></div>
                </td>
                <td>
                  <form method="post" action="index.php?page=admin/membresias/actualizar" class="adm-inline-form">
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf) ?>">
                    <input type="hidden" name="membresia_id" value="<?= (int)$m['id'] ?>">
                    <select name="tipo_membresia" class="adm-role-select">
                      <option value="gratis" <?= $m['tipo_membresia']==='gratis'?'selected':'' ?>>Gratis</option>
                      <option value="pro" <?= $m['tipo_membresia']==='pro'?'selected':'' ?>>Pro</option>
                      <option value="premium" <?= $m['tipo_membresia']==='premium'?'selected':'' ?>>Premium</option>
                    </select>
                    <select name="activa" class="adm-role-select">
                      <option value="1" <?= $m['activa']?'selected':'' ?>>Activa</option>
                      <option value="0" <?= !$m['activa']?'selected':'' ?>>Inactiva</option>
                    </select>
                    <input type="date" name="fecha_vencimiento" class="adm-input" style="width:auto" value="<?= htmlspecialchars($m['fecha_vencimiento'] ? substr($m['fecha_vencimiento'],0,10) : '') ?>">
                    <button class="adm-action-btn success">Guardar</button>
                  </form>
                </td>
                <td><span class="adm-badge <?= $m['activa'] ? 'activo' : 'inactivo' ?>"><?= $m['activa'] ? 'Activa' : 'Inactiva' ?></span></td>
              </tr>
            <?php endforeach; endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- ── 8. AUDITORÍA DE SEGURIDAD ─────────────────────────────────── -->
  <section id="tab-auditoria" class="adm-tab-content" role="tabpanel" aria-labelledby="tab-btn-auditoria" tabindex="0">
    <div class="adm-page-header">
      <div>
        <h2><i class="fi fi-rr-shield-check" style="color:var(--adm-primary)"></i> Auditoría de Seguridad</h2>
        <p>Bitácora de inicios de sesión y modificaciones de perfiles en tiempo real</p>
      </div>
    </div>
    
    <div class="adm-table-card">
      <div class="adm-table-header"><h3>Últimos Intentos de Inicio de Sesión</h3></div>
      <div class="adm-table-responsive">
        <table class="adm-table">
          <thead>
            <tr>
              <th>Fecha y Hora</th>
              <th>Usuario</th>
              <th>Email</th>
              <th>Dirección IP</th>
              <th>Resultado</th>
            </tr>
          </thead>
          <tbody>
            <?php if (empty($logins)): ?>
              <tr><td colspan="5" class="adm-empty">Sin registros recientes de inicio de sesión.</td></tr>
            <?php else: foreach ($logins as $log): ?>
              <tr>
                <td style="color:var(--adm-muted);font-size:.82rem"><?= date('d/m/Y H:i:s', strtotime($log['fecha_intent'])) ?></td>
                <td style="font-weight:600"><?= htmlspecialchars($log['usuario_nombre'] ?: 'Desconocido') ?></td>
                <td style="color:var(--adm-muted)"><?= htmlspecialchars($log['email']) ?></td>
                <td style="color:var(--adm-muted);font-size:.82rem"><?= htmlspecialchars($log['ip_address'] ?: '-') ?></td>
                <td><span class="adm-badge <?= $log['exitoso'] ? 'activo' : 'inactivo' ?>"><?= $log['exitoso'] ? 'Éxito' : 'Fallido' ?></span></td>
              </tr>
            <?php endforeach; endif; ?>
          </tbody>
        </table>
      </div>
    </div>

    <div class="adm-table-card">
      <div class="adm-table-header"><h3>Cambios Recientes en Cuentas y Perfiles</h3></div>
      <div class="adm-table-responsive">
        <table class="adm-table">
          <thead>
            <tr>
              <th>Fecha y Hora</th>
              <th>Usuario</th>
              <th>Campo Modificado</th>
              <th>Valor Anterior</th>
              <th>Valor Nuevo</th>
            </tr>
          </thead>
          <tbody>
            <?php if (empty($cambios)): ?>
              <tr><td colspan="5" class="adm-empty">Sin cambios registrados.</td></tr>
            <?php else: foreach ($cambios as $ch): ?>
              <tr>
                <td style="color:var(--adm-muted);font-size:.82rem"><?= date('d/m/Y H:i:s', strtotime($ch['fecha_cambio'])) ?></td>
                <td style="font-weight:600"><?= htmlspecialchars($ch['usuario_nombre'] ?: $ch['email']) ?></td>
                <td><span class="adm-badge estudiante"><?= htmlspecialchars($ch['campo_cambiado']) ?></span></td>
                <td style="color:var(--adm-muted)"><?= htmlspecialchars($ch['valor_anterior'] ?? '-') ?></td>
                <td style="color:var(--adm-muted)"><?= htmlspecialchars($ch['valor_nuevo'] ?? '-') ?></td>
              </tr>
            <?php endforeach; endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- ── 9. CONFIGURACIÓN Y ANUNCIOS ───────────────────────────────── -->
  <section id="tab-config" class="adm-tab-content" role="tabpanel" aria-labelledby="tab-btn-config" tabindex="0">
    <div class="adm-page-header">
      <div>
        <h2><i class="fi fi-rr-settings" style="color:var(--adm-primary)"></i> Configuración Global y Avisos</h2>
        <p>Ajustes de la plataforma, avisos en vivo a estudiantes y credenciales de seguridad</p>
      </div>
    </div>

    <form method="post" action="index.php?page=admin/configuracion">
      <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf) ?>">
      
      <!-- Anuncio Global para Estudiantes -->
      <div class="adm-config-card" style="margin-bottom:20px;border-left:4px solid #0ea5e9">
        <h3><i class="fi fi-rr-bullhorn" style="color:#0ea5e9;margin-right:6px;"></i> Anuncio Global para Estudiantes</h3>
        <p style="font-size:.85rem;color:var(--adm-muted);margin:0 0 14px">
          Muestra una barra destacada en la parte superior del aula virtual para todos los estudiantes conectados.
        </p>
        <div class="adm-check-row">
          <input type="hidden" name="anuncio_activo" value="0">
          <input type="checkbox" id="anuncio_activo" name="anuncio_activo" value="1" <?= $config['anuncio_activo']==='1'?'checked':'' ?>>
          <label for="anuncio_activo">
            Activar banner de aviso global
            <small>Los estudiantes verán este mensaje fijo en la parte superior del aula.</small>
          </label>
        </div>
        <div class="adm-form-row">
          <div class="adm-form-group" style="flex:2">
            <label for="anuncio_texto">Mensaje del Anuncio</label>
            <input id="anuncio_texto" class="adm-input" name="anuncio_texto" placeholder="Ej: ¡Nuevo taller de Finanzas e Inversiones este sábado a las 6:00 PM!" value="<?= htmlspecialchars($config['anuncio_texto']) ?>">
          </div>
          <div class="adm-form-group">
            <label for="anuncio_tipo">Estilo Visual</label>
            <select id="anuncio_tipo" class="adm-input" name="anuncio_tipo">
              <option value="info" <?= $config['anuncio_tipo']==='info'?'selected':'' ?>>Informativo (Azul)</option>
              <option value="exito" <?= $config['anuncio_tipo']==='exito'?'selected':'' ?>>Éxito / Novedad (Verde)</option>
              <option value="alerta" <?= $config['anuncio_tipo']==='alerta'?'selected':'' ?>>Alerta / Urgente (Rojo)</option>
            </select>
          </div>
        </div>
      </div>

      <div class="adm-config-grid">
        <div class="adm-config-card">
          <h3>Plataforma General</h3>
          <div class="adm-form-group">
            <label for="cfg_nombre">Nombre de la Escuela</label>
            <input id="cfg_nombre" class="adm-input" name="nombre_plataforma" maxlength="80" required value="<?= htmlspecialchars($config['nombre_plataforma']) ?>">
          </div>
          <div class="adm-form-group">
            <label for="cfg_soporte">Correo de Soporte Técnico</label>
            <input id="cfg_soporte" class="adm-input" type="email" name="correo_soporte" value="<?= htmlspecialchars($config['correo_soporte']) ?>">
          </div>
          <div class="adm-form-row">
            <div class="adm-form-group">
              <label for="cfg_moneda">Moneda</label>
              <select id="cfg_moneda" class="adm-input" name="moneda">
                <?php foreach (['MXN','USD','EUR','COP','ARS','CLP','PEN'] as $code): ?>
                  <option value="<?= $code ?>" <?= $config['moneda']===$code?'selected':'' ?>><?= $code ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="adm-form-group">
              <label for="cfg_zona">Zona Horaria</label>
              <input id="cfg_zona" class="adm-input" name="zona_horaria" value="<?= htmlspecialchars($config['zona_horaria']) ?>">
            </div>
          </div>
        </div>

        <div class="adm-config-card">
          <h3>Registro y Seguridad</h3>
          <div class="adm-check-row">
            <input type="hidden" name="permitir_registro" value="0">
            <input type="checkbox" id="permitir_registro" name="permitir_registro" value="1" <?= $config['permitir_registro']==='1'?'checked':'' ?>>
            <label for="permitir_registro">
              Permitir registro público
              <small>Habilita o deshabilita la creación de nuevas cuentas desde el inicio.</small>
            </label>
          </div>
          <div class="adm-form-row">
            <div class="adm-form-group">
              <label for="cfg_intentos">Máx. Intentos Login</label>
              <input id="cfg_intentos" class="adm-input" type="number" name="login_max_intentos" min="1" max="20" value="<?= htmlspecialchars($config['login_max_intentos']) ?>">
            </div>
            <div class="adm-form-group">
              <label for="cfg_ventana">Minutos Bloqueo</label>
              <input id="cfg_ventana" class="adm-input" type="number" name="login_ventana_minutos" min="1" max="120" value="<?= htmlspecialchars($config['login_ventana_minutos']) ?>">
            </div>
          </div>
        </div>

        <div class="adm-config-card">
          <h3>Modo Mantenimiento</h3>
          <div class="adm-check-row">
            <input type="hidden" name="modo_mantenimiento" value="0">
            <input type="checkbox" id="modo_mantenimiento" name="modo_mantenimiento" value="1" <?= $config['modo_mantenimiento']==='1'?'checked':'' ?>>
            <label for="modo_mantenimiento">
              Activar Mantenimiento
              <small>Los estudiantes verán pantalla de mantenimiento; administradores acceden normalmente.</small>
            </label>
          </div>
          <div class="adm-form-group">
            <label for="cfg_msg_mant">Mensaje de Mantenimiento</label>
            <textarea id="cfg_msg_mant" class="adm-input" name="mensaje_mantenimiento" rows="3" maxlength="500"><?= htmlspecialchars($config['mensaje_mantenimiento']) ?></textarea>
          </div>
        </div>
      </div>

      <div style="margin-bottom:28px">
        <button type="submit" class="adm-action-btn primary" style="padding:10px 22px;font-size:.9rem"><i class="fi fi-rr-disk"></i> Guardar Toda la Configuración</button>
      </div>
    </form>

    <div class="adm-config-card" style="margin-bottom:24px">
      <h3><i class="fi fi-rr-key" style="margin-right:6px;color:var(--adm-primary)"></i> Seguridad: Actualizar Contraseña del Administrador</h3>
      <form method="post" action="index.php?page=admin/password">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf) ?>">
        <div class="adm-form-row" style="grid-template-columns:repeat(auto-fit,minmax(180px,1fr))">
          <div class="adm-form-group"><label for="pwd_act">Contraseña Actual</label><input id="pwd_act" class="adm-input" type="password" name="password_actual" required></div>
          <div class="adm-form-group"><label for="pwd_new">Nueva Contraseña</label><input id="pwd_new" class="adm-input" type="password" name="password_nueva" minlength="8" required></div>
          <div class="adm-form-group"><label for="pwd_conf">Confirmar Nueva Contraseña</label><input id="pwd_conf" class="adm-input" type="password" name="password_confirmar" minlength="8" required></div>
        </div>
        <p class="adm-help" style="margin:0 0 12px">Mínimo 8 caracteres, al menos una mayúscula, un número y un carácter especial.</p>
        <button type="submit" class="adm-action-btn primary">Actualizar Contraseña</button>
      </form>
    </div>
  </section>
</main>

<script>
/* Control de Pestañas Principales con actualización de URL */
function showAdminTab(tabName){
  document.querySelectorAll('.adm-tab-content').forEach(function(el){
    el.classList.remove('active');
    el.style.display='none';
  });
  document.querySelectorAll('.adm-sidebar-link').forEach(function(el){
    el.classList.remove('active');
    el.setAttribute('aria-selected', 'false');
  });
  var tab = document.getElementById('tab-' + tabName);
  if(tab){
    tab.style.display='block';
    tab.classList.add('active');
    try{ tab.focus(); }catch(e){}
  }
  var link = document.querySelector('[data-tab="' + tabName + '"]');
  if(link){
    link.classList.add('active');
    link.setAttribute('aria-selected', 'true');
  }
  if(window.history && window.history.replaceState){
    var u = new URL(window.location);
    u.searchParams.set('tab', tabName);
    window.history.replaceState(null, '', u);
  }
  // En móviles, cerrar el sidebar al seleccionar una pestaña
  if(window.innerWidth <= 900){
    toggleAdminSidebar(false);
  }
}

/* Control de Sub-pestañas de contenidos */
function showSubTab(subName){
  document.querySelectorAll('.adm-subcontent').forEach(function(el){
    el.classList.remove('active');
    el.style.display='none';
  });
  document.querySelectorAll('.adm-subtab-btn').forEach(function(el){
    el.classList.remove('active');
  });
  var sub = document.getElementById('sub-' + subName);
  if(sub){ sub.style.display='block'; sub.classList.add('active'); }
  var btn = document.querySelector('[data-sub="' + subName + '"]');
  if(btn){ btn.classList.add('active'); }
}

/* Toggle colapsable accesible */
function toggleElem(id){
  var el = document.getElementById(id);
  if(el){
    var isHidden = (el.style.display === 'none' || el.style.display === '');
    el.style.display = isHidden ? 'block' : 'none';
    if(isHidden){
      var firstInput = el.querySelector('input:not([type="hidden"]), select, textarea');
      if(firstInput){ try{ firstInput.focus(); }catch(e){} }
    }
  }
}

/* Toggle Sidebar móvil */
function toggleAdminSidebar(forceState){
  var sidebar = document.getElementById('admSidebar');
  var backdrop = document.getElementById('admSidebarBackdrop');
  var toggleBtn = document.getElementById('admMenuToggle');
  if(!sidebar || !backdrop) return;
  
  var isOpen = sidebar.classList.contains('open');
  var newState = (typeof forceState === 'boolean') ? forceState : !isOpen;
  
  if(newState){
    sidebar.classList.add('open');
    backdrop.classList.add('active');
    if(toggleBtn) toggleBtn.setAttribute('aria-expanded', 'true');
  } else {
    sidebar.classList.remove('open');
    backdrop.classList.remove('active');
    if(toggleBtn) toggleBtn.setAttribute('aria-expanded', 'false');
  }
}

/* Filtros en tiempo real */
function filtrarUsuarios(){
  var s = (document.getElementById('userSearch').value || '').toLowerCase().trim();
  var r = document.getElementById('rolFilter').value;
  var visible = 0;
  document.querySelectorAll('.user-row').forEach(function(row){
    var n = row.getAttribute('data-nombre') || '', e = row.getAttribute('data-email') || '', rol = row.getAttribute('data-rol') || '';
    var match = ((n.indexOf(s) !== -1 || e.indexOf(s) !== -1) && (!r || rol === r));
    row.style.display = match ? '' : 'none';
    if(match) visible++;
  });
  var counter = document.getElementById('userCountVisible');
  if(counter) counter.textContent = visible;
}

function filtrarInscripciones(){
  var s = (document.getElementById('inscSearch').value || '').toLowerCase().trim();
  var visible = 0;
  document.querySelectorAll('.insc-row').forEach(function(row){
    var e = row.getAttribute('data-estudiante') || '', m = row.getAttribute('data-materia') || '';
    var match = (e.indexOf(s) !== -1 || m.indexOf(s) !== -1);
    row.style.display = match ? '' : 'none';
    if(match) visible++;
  });
  var counter = document.getElementById('inscCountVisible');
  if(counter) counter.textContent = visible;
}

function filtrarProgreso(){
  var s = (document.getElementById('progSearch').value || '').toLowerCase().trim();
  var visible = 0;
  document.querySelectorAll('.prog-row').forEach(function(row){
    var e = row.getAttribute('data-estudiante') || '', c = row.getAttribute('data-curso') || '';
    var match = (e.indexOf(s) !== -1 || c.indexOf(s) !== -1);
    row.style.display = match ? '' : 'none';
    if(match) visible++;
  });
  var counter = document.getElementById('progCountVisible');
  if(counter) counter.textContent = visible;
}

/* Gestión de Tema Visual */
function setAdminTheme(theme){
  if(theme === 'emerald'){
    document.documentElement.removeAttribute('data-theme');
  } else {
    document.documentElement.setAttribute('data-theme', theme);
  }
  try{ localStorage.setItem('adm_theme', theme); }catch(e){}
}
(function(){
  try{
    var saved = localStorage.getItem('adm_theme') || 'emerald';
    setAdminTheme(saved);
  }catch(e){}
})();

/* Cerrar sesión */
function adminLogout(){
  if(!confirm('¿Estás seguro de que deseas cerrar tu sesión administrativa?')) return;
  try{ localStorage.removeItem('edu_fin_session'); }catch(e){}
  fetch('api/index.php?endpoint=logout', {method:'POST', credentials:'include'}).finally(function(){
    window.location.href = 'index.php';
  });
}

/* Inicialización al cargar la página */
document.addEventListener('DOMContentLoaded', function(){
  var p = new URLSearchParams(window.location.search);
  var t = p.get('tab');
  var sec = p.get('sec');
  var validTabs = ['dashboard','contenido','inscripciones','progreso','logros','usuarios','membresias','auditoria','config'];
  showAdminTab(validTabs.indexOf(t) !== -1 ? t : 'dashboard');
  if(sec){ showSubTab(sec); }

  // Atajo de teclado: Escape cierra la barra lateral en móviles
  document.addEventListener('keydown', function(ev){
    if(ev.key === 'Escape'){
      toggleAdminSidebar(false);
    }
  });
});
</script>
