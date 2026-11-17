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
$memPorTipo = ['gratis' => 0, 'pro' => 0, 'premium' => 0];
foreach (($membresias ?? []) as $m) { if (!empty($m['activa']) && isset($memPorTipo[$m['tipo_membresia']])) $memPorTipo[$m['tipo_membresia']]++; }
?>
<style>
.admin-page{margin:0;padding:0;background:#f1f5f9}
.adm-topbar{position:fixed;top:0;left:0;right:0;z-index:1100;height:56px;background:#fff;border-bottom:1px solid #e2e8f0;display:flex;align-items:center;justify-content:space-between;padding:0 24px;font-family:'Poppins',system-ui,sans-serif}
.adm-topbar-badge{background:#0f172a;color:#e2e8f0;padding:5px 14px;border-radius:8px;font-size:13px;font-weight:700}.adm-topbar-center{font-size:14px;color:#475569}.adm-topbar-right{display:flex;gap:10px}
.adm-btn-student,.adm-btn-logout{padding:6px 14px;border-radius:8px;font-size:13px;font-weight:600;text-decoration:none;cursor:pointer;border:1px solid}
.adm-btn-student{background:#ecfdf5;color:#065f46;border-color:#a7f3d0}.adm-btn-logout{background:#fef2f2;color:#991b1b;border-color:#fecaca}
.adm-sidebar{position:fixed;top:56px;left:0;bottom:0;width:240px;background:#0f172a;overflow-y:auto;display:flex;flex-direction:column;font-family:'Poppins',system-ui,sans-serif}
.adm-sidebar-nav{flex:1;padding:16px 0}.adm-sidebar-title{padding:12px 20px 6px;font-size:10px;font-weight:700;color:#64748b;letter-spacing:.08em}
.adm-sidebar-link{display:flex;align-items:center;gap:10px;padding:10px 20px;color:#94a3b8;font-size:14px;text-decoration:none;border-left:3px solid transparent;cursor:pointer}
.adm-sidebar-link:hover,.adm-sidebar-link.active{background:#1e293b;color:#fff}.adm-sidebar-link.active{border-left-color:#0ea5e9}.adm-icon{width:22px;text-align:center}
.adm-sidebar-footer{padding:16px 20px;border-top:1px solid #1e293b;display:flex;align-items:center;gap:10px}.adm-sidebar-avatar{width:36px;height:36px;border-radius:50%;background:#0ea5e9;color:#fff;display:flex;align-items:center;justify-content:center;font-weight:700}
.adm-sidebar-user-name{color:#e2e8f0;font-size:13px;font-weight:600}.adm-sidebar-user-role{font-size:11px;color:#3b2a00;background:#fabb15;padding:2px 10px;border-radius:99px;font-weight:800}
.adm-main{margin-left:240px;margin-top:56px;padding:28px 32px 64px;min-height:calc(100vh - 56px);font-family:'Poppins',system-ui,sans-serif}
.adm-page-header{margin-bottom:24px}.adm-page-header h2{font-size:1.5rem;font-weight:700;color:#0f172a;margin:0}.adm-page-header p{font-size:.88rem;color:#64748b;margin:4px 0 0}
.adm-flash{padding:12px 18px;border-radius:10px;margin-bottom:20px;font-size:.9rem}.adm-flash.ok{background:#dcfce7;color:#166534;border:1px solid #bbf7d0}.adm-flash.error{background:#fee2e2;color:#991b1b;border:1px solid #fecaca}
.adm-kpi-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:18px;margin-bottom:28px}
.adm-kpi{background:#fff;border-radius:14px;padding:20px;border:1px solid #e2e8f0;position:relative}.adm-kpi::before{content:'';position:absolute;top:0;left:0;right:0;height:4px;border-radius:14px 14px 0 0}.adm-kpi.green::before{background:#22c55e}.adm-kpi.purple::before{background:#8b5cf6}.adm-kpi.blue::before{background:#0ea5e9}.adm-kpi.gold::before{background:#f59e0b}
.adm-kpi-icon{font-size:22px;margin-bottom:6px}.adm-kpi-number{font-size:2rem;font-weight:800;color:#0f172a}.adm-kpi-label{font-size:.85rem;color:#64748b;margin-top:4px}
.adm-table-card{background:#fff;border:1px solid #e2e8f0;border-radius:14px;overflow:hidden;margin-bottom:24px}
.adm-table-header{padding:16px 20px;display:flex;align-items:center;justify-content:space-between;gap:12px;border-bottom:1px solid #f1f5f9;flex-wrap:wrap}.adm-table-header h3{font-size:1rem;font-weight:700;color:#0f172a;margin:0}.adm-table-actions{display:flex;gap:10px;flex-wrap:wrap}
table.adm-table{width:100%;border-collapse:collapse;font-size:.85rem}table.adm-table th,table.adm-table td{padding:11px 14px;text-align:left;border-bottom:1px solid #f1f5f9;vertical-align:top}table.adm-table th{background:#f8fafc;color:#475569;font-size:.73rem;font-weight:700;text-transform:uppercase}
.adm-badge{display:inline-flex;padding:3px 10px;border-radius:999px;font-size:.72rem;font-weight:700}.adm-badge.admin{background:#ede9fe;color:#7c3aed}.adm-badge.estudiante{background:#e0f2fe;color:#0369a1}.adm-badge.activo{background:#dcfce7;color:#16a34a}.adm-badge.inactivo{background:#fee2e2;color:#dc2626}.adm-badge.gratis{background:#f1f5f9;color:#475569}.adm-badge.pro{background:#fef3c7;color:#b45309}.adm-badge.premium{background:#ede9fe;color:#7c3aed}
.adm-user-cell{display:flex;align-items:center;gap:10px}.adm-user-avatar{width:32px;height:32px;border-radius:50%;background:#e0f2fe;color:#0369a1;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:700}.adm-user-avatar.is-admin{background:#ede9fe;color:#7c3aed}
.adm-role-select,.adm-input,.adm-search-input,.adm-filter-select{padding:6px 10px;border-radius:8px;border:1px solid #cbd5e1;background:#fff;font-size:.82rem;font-family:inherit}.adm-input{width:100%;box-sizing:border-box}
.adm-action-btn{display:inline-flex;align-items:center;padding:5px 10px;border-radius:7px;border:1px solid #cbd5e1;background:#fff;font-size:.75rem;font-weight:600;color:#334155;cursor:pointer}.adm-action-btn.danger{color:#b91c1c;border-color:#fecaca;background:#fef2f2}.adm-action-btn.success{color:#15803d;border-color:#bbf7d0;background:#f0fdf4}
.adm-inline-form{display:inline-flex;gap:6px;flex-wrap:wrap;align-items:center}.adm-empty{text-align:center;color:#94a3b8;padding:24px}.adm-help{font-size:.8rem;color:#64748b;margin:8px 0 0}
.adm-tab-content{display:none}.adm-tab-content.active{display:block}
.adm-config-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:20px;margin-bottom:24px}.adm-config-card{background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:22px}.adm-form-group{margin-bottom:14px}.adm-form-group label{display:block;font-size:.82rem;font-weight:600;color:#475569;margin-bottom:6px}.adm-form-row{display:grid;grid-template-columns:1fr 1fr;gap:12px}.adm-check-row{display:flex;gap:10px;padding:10px 12px;border:1px solid #e2e8f0;border-radius:10px;background:#f8fafc;margin-bottom:12px}.adm-check-row small{display:block;color:#64748b;font-weight:400}
.adm-mem-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:16px}.adm-mem-card{background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:22px;text-align:center}.mem-icon{font-size:30px;margin-bottom:8px}.mem-desc{font-size:.82rem;color:#64748b}
.adm-quick-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:12px;margin-top:16px}.adm-quick-btn{display:flex;gap:10px;padding:14px 16px;border-radius:12px;background:#fff;border:1px solid #e2e8f0;font-weight:600;color:#0f172a;cursor:pointer}.adm-quick-btn:hover{border-color:#0ea5e9;background:#f0f9ff}
.adm-edit-details summary{cursor:pointer;color:#0369a1;font-weight:600;font-size:.8rem}.adm-edit-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(140px,1fr));gap:8px;margin-top:10px}.adm-edit-grid textarea{grid-column:1/-1;min-height:70px}
@media(max-width:900px){.adm-sidebar{width:210px}.adm-main{margin-left:210px;padding:20px 16px 48px}}@media(max-width:700px){.adm-sidebar{transform:translateX(-100%)}.adm-main{margin-left:0}.adm-topbar-center{display:none}}
</style>

<div class="adm-topbar">
  <div><span class="adm-topbar-badge">PANEL ADMINISTRATIVO</span></div>
  <div class="adm-topbar-center">Bienvenido, <strong><?= $adminName ?></strong></div>
  <div class="adm-topbar-right"><a href="index.php?page=aula" class="adm-btn-student">Ir al aula (vista estudiante)</a><button class="adm-btn-logout" onclick="adminLogout()">Cerrar sesión</button></div>
</div>

<aside class="adm-sidebar">
  <nav class="adm-sidebar-nav">
    <div class="adm-sidebar-title">OVERVIEW</div>
    <a class="adm-sidebar-link active" data-tab="dashboard" onclick="showAdminTab('dashboard')"><span class="adm-icon">📊</span> Dashboard</a>
    <div class="adm-sidebar-title">GESTIÓN</div>
    <a class="adm-sidebar-link" data-tab="usuarios" onclick="showAdminTab('usuarios')"><span class="adm-icon">👥</span> Usuarios</a>
    <a class="adm-sidebar-link" data-tab="cursos" onclick="showAdminTab('cursos')"><span class="adm-icon">📚</span> Cursos</a>
    <a class="adm-sidebar-link" data-tab="inscripciones" onclick="showAdminTab('inscripciones')"><span class="adm-icon">📝</span> Inscripciones</a>
    <a class="adm-sidebar-link" data-tab="progreso" onclick="showAdminTab('progreso')"><span class="adm-icon">📈</span> Progreso</a>
    <a class="adm-sidebar-link" data-tab="logros" onclick="showAdminTab('logros')"><span class="adm-icon">🏆</span> Logros</a>
    <div class="adm-sidebar-title">FINANZAS</div>
    <a class="adm-sidebar-link" data-tab="membresias" onclick="showAdminTab('membresias')"><span class="adm-icon">💳</span> Membresías</a>
    <div class="adm-sidebar-title">SISTEMA</div>
    <a class="adm-sidebar-link" data-tab="auditoria" onclick="showAdminTab('auditoria')"><span class="adm-icon">🛡</span> Auditoría</a>
    <a class="adm-sidebar-link" data-tab="config" onclick="showAdminTab('config')"><span class="adm-icon">⚙</span> Configuración</a>
  </nav>
  <div class="adm-sidebar-footer"><div class="adm-sidebar-avatar"><?= strtoupper(mb_substr($adminName,0,1)) ?></div><div><div class="adm-sidebar-user-name"><?= $adminName ?></div><span class="adm-sidebar-user-role">Admin</span></div></div>
</aside>

<main class="adm-main">
  <?php if (!empty($flash)): ?><div class="adm-flash <?= htmlspecialchars($flash['tipo']) ?>"><?= htmlspecialchars($flash['texto']) ?></div><?php endif; ?>

  <div id="tab-dashboard" class="adm-tab-content active">
    <div class="adm-page-header"><div><h2>Dashboard General</h2><p>Resumen alineado con la experiencia del estudiante</p></div></div>
    <div class="adm-kpi-grid">
      <div class="adm-kpi green"><div class="adm-kpi-icon">👥</div><div class="adm-kpi-number"><?= $totalEstudiantes ?></div><div class="adm-kpi-label">Estudiantes</div></div>
      <div class="adm-kpi purple"><div class="adm-kpi-icon">🛡</div><div class="adm-kpi-number"><?= $totalAdmins ?></div><div class="adm-kpi-label">Administradores</div></div>
      <div class="adm-kpi blue"><div class="adm-kpi-icon">📚</div><div class="adm-kpi-number"><?= $totalCursosActivos ?></div><div class="adm-kpi-label">Cursos activos</div></div>
      <div class="adm-kpi gold"><div class="adm-kpi-icon">📝</div><div class="adm-kpi-number"><?= $totalInscripciones ?></div><div class="adm-kpi-label">Inscripciones</div></div>
      <div class="adm-kpi green"><div class="adm-kpi-icon">📈</div><div class="adm-kpi-number"><?= $totalProgresos ?></div><div class="adm-kpi-label">Registros de progreso</div></div>
      <div class="adm-kpi purple"><div class="adm-kpi-icon">🏆</div><div class="adm-kpi-number"><?= $totalLogros ?></div><div class="adm-kpi-label">Logros</div></div>
      <div class="adm-kpi blue"><div class="adm-kpi-icon">💳</div><div class="adm-kpi-number"><?= $totalMembresias ?></div><div class="adm-kpi-label">Membresías activas</div></div>
      <div class="adm-kpi gold"><div class="adm-kpi-icon">📖</div><div class="adm-kpi-number"><?= $totalLecciones ?></div><div class="adm-kpi-label">Lecciones / <?= $totalEjercicios ?> ejercicios</div></div>
    </div>
    <div class="adm-quick-grid">
      <a class="adm-quick-btn" onclick="showAdminTab('usuarios')">👥 Usuarios</a>
      <a class="adm-quick-btn" onclick="showAdminTab('cursos')">📚 Cursos</a>
      <a class="adm-quick-btn" onclick="showAdminTab('inscripciones')">📝 Inscripciones</a>
      <a class="adm-quick-btn" onclick="showAdminTab('progreso')">📈 Progreso</a>
      <a class="adm-quick-btn" onclick="showAdminTab('logros')">🏆 Logros</a>
      <a class="adm-quick-btn" onclick="showAdminTab('auditoria')">🛡 Auditoría</a>
    </div>
  </div>

  <div id="tab-usuarios" class="adm-tab-content">
    <div class="adm-page-header"><div><h2>Gestión de Usuarios</h2><p><?= $totalUsuarios ?> usuarios registrados</p></div></div>
    <div class="adm-table-card"><div class="adm-table-header"><h3>Directorio</h3><div class="adm-table-actions"><input id="userSearch" class="adm-search-input" placeholder="Buscar..." oninput="filtrarUsuarios()"><select id="rolFilter" class="adm-filter-select" onchange="filtrarUsuarios()"><option value="">Todos</option><option value="estudiante">Estudiantes</option><option value="admin">Admins</option></select></div></div>
      <table class="adm-table"><thead><tr><th>ID</th><th>Usuario</th><th>Email</th><th>Rol</th><th>Registro</th><th>Estado</th><th>Cambiar rol</th><th>Acciones</th></tr></thead><tbody id="usersTableBody">
        <?php if (empty($usuarios)): ?><tr><td colspan="8" class="adm-empty">No hay usuarios.</td></tr><?php else: foreach ($usuarios as $u): $ini=strtoupper(mb_substr($u['nombre'],0,1)); $isAdmin=$u['rol']==='admin'; $isSelf=(int)$u['id']===(int)($user['id']??0); ?>
        <tr class="user-row" data-nombre="<?= htmlspecialchars(strtolower($u['nombre'])) ?>" data-email="<?= htmlspecialchars(strtolower($u['email'])) ?>" data-rol="<?= htmlspecialchars($u['rol']) ?>">
          <td>#<?= (int)$u['id'] ?></td>
          <td><div class="adm-user-cell"><div class="adm-user-avatar <?= $isAdmin?'is-admin':'' ?>"><?= $ini ?></div><span style="font-weight:600;color:#0f172a"><?= htmlspecialchars($u['nombre']) ?></span></div></td>
          <td style="color:#64748b"><?= htmlspecialchars($u['email']) ?></td>
          <td><span class="adm-badge <?= htmlspecialchars($u['rol']) ?>"><?= $isAdmin?'Admin':'Estudiante' ?></span></td>
          <td style="color:#64748b;font-size:.82rem"><?= date('d/m/Y H:i', strtotime($u['fecha_creacion'])) ?></td>
          <td><span class="adm-badge <?= $u['activo']?'activo':'inactivo' ?>"><?= $u['activo']?'Activo':'Inactivo' ?></span></td>
          <td><form method="post" action="index.php?page=admin/usuarios/rol" class="adm-inline-form"><input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf) ?>"><input type="hidden" name="usuario_id" value="<?= (int)$u['id'] ?>"><select name="rol" class="adm-role-select" onchange="this.form.submit()" <?= $isSelf?'disabled':'' ?>><option value="estudiante" <?= $u['rol']==='estudiante'?'selected':'' ?>>Estudiante</option><option value="admin" <?= $u['rol']==='admin'?'selected':'' ?>>Administrador</option></select></form></td>
          <td>
            <form method="post" action="index.php?page=admin/usuarios/estado" class="adm-inline-form"><input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf) ?>"><input type="hidden" name="usuario_id" value="<?= (int)$u['id'] ?>"><input type="hidden" name="activo" value="<?= $u['activo']?'0':'1' ?>"><button class="adm-action-btn <?= $u['activo']?'danger':'success' ?>" <?= $isSelf?'disabled':'' ?>><?= $u['activo']?'Desactivar':'Activar' ?></button></form>
            <form method="post" action="index.php?page=admin/usuarios/eliminar" class="adm-inline-form" onsubmit="return confirm('¿Eliminar esta cuenta?');"><input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf) ?>"><input type="hidden" name="usuario_id" value="<?= (int)$u['id'] ?>"><button class="adm-action-btn danger" <?= $isSelf?'disabled':'' ?>>Eliminar</button></form>
          </td>
        </tr>
        <?php endforeach; endif; ?>
      </tbody></table>
    </div>
  </div>

  <div id="tab-cursos" class="adm-tab-content">
    <div class="adm-page-header"><div><h2>Gestión de Cursos</h2><p>Contenido que ven los estudiantes en cursos/aula</p></div></div>
    <div class="adm-table-card"><div class="adm-table-header"><h3>Catálogo</h3></div>
      <table class="adm-table"><thead><tr><th>Curso</th><th>Nivel/Sem.</th><th>Contenido</th><th>Estado</th><th>Acciones</th></tr></thead><tbody>
        <?php if (empty($cursos)): ?><tr><td colspan="5" class="adm-empty">No hay cursos.</td></tr><?php else: foreach ($cursos as $curso): ?>
        <tr>
          <td><div style="font-weight:600;color:#0f172a"><?= htmlspecialchars($curso['titulo']) ?></div><div style="font-size:.75rem;color:#94a3b8"><?= htmlspecialchars($curso['codigo']) ?> · <?= htmlspecialchars($curso['categoria']) ?></div></td>
          <td><span class="adm-badge estudiante"><?= htmlspecialchars(ucfirst($curso['nivel'])) ?></span><div style="font-size:.78rem;color:#64748b;margin-top:4px">Sem <?= (int)$curso['semestre'] ?></div></td>
          <td style="font-size:.8rem;color:#475569"><?= (int)$curso['total_lecciones'] ?> lecciones · <?= (int)$curso['total_ejercicios'] ?> ejercicios<br><?= (int)($curso['total_audios']??0) ?> audios · <?= (int)($curso['total_libros']??0) ?> libros</td>
          <td><span class="adm-badge <?= $curso['activo']?'activo':'inactivo' ?>"><?= $curso['activo']?'Activo':'Inactivo' ?></span></td>
          <td>
            <form method="post" action="index.php?page=admin/cursos/estado" class="adm-inline-form" style="margin-bottom:6px"><input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf) ?>"><input type="hidden" name="curso_id" value="<?= (int)$curso['id'] ?>"><input type="hidden" name="activo" value="<?= $curso['activo']?'0':'1' ?>"><button class="adm-action-btn <?= $curso['activo']?'danger':'success' ?>"><?= $curso['activo']?'Desactivar':'Activar' ?></button></form>
            <details class="adm-edit-details"><summary>Editar</summary>
              <form method="post" action="index.php?page=admin/cursos/actualizar" style="margin-top:8px"><input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf) ?>"><input type="hidden" name="curso_id" value="<?= (int)$curso['id'] ?>">
                <div class="adm-edit-grid">
                  <input class="adm-input" name="codigo" value="<?= htmlspecialchars($curso['codigo']) ?>" required>
                  <input class="adm-input" name="semestre" type="number" min="1" max="10" value="<?= (int)$curso['semestre'] ?>" required>
                  <input class="adm-input" name="categoria" value="<?= htmlspecialchars($curso['categoria']) ?>" required>
                  <select class="adm-input" name="nivel"><option value="principiante" <?= $curso['nivel']==='principiante'?'selected':'' ?>>Principiante</option><option value="intermedio" <?= $curso['nivel']==='intermedio'?'selected':'' ?>>Intermedio</option><option value="avanzado" <?= $curso['nivel']==='avanzado'?'selected':'' ?>>Avanzado</option></select>
                  <input class="adm-input" name="duracion_horas" type="number" step="0.5" value="<?= htmlspecialchars((string)$curso['duracion_horas']) ?>">
                  <input class="adm-input" name="orden" type="number" value="<?= (int)$curso['orden'] ?>">
                  <select class="adm-input" name="activo"><option value="1" <?= $curso['activo']?'selected':'' ?>>Activo</option><option value="0" <?= !$curso['activo']?'selected':'' ?>>Inactivo</option></select>
                  <input class="adm-input" name="imagen_url" value="<?= htmlspecialchars((string)($curso['imagen_url']??'')) ?>" placeholder="Imagen URL" style="grid-column:1/-1">
                  <input class="adm-input" name="titulo" value="<?= htmlspecialchars($curso['titulo']) ?>" required style="grid-column:1/-1">
                  <textarea class="adm-input" name="descripcion" required><?= htmlspecialchars($curso['descripcion']) ?></textarea>
                </div>
                <div style="margin-top:8px"><button class="adm-action-btn success">Guardar</button></div>
              </form>
            </details>
          </td>
        </tr>
        <?php endforeach; endif; ?>
      </tbody></table>
    </div>
  </div>

  <div id="tab-inscripciones" class="adm-tab-content">
    <div class="adm-page-header"><div><h2>Inscripciones</h2><p>Materias inscritas por estudiantes (retícula)</p></div></div>
    <div class="adm-table-card"><div class="adm-table-header"><h3>Historial (<?= $totalInscripciones ?>)</h3></div>
      <table class="adm-table"><thead><tr><th>ID</th><th>Estudiante</th><th>Email</th><th>Materia</th><th>Semestre</th><th>Fecha</th></tr></thead><tbody>
        <?php if (empty($inscripciones)): ?><tr><td colspan="6" class="adm-empty">No hay inscripciones.</td></tr><?php else: foreach ($inscripciones as $i): ?>
        <tr><td>#<?= (int)$i['id'] ?></td><td style="font-weight:600;color:#0f172a"><?= htmlspecialchars($i['usuario_nombre']) ?></td><td style="color:#64748b"><?= htmlspecialchars($i['usuario_email']) ?></td><td><span class="adm-badge estudiante"><?= htmlspecialchars($i['materia_id']) ?></span></td><td>Sem <?= (int)$i['semestre'] ?></td><td style="color:#64748b;font-size:.82rem"><?= date('d/m/Y H:i', strtotime($i['fecha_inscripcion'])) ?></td></tr>
        <?php endforeach; endif; ?>
      </tbody></table>
    </div>
  </div>

  <div id="tab-progreso" class="adm-tab-content">
    <div class="adm-page-header"><div><h2>Progreso de Estudiantes</h2><p>Avance por curso (como en aula/metas)</p></div></div>
    <div class="adm-table-card"><div class="adm-table-header"><h3>Registros (<?= $totalProgresos ?>)</h3></div>
      <table class="adm-table"><thead><tr><th>Estudiante</th><th>Curso</th><th>Porcentaje</th><th>Estado</th><th>Actualización</th></tr></thead><tbody>
        <?php if (empty($progresos)): ?><tr><td colspan="5" class="adm-empty">No hay registros.</td></tr><?php else: foreach ($progresos as $p): $pct=(float)$p['porcentaje']; $done=$pct>=100||(int)$p['completado']===1; ?>
        <tr>
          <td><div style="font-weight:600;color:#0f172a"><?= htmlspecialchars($p['usuario_nombre']) ?></div><div style="font-size:.75rem;color:#94a3b8"><?= htmlspecialchars($p['usuario_email']) ?></div></td>
          <td><div style="font-weight:600;color:#334155"><?= htmlspecialchars($p['curso_titulo']) ?></div><div style="font-size:.75rem;color:#94a3b8"><?= htmlspecialchars($p['curso_codigo']) ?></div></td>
          <td style="min-width:140px"><div style="font-weight:700;color:#0f172a;margin-bottom:4px"><?= number_format($pct,0) ?>%</div><div style="background:#e2e8f0;border-radius:99px;height:8px;overflow:hidden"><div style="background:#22c55e;height:100%;width:<?= min(100,max(0,$pct)) ?>%"></div></div></td>
          <td><span class="adm-badge <?= $done?'activo':'estudiante' ?>"><?= $done?'Completado':'En curso' ?></span></td>
          <td style="color:#64748b;font-size:.82rem"><?= htmlspecialchars($p['fecha_actualizacion'] ?? '-') ?></td>
        </tr>
        <?php endforeach; endif; ?>
      </tbody></table>
    </div>
  </div>

  <div id="tab-logros" class="adm-tab-content">
    <div class="adm-page-header"><div><h2>Logros y Gamificación</h2><p>Logros que desbloquean los estudiantes</p></div></div>
    <div class="adm-table-card"><div class="adm-table-header"><h3>Catálogo</h3></div>
      <table class="adm-table"><thead><tr><th>ID</th><th>Logro</th><th>Requisitos</th><th>Desbloqueos</th><th>Estado</th><th>Acción</th></tr></thead><tbody>
        <?php if (empty($logros)): ?><tr><td colspan="6" class="adm-empty">No hay logros.</td></tr><?php else: foreach ($logros as $l): ?>
        <tr>
          <td>#<?= (int)$l['id'] ?></td>
          <td><div style="font-weight:600;color:#0f172a"><?= htmlspecialchars($l['icono'] ?? '🏅') ?> <?= htmlspecialchars($l['nombre']) ?></div><div style="font-size:.78rem;color:#64748b"><?= htmlspecialchars($l['descripcion']) ?></div></td>
          <td style="font-size:.82rem;color:#475569"><?= (int)$l['puntos_requeridos'] ?> pts<?= $l['cursos_requeridos'] ? ' · '.(int)$l['cursos_requeridos'].' cursos' : '' ?></td>
          <td><span class="adm-badge estudiante"><?= (int)($l['total_desbloqueos'] ?? 0) ?></span></td>
          <td><span class="adm-badge <?= $l['activo']?'activo':'inactivo' ?>"><?= $l['activo']?'Activo':'Inactivo' ?></span></td>
          <td><form method="post" action="index.php?page=admin/logros/estado" class="adm-inline-form"><input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf) ?>"><input type="hidden" name="logro_id" value="<?= (int)$l['id'] ?>"><input type="hidden" name="activo" value="<?= $l['activo']?'0':'1' ?>"><button class="adm-action-btn <?= $l['activo']?'danger':'success' ?>"><?= $l['activo']?'Desactivar':'Activar' ?></button></form></td>
        </tr>
        <?php endforeach; endif; ?>
      </tbody></table>
    </div>
  </div>

  <div id="tab-membresias" class="adm-tab-content">
    <div class="adm-page-header"><div><h2>Membresías</h2><p>Planes y suscripciones</p></div></div>
    <div class="adm-mem-grid">
      <div class="adm-mem-card"><div class="mem-icon">🌱</div><h4>Gratis</h4><p class="mem-desc">Básico</p><span class="adm-badge gratis"><?= $memPorTipo['gratis'] ?> activas</span></div>
      <div class="adm-mem-card"><div class="mem-icon">⭐</div><h4>Pro</h4><p class="mem-desc">Ampliado</p><span class="adm-badge pro"><?= $memPorTipo['pro'] ?> activas</span></div>
      <div class="adm-mem-card"><div class="mem-icon">💎</div><h4>Premium</h4><p class="mem-desc">Completo</p><span class="adm-badge premium"><?= $memPorTipo['premium'] ?> activas</span></div>
    </div>
    <div class="adm-table-card" style="margin-top:20px"><div class="adm-table-header"><h3>Suscripciones</h3></div>
      <table class="adm-table"><thead><tr><th>Usuario</th><th>Plan / estado / vencimiento</th><th>Estado</th></tr></thead><tbody>
        <?php if (empty($membresias)): ?><tr><td colspan="3" class="adm-empty">No hay membresías.</td></tr><?php else: foreach ($membresias as $m): ?>
        <tr>
          <td><div style="font-weight:600;color:#0f172a"><?= htmlspecialchars($m['usuario_nombre']) ?></div><div style="font-size:.75rem;color:#94a3b8"><?= htmlspecialchars($m['usuario_email']) ?></div></td>
          <td><form method="post" action="index.php?page=admin/membresias/actualizar" class="adm-inline-form"><input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf) ?>"><input type="hidden" name="membresia_id" value="<?= (int)$m['id'] ?>"><select name="tipo_membresia" class="adm-role-select"><option value="gratis" <?= $m['tipo_membresia']==='gratis'?'selected':'' ?>>Gratis</option><option value="pro" <?= $m['tipo_membresia']==='pro'?'selected':'' ?>>Pro</option><option value="premium" <?= $m['tipo_membresia']==='premium'?'selected':'' ?>>Premium</option></select><select name="activa" class="adm-role-select"><option value="1" <?= $m['activa']?'selected':'' ?>>Activa</option><option value="0" <?= !$m['activa']?'selected':'' ?>>Inactiva</option></select><input type="date" name="fecha_vencimiento" class="adm-input" style="width:auto" value="<?= htmlspecialchars($m['fecha_vencimiento'] ? substr($m['fecha_vencimiento'],0,10) : '') ?>"><button class="adm-action-btn success">Guardar</button></form></td>
          <td><span class="adm-badge <?= $m['activa']?'activo':'inactivo' ?>"><?= $m['activa']?'Activa':'Inactiva' ?></span></td>
        </tr>
        <?php endforeach; endif; ?>
      </tbody></table>
    </div>
  </div>

  <div id="tab-auditoria" class="adm-tab-content">
    <div class="adm-page-header"><div><h2>Auditoría</h2><p>Accesos y cambios</p></div></div>
    <div class="adm-table-card"><div class="adm-table-header"><h3>Inicios de sesión</h3></div>
      <table class="adm-table"><thead><tr><th>Fecha</th><th>Usuario</th><th>Email</th><th>IP</th><th>Resultado</th></tr></thead><tbody>
      <?php if (empty($logins)): ?><tr><td colspan="5" class="adm-empty">Sin registros.</td></tr><?php else: foreach ($logins as $log): ?>
        <tr><td style="color:#64748b;font-size:.82rem"><?= date('d/m/Y H:i', strtotime($log['fecha_intent'])) ?></td><td style="font-weight:600"><?= htmlspecialchars($log['usuario_nombre'] ?: 'Desconocido') ?></td><td style="color:#64748b"><?= htmlspecialchars($log['email']) ?></td><td style="color:#64748b;font-size:.82rem"><?= htmlspecialchars($log['ip_address'] ?: '-') ?></td><td><span class="adm-badge <?= $log['exitoso']?'activo':'inactivo' ?>"><?= $log['exitoso']?'Éxito':'Fallido' ?></span></td></tr>
      <?php endforeach; endif; ?></tbody></table>
    </div>
    <div class="adm-table-card"><div class="adm-table-header"><h3>Cambios de perfil</h3></div>
      <table class="adm-table"><thead><tr><th>Fecha</th><th>Usuario</th><th>Campo</th><th>Anterior</th><th>Nuevo</th></tr></thead><tbody>
      <?php if (empty($cambios)): ?><tr><td colspan="5" class="adm-empty">Sin cambios.</td></tr><?php else: foreach ($cambios as $c): ?>
        <tr><td style="color:#64748b;font-size:.82rem"><?= date('d/m/Y H:i', strtotime($c['fecha_cambio'])) ?></td><td style="font-weight:600"><?= htmlspecialchars($c['usuario_nombre'] ?: $c['email']) ?></td><td><span class="adm-badge estudiante"><?= htmlspecialchars($c['campo_cambiado']) ?></span></td><td style="color:#64748b"><?= htmlspecialchars($c['valor_anterior'] ?? '-') ?></td><td style="color:#64748b"><?= htmlspecialchars($c['valor_nuevo'] ?? '-') ?></td></tr>
      <?php endforeach; endif; ?></tbody></table>
    </div>
  </div>

  <div id="tab-config" class="adm-tab-content">
    <div class="adm-page-header"><div><h2>Configuración</h2><p>Ajustes generales, seguridad y mantenimiento</p></div></div>
    <form method="post" action="index.php?page=admin/configuracion"><input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf) ?>">
      <div class="adm-config-grid">
        <div class="adm-config-card"><h3>General</h3>
          <div class="adm-form-group"><label>Nombre</label><input class="adm-input" name="nombre_plataforma" maxlength="80" required value="<?= htmlspecialchars($config['nombre_plataforma']) ?>"></div>
          <div class="adm-form-group"><label>Correo soporte</label><input class="adm-input" type="email" name="correo_soporte" value="<?= htmlspecialchars($config['correo_soporte']) ?>"></div>
          <div class="adm-form-row"><div class="adm-form-group"><label>Moneda</label><select class="adm-input" name="moneda"><?php foreach (['MXN','USD','EUR','COP','ARS','CLP','PEN'] as $code): ?><option value="<?= $code ?>" <?= $config['moneda']===$code?'selected':'' ?>><?= $code ?></option><?php endforeach; ?></select></div><div class="adm-form-group"><label>Zona horaria</label><input class="adm-input" name="zona_horaria" value="<?= htmlspecialchars($config['zona_horaria']) ?>"></div></div>
        </div>
        <div class="adm-config-card"><h3>Registro y acceso</h3>
          <div class="adm-check-row"><input type="hidden" name="permitir_registro" value="0"><input type="checkbox" id="permitir_registro" name="permitir_registro" value="1" <?= $config['permitir_registro']==='1'?'checked':'' ?>><label for="permitir_registro">Permitir registro<small>Controla si nuevos estudiantes pueden registrarse.</small></label></div>
          <div class="adm-form-row"><div class="adm-form-group"><label>Intentos login</label><input class="adm-input" type="number" name="login_max_intentos" min="1" max="20" value="<?= htmlspecialchars($config['login_max_intentos']) ?>"></div><div class="adm-form-group"><label>Minutos bloqueo</label><input class="adm-input" type="number" name="login_ventana_minutos" min="1" max="120" value="<?= htmlspecialchars($config['login_ventana_minutos']) ?>"></div></div>
        </div>
        <div class="adm-config-card"><h3>Mantenimiento</h3>
          <div class="adm-check-row"><input type="hidden" name="modo_mantenimiento" value="0"><input type="checkbox" id="modo_mantenimiento" name="modo_mantenimiento" value="1" <?= $config['modo_mantenimiento']==='1'?'checked':'' ?>><label for="modo_mantenimiento">Activar mantenimiento<small>Estudiantes ven aviso; admins conservan acceso.</small></label></div>
          <div class="adm-form-group"><label>Mensaje</label><textarea class="adm-input" name="mensaje_mantenimiento" maxlength="500"><?= htmlspecialchars($config['mensaje_mantenimiento']) ?></textarea></div>
        </div>
      </div>
      <div style="margin-bottom:24px"><button class="adm-action-btn success" style="padding:10px 18px">Guardar configuración</button></div>
    </form>
    <div class="adm-config-card" style="margin-bottom:24px"><h3>Seguridad de cuenta admin</h3>
      <form method="post" action="index.php?page=admin/password"><input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf) ?>">
        <div class="adm-form-row" style="grid-template-columns:repeat(3,1fr)"><div class="adm-form-group"><label>Actual</label><input class="adm-input" type="password" name="password_actual" required></div><div class="adm-form-group"><label>Nueva</label><input class="adm-input" type="password" name="password_nueva" minlength="8" required></div><div class="adm-form-group"><label>Confirmar</label><input class="adm-input" type="password" name="password_confirmar" minlength="8" required></div></div>
        <p class="adm-help" style="margin:0 0 12px">Mínimo 8 caracteres, mayúscula, número y carácter especial.</p>
        <button class="adm-action-btn">Actualizar contraseña</button>
      </form>
    </div>
  </div>
</main>

<script>
function showAdminTab(tabName){
  document.querySelectorAll('.adm-tab-content').forEach(function(el){el.classList.remove('active');el.style.display='none';});
  document.querySelectorAll('.adm-sidebar-link').forEach(function(el){el.classList.remove('active');});
  var tab=document.getElementById('tab-'+tabName); if(tab){tab.style.display='block';tab.classList.add('active');}
  var link=document.querySelector('[data-tab="'+tabName+'"]'); if(link)link.classList.add('active');
}
function filtrarUsuarios(){
  var s=(document.getElementById('userSearch').value||'').toLowerCase();
  var r=document.getElementById('rolFilter').value;
  document.querySelectorAll('.user-row').forEach(function(row){
    var n=row.getAttribute('data-nombre')||'',e=row.getAttribute('data-email')||'',rol=row.getAttribute('data-rol')||'';
    row.style.display=((n.indexOf(s)!==-1||e.indexOf(s)!==-1)&&(!r||rol===r))?'':'none';
  });
}
function adminLogout(){
  try{localStorage.removeItem('edu_fin_session');}catch(e){}
  fetch('api/index.php?endpoint=logout',{method:'POST',credentials:'include'}).finally(function(){window.location.href='index.php';});
}
document.addEventListener('DOMContentLoaded',function(){
  var p=new URLSearchParams(window.location.search),t=p.get('tab');
  var ok=['dashboard','usuarios','cursos','inscripciones','progreso','logros','membresias','auditoria','config'];
  showAdminTab(ok.indexOf(t)!==-1?t:'dashboard');
});
</script>
