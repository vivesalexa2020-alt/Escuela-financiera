<?php
/**
 * Vista: Cursos y Programas
 * Contenido migrado desde cursos.html (legacy/html).
 * Variables: $pageTitle, $pageCss, $bodyClass, $user
 */
?>
<!-- Modal de Retícula Académica y Recursos -->
  <div class="modal-overlay" id="reticulaModal" role="dialog" aria-modal="true">
    <div class="modal-card modal-card-wide" style="text-align: left; max-width: 650px; max-height: 90vh; overflow-y: auto;">
      <button class="modal-close-btn" onclick="closeReticulaModal()" aria-label="Cerrar">×</button>
      <div style="display: flex; align-items: center; justify-content: space-between; gap: 10px; margin-bottom: 4px;">
        <span class="reticula-modal-level" id="reticulaModalLevel">Semestre 1</span>
      </div>
      <h3 id="reticulaModalTitle" style="margin: 6px 0 4px; font-size: 20px;">Materia</h3>
      <p id="reticulaModalDesc" style="color: var(--text-muted); font-size: 13.5px; line-height: 1.5; margin-bottom: 12px;">Descripción de la materia.</p>

      <!-- Tabs de recursos -->
      <div class="reticula-tabs">
        <button type="button" class="reticula-tab-btn active" onclick="switchReticulaTab('temario')" id="tabBtn-temario">
          📋 Temario
        </button>
        <button type="button" class="reticula-tab-btn" onclick="switchReticulaTab('videos')" id="tabBtn-videos">
          🎥 Videos <span class="reticula-tab-badge" id="badgeVideos">0</span>
        </button>
        <button type="button" class="reticula-tab-btn" onclick="switchReticulaTab('ejercicios')" id="tabBtn-ejercicios">
          📝 Ejercicios <span class="reticula-tab-badge" id="badgeEjercicios">0</span>
        </button>
        <button type="button" class="reticula-tab-btn" onclick="switchReticulaTab('audios')" id="tabBtn-audios">
          🎧 Audios <span class="reticula-tab-badge" id="badgeAudios">0</span>
        </button>
        <button type="button" class="reticula-tab-btn" onclick="switchReticulaTab('libros')" id="tabBtn-libros">
          📚 Libros <span class="reticula-tab-badge" id="badgeLibros">0</span>
        </button>
      </div>

      <!-- Tab Contenido: Temario -->
      <div id="tabContent-temario" class="reticula-tab-pane" style="display: block;">
        <div class="reticula-modal-temario" style="margin: 0 0 16px;">
          <h4>¿Qué incluye este curso?</h4>
          <ul id="reticulaModalTemario"></ul>
        </div>
      </div>

      <!-- Tab Contenido: Videos -->
      <div id="tabContent-videos" class="reticula-tab-pane" style="display: none;">
        <div id="reticulaModalVideos" style="margin: 0 0 16px;"></div>
      </div>

      <!-- Tab Contenido: Ejercicios -->
      <div id="tabContent-ejercicios" class="reticula-tab-pane" style="display: none;">
        <div id="reticulaModalEjercicios" style="margin: 0 0 16px;"></div>
      </div>

      <!-- Tab Contenido: Audios -->
      <div id="tabContent-audios" class="reticula-tab-pane" style="display: none;">
        <div id="reticulaModalAudios" style="margin: 0 0 16px;"></div>
      </div>

      <!-- Tab Contenido: Libros -->
      <div id="tabContent-libros" class="reticula-tab-pane" style="display: none;">
        <div id="reticulaModalLibros" style="margin: 0 0 16px;"></div>
      </div>

      <div class="reticula-modal-estado" id="reticulaModalEstado"></div>

      <button class="btn-cta-yellow reticula-modal-action" id="reticulaModalAction" onclick="inscribirMateriaActual()">
        Inscribirme
      </button>
    </div>
  </div>

