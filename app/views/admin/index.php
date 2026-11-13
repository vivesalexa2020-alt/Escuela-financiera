<?php
/**
 * Vista: Panel de Administración Completo
 * Variables: $stats, $usuarios, $flash, $user
 */
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
], $config ?? []);
$adminName = htmlspecialchars($user['name'] ?? 'Administrador');
$adminRol  = htmlspecialchars($user['rol'] ?? 'admin');
$totalUsuarios = (int)($stats['usuarios'] ?? 0);
$totalAdmins   = (int)($stats['admins'] ?? 0);
$totalCursos   = (int)($stats['cursos'] ?? 0);
$totalCursosActivos = (int)($stats['cursos_activos'] ?? 0);
$totalMembresias = (int)($stats['membresias'] ?? 0);
$totalInscripciones = (int)($stats['inscripciones'] ?? 0);
$totalEstudiantes = $totalUsuarios - $totalAdmins;
$totalLecciones = array_sum(array_map(fn($c) => (int)($c['total_lecciones'] ?? 0), $cursos ?? []));
$totalEjercicios = array_sum(array_map(fn($c) => (int)($c['total_ejercicios'] ?? 0), $cursos ?? []));
$memPorTipo = ['gratis' => 0, 'pro' => 0, 'premium' => 0];
foreach (($membresias ?? []) as $m) {
    if (!empty($m['activa']) && isset($memPorTipo[$m['tipo_membresia']])) {
        $memPorTipo[$m['tipo_membresia']]++;
    }
}
?>
<style>
/* ═══════════════════════════════════════════════════
   PANEL DE ADMINISTRACIÓN — ESTILO BACKOFFICE / SaaS
   ═══════════════════════════════════════════════════ */

