<?php
/**
 * Vista: Panel de Administración
 * Variables: $stats, $usuarios, $flash, $user
 */
$csrf = \App\Core\Csrf::generateToken();
?>
<style>
  .admin-shell { max-width: 1080px; margin: 0 auto; padding: 32px 20px 64px; font-family: 'Poppins', system-ui, Arial, sans-serif; }
  .admin-top { display: flex; flex-wrap: wrap; gap: 12px; align-items: center; justify-content: space-between; margin-bottom: 24px; }
  .admin-top h1 { font-size: 1.6rem; margin: 0; }
  .admin-top .admin-user { font-size: .9rem; opacity: .8; }
  .admin-top a.admin-home { color: #0ea5e9; text-decoration: none; font-weight: 600; }
  .admin-cards { display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 16px; margin-bottom: 28px; }
  .admin-card { background: #fff; border: 1px solid #e2e8f0; border-radius: 14px; padding: 18px 20px; box-shadow: 0 1px 2px rgba(15,23,42,.04); }
  .admin-card .n { font-size: 1.8rem; font-weight: 700; color: #0f172a; }
  .admin-card .l { font-size: .85rem; color: #64748b; text-transform: uppercase; letter-spacing: .04em; }
  .admin-flash { padding: 12px 16px; border-radius: 10px; margin-bottom: 20px; font-size: .92rem; }
  .admin-flash.ok { background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
  .admin-flash.error { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }
  .admin-table-wrap { background: #fff; border: 1px solid #e2e8f0; border-radius: 14px; overflow: hidden; }
  table.admin-table { width: 100%; border-collapse: collapse; font-size: .92rem; }
  table.admin-table th, table.admin-table td { padding: 12px 14px; text-align: left; border-bottom: 1px solid #f1f5f9; }
  table.admin-table th { background: #f8fafc; color: #475569; font-size: .78rem; text-transform: uppercase; letter-spacing: .04em; }
  table.admin-table tr:last-child td { border-bottom: none; }
  .badge { display: inline-block; padding: 3px 10px; border-radius: 999px; font-size: .75rem; font-weight: 600; }
  .badge.admin { background: #ede9fe; color: #6d28d9; }
  .badge.estudiante { background: #e0f2fe; color: #0369a1; }
  .admin-role-form { display: flex; gap: 8px; align-items: center; }
  .admin-role-form select { padding: 6px 10px; border-radius: 8px; border: 1px solid #cbd5e1; background: #fff; font-size: .85rem; }
  .admin-role-form button { padding: 6px 12px; border-radius: 8px; border: none; background: #0f172a; color: #fff; font-size: .82rem; font-weight: 600; cursor: pointer; }
  .admin-role-form button:hover { background: #1e293b; }
  .admin-empty { padding: 32px; text-align: center; color: #64748b; }
</style>

<div class="admin-shell">
  <div class="admin-top">
    <div>
      <h1>Panel de Administración</h1>
      <div class="admin-user">
        Sesión: <?= htmlspecialchars($user['name'] ?? 'Administrador') ?>
        <span class="badge admin"><?= htmlspecialchars($user['rol'] ?? 'admin') ?></span>
      </div>
    </div>
    <a class="admin-home" href="index.php?page=home">&larr; Volver al inicio</a>
  </div>

  <?php if (!empty($flash)): ?>
    <div class="admin-flash <?= htmlspecialchars($flash['tipo']) ?>">
      <?= htmlspecialchars($flash['texto']) ?>
    </div>
  <?php endif; ?>

  <div class="admin-cards">
    <div class="admin-card">
      <div class="n"><?= (int)($stats['usuarios'] ?? 0) ?></div>
      <div class="l">Usuarios</div>
    </div>
    <div class="admin-card">
      <div class="n"><?= (int)($stats['admins'] ?? 0) ?></div>
      <div class="l">Administradores</div>
    </div>
    <div class="admin-card">
      <div class="n"><?= (int)($stats['cursos'] ?? 0) ?></div>
      <div class="l">Cursos</div>
    </div>
  </div>

  <div class="admin-table-wrap">
    <table class="admin-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Correo</th>
          <th>Rol actual</th>
          <th>Cambiar rol</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($usuarios)): ?>
          <tr><td colspan="5" class="admin-empty">No hay usuarios registrados.</td></tr>
        <?php else: ?>
          <?php foreach ($usuarios as $u): ?>
            <tr>
              <td><?= (int)$u['id'] ?></td>
              <td><?= htmlspecialchars($u['nombre']) ?></td>
              <td><?= htmlspecialchars($u['email']) ?></td>
              <td>
                <span class="badge <?= htmlspecialchars($u['rol']) ?>">
                  <?= $u['rol'] === 'admin' ? 'Administrador' : 'Estudiante' ?>
                </span>
              </td>
              <td>
                <form class="admin-role-form" method="post" action="index.php?page=admin/usuarios/rol">
                  <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf) ?>">
                  <input type="hidden" name="usuario_id" value="<?= (int)$u['id'] ?>">
                  <select name="rol">
                    <option value="estudiante" <?= $u['rol'] === 'estudiante' ? 'selected' : '' ?>>Estudiante</option>
                    <option value="admin" <?= $u['rol'] === 'admin' ? 'selected' : '' ?>>Administrador</option>
                  </select>
                  <button type="submit">Guardar</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