<!-- ============================================================
       SIDEBAR LATERAL IZQUIERDA (Aparece tras iniciar sesión)
       ============================================================ -->
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

      <div class="sidebar-nav-title">MENÚ PRINCIPAL</div>
      <nav class="sidebar-nav">
        <a href="index.php" class="sidebar-link ">
          <span class="sidebar-icon">🏠</span>
          <span>Inicio</span>
        </a>
        <a href="index.php?page=reticula" class="sidebar-link">
          <span class="sidebar-icon">🗺️</span>
          <span>Retícula Académica</span>
        </a>
        <a href="index.php?page=aula" class="sidebar-link ">
          <span class="sidebar-icon">🚀</span>
          <span>Aula Demo</span>
        </a>
        <a href="index.php?page=metas" class="sidebar-link ">
          <span class="sidebar-icon">🎯</span>
          <span>Metas</span>
        </a>
        <a href="index.php?page=recursos" class="sidebar-link ">
          <span class="sidebar-icon">🧮</span>
          <span>Recursos</span>
        </a>
        <a href="index.php?page=suscripcion" class="sidebar-link ">
          <span class="sidebar-icon">💳</span>
          <span>Membresía</span>
        </a>
        <a href="index.php?page=configuraciones" class="sidebar-link ">
          <span class="sidebar-icon">⚙️</span>
          <span>Configuraciones</span>
        </a>
      </nav>
    </div>

    <!-- Perfil del estudiante en la parte inferior del Sidebar -->
    <div class="sidebar-user-panel">
      <div class="sidebar-user-info">
        <div class="sidebar-user-avatar" id="sidebarUserAvatar">👤</div>
        <div class="sidebar-user-details">
          <div class="sidebar-user-name" id="sidebarUserName">Estudiante</div>
          <div class="sidebar-user-role">Estudiante Activo</div>
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

  <!-- Backdrop para cerrar sidebar en responsive -->
  <div class="sidebar-backdrop" id="sidebarBackdrop" onclick="toggleSidebar(false)"></div>

  <div class="main-wrapper" id="mainWrapper">
      <!-- ============================================================
       ENCABEZADO PÚBLICO (Visible cuando NO hay sesión)
       ============================================================ -->
  <header class="site-header guest-header">
    <div class="container">
      <nav class="nav-wrap">
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

        <div class="nav-actions" style="display: flex; align-items: center; gap: 12px;">
        </div>
      </nav>
    </div>
  </header>

      <!-- Barra superior del estudiante (tras iniciar sesión) -->
  <div class="logged-topbar">
    <div class="logged-topbar-left">
      <button class="btn-sidebar-toggle" onclick="toggleSidebar()" aria-label="Abrir menú lateral">☰</button>
      <div style="display: flex; align-items: center; gap: 10px;">
        <svg viewBox="0 0 240 210" xmlns="http://www.w3.org/2000/svg" style="width: 28px; height: 24px; flex-shrink: 0;" role="img" aria-label="Logo Sombrero de Graduación con Libros">
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
        <div class="page-current-title">Catálogo de Cursos</div>
      </div>
    </div>
    <div class="logged-topbar-right">
      <span class="topbar-greeting">Hola, <strong id="topbarUserName">Estudiante</strong></span>
      <button class="btn-search" onclick="openSearchModal()" aria-label="Buscar" style="color: var(--text-dark);">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="11" cy="11" r="8"></circle>
          <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
      </button>
    </div>
  </div>

    <main>
    <section class="subpage-hero">
    <div class="container">
      <div style="display: flex; align-items: center; justify-content: center; gap: 16px; margin-bottom: 16px;">
        <svg viewBox="0 0 240 210" xmlns="http://www.w3.org/2000/svg" style="width: 56px; height: 49px; flex-shrink: 0;" role="img" aria-label="Logo Sombrero de Graduación con Libros">
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
        <span class="subpage-badge" style="margin: 0;">📚 Catálogo de Formación</span>
      </div>
      <h1>Nuestros <span>Cursos y Programas</span></h1>
      <p>Aprende paso a paso desde los fundamentos del ahorro hasta estrategias avanzadas de inversión y emprendimiento.</p>
    </div>
  </section>

  
    <div id="lockedBanner" class="auth-lock-card" style="display: none;">
      <div style="display: flex; justify-content: center; margin-bottom: 16px;">
        <svg viewBox="0 0 240 210" xmlns="http://www.w3.org/2000/svg" style="width: 64px; height: 56px; flex-shrink: 0;" role="img" aria-label="Logo Sombrero de Graduación con Libros">
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
      </div>
      <h2 style="font-size: 24px; color: var(--text-dark); margin-bottom: 10px;">Contenido exclusivo para estudiantes</h2>
      <p style="color: var(--text-muted); font-size: 14.5px; line-height: 1.6; margin-bottom: 24px;">
        Para acceder a la interfaz de <strong>Cursos</strong> y activar el menú lateral, por favor inicia sesión con tu cuenta o regístrate gratis.
      </p>
      <div style="display: flex; gap: 12px; justify-content: center; flex-wrap: wrap;">
        <button class="btn-cta-yellow" onclick="openLoginModal()" style="padding: 10px 22px;">Iniciar sesión</button>
        <button class="btn-cta-outline" onclick="openSignupModal()" style="padding: 10px 22px; color: var(--text-dark); border-color: var(--btn-green);">Crear cuenta gratis</button>
      </div>
    </div>
  

  <div id="protectedContent">
    <section class="courses-section" id="cursos">
    <div class="container">
      <div class="section-header">
        <div>
          <h2>Nuestros cursos (Programa de 2 Años)</h2>
          <p>Organizados en 3 niveles (Básico, Intermedio y Avanzado). Tu <strong>Primer Semestre es de prueba y 100% GRATIS</strong>.</p>
        </div>
        <a href="#cursos" class="link-view-all">
          Ver todos los cursos <span>→</span>
        </a>
      </div>

      <div style="display: flex; flex-direction: column; gap: 40px;">
  <div>
    <div style="margin-bottom: 16px; border-bottom: 2px solid #e6f0eb; padding-bottom: 10px;">
      <h3 style="font-size: 20px; font-weight: 800; color: var(--verde-bosque); margin-bottom: 4px;">Semestre 1: Nivel Básico (Prueba 100% Gratis)</h3>
      <p style="font-size: 13.5px; color: var(--text-muted);">Construye tus cimientos financieros, diagnostica fugas de dinero y diseña tu primer presupuesto.</p>
    </div>
    <div class="courses-grid">
      <article class="course-card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
          <span class="course-level level-basico">Semestre 1 · Básico</span>
          <span style="font-size: 10px; font-weight: 700; color: #00804b; background: #d7f4e6; padding: 2px 8px; border-radius: 999px;">100% GRATIS</span>
        </div>
        <div style="font-size: 28px; margin-bottom: 8px;">📗</div>
        <h3 style="font-size: 16.5px; font-weight: 700; color: var(--text-dark); margin-bottom: 8px;">Unidad 1: Rompe el ciclo</h3>
        <p class="course-desc" style="font-size: 12px; color: var(--text-muted); margin-bottom: 14px;">Diagnostica tu dinero, detecta fugas y aplica la regla 50/30/20 para tomar el control.</p>
        <div style="background: #f7fbf9; border: 1px solid #e1eee7; border-radius: 12px; padding: 10px 12px; margin-bottom: 16px;">
          <div style="font-size: 10.5px; font-weight: 800; color: var(--verde-bosque); margin-bottom: 6px; letter-spacing: 0.5px;">RECURSOS INCLUIDOS:</div>
          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 6px; font-size: 11px;">
            <span style="color: #dc2626; font-weight: 600;">🎬 3 Videos</span>
            <span style="color: #4338ca; font-weight: 600;">📝 3 Ejercicios</span>
            <span style="color: #0284c7; font-weight: 600;">🎧 2 Audios</span>
            <span style="color: #a16207; font-weight: 600;">📚 2 Libros</span>
          </div>
        </div>
        <button class="btn-course-action" onclick="openReticulaModal('finanzas-personales')">
          Ver recursos y lecciones <span>→</span>
        </button>
      </article>
      <article class="course-card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
          <span class="course-level level-basico">Semestre 1 · Básico</span>
          <span style="font-size: 10px; font-weight: 700; color: #00804b; background: #d7f4e6; padding: 2px 8px; border-radius: 999px;">100% GRATIS</span>
        </div>
        <div style="font-size: 28px; margin-bottom: 8px;">📘</div>
        <h3 style="font-size: 16.5px; font-weight: 700; color: var(--text-dark); margin-bottom: 8px;">Unidad 2: Construye tu fortaleza</h3>
        <p class="course-desc" style="font-size: 12px; color: var(--text-muted); margin-bottom: 14px;">Crea tu fondo de paz y aprende a negociar tus créditos de forma inteligente.</p>
        <div style="background: #f7fbf9; border: 1px solid #e1eee7; border-radius: 12px; padding: 10px 12px; margin-bottom: 16px;">
          <div style="font-size: 10.5px; font-weight: 800; color: var(--verde-bosque); margin-bottom: 6px; letter-spacing: 0.5px;">RECURSOS INCLUIDOS:</div>
          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 6px; font-size: 11px;">
            <span style="color: #dc2626; font-weight: 600;">🎬 3 Videos</span>
            <span style="color: #4338ca; font-weight: 600;">📝 2 Ejercicios</span>
            <span style="color: #0284c7; font-weight: 600;">🎧 1 Audios</span>
            <span style="color: #a16207; font-weight: 600;">📚 2 Libros</span>
          </div>
        </div>
        <button class="btn-course-action" onclick="openReticulaModal('presupuesto')">
          Ver recursos y lecciones <span>→</span>
        </button>
      </article>
      <article class="course-card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
          <span class="course-level level-basico">Semestre 1 · Básico</span>
          <span style="font-size: 10px; font-weight: 700; color: #00804b; background: #d7f4e6; padding: 2px 8px; border-radius: 999px;">100% GRATIS</span>
        </div>
        <div style="font-size: 28px; margin-bottom: 8px;">📙</div>
        <h3 style="font-size: 16.5px; font-weight: 700; color: var(--text-dark); margin-bottom: 8px;">Unidad 3: Multiplica e invierte</h3>
        <p class="course-desc" style="font-size: 12px; color: var(--text-muted); margin-bottom: 14px;">Protege tu dinero de la inflación y da tus primeros pasos en portafolios pasivos.</p>
        <div style="background: #f7fbf9; border: 1px solid #e1eee7; border-radius: 12px; padding: 10px 12px; margin-bottom: 16px;">
          <div style="font-size: 10.5px; font-weight: 800; color: var(--verde-bosque); margin-bottom: 6px; letter-spacing: 0.5px;">RECURSOS INCLUIDOS:</div>
          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 6px; font-size: 11px;">
            <span style="color: #dc2626; font-weight: 600;">🎬 3 Videos</span>
            <span style="color: #4338ca; font-weight: 600;">📝 2 Ejercicios</span>
            <span style="color: #0284c7; font-weight: 600;">🎧 2 Audios</span>
            <span style="color: #a16207; font-weight: 600;">📚 2 Libros</span>
          </div>
        </div>
        <button class="btn-course-action" onclick="openReticulaModal('gasto-hormiga')">
          Ver recursos y lecciones <span>→</span>
        </button>
      </article>
    </div>
  </div>
  <div>
    <div style="margin-bottom: 16px; border-bottom: 2px solid #e6f0eb; padding-bottom: 10px;">
      <h3 style="font-size: 20px; font-weight: 800; color: var(--verde-bosque); margin-bottom: 4px;">Semestre 2: Nivel Intermedio I (Consolidación y Ahorro)</h3>
      <p style="font-size: 13.5px; color: var(--text-muted);">Construye tu fondo de paz mental, elimina deudas bancarias y domina herramientas digitales.</p>
    </div>
    <div class="courses-grid">
      <article class="course-card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
          <span class="course-level level-intermedio">Semestre 2 · Intermedio</span>
        </div>
        <div style="font-size: 28px; margin-bottom: 8px;">🛡️</div>
        <h3 style="font-size: 16.5px; font-weight: 700; color: var(--text-dark); margin-bottom: 8px;">Ahorro formal y fondo de emergencia</h3>
        <p class="course-desc" style="font-size: 12px; color: var(--text-muted); margin-bottom: 14px;">Construye tu escudo de tranquilidad financiera para 3 a 6 meses de gastos.</p>
        <div style="background: #f7fbf9; border: 1px solid #e1eee7; border-radius: 12px; padding: 10px 12px; margin-bottom: 16px;">
          <div style="font-size: 10.5px; font-weight: 800; color: var(--verde-bosque); margin-bottom: 6px; letter-spacing: 0.5px;">RECURSOS INCLUIDOS:</div>
          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 6px; font-size: 11px;">
            <span style="color: #dc2626; font-weight: 600;">🎬 3 Videos</span>
            <span style="color: #4338ca; font-weight: 600;">📝 3 Ejercicios</span>
            <span style="color: #0284c7; font-weight: 600;">🎧 2 Audios</span>
            <span style="color: #a16207; font-weight: 600;">📚 2 Libros</span>
          </div>
        </div>
        <button class="btn-course-action" onclick="openReticulaModal('fondo-emergencia')">
          Ver recursos y lecciones <span>→</span>
        </button>
      </article>
      <article class="course-card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
          <span class="course-level level-intermedio">Semestre 2 · Intermedio</span>
        </div>
        <div style="font-size: 28px; margin-bottom: 8px;">💳</div>
        <h3 style="font-size: 16.5px; font-weight: 700; color: var(--text-dark); margin-bottom: 8px;">Control de deudas y crédito bancario</h3>
        <p class="course-desc" style="font-size: 12px; color: var(--text-muted); margin-bottom: 14px;">Métodos probados (Bola de nieve y Avalancha) para liquidar tarjetas y créditos.</p>
        <div style="background: #f7fbf9; border: 1px solid #e1eee7; border-radius: 12px; padding: 10px 12px; margin-bottom: 16px;">
          <div style="font-size: 10.5px; font-weight: 800; color: var(--verde-bosque); margin-bottom: 6px; letter-spacing: 0.5px;">RECURSOS INCLUIDOS:</div>
          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 6px; font-size: 11px;">
            <span style="color: #dc2626; font-weight: 600;">🎬 3 Videos</span>
            <span style="color: #4338ca; font-weight: 600;">📝 3 Ejercicios</span>
            <span style="color: #0284c7; font-weight: 600;">🎧 1 Audios</span>
            <span style="color: #a16207; font-weight: 600;">📚 2 Libros</span>
          </div>
        </div>
        <button class="btn-course-action" onclick="openReticulaModal('control-deudas')">
          Ver recursos y lecciones <span>→</span>
        </button>
      </article>
      <article class="course-card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
          <span class="course-level level-intermedio">Semestre 2 · Intermedio</span>
        </div>
        <div style="font-size: 28px; margin-bottom: 8px;">🧰</div>
        <h3 style="font-size: 16.5px; font-weight: 700; color: var(--text-dark); margin-bottom: 8px;">Materiales y herramientas digitales</h3>
        <p class="course-desc" style="font-size: 12px; color: var(--text-muted); margin-bottom: 14px;">Plantillas automatizadas en Excel, calculadoras y apps para gestionar tus finanzas.</p>
        <div style="background: #f7fbf9; border: 1px solid #e1eee7; border-radius: 12px; padding: 10px 12px; margin-bottom: 16px;">
          <div style="font-size: 10.5px; font-weight: 800; color: var(--verde-bosque); margin-bottom: 6px; letter-spacing: 0.5px;">RECURSOS INCLUIDOS:</div>
          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 6px; font-size: 11px;">
            <span style="color: #dc2626; font-weight: 600;">🎬 3 Videos</span>
            <span style="color: #4338ca; font-weight: 600;">📝 2 Ejercicios</span>
            <span style="color: #0284c7; font-weight: 600;">🎧 1 Audios</span>
            <span style="color: #a16207; font-weight: 600;">📚 2 Libros</span>
          </div>
        </div>
        <button class="btn-course-action" onclick="openReticulaModal('materiales-herramientas')">
          Ver recursos y lecciones <span>→</span>
        </button>
      </article>
    </div>
  </div>
  <div>
    <div style="margin-bottom: 16px; border-bottom: 2px solid #e6f0eb; padding-bottom: 10px;">
      <h3 style="font-size: 20px; font-weight: 800; color: var(--verde-bosque); margin-bottom: 4px;">Semestre 3: Nivel Intermedio II (Inversiones y Patrimonio)</h3>
      <p style="font-size: 13.5px; color: var(--text-muted);">Pon a trabajar tu dinero en CETES, Bonos, ETFs (S&P 500) y optimiza tus deducciones fiscales.</p>
    </div>
    <div class="courses-grid">
      <article class="course-card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
          <span class="course-level level-intermedio">Semestre 3 · Intermedio</span>
        </div>
        <div style="font-size: 28px; margin-bottom: 8px;">📈</div>
        <h3 style="font-size: 16.5px; font-weight: 700; color: var(--text-dark); margin-bottom: 8px;">Estrategias de inversión y renta fija</h3>
        <p class="course-desc" style="font-size: 12px; color: var(--text-muted); margin-bottom: 14px;">Pon tu dinero a trabajar con instrumentos regulados de bajo riesgo y renta fija.</p>
        <div style="background: #f7fbf9; border: 1px solid #e1eee7; border-radius: 12px; padding: 10px 12px; margin-bottom: 16px;">
          <div style="font-size: 10.5px; font-weight: 800; color: var(--verde-bosque); margin-bottom: 6px; letter-spacing: 0.5px;">RECURSOS INCLUIDOS:</div>
          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 6px; font-size: 11px;">
            <span style="color: #dc2626; font-weight: 600;">🎬 3 Videos</span>
            <span style="color: #4338ca; font-weight: 600;">📝 3 Ejercicios</span>
            <span style="color: #0284c7; font-weight: 600;">🎧 1 Audios</span>
            <span style="color: #a16207; font-weight: 600;">📚 2 Libros</span>
          </div>
        </div>
        <button class="btn-course-action" onclick="openReticulaModal('ahorro-inversion')">
          Ver recursos y lecciones <span>→</span>
        </button>
      </article>
      <article class="course-card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
          <span class="course-level level-intermedio">Semestre 3 · Intermedio</span>
        </div>
        <div style="font-size: 28px; margin-bottom: 8px;">📊</div>
        <h3 style="font-size: 16.5px; font-weight: 700; color: var(--text-dark); margin-bottom: 8px;">Fondos indexados y renta variable</h3>
        <p class="course-desc" style="font-size: 12px; color: var(--text-muted); margin-bottom: 14px;">Aprende a invertir a largo plazo en índices globales como el S&P 500.</p>
        <div style="background: #f7fbf9; border: 1px solid #e1eee7; border-radius: 12px; padding: 10px 12px; margin-bottom: 16px;">
          <div style="font-size: 10.5px; font-weight: 800; color: var(--verde-bosque); margin-bottom: 6px; letter-spacing: 0.5px;">RECURSOS INCLUIDOS:</div>
          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 6px; font-size: 11px;">
            <span style="color: #dc2626; font-weight: 600;">🎬 3 Videos</span>
            <span style="color: #4338ca; font-weight: 600;">📝 3 Ejercicios</span>
            <span style="color: #0284c7; font-weight: 600;">🎧 2 Audios</span>
            <span style="color: #a16207; font-weight: 600;">📚 2 Libros</span>
          </div>
        </div>
        <button class="btn-course-action" onclick="openReticulaModal('fondos-bolsa')">
          Ver recursos y lecciones <span>→</span>
        </button>
      </article>
      <article class="course-card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
          <span class="course-level level-intermedio">Semestre 3 · Intermedio</span>
        </div>
        <div style="font-size: 28px; margin-bottom: 8px;">🏛️</div>
        <h3 style="font-size: 16.5px; font-weight: 700; color: var(--text-dark); margin-bottom: 8px;">Protección patrimonial e impuestos</h3>
        <p class="course-desc" style="font-size: 12px; color: var(--text-muted); margin-bottom: 14px;">Seguros indispensables y optimización fiscal para proteger tu capital.</p>
        <div style="background: #f7fbf9; border: 1px solid #e1eee7; border-radius: 12px; padding: 10px 12px; margin-bottom: 16px;">
          <div style="font-size: 10.5px; font-weight: 800; color: var(--verde-bosque); margin-bottom: 6px; letter-spacing: 0.5px;">RECURSOS INCLUIDOS:</div>
          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 6px; font-size: 11px;">
            <span style="color: #dc2626; font-weight: 600;">🎬 3 Videos</span>
            <span style="color: #4338ca; font-weight: 600;">📝 3 Ejercicios</span>
            <span style="color: #0284c7; font-weight: 600;">🎧 1 Audios</span>
            <span style="color: #a16207; font-weight: 600;">📚 2 Libros</span>
          </div>
        </div>
        <button class="btn-course-action" onclick="openReticulaModal('proteccion-impuestos')">
          Ver recursos y lecciones <span>→</span>
        </button>
      </article>
    </div>
  </div>
  <div>
    <div style="margin-bottom: 16px; border-bottom: 2px solid #e6f0eb; padding-bottom: 10px;">
      <h3 style="font-size: 20px; font-weight: 800; color: var(--verde-bosque); margin-bottom: 4px;">Semestre 4: Nivel Avanzado (Libertad Financiera)</h3>
      <p style="font-size: 13.5px; color: var(--text-muted);">Crea negocios rentables, invierte en bienes raíces y FIBRAs, y consolida tu retiro anticipado.</p>
    </div>
    <div class="courses-grid">
      <article class="course-card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
          <span class="course-level level-avanzado">Semestre 4 · Avanzado</span>
        </div>
        <div style="font-size: 28px; margin-bottom: 8px;">💡</div>
        <h3 style="font-size: 16.5px; font-weight: 700; color: var(--text-dark); margin-bottom: 8px;">Emprendimiento y modelos de negocio</h3>
        <p class="course-desc" style="font-size: 12px; color: var(--text-muted); margin-bottom: 14px;">Valida ideas, crea negocios rentables y diversifica tus fuentes de ingresos.</p>
        <div style="background: #f7fbf9; border: 1px solid #e1eee7; border-radius: 12px; padding: 10px 12px; margin-bottom: 16px;">
          <div style="font-size: 10.5px; font-weight: 800; color: var(--verde-bosque); margin-bottom: 6px; letter-spacing: 0.5px;">RECURSOS INCLUIDOS:</div>
          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 6px; font-size: 11px;">
            <span style="color: #dc2626; font-weight: 600;">🎬 3 Videos</span>
            <span style="color: #4338ca; font-weight: 600;">📝 3 Ejercicios</span>
            <span style="color: #0284c7; font-weight: 600;">🎧 2 Audios</span>
            <span style="color: #a16207; font-weight: 600;">📚 2 Libros</span>
          </div>
        </div>
        <button class="btn-course-action" onclick="openReticulaModal('emprendimiento')">
          Ver recursos y lecciones <span>→</span>
        </button>
      </article>
      <article class="course-card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
          <span class="course-level level-avanzado">Semestre 4 · Avanzado</span>
        </div>
        <div style="font-size: 28px; margin-bottom: 8px;">🏢</div>
        <h3 style="font-size: 16.5px; font-weight: 700; color: var(--text-dark); margin-bottom: 8px;">Inversión inmobiliaria y FIBRAs</h3>
        <p class="course-desc" style="font-size: 12px; color: var(--text-muted); margin-bottom: 14px;">Participa en el sector inmobiliario con bajo capital a través de FIBRAs y rentas.</p>
        <div style="background: #f7fbf9; border: 1px solid #e1eee7; border-radius: 12px; padding: 10px 12px; margin-bottom: 16px;">
          <div style="font-size: 10.5px; font-weight: 800; color: var(--verde-bosque); margin-bottom: 6px; letter-spacing: 0.5px;">RECURSOS INCLUIDOS:</div>
          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 6px; font-size: 11px;">
            <span style="color: #dc2626; font-weight: 600;">🎬 3 Videos</span>
            <span style="color: #4338ca; font-weight: 600;">📝 3 Ejercicios</span>
            <span style="color: #0284c7; font-weight: 600;">🎧 1 Audios</span>
            <span style="color: #a16207; font-weight: 600;">📚 2 Libros</span>
          </div>
        </div>
        <button class="btn-course-action" onclick="openReticulaModal('bienes-raices')">
          Ver recursos y lecciones <span>→</span>
        </button>
      </article>
      <article class="course-card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
          <span class="course-level level-avanzado">Semestre 4 · Avanzado</span>
        </div>
        <div style="font-size: 28px; margin-bottom: 8px;">🏆</div>
        <h3 style="font-size: 16.5px; font-weight: 700; color: var(--text-dark); margin-bottom: 8px;">Independencia y legado financiero</h3>
        <p class="course-desc" style="font-size: 12px; color: var(--text-muted); margin-bottom: 14px;">Consolida tu portafolio patrimonial definitivo para vivir de tus rentas e inversiones.</p>
        <div style="background: #f7fbf9; border: 1px solid #e1eee7; border-radius: 12px; padding: 10px 12px; margin-bottom: 16px;">
          <div style="font-size: 10.5px; font-weight: 800; color: var(--verde-bosque); margin-bottom: 6px; letter-spacing: 0.5px;">RECURSOS INCLUIDOS:</div>
          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 6px; font-size: 11px;">
            <span style="color: #dc2626; font-weight: 600;">🎬 3 Videos</span>
            <span style="color: #4338ca; font-weight: 600;">📝 3 Ejercicios</span>
            <span style="color: #0284c7; font-weight: 600;">🎧 2 Audios</span>
            <span style="color: #a16207; font-weight: 600;">📚 2 Libros</span>
          </div>
        </div>
        <button class="btn-course-action" onclick="openReticulaModal('libertad-financiera')">
          Ver recursos y lecciones <span>→</span>
        </button>
      </article>
    </div>
  </div>