/* Reset para el panel admin */
.admin-page { margin: 0; padding: 0; background: #f1f5f9; }

/* ── TOPBAR ADMIN ── */
.adm-topbar {
  position: fixed; top: 0; left: 0; right: 0; z-index: 1100;
  height: 56px; background: #fff;
  border-bottom: 1px solid #e2e8f0;
  display: flex; align-items: center; justify-content: space-between;
  padding: 0 24px;
  box-shadow: 0 1px 3px rgba(15,23,42,.06);
  font-family: 'Poppins', system-ui, sans-serif;
}
.adm-topbar-left { display: flex; align-items: center; gap: 12px; }
.adm-topbar-badge {
  display: inline-flex; align-items: center; gap: 6px;
  background: #0f172a; color: #e2e8f0;
  padding: 5px 14px; border-radius: 8px;
  font-size: 13px; font-weight: 700; letter-spacing: .02em;
}
.adm-topbar-center {
  font-size: 14px; color: #475569; font-weight: 500;
}
.adm-topbar-center strong { color: #0f172a; }
.adm-topbar-right { display: flex; align-items: center; gap: 10px; }
.adm-btn-student {
  display: inline-flex; align-items: center; gap: 6px;
  padding: 6px 14px; border-radius: 8px;
  background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0;
  font-size: 13px; font-weight: 600; text-decoration: none;
  transition: all .15s;
}
.adm-btn-student:hover { background: #d1fae5; border-color: #6ee7b7; }
.adm-btn-logout {
  display: inline-flex; align-items: center; gap: 5px;
  padding: 6px 14px; border-radius: 8px;
  background: #fef2f2; color: #991b1b; border: 1px solid #fecaca;
  font-size: 13px; font-weight: 600; cursor: pointer;
  transition: all .15s;
}
.adm-btn-logout:hover { background: #fee2e2; border-color: #fca5a5; }

/* ── SIDEBAR ADMIN ── */
.adm-sidebar {
  position: fixed; top: 56px; left: 0; bottom: 0;
  width: 240px; background: #0f172a;
  overflow-y: auto; z-index: 1050;
  display: flex; flex-direction: column;
  font-family: 'Poppins', system-ui, sans-serif;
}
.adm-sidebar-nav { flex: 1; padding: 16px 0; }
.adm-sidebar-title {
  padding: 12px 20px 6px;
  font-size: 10px; font-weight: 700;
  color: #64748b; letter-spacing: .08em;
  text-transform: uppercase;
}
.adm-sidebar-link {
  display: flex; align-items: center; gap: 10px;
  padding: 10px 20px;
  color: #94a3b8; font-size: 14px; font-weight: 500;
  text-decoration: none; border-left: 3px solid transparent;
  transition: all .15s; cursor: pointer;
}
.adm-sidebar-link:hover {
  background: #1e293b; color: #e2e8f0;
}
.adm-sidebar-link.active {
  background: #1e293b; color: #fff;
  border-left-color: #0ea5e9;
}
.adm-sidebar-link .adm-icon { font-size: 16px; width: 22px; text-align: center; }

.adm-sidebar-footer {
  padding: 16px 20px;
  border-top: 1px solid #1e293b;
  display: flex; align-items: center; gap: 10px;
}
.adm-sidebar-avatar {
  width: 36px; height: 36px; border-radius: 50%;
  background: #0ea5e9; color: #fff;
  display: flex; align-items: center; justify-content: center;
  font-size: 15px; font-weight: 700;
}
.adm-sidebar-user-name { color: #e2e8f0; font-size: 13px; font-weight: 600; }
.adm-sidebar-user-role {
  display: inline-block;
  font-size: 12px; color: #3b2a00;
  background: #fabb15; padding: 3px 11px;
  border-radius: 99px; font-weight: 800;
  letter-spacing: .04em; text-transform: uppercase;
  box-shadow: 0 2px 8px rgba(250,187,21,.35);
}

/* ── CONTENIDO PRINCIPAL ── */
.adm-main {
  margin-left: 240px; margin-top: 56px;
  padding: 28px 32px 64px;
  min-height: calc(100vh - 56px);
  font-family: 'Poppins', system-ui, sans-serif;
}

/* ── HEADER DE PÁGINA ── */
.adm-page-header {
  display: flex; align-items: center; justify-content: space-between;
  margin-bottom: 24px;
}
.adm-page-header h2 {
  font-size: 1.5rem; font-weight: 700; color: #0f172a; margin: 0;
}
.adm-page-header p {
  font-size: .88rem; color: #64748b; margin: 4px 0 0;
}

/* ── FLASH MESSAGES ── */
.adm-flash {
  padding: 12px 18px; border-radius: 10px;
  margin-bottom: 20px; font-size: .9rem; font-weight: 500;
}
.adm-flash.ok { background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
.adm-flash.error { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }

/* ── TARJETAS KPI ── */
.adm-kpi-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 22px; margin-bottom: 32px;
}
.adm-kpi {
  background: #fff; border-radius: 16px;
  padding: 30px 30px; position: relative;
  border: 1px solid #e2e8f0;
  box-shadow: 0 1px 3px rgba(15,23,42,.04);
  overflow: hidden;
}
.adm-kpi::before {
  content: ''; position: absolute; top: 0; left: 0; right: 0;
  height: 4px; border-radius: 14px 14px 0 0;
}
.adm-kpi.green::before { background: #22c55e; }
.adm-kpi.purple::before { background: #8b5cf6; }
.adm-kpi.blue::before { background: #0ea5e9; }
.adm-kpi.gold::before { background: #f59e0b; }

.adm-kpi-top { display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px; }
.adm-kpi-icon {
  width: 54px; height: 54px; border-radius: 13px;
  display: flex; align-items: center; justify-content: center;
  font-size: 26px;
}
.adm-kpi.green .adm-kpi-icon { background: #dcfce7; }
.adm-kpi.purple .adm-kpi-icon { background: #ede9fe; }
.adm-kpi.blue .adm-kpi-icon { background: #e0f2fe; }
.adm-kpi.gold .adm-kpi-icon { background: #fef3c7; }

.adm-kpi-number { font-size: 2.6rem; font-weight: 800; color: #0f172a; line-height: 1; }
.adm-kpi-label { font-size: .92rem; color: #64748b; font-weight: 500; margin-top: 8px; }

/* ── TABLAS ── */
.adm-table-card {
  background: #fff; border: 1px solid #e2e8f0;
  border-radius: 14px; overflow: hidden;
  box-shadow: 0 1px 3px rgba(15,23,42,.04);
  margin-bottom: 24px;
}
.adm-table-header {
  padding: 18px 22px; display: flex;
  align-items: center; justify-content: space-between;
  flex-wrap: wrap; gap: 12px;
  border-bottom: 1px solid #f1f5f9;
}
.adm-table-header h3 { font-size: 1rem; font-weight: 700; color: #0f172a; margin: 0; }
.adm-table-actions { display: flex; gap: 10px; align-items: center; }

table.adm-table {
  width: 100%; border-collapse: collapse; font-size: .88rem;
}
table.adm-table th, table.adm-table td {
  padding: 12px 16px; text-align: left;
  border-bottom: 1px solid #f1f5f9;
}
table.adm-table th {
  background: #f8fafc; color: #475569;
  font-size: .75rem; font-weight: 700;
  text-transform: uppercase; letter-spacing: .05em;
}
table.adm-table tr:last-child td { border-bottom: none; }
table.adm-table tr:hover td { background: #f8fafc; }

/* ── BADGES ── */
.adm-badge {
  display: inline-flex; align-items: center; gap: 4px;
  padding: 3px 10px; border-radius: 999px;
  font-size: .72rem; font-weight: 700; letter-spacing: .02em;
}
.adm-badge.admin { background: #ede9fe; color: #7c3aed; }
.adm-badge.estudiante { background: #e0f2fe; color: #0369a1; }
.adm-badge.activo { background: #dcfce7; color: #16a34a; }
.adm-badge.inactivo { background: #fee2e2; color: #dc2626; }
.adm-badge.gratis { background: #f1f5f9; color: #475569; }
.adm-badge.pro { background: #fef3c7; color: #b45309; }
.adm-badge.premium { background: #ede9fe; color: #7c3aed; }

/* ── AVATAR USUARIO ── */
.adm-user-cell { display: flex; align-items: center; gap: 10px; }
.adm-user-avatar {
  width: 34px; height: 34px; border-radius: 50%;
  background: #e0f2fe; color: #0369a1;
  display: flex; align-items: center; justify-content: center;
  font-size: 13px; font-weight: 700; flex-shrink: 0;
}
.adm-user-avatar.is-admin { background: #ede9fe; color: #7c3aed; }

/* ── SELECT DE ROL ── */
.adm-role-select {
  padding: 5px 10px; border-radius: 8px;
  border: 1px solid #cbd5e1; background: #fff;
  font-size: .82rem; font-family: inherit;
  cursor: pointer; transition: border-color .15s;
}
.adm-role-select:hover { border-color: #0ea5e9; }
.adm-role-select:focus { outline: none; border-color: #0ea5e9; box-shadow: 0 0 0 3px rgba(14,165,233,.15); }

/* ── ACCIONES DE TABLA ── */
.adm-action-btn {
  display: inline-flex; align-items: center; gap: 4px;
  padding: 5px 10px; border-radius: 7px;
  border: 1px solid #cbd5e1; background: #fff;
  font-size: .76rem; font-weight: 600; font-family: inherit;
  color: #334155; cursor: pointer; white-space: nowrap;
  transition: all .15s;
}
.adm-action-btn:hover { background: #f1f5f9; border-color: #94a3b8; }
.adm-action-btn.danger { color: #b91c1c; border-color: #fecaca; background: #fef2f2; }
.adm-action-btn.danger:hover { background: #fee2e2; border-color: #fca5a5; }
.adm-action-btn.success { color: #15803d; border-color: #bbf7d0; background: #f0fdf4; }
.adm-action-btn.success:hover { background: #dcfce7; border-color: #86efac; }
.adm-inline-form { display: inline-flex; align-items: center; gap: 6px; }
.adm-table td .adm-inline-form + .adm-inline-form { margin-left: 4px; }
.adm-empty { text-align: center; color: #94a3b8; padding: 28px 16px; }
.adm-help { font-size: .8rem; color: #64748b; margin: 10px 0 0; }

/* ── CONFIGURACIÓN ── */
.adm-config-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
  gap: 22px;
  margin-bottom: 24px;
  align-items: start;
}
.adm-config-card {
  background: #fff; border: 1px solid #e2e8f0; border-radius: 14px;
  padding: 24px; box-shadow: 0 1px 3px rgba(15,23,42,.04);
}
.adm-config-card h3 {
  font-size: 1rem; font-weight: 700; color: #0f172a;
  margin: 0 0 18px; display: flex; align-items: center; gap: 8px;
}
.adm-form-group { margin-bottom: 15px; }
.adm-form-group label {
  display: block; font-size: .82rem; font-weight: 600;
  color: #475569; margin-bottom: 6px;
}
.adm-input {
  width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1;
  border-radius: 9px; font-family: inherit; font-size: .88rem;
  color: #0f172a; background: #fff; box-sizing: border-box;
}
.adm-input:focus { outline: none; border-color: #0ea5e9; box-shadow: 0 0 0 3px rgba(14,165,233,.12); }
textarea.adm-input { resize: vertical; min-height: 92px; }
.adm-check-row {
  display: flex; align-items: flex-start; gap: 10px;
  padding: 11px 13px; border: 1px solid #e2e8f0; border-radius: 10px;
  background: #f8fafc; margin-bottom: 14px;
}
.adm-check-row input[type="checkbox"] {
  width: 17px; height: 17px; margin-top: 2px; accent-color: #0ea5e9; flex-shrink: 0;
}
.adm-check-row label { margin: 0; cursor: pointer; }
.adm-check-row small { display: block; font-size: .76rem; color: #64748b; font-weight: 400; margin-top: 2px; }
.adm-form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
.adm-config-actions { margin-top: 6px; }
@media (max-width: 520px) { .adm-form-row { grid-template-columns: 1fr; } }

/* ── BUSCADOR ── */
.adm-search-input {
  padding: 8px 14px; border-radius: 8px;
  border: 1px solid #cbd5e1; background: #fff;
  font-size: .85rem; font-family: inherit;
  min-width: 220px; transition: border-color .15s;
}
.adm-search-input:focus { outline: none; border-color: #0ea5e9; box-shadow: 0 0 0 3px rgba(14,165,233,.15); }
.adm-filter-select {
  padding: 8px 12px; border-radius: 8px;
  border: 1px solid #cbd5e1; background: #fff;
  font-size: .85rem; font-family: inherit;
  cursor: pointer;
}

/* ── SECCIONES / TABS ── */
.adm-tab-content { display: none; }
.adm-tab-content.active { display: block; }

/* ── ACCIONES RÁPIDAS ── */
.adm-quick-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
  gap: 14px; margin-top: 20px;
}
.adm-quick-btn {
  display: flex; align-items: center; gap: 10px;
  padding: 16px 20px; border-radius: 12px;
  background: #fff; border: 1px solid #e2e8f0;
  font-size: .9rem; font-weight: 600; color: #0f172a;
  cursor: pointer; transition: all .15s;
  text-decoration: none;
}
.adm-quick-btn:hover {
  border-color: #0ea5e9; background: #f0f9ff;
  transform: translateY(-1px);
  box-shadow: 0 4px 12px rgba(14,165,233,.1);
}
.adm-quick-btn .q-icon { font-size: 22px; }

/* ── CARDS DE CURSOS ── */
.adm-course-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
  gap: 18px;
}
.adm-course-card {
  background: #fff; border: 1px solid #e2e8f0;
  border-radius: 14px; padding: 22px;
  box-shadow: 0 1px 3px rgba(15,23,42,.04);
}
.adm-course-card h4 { font-size: .95rem; font-weight: 700; color: #0f172a; margin: 0 0 8px; }
.adm-course-meta { font-size: .8rem; color: #64748b; }

/* ── MEMBRESÍAS ── */
.adm-mem-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 18px;
}
.adm-mem-card {
  background: #fff; border: 1px solid #e2e8f0;
  border-radius: 14px; padding: 24px; text-align: center;
}
.adm-mem-card .mem-icon { font-size: 32px; margin-bottom: 8px; }
.adm-mem-card h4 { font-size: 1rem; font-weight: 700; color: #0f172a; margin: 0 0 6px; }
.adm-mem-card .mem-desc { font-size: .82rem; color: #64748b; }

/* ── PLACEHOLDER / PRÓXIMAMENTE ── */
.adm-coming-soon {
  text-align: center; padding: 48px 20px;
  color: #94a3b8; font-size: .95rem;
}
.adm-coming-soon .cs-icon { font-size: 42px; margin-bottom: 12px; }
.adm-coming-soon h4 { color: #475569; font-size: 1.1rem; margin: 0 0 6px; }

/* ── RESPONSIVE ── */
@media (max-width: 768px) {
  .adm-sidebar { width: 200px; }
  .adm-main { margin-left: 200px; padding: 20px 16px 48px; }
  .adm-topbar { padding: 0 12px; }
  .adm-topbar-center { display: none; }
}
@media (max-width: 600px) {
  .adm-sidebar {
    transform: translateX(-100%);
    transition: transform .25s;
  }
  .adm-sidebar.open { transform: translateX(0); }
  .adm-main { margin-left: 0; }
  .adm-kpi-grid { grid-template-columns: repeat(2, 1fr); }
}
</style>

<!-- ════════════════════════════════════════════════════
     TOPBAR ADMIN
     ════════════════════════════════════════════════════ -->
<div class="adm-topbar">
  <div class="adm-topbar-left">
    <span class="adm-topbar-badge">🛡️ PANEL ADMINISTRATIVO</span>
  </div>
  <div class="adm-topbar-center">
    Bienvenido, <strong><?= $adminName ?></strong>
  </div>
  <div class="adm-topbar-right">
    <a href="index.php?page=aula" class="adm-btn-student">🎓 Ingresar al aula virtual</a>
    <button class="adm-btn-logout" onclick="adminLogout()">
      ⬅ Cerrar sesión
    </button>
  </div>
</div>

<!-- ════════════════════════════════════════════════════
     SIDEBAR ADMIN
     ════════════════════════════════════════════════════ -->
<aside class="adm-sidebar" id="admSidebar">
  <nav class="adm-sidebar-nav">
    <div class="adm-sidebar-title">OVERVIEW</div>
    <a class="adm-sidebar-link active" data-tab="dashboard" onclick="showAdminTab('dashboard')">
      <span class="adm-icon">📊</span> Dashboard
    </a>

    <div class="adm-sidebar-title">GESTIÓN</div>
    <a class="adm-sidebar-link" data-tab="usuarios" onclick="showAdminTab('usuarios')">
      <span class="adm-icon">👥</span> Usuarios
    </a>
    <a class="adm-sidebar-link" data-tab="cursos" onclick="showAdminTab('cursos')">
      <span class="adm-icon">📚</span> Cursos
    </a>

    <div class="adm-sidebar-title">FINANZAS</div>
    <a class="adm-sidebar-link" data-tab="membresias" onclick="showAdminTab('membresias')">
      <span class="adm-icon">💳</span> Membresías
    </a>

    <div class="adm-sidebar-title">SISTEMA</div>
    <a class="adm-sidebar-link" data-tab="auditoria" onclick="showAdminTab('auditoria')">
      <span class="adm-icon">🔒</span> Auditoría
    </a>
    <a class="adm-sidebar-link" data-tab="config" onclick="showAdminTab('config')">
      <span class="adm-icon">⚙️</span> Configuración
    </a>
  </nav>

  <div class="adm-sidebar-footer">
    <div class="adm-sidebar-avatar"><?= strtoupper(mb_substr($adminName, 0, 1)) ?></div>
    <div>
      <div class="adm-sidebar-user-name"><?= $adminName ?></div>
      <span class="adm-sidebar-user-role">Admin</span>
    </div>
  </div>
</aside>

<!-- ════════════════════════════════════════════════════
     CONTENIDO PRINCIPAL
     ════════════════════════════════════════════════════ -->
<main class="adm-main">

  <!-- Flash messages -->
  <?php if (!empty($flash)): ?>
    <div class="adm-flash <?= htmlspecialchars($flash['tipo']) ?>">
      <?= htmlspecialchars($flash['texto']) ?>
    </div>
  <?php endif; ?>

  <!-- ═══════════════════════════════════
       TAB: DASHBOARD
       ═══════════════════════════════════ -->
  <div id="tab-dashboard" class="adm-tab-content active">
    <div class="adm-page-header">
      <div>
        <h2>Dashboard General</h2>
        <p>Resumen de la plataforma de Educación Financiera</p>
      </div>
    </div>

    <!-- KPIs -->
    <div class="adm-kpi-grid">
      <div class="adm-kpi green">
        <div class="adm-kpi-top">
          <div class="adm-kpi-icon">👥</div>
        </div>
        <div class="adm-kpi-number"><?= $totalEstudiantes ?></div>
        <div class="adm-kpi-label">Estudiantes</div>
      </div>
      <div class="adm-kpi purple">
        <div class="adm-kpi-top">
          <div class="adm-kpi-icon">🛡️</div>
        </div>
        <div class="adm-kpi-number"><?= $totalAdmins ?></div>
        <div class="adm-kpi-label">Administradores</div>
      </div>
      <div class="adm-kpi blue">
        <div class="adm-kpi-top">
          <div class="adm-kpi-icon">📚</div>
        </div>
        <div class="adm-kpi-number"><?= $totalCursosActivos ?></div>
        <div class="adm-kpi-label">Cursos Activos (<?= $totalCursos ?> total)</div>
      </div>
      <div class="adm-kpi gold">
        <div class="adm-kpi-top">
          <div class="adm-kpi-icon">💳</div>
        </div>
        <div class="adm-kpi-number"><?= $totalMembresias ?></div>
        <div class="adm-kpi-label">Membresías Activas</div>
      </div>
      <div class="adm-kpi green">
        <div class="adm-kpi-top">
          <div class="adm-kpi-icon">🧾</div>
        </div>
        <div class="adm-kpi-number"><?= $totalInscripciones ?></div>
        <div class="adm-kpi-label">Inscripciones a Materias</div>
      </div>
      <div class="adm-kpi purple">
        <div class="adm-kpi-top">
          <div class="adm-kpi-icon">👥</div>
        </div>
        <div class="adm-kpi-number"><?= $totalUsuarios ?></div>
        <div class="adm-kpi-label">Usuarios Totales</div>
      </div>
    </div>

    <!-- Usuarios Recientes -->
    <div class="adm-table-card">
      <div class="adm-table-header">
        <h3>👥 Usuarios Recientes</h3>
        <a class="adm-sidebar-link" style="padding:6px 14px;background:#0ea5e9;color:#fff;border-radius:8px;font-size:13px;font-weight:600;display:inline-flex;" onclick="showAdminTab('usuarios')">
          Ver todos →
        </a>
      </div>
      <table class="adm-table">
        <thead>
          <tr>
            <th>Usuario</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Registro</th>
            <th>Estado</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $recientes = array_slice($usuarios ?? [], 0, 5);
          foreach ($recientes as $u):
            $inicial = strtoupper(mb_substr($u['nombre'], 0, 1));
            $isAdmin = $u['rol'] === 'admin';
          ?>
          <tr>
            <td>
              <div class="adm-user-cell">
                <div class="adm-user-avatar <?= $isAdmin ? 'is-admin' : '' ?>"><?= $inicial ?></div>
                <span style="font-weight:600;color:#0f172a;"><?= htmlspecialchars($u['nombre']) ?></span>
              </div>
            </td>
            <td style="color:#64748b;"><?= htmlspecialchars($u['email']) ?></td>
            <td>
              <span class="adm-badge <?= htmlspecialchars($u['rol']) ?>">
                <?= $isAdmin ? '🛡️ Admin' : '🎓 Estudiante' ?>
              </span>
            </td>
            <td style="color:#64748b;font-size:.82rem;">
              <?= date('d/m/Y', strtotime($u['fecha_creacion'])) ?>
            </td>
            <td>
              <span class="adm-badge <?= $u['activo'] ? 'activo' : 'inactivo' ?>">
                <?= $u['activo'] ? '● Activo' : '● Inactivo' ?>
              </span>
            </td>
          </tr>
          <?php endforeach; ?>
          <?php if (empty($recientes)): ?>
          <tr><td colspan="5" style="text-align:center;color:#94a3b8;padding:32px;">No hay usuarios registrados.</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <!-- Acciones Rápidas -->
    <h3 style="font-size:1rem;font-weight:700;color:#0f172a;margin:0 0 6px;">⚡ Acciones Rápidas</h3>
    <div class="adm-quick-grid">
      <a class="adm-quick-btn" onclick="showAdminTab('usuarios')">
        <span class="q-icon">👥</span> Gestionar Usuarios
      </a>
      <a class="adm-quick-btn" onclick="showAdminTab('cursos')">
        <span class="q-icon">📚</span> Ver Cursos
      </a>
      <a class="adm-quick-btn" onclick="showAdminTab('membresias')">
        <span class="q-icon">💳</span> Membresías
      </a>
      <a class="adm-quick-btn" onclick="showAdminTab('auditoria')">
        <span class="q-icon">🔒</span> Ver Auditoría
      </a>
    </div>
  </div>

  <!-- ═══════════════════════════════════
       TAB: USUARIOS
       ═══════════════════════════════════ -->
  <div id="tab-usuarios" class="adm-tab-content">
    <div class="adm-page-header">
      <div>
        <h2>Gestión de Usuarios</h2>
        <p><?= $totalUsuarios ?> usuarios registrados en la plataforma</p>
      </div>
    </div>

    <div class="adm-table-card">
      <div class="adm-table-header">
        <h3>Directorio de Usuarios</h3>
        <div class="adm-table-actions">
          <input type="text" id="userSearch" class="adm-search-input"
                 placeholder="🔍 Buscar por nombre o email..."
                 oninput="filtrarUsuarios()">
          <select id="rolFilter" class="adm-filter-select" onchange="filtrarUsuarios()">
            <option value="">Todos los roles</option>
            <option value="estudiante">🎓 Estudiantes</option>
            <option value="admin">🛡️ Admins</option>
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
            <th>Registrado</th>
            <th>Estado</th>
            <th>Cambiar Rol</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody id="usersTableBody">
          <?php if (empty($usuarios)): ?>
            <tr><td colspan="8" style="text-align:center;color:#94a3b8;padding:32px;">No hay usuarios registrados.</td></tr>
          <?php else: ?>
            <?php foreach ($usuarios as $u):
              $inicial = strtoupper(mb_substr($u['nombre'], 0, 1));
              $isAdmin = $u['rol'] === 'admin';
              $isSelf  = (int)$u['id'] === (int)($user['id'] ?? 0);
            ?>
            <tr class="user-row"
                data-nombre="<?= htmlspecialchars(strtolower($u['nombre'])) ?>"
                data-email="<?= htmlspecialchars(strtolower($u['email'])) ?>"
                data-rol="<?= htmlspecialchars($u['rol']) ?>">
              <td style="color:#94a3b8;font-weight:600;">#<?= (int)$u['id'] ?></td>
              <td>
                <div class="adm-user-cell">
                  <div class="adm-user-avatar <?= $isAdmin ? 'is-admin' : '' ?>"><?= $inicial ?></div>
                  <span style="font-weight:600;color:#0f172a;"><?= htmlspecialchars($u['nombre']) ?></span>
                </div>
              </td>
              <td style="color:#64748b;"><?= htmlspecialchars($u['email']) ?></td>
              <td>
                <span class="adm-badge <?= htmlspecialchars($u['rol']) ?>">
                  <?= $isAdmin ? '🛡️ Admin' : '🎓 Estudiante' ?>
                </span>
              </td>
              <td style="color:#64748b;font-size:.82rem;">
                <?= date('d/m/Y H:i', strtotime($u['fecha_creacion'])) ?>
              </td>
              <td>
                <span class="adm-badge <?= $u['activo'] ? 'activo' : 'inactivo' ?>">
                  <?= $u['activo'] ? '● Activo' : '● Inactivo' ?>
                </span>
              </td>
              <td>
                <form method="post" action="index.php?page=admin/usuarios/rol" style="display:flex;gap:6px;align-items:center;">
                  <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf) ?>">
                  <input type="hidden" name="usuario_id" value="<?= (int)$u['id'] ?>">
                  <select name="rol" class="adm-role-select" onchange="this.form.submit()" <?= $isSelf ? 'disabled' : '' ?>>
                    <option value="estudiante" <?= $u['rol'] === 'estudiante' ? 'selected' : '' ?>>Estudiante</option>
                    <option value="admin" <?= $u['rol'] === 'admin' ? 'selected' : '' ?>>Administrador</option>
                  </select>
                </form>
              </td>
              <td>
                <form method="post" action="index.php?page=admin/usuarios/estado" class="adm-inline-form">
                  <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf) ?>">
                  <input type="hidden" name="usuario_id" value="<?= (int)$u['id'] ?>">
                  <input type="hidden" name="activo" value="<?= $u['activo'] ? '0' : '1' ?>">
                  <button type="submit" class="adm-action-btn <?= $u['activo'] ? 'danger' : 'success' ?>" <?= $isSelf ? 'disabled title="No puedes desactivar tu propia cuenta"' : '' ?>>
                    <?= $u['activo'] ? '⏸ Desactivar' : '▶ Activar' ?>
                  </button>
                </form>
                <form method="post" action="index.php?page=admin/usuarios/eliminar" class="adm-inline-form" onsubmit="return confirm('¿Eliminar permanentemente esta cuenta?');">
                  <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf) ?>">
                  <input type="hidden" name="usuario_id" value="<?= (int)$u['id'] ?>">
                  <button type="submit" class="adm-action-btn danger" <?= $isSelf ? 'disabled title="No puedes eliminar tu propia cuenta"' : '' ?>>
                    🗑 Eliminar
                  </button>
                </form>
              </td>
            </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- ═══════════════════════════════════
       TAB: CURSOS
       ═══════════════════════════════════ -->
  <div id="tab-cursos" class="adm-tab-content">
    <div class="adm-page-header">
      <div>
        <h2>Gestión de Cursos</h2>
        <p><?= $totalCursosActivos ?> cursos activos de <?= $totalCursos ?> registrados</p>
      </div>
    </div>

    <div class="adm-kpi-grid" style="margin-bottom:24px;">
      <div class="adm-kpi blue">
        <div class="adm-kpi-top"><div class="adm-kpi-icon">📚</div></div>
        <div class="adm-kpi-number"><?= $totalCursosActivos ?></div>
        <div class="adm-kpi-label">Cursos Publicados</div>
      </div>
      <div class="adm-kpi green">
        <div class="adm-kpi-top"><div class="adm-kpi-icon">📝</div></div>
        <div class="adm-kpi-number"><?= $totalLecciones ?></div>
        <div class="adm-kpi-label">Lecciones Totales</div>
      </div>
      <div class="adm-kpi gold">
        <div class="adm-kpi-top"><div class="adm-kpi-icon">🎯</div></div>
        <div class="adm-kpi-number"><?= $totalEjercicios ?></div>
        <div class="adm-kpi-label">Ejercicios Activos</div>
      </div>
    </div>

    <div class="adm-table-card">
      <div class="adm-table-header">
        <h3>Catálogo de Cursos</h3>
      </div>
      <table class="adm-table">
        <thead>
          <tr>
            <th>Curso</th>
            <th>Semestre</th>
            <th>Nivel</th>
            <th>Lecciones</th>
            <th>Ejercicios</th>
            <th>Estado</th>
            <th>Acción</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($cursos)): ?>
            <tr><td colspan="7" class="adm-empty">No hay cursos registrados.</td></tr>
          <?php else: ?>
            <?php foreach ($cursos as $curso): ?>
            <tr>
              <td>
                <div style="font-weight:600;color:#0f172a;"><?= htmlspecialchars($curso['titulo']) ?></div>
                <div style="font-size:.75rem;color:#94a3b8;"><?= htmlspecialchars($curso['codigo']) ?></div>
              </td>
              <td>Semestre <?= (int)$curso['semestre'] ?></td>
              <td><span class="adm-badge estudiante"><?= htmlspecialchars(ucfirst($curso['nivel'])) ?></span></td>
              <td><?= (int)$curso['total_lecciones'] ?></td>
              <td><?= (int)$curso['total_ejercicios'] ?></td>
              <td>
                <span class="adm-badge <?= $curso['activo'] ? 'activo' : 'inactivo' ?>">
                  <?= $curso['activo'] ? '● Activo' : '● Inactivo' ?>
                </span>
              </td>
              <td>
                <form method="post" action="index.php?page=admin/cursos/estado" class="adm-inline-form">
                  <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf) ?>">
                  <input type="hidden" name="curso_id" value="<?= (int)$curso['id'] ?>">
                  <input type="hidden" name="activo" value="<?= $curso['activo'] ? '0' : '1' ?>">
                  <button type="submit" class="adm-action-btn <?= $curso['activo'] ? 'danger' : 'success' ?>">
                    <?= $curso['activo'] ? '⏸ Desactivar' : '▶ Activar' ?>
                  </button>
                </form>
              </td>
            </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <p class="adm-help">El editor visual de cursos, lecciones y ejercicios está planificado para una próxima versión.</p>
  </div>

  <!-- ═══════════════════════════════════
       TAB: MEMBRESÍAS
       ═══════════════════════════════════ -->
  <div id="tab-membresias" class="adm-tab-content">
    <div class="adm-page-header">
      <div>
        <h2>Control de Membresías</h2>
        <p>Gestión de planes y suscripciones</p>
      </div>
    </div>

    <div class="adm-mem-grid">
      <div class="adm-mem-card">
        <div class="mem-icon">🆓</div>
        <h4>Plan Gratis</h4>
        <p class="mem-desc">Acceso básico a cursos de Nivel 1.<br>Sin costo mensual.</p>
        <div style="margin-top:12px;">
          <span class="adm-badge gratis" style="font-size:.85rem;padding:5px 14px;"><?= $memPorTipo['gratis'] ?> activas</span>
        </div>
      </div>
      <div class="adm-mem-card" style="border-color:#f59e0b;">
        <div class="mem-icon">⭐</div>
        <h4>Plan Pro</h4>
        <p class="mem-desc">Acceso a Nivel 1 y 2.<br>Ejercicios y recursos extra.</p>
        <div style="margin-top:12px;">
          <span class="adm-badge pro" style="font-size:.85rem;padding:5px 14px;"><?= $memPorTipo['pro'] ?> activas</span>
        </div>
      </div>
      <div class="adm-mem-card" style="border-color:#8b5cf6;">
        <div class="mem-icon">💎</div>
        <h4>Plan Premium</h4>
        <p class="mem-desc">Acceso completo a los 3 Niveles.<br>Audios, libros y certificado.</p>
        <div style="margin-top:12px;">
          <span class="adm-badge premium" style="font-size:.85rem;padding:5px 14px;"><?= $memPorTipo['premium'] ?> activas</span>
        </div>
      </div>
    </div>

    <div class="adm-table-card" style="margin-top:24px;">
      <div class="adm-table-header">
        <h3>Suscripciones de Usuarios</h3>
      </div>
      <table class="adm-table">
        <thead>
          <tr>
            <th>Usuario</th>
            <th>Plan, estado y vencimiento</th>
            <th>Estado actual</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($membresias)): ?>
            <tr><td colspan="3" class="adm-empty">No hay membresías registradas.</td></tr>
          <?php else: ?>
            <?php foreach ($membresias as $m): ?>
            <tr>
              <td>
                <div style="font-weight:600;color:#0f172a;"><?= htmlspecialchars($m['usuario_nombre']) ?></div>
                <div style="font-size:.75rem;color:#94a3b8;"><?= htmlspecialchars($m['usuario_email']) ?></div>
              </td>
              <td>
                <form method="post" action="index.php?page=admin/membresias/actualizar" class="adm-inline-form" style="flex-wrap:wrap;gap:8px;">
                  <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf) ?>">
                  <input type="hidden" name="membresia_id" value="<?= (int)$m['id'] ?>">
                  <select name="tipo_membresia" class="adm-role-select">
                    <option value="gratis" <?= $m['tipo_membresia'] === 'gratis' ? 'selected' : '' ?>>Gratis</option>
                    <option value="pro" <?= $m['tipo_membresia'] === 'pro' ? 'selected' : '' ?>>Pro</option>
                    <option value="premium" <?= $m['tipo_membresia'] === 'premium' ? 'selected' : '' ?>>Premium</option>
                  </select>
                  <select name="activa" class="adm-role-select">
                    <option value="1" <?= $m['activa'] ? 'selected' : '' ?>>Activa</option>
                    <option value="0" <?= !$m['activa'] ? 'selected' : '' ?>>Inactiva</option>
                  </select>
                  <input type="date" name="fecha_vencimiento" class="adm-search-input" style="min-width:150px;" value="<?= htmlspecialchars($m['fecha_vencimiento'] ? substr($m['fecha_vencimiento'], 0, 10) : '') ?>">
                  <button type="submit" class="adm-action-btn success">💾 Guardar</button>
                </form>
              </td>
              <td>
                <span class="adm-badge <?= $m['activa'] ? 'activo' : 'inactivo' ?>">
                  <?= $m['activa'] ? '● Activa' : '● Inactiva' ?>
                </span>
              </td>
            </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- ═══════════════════════════════════
       TAB: AUDITORÍA
       ═══════════════════════════════════ -->
  <div id="tab-auditoria" class="adm-tab-content">
    <div class="adm-page-header">
      <div>
        <h2>Registro de Auditoría</h2>
        <p>Historial de accesos y acciones del sistema</p>
      </div>
    </div>

    <div class="adm-table-card">
      <div class="adm-table-header">
        <h3>🔐 Intentos de Inicio de Sesión</h3>
      </div>
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
            <tr><td colspan="5" class="adm-empty">No hay registros de acceso.</td></tr>
          <?php else: ?>
            <?php foreach ($logins as $log): ?>
            <tr>
              <td style="color:#64748b;font-size:.82rem;"><?= date('d/m/Y H:i', strtotime($log['fecha_intent'])) ?></td>
              <td style="font-weight:600;"><?= htmlspecialchars($log['usuario_nombre'] ?: 'Desconocido') ?></td>
              <td style="color:#64748b;"><?= htmlspecialchars($log['email']) ?></td>
              <td style="color:#64748b;font-size:.82rem;"><?= htmlspecialchars($log['ip_address'] ?: '—') ?></td>
              <td>
                <span class="adm-badge <?= $log['exitoso'] ? 'activo' : 'inactivo' ?>">
                  <?= $log['exitoso'] ? '✓ Éxito' : '✗ Fallido' ?>
                </span>
              </td>
            </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <div class="adm-table-card">
      <div class="adm-table-header">
        <h3>📝 Cambios de Perfil</h3>
      </div>
      <table class="adm-table">
        <thead>
          <tr>
            <th>Fecha</th>
            <th>Usuario</th>
            <th>Campo</th>
            <th>Anterior</th>
            <th>Nuevo</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($cambios)): ?>
            <tr><td colspan="5" class="adm-empty">No hay cambios de perfil registrados.</td></tr>
          <?php else: ?>
            <?php foreach ($cambios as $cambio): ?>
            <tr>
              <td style="color:#64748b;font-size:.82rem;"><?= date('d/m/Y H:i', strtotime($cambio['fecha_cambio'])) ?></td>
              <td style="font-weight:600;"><?= htmlspecialchars($cambio['usuario_nombre'] ?: $cambio['email']) ?></td>
              <td><span class="adm-badge estudiante"><?= htmlspecialchars($cambio['campo_cambiado']) ?></span></td>
              <td style="color:#64748b;"><?= htmlspecialchars($cambio['valor_anterior'] ?? '—') ?></td>
              <td style="color:#64748b;"><?= htmlspecialchars($cambio['valor_nuevo'] ?? '—') ?></td>
            </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- ═══════════════════════════════════
       TAB: CONFIGURACIÓN
       ═══════════════════════════════════ -->
  <div id="tab-config" class="adm-tab-content">
    <div class="adm-page-header">
      <div>
        <h2>Configuración del Sistema</h2>
        <p>Ajustes generales, registro, seguridad y mantenimiento</p>
      </div>
    </div>

    <form method="post" action="index.php?page=admin/configuracion">
      <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf) ?>">
      <div class="adm-config-grid">
        <div class="adm-config-card">
          <h3>🌐 Información General</h3>
          <div class="adm-form-group">
            <label for="nombre_plataforma">Nombre de la plataforma</label>
            <input class="adm-input" type="text" id="nombre_plataforma" name="nombre_plataforma" maxlength="80" required value="<?= htmlspecialchars($config['nombre_plataforma']) ?>">
          </div>
          <div class="adm-form-group">
            <label for="correo_soporte">Correo de soporte</label>
            <input class="adm-input" type="email" id="correo_soporte" name="correo_soporte" value="<?= htmlspecialchars($config['correo_soporte']) ?>" placeholder="soporte@tudominio.com">
          </div>
          <div class="adm-form-row">
            <div class="adm-form-group">
              <label for="moneda">Moneda</label>
              <select class="adm-input" id="moneda" name="moneda">
                <?php foreach (['MXN' => 'Peso mexicano (MXN)', 'USD' => 'Dólar (USD)', 'EUR' => 'Euro (EUR)', 'COP' => 'Peso colombiano (COP)', 'ARS' => 'Peso argentino (ARS)', 'CLP' => 'Peso chileno (CLP)', 'PEN' => 'Sol (PEN)'] as $code => $label): ?>
                  <option value="<?= $code ?>" <?= $config['moneda'] === $code ? 'selected' : '' ?>><?= $label ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="adm-form-group">
              <label for="zona_horaria">Zona horaria</label>
              <select class="adm-input" id="zona_horaria" name="zona_horaria">
                <?php
                $zonas = ['America/Mexico_City', 'America/Cancun', 'America/Monterrey', 'America/Tijuana', 'America/Bogota', 'America/Lima', 'America/Santiago', 'America/Argentina/Buenos_Aires', 'America/New_York', 'Europe/Madrid', 'UTC'];
                if (!in_array($config['zona_horaria'], $zonas, true)) $zonas[] = $config['zona_horaria'];
                foreach ($zonas as $zona): ?>
                  <option value="<?= htmlspecialchars($zona) ?>" <?= $config['zona_horaria'] === $zona ? 'selected' : '' ?>><?= htmlspecialchars($zona) ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
        </div>

        <div class="adm-config-card">
          <h3>👥 Registro y Acceso</h3>
          <div class="adm-check-row">
            <input type="hidden" name="permitir_registro" value="0">
            <input type="checkbox" id="permitir_registro" name="permitir_registro" value="1" <?= $config['permitir_registro'] === '1' ? 'checked' : '' ?>>
            <label for="permitir_registro">Permitir registro de nuevas cuentas
              <small>Si se desactiva, nadie podrá crear cuentas nuevas desde la web.</small>
            </label>
          </div>
          <div class="adm-form-row">
            <div class="adm-form-group">
              <label for="login_max_intentos">Intentos de login permitidos</label>
              <input class="adm-input" type="number" id="login_max_intentos" name="login_max_intentos" min="1" max="20" required value="<?= htmlspecialchars($config['login_max_intentos']) ?>">
            </div>
            <div class="adm-form-group">
              <label for="login_ventana_minutos">Minutos de bloqueo</label>
              <input class="adm-input" type="number" id="login_ventana_minutos" name="login_ventana_minutos" min="1" max="120" required value="<?= htmlspecialchars($config['login_ventana_minutos']) ?>">
            </div>
          </div>
        </div>

        <div class="adm-config-card">
          <h3>🚧 Modo Mantenimiento</h3>
          <div class="adm-check-row">
            <input type="hidden" name="modo_mantenimiento" value="0">
            <input type="checkbox" id="modo_mantenimiento" name="modo_mantenimiento" value="1" <?= $config['modo_mantenimiento'] === '1' ? 'checked' : '' ?>>
            <label for="modo_mantenimiento">Activar modo mantenimiento
              <small>Los visitantes verán el aviso; los administradores conservan el acceso.</small>
            </label>
          </div>
          <div class="adm-form-group">
            <label for="mensaje_mantenimiento">Mensaje para los visitantes</label>
            <textarea class="adm-input" id="mensaje_mantenimiento" name="mensaje_mantenimiento" maxlength="500"><?= htmlspecialchars($config['mensaje_mantenimiento']) ?></textarea>
          </div>
        </div>
      </div>

      <div class="adm-config-actions">
        <button type="submit" class="adm-action-btn success" style="padding:10px 20px;font-size:.85rem;">💾 Guardar configuración</button>
      </div>
    </form>

    <div class="adm-config-card" style="margin-bottom:24px;">
      <h3>🔐 Seguridad de la Cuenta</h3>
      <p class="adm-help" style="margin:0 0 16px;">Cambia la contraseña del administrador con el que has iniciado sesión.</p>
      <form method="post" action="index.php?page=admin/password">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf) ?>">
        <div class="adm-form-row" style="grid-template-columns:repeat(3,1fr);">
          <div class="adm-form-group">
            <label for="password_actual">Contraseña actual</label>
            <input class="adm-input" type="password" id="password_actual" name="password_actual" required autocomplete="current-password">
          </div>
          <div class="adm-form-group">
            <label for="password_nueva">Nueva contraseña</label>
            <input class="adm-input" type="password" id="password_nueva" name="password_nueva" minlength="8" required autocomplete="new-password">
          </div>
          <div class="adm-form-group">
            <label for="password_confirmar">Confirmar nueva contraseña</label>
            <input class="adm-input" type="password" id="password_confirmar" name="password_confirmar" minlength="8" required autocomplete="new-password">
          </div>
        </div>
        <p class="adm-help" style="margin:0 0 14px;">Mínimo 8 caracteres, una mayúscula, un número y un carácter especial.</p>
        <button type="submit" class="adm-action-btn" style="padding:10px 20px;font-size:.85rem;">Actualizar contraseña</button>
      </form>
    </div>

    <div class="adm-table-card" style="padding:28px;">
      <h3 style="font-size:1rem;font-weight:700;color:#0f172a;margin:0 0 18px;">📋 Información del Sistema</h3>
      <table class="adm-table" style="max-width:500px;">
        <tbody>
          <tr><td style="font-weight:600;color:#475569;">Plataforma</td><td>Educación Financiera v2.0</td></tr>
          <tr><td style="font-weight:600;color:#475569;">Backend</td><td>PHP 8.2+ (MVC)</td></tr>
          <tr><td style="font-weight:600;color:#475569;">Base de datos</td><td>MySQL / MariaDB</td></tr>
          <tr><td style="font-weight:600;color:#475569;">Servidor</td><td>Apache (XAMPP)</td></tr>
          <tr><td style="font-weight:600;color:#475569;">Usuarios registrados</td><td><?= $totalUsuarios ?> (<?= $totalAdmins ?> admin)</td></tr>
          <tr><td style="font-weight:600;color:#475569;">Cursos activos</td><td><?= $totalCursosActivos ?> de <?= $totalCursos ?></td></tr>
          <tr><td style="font-weight:600;color:#475569;">Membresías activas</td><td><?= $totalMembresias ?></td></tr>
          <tr><td style="font-weight:600;color:#475569;">Inscripciones</td><td><?= $totalInscripciones ?></td></tr>
        </tbody>
      </table>
    </div>

  </div>
  </div>

</main>

<!-- ════════════════════════════════════════════════════
     JAVASCRIPT DEL PANEL ADMIN
     ════════════════════════════════════════════════════ -->
<script>
// ── Navegación por tabs ──
function showAdminTab(tabName) {
  // Ocultar todos los tabs
  document.querySelectorAll('.adm-tab-content').forEach(function(el) {
    el.classList.remove('active');
    el.style.display = 'none';
  });
  // Desactivar todos los links del sidebar
  document.querySelectorAll('.adm-sidebar-link').forEach(function(el) {
    el.classList.remove('active');
  });
  // Mostrar el tab seleccionado
  var tab = document.getElementById('tab-' + tabName);
  if (tab) {
    tab.style.display = 'block';
    tab.classList.add('active');
  }
  // Activar el link del sidebar
  var link = document.querySelector('[data-tab="' + tabName + '"]');
  if (link) link.classList.add('active');
}

// ── Filtrar usuarios en tiempo real ──
function filtrarUsuarios() {
  var search = (document.getElementById('userSearch').value || '').toLowerCase();
  var rolFilter = document.getElementById('rolFilter').value;
  var rows = document.querySelectorAll('.user-row');
  rows.forEach(function(row) {
    var nombre = row.getAttribute('data-nombre') || '';
    var email = row.getAttribute('data-email') || '';
    var rol = row.getAttribute('data-rol') || '';
    var matchSearch = nombre.indexOf(search) !== -1 || email.indexOf(search) !== -1;
    var matchRol = !rolFilter || rol === rolFilter;
    row.style.display = (matchSearch && matchRol) ? '' : 'none';
  });
}

// ── Cerrar sesión ──
function adminLogout() {
  try {
    localStorage.removeItem('edu_fin_session');
  } catch(e) {}
  fetch('api/index.php?endpoint=logout', {
    method: 'POST',
    credentials: 'include'
  }).finally(function() {
    window.location.href = 'index.php';
  });
}

// ── Inicializar: respetar el tab indicado en la URL ──
document.addEventListener('DOMContentLoaded', function() {
  var params = new URLSearchParams(window.location.search);
  var tab = params.get('tab');
  var permitidos = ['dashboard', 'usuarios', 'cursos', 'membresias', 'auditoria', 'config'];
  showAdminTab(permitidos.indexOf(tab) !== -1 ? tab : 'dashboard');
});
</script>
