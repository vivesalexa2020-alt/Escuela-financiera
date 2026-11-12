<?php
/**
 * Layout Partial: Sidebar lateral de navegación
 * Opción A: Organizado por categorías (Principal, Aprendizaje, Herramientas, Mi Cuenta)
 */
$currentPage = $currentPage ?? ($_GET['page'] ?? 'home');
if (empty($currentPage)) {
    $currentPage = 'home';
}
?>
<aside class="sidebar-left" id="sidebarLeft">
  <div>
    <div class="sidebar-brand">
      <a href="index.php" class="brand-logo">
        <svg viewBox="0 0 240 210" xmlns="http://www.w3.org/2000/svg" style="width: 42px; height: 36px; flex-shrink: 0;" role="img" aria-label="Logo Sombrero de Graduación con Libros">
          <g>
            <rect x="26" y="162" width="188" height="30" rx="8" fill="#fabb15"/>
            <rect x="34" y="168" width="172" height="18" rx="4" fill="#fff6dd"/>
            <rect x="26" y="162" width="26" height="30" rx="8" fill="#e09800"/>

            <rect x="42" y="128" width="156" height="30" rx="8" fill="#cbf63e" transform="rotate(-2 120 143)"/>
            <rect x="50" y="134" width="140" height="18" rx="4" fill="#f2ffcd" transform="rotate(-2 120 143)"/>
            <rect x="42" y="128" width="26" height="30" rx="8" fill="#a9cf1e" transform="rotate(-2 120 143)"/>

            <rect x="58" y="94" width="124" height="30" rx="8" fill="#ffffff" transform="rotate(2 120 109)"/>
            <rect x="66" y="100" width="108" height="18" rx="4" fill="#d7f4e6" transform="rotate(2 120 109)"/>
            <rect x="58" y="94" width="26" height="30" rx="8" fill="#bce9d2" transform="rotate(2 120 109)"/>
          </g>

          <g>
            <path d="M88,66 L88,90 C88,106 152,106 152,90 L152,66 L120,82 Z" fill="#032d1f"/>
            <path d="M120,14 L216,58 L120,102 L24,58 Z" fill="#ffffff"/>
            <path d="M120,14 L216,58 L120,102 L24,58 Z" fill="none" stroke="#d7f4e6" stroke-width="3"/>
            <circle cx="120" cy="58" r="7" fill="#fabb15"/>
            <path d="M120,58 C160,58 196,60 204,62 L204,104" fill="none" stroke="#fabb15" stroke-width="5" stroke-linecap="round"/>
            <path d="M197,104 h14 l4,26 h-22 z" fill="#fabb15"/>
            <path d="M199,130 l1,14 M204,130 l0,14 M209,130 l-1,14" stroke="#fabb15" stroke-width="4" stroke-linecap="round"/>
          </g>
        </svg>
        <div>
          <div>Educación</div>
          <div>Financiera</div>
        </div>
      </a>
      <button class="sidebar-close-mobile" onclick="toggleSidebar(false)" aria-label="Cerrar menú">✕</button>
    </div>

    <nav class="sidebar-nav">
      <div class="sidebar-nav-title">PRINCIPAL</div>
      <a href="index.php" class="sidebar-link <?= ($currentPage === 'home' || $currentPage === '') ? 'active' : '' ?>">
        <span class="sidebar-icon">🏠</span>
        <span>Inicio</span>
      </a>

      <div class="sidebar-nav-title">APRENDIZAJE</div>
      <a href="index.php?page=reticula" class="sidebar-link <?= $currentPage === 'reticula' ? 'active' : '' ?>">
        <span class="sidebar-icon">🗺️</span>
        <span>Retícula Académica</span>
      </a>
      <a href="index.php?page=cursos" class="sidebar-link <?= $currentPage === 'cursos' ? 'active' : '' ?>">
        <span class="sidebar-icon">📚</span>
        <span>Cursos</span>
      </a>
      <a href="index.php?page=aula" class="sidebar-link <?= $currentPage === 'aula' ? 'active' : '' ?>">
        <span class="sidebar-icon">🎓</span>
        <span>Aula Virtual</span>
      </a>

      <div class="sidebar-nav-title">HERRAMIENTAS</div>
      <a href="index.php?page=metas" class="sidebar-link <?= $currentPage === 'metas' ? 'active' : '' ?>">
        <span class="sidebar-icon">🎯</span>
        <span>Metas</span>
      </a>
      <a href="index.php?page=recursos" class="sidebar-link <?= $currentPage === 'recursos' ? 'active' : '' ?>">
        <span class="sidebar-icon">🧮</span>
        <span>Recursos</span>
      </a>

      <div class="sidebar-nav-title">MI CUENTA</div>
      <a href="index.php?page=suscripcion" class="sidebar-link <?= $currentPage === 'suscripcion' ? 'active' : '' ?>">
        <span class="sidebar-icon">💳</span>
        <span>Membresía</span>
      </a>
      <a href="index.php?page=configuraciones" class="sidebar-link <?= $currentPage === 'configuraciones' ? 'active' : '' ?>">
        <span class="sidebar-icon">⚙️</span>
        <span>Configuraciones</span>
      </a>
      <?php if (!empty($user) && ($user['rol'] ?? '') === 'admin'): ?>
      <a href="index.php?page=admin" class="sidebar-link <?= $currentPage === 'admin' ? 'active' : '' ?>">
        <span class="sidebar-icon">🛡️</span>
        <span>Administración</span>
      </a>
      <?php endif; ?>
    </nav>
  </div>

  <!-- Perfil del estudiante en la parte inferior del Sidebar -->
  <div class="sidebar-user-panel">
    <div class="sidebar-user-info">
      <div class="sidebar-user-avatar" id="sidebarUserAvatar">👤</div>
      <div class="sidebar-user-details">
        <div class="sidebar-user-name" id="sidebarUserName"><?= htmlspecialchars($user['nombre'] ?? $user['name'] ?? 'Estudiante') ?></div>
        <div class="sidebar-user-role"><?= !empty($user) ? (htmlspecialchars($user['rol'] ?? 'Estudiante Activo')) : 'Estudiante Activo' ?></div>
      </div>
    </div>
    <button class="sidebar-logout-btn" onclick="logout()" title="Cerrar sesión">
      <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
        <polyline points="16 17 21 12 16 7"></polyline>
        <line x1="21" y1="12" x2="9" y2="12"></line>
      </svg>
      <span>Salir</span>
    </button>
  </div>
</aside>