</div>
    </div>
  </section>
    <section class="progress-banner-wrap" id="progreso">
    <div class="container">
      <div class="progress-banner-card">
        <!-- Izquierda: Target icon + Textos -->
        <div class="progress-banner-left">
          <svg class="target-circle-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <circle cx="12" cy="12" r="6"></circle>
            <circle cx="12" cy="12" r="2"></circle>
            <path d="m14 10 7-7"></path>
          </svg>
          <div class="progress-banner-text">
            <h3>Tu progreso importa</h3>
            <p>Cada paso cuenta. Sigue aprendiendo, completa tus cursos y gana insignias.</p>
          </div>
        </div>

        <!-- Derecha: Tarjeta blanca con barra y medalla dorada -->
        <div class="progress-banner-right">
          <div class="stat-col">
            <h4>Tu avance general</h4>
            <div class="overall-progress-bar">
              <div class="overall-progress-fill"></div>
            </div>
            <span class="stat-sub">3 de 6 cursos completados</span>
          </div>

          <!-- Medalla dorada con estrella y lazos -->
          <svg class="medal-icon-badge" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="18" cy="14" r="11" fill="#F59E0B" stroke="#D97706" stroke-width="2"/>
            <polygon points="18,7 20,12 25,12 21,15 22.5,20 18,17 13.5,20 15,15 11,12 16,12" fill="#FEF3C7"/>
            <path d="M13 22L10 32L16 28L18 24" fill="#D97706"/>
            <path d="M23 22L26 32L20 28L18 24" fill="#B45309"/>
          </svg>
        </div>
      </div>
    </div>
  </section>
  </div>

  <section class="cta-band" style="display:none;">
    <div class="container">
      <div class="cta-band-inner">
        <div>
          <h3>Empieza tu educación financiera hoy</h3>
          <p>Crea tu cuenta gratis o inicia sesión para continuar tu progreso.</p>
        </div>
        <div class="cta-band-actions">
          <button class="btn-cta-yellow" onclick="openSignupModal()">Crear cuenta gratis</button>
          <button class="btn-cta-outline" onclick="openLoginModal()">Iniciar sesión</button>
        </div>
      </div>
    </div>
  </section>

    </main>

    <footer class="site-footer">
    <!-- Cinta decorativa curva inferior izquierda -->
    <div class="footer-swoosh"></div>

    <div class="container">
      <div class="footer-grid">
        <!-- Columna 1: Logo & lema -->
        <div class="footer-brand">
          <a href="index.php" class="brand-logo">
            <svg viewBox="0 0 240 210" xmlns="http://www.w3.org/2000/svg" style="width: 40px; height: 35px; flex-shrink: 0;" role="img" aria-label="Logo Sombrero de Graduación con Libros">
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
          <p>Mejores decisiones, un futuro más seguro.</p>
        </div>

        <!-- Columna 2: Enlaces rápidos -->
        <div class="footer-col" id="enlaces">
          <h4>Enlaces rápidos</h4>
          <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="index.php?page=recursos">Recursos</a></li>
            <li><a href="#blog">Blog</a></li>
          </ul>
        </div>

        <!-- Columna 3: Recursos -->
        <div class="footer-col" id="recursos-footer">
          <h4>Recursos</h4>
          <ul>
            <li><a href="javascript:void(0)" onclick="openResourceModal('Guías financieras', 'Accede a guías descargables en PDF sobre ahorro, control de deudas e inversiones.')">Guías</a></li>
            <li><a href="javascript:void(0)" onclick="openResourceModal('Calculadoras interactivas', 'Simula planes de ahorro, amortización de deudas e interés compuesto.')">Calculadoras</a></li>
            <li><a href="javascript:void(0)" onclick="openResourceModal('Preguntas frecuentes', 'Encuentra respuestas inmediatas sobre el acceso a los cursos, certificaciones y contenidos.')">Preguntas frecuentes</a></li>
            <li><a href="javascript:void(0)" onclick="openResourceModal('Contacto', 'Escríbenos a soporte@educacionfinanciera.edu o a través de nuestras redes sociales.')">Contacto</a></li>
          </ul>
        </div>

        <!-- Columna 4: Síguenos -->
        <div class="footer-col" id="nosotros-footer">
          <h4>Síguenos</h4>
          <div class="social-links">
            <!-- Facebook -->
            <a href="https://facebook.com" target="_blank" rel="noopener" class="social-icon-btn" aria-label="Facebook">
              <svg viewBox="0 0 24 24" fill="currentColor">
                <path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.95c5.05-.5 9-4.76 9-9.95z"/>
              </svg>
            </a>

            <!-- Instagram -->
            <a href="https://instagram.com" target="_blank" rel="noopener" class="social-icon-btn" aria-label="Instagram">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
              </svg>
            </a>

            <!-- YouTube -->
            <a href="https://youtube.com" target="_blank" rel="noopener" class="social-icon-btn" aria-label="YouTube">
              <svg viewBox="0 0 24 24" fill="currentColor">
                <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
              </svg>
            </a>

            <!-- TikTok -->
            <a href="https://tiktok.com" target="_blank" rel="noopener" class="social-icon-btn" aria-label="TikTok">
              <svg viewBox="0 0 24 24" fill="currentColor">
                <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.97v7.69c0 1.52-.37 3.06-1.2 4.34-1.2 1.83-3.23 3.07-5.46 3.32-1.92.21-3.9-.2-5.52-1.3-1.66-1.13-2.77-2.94-3.05-4.94-.3-2.02.26-4.13 1.55-5.74 1.34-1.68 3.4-2.65 5.56-2.67.37 0 .74.03 1.1.1v4.13c-.34-.1-.7-.14-1.06-.13-1.02.01-2.02.48-2.66 1.28-.68.85-.86 2.02-.49 3.05.37 1.02 1.32 1.77 2.41 1.93.99.14 2.03-.13 2.78-.8.67-.6 1.07-1.48 1.07-2.39V.02h-.87z"/>
              </svg>
            </a>
          </div>
        </div>
      </div>

      <div class="footer-bottom">
        <p class="copyright">© 2025 Educación Financiera. Todos los derechos reservados.</p>
      </div>
    </div>
  </footer>
  </div>

  <!-- ============================================================
       MODAL POPUP
       ============================================================ -->
  <div class="modal-overlay" id="modalOverlay" role="dialog" aria-modal="true">
    <div class="modal-card">
      <button class="modal-close-btn" id="modalCloseBtn" aria-label="Cerrar">×</button>
      <div style="display: flex; justify-content: center; margin-bottom: 12px;"><svg viewBox="0 0 240 210" xmlns="http://www.w3.org/2000/svg" style="width: 54px; height: 48px; flex-shrink: 0;" role="img" aria-label="Logo Sombrero de Graduación con Libros">
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
  </svg></div>
      <h3 id="modalTitle">Detalle del curso</h3>
      <p id="modalDescription">Información del curso y temario disponible.</p>
      <button class="btn-cta-yellow" style="width: 100%; justify-content: center;" onclick="closeModal()">
        ¡Entendido!
      </button>
    </div>
  </div>

  <!-- Modal de Búsqueda -->
  <div class="modal-overlay" id="searchModal" role="dialog" aria-modal="true">
    <div class="modal-card" style="text-align: left;">
      <button class="modal-close-btn" onclick="closeSearchModal()">×</button>
      <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 12px;">
        <svg viewBox="0 0 240 210" xmlns="http://www.w3.org/2000/svg" style="width: 34px; height: 30px; flex-shrink: 0;" role="img" aria-label="Logo Sombrero de Graduación con Libros">
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
        <h3 style="margin: 0; font-size: 18px;">Buscar en la plataforma</h3>
      </div>
      <input type="text" id="searchInput" placeholder="Buscar cursos, lecciones o herramientas..." 
             style="width: 100%; padding: 12px 16px; border: 1px solid #d4e7de; border-radius: 12px; font-family: inherit; font-size: 14px; margin-bottom: 16px; outline: none; box-sizing: border-box;">
      <div id="searchResults" style="font-size: 13px; color: var(--text-muted); line-height: 1.6;">
        Escribe para encontrar cursos como "Finanzas personales", "Ahorro", "Presupuesto", o calculadoras interactivas.
      </div>
    </div>
  </div>


  <!-- Modal de Inicio de Sesión -->
  <div class="modal-overlay" id="loginModal" role="dialog" aria-modal="true">
    <div class="modal-card">
      <button class="modal-close-btn" onclick="closeLoginModal()">×</button>
      <div style="display: flex; justify-content: center; margin-bottom: 12px;"><svg viewBox="0 0 240 210" xmlns="http://www.w3.org/2000/svg" style="width: 54px; height: 48px; flex-shrink: 0;" role="img" aria-label="Logo Sombrero de Graduación con Libros">
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
  </svg></div>
      <h3>Iniciar sesión</h3>
      <p>Accede a tu aula virtual para acceder al menú completo y continuar tus cursos.</p>
      <div id="loginMsg" class="form-message"></div>
      <form id="loginForm" onsubmit="handleLoginSubmit(event)" style="display: flex; flex-direction: column; gap: 12px; text-align: left;">
        <div>
          <label style="font-size: 12px; font-weight: 600; color: var(--text-dark);">Correo electrónico</label>
          <input type="email" id="loginEmail" required placeholder="tu@correo.com" style="width: 100%; padding: 10px 14px; border: 1px solid #d4e7de; border-radius: 10px; font-family: inherit; font-size: 13px; margin-top: 4px; box-sizing: border-box;">
          <span id="loginEmailErr" style="display:none; color: #e11d48; font-size: 11px; margin-top: 2px;">Ingresa un correo electrónico válido.</span>
        </div>
        <div>
          <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 4px;">
            <label style="font-size: 12px; font-weight: 600; color: var(--text-dark);">Contraseña</label>
            <button type="button" onclick="openForgotModal()" style="background: none; border: none; font-size: 11.5px; color: #00ba6d; font-weight: 600; cursor: pointer; text-decoration: underline; padding: 0;">¿Olvidaste tu contraseña?</button>
          </div>
          <div class="password-field">
            <input type="password" id="loginPassword" required placeholder="••••••••">
            <button type="button" class="btn-toggle-eye" onclick="togglePasswordVisibility('loginPassword', this)" aria-label="Mostrar contraseña" title="Mostrar contraseña">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                <circle cx="12" cy="12" r="3"></circle>
              </svg>
            </button>
          </div>
          <span id="loginPasswordErr" style="display:none; color: #e11d48; font-size: 11px; margin-top: 2px;">Ingresa tu contraseña.</span>
        </div>
        <button type="submit" class="btn-cta-yellow" style="width: 100%; justify-content: center; margin-top: 8px;">
          Ingresar al aula virtual
        </button>
      </form>
      <p class="modal-switch-text">
        ¿No tienes cuenta? <button type="button" onclick="openSignupModal()">Crear cuenta</button>
      </p>
    </div>
  </div>

  <!-- Modal de Recuperar Contraseña -->
  <div class="modal-overlay" id="forgotModal" role="dialog" aria-modal="true">
    <div class="modal-card">
      <button class="modal-close-btn" onclick="closeForgotModal()">×</button>
      <div style="display: flex; justify-content: center; margin-bottom: 12px;"><svg viewBox="0 0 240 210" xmlns="http://www.w3.org/2000/svg" style="width: 54px; height: 48px; flex-shrink: 0;" role="img" aria-label="Logo Sombrero de Graduación con Libros">
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
  </svg></div>
      <h3>Recuperar contraseña</h3>
      <p>Ingresa tu correo registrado y define una nueva contraseña para restablecer tu acceso.</p>
      <div id="forgotMsg" class="form-message"></div>
      <form id="forgotForm" onsubmit="handleForgotSubmit(event)" style="display: flex; flex-direction: column; gap: 12px; text-align: left;">
        <div>
          <label style="font-size: 12px; font-weight: 600; color: var(--text-dark);">Correo electrónico registrado</label>
          <input type="email" id="forgotEmail" required placeholder="tu@correo.com" style="width: 100%; padding: 10px 14px; border: 1px solid #d4e7de; border-radius: 10px; font-family: inherit; font-size: 13px; margin-top: 4px; box-sizing: border-box;">
          <span id="forgotEmailErr" style="display:none; color: #e11d48; font-size: 11px; margin-top: 2px;">Ingresa un correo electrónico válido.</span>
        </div>
        <div>
          <label style="font-size: 12px; font-weight: 600; color: var(--text-dark);">Nueva contraseña</label>
          <div class="password-field">
            <input type="password" id="forgotPassword" required minlength="6" placeholder="Mínimo 6 caracteres">
            <button type="button" class="btn-toggle-eye" onclick="togglePasswordVisibility('forgotPassword', this)" aria-label="Mostrar contraseña" title="Mostrar contraseña">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                <circle cx="12" cy="12" r="3"></circle>
              </svg>
            </button>
          </div>
          <span id="forgotPasswordErr" style="display:none; color: #e11d48; font-size: 11px; margin-top: 2px;">La contraseña debe tener al menos 6 caracteres.</span>
        </div>
        <div>
          <label style="font-size: 12px; font-weight: 600; color: var(--text-dark);">Confirmar nueva contraseña</label>
          <div class="password-field">
            <input type="password" id="forgotConfirm" required minlength="6" placeholder="Repite tu nueva contraseña">
            <button type="button" class="btn-toggle-eye" onclick="togglePasswordVisibility('forgotConfirm', this)" aria-label="Mostrar contraseña" title="Mostrar contraseña">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                <circle cx="12" cy="12" r="3"></circle>
              </svg>
            </button>
          </div>
          <span id="forgotConfirmErr" style="display:none; color: #e11d48; font-size: 11px; margin-top: 2px;">Las contraseñas no coinciden.</span>
        </div>
        <button type="submit" class="btn-cta-yellow" style="width: 100%; justify-content: center; margin-top: 8px;">
          Restablecer mi contraseña
        </button>
      </form>
      <p class="modal-switch-text">
        ¿Recordaste tu contraseña? <button type="button" onclick="openLoginModal()">Iniciar sesión</button>
      </p>
    </div>
  </div>

  <!-- Modal de Crear Cuenta -->
  <div class="modal-overlay" id="signupModal" role="dialog" aria-modal="true">
    <div class="modal-card">
      <button class="modal-close-btn" onclick="closeSignupModal()">×</button>
      <div style="display: flex; justify-content: center; margin-bottom: 12px;"><svg viewBox="0 0 240 210" xmlns="http://www.w3.org/2000/svg" style="width: 54px; height: 48px; flex-shrink: 0;" role="img" aria-label="Logo Sombrero de Graduación con Libros">
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
  </svg></div>
      <h3>Crear cuenta</h3>
      <p>Regístrate gratis para acceder a tu aula virtual y desbloquear el menú de la escuela.</p>
      <div id="signupMsg" class="form-message"></div>
      <form id="signupForm" onsubmit="handleSignupSubmit(event)" style="display: flex; flex-direction: column; gap: 12px; text-align: left;">
        <div>
          <label style="font-size: 12px; font-weight: 600; color: var(--text-dark);">Nombre completo</label>
          <input type="text" id="signupName" required placeholder="Tu nombre completo" style="width: 100%; padding: 10px 14px; border: 1px solid #d4e7de; border-radius: 10px; font-family: inherit; font-size: 13px; margin-top: 4px; box-sizing: border-box;">
          <span id="signupNameErr" style="display:none; color: #e11d48; font-size: 11px; margin-top: 2px;">Ingresa tu nombre completo.</span>
        </div>
        <div>
          <label style="font-size: 12px; font-weight: 600; color: var(--text-dark);">Correo electrónico</label>
          <input type="email" id="signupEmail" required placeholder="tu@correo.com" style="width: 100%; padding: 10px 14px; border: 1px solid #d4e7de; border-radius: 10px; font-family: inherit; font-size: 13px; margin-top: 4px; box-sizing: border-box;">
          <span id="signupEmailErr" style="display:none; color: #e11d48; font-size: 11px; margin-top: 2px;">Ingresa un correo electrónico válido.</span>
        </div>
        <div>
          <label style="font-size: 12px; font-weight: 600; color: var(--text-dark);">Contraseña</label>
          <div class="password-field">
            <input type="password" id="signupPassword" required minlength="6" placeholder="Mínimo 6 caracteres">
            <button type="button" class="btn-toggle-eye" onclick="togglePasswordVisibility('signupPassword', this)" aria-label="Mostrar contraseña" title="Mostrar contraseña">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                <circle cx="12" cy="12" r="3"></circle>
              </svg>
            </button>
          </div>
          <span id="signupPasswordErr" style="display:none; color: #e11d48; font-size: 11px; margin-top: 2px;">La contraseña debe tener al menos 6 caracteres.</span>
        </div>
        <div>
          <label style="font-size: 12px; font-weight: 600; color: var(--text-dark);">Confirmar contraseña</label>
          <div class="password-field">
            <input type="password" id="signupConfirm" required minlength="6" placeholder="Repite tu contraseña">
            <button type="button" class="btn-toggle-eye" onclick="togglePasswordVisibility('signupConfirm', this)" aria-label="Mostrar contraseña" title="Mostrar contraseña">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                <circle cx="12" cy="12" r="3"></circle>
              </svg>
            </button>
          </div>
          <span id="signupConfirmErr" style="display:none; color: #e11d48; font-size: 11px; margin-top: 2px;">Las contraseñas no coinciden.</span>
        </div>
        <button type="submit" class="btn-cta-yellow" style="width: 100%; justify-content: center; margin-top: 8px;">
          Registrarme y acceder
        </button>
      </form>
      <p class="modal-switch-text">
        ¿Ya tienes cuenta? <button type="button" onclick="openLoginModal()">Iniciar sesión</button>
      </p>
    </div>
  </div>


  <script src="public/js/script.js?v=20261102_recursos"></script>

  <!-- ============================================================
       MODAL REPRODUCTOR DE VIDEO
       ============================================================ -->
  <div class="modal-overlay" id="videoPlayerModal" role="dialog" aria-modal="true">
    <div class="modal-card" style="text-align: left; max-width: 720px; padding: 24px; width: 95%;">
      <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px;">
        <div style="display: flex; align-items: center; gap: 8px;">
          <span style="font-size: 20px;">🎬</span>
          <h3 id="videoPlayerTitle" style="font-size: 17px; margin: 0; color: var(--text-dark); font-weight: 700;">Video Clase</h3>
        </div>
        <button class="modal-close-btn" onclick="closeVideoPlayerModal()" style="position: static;" aria-label="Cerrar reproductor">×</button>
      </div>
      <div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; border-radius: 14px; background: #000; margin-bottom: 16px; box-shadow: 0 10px 25px rgba(0,0,0,0.2);">
        <iframe id="videoPlayerIframe" style="position: absolute; top:0; left:0; width:100%; height:100%; border:0;" src="" title="Reproductor de Video" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
      <div style="display: flex; justify-content: space-between; align-items: center; gap: 10px; flex-wrap: wrap;">
        <span style="font-size: 12.5px; color: var(--text-muted);">✅ Clase interactiva de Educación Financiera</span>
        <button class="btn-cta-yellow" onclick="closeVideoPlayerModal()" style="padding: 8px 18px; font-size: 13px;">Terminar de ver</button>
      </div>
    </div>
  </div>

  <!-- ============================================================
       MODAL REALIZADOR DE EJERCICIOS INTERACTIVOS
       ============================================================ -->
  <div class="modal-overlay" id="exercisePlayerModal" role="dialog" aria-modal="true">
    <div class="modal-card" style="text-align: left; max-width: 580px; padding: 24px; width: 95%;">
      <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
        <span style="font-size: 11px; font-weight: 800; background: #e0e7ff; color: #4338ca; padding: 3px 10px; border-radius: 999px;" id="exerciseModalType">ACTIVIDAD PRÁCTICA</span>
        <button class="modal-close-btn" onclick="closeExercisePlayerModal()" style="position: static;" aria-label="Cerrar ejercicio">×</button>
      </div>
      <h3 id="exerciseModalTitle" style="font-size: 18px; margin: 0 0 8px; color: var(--text-dark); font-weight: 800;">Título del ejercicio</h3>
      <p id="exerciseModalDesc" style="font-size: 13.5px; color: var(--text-muted); line-height: 1.5; margin-bottom: 16px;">Descripción del ejercicio.</p>
      
      <div id="exerciseModalOptions" style="display: flex; flex-direction: column; gap: 8px; margin-bottom: 16px;">
        <!-- Se llena dinámicamente con JS -->
      </div>

      <div id="exerciseModalFeedback" style="display: none; padding: 12px 14px; border-radius: 10px; margin-bottom: 16px; font-size: 13px; line-height: 1.4;"></div>

      <div style="display: flex; justify-content: space-between; align-items: center; gap: 10px; flex-wrap: wrap;">
        <button type="button" class="btn-cta-yellow" onclick="comprobarEjercicioModal()" style="padding: 10px 22px; font-size: 13px;">Comprobar mi respuesta</button>
        <button type="button" class="btn-cta-outline" onclick="closeExercisePlayerModal()" style="padding: 9px 18px; font-size: 13px; color: var(--text-dark); border-color: #d4e7de;">Cerrar</button>
      </div>
    </div>
  </div>


  <!-- MODAL: REPRODUCTOR DE VIDEO REAL -->
  <div class="modal-overlay" id="videoPlayerModal" role="dialog" aria-modal="true">
    <div class="modal-card" style="text-align: left; max-width: 760px; padding: 22px; width: 95%;">
      <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px; border-bottom: 1px solid #e2e8f0; padding-bottom: 10px;">
        <h4 id="videoPlayerTitle" style="margin: 0; font-size: 17px; color: var(--gris-oscuro); display: flex; align-items: center; gap: 8px;">
          <span>🎥</span> <span>Clase en Video</span>
        </h4>
        <button class="modal-close-btn" onclick="closeVideoPlayerModal()" style="position: static;" aria-label="Cerrar reproductor">✕</button>
      </div>
      <div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; border-radius: 12px; background: #000; box-shadow: 0 8px 24px rgba(0,0,0,0.18);">
        <iframe id="videoPlayerIframe" style="position: absolute; top:0; left:0; width:100%; height:100%; border:0;" src="" title="Reproductor de Video" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
      <div style="margin-top: 12px; display: flex; justify-content: flex-end;">
        <button type="button" class="btn-cta-yellow" onclick="closeVideoPlayerModal()" style="padding: 8px 18px; font-size: 13.5px;">Cerrar Video</button>
      </div>
    </div>
  </div>

  <!-- MODAL: REPRODUCTOR DE AUDIO / PODCAST -->
  <div class="modal-overlay" id="audioPlayerModal" role="dialog" aria-modal="true">
    <div class="modal-card" style="text-align: left; max-width: 580px; padding: 24px; width: 95%; background: #ffffff;">
      <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
        <span style="font-size: 11px; font-weight: 700; text-transform: uppercase; background: #e0f2fe; color: #0369a1; padding: 4px 10px; border-radius: 999px;">
          🎧 PODCAST & AUDIO-LECCIÓN OFICIAL
        </span>
        <button class="modal-close-btn" onclick="closeAudioPlayerModal()" style="position: static;" aria-label="Cerrar audio">✕</button>
      </div>

      <div style="background: linear-gradient(135deg, #053724 0%, #06402d 100%); color: #ffffff; padding: 22px; border-radius: 14px; margin-bottom: 18px;">
        <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 14px;">
          <div style="width: 54px; height: 54px; border-radius: 14px; background: var(--amarillo-dorado); display: grid; place-items: center; font-size: 26px; color: #06402d; flex-shrink: 0;">
            🎙️
          </div>
          <div>
            <h4 id="audioModalTitle" style="font-size: 17px; margin: 0 0 4px; font-weight: 700; color: #ffffff;">Título del Audio</h4>
            <div id="audioModalDuration" style="font-size: 12.5px; opacity: 0.85;">Duración: 18 min</div>
          </div>
        </div>

        <p id="audioModalDesc" style="font-size: 13px; opacity: 0.9; line-height: 1.5; margin-bottom: 16px;">
          Escucha esta síntesis comentada por el profesor mientras realizas tus actividades cotidianas.
        </p>

        <!-- Visualizador de ondas sonoras animadas -->
        <div class="audio-wave-visual" id="audioWaveVisual" style="display: flex; align-items: flex-end; justify-content: center; gap: 4px; height: 36px; margin-bottom: 16px;">
          <span class="wave-bar" style="height: 12px;"></span>
          <span class="wave-bar" style="height: 24px;"></span>
          <span class="wave-bar" style="height: 32px;"></span>
          <span class="wave-bar" style="height: 18px;"></span>
          <span class="wave-bar" style="height: 28px;"></span>
          <span class="wave-bar" style="height: 36px;"></span>
          <span class="wave-bar" style="height: 20px;"></span>
          <span class="wave-bar" style="height: 30px;"></span>
          <span class="wave-bar" style="height: 14px;"></span>
        </div>

        <!-- Barra de progreso -->
        <div style="background: rgba(255,255,255,0.2); height: 6px; border-radius: 999px; overflow: hidden; margin-bottom: 8px;">
          <div id="audioModalProgressBar" style="background: var(--amarillo-dorado); height: 100%; width: 0%; transition: width 0.3s ease;"></div>
        </div>
        <div style="display: flex; justify-content: space-between; font-size: 11px; opacity: 0.8;">
          <span id="audioModalCurrentTime">00:00</span>
          <span>Reproducción continua en HD</span>
        </div>
      </div>

      <div style="display: flex; gap: 12px; justify-content: space-between; align-items: center;">
        <button type="button" id="btnPlayAudioModal" onclick="toggleAudioPlayback()" class="btn-cta-yellow" style="flex: 1; padding: 12px; font-weight: 700; font-size: 14px; display: flex; align-items: center; justify-content: center; gap: 8px;">
          ▶️ Iniciar reproducción
        </button>
        <button type="button" onclick="closeAudioPlayerModal()" style="background: #f1f5f9; color: var(--gris-oscuro); border: 1px solid #cbd5e1; padding: 12px 18px; border-radius: 10px; font-weight: 600; cursor: pointer;">
          Cerrar
        </button>
      </div>
    </div>
  </div>

  <!-- MODAL: LECTOR Y DESCARGADOR DE LIBROS / GUÍAS -->
  <div class="modal-overlay" id="bookReaderModal" role="dialog" aria-modal="true">
    <div class="modal-card" style="text-align: left; max-width: 620px; padding: 24px; width: 95%; max-height: 90vh; overflow-y: auto;">
      <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
        <span style="font-size: 11px; font-weight: 700; text-transform: uppercase; background: #fef08a; color: #854d0e; padding: 4px 10px; border-radius: 999px;">
          📚 LECTURA & GUÍA OFICIAL
        </span>
        <button class="modal-close-btn" onclick="closeBookReaderModal()" style="position: static;" aria-label="Cerrar libro">✕</button>
      </div>

      <div style="display: flex; gap: 16px; margin-bottom: 16px; align-items: flex-start;">
        <div style="width: 58px; height: 76px; background: linear-gradient(135deg, #00703C, #06402d); border-radius: 8px; display: grid; place-items: center; font-size: 32px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); flex-shrink: 0; color: #ffffff;">
          📖
        </div>
        <div>
          <h3 id="bookModalTitle" style="font-size: 18px; margin: 0 0 4px; font-weight: 700; color: var(--gris-oscuro);">Título del Libro</h3>
          <div id="bookModalAuthor" style="font-size: 13.5px; color: var(--verde-bosque); font-weight: 600; margin-bottom: 6px;">Por Autor</div>
          <p id="bookModalDesc" style="font-size: 13px; color: var(--gris-medio); line-height: 1.45; margin: 0;">Descripción oficial del material formativo.</p>
        </div>
      </div>

      <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 16px; margin-bottom: 18px;">
        <h5 style="font-size: 14px; font-weight: 700; color: var(--verde-principal); margin: 0 0 10px; display: flex; align-items: center; gap: 6px;">
          <span>💡</span> <span>5 Principios y Lecciones de este libro:</span>
        </h5>
        <ul id="bookModalLessons" style="margin: 0; padding-left: 20px; font-size: 13px; color: #334155; line-height: 1.6;">
          <li><strong>Principio 1:</strong> La diferencia entre ingresos activos y generación de flujo pasivo.</li>
          <li><strong>Principio 2:</strong> Auditar y proteger el 20% de cada peso que ganas.</li>
          <li><strong>Principio 3:</strong> El costo oculto de la deuda y cómo eliminar intereses abusivos.</li>
          <li><strong>Principio 4:</strong> Inversión recurrente automatizada para aprovechar el interés compuesto.</li>
          <li><strong>Principio 5:</strong> Definir tu fecha y número exacto de libertad financiera.</li>
        </ul>
      </div>

      <div style="display: flex; gap: 12px; justify-content: flex-end; align-items: center;">
        <button type="button" onclick="descargarGuiaPdfActual()" class="btn-cta-yellow" style="padding: 10px 18px; font-size: 13.5px; display: flex; align-items: center; gap: 8px;">
          <span>📥</span> <span>Descargar Guía Oficial (PDF / HTML)</span>
        </button>
        <button type="button" onclick="closeBookReaderModal()" style="background: #f1f5f9; color: var(--gris-oscuro); border: 1px solid #cbd5e1; padding: 10px 18px; border-radius: 10px; font-weight: 600; cursor: pointer;">
          Cerrar
        </button>
      </div>
    </div>
  </div>

  <!-- MODAL: EJERCICIOS Y CASOS PRÁCTICOS -->
  <div class="modal-overlay" id="exercisePlayerModal" role="dialog" aria-modal="true">
    <div class="modal-card" style="text-align: left; max-width: 620px; padding: 24px; width: 95%;">
      <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
        <span style="font-size: 11px; font-weight: 700; text-transform: uppercase; background: #e0e7ff; color: #4338ca; padding: 4px 10px; border-radius: 999px;">
          📝 ACTIVIDAD PRÁCTICA DEL MÓDULO
        </span>
        <button class="modal-close-btn" onclick="closeExercisePlayerModal()" style="position: static;" aria-label="Cerrar ejercicio">✕</button>
      </div>
      <h3 id="exerciseModalTitle" style="font-size: 17px; margin: 0 0 6px; font-weight: 700; color: var(--gris-oscuro);">Título del Ejercicio</h3>
      <p id="exerciseModalDesc" style="color: var(--gris-medio); font-size: 13.5px; line-height: 1.5; margin-bottom: 16px;">Instrucciones para resolver el ejercicio.</p>

      <div id="exerciseModalOptions" style="display: flex; flex-direction: column; gap: 8px; margin-bottom: 16px;"></div>

      <div id="exerciseModalFeedback" style="display: none; padding: 12px 14px; border-radius: 10px; font-size: 13.5px; margin-bottom: 16px; line-height: 1.5;"></div>

      <div style="display: flex; justify-content: space-between; align-items: center; gap: 12px;">
        <button type="button" class="btn-cta-yellow" onclick="comprobarEjercicioModal()" style="padding: 10px 20px; font-size: 14px; font-weight: 700;">
          Comprobar respuesta
        </button>
        <button type="button" onclick="closeExercisePlayerModal()" style="background: #f1f5f9; color: var(--gris-oscuro); border: 1px solid #cbd5e1; padding: 10px 18px; border-radius: 10px; font-weight: 600; cursor: pointer;">
          Cerrar
        </button>
      </div>
    </div>
  </div>
