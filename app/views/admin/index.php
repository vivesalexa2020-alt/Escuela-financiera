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
$totalEstudiantes = $totalUsuarios - $totalAdmins;
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
  --adm-sidebar:#04291d;
  --adm-sidebar-border:#084d37;
  --adm-sidebar-title:#a7f3d0;
  --adm-sidebar-link:#d1fae5;
  --adm-sidebar-active:#fabb15;
  --adm-primary:#00703c;
  --adm-primary-grad:linear-gradient(135deg, #00703c, #10b981);
  --adm-accent:#fabb15;
}
[data-theme="fintech"]{
  --adm-bg:#f8fafc;
  --adm-sidebar:#0f172a;
  --adm-sidebar-border:#1e293b;
  --adm-sidebar-title:#94a3b8;
  --adm-sidebar-link:#cbd5e1;
  --adm-sidebar-active:#38bdf8;
  --adm-primary:#0284c7;
  --adm-primary-grad:linear-gradient(135deg, #0284c7, #38bdf8);
  --adm-accent:#38bdf8;
}
[data-theme="dark"]{
  --adm-bg:#0b1120;
  --adm-sidebar:#030712;
  --adm-sidebar-border:#1f2937;
  --adm-sidebar-title:#9ca3af;
  --adm-sidebar-link:#94a3b8;
  --adm-sidebar-active:#22c55e;
  --adm-primary:#16a34a;
  --adm-primary-grad:linear-gradient(135deg, #15803d, #22c55e);
  --adm-accent:#22c55e;
}
.admin-page, .admin-page button, .admin-page input, .admin-page select, .admin-page textarea{margin:0;padding:0;background:var(--adm-bg);color:#1e293b;font-family:'Poppins',-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif}
.adm-topbar{position:fixed;top:0;left:0;right:0;z-index:1100;height:60px;background:#fff;border-bottom:2px solid var(--adm-primary);display:flex;align-items:center;justify-content:space-between;padding:0 24px;box-shadow:0 1px 6px rgba(0,0,0,0.03)}
.adm-topbar-badge{background:var(--adm-primary-grad);color:#fff;padding:6px 14px;border-radius:8px;font-size:12.5px;font-weight:800;letter-spacing:.04em;display:flex;align-items:center;gap:6px;box-shadow:0 2px 6px rgba(0,112,60,0.2)}
.adm-topbar-center{font-size:13.5px;color:#475569}
.adm-topbar-right{display:flex;align-items:center;gap:10px}
.adm-theme-picker{display:flex;align-items:center;gap:5px;background:#f1f5f9;padding:3px 8px;border-radius:20px;border:1px solid #e2e8f0}
.adm-theme-btn{width:20px;height:20px;border-radius:50%;border:2px solid #fff;cursor:pointer;outline:none;transition:transform .15s}
.adm-theme-btn:hover{transform:scale(1.2)}
.adm-theme-emerald{background:#00703c}
.adm-theme-fintech{background:#0284c7}
.adm-theme-dark{background:#111827}
.adm-btn-student,.adm-btn-logout{padding:7px 15px;border-radius:8px;font-size:13px;font-weight:600;text-decoration:none;cursor:pointer;border:1px solid;display:inline-flex;align-items:center;gap:6px;transition:all .15s}
.adm-btn-student{background:#ecfdf5;color:#065f46;border-color:#a7f3d0}.adm-btn-student:hover{background:#d1fae5}
.adm-btn-logout{background:#fef2f2;color:#991b1b;border-color:#fecaca}.adm-btn-logout:hover{background:#fee2e2}
.adm-sidebar{position:fixed;top:60px;left:0;bottom:0;width:245px;background:var(--adm-sidebar);border-right:1px solid var(--adm-sidebar-border);overflow-y:auto;display:flex;flex-direction:column;box-shadow:2px 0 8px rgba(0,0,0,0.04)}
.adm-sidebar-nav{flex:1;padding:16px 0}
.adm-sidebar-title{padding:12px 20px 6px;font-size:10px;font-weight:800;color:var(--adm-sidebar-title);letter-spacing:.08em}
.adm-sidebar-link{display:flex;align-items:center;gap:10px;padding:11px 20px;color:var(--adm-sidebar-link);font-size:13.5px;text-decoration:none;border-left:4px solid transparent;cursor:pointer;transition:all .15s}
.adm-sidebar-link:hover{background:rgba(255,255,255,0.07);color:#fff}
.adm-sidebar-link.active{background:rgba(255,255,255,0.12);color:var(--adm-sidebar-active);border-left-color:var(--adm-sidebar-active);font-weight:700}
.adm-icon{width:22px;text-align:center;font-size:16px;display:inline-flex;align-items:center;justify-content:center}
.adm-sidebar-footer{padding:16px 20px;border-top:1px solid var(--adm-sidebar-border);display:flex;align-items:center;gap:10px;background:rgba(0,0,0,0.15)}
.adm-sidebar-avatar{width:36px;height:36px;border-radius:50%;background:var(--adm-accent);color:#06402d;display:flex;align-items:center;justify-content:center;font-weight:800}
.adm-sidebar-user-name{color:#e2e8f0;font-size:13px;font-weight:600}
.adm-sidebar-user-role{font-size:10.5px;color:#06402d;background:#fabb15;padding:2px 9px;border-radius:99px;font-weight:800}
.adm-main{margin-left:245px;margin-top:60px;padding:28px 32px 64px;min-height:calc(100vh - 60px)}
.adm-page-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:24px;flex-wrap:wrap;gap:14px}
.adm-page-header h2{font-size:1.55rem;font-weight:800;color:#0f172a;margin:0}
.adm-page-header p{font-size:.88rem;color:#64748b;margin:4px 0 0}
.adm-flash{padding:14px 18px;border-radius:10px;margin-bottom:22px;font-size:.9rem;font-weight:500;display:flex;align-items:center;gap:10px}
.adm-flash.ok{background:#dcfce7;color:#166534;border:1px solid #bbf7d0}
.adm-flash.error{background:#fee2e2;color:#991b1b;border:1px solid #fecaca}
.adm-kpi-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(210px,1fr));gap:16px;margin-bottom:28px}
.adm-kpi{background:#fff;border-radius:14px;padding:20px;border:1px solid #e2e8f0;position:relative;box-shadow:0 3px 12px rgba(6,64,45,0.04);transition:transform .15s,box-shadow .15s}
.adm-kpi:hover{transform:translateY(-2px);box-shadow:0 6px 16px rgba(6,64,45,0.08)}
.adm-kpi::before{content:'';position:absolute;top:0;left:0;right:0;height:4px;border-radius:14px 14px 0 0}
.adm-kpi.green::before{background:linear-gradient(90deg, #00703c, #10b981)}
.adm-kpi.purple::before{background:linear-gradient(90deg, #7c3aed, #a855f7)}
.adm-kpi.blue::before{background:linear-gradient(90deg, #0284c7, #38bdf8)}
.adm-kpi.gold::before{background:linear-gradient(90deg, #d97706, #fabb15)}
.adm-kpi-icon{font-size:22px;margin-bottom:6px;display:inline-flex;align-items:center;justify-content:center}
.adm-kpi-number{font-size:1.85rem;font-weight:800;color:#0f172a}
.adm-kpi-label{font-size:.82rem;color:#64748b;margin-top:4px}
.adm-table-card{background:#fff;border:1px solid #e2e8f0;border-radius:14px;overflow:hidden;margin-bottom:24px;box-shadow:0 3px 12px rgba(0,0,0,0.02)}
.adm-table-header{padding:16px 20px;display:flex;align-items:center;justify-content:space-between;gap:12px;border-bottom:1px solid #f1f5f9;flex-wrap:wrap;background:#fafafa}
.adm-table-header h3{font-size:1.02rem;font-weight:700;color:#0f172a;margin:0}
.adm-table-actions{display:flex;gap:10px;align-items:center;flex-wrap:wrap}
table.adm-table{width:100%;border-collapse:collapse;font-size:.85rem}
table.adm-table th,table.adm-table td{padding:12px 14px;text-align:left;border-bottom:1px solid #f1f5f9;vertical-align:middle}
table.adm-table th{background:#f8fafc;color:#475569;font-size:.73rem;font-weight:700;text-transform:uppercase;letter-spacing:.04em}
.adm-badge{display:inline-flex;align-items:center;gap:4px;padding:3px 10px;border-radius:999px;font-size:.72rem;font-weight:700}
.adm-badge.admin{background:#fef3c7;color:#92400e}.adm-badge.estudiante{background:#e0f2fe;color:#0369a1}
.adm-badge.activo{background:#dcfce7;color:#16a34a}.adm-badge.inactivo{background:#fee2e2;color:#dc2626}
.adm-badge.gratis{background:#f1f5f9;color:#475569}.adm-badge.pro{background:#fef3c7;color:#b45309}.adm-badge.premium{background:#ede9fe;color:#7c3aed}
.adm-badge.pill{background:#e2e8f0;color:#334155;border-radius:6px;padding:2px 8px;font-size:.74rem}
.adm-user-cell{display:flex;align-items:center;gap:10px}
.adm-user-avatar{width:32px;height:32px;border-radius:50%;background:#e0f2fe;color:#0369a1;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:700}
.adm-user-avatar.is-admin{background:#ede9fe;color:#7c3aed}
.adm-role-select,.adm-input,.adm-search-input,.adm-filter-select{padding:7px 11px;border-radius:8px;border:1px solid #cbd5e1;background:#fff;font-size:.83rem;font-family:inherit;transition:border-color .15s}
.adm-role-select:focus,.adm-input:focus,.adm-search-input:focus{outline:none;border-color:var(--adm-primary)}
.adm-input{width:100%;box-sizing:border-box}
.adm-action-btn{display:inline-flex;align-items:center;gap:5px;padding:7px 13px;border-radius:8px;border:1px solid #cbd5e1;background:#fff;font-size:.78rem;font-weight:600;color:#334155;cursor:pointer;text-decoration:none;transition:all .15s}
.adm-action-btn:hover{background:#f8fafc;border-color:#94a3b8}
.adm-action-btn.primary{background:var(--adm-primary-grad);color:#fff;border:none;box-shadow:0 2px 8px rgba(0,112,60,0.22)}.adm-action-btn.primary:hover{opacity:0.92;box-shadow:0 4px 12px rgba(0,112,60,0.3)}
.adm-action-btn.success{color:#15803d;border-color:#bbf7d0;background:#f0fdf4}.adm-action-btn.success:hover{background:#dcfce7}
.adm-action-btn.danger{color:#b91c1c;border-color:#fecaca;background:#fef2f2}.adm-action-btn.danger:hover{background:#fee2e2}
.adm-action-btn.warning{color:#b45309;border-color:#fde68a;background:#fffbeb}.adm-action-btn.warning:hover{background:#fef3c7}
.adm-inline-form{display:inline-flex;gap:6px;flex-wrap:wrap;align-items:center;margin:0}
.adm-empty{text-align:center;color:#94a3b8;padding:28px;font-style:italic}
.adm-help{font-size:.78rem;color:#64748b;margin:6px 0 0}
.adm-tab-content{display:none}.adm-tab-content.active{display:block}
.adm-config-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:20px;margin-bottom:24px}
.adm-config-card{background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:22px;box-shadow:0 2px 8px rgba(0,0,0,0.02)}
.adm-config-card h3{font-size:1.05rem;font-weight:700;color:#0f172a;margin:0 0 16px;border-bottom:1px solid #f1f5f9;padding-bottom:10px}
.adm-form-group{margin-bottom:14px}
.adm-form-group label{display:block;font-size:.82rem;font-weight:600;color:#475569;margin-bottom:5px}
.adm-form-row{display:grid;grid-template-columns:repeat(auto-fit,minmax(140px,1fr));gap:12px}
.adm-check-row{display:flex;align-items:flex-start;gap:10px;padding:10px 12px;border:1px solid #e2e8f0;border-radius:10px;background:#f8fafc;margin-bottom:12px}
.adm-check-row small{display:block;color:#64748b;font-weight:400}
.adm-mem-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:16px}
.adm-mem-card{background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:22px;text-align:center;box-shadow:0 2px 8px rgba(0,0,0,0.02)}
.mem-icon{font-size:32px;margin-bottom:8px}
.mem-desc{font-size:.82rem;color:#64748b}
.adm-quick-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(190px,1fr));gap:12px;margin-top:16px}
.adm-quick-btn{display:flex;align-items:center;gap:10px;padding:14px 16px;border-radius:12px;background:#fff;border:1px solid #e2e8f0;font-weight:600;color:#0f172a;cursor:pointer;text-decoration:none;transition:border-color .15s,background .15s,box-shadow .15s}
.adm-quick-btn:hover{border-color:var(--adm-primary);background:#f0fdf4;box-shadow:0 3px 10px rgba(0,112,60,0.08)}
.adm-collapse-box{background:#f8fafc;border:1px dashed #cbd5e1;border-radius:12px;padding:18px;margin-bottom:20px}
.adm-course-card{display:flex;align-items:center;gap:18px;background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:16px 20px;margin-bottom:20px;flex-wrap:wrap;box-shadow:0 3px 10px rgba(0,0,0,0.02)}
.adm-course-thumb{width:90px;height:65px;border-radius:8px;object-fit:cover;background:#e2e8f0;display:flex;align-items:center;justify-content:center;color:#64748b;font-size:24px}
.adm-subtabs{display:flex;gap:8px;border-bottom:2px solid #e2e8f0;margin-bottom:20px;overflow-x:auto}
.adm-subtab-btn{padding:10px 16px;font-size:.86rem;font-weight:600;color:#64748b;background:none;border:none;border-bottom:3px solid transparent;cursor:pointer;white-space:nowrap;transition:color .15s}
.adm-subtab-btn:hover{color:var(--adm-primary)}
.adm-subtab-btn.active{color:var(--adm-primary);border-bottom-color:var(--adm-primary);font-weight:700}
.adm-subcontent{display:none}.adm-subcontent.active{display:block}
.adm-edit-details summary{cursor:pointer;color:var(--adm-primary);font-weight:600;font-size:.8rem;padding:4px 0}
.adm-edit-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(140px,1fr));gap:10px;margin-top:10px}
.adm-edit-grid textarea{grid-column:1/-1;min-height:70px}
@media(max-width:900px){.adm-sidebar{width:210px}.adm-main{margin-left:210px;padding:20px 16px 48px}}
@media(max-width:700px){.adm-sidebar{transform:translateX(-100%)}.adm-main{margin-left:0}.adm-topbar-center{display:none}}
</style>

<div class="adm-topbar">
  <div>
    <span class="adm-topbar-badge">
      <svg viewBox="0 0 240 210" style="width:20px;height:18px" fill="none"><rect x="26" y="162" width="188" height="30" rx="8" fill="#fabb15"/><path d="M120,14 L216,58 L120,102 L24,58 Z" fill="#ffffff"/></svg>
      PANEL ADMINISTRATIVO
    </span>
  </div>
  <div class="adm-topbar-center">Bienvenido, <strong><?= $adminName ?></strong></div>
  <div class="adm-topbar-right">
    <!-- Selector rápido de tema / color -->
    <div class="adm-theme-picker" title="Cambiar tema de color">
      <span style="font-size:11px;font-weight:700;color:#64748b;margin-right:3px">Color:</span>
      <button class="adm-theme-btn adm-theme-emerald" onclick="setAdminTheme('emerald')" title="Esmeralda & Oro"></button>
      <button class="adm-theme-btn adm-theme-fintech" onclick="setAdminTheme('fintech')" title="Azul Fintech"></button>
      <button class="adm-theme-btn adm-theme-dark" onclick="setAdminTheme('dark')" title="Modo Oscuro"></button>
    </div>
    <a href="index.php?page=aula" class="adm-btn-student"><i class="fi fi-rr-graduation-cap" style="margin-right:5px;font-size:13px;"></i> Ir al aula</a>
    <button class="adm-btn-logout" onclick="adminLogout()"><i class="fi fi-rr-sign-out-alt" style="margin-right:5px;font-size:13px;"></i> Cerrar sesión</button>
  </div>
</div>

<aside class="adm-sidebar">
  <nav class="adm-sidebar-nav">
    <div class="adm-sidebar-title">PANEL PRINCIPAL</div>
    <a class="adm-sidebar-link active" data-tab="dashboard" onclick="showAdminTab('dashboard')"><i class="fi fi-rr-chart-pie adm-icon"></i> Resumen General</a>
    
    <div class="adm-sidebar-title">ACADÉMICO Y MULTIMEDIA</div>
    <a class="adm-sidebar-link" data-tab="contenido" onclick="showAdminTab('contenido')"><i class="fi fi-rr-film adm-icon"></i> Contenidos (Videos/Libros)</a>
    <a class="adm-sidebar-link" data-tab="inscripciones" onclick="showAdminTab('inscripciones')"><i class="fi fi-rr-document-signed adm-icon"></i> Inscripciones</a>
    <a class="adm-sidebar-link" data-tab="progreso" onclick="showAdminTab('progreso')"><i class="fi fi-rr-chart-histogram adm-icon"></i> Progreso</a>
    <a class="adm-sidebar-link" data-tab="logros" onclick="showAdminTab('logros')"><i class="fi fi-rr-trophy adm-icon"></i> Logros</a>
    
    <div class="adm-sidebar-title">USUARIOS Y ACCESOS</div>
    <a class="adm-sidebar-link" data-tab="usuarios" onclick="showAdminTab('usuarios')"><i class="fi fi-rr-users-alt adm-icon"></i> Usuarios</a>
    <a class="adm-sidebar-link" data-tab="membresias" onclick="showAdminTab('membresias')"><i class="fi fi-rr-credit-card adm-icon"></i> Membresías</a>
    
    <div class="adm-sidebar-title">SISTEMA</div>
    <a class="adm-sidebar-link" data-tab="auditoria" onclick="showAdminTab('auditoria')"><i class="fi fi-rr-shield-check adm-icon"></i> Auditoría</a>
    <a class="adm-sidebar-link" data-tab="config" onclick="showAdminTab('config')"><i class="fi fi-rr-settings adm-icon"></i> Configuración y Anuncios</a>
  </nav>
  <div class="adm-sidebar-footer">
    <div class="adm-sidebar-avatar"><?= strtoupper(mb_substr($adminName,0,1)) ?></div>
    <div><div class="adm-sidebar-user-name"><?= $adminName ?></div><span class="adm-sidebar-user-role">Administrador</span></div>
  </div>
</aside>

<main class="adm-main">
  <?php if (!empty($flash)): ?>
    <div class="adm-flash <?= htmlspecialchars($flash['tipo']) ?>">
      <span><i class="fi <?= $flash['tipo'] === 'ok' ? 'fi-rr-check-circle' : 'fi-rr-exclamation' ?>"></i></span>
      <span><?= htmlspecialchars($flash['texto']) ?></span>
    </div>
  <?php endif; ?>

  <!-- ── 1. RESUMEN GENERAL ────────────────────────────────────────── -->
  <div id="tab-dashboard" class="adm-tab-content active">
    <div class="adm-page-header">
      <div>
        <h2>Resumen General</h2>
        <p>Visión completa de estudiantes, cursos, materiales y rendimiento</p>
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
      <div class="adm-table-header"><h3><i class="fi fi-sr-bolt" style="color:#f5b800;margin-right:6px;"></i> Accesos Rápidos y Tareas Frecuentes</h3></div>
      <div style="padding:18px 20px">
        <div class="adm-quick-grid" style="margin-top:0">
          <a class="adm-quick-btn" onclick="showAdminTab('contenido')"><i class="fi fi-rr-film" style="font-size:20px"></i> Gestionar Videos y Libros</a>
          <a class="adm-quick-btn" onclick="showAdminTab('usuarios')"><i class="fi fi-rr-users-alt" style="font-size:20px"></i> Control de Usuarios</a>
          <a class="adm-quick-btn" href="index.php?page=admin/exportar-pdf&tipo=usuarios" target="_blank"><i class="fi fi-rr-file-pdf" style="font-size:20px"></i> Descargar Usuarios en PDF</a>
          <a class="adm-quick-btn" href="index.php?page=admin/exportar-pdf&tipo=progreso" target="_blank"><i class="fi fi-rr-file-pdf" style="font-size:20px"></i> Descargar Progreso en PDF</a>
          <a class="adm-quick-btn" onclick="showAdminTab('config')"><i class="fi fi-rr-bullhorn" style="font-size:20px"></i> Publicar Aviso Global</a>
        </div>
      </div>
    </div>
  </div>

  <!-- ── 3. GESTIÓN DE CONTENIDOS MULTIMEDIA (VIDEOS, LIBROS, AUDIOS, EJERCICIOS) ── -->
  <div id="tab-contenido" class="adm-tab-content">
    <div class="adm-page-header">
      <div>
        <h2>Gestión de Contenidos Multimedia</h2>
        <p>Modifica y añade videos, libros (PDFs), audios y ejercicios del curso seleccionado</p>
      </div>
      <div>
        <form method="get" action="index.php" class="adm-inline-form">
          <input type="hidden" name="page" value="admin">
          <input type="hidden" name="tab" value="contenido">
          <label style="font-size:.85rem;font-weight:700;color:#0f172a">Seleccionar Curso:</label>
          <select name="curso_id" class="adm-role-select" onchange="this.form.submit()" style="font-weight:600;min-width:240px">
            <?php foreach ($cursos as $cur): ?>
              <option value="<?= (int)$cur['id'] ?>" <?= (int)$cur['id'] === $selectedCursoId ? 'selected' : '' ?>>
                <?= htmlspecialchars($cur['titulo']) ?> (Sem. <?= (int)$cur['semestre'] ?>)
              </option>
            <?php endforeach; ?>
          </select>
        </form>
      </div>
    </div>

    <?php if ($selectedCurso): ?>
      <!-- Tarjeta resumen del curso -->
      <div class="adm-course-card">
        <?php if (!empty($selectedCurso['imagen_url'])): ?>
          <img src="<?= htmlspecialchars($selectedCurso['imagen_url']) ?>" class="adm-course-thumb" alt="Portada">
        <?php else: ?>
          <div class="adm-course-thumb"><i class="fi fi-rr-book-alt"></i></div>
        <?php endif; ?>
        <div style="flex:1">
          <div style="font-size:1.15rem;font-weight:800;color:#0f172a"><?= htmlspecialchars($selectedCurso['titulo']) ?></div>
          <div style="font-size:.82rem;color:#64748b;margin-top:2px">
            Código: <strong><?= htmlspecialchars($selectedCurso['codigo']) ?></strong> · 
            Semestre: <strong><?= (int)$selectedCurso['semestre'] ?></strong> · 
            Nivel: <strong><?= ucfirst(htmlspecialchars($selectedCurso['nivel'])) ?></strong> · 
            Categoría: <strong><?= htmlspecialchars($selectedCurso['categoria']) ?></strong>
          </div>
        </div>
        <div>
          <a href="index.php?page=aula" target="_blank" class="adm-action-btn"><i class="fi fi-rr-eye"></i> Ver en el Aula</a>
        </div>
      </div>

      <!-- Sub-pestañas de contenidos -->
      <div class="adm-subtabs">
        <button class="adm-subtab-btn active" data-sub="videos" onclick="showSubTab('videos')"><i class="fi fi-rr-video-camera-alt" style="margin-right:4px;"></i> Videos y Lecciones (<?= count($leccionesCurso) ?>)</button>
        <button class="adm-subtab-btn" data-sub="libros" onclick="showSubTab('libros')"><i class="fi fi-rr-book-open-cover" style="margin-right:4px;"></i> Libros y Ebooks (<?= count($librosCurso) ?>)</button>
        <button class="adm-subtab-btn" data-sub="audios" onclick="showSubTab('audios')"><i class="fi fi-rr-headphones" style="margin-right:4px;"></i> Audios y Podcasts (<?= count($audiosCurso) ?>)</button>
        <button class="adm-subtab-btn" data-sub="ejercicios" onclick="showSubTab('ejercicios')"><i class="fi fi-rr-edit" style="margin-right:4px;"></i> Ejercicios y Quizzes (<?= count($ejerciciosCurso) ?>)</button>
      </div>

      <!-- SUB-TAB: VIDEOS / LECCIONES -->
      <div id="sub-videos" class="adm-subcontent active">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:14px">
          <h3 style="margin:0;font-size:1.05rem;color:#0f172a">Lista de Lecciones y Videos</h3>
          <button class="adm-action-btn primary" onclick="toggleElem('box-nueva-leccion')"><i class="fi fi-rr-plus"></i> Agregar Nueva Lección</button>
        </div>

        <div id="box-nueva-leccion" class="adm-collapse-box" style="display:none">
          <h4 style="margin:0 0 12px;color:#0f172a">Nueva Lección en: <em><?= htmlspecialchars($selectedCurso['titulo']) ?></em></h4>
          <form method="post" action="index.php?page=admin/lecciones/crear">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf) ?>">
            <input type="hidden" name="curso_id" value="<?= (int)$selectedCurso['id'] ?>">
            <div class="adm-form-row" style="margin-bottom:10px">
              <div class="adm-form-group"><label>Título de la Lección</label><input class="adm-input" name="titulo" required placeholder="Ej: Fundamentos del Ahorro Inteligente"></div>
              <div class="adm-form-group"><label>Duración (ej: 14:30)</label><input class="adm-input" name="duracion" value="15:00"></div>
              <div class="adm-form-group"><label>Orden de visualización</label><input class="adm-input" type="number" name="orden" value="<?= count($leccionesCurso) + 1 ?>"></div>
            </div>
            <div class="adm-form-group">
              <label>URL del Video (YouTube, Vimeo o URL .mp4)</label>
              <input class="adm-input" name="video_url" placeholder="https://www.youtube.com/watch?v=... o https://player.vimeo.com/video/...">
            </div>
            <div class="adm-form-group">
              <label>Contenido / Resumen / Instrucciones de la clase</label>
              <textarea class="adm-input" name="contenido" rows="3" placeholder="Puntos clave de la lección, notas o resumen para el alumno..."></textarea>
            </div>
            <div style="display:flex;gap:10px">
              <button class="adm-action-btn primary">Guardar Lección</button>
              <button type="button" class="adm-action-btn" onclick="toggleElem('box-nueva-leccion')">Cancelar</button>
            </div>
          </form>
        </div>

        <div class="adm-table-card">
          <table class="adm-table">
            <thead>
              <tr>
                <th>Orden</th>
                <th>Lección</th>
                <th>Duración</th>
                <th>Video URL</th>
                <th>Estado</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php if (empty($leccionesCurso)): ?>
                <tr><td colspan="6" class="adm-empty">No hay lecciones registradas en este curso.</td></tr>
              <?php else: foreach ($leccionesCurso as $lec): ?>
                <tr>
                  <td style="font-weight:700;color:#64748b">#<?= (int)$lec['orden'] ?></td>
                  <td>
                    <div style="font-weight:700;color:#0f172a"><?= htmlspecialchars($lec['titulo']) ?></div>
                    <div style="font-size:.78rem;color:#64748b;max-width:320px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">
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
                  <td>
                    <span class="adm-badge <?= $lec['activo'] ? 'activo' : 'inactivo' ?>"><?= $lec['activo'] ? 'Activa' : 'Inactiva' ?></span>
                  </td>
                  <td>
                    <div style="display:flex;gap:6px">
                      <details class="adm-edit-details">
                        <summary>Editar</summary>
                        <form method="post" action="index.php?page=admin/lecciones/actualizar" style="margin-top:8px;background:#fff;border:1px solid #e2e8f0;padding:12px;border-radius:8px">
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

      <!-- SUB-TAB: LIBROS / EBOOKS -->
      <div id="sub-libros" class="adm-subcontent">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:14px">
          <h3 style="margin:0;font-size:1.05rem;color:#0f172a">Libros, Ebooks y Lecturas Recomendadas</h3>
          <button class="adm-action-btn primary" onclick="toggleElem('box-nuevo-libro')"><i class="fi fi-rr-plus"></i> Agregar Libro / Ebook</button>
        </div>

        <div id="box-nuevo-libro" class="adm-collapse-box" style="display:none">
          <h4 style="margin:0 0 12px;color:#0f172a">Añadir Libro a: <em><?= htmlspecialchars($selectedCurso['titulo']) ?></em></h4>
          <form method="post" action="index.php?page=admin/libros/crear" enctype="multipart/form-data">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf) ?>">
            <input type="hidden" name="curso_id" value="<?= (int)$selectedCurso['id'] ?>">
            <div class="adm-form-row" style="margin-bottom:10px">
              <div class="adm-form-group"><label>Título del Libro</label><input class="adm-input" name="titulo" required placeholder="Ej: La Psicología del Dinero"></div>
              <div class="adm-form-group"><label>Autor</label><input class="adm-input" name="autor" placeholder="Morgan Housel"></div>
              <div class="adm-form-group"><label>Tipo de material</label>
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
                <label>O Enlace URL Directo al PDF (Google Drive o Web)</label>
                <input class="adm-input" name="archivo_url" placeholder="https://drive.google.com/... o ruta del PDF">
              </div>
            </div>
            <div class="adm-form-group">
              <label>Descripción / Sinopsis del Libro</label>
              <textarea class="adm-input" name="descripcion" rows="2" placeholder="Breve reseña sobre qué aprenderá con este libro..."></textarea>
            </div>
            <div style="display:flex;gap:10px">
              <button class="adm-action-btn primary">Guardar Libro (PDF)</button>
              <button type="button" class="adm-action-btn" onclick="toggleElem('box-nuevo-libro')">Cancelar</button>
            </div>
          </form>
        </div>

        <div class="adm-table-card">
          <table class="adm-table">
            <thead>
              <tr>
                <th>Orden</th>
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
                  <td style="font-weight:700;color:#64748b">#<?= (int)$lib['orden'] ?></td>
                  <td>
                    <div style="font-weight:700;color:#0f172a"><i class="fi fi-rr-file-pdf" style="color:#ef4444;margin-right:4px;"></i> <?= htmlspecialchars($lib['titulo']) ?></div>
                    <div style="font-size:.78rem;color:#64748b"><?= htmlspecialchars($lib['descripcion'] ?: 'Sin descripción') ?></div>
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
                        <form method="post" action="index.php?page=admin/libros/actualizar" enctype="multipart/form-data" style="margin-top:8px;background:#fff;border:1px solid #e2e8f0;padding:12px;border-radius:8px">
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
                            <label>Cambiar Archivo (PDF/ePub)</label>
                            <input class="adm-input" type="file" name="archivo_file" accept=".pdf,.epub,.doc,.docx" style="margin-bottom:4px">
                            <input class="adm-input" name="archivo_url" value="<?= htmlspecialchars((string)($lib['archivo_url']??'')) ?>" placeholder="O URL de descarga">
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

      <!-- SUB-TAB: AUDIOS / PODCASTS -->
      <div id="sub-audios" class="adm-subcontent">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:14px">
          <h3 style="margin:0;font-size:1.05rem;color:#0f172a">Audios y Podcasts Educativos</h3>
          <button class="adm-action-btn primary" onclick="toggleElem('box-nuevo-audio')"><i class="fi fi-rr-plus"></i> Agregar Audio</button>
        </div>

        <div id="box-nuevo-audio" class="adm-collapse-box" style="display:none">
          <h4 style="margin:0 0 12px;color:#0f172a">Añadir Audio a: <em><?= htmlspecialchars($selectedCurso['titulo']) ?></em></h4>
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
              <label>Descripción / Notas del Audio</label>
              <textarea class="adm-input" name="descripcion" rows="2" placeholder="Resumen de los temas tratados en este podcast..."></textarea>
            </div>
            <div style="display:flex;gap:10px">
              <button class="adm-action-btn primary">Guardar Audio</button>
              <button type="button" class="adm-action-btn" onclick="toggleElem('box-nuevo-audio')">Cancelar</button>
            </div>
          </form>
        </div>

        <div class="adm-table-card">
          <table class="adm-table">
            <thead>
              <tr>
                <th>Orden</th>
                <th>Audio</th>
                <th>Duración</th>
                <th>Reproductor / Enlace</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php if (empty($audiosCurso)): ?>
                <tr><td colspan="5" class="adm-empty">No hay audios registrados en este curso.</td></tr>
              <?php else: foreach ($audiosCurso as $aud): ?>
                <tr>
                  <td style="font-weight:700;color:#64748b">#<?= (int)$aud['orden'] ?></td>
                  <td>
                    <div style="font-weight:700;color:#0f172a"><i class="fi fi-rr-headphones"></i> <?= htmlspecialchars($aud['titulo']) ?></div>
                    <div style="font-size:.78rem;color:#64748b"><?= htmlspecialchars($aud['descripcion'] ?: 'Sin notas') ?></div>
                  </td>
                  <td><span class="adm-badge pill"><i class="fi fi-rr-clock"></i> <?= htmlspecialchars($aud['duracion']) ?></span></td>
                  <td>
                    <?php if (!empty($aud['audio_url'])): ?>
                      <audio controls style="height:32px;max-width:220px">
                        <source src="<?= htmlspecialchars($aud['audio_url']) ?>">
                        Tu navegador no soporta audio.
                      </audio>
                    <?php else: ?>
                      <span style="color:#94a3b8;font-size:.8rem">Sin audio</span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <div style="display:flex;gap:6px">
                      <details class="adm-edit-details">
                        <summary>Editar</summary>
                        <form method="post" action="index.php?page=admin/audios/actualizar" enctype="multipart/form-data" style="margin-top:8px;background:#fff;border:1px solid #e2e8f0;padding:12px;border-radius:8px">
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

      <!-- SUB-TAB: EJERCICIOS / QUIZZES -->
      <div id="sub-ejercicios" class="adm-subcontent">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:14px">
          <h3 style="margin:0;font-size:1.05rem;color:#0f172a">Ejercicios Prácticos y Evaluaciones</h3>
          <button class="adm-action-btn primary" onclick="toggleElem('box-nuevo-ejercicio')"><i class="fi fi-rr-plus"></i> Agregar Ejercicio</button>
        </div>

        <div id="box-nuevo-ejercicio" class="adm-collapse-box" style="display:none">
          <h4 style="margin:0 0 12px;color:#0f172a">Nuevo Ejercicio en: <em><?= htmlspecialchars($selectedCurso['titulo']) ?></em></h4>
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
              <label>Instrucciones / Preguntas / Descripción de la Actividad</label>
              <textarea class="adm-input" name="descripcion" rows="3" required placeholder="Instrucciones paso a paso de lo que debe realizar el estudiante..."></textarea>
            </div>
            <div style="display:flex;gap:10px">
              <button class="adm-action-btn primary">Guardar Ejercicio</button>
              <button type="button" class="adm-action-btn" onclick="toggleElem('box-nuevo-ejercicio')">Cancelar</button>
            </div>
          </form>
        </div>

        <div class="adm-table-card">
          <table class="adm-table">
            <thead>
              <tr>
                <th>Orden</th>
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
                  <td style="font-weight:700;color:#64748b">#<?= (int)$ej['orden'] ?></td>
                  <td><div style="font-weight:700;color:#0f172a"><i class="fi fi-rr-edit" style="color:#6366f1;margin-right:4px;"></i> <?= htmlspecialchars($ej['titulo']) ?></div></td>
                  <td><span class="adm-badge pill"><?= ucfirst(htmlspecialchars($ej['tipo'])) ?></span></td>
                  <td style="font-size:.82rem;color:#475569;max-width:350px">
                    <?= htmlspecialchars(mb_strimwidth($ej['descripcion'], 0, 110, '...')) ?>
                  </td>
                  <td>
                    <div style="display:flex;gap:6px">
                      <details class="adm-edit-details">
                        <summary>Editar</summary>
                        <form method="post" action="index.php?page=admin/ejercicios/actualizar" style="margin-top:8px;background:#fff;border:1px solid #e2e8f0;padding:12px;border-radius:8px">
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
    <?php else: ?>
      <div class="adm-empty">Por favor selecciona un curso para administrar su contenido.</div>
    <?php endif; ?>
  </div>

  <!-- ── 4. GESTIÓN DE USUARIOS ────────────────────────────────────── -->
  <div id="tab-usuarios" class="adm-tab-content">
    <div class="adm-page-header">
      <div>
        <h2>Gestión de Usuarios</h2>
        <p><?= $totalUsuarios ?> usuarios registrados en la plataforma</p>
      </div>
      <div style="display:flex;gap:8px">
        <button type="button" class="adm-action-btn success" onclick="toggleElem('box-nuevo-usuario')">
          <i class="fi fi-rr-user-add"></i> + Nuevo Alumno / Admin
        </button>
        <a href="index.php?page=admin/exportar-pdf&tipo=usuarios" target="_blank" class="adm-action-btn primary">
          <i class="fi fi-rr-file-pdf"></i> Descargar Reporte en PDF
        </a>
        <a href="index.php?page=admin/exportar&tipo=usuarios" class="adm-action-btn" title="Descargar versión Excel">
          <i class="fi fi-rr-file-spreadsheet"></i> Excel (.csv)
        </a>
      </div>
    </div>

    <!-- Caja colapsable para crear nuevo usuario / estudiante -->
    <div id="box-nuevo-usuario" class="adm-collapse-box" style="display:none; margin-bottom:18px;">
      <h4 style="margin:0 0 12px;color:#0f172a"><i class="fi fi-rr-user-add" style="margin-right:6px;color:#16a34a"></i>Registrar Nuevo Usuario / Estudiante</h4>
      <form method="post" action="index.php?page=admin/usuarios/crear">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf) ?>">
        <div class="adm-form-row" style="margin-bottom:10px">
          <div class="adm-form-group">
            <label>Nombre Completo</label>
            <input class="adm-input" name="nombre" required placeholder="Ej: Carlos Ramírez">
          </div>
          <div class="adm-form-group">
            <label>Correo Electrónico</label>
            <input class="adm-input" type="email" name="email" required placeholder="alumno@correo.com">
          </div>
          <div class="adm-form-group">
            <label>Contraseña Inicial (mín. 6 caracteres)</label>
            <input class="adm-input" type="password" name="password" required placeholder="••••••••">
          </div>
        </div>
        <div class="adm-form-row" style="margin-bottom:14px">
          <div class="adm-form-group">
            <label>Rol de Usuario</label>
            <select name="rol" class="adm-select">
              <option value="estudiante" selected>Estudiante</option>
              <option value="admin">Administrador</option>
            </select>
          </div>
          <div class="adm-form-group">
            <label>Membresía Inicial</label>
            <select name="tipo_membresia" class="adm-select">
              <option value="gratis" selected>Gratis (1 mes de prueba)</option>
              <option value="pro">Pro (Acceso completo)</option>
              <option value="premium">Premium (Acceso total anual)</option>
            </select>
          </div>
        </div>
        <div style="display:flex;gap:10px">
          <button type="submit" class="adm-action-btn success"><i class="fi fi-rr-check"></i> Guardar Usuario</button>
          <button type="button" class="adm-action-btn" onclick="toggleElem('box-nuevo-usuario')">Cancelar</button>
        </div>
      </form>
    </div>
    
    <div class="adm-table-card">
      <div class="adm-table-header">
        <h3>Directorio de Alumnos y Administradores</h3>
        <div class="adm-table-actions">
          <input id="userSearch" class="adm-search-input" placeholder="Buscar por nombre o correo..." oninput="filtrarUsuarios()">
          <select id="rolFilter" class="adm-filter-select" onchange="filtrarUsuarios()">
            <option value="">Todos los roles</option>
            <option value="estudiante">Estudiantes</option>
            <option value="admin">Administradores</option>
          </select>
        </div>
      </div>
      <table class="adm-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Usuario</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Registro</th>
            <th>Estado</th>
            <th>Cambiar Rol</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody id="usersTableBody">
          <?php if (empty($usuarios)): ?>
            <tr><td colspan="8" class="adm-empty">No hay usuarios.</td></tr>
          <?php else: foreach ($usuarios as $u): 
            $ini = strtoupper(mb_substr($u['nombre'],0,1)); 
            $isAdmin = $u['rol'] === 'admin'; 
            $isSelf = (int)$u['id'] === (int)($user['id'] ?? 0); 
          ?>
            <tr class="user-row" data-nombre="<?= htmlspecialchars(strtolower($u['nombre'])) ?>" data-email="<?= htmlspecialchars(strtolower($u['email'])) ?>" data-rol="<?= htmlspecialchars($u['rol']) ?>">
              <td>#<?= (int)$u['id'] ?></td>
              <td>
                <div class="adm-user-cell">
                  <div class="adm-user-avatar <?= $isAdmin ? 'is-admin' : '' ?>"><?= $ini ?></div>
                  <span style="font-weight:600;color:#0f172a"><?= htmlspecialchars($u['nombre']) ?></span>
                </div>
              </td>
              <td style="color:#64748b"><?= htmlspecialchars($u['email']) ?></td>
              <td><span class="adm-badge <?= htmlspecialchars($u['rol']) ?>"><?= $isAdmin ? 'Admin' : 'Estudiante' ?></span></td>
              <td style="color:#64748b;font-size:.82rem"><?= date('d/m/Y H:i', strtotime($u['fecha_creacion'])) ?></td>
              <td><span class="adm-badge <?= $u['activo'] ? 'activo' : 'inactivo' ?>"><?= $u['activo'] ? 'Activo' : 'Inactivo' ?></span></td>
              <td>
                <form method="post" action="index.php?page=admin/usuarios/rol" class="adm-inline-form">
                  <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf) ?>">
                  <input type="hidden" name="usuario_id" value="<?= (int)$u['id'] ?>">
                  <select name="rol" class="adm-role-select" onchange="this.form.submit()" <?= $isSelf ? 'disabled' : '' ?>>
                    <option value="estudiante" <?= $u['rol']==='estudiante'?'selected':'' ?>>Estudiante</option>
                    <option value="admin" <?= $u['rol']==='admin'?'selected':'' ?>>Administrador</option>
                  </select>
                </form>
              </td>
              <td>
                <button type="button" class="adm-action-btn" style="background:#0284c7;color:#fff;" onclick="toggleElem('edit-user-<?= (int)$u['id'] ?>')">
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
                <form method="post" action="index.php?page=admin/usuarios/eliminar" class="adm-inline-form" onsubmit="return confirm('¿Seguro que deseas dar de baja este usuario?');">
                  <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf) ?>">
                  <input type="hidden" name="usuario_id" value="<?= (int)$u['id'] ?>">
                  <button class="adm-action-btn danger" <?= $isSelf ? 'disabled' : '' ?>>Eliminar</button>
                </form>
              </td>
            </tr>
            <tr id="edit-user-<?= (int)$u['id'] ?>" style="display:none;background:#f8fafc">
              <td colspan="8" style="padding:14px;">
                <form method="post" action="index.php?page=admin/usuarios/editar" style="background:#fff;border:1px solid #cbd5e1;padding:16px;border-radius:10px;text-align:left;">
                  <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf) ?>">
                  <input type="hidden" name="usuario_id" value="<?= (int)$u['id'] ?>">
                  <h4 style="margin:0 0 10px;color:#0f172a;font-size:0.95rem;">
                    <i class="fi fi-rr-edit" style="color:#0284c7;margin-right:6px"></i>Editar Usuario #<?= (int)$u['id'] ?>: <?= htmlspecialchars($u['nombre']) ?>
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

  <!-- ── 5. INSCRIPCIONES ─────────────────────────────────────────── -->
  <div id="tab-inscripciones" class="adm-tab-content">
    <div class="adm-page-header">
      <div>
        <h2>Inscripciones de Alumnos</h2>
        <p>Materias y asignaturas inscritas por los estudiantes en la retícula</p>
      </div>
      <div style="display:flex;gap:8px">
        <a href="index.php?page=admin/exportar-pdf&tipo=inscripciones" target="_blank" class="adm-action-btn primary">
          <i class="fi fi-rr-file-pdf"></i> Descargar Reporte en PDF
        </a>
        <a href="index.php?page=admin/exportar&tipo=inscripciones" class="adm-action-btn" title="Descargar versión Excel">
          <i class="fi fi-rr-file-spreadsheet"></i> Excel (.csv)
        </a>
      </div>
    </div>
    
    <div class="adm-table-card">
      <div class="adm-table-header">
        <h3>Historial de Inscripciones (<?= $totalInscripciones ?>)</h3>
        <div class="adm-table-actions">
          <input id="inscSearch" class="adm-search-input" placeholder="Buscar por alumno o materia..." oninput="filtrarInscripciones()">
        </div>
      </div>
      <table class="adm-table">
        <thead>
          <tr>
            <th>ID</th>
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
              <td>#<?= (int)$i['id'] ?></td>
              <td style="font-weight:600;color:#0f172a"><?= htmlspecialchars($i['usuario_nombre']) ?></td>
              <td style="color:#64748b"><?= htmlspecialchars($i['usuario_email']) ?></td>
              <td><span class="adm-badge estudiante"><?= htmlspecialchars($i['materia_id']) ?></span></td>
              <td>Semestre <?= (int)$i['semestre'] ?></td>
              <td style="color:#64748b;font-size:.82rem"><?= date('d/m/Y H:i', strtotime($i['fecha_inscripcion'])) ?></td>
            </tr>
          <?php endforeach; endif; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- ── 6. PROGRESO DE ESTUDIANTES ───────────────────────────────── -->
  <div id="tab-progreso" class="adm-tab-content">
    <div class="adm-page-header">
      <div>
        <h2>Progreso y Avance Académico</h2>
        <p>Monitorea qué porcentaje lleva completado cada alumno en sus cursos</p>
      </div>
      <div style="display:flex;gap:8px">
        <a href="index.php?page=admin/exportar-pdf&tipo=progreso" target="_blank" class="adm-action-btn primary">
          <i class="fi fi-rr-file-pdf"></i> Descargar Reporte en PDF
        </a>
        <a href="index.php?page=admin/exportar&tipo=progreso" class="adm-action-btn" title="Descargar versión Excel">
          <i class="fi fi-rr-file-spreadsheet"></i> Excel (.csv)
        </a>
      </div>
    </div>

    <div class="adm-table-card">
      <div class="adm-table-header">
        <h3>Avance por Curso (<?= $totalProgresos ?>)</h3>
        <div class="adm-table-actions">
          <input id="progSearch" class="adm-search-input" placeholder="Buscar por alumno o curso..." oninput="filtrarProgreso()">
        </div>
      </div>
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
                <div style="font-weight:600;color:#0f172a"><?= htmlspecialchars($p['usuario_nombre']) ?></div>
                <div style="font-size:.75rem;color:#94a3b8"><?= htmlspecialchars($p['usuario_email']) ?></div>
              </td>
              <td>
                <div style="font-weight:600;color:#334155"><?= htmlspecialchars($p['curso_titulo']) ?></div>
                <div style="font-size:.75rem;color:#94a3b8"><?= htmlspecialchars($p['curso_codigo']) ?></div>
              </td>
              <td style="min-width:140px">
                <div style="font-weight:700;color:#0f172a;margin-bottom:4px"><?= number_format($pct,0) ?>%</div>
                <div style="background:#e2e8f0;border-radius:99px;height:8px;overflow:hidden">
                  <div style="background:#22c55e;height:100%;width:<?= min(100,max(0,$pct)) ?>%"></div>
                </div>
              </td>
              <td><span class="adm-badge <?= $done ? 'activo' : 'estudiante' ?>"><?= $done ? 'Completado' : 'En curso' ?></span></td>
              <td style="color:#64748b;font-size:.82rem"><?= htmlspecialchars($p['fecha_actualizacion'] ?? '-') ?></td>
            </tr>
          <?php endforeach; endif; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- ── 7. LOGROS Y GAMIFICACIÓN ─────────────────────────────────── -->
  <div id="tab-logros" class="adm-tab-content">
    <div class="adm-page-header">
      <div>
        <h2>Logros e Insignias (Gamificación)</h2>
        <p>Insignias y medallas que los alumnos desbloquean al completar retos y acumular puntos</p>
      </div>
      <div>
        <button class="adm-action-btn primary" onclick="toggleElem('box-nuevo-logro')"><i class="fi fi-rr-plus"></i> Crear Nuevo Logro</button>
      </div>
    </div>

    <!-- Formulario para crear logro -->
    <div id="box-nuevo-logro" class="adm-collapse-box" style="display:none">
      <h3 style="margin:0 0 12px;color:#0f172a"><i class="fi fi-rr-trophy" style="color:#f5b800;margin-right:6px;"></i> Crear Nueva Insignia o Logro</h3>
      <form method="post" action="index.php?page=admin/logros/crear">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf) ?>">
        <div class="adm-form-row" style="margin-bottom:10px">
          <div class="adm-form-group"><label>Nombre del Logro</label><input class="adm-input" name="nombre" required placeholder="Ej: Maestro del Presupuesto"></div>
          <div class="adm-form-group"><label>Icono o Clase (ej: fi-rr-trophy, fi-rr-star)</label><input class="adm-input" name="icono" value="fi-rr-medal" required></div>
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
      <div class="adm-table-header"><h3>Catálogo de Logros (<?= count($logros) ?>)</h3></div>
      <table class="adm-table">
        <thead>
          <tr>
            <th>ID</th>
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
              <td>#<?= (int)$l['id'] ?></td>
              <td>
                <div style="font-weight:700;color:#0f172a;font-size:.95rem"><?php if (!empty($l['icono']) && strpos($l['icono'], 'fi-') !== false): ?><i class="fi <?= htmlspecialchars($l['icono']) ?>"></i><?php else: ?><i class="fi fi-rr-medal"></i><?php endif; ?> <?= htmlspecialchars($l['nombre']) ?></div>
                <div style="font-size:.78rem;color:#64748b"><?= htmlspecialchars($l['descripcion']) ?></div>
              </td>
              <td style="font-size:.82rem;color:#475569">
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

  <!-- ── 8. MEMBRESÍAS Y SUSCRIPCIONES ────────────────────────────── -->
  <div id="tab-membresias" class="adm-tab-content">
    <div class="adm-page-header">
      <div>
        <h2>Membresías y Suscripciones</h2>
        <p>Control de planes activos y vencimientos de acceso</p>
      </div>
    </div>
    
    <div class="adm-mem-grid">
      <div class="adm-mem-card"><div class="mem-icon"><i class="fi fi-rr-leaf"></i></div><h4>Plan Gratis</h4><p class="mem-desc">Acceso básico inicial</p><span class="adm-badge gratis"><?= $memPorTipo['gratis'] ?> activas</span></div>
      <div class="adm-mem-card"><div class="mem-icon"><i class="fi fi-rr-star"></i></div><h4>Plan Pro</h4><p class="mem-desc">Acceso ampliado de cursos</p><span class="adm-badge pro"><?= $memPorTipo['pro'] ?> activas</span></div>
      <div class="adm-mem-card"><div class="mem-icon"><i class="fi fi-rr-gem"></i></div><h4>Plan Premium</h4><p class="mem-desc">Acceso total ilimitado</p><span class="adm-badge premium"><?= $memPorTipo['premium'] ?> activas</span></div>
    </div>

    <div class="adm-table-card" style="margin-top:20px">
      <div class="adm-table-header"><h3>Gestión de Alumnos y Suscripción</h3></div>
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
                <div style="font-weight:600;color:#0f172a"><?= htmlspecialchars($m['usuario_nombre']) ?></div>
                <div style="font-size:.75rem;color:#94a3b8"><?= htmlspecialchars($m['usuario_email']) ?></div>
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

  <!-- ── 9. AUDITORÍA ─────────────────────────────────────────────── -->
  <div id="tab-auditoria" class="adm-tab-content">
    <div class="adm-page-header">
      <div>
        <h2>Auditoría de Seguridad</h2>
        <p>Historial reciente de inicios de sesión y modificaciones de perfiles</p>
      </div>
    </div>
    
    <div class="adm-table-card">
      <div class="adm-table-header"><h3>Últimos Inicios de Sesión (Logins)</h3></div>
      <table class="adm-table">
        <thead>
          <tr>
            <th>Fecha</th>
            <th>Usuario</th>
            <th>Email</th>
            <th>IP</th>
            <th>Resultado</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($logins)): ?>
            <tr><td colspan="5" class="adm-empty">Sin registros recientes.</td></tr>
          <?php else: foreach ($logins as $log): ?>
            <tr>
              <td style="color:#64748b;font-size:.82rem"><?= date('d/m/Y H:i', strtotime($log['fecha_intent'])) ?></td>
              <td style="font-weight:600"><?= htmlspecialchars($log['usuario_nombre'] ?: 'Desconocido') ?></td>
              <td style="color:#64748b"><?= htmlspecialchars($log['email']) ?></td>
              <td style="color:#64748b;font-size:.82rem"><?= htmlspecialchars($log['ip_address'] ?: '-') ?></td>
              <td><span class="adm-badge <?= $log['exitoso'] ? 'activo' : 'inactivo' ?>"><?= $log['exitoso'] ? 'Éxito' : 'Fallido' ?></span></td>
            </tr>
          <?php endforeach; endif; ?>
        </tbody>
      </table>
    </div>

    <div class="adm-table-card">
      <div class="adm-table-header"><h3>Cambios Recientes en Perfiles</h3></div>
      <table class="adm-table">
        <thead>
          <tr>
            <th>Fecha</th>
            <th>Usuario</th>
            <th>Campo Cambiado</th>
            <th>Valor Anterior</th>
            <th>Valor Nuevo</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($cambios)): ?>
            <tr><td colspan="5" class="adm-empty">Sin cambios registrados.</td></tr>
          <?php else: foreach ($cambios as $ch): ?>
            <tr>
              <td style="color:#64748b;font-size:.82rem"><?= date('d/m/Y H:i', strtotime($ch['fecha_cambio'])) ?></td>
              <td style="font-weight:600"><?= htmlspecialchars($ch['usuario_nombre'] ?: $ch['email']) ?></td>
              <td><span class="adm-badge estudiante"><?= htmlspecialchars($ch['campo_cambiado']) ?></span></td>
              <td style="color:#64748b"><?= htmlspecialchars($ch['valor_anterior'] ?? '-') ?></td>
              <td style="color:#64748b"><?= htmlspecialchars($ch['valor_nuevo'] ?? '-') ?></td>
            </tr>
          <?php endforeach; endif; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- ── 10. CONFIGURACIÓN Y ANUNCIOS ─────────────────────────────── -->
  <div id="tab-config" class="adm-tab-content">
    <div class="adm-page-header">
      <div>
        <h2>Configuración y Anuncios</h2>
        <p>Ajustes generales de la plataforma, avisos a estudiantes y seguridad</p>
      </div>
    </div>

    <form method="post" action="index.php?page=admin/configuracion">
      <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf) ?>">
      
      <!-- Sección de Anuncio Global -->
      <div class="adm-config-card" style="margin-bottom:20px;border-left:4px solid #0ea5e9">
        <h3><i class="fi fi-rr-bullhorn" style="color:#0ea5e9;margin-right:6px;"></i> Anuncio Global para Estudiantes</h3>
        <p style="font-size:.85rem;color:#64748b;margin:0 0 14px">
          Muestra una barra destacada en la parte superior del aula virtual para todos los alumnos conectados.
        </p>
        <div class="adm-check-row">
          <input type="hidden" name="anuncio_activo" value="0">
          <input type="checkbox" id="anuncio_activo" name="anuncio_activo" value="1" <?= $config['anuncio_activo']==='1'?'checked':'' ?>>
          <label for="anuncio_activo">
            Activar banner de aviso global
            <small>Los estudiantes verán este mensaje fijo en la parte superior.</small>
          </label>
        </div>
        <div class="adm-form-row">
          <div class="adm-form-group" style="flex:2">
            <label>Mensaje del Anuncio</label>
            <input class="adm-input" name="anuncio_texto" placeholder="Ej: ¡Nuevo taller de Finanzas e Inversiones este sábado a las 6:00 PM!" value="<?= htmlspecialchars($config['anuncio_texto']) ?>">
          </div>
          <div class="adm-form-group">
            <label>Estilo / Color</label>
            <select class="adm-input" name="anuncio_tipo">
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
            <label>Nombre de la Plataforma</label>
            <input class="adm-input" name="nombre_plataforma" maxlength="80" required value="<?= htmlspecialchars($config['nombre_plataforma']) ?>">
          </div>
          <div class="adm-form-group">
            <label>Correo de Soporte Técnico</label>
            <input class="adm-input" type="email" name="correo_soporte" value="<?= htmlspecialchars($config['correo_soporte']) ?>">
          </div>
          <div class="adm-form-row">
            <div class="adm-form-group">
              <label>Moneda</label>
              <select class="adm-input" name="moneda">
                <?php foreach (['MXN','USD','EUR','COP','ARS','CLP','PEN'] as $code): ?>
                  <option value="<?= $code ?>" <?= $config['moneda']===$code?'selected':'' ?>><?= $code ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="adm-form-group">
              <label>Zona Horaria</label>
              <input class="adm-input" name="zona_horaria" value="<?= htmlspecialchars($config['zona_horaria']) ?>">
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
              <small>Controla si cualquier usuario puede crear cuenta.</small>
            </label>
          </div>
          <div class="adm-form-row">
            <div class="adm-form-group">
              <label>Máximo Intentos Login</label>
              <input class="adm-input" type="number" name="login_max_intentos" min="1" max="20" value="<?= htmlspecialchars($config['login_max_intentos']) ?>">
            </div>
            <div class="adm-form-group">
              <label>Minutos de Bloqueo</label>
              <input class="adm-input" type="number" name="login_ventana_minutos" min="1" max="120" value="<?= htmlspecialchars($config['login_ventana_minutos']) ?>">
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
              <small>Los estudiantes verán pantalla de espera; admins conservan acceso.</small>
            </label>
          </div>
          <div class="adm-form-group">
            <label>Mensaje de Mantenimiento</label>
            <textarea class="adm-input" name="mensaje_mantenimiento" rows="3" maxlength="500"><?= htmlspecialchars($config['mensaje_mantenimiento']) ?></textarea>
          </div>
        </div>
      </div>

      <div style="margin-bottom:28px">
        <button class="adm-action-btn primary" style="padding:10px 22px;font-size:.9rem"><i class="fi fi-rr-disk"></i> Guardar Toda la Configuración</button>
      </div>
    </form>

    <div class="adm-config-card" style="margin-bottom:24px">
      <h3>Seguridad: Cambiar Contraseña del Administrador</h3>
      <form method="post" action="index.php?page=admin/password">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf) ?>">
        <div class="adm-form-row" style="grid-template-columns:repeat(auto-fit,minmax(180px,1fr))">
          <div class="adm-form-group"><label>Contraseña Actual</label><input class="adm-input" type="password" name="password_actual" required></div>
          <div class="adm-form-group"><label>Nueva Contraseña</label><input class="adm-input" type="password" name="password_nueva" minlength="8" required></div>
          <div class="adm-form-group"><label>Confirmar Nueva Contraseña</label><input class="adm-input" type="password" name="password_confirmar" minlength="8" required></div>
        </div>
        <p class="adm-help" style="margin:0 0 12px">Mínimo 8 caracteres, al menos una mayúscula, un número y un carácter especial.</p>
        <button class="adm-action-btn">Actualizar Contraseña</button>
      </form>
    </div>
  </div>
</main>

<script>
function showAdminTab(tabName){
  document.querySelectorAll('.adm-tab-content').forEach(function(el){el.classList.remove('active');el.style.display='none';});
  document.querySelectorAll('.adm-sidebar-link').forEach(function(el){el.classList.remove('active');});
  var tab = document.getElementById('tab-' + tabName);
  if(tab){ tab.style.display='block'; tab.classList.add('active'); }
  var link = document.querySelector('[data-tab="' + tabName + '"]');
  if(link){ link.classList.add('active'); }
}

function showSubTab(subName){
  document.querySelectorAll('.adm-subcontent').forEach(function(el){el.classList.remove('active');el.style.display='none';});
  document.querySelectorAll('.adm-subtab-btn').forEach(function(el){el.classList.remove('active');});
  var sub = document.getElementById('sub-' + subName);
  if(sub){ sub.style.display='block'; sub.classList.add('active'); }
  var btn = document.querySelector('[data-sub="' + subName + '"]');
  if(btn){ btn.classList.add('active'); }
}

function toggleElem(id){
  var el = document.getElementById(id);
  if(el){ el.style.display = (el.style.display === 'none' || el.style.display === '') ? 'block' : 'none'; }
}

function filtrarUsuarios(){
  var s = (document.getElementById('userSearch').value || '').toLowerCase();
  var r = document.getElementById('rolFilter').value;
  document.querySelectorAll('.user-row').forEach(function(row){
    var n = row.getAttribute('data-nombre') || '', e = row.getAttribute('data-email') || '', rol = row.getAttribute('data-rol') || '';
    row.style.display = ((n.indexOf(s) !== -1 || e.indexOf(s) !== -1) && (!r || rol === r)) ? '' : 'none';
  });
}

function filtrarInscripciones(){
  var s = (document.getElementById('inscSearch').value || '').toLowerCase();
  document.querySelectorAll('.insc-row').forEach(function(row){
    var e = row.getAttribute('data-estudiante') || '', m = row.getAttribute('data-materia') || '';
    row.style.display = (e.indexOf(s) !== -1 || m.indexOf(s) !== -1) ? '' : 'none';
  });
}

function filtrarProgreso(){
  var s = (document.getElementById('progSearch').value || '').toLowerCase();
  document.querySelectorAll('.prog-row').forEach(function(row){
    var e = row.getAttribute('data-estudiante') || '', c = row.getAttribute('data-curso') || '';
    row.style.display = (e.indexOf(s) !== -1 || c.indexOf(s) !== -1) ? '' : 'none';
  });
}

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

function adminLogout(){
  try{localStorage.removeItem('edu_fin_session');}catch(e){}
  fetch('api/index.php?endpoint=logout',{method:'POST',credentials:'include'}).finally(function(){
    window.location.href='index.php';
  });
}

document.addEventListener('DOMContentLoaded',function(){
  var p = new URLSearchParams(window.location.search);
  var t = p.get('tab');
  var sec = p.get('sec');
  var validTabs = ['dashboard','contenido','inscripciones','progreso','logros','usuarios','membresias','auditoria','config'];
  showAdminTab(validTabs.indexOf(t) !== -1 ? t : 'dashboard');
  if(sec){ showSubTab(sec); }
});
</script>
