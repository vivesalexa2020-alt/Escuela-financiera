<?php
/**
 * Vista: Mis Metas Financieras
 * Contenido migrado desde metas.html (legacy/html).
 * Variables: $pageTitle, $pageCss, $bodyClass, $user
 */
?>
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
        <a href="index.php?page=reticula" class="sidebar-link ">
          <span class="sidebar-icon">🗺️</span>
          <span>Retícula Académica</span>
        </a>
        <a href="index.php?page=aula" class="sidebar-link ">
          <span class="sidebar-icon">🚀</span>
          <span>Aula Demo</span>
        </a>
        <a href="index.php?page=metas" class="sidebar-link active">
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

        <!-- Aviso en la parte superior: Menú bloqueado -->
        <div id="navGuestNotice" onclick="openLoginModal()" style="display: flex; align-items: center; gap: 8px; font-size: 15px; color: var(--accent-lime); background: rgba(203, 246, 62, 0.12); padding: 7px 18px; border-radius: 999px; border: 1px solid rgba(203, 246, 62, 0.35); cursor: pointer; font-weight: 600; transition: all 0.2s;" title="Haz clic para iniciar sesión">
          <span>🔒</span> Inicia sesión para acceder al menú
        </div>

        <div class="nav-actions">
          <button class="btn-login" onclick="openLoginModal()">Iniciar sesión</button>
          <button class="btn-signup" onclick="openSignupModal()">Crear cuenta</button>
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
        <div class="page-current-title">Retícula Académica</div>
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
        <span class="subpage-badge" style="margin: 0;">&#x1F3AF; Metas y H&aacute;bitos Financieros</span>
      </div>
      <h1>Mis <span>Metas Financieras</span></h1>
      <p>Organiza tu crecimiento con herramientas para crear h&aacute;bitos, simulador de decisiones y plan de recuperaci&oacute;n.</p>
    </div>
  </section>

  <div id="protectedContent" style="display: block !important;">
    <div class="container" style="padding: 48px 20px 20px;">
      <!-- BANNER SUPERIOR PRINCIPIANTES -->
      <div style="background: linear-gradient(135deg, #053724 0%, #0d5f3e 100%); color: #ffffff; border-radius: 18px; padding: 24px 28px; margin-bottom: 24px; box-shadow: 0 10px 30px rgba(5,55,36,0.15); display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 16px;">
        <div style="max-width: 680px;">
          <div style="display: inline-flex; align-items: center; gap: 8px; background: rgba(203,246,62,0.2); color: #cbf63e; font-size: 14px; font-weight: 800; padding: 4px 12px; border-radius: 20px; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px;">
            <span>&#x2728;</span> Dise&ntilde;ado para Principiantes &bull; 100% Pr&aacute;ctico
          </div>
          <h2 style="font-size: 26.5px; font-weight: 900; color: #ffffff; margin: 0 0 6px;">Tu Centro de Metas y Transformaci&oacute;n Financiera</h2>
          <p style="font-size: 16.5px; color: #d7f4e6; margin: 0; line-height: 1.5;">
            Sin f&oacute;rmulas complicadas. Elige una de las 3 herramientas interactivas de abajo para ahorrar, cumplir h&aacute;bitos y eliminar deudas paso a paso.
          </p>
        </div>
        <div style="display: flex; gap: 8px; background: rgba(255,255,255,0.12); padding: 8px 14px; border-radius: 14px; backdrop-filter: blur(4px);">
          <div style="text-align: center; padding: 0 8px;">
            <div style="font-size: 22.5px; font-weight: 900; color: #cbf63e;">3</div>
            <div style="font-size: 13px; color: #e2e8f0; font-weight: 600;">Herramientas</div>
          </div>
          <div style="width: 1px; background: rgba(255,255,255,0.2);"></div>
          <div style="text-align: center; padding: 0 8px;">
            <div style="font-size: 22.5px; font-weight: 900; color: #fabb15;">$0</div>
            <div style="font-size: 13px; color: #e2e8f0; font-weight: 600;">Acceso Libre</div>
          </div>
        </div>
      </div>

      <section class="metas-interactive-suite">

        <!-- TABS MODERNOS CON DEGRADADOS Y COLORES -->
        <div class="metas-tabs-nav" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 12px; margin-bottom: 26px;">
          
          <button type="button" class="metas-tab-btn active" id="tabBtnMetas" onclick="switchMetasTab('metas')" 
                  style="padding: 16px 20px; border-radius: 14px; font-weight: 800; font-size: 17px; border: 2px solid #00703C; cursor: pointer; display: flex; align-items: center; gap: 12px; background: linear-gradient(135deg, #00703C 0%, #064e2e 100%); color: #ffffff; box-shadow: 0 6px 18px rgba(0,112,60,0.25); transition: all 0.25s ease; text-align: left;">
            <span style="font-size: 30.5px; background: rgba(255,255,255,0.2); width: 44px; height: 44px; border-radius: 10px; display: flex; align-items: center; justify-content: center;">&#x1F3AF;</span>
            <div>
              <div style="font-size: 17px; font-weight: 800;">1. Metas de Ahorro</div>
              <div style="font-size: 14px; opacity: 0.9; font-weight: 500;">Calcula y visualiza tu progreso</div>
            </div>
          </button>

          <button type="button" class="metas-tab-btn" id="tabBtnRetos" onclick="switchMetasTab('retos')" 
                  style="padding: 16px 20px; border-radius: 14px; font-weight: 800; font-size: 17px; border: 2px solid #e2e8f0; cursor: pointer; display: flex; align-items: center; gap: 12px; background: #ffffff; color: #1e293b; box-shadow: 0 2px 8px rgba(0,0,0,0.04); transition: all 0.25s ease; text-align: left;">
            <span style="font-size: 30.5px; background: #fef3c7; width: 44px; height: 44px; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #d97706;">&#x1F3C6;</span>
            <div>
              <div style="font-size: 17px; font-weight: 800;">2. Retos Semanales</div>
              <div style="font-size: 14px; color: #64748b; font-weight: 500;">Desaf&iacute;os r&aacute;pidos con medallas</div>
            </div>
          </button>

          <button type="button" class="metas-tab-btn" id="tabBtnDeudas" onclick="switchMetasTab('deudas')" 
                  style="padding: 16px 20px; border-radius: 14px; font-weight: 800; font-size: 17px; border: 2px solid #e2e8f0; cursor: pointer; display: flex; align-items: center; gap: 12px; background: #ffffff; color: #1e293b; box-shadow: 0 2px 8px rgba(0,0,0,0.04); transition: all 0.25s ease; text-align: left;">
            <span style="font-size: 30.5px; background: #fee2e2; width: 44px; height: 44px; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #dc2626;">&#x1F6E1;&#xFE0F;</span>
            <div>
              <div style="font-size: 17px; font-weight: 800;">3. M&eacute;todo Anti-Deuda</div>
              <div style="font-size: 14px; color: #64748b; font-weight: 500;">Estrategia Bola de Nieve</div>
            </div>
          </button>

        </div>

        <!-- ========================================================
             TAB 1: RASTREADOR DE METAS DE AHORRO
             ======================================================== -->
        <div class="metas-tab-content" id="tabContentMetas" style="display: block;">
          
          <!-- FORMULARIO CREAR META VIBRANTE -->
          <div style="background: linear-gradient(135deg, #f0fdf4 0%, #ffffff 100%); border-radius: 18px; border: 1.5px solid #86efac; padding: 26px; box-shadow: 0 6px 20px rgba(0,112,60,0.06); margin-bottom: 30px;">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; margin-bottom: 20px;">
              <div>
                <span style="background: #dcfce7; color: #15803d; font-size: 14px; font-weight: 800; padding: 4px 10px; border-radius: 20px; display: inline-block; margin-bottom: 6px;">
                  &#x1F4B0; Simulador de Ahorro Paso a Paso
                </span>
                <h3 style="font-size: 23.5px; font-weight: 900; color: #064e3b; margin: 0 0 4px;">&iquest;Qu&eacute; sue&ntilde;o o meta quieres alcanzar?</h3>
                <p style="font-size: 15.5px; color: #475569; margin: 0;">Escribe tu meta e ingresa un aporte mensual c&oacute;modo (Â¡incluso desde $500 o $1,500 MXN!).</p>
              </div>
            </div>

            <form id="formNuevaMeta" onsubmit="agregarNuevaMeta(event)" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(210px, 1fr)); gap: 14px; align-items: flex-end;">
              <div>
                <label style="display: block; font-size: 14.5px; font-weight: 800; color: #1e293b; margin-bottom: 6px;">
                  &#x1F3AF; Nombre de la Meta
                </label>
                <input type="text" id="metaNombre" placeholder="Ej. Fondo de emergencia o Viaje" required style="width: 100%; padding: 11px 14px; border: 1.5px solid #cbd5e1; border-radius: 10px; font-size: 16px; font-weight: 700; background: #ffffff;">
              </div>
              <div>
                <label style="display: block; font-size: 14.5px; font-weight: 800; color: #1e293b; margin-bottom: 6px;">
                  &#x1F4B5; Monto Objetivo ($ MXN)
                </label>
                <input type="number" id="metaObjetivo" placeholder="Ej. 15000" min="500" step="500" required style="width: 100%; padding: 11px 14px; border: 1.5px solid #cbd5e1; border-radius: 10px; font-size: 16px; font-weight: 700; background: #ffffff;">
              </div>
              <div>
                <label style="display: block; font-size: 14.5px; font-weight: 800; color: #1e293b; margin-bottom: 6px;">
                  &#x1F9FE; &iquest;Cu&aacute;nto tienes hoy? ($)
                </label>
                <input type="number" id="metaActual" placeholder="Ej. 2000" min="0" step="100" value="0" required style="width: 100%; padding: 11px 14px; border: 1.5px solid #cbd5e1; border-radius: 10px; font-size: 16px; font-weight: 700; background: #ffffff;">
              </div>
              <div>
                <label style="display: block; font-size: 14.5px; font-weight: 800; color: #1e293b; margin-bottom: 6px;">
                  &#x1F4C5; Aporte mensual ($ MXN)
                </label>
                <input type="number" id="metaAporte" placeholder="Ej. 1500" min="100" step="100" value="1500" required style="width: 100%; padding: 11px 14px; border: 1.5px solid #cbd5e1; border-radius: 10px; font-size: 16px; font-weight: 700; background: #ffffff;">
              </div>
              <div>
                <button type="submit" style="width: 100%; padding: 12px 18px; background: linear-gradient(135deg, #00703C 0%, #15803d 100%); color: #ffffff; border: none; border-radius: 10px; font-weight: 800; font-size: 16.5px; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; box-shadow: 0 4px 14px rgba(0,112,60,0.3); transition: transform 0.15s ease;">
                  <span>&#x2728;</span> Agregar Meta
                </button>
              </div>
            </form>
          </div>

          <!-- ENCABEZADO DE TARJETAS -->
          <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px; flex-wrap: wrap; gap: 10px;">
            <div>
              <h3 style="font-size: 22.5px; font-weight: 900; color: #0f172a; margin: 0 0 4px;">Tus Metas Activas</h3>
              <p style="font-size: 15.5px; color: #64748b; margin: 0;">Presiona los botones verdes <strong>+Abonar</strong> para simular tus aportes y ver crecer tu barra.</p>
            </div>
            <button type="button" onclick="restablecerMetasEjemplo()" style="background: #f1f5f9; color: #475569; border: 1px solid #cbd5e1; padding: 7px 14px; border-radius: 8px; font-size: 14.5px; font-weight: 700; cursor: pointer;">
              &#x21BA; Cargar Metas Recomendadas
            </button>
          </div>

          <!-- GRID DE TARJETAS DE METAS COLORIDAS -->
          <div id="gridMetasCards" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 20px;">
            <!-- Renderizado dinamicamente por JS -->
          </div>

        </div>

        <!-- ========================================================
             TAB 2: RETOS FINANCIEROS SEMANALES (GAMIFICACION)
             ======================================================== -->
        <div class="metas-tab-content" id="tabContentRetos" style="display: none;">
          
          <!-- BANNER HERO RETOS CON TROFEO -->
          <div style="background: linear-gradient(135deg, #1e1b4b 0%, #312e81 100%); color: #ffffff; border-radius: 18px; padding: 26px 28px; margin-bottom: 26px; box-shadow: 0 8px 26px rgba(49,46,129,0.25);">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
              <div>
                <div style="display: inline-flex; align-items: center; gap: 6px; background: rgba(250,187,21,0.25); color: #fabb15; font-size: 14px; font-weight: 800; padding: 4px 12px; border-radius: 20px; text-transform: uppercase; margin-bottom: 8px;">
                  <span>&#x1F3C6;</span> Nivel 1: Constructor de Disciplina
                </div>
                <h3 style="font-size: 25.5px; font-weight: 900; margin: 0 0 6px; color: #ffffff;">5 Retos F&aacute;ciles de Transformaci&oacute;n</h3>
                <p style="font-size: 16px; color: #c7d2fe; margin: 0; max-width: 650px;">
                  Gana peque&ntilde;as victorias cada semana. Al marcar cada reto ver&aacute;s c&oacute;mo aumenta tu barra de progreso y liberas dinero real.
                </p>
              </div>
              <div style="background: rgba(255,255,255,0.12); padding: 14px 22px; border-radius: 14px; text-align: center; border: 1px solid rgba(255,255,255,0.2);">
                <div style="font-size: 34.5px; font-weight: 900; color: #cbf63e; line-height: 1;" id="contadorRetosTxt">0 / 5</div>
                <div style="font-size: 14px; color: #e0e7ff; font-weight: 700; margin-top: 4px;">Retos Completados</div>
              </div>
            </div>

            <!-- BARRA DE NIVEL GAMIFICADA -->
            <div style="background: rgba(255,255,255,0.2); height: 12px; border-radius: 10px; margin-top: 22px; overflow: hidden;">
              <div id="barraProgresoRetos" style="background: linear-gradient(90deg, #fabb15 0%, #cbf63e 100%); height: 100%; width: 0%; border-radius: 10px; transition: width 0.4s ease;"></div>
            </div>
          </div>

          <!-- LISTA DE LOS 5 RETOS EN COLORES PASTEL -->
          <div id="listaRetosContainer" style="display: flex; flex-direction: column; gap: 16px;">
            <!-- Renderizado por JS -->
          </div>

        </div>

        <!-- ========================================================
             TAB 3: METODO BOLA DE NIEVE (ANTI-DEUDA)
             ======================================================== -->
        <div class="metas-tab-content" id="tabContentDeudas" style="display: none;">
          
          <!-- TARJETA EXPLICATIVA AMIGABLE -->
          <div style="background: linear-gradient(135deg, #fff1f2 0%, #ffffff 100%); border-radius: 18px; border: 1.5px solid #fecdd3; padding: 26px; box-shadow: 0 6px 20px rgba(225,29,72,0.06); margin-bottom: 26px;">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 14px; margin-bottom: 20px;">
              <div>
                <span style="background: #ffe4e6; color: #e11d48; font-size: 14px; font-weight: 800; padding: 4px 12px; border-radius: 20px; display: inline-block; margin-bottom: 8px;">
                  &#x1F9CA; M&eacute;todo Psicol&oacute;gico Comprobado
                </span>
                <h3 style="font-size: 24.5px; font-weight: 900; color: #881337; margin: 0 0 6px;">&iquest;C&oacute;mo funciona la Bola de Nieve?</h3>
                <p style="font-size: 16px; color: #4c0519; margin: 0; max-width: 680px; line-height: 1.5;">
                  Pagas el m&iacute;nimo en las grandes y concentras todo tu dinero extra en <strong>liquidar la m&aacute;s chiquita primero</strong>. Al vencer la primera, sientes alivio inmediato y sumas ese dinero a la siguiente.
                </p>
              </div>

              <!-- APORTE EXTRA MENSUAL VIBRANTE -->
              <div style="background: #ffffff; padding: 12px 18px; border-radius: 12px; border: 2px solid #fb7185; box-shadow: 0 4px 12px rgba(225,29,72,0.1);">
                <label style="font-size: 14px; font-weight: 800; color: #9f1239; display: block; margin-bottom: 4px;">&#x26A1; Aporte extra mensual:</label>
                <div style="display: flex; align-items: center; gap: 6px;">
                  <span style="font-size: 18px; font-weight: 900; color: #e11d48;">$</span>
                  <input type="number" id="inputAporteExtraBola" value="1000" min="0" step="200" oninput="calcularBolaDeNieve()" 
                         style="width: 120px; padding: 6px 10px; border: 1.5px solid #fda4af; border-radius: 8px; font-weight: 900; font-size: 18px; color: #881337; background: #fff1f2;">
                  <span style="font-size: 14px; color: #9f1239; font-weight: 700;">MXN</span>
                </div>
              </div>
            </div>

            <!-- TABLA ESTILIZADA DE COMPROMISOS -->
            <div style="overflow-x: auto; margin-bottom: 20px; border-radius: 12px; border: 1px solid #fed7aa; background: #ffffff;">
              <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 15.5px;">
                <thead>
                  <tr style="background: linear-gradient(90deg, #ffedd5 0%, #fed7aa 100%); color: #7c2d12; font-weight: 800;">
                    <th style="padding: 12px 16px;">Prioridad de Pago</th>
                    <th style="padding: 12px 16px;">Compromiso</th>
                    <th style="padding: 12px 16px;">Saldo Restante</th>
                    <th style="padding: 12px 16px;">Pago M&iacute;nimo</th>
                    <th style="padding: 12px 16px;">Tasa Anual</th>
                    <th style="padding: 12px 16px; text-align: center;">Eliminar</th>
                  </tr>
                </thead>
                <tbody id="tablaDeudasBody">
                  <!-- Renderizado por JS con colores semaforo -->
                </tbody>
              </table>
            </div>

            <!-- FORMULARIO AGREGAR DEUDA AMIGABLE -->
            <form id="formAgregarDeuda" onsubmit="agregarDeudaBola(event)" style="display: grid; grid-template-columns: 2fr 1fr 1fr 1fr auto; gap: 10px; align-items: flex-end; background: #fff7ed; padding: 16px; border-radius: 12px; border: 1.5px dashed #fdba74;">
              <div>
                <label style="display:block; font-size:13.5px; font-weight:700; color:#9a3412; margin-bottom:4px;">Nombre</label>
                <input type="text" id="nuevaDeudaNombre" placeholder="Ej. Tarjeta Bancomer" required style="width: 100%; padding: 8px 12px; border: 1px solid #fdba74; border-radius: 8px; font-size: 15px; background:#fff;">
              </div>
              <div>
                <label style="display:block; font-size:13.5px; font-weight:700; color:#9a3412; margin-bottom:4px;">Saldo Total ($)</label>
                <input type="number" id="nuevaDeudaSaldo" placeholder="3500" min="100" step="100" required style="width: 100%; padding: 8px 12px; border: 1px solid #fdba74; border-radius: 8px; font-size: 15px; background:#fff;">
              </div>
              <div>
                <label style="display:block; font-size:13.5px; font-weight:700; color:#9a3412; margin-bottom:4px;">M&iacute;nimo Mes ($)</label>
                <input type="number" id="nuevaDeudaMinimo" placeholder="400" min="50" step="50" required style="width: 100%; padding: 8px 12px; border: 1px solid #fdba74; border-radius: 8px; font-size: 15px; background:#fff;">
              </div>
              <div>
                <label style="display:block; font-size:13.5px; font-weight:700; color:#9a3412; margin-bottom:4px;">Tasa %</label>
                <input type="number" id="nuevaDeudaTasa" placeholder="35" min="0" max="150" step="1" value="35" style="width: 100%; padding: 8px 12px; border: 1px solid #fdba74; border-radius: 8px; font-size: 15px; background:#fff;">
              </div>
              <div>
                <button type="submit" style="padding: 9px 18px; background: #ea580c; color: #ffffff; border: none; border-radius: 8px; font-weight: 800; font-size: 15px; cursor: pointer; box-shadow: 0 3px 10px rgba(234,88,12,0.3);">
                  + Registrar
                </button>
              </div>
            </form>

          </div>

          <!-- RESULTADOS COLORIDOS DE BOLA DE NIEVE -->
          <div id="resultadoBolaContainer">
            <!-- Renderizado dinamicamente por JS -->
          </div>

        </div>

      </section>

      <!-- JAVASCRIPT INTEGRADO DE LAS 3 HERRAMIENTAS -->
      <script>
        // --- 1. GESTION DE TABS COLORIDOS ---
        function switchMetasTab(tabId) {
          const tabs = ['metas', 'retos', 'deudas'];
          tabs.forEach(t => {
            const btn = document.getElementById('tabBtn' + t.charAt(0).toUpperCase() + t.slice(1));
            const content = document.getElementById('tabContent' + t.charAt(0).toUpperCase() + t.slice(1));
            if (t === tabId) {
              if (btn) {
                if (t === 'metas') {
                  btn.style.background = 'linear-gradient(135deg, #00703C 0%, #064e2e 100%)';
                  btn.style.borderColor = '#00703C';
                  btn.style.boxShadow = '0 6px 18px rgba(0,112,60,0.25)';
                } else if (t === 'retos') {
                  btn.style.background = 'linear-gradient(135deg, #d97706 0%, #b45309 100%)';
                  btn.style.borderColor = '#d97706';
                  btn.style.boxShadow = '0 6px 18px rgba(217,119,6,0.25)';
                } else {
                  btn.style.background = 'linear-gradient(135deg, #e11d48 0%, #be123c 100%)';
                  btn.style.borderColor = '#e11d48';
                  btn.style.boxShadow = '0 6px 18px rgba(225,29,72,0.25)';
                }
                btn.style.color = '#ffffff';
                const iconBox = btn.querySelector('span');
                if (iconBox) {
                  iconBox.style.background = 'rgba(255,255,255,0.25)';
                  iconBox.style.color = '#ffffff';
                }
              }
              if (content) content.style.display = 'block';
            } else {
              if (btn) {
                btn.style.background = '#ffffff';
                btn.style.color = '#1e293b';
                btn.style.borderColor = '#e2e8f0';
                btn.style.boxShadow = '0 2px 8px rgba(0,0,0,0.04)';
                const iconBox = btn.querySelector('span');
                if (iconBox) {
                  if (t === 'metas') { iconBox.style.background = '#dcfce7'; iconBox.style.color = '#15803d'; }
                  else if (t === 'retos') { iconBox.style.background = '#fef3c7'; iconBox.style.color = '#d97706'; }
                  else { iconBox.style.background = '#fee2e2'; iconBox.style.color = '#dc2626'; }
                }
              }
              if (content) content.style.display = 'none';
            }
          });
        }

        // --- 2. LOGICA METAS DE AHORRO ---
        const METAS_STORAGE_KEY = 'edu_fin_metas_list_v2';
        let misMetas = [];

        function cargarMetasIniciales() {
          const guardadas = localStorage.getItem(METAS_STORAGE_KEY);
          if (guardadas) {
            try { misMetas = JSON.parse(guardadas); } catch(e) { misMetas = []; }
          }
          if (!misMetas || misMetas.length === 0) {
            restablecerMetasEjemplo();
            return;
          }
          renderMetasCards();
        }

        function restablecerMetasEjemplo() {
          misMetas = [
            { 
              id: 1, 
              nombre: 'Colch&oacute;n de Emergencia (3 Meses)', 
              categoria: 'Seguridad', 
              objetivo: 18000, 
              actual: 7500, 
              aporte: 1500, 
              colorTheme: 'green',
              icono: '&#x1F6E1;&#xFE0F;' 
            },
            { 
              id: 2, 
              nombre: 'Mi Primera Inversi&oacute;n en CETES', 
              categoria: 'Inversi&oacute;n', 
              objetivo: 10000, 
              actual: 4000, 
              aporte: 1500, 
              colorTheme: 'blue',
              icono: '&#x1F4C8;' 
            },
            { 
              id: 3, 
              nombre: 'Nueva Laptop para Estudiar y Trabajar', 
              categoria: 'Herramienta', 
              objetivo: 12000, 
              actual: 6000, 
              aporte: 1500, 
              colorTheme: 'amber',
              icono: '&#x1F4BB;' 
            }
          ];
          guardarMetas();
          renderMetasCards();
        }

        function guardarMetas() {
          localStorage.setItem(METAS_STORAGE_KEY, JSON.stringify(misMetas));
        }

        function renderMetasCards() {
          const container = document.getElementById('gridMetasCards');
          if (!container) return;
          container.innerHTML = '';

          const themes = {
            green: { bg: '#f0fdf4', border: '#86efac', bar: 'linear-gradient(90deg, #10b981 0%, #00703C 100%)', badgeBg: '#dcfce7', badgeColor: '#166534', btnBg: '#00703C' },
            blue:  { bg: '#f0f9ff', border: '#7dd3fc', bar: 'linear-gradient(90deg, #38bdf8 0%, #0284c7 100%)', badgeBg: '#e0f2fe', badgeColor: '#075985', btnBg: '#0284c7' },
            amber: { bg: '#fffbeb', border: '#fcd34d', bar: 'linear-gradient(90deg, #fbbf24 0%, #d97706 100%)', badgeBg: '#fef3c7', badgeColor: '#92400e', btnBg: '#d97706' }
          };

          misMetas.forEach((m, idx) => {
            const themeKey = m.colorTheme || (idx % 3 === 0 ? 'green' : (idx % 3 === 1 ? 'blue' : 'amber'));
            const th = themes[themeKey] || themes.green;

            const pct = Math.min(100, Math.round((m.actual / m.objetivo) * 100));
            const restante = Math.max(0, m.objetivo - m.actual);
            const meses = m.aporte > 0 ? Math.ceil(restante / m.aporte) : 0;

            const card = document.createElement('div');
            card.style.background = th.bg;
            card.style.borderRadius = '18px';
            card.style.border = '2px solid ' + th.border;
            card.style.padding = '22px';
            card.style.boxShadow = '0 6px 20px rgba(0,0,0,0.04)';
            card.style.display = 'flex';
            card.style.flexDirection = 'column';
            card.style.justifyContent = 'space-between';
            card.style.transition = 'transform 0.2s ease';

            card.innerHTML = 
              '<div>' +
                '<div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">' +
                  '<div style="display: flex; align-items: center; gap: 10px;">' +
                    '<span style="font-size: 30.5px; background: #ffffff; width: 44px; height: 44px; border-radius: 12px; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 6px rgba(0,0,0,0.06);">' + (m.icono || '&#x1F3AF;') + '</span>' +
                    '<div>' +
                      '<span style="background:' + th.badgeBg + '; color:' + th.badgeColor + '; font-size: 13px; font-weight: 800; padding: 2px 8px; border-radius: 6px; text-transform: uppercase;">' + (m.categoria || 'Ahorro') + '</span>' +
                      '<h4 style="font-size: 18.5px; font-weight: 900; color:#0f172a; margin: 4px 0 0;">' + m.nombre + '</h4>' +
                    '</div>' +
                  '</div>' +
                  '<button type="button" onclick="eliminarMeta(' + m.id + ')" title="Eliminar meta" style="background:none; border:none; color:#94a3b8; font-size:20px; cursor:pointer; padding:4px;">&times;</button>' +
                '</div>' +

                '<div style="background:#ffffff; border-radius: 12px; padding: 14px; margin-bottom: 14px; border: 1px solid rgba(0,0,0,0.05);">' +
                  '<div style="display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 8px;">' +
                    '<div>' +
                      '<span style="font-size: 13px; color:#64748b; font-weight: 700; text-transform: uppercase;">Llevas ahorrado</span>' +
                      '<div style="font-size: 22.5px; font-weight: 900; color:#0f172a;">$' + m.actual.toLocaleString('es-MX') + ' <span style="font-size: 14px; color:#64748b;">MXN</span></div>' +
                    '</div>' +
                    '<div style="text-align: right;">' +
                      '<span style="font-size: 13px; color:#64748b; font-weight: 700; text-transform: uppercase;">Meta final</span>' +
                      '<div style="font-size: 17px; font-weight: 800; color:#475569;">$' + m.objetivo.toLocaleString('es-MX') + '</div>' +
                    '</div>' +
                  '</div>' +

                  '<div style="background: #e2e8f0; height: 12px; border-radius: 8px; overflow: hidden; margin-bottom: 6px;">' +
                    '<div style="background: ' + th.bar + '; height: 100%; width: ' + pct + '%; border-radius: 8px; transition: width 0.4s ease;"></div>' +
                  '</div>' +

                  '<div style="display: flex; justify-content: space-between; font-size: 14px; font-weight: 700;">' +
                    '<span style="color:' + th.badgeColor + ';">' + pct + '% Completado</span>' +
                    '<span style="color:#64748b;">Faltan: $' + restante.toLocaleString('es-MX') + '</span>' +
                  '</div>' +
                '</div>' +
              '</div>' +

              '<div style="border-top: 1px solid rgba(0,0,0,0.06); padding-top: 14px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">' +
                '<span style="font-size: 14.5px; color:#334155; font-weight: 700;">' +
                  (restante === 0 ? '&#x1F389; &iexcl;META LOGRADA!' : '&#x23F3; Llegar&aacute;s en <strong>' + meses + ' mes(es)</strong>') +
                '</span>' +
                '<div style="display: flex; gap: 6px;">' +
                  '<button type="button" onclick="abonarMeta(' + m.id + ', 500)" style="padding: 7px 12px; font-size: 14px; font-weight: 800; background:#ffffff; color:' + th.badgeColor + '; border:1.5px solid ' + th.border + '; border-radius:8px; cursor:pointer; box-shadow: 0 2px 4px rgba(0,0,0,0.04);">+$500</button>' +
                  '<button type="button" onclick="abonarMeta(' + m.id + ', ' + m.aporte + ')" style="padding: 7px 12px; font-size: 14px; font-weight: 800; background:' + th.btnBg + '; color:#ffffff; border:none; border-radius:8px; cursor:pointer; box-shadow: 0 3px 8px rgba(0,0,0,0.12);">+$' + m.aporte + '</button>' +
                '</div>' +
              '</div>';

            container.appendChild(card);
          });
        }

        function agregarNuevaMeta(e) {
          e.preventDefault();
          const nombre = document.getElementById('metaNombre').value.trim();
          const objetivo = parseFloat(document.getElementById('metaObjetivo').value) || 0;
          const actual = parseFloat(document.getElementById('metaActual').value) || 0;
          const aporte = parseFloat(document.getElementById('metaAporte').value) || 1500;

          if (!nombre || objetivo <= 0) return;

          misMetas.unshift({
            id: Date.now(),
            nombre: nombre,
            categoria: 'Personal',
            objetivo: objetivo,
            actual: actual,
            aporte: aporte,
            colorTheme: misMetas.length % 3 === 0 ? 'green' : (misMetas.length % 3 === 1 ? 'blue' : 'amber'),
            icono: '&#x1F3AF;'
          });

          guardarMetas();
          renderMetasCards();
          document.getElementById('formNuevaMeta').reset();
          document.getElementById('metaActual').value = '0';
          document.getElementById('metaAporte').value = '1500';
        }

        function abonarMeta(id, monto) {
          const meta = misMetas.find(m => m.id === id);
          if (meta) {
            meta.actual = Math.min(meta.objetivo, meta.actual + monto);
            guardarMetas();
            renderMetasCards();
          }
        }

        function eliminarMeta(id) {
          if (confirm('&iquest;Deseas eliminar esta meta?')) {
            misMetas = misMetas.filter(m => m.id !== id);
            guardarMetas();
            renderMetasCards();
          }
        }

        // --- 3. LOGICA RETOS SEMANALES COLORIDOS ---
        const RETOS_STORAGE_KEY = 'edu_fin_retos_status_v2';
        const LISTA_RETOS = [
          {
            id: 'r1',
            titulo: 'Reto 1: Detecta y Elimina tus Fugas Hormiga',
            desc: 'Apunta cada gasto peque&ntilde;o de tu d&iacute;a (caf&eacute; comercial, botanas, comisiones de apps). Elige 2 que puedas evitar y guarda $50 MXN diarios en un sobre.',
            ahorro: '$350 MXN en 7 d&iacute;as',
            duracion: '1 Semana',
            icono: '&#x2615;',
            theme: { bg: '#fffbeb', border: '#fcd34d', badgeBg: '#fef3c7', badgeColor: '#92400e', iconBg: '#fde68a' }
          },
          {
            id: 'r2',
            titulo: 'Reto 2: Construye tu Colch&oacute;n de Paz Mental',
            desc: 'Aparta tus primeros $1,000 MXN en una alcanc&iacute;a o cuenta bancaria sin tarjeta f&iacute;sica. Solo se toca si ocurre una aut&eacute;ntica emergencia m&eacute;dica o dom&eacute;stica.',
            ahorro: '$1,000 MXN ahorrados',
            duracion: '15 d&iacute;as',
            icono: '&#x1F331;',
            theme: { bg: '#f0fdf4', border: '#86efac', badgeBg: '#dcfce7', badgeColor: '#166534', iconBg: '#bbf7d0' }
          },
          {
            id: 'r3',
            titulo: 'Reto 3: Fin de Semana Cero Gastos Innecesarios',
            desc: 'Pasa s&aacute;bado y domingo cocinando rico en casa y organizando paseos al aire libre o pel&iacute;culas con amigos. Demu&eacute;strale a tu cerebro que relajarse no cuesta dinero.',
            ahorro: '$400 a $800 MXN libres',
            duracion: 'Fin de semana',
            icono: '&#x1F3AE;',
            theme: { bg: '#faf5ff', border: '#d8b4fe', badgeBg: '#f3e8ff', badgeColor: '#6b21a8', iconBg: '#e9d5ff' }
          },
          {
            id: 'r4',
            titulo: 'Reto 4: Auditor&iacute;a de Suscripciones Fantasma',
            desc: 'Abre tu banca m&oacute;vil, revisa tus cobros autom&aacute;ticos del &uacute;ltimo mes y cancela de inmediato al menos 1 membres&iacute;a o aplicaci&oacute;n que no uses todos los d&iacute;as.',
            ahorro: '$150 a $350 MXN al mes',
            duracion: '15 minutos',
            icono: '&#x1F4F1;',
            theme: { bg: '#f0f9ff', border: '#7dd3fc', badgeBg: '#e0f2fe', badgeColor: '#075985', iconBg: '#bae6fd' }
          },
          {
            id: 'r5',
            titulo: 'Reto 5: Tu Primer Paso en CETES / Renta Fija',
            desc: 'Abre tu cuenta en CETES Directo o usa el simulador para apartar tus primeros $100 MXN en deuda gubernamental respaldada. Vence el miedo a invertir.',
            ahorro: 'H&aacute;bito de inversi&oacute;n',
            duracion: '1 d&iacute;a',
            icono: '&#x1F48E;',
            theme: { bg: '#fff1f2', border: '#fda4af', badgeBg: '#ffe4e6', badgeColor: '#9f1239', iconBg: '#fecdd3' }
          }
        ];

        let estadosRetos = {};

        function cargarRetos() {
          const guardados = localStorage.getItem(RETOS_STORAGE_KEY);
          if (guardados) {
            try { estadosRetos = JSON.parse(guardados); } catch(e) { estadosRetos = {}; }
          }
          renderRetos();
        }

        function renderRetos() {
          const container = document.getElementById('listaRetosContainer');
          if (!container) return;
          container.innerHTML = '';

          let cumplidos = 0;

          LISTA_RETOS.forEach(r => {
            const completado = !!estadosRetos[r.id];
            if (completado) cumplidos++;
            const th = r.theme;

            const card = document.createElement('div');
            card.style.background = completado ? '#ecfdf5' : th.bg;
            card.style.border = '2px solid ' + (completado ? '#10b981' : th.border);
            card.style.borderRadius = '16px';
            card.style.padding = '20px 22px';
            card.style.display = 'flex';
            card.style.justifyContent = 'space-between';
            card.style.alignItems = 'center';
            card.style.gap = '16px';
            card.style.boxShadow = '0 4px 14px rgba(0,0,0,0.03)';
            card.style.transition = 'all 0.25s ease';

            card.innerHTML = 
              '<div style="display: flex; align-items: flex-start; gap: 16px; flex: 1;">' +
                '<div style="font-size: 28.5px; width: 48px; height: 48px; border-radius: 12px; background:' + (completado ? '#d1fae5' : th.iconBg) + '; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 2px 6px rgba(0,0,0,0.05);">' +
                  (completado ? '&#x2705;' : r.icono) +
                '</div>' +
                '<div style="flex: 1;">' +
                  '<div style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap; margin-bottom: 4px;">' +
                    '<h4 style="font-size: 18px; font-weight: 900; color:' + (completado ? '#065f46' : '#0f172a') + '; margin: 0;">' + r.titulo + '</h4>' +
                    '<span style="font-size: 13px; font-weight: 800; background:' + (completado ? '#a7f3d0' : th.badgeBg) + '; color:' + (completado ? '#064e3b' : th.badgeColor) + '; padding: 3px 8px; border-radius: 6px;">' + r.duracion + '</span>' +
                  '</div>' +
                  '<p style="font-size: 15.5px; color:' + (completado ? '#047857' : '#475569') + '; margin: 0 0 6px; line-height: 1.45;">' + r.desc + '</p>' +
                  '<div style="font-size: 14.5px; font-weight: 800; color:' + (completado ? '#059669' : '#00703C') + ';">&#x1F4A1; Recompensa estimada: ' + r.ahorro + '</div>' +
                '</div>' +
              '</div>' +
              '<div>' +
                '<button type="button" onclick="toggleReto(\'' + r.id + '\')" style="padding: 10px 20px; border-radius: 24px; font-weight: 800; font-size: 15.5px; cursor: pointer; border: none; background:' + (completado ? '#10b981' : '#00703C') + '; color: #ffffff; box-shadow: 0 4px 12px rgba(0,0,0,0.12); transition: transform 0.15s ease;">' +
                  (completado ? '&#x2714; &iexcl;Logrado!' : 'Marcar Hecho') +
                '</button>' +
              '</div>';

            container.appendChild(card);
          });

          const pct = Math.round((cumplidos / LISTA_RETOS.length) * 100);
          const contadorEl = document.getElementById('contadorRetosTxt');
          const barraEl = document.getElementById('barraProgresoRetos');
          if (contadorEl) contadorEl.textContent = cumplidos + ' / ' + LISTA_RETOS.length;
          if (barraEl) barraEl.style.width = pct + '%';
        }

        function toggleReto(id) {
          estadosRetos[id] = !estadosRetos[id];
          localStorage.setItem(RETOS_STORAGE_KEY, JSON.stringify(estadosRetos));
          renderRetos();
        }

        // --- 4. LOGICA METODO BOLA DE NIEVE VIBRANTE ---
        let misDeudas = [
          { id: 1, nombre: 'Tienda Departamental (Ropa/Muebles)', saldo: 3500, minimo: 400, tasa: 42 },
          { id: 2, nombre: 'Tarjeta de Cr&eacute;dito Cl&aacute;sica', saldo: 12000, minimo: 900, tasa: 48 },
          { id: 3, nombre: 'Pr&eacute;stamo de N&oacute;mina', saldo: 28000, minimo: 1600, tasa: 28 }
        ];

        function renderTablaDeudas() {
          const tbody = document.getElementById('tablaDeudasBody');
          if (!tbody) return;
          tbody.innerHTML = '';

          misDeudas.sort((a, b) => a.saldo - b.saldo);

          const badgeStyles = [
            { bg: '#fee2e2', color: '#b91c1c', border: '#fca5a5', label: '&#x1F525; Paso 1: Pagar Primero' },
            { bg: '#fef3c7', color: '#b45309', border: '#fcd34d', label: '&#x23F3; Paso 2: Pagar M&iacute;nimo' },
            { bg: '#e0f2fe', color: '#0369a1', border: '#7dd3fc', label: '&#x1F6E1;&#xFE0F; Paso 3: Al Final' }
          ];

          misDeudas.forEach((d, idx) => {
            const b = badgeStyles[idx] || badgeStyles[2];
            const tr = document.createElement('tr');
            tr.style.borderBottom = '1px solid #f1f5f9';
            tr.style.background = idx === 0 ? '#fff1f2' : (idx === 1 ? '#fffbeb' : '#ffffff');

            tr.innerHTML = 
              '<td style="padding: 14px 16px;">' +
                '<span style="background:' + b.bg + '; color:' + b.color + '; border:1px solid ' + b.border + '; font-size:13.5px; font-weight:800; padding:4px 10px; border-radius:20px;">' + b.label + '</span>' +
              '</td>' +
              '<td style="padding: 14px 16px; font-weight: 800; color:#0f172a; font-size: 16px;">' + d.nombre + '</td>' +
              '<td style="padding: 14px 16px; font-weight: 900; color:#b91c1c; font-size: 17px;">$' + d.saldo.toLocaleString('es-MX') + ' MXN</td>' +
              '<td style="padding: 14px 16px; color:#475569; font-weight: 700;">$' + d.minimo.toLocaleString('es-MX') + ' / mes</td>' +
              '<td style="padding: 14px 16px; color:#64748b; font-weight: 600;">' + d.tasa + '% anual</td>' +
              '<td style="padding: 14px 16px; text-align:center;">' +
                '<button type="button" onclick="eliminarDeudaBola(' + d.id + ')" style="background:#fee2e2; border:none; color:#dc2626; width:28px; height:28px; border-radius:50%; font-size:18px; cursor:pointer; font-weight:800;" title="Eliminar">&times;</button>' +
              '</td>';
            tbody.appendChild(tr);
          });

          calcularBolaDeNieve();
        }

        function agregarDeudaBola(e) {
          e.preventDefault();
          const nombre = document.getElementById('nuevaDeudaNombre').value.trim();
          const saldo = parseFloat(document.getElementById('nuevaDeudaSaldo').value) || 0;
          const minimo = parseFloat(document.getElementById('nuevaDeudaMinimo').value) || 0;
          const tasa = parseFloat(document.getElementById('nuevaDeudaTasa').value) || 30;

          if (!nombre || saldo <= 0 || minimo <= 0) return;

          misDeudas.push({
            id: Date.now(),
            nombre: nombre,
            saldo: saldo,
            minimo: minimo,
            tasa: tasa
          });

          document.getElementById('formAgregarDeuda').reset();
          renderTablaDeudas();
        }

        function eliminarDeudaBola(id) {
          misDeudas = misDeudas.filter(d => d.id !== id);
          renderTablaDeudas();
        }

        function calcularBolaDeNieve() {
          const resContainer = document.getElementById('resultadoBolaContainer');
          if (!resContainer) return;

          if (misDeudas.length === 0) {
            resContainer.innerHTML = 
              '<div style="text-align:center; padding:30px; background:#f0fdf4; border-radius:16px; border:2px dashed #86efac;">' +
                '<div style="font-size:38.5px; margin-bottom:8px;">&#x1F389;</div>' +
                '<div style="font-size:20px; font-weight:900; color:#15803d;">&iexcl;Felicidades! No tienes compromisos pendientes.</div>' +
                '<p style="font-size:15.5px; color:#166534; margin:4px 0 0;">Todo tu dinero extra puede ir directo a tus metas de inversi&oacute;n y patrimonio.</p>' +
              '</div>';
            return;
          }

          const extra = parseFloat(document.getElementById('inputAporteExtraBola').value) || 0;
          const totalDeuda = misDeudas.reduce((acc, d) => acc + d.saldo, 0);
          const totalMinimos = misDeudas.reduce((acc, d) => acc + d.minimo, 0);
          const flujoTotal = totalMinimos + extra;

          const mesesEst = flujoTotal > 0 ? Math.ceil(totalDeuda / flujoTotal) : 1;
          const interesesAhorradosEst = Math.round(totalDeuda * 0.24);

          resContainer.innerHTML = 
            '<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(210px, 1fr)); gap: 14px; margin-bottom: 20px;">' +
              '<div style="background:#fff1f2; padding:18px; border-radius:14px; border:1.5px solid #fecdd3;">' +
                '<div style="font-size:13.5px; color:#9f1239; font-weight:800; text-transform:uppercase;">Deuda Consolidada</div>' +
                '<div style="font-size:26.5px; font-weight:900; color:#be123c; margin-top:4px;">$' + totalDeuda.toLocaleString('es-MX') + ' MXN</div>' +
              '</div>' +
              '<div style="background:#f0fdf4; padding:18px; border-radius:14px; border:1.5px solid #bbf7d0;">' +
                '<div style="font-size:13.5px; color:#166534; font-weight:800; text-transform:uppercase;">Flujo Mensual Anti-Deuda</div>' +
                '<div style="font-size:26.5px; font-weight:900; color:#15803d; margin-top:4px;">$' + flujoTotal.toLocaleString('es-MX') + ' MXN</div>' +
              '</div>' +
              '<div style="background:#f0f9ff; padding:18px; border-radius:14px; border:1.5px solid #bae6fd;">' +
                '<div style="font-size:13.5px; color:#0369a1; font-weight:800; text-transform:uppercase;">Meses para Ser Libre</div>' +
                '<div style="font-size:26.5px; font-weight:900; color:#0284c7; margin-top:4px;">' + mesesEst + ' mes(es)</div>' +
              '</div>' +
              '<div style="background:#fefce8; padding:18px; border-radius:14px; border:1.5px solid #fef08a;">' +
                '<div style="font-size:13.5px; color:#854d0e; font-weight:800; text-transform:uppercase;">Intereses que te Ahorras</div>' +
                '<div style="font-size:26.5px; font-weight:900; color:#ca8a04; margin-top:4px;">+$' + interesesAhorradosEst.toLocaleString('es-MX') + ' MXN</div>' +
              '</div>' +
            '</div>' +
            '<div style="background: linear-gradient(135deg, #053724 0%, #032518 100%); color:#ffffff; padding: 18px 22px; border-radius: 14px; display: flex; align-items: center; gap: 16px; box-shadow: 0 4px 16px rgba(5,55,36,0.15);">' +
              '<div style="font-size: 34.5px; flex-shrink: 0;">&#x1F3AF;</div>' +
              '<div>' +
                '<div style="font-size: 17px; font-weight: 900; color: #cbf63e; margin-bottom: 2px;">Plan de Ataque Inmediato:</div>' +
                '<p style="font-size: 15.5px; color: #d7f4e6; margin: 0; line-height: 1.45;">' +
                  'Destina <strong>$' + (misDeudas[0].minimo + extra).toLocaleString('es-MX') + ' MXN</strong> cada mes a liquidar <strong>' + misDeudas[0].nombre + '</strong> mientras pagas el m&iacute;nimo en las dem&aacute;s. Al terminarla, ese flujo completo pasa a la siguiente. &iexcl;Ver&aacute;s resultados antes de lo que crees!' +
                '</p>' +
              '</div>' +
            '</div>';
        }

        // --- INICIALIZAR TODO AL CARGAR EL DOM ---
        document.addEventListener('DOMContentLoaded', function() {
          cargarMetasIniciales();
          cargarRetos();
          renderTablaDeudas();
        });
      </script>
    </div>
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

  <!-- Modal de Retícula Académica -->
  <div class="modal-overlay" id="reticulaModal" role="dialog" aria-modal="true">
    <div class="modal-card modal-card-wide" style="text-align: left; max-width: 650px; max-height: 90vh; overflow-y: auto;">
      <button class="modal-close-btn" onclick="closeReticulaModal()" aria-label="Cerrar">×</button>
      <div style="display: flex; align-items: center; justify-content: space-between; gap: 10px; margin-bottom: 4px;">
        <span class="reticula-modal-level" id="reticulaModalLevel">Nivel 1</span>
      </div>
      <h3 id="reticulaModalTitle" style="margin: 6px 0 4px; font-size: 22.5px;">Materia</h3>
      <p id="reticulaModalDesc" style="color: var(--text-muted); font-size: 15.5px; line-height: 1.5; margin-bottom: 12px;">Descripción de la materia.</p>

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
        <h3 style="margin: 0; font-size: 20px;">Buscar en la plataforma</h3>
      </div>
      <input type="text" id="searchInput" placeholder="Buscar cursos, lecciones o herramientas..." 
             style="width: 100%; padding: 12px 16px; border: 1px solid #d4e7de; border-radius: 12px; font-family: inherit; font-size: 16px; margin-bottom: 16px; outline: none; box-sizing: border-box;">
      <div id="searchResults" style="font-size: 15px; color: var(--text-muted); line-height: 1.6;">
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
          <label style="font-size: 14px; font-weight: 600; color: var(--text-dark);">Correo electrónico</label>
          <input type="email" id="loginEmail" required placeholder="tu@correo.com" style="width: 100%; padding: 10px 14px; border: 1px solid #d4e7de; border-radius: 10px; font-family: inherit; font-size: 15px; margin-top: 4px; box-sizing: border-box;">
          <span id="loginEmailErr" style="display:none; color: #e11d48; font-size: 13px; margin-top: 2px;">Ingresa un correo electrónico válido.</span>
        </div>
        <div>
          <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 4px;">
            <label style="font-size: 14px; font-weight: 600; color: var(--text-dark);">Contraseña</label>
            <button type="button" onclick="openForgotModal()" style="background: none; border: none; font-size: 13.5px; color: #00ba6d; font-weight: 600; cursor: pointer; text-decoration: underline; padding: 0;">¿Olvidaste tu contraseña?</button>
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
          <span id="loginPasswordErr" style="display:none; color: #e11d48; font-size: 13px; margin-top: 2px;">Ingresa tu contraseña.</span>
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
          <label style="font-size: 14px; font-weight: 600; color: var(--text-dark);">Correo electrónico registrado</label>
          <input type="email" id="forgotEmail" required placeholder="tu@correo.com" style="width: 100%; padding: 10px 14px; border: 1px solid #d4e7de; border-radius: 10px; font-family: inherit; font-size: 15px; margin-top: 4px; box-sizing: border-box;">
          <span id="forgotEmailErr" style="display:none; color: #e11d48; font-size: 13px; margin-top: 2px;">Ingresa un correo electrónico válido.</span>
        </div>
        <div>
          <label style="font-size: 14px; font-weight: 600; color: var(--text-dark);">Nueva contraseña</label>
          <div class="password-field">
            <input type="password" id="forgotPassword" required minlength="6" placeholder="Mínimo 6 caracteres">
            <button type="button" class="btn-toggle-eye" onclick="togglePasswordVisibility('forgotPassword', this)" aria-label="Mostrar contraseña" title="Mostrar contraseña">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                <circle cx="12" cy="12" r="3"></circle>
              </svg>
            </button>
          </div>
          <span id="forgotPasswordErr" style="display:none; color: #e11d48; font-size: 13px; margin-top: 2px;">La contraseña debe tener al menos 6 caracteres.</span>
        </div>
        <div>
          <label style="font-size: 14px; font-weight: 600; color: var(--text-dark);">Confirmar nueva contraseña</label>
          <div class="password-field">
            <input type="password" id="forgotConfirm" required minlength="6" placeholder="Repite tu nueva contraseña">
            <button type="button" class="btn-toggle-eye" onclick="togglePasswordVisibility('forgotConfirm', this)" aria-label="Mostrar contraseña" title="Mostrar contraseña">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                <circle cx="12" cy="12" r="3"></circle>
              </svg>
            </button>
          </div>
          <span id="forgotConfirmErr" style="display:none; color: #e11d48; font-size: 13px; margin-top: 2px;">Las contraseñas no coinciden.</span>
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
          <label style="font-size: 14px; font-weight: 600; color: var(--text-dark);">Nombre completo</label>
          <input type="text" id="signupName" required placeholder="Tu nombre completo" style="width: 100%; padding: 10px 14px; border: 1px solid #d4e7de; border-radius: 10px; font-family: inherit; font-size: 15px; margin-top: 4px; box-sizing: border-box;">
          <span id="signupNameErr" style="display:none; color: #e11d48; font-size: 13px; margin-top: 2px;">Ingresa tu nombre completo.</span>
        </div>
        <div>
          <label style="font-size: 14px; font-weight: 600; color: var(--text-dark);">Correo electrónico</label>
          <input type="email" id="signupEmail" required placeholder="tu@correo.com" style="width: 100%; padding: 10px 14px; border: 1px solid #d4e7de; border-radius: 10px; font-family: inherit; font-size: 15px; margin-top: 4px; box-sizing: border-box;">
          <span id="signupEmailErr" style="display:none; color: #e11d48; font-size: 13px; margin-top: 2px;">Ingresa un correo electrónico válido.</span>
        </div>
        <div>
          <label style="font-size: 14px; font-weight: 600; color: var(--text-dark);">Contraseña</label>
          <div class="password-field">
            <input type="password" id="signupPassword" required minlength="6" placeholder="Mínimo 6 caracteres">
            <button type="button" class="btn-toggle-eye" onclick="togglePasswordVisibility('signupPassword', this)" aria-label="Mostrar contraseña" title="Mostrar contraseña">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                <circle cx="12" cy="12" r="3"></circle>
              </svg>
            </button>
          </div>
          <span id="signupPasswordErr" style="display:none; color: #e11d48; font-size: 13px; margin-top: 2px;">La contraseña debe tener al menos 6 caracteres.</span>
        </div>
        <div>
          <label style="font-size: 14px; font-weight: 600; color: var(--text-dark);">Confirmar contraseña</label>
          <div class="password-field">
            <input type="password" id="signupConfirm" required minlength="6" placeholder="Repite tu contraseña">
            <button type="button" class="btn-toggle-eye" onclick="togglePasswordVisibility('signupConfirm', this)" aria-label="Mostrar contraseña" title="Mostrar contraseña">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                <circle cx="12" cy="12" r="3"></circle>
              </svg>
            </button>
          </div>
          <span id="signupConfirmErr" style="display:none; color: #e11d48; font-size: 13px; margin-top: 2px;">Las contraseñas no coinciden.</span>
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


  <script src="public/js/script.js?v=<?= time() ?>"></script>

  <!-- ============================================================
       MODAL REPRODUCTOR DE VIDEO
       ============================================================ -->
  <div class="modal-overlay" id="videoPlayerModal" role="dialog" aria-modal="true">
    <div class="modal-card" style="text-align: left; max-width: 720px; padding: 24px; width: 95%;">
      <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px;">
        <div style="display: flex; align-items: center; gap: 8px;">
          <span style="font-size: 22.5px;">🎬</span>
          <h3 id="videoPlayerTitle" style="font-size: 19px; margin: 0; color: var(--text-dark); font-weight: 700;">Video Clase</h3>
        </div>
        <button class="modal-close-btn" onclick="closeVideoPlayerModal()" style="position: static;" aria-label="Cerrar reproductor">×</button>
      </div>
      <div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; border-radius: 14px; background: #000; margin-bottom: 16px; box-shadow: 0 10px 25px rgba(0,0,0,0.2);">
        <iframe id="videoPlayerIframe" style="position: absolute; top:0; left:0; width:100%; height:100%; border:0;" src="" title="Reproductor de Video" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
      <div style="display: flex; justify-content: space-between; align-items: center; gap: 10px; flex-wrap: wrap;">
        <span style="font-size: 14.5px; color: var(--text-muted);">✅ Clase interactiva de Educación Financiera</span>
        <button class="btn-cta-yellow" onclick="closeVideoPlayerModal()" style="padding: 8px 18px; font-size: 15px;">Terminar de ver</button>
      </div>
    </div>
  </div>

  <!-- ============================================================
       MODAL REALIZADOR DE EJERCICIOS INTERACTIVOS
       ============================================================ -->
  <div class="modal-overlay" id="exercisePlayerModal" role="dialog" aria-modal="true">
    <div class="modal-card" style="text-align: left; max-width: 580px; padding: 24px; width: 95%;">
      <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
        <span style="font-size: 13px; font-weight: 800; background: #e0e7ff; color: #4338ca; padding: 3px 10px; border-radius: 999px;" id="exerciseModalType">ACTIVIDAD PRÁCTICA</span>
        <button class="modal-close-btn" onclick="closeExercisePlayerModal()" style="position: static;" aria-label="Cerrar ejercicio">×</button>
      </div>
      <h3 id="exerciseModalTitle" style="font-size: 20px; margin: 0 0 8px; color: var(--text-dark); font-weight: 800;">Título del ejercicio</h3>
      <p id="exerciseModalDesc" style="font-size: 15.5px; color: var(--text-muted); line-height: 1.5; margin-bottom: 16px;">Descripción del ejercicio.</p>
      
      <div id="exerciseModalOptions" style="display: flex; flex-direction: column; gap: 8px; margin-bottom: 16px;">
        <!-- Se llena dinámicamente con JS -->
      </div>

      <div id="exerciseModalFeedback" style="display: none; padding: 12px 14px; border-radius: 10px; margin-bottom: 16px; font-size: 15px; line-height: 1.4;"></div>

      <div style="display: flex; justify-content: space-between; align-items: center; gap: 10px; flex-wrap: wrap;">
        <button type="button" class="btn-cta-yellow" onclick="comprobarEjercicioModal()" style="padding: 10px 22px; font-size: 15px;">Comprobar mi respuesta</button>
        <button type="button" class="btn-cta-outline" onclick="closeExercisePlayerModal()" style="padding: 9px 18px; font-size: 15px; color: var(--text-dark); border-color: #d4e7de;">Cerrar</button>
      </div>
    </div>
  </div>


  <!-- MODAL: REPRODUCTOR DE VIDEO REAL -->
  <div class="modal-overlay" id="videoPlayerModal" role="dialog" aria-modal="true">
    <div class="modal-card" style="text-align: left; max-width: 760px; padding: 22px; width: 95%;">
      <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px; border-bottom: 1px solid #e2e8f0; padding-bottom: 10px;">
        <h4 id="videoPlayerTitle" style="margin: 0; font-size: 19px; color: var(--gris-oscuro); display: flex; align-items: center; gap: 8px;">
          <span>🎥</span> <span>Clase en Video</span>
        </h4>
        <button class="modal-close-btn" onclick="closeVideoPlayerModal()" style="position: static;" aria-label="Cerrar reproductor">✕</button>
      </div>
      <div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; border-radius: 12px; background: #000; box-shadow: 0 8px 24px rgba(0,0,0,0.18);">
        <iframe id="videoPlayerIframe" style="position: absolute; top:0; left:0; width:100%; height:100%; border:0;" src="" title="Reproductor de Video" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
      <div style="margin-top: 12px; display: flex; justify-content: flex-end;">
        <button type="button" class="btn-cta-yellow" onclick="closeVideoPlayerModal()" style="padding: 8px 18px; font-size: 15.5px;">Cerrar Video</button>
      </div>
    </div>
  </div>

  <!-- MODAL: REPRODUCTOR DE AUDIO / PODCAST -->
  <div class="modal-overlay" id="audioPlayerModal" role="dialog" aria-modal="true">
    <div class="modal-card" style="text-align: left; max-width: 580px; padding: 24px; width: 95%; background: #ffffff;">
      <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
        <span style="font-size: 13px; font-weight: 700; text-transform: uppercase; background: #e0f2fe; color: #0369a1; padding: 4px 10px; border-radius: 999px;">
          🎧 PODCAST & AUDIO-LECCIÓN OFICIAL
        </span>
        <button class="modal-close-btn" onclick="closeAudioPlayerModal()" style="position: static;" aria-label="Cerrar audio">✕</button>
      </div>

      <div style="background: linear-gradient(135deg, #053724 0%, #06402d 100%); color: #ffffff; padding: 22px; border-radius: 14px; margin-bottom: 18px;">
        <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 14px;">
          <div style="width: 54px; height: 54px; border-radius: 14px; background: var(--amarillo-dorado); display: grid; place-items: center; font-size: 28.5px; color: #06402d; flex-shrink: 0;">
            🎙️
          </div>
          <div>
            <h4 id="audioModalTitle" style="font-size: 19px; margin: 0 0 4px; font-weight: 700; color: #ffffff;">Título del Audio</h4>
            <div id="audioModalDuration" style="font-size: 14.5px; opacity: 0.85;">Duración: 18 min</div>
          </div>
        </div>

        <p id="audioModalDesc" style="font-size: 15px; opacity: 0.9; line-height: 1.5; margin-bottom: 16px;">
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
        <div style="display: flex; justify-content: space-between; font-size: 13px; opacity: 0.8;">
          <span id="audioModalCurrentTime">00:00</span>
          <span>Reproducción continua en HD</span>
        </div>
      </div>

      <div style="display: flex; gap: 12px; justify-content: space-between; align-items: center;">
        <button type="button" id="btnPlayAudioModal" onclick="toggleAudioPlayback()" class="btn-cta-yellow" style="flex: 1; padding: 12px; font-weight: 700; font-size: 16px; display: flex; align-items: center; justify-content: center; gap: 8px;">
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
        <span style="font-size: 13px; font-weight: 700; text-transform: uppercase; background: #fef08a; color: #854d0e; padding: 4px 10px; border-radius: 999px;">
          📚 LECTURA & GUÍA OFICIAL
        </span>
        <button class="modal-close-btn" onclick="closeBookReaderModal()" style="position: static;" aria-label="Cerrar libro">✕</button>
      </div>

      <div style="display: flex; gap: 16px; margin-bottom: 16px; align-items: flex-start;">
        <div style="width: 58px; height: 76px; background: linear-gradient(135deg, #00703C, #06402d); border-radius: 8px; display: grid; place-items: center; font-size: 34.5px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); flex-shrink: 0; color: #ffffff;">
          📖
        </div>
        <div>
          <h3 id="bookModalTitle" style="font-size: 20px; margin: 0 0 4px; font-weight: 700; color: var(--gris-oscuro);">Título del Libro</h3>
          <div id="bookModalAuthor" style="font-size: 15.5px; color: var(--verde-bosque); font-weight: 600; margin-bottom: 6px;">Por Autor</div>
          <p id="bookModalDesc" style="font-size: 15px; color: var(--gris-medio); line-height: 1.45; margin: 0;">Descripción oficial del material formativo.</p>
        </div>
      </div>

      <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 16px; margin-bottom: 18px;">
        <h5 style="font-size: 16px; font-weight: 700; color: var(--verde-principal); margin: 0 0 10px; display: flex; align-items: center; gap: 6px;">
          <span>💡</span> <span>5 Principios y Lecciones de este libro:</span>
        </h5>
        <ul id="bookModalLessons" style="margin: 0; padding-left: 20px; font-size: 15px; color: #334155; line-height: 1.6;">
          <li><strong>Principio 1:</strong> La diferencia entre ingresos activos y generación de flujo pasivo.</li>
          <li><strong>Principio 2:</strong> Auditar y proteger el 20% de cada peso que ganas.</li>
          <li><strong>Principio 3:</strong> El costo oculto de la deuda y cómo eliminar intereses abusivos.</li>
          <li><strong>Principio 4:</strong> Inversión recurrente automatizada para aprovechar el interés compuesto.</li>
          <li><strong>Principio 5:</strong> Definir tu fecha y número exacto de libertad financiera.</li>
        </ul>
      </div>

      <div style="display: flex; gap: 12px; justify-content: flex-end; align-items: center;">
        <button type="button" onclick="descargarGuiaPdfActual()" class="btn-cta-yellow" style="padding: 10px 18px; font-size: 15.5px; display: flex; align-items: center; gap: 8px;">
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
        <span style="font-size: 13px; font-weight: 700; text-transform: uppercase; background: #e0e7ff; color: #4338ca; padding: 4px 10px; border-radius: 999px;">
          📝 ACTIVIDAD PRÁCTICA DEL MÓDULO
        </span>
        <button class="modal-close-btn" onclick="closeExercisePlayerModal()" style="position: static;" aria-label="Cerrar ejercicio">✕</button>
      </div>
      <h3 id="exerciseModalTitle" style="font-size: 19px; margin: 0 0 6px; font-weight: 700; color: var(--gris-oscuro);">Título del Ejercicio</h3>
      <p id="exerciseModalDesc" style="color: var(--gris-medio); font-size: 15.5px; line-height: 1.5; margin-bottom: 16px;">Instrucciones para resolver el ejercicio.</p>

      <div id="exerciseModalOptions" style="display: flex; flex-direction: column; gap: 8px; margin-bottom: 16px;"></div>

      <div id="exerciseModalFeedback" style="display: none; padding: 12px 14px; border-radius: 10px; font-size: 15.5px; margin-bottom: 16px; line-height: 1.5;"></div>

      <div style="display: flex; justify-content: space-between; align-items: center; gap: 12px;">
        <button type="button" class="btn-cta-yellow" onclick="comprobarEjercicioModal()" style="padding: 10px 20px; font-size: 16px; font-weight: 700;">
          Comprobar respuesta
        </button>
        <button type="button" onclick="closeExercisePlayerModal()" style="background: #f1f5f9; color: var(--gris-oscuro); border: 1px solid #cbd5e1; padding: 10px 18px; border-radius: 10px; font-weight: 600; cursor: pointer;">
          Cerrar
        </button>
      </div>
    </div>
  </div>
