<?php
/**
 * Vista: Aula Virtual
 * Contenido migrado desde aula-demo.html (legacy/html).
 * Variables: $pageTitle, $pageCss, $bodyClass, $user
 */
?>
<!-- ============================================================
     SIDEBAR LATERAL IZQUIERDA (MENÚ PRINCIPAL)
     ============================================================ -->
  <aside class="sidebar-left" id="sidebarLeft">
    <div>
      <div class="sidebar-brand">
        <a href="index.php" class="brand-logo" style="text-decoration: none; color: inherit; display: flex; align-items: center; gap: 10px;">
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
            <div style="font-weight: 800; font-size: 18px; line-height: 1.1; color: #ffffff;">Educación</div>
            <div style="font-weight: 500; font-size: 14px; color: var(--accent-lime, #cbf63e);">Financiera</div>
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
        <a href="index.php?page=aula" class="sidebar-link active">
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

  <!-- Barra superior del estudiante -->
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
        <div class="page-current-title">Aula Virtual Demo</div>
      </div>
    </div>
    <div class="logged-topbar-right">
      <span class="topbar-greeting">Hola, <strong id="topbarUserName">Estudiante</strong></span>
      <a href="index.php?page=suscripcion" class="btn-cta-upgrade" style="padding: 6px 14px; font-size: 15px; font-weight: 700; background: var(--amarillo-dorado); color: #06402d; border-radius: 8px; text-decoration: none;">Membresía Completa</a>
    </div>
  </div>


  <!-- HEADER INDIVIDUAL DEL AULA -->
  <header class="site-header">
    <div class="container nav-wrap">
      <a href="index.php" class="brand-logo">
        <svg viewBox="0 0 240 210" width="32" height="28" role="img" aria-label="Logo Sombrero de Graduación con Libros">
          <g>
            <rect x="26" y="162" width="188" height="30" rx="8" fill="#F5B800"/>
            <rect x="34" y="168" width="172" height="18" rx="4" fill="#fff6dd"/>
            <rect x="42" y="128" width="156" height="30" rx="8" fill="#28C76F" transform="rotate(-2 120 143)"/>
            <rect x="58" y="94" width="124" height="30" rx="8" fill="#ffffff" transform="rotate(2 120 109)"/>
          </g>
          <g>
            <path d="M88,66 L88,90 C88,106 152,106 152,90 L152,66 L120,82 Z" fill="#032d1f"/>
            <path d="M120,14 L216,58 L120,102 L24,58 Z" fill="#ffffff"/>
            <circle cx="120" cy="58" r="7" fill="#F5B800"/>
          </g>
        </svg>
        <span>Educación <strong>Financiera</strong> | Aula Virtual</span>
      </a>

      <div class="nav-actions">
        <div class="demo-pill-badge">
          <span>⚡ Modo Demo Activo</span>
        </div>
        <a href="index.php?page=suscripcion" class="btn-upgrade-nav">Membresía Completa</a>
      </div>
    </div>
  </header>

  <!-- BARRITA DE ESTADO DE AVANCE -->
  <aside class="demo-progress-bar-strip">
    <div class="container progress-strip-inner">
      <div class="progress-strip-info">
        <span>📖 Estudiando: <strong>Unidad 1 — Psicología del dinero y cambio de hábitos</strong></span>
        <span>•</span>
        <span id="stripStatus">3 lecciones libres para ver ahora</span>
      </div>
      <div>
        <a href="index.php#testimonios" style="color: var(--verde-principal); font-weight: 600; font-size: 14.5px;">
          Ver historias de éxito y testimonios →
        </a>
      </div>
    </div>
  </aside>

  <!-- CONTENIDO PRINCIPAL DEL AULA -->
  <main class="classroom-main">
    <div class="container">
      <div class="curriculum-layout">

        <!-- COLUMNA IZQUIERDA: MENÚ COMPLETO -->
        <div class="course-menu-card">
          <div class="menu-card-header">
            <h3>
              <span>Plan de Aprendizaje</span>
              <span class="status-tag" id="menuStatusTag">3 Temas Abiertos</span>
            </h3>
          </div>

          <!-- UNIDAD 1 -->
          <div class="unit-accordion">
            <div class="unit-title-bar unit-active" onclick="toggleUnit('unit1')">
              <span>📖 Unidad 1: Psicología del dinero</span>
              <span class="unit-badge badge-open" id="unit1Badge">Liberada</span>
            </div>
            <ul class="lesson-list" id="unit1List">
              <li class="lesson-item active" id="itemLesson1" onclick="selectLesson(1)">
                <div class="lesson-info"><span class="lesson-icon">▶</span><span>1. La psicología del dinero (Housel)</span></div>
                <span class="lesson-status" style="color: var(--verde-claro);">Gratis</span>
              </li>
              <li class="lesson-item" id="itemLesson2" onclick="selectLesson(2)">
                <div class="lesson-info">
                  <span class="lesson-icon">▶</span>
                  <span>2. Fugas y micro-gastos hormiga</span>
                  <a href="https://youtu.be/DT6Nh3aV5Vc?si=7Goupsx4H4p_JuUP" target="_blank" rel="noopener noreferrer" onclick="event.stopPropagation();" title="Ver video explicativo en YouTube (abrir en otra pestaña)" style="display:inline-flex; align-items:center; gap:2px; font-size:11px; color:#dc2626; background:#fee2e2; padding:1px 6px; border-radius:4px; margin-left:6px; font-weight:700; text-decoration:none;">
                    <span>Video</span> ↗
                  </a>
                </div>
                <span class="lesson-status" style="color: var(--verde-claro);">Gratis</span>
              </li>
              <li class="lesson-item" id="itemLesson3" onclick="selectLesson(3)">
                <div class="lesson-info"><span class="lesson-icon">▶</span><span>3. Hábitos atómicos: identidad > motivación (Clear)</span></div>
                <span class="lesson-status" style="color: var(--verde-claro);">Gratis</span>
              </li>
              <li class="lesson-item" id="itemLesson4" onclick="selectLesson(4)">
                <div class="lesson-info">
                  <span class="lesson-icon">▶</span>
                  <span>4. No pidas préstamos: el método anti-deuda (Ramsey)</span>
                  <a href="https://youtu.be/SkHPWkxzE7o?si=AA9chSyG1lcZaSrY" target="_blank" rel="noopener noreferrer" onclick="event.stopPropagation();" title="Ver video explicativo en YouTube (abrir en otra pestaña)" style="display:inline-flex; align-items:center; gap:2px; font-size:11px; color:#dc2626; background:#fee2e2; padding:1px 6px; border-radius:4px; margin-left:6px; font-weight:700; text-decoration:none;">
                    <span>Video</span> ↗
                  </a>
                </div>
                <span class="lesson-status" style="color: var(--verde-claro);">Liberada</span>
              </li>
            </ul>
          </div>

          <!-- UNIDAD 2 -->
          <div class="unit-accordion">
            <div class="unit-title-bar" onclick="toggleUnit('unit2')">
              <span>💸 Unidad 2: Aprende a gastar</span>
              <span class="unit-badge badge-open" style="background:#e0f2fe; color:#0369a1;">Liberada</span>
            </div>
            <ul class="lesson-list" id="unit2List">
              <li class="lesson-item" id="itemLesson5" onclick="selectLesson(5)">
                <div class="lesson-info">
                  <span class="lesson-icon">▶</span>
                  <span>5. Págate primero y colchón de emergencia (Clason)</span>
                  <a href="https://youtu.be/vp_B6Z7eF68?si=S854mK2puo4_ystd" target="_blank" rel="noopener noreferrer" onclick="event.stopPropagation();" title="Ver video explicativo en YouTube (abrir en otra pestaña)" style="display:inline-flex; align-items:center; gap:2px; font-size:11px; color:#dc2626; background:#fee2e2; padding:1px 6px; border-radius:4px; margin-left:6px; font-weight:700; text-decoration:none;">
                    <span>Video</span> ↗
                  </a>
                </div>
                <span class="lesson-status" style="color: var(--verde-claro);">Gratis</span>
              </li>
              <li class="lesson-item" id="itemLesson6" onclick="selectLesson(6)">
                <div class="lesson-info"><span class="lesson-icon">▶</span><span>6. Presupuesto base cero y no gastar de más (Ramsey)</span></div>
                <span class="lesson-status" style="color: var(--verde-claro);">Gratis</span>
              </li>
            </ul>
          </div>

          <!-- UNIDAD 3 -->
          <div class="unit-accordion">
            <div class="unit-title-bar" onclick="toggleUnit('unit3')">
              <span>🔥 Unidad 3: No pidas préstamos</span>
              <span class="unit-badge badge-open" style="background:#fef08a; color:#854d0e;">Liberada</span>
            </div>
            <ul class="lesson-list" id="unit3List">
              <li class="lesson-item" id="itemLesson7" onclick="selectLesson(7)">
                <div class="lesson-info"><span class="lesson-icon">▶</span><span>7. Aprende a ahorrar: de CETES al interés compuesto</span></div>
                <span class="lesson-status" style="color: var(--verde-claro);">Gratis</span>
              </li>
              <li class="lesson-item" id="itemLesson8" onclick="selectLesson(8)">
                <div class="lesson-info"><span class="lesson-icon">▶</span><span>8. Tu libertad financiera con hábitos sólidos</span></div>
                <span class="lesson-status" style="color: var(--verde-claro);">Gratis</span>
              </li>
            </ul>
          </div>

        </div>

        <!-- COLUMNA DERECHA: REPRODUCTOR DE LA LECCIÓN -->
        <div class="lesson-player-card">
          
          <div class="lesson-player-header">
            <span class="lesson-meta-tag" id="lessonTag">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polygon points="10 8 16 12 10 16 10 8"/></svg>
              <span id="lessonTagText">Lección 1 de 3 (Demo Gratuita)</span>
            </span>
            <span style="font-size: 15px; color: var(--gris-medio);" id="lessonDuration">Duración: 12 min</span>
          </div>

          <h3 class="lesson-title" id="playerTitle">1. Diagnóstico de tu dinero: ¿A dónde se va lo que ganas?</h3>

          <!-- TABS DE RECURSOS DE LA LECCIÓN -->
          <div class="lesson-content-tabs">
            <button type="button" class="lesson-tab-btn active" id="btnTabVideo" onclick="switchLessonTab('video')">
              🎥 Video Clase
            </button>
            <button type="button" class="lesson-tab-btn" id="btnTabEjercicio" onclick="switchLessonTab('ejercicio')">
              📝 Ejercicio Práctico
            </button>
            <button type="button" class="lesson-tab-btn" id="btnTabAudio" onclick="switchLessonTab('audio')">
              🎧 Audio / Podcast
            </button>
            <button type="button" class="lesson-tab-btn" id="btnTabLibro" onclick="switchLessonTab('libro')">
              📚 Lectura / Libro
            </button>
            <button type="button" class="lesson-tab-btn" id="btnTabTexto" onclick="switchLessonTab('texto')">
              📄 Resumen Teórico
            </button>
          </div>

          <!-- PANE: VIDEO REAL CON CUESTIONARIO INTERACTIVO EN TIEMPO REAL -->
          <div class="lesson-tab-pane active" id="paneVideo" style="display: block;">
            <div class="video-player-wrapper" id="videoWrapper">
              <iframe id="lessonVideoIframe" src="https://www.youtube.com/embed/WF6qLnuh4EA?enablejsapi=1&rel=0&modestbranding=1" title="Video de la Lección" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
              
              <!-- OVERLAY DEL CUESTIONARIO SOBRE EL VIDEO -->
              <div class="vquiz-overlay" id="videoQuizOverlay" aria-modal="true" role="dialog">
                <div class="vquiz-card">
                  <div class="vquiz-header">
                    <span class="vquiz-badge-time" id="vquizTimeBadge">⏱️ Minuto 0:30</span>
                    <span class="vquiz-badge-step" id="vquizStepBadge">Pregunta 1 de 3</span>
                  </div>
                  <h4 class="vquiz-question-title" id="vquizTitle">Pregunta de comprensión</h4>
                  <p class="vquiz-question-desc" id="vquizDesc">El video se ha pausado para validar tu comprensión antes de continuar.</p>
                  
                  <div class="vquiz-options-list" id="vquizOptionsContainer"></div>

                  <div class="vquiz-feedback" id="vquizFeedback"></div>

                  <div class="vquiz-actions">
                    <div style="display: flex; gap: 8px; align-items: center; flex-wrap: wrap;">
                      <button type="button" class="vquiz-btn-submit" id="vquizBtnSubmit" onclick="checkVideoQuestion()">
                        ✓ Comprobar respuesta
                      </button>
                      <button type="button" class="vquiz-btn-continue" id="vquizBtnContinue" onclick="resumeVideoAfterQuiz()">
                        ▶ Continuar clase
                      </button>
                      <button type="button" class="vquiz-btn-rewind" id="vquizBtnRewind" onclick="rewindVideoSegment()">
                        ⏪ Repasar (-15s)
                      </button>
                    </div>
                    <button type="button" class="vquiz-btn-skip" onclick="skipVideoQuestion()" title="Continuar el video sin responder">
                      Saltar por ahora →
                    </button>
                  </div>
                </div>
              </div>
            </div>

            
            <!-- ENLACE EXTERNO PARA VER EN YOUTUBE EN OTRA PESTAÑA -->
            <div class="video-ext-bar" id="videoExtBar" style="display: flex; justify-content: space-between; align-items: center; margin: 10px 0 14px; padding: 10px 14px; background: #ffffff; border: 1px solid #e2e8f0; border-radius: 10px; box-shadow: 0 1px 3px rgba(0,0,0,0.04); flex-wrap: wrap; gap: 8px;">
              <div style="display: flex; align-items: center; gap: 8px;">
                <span style="display: inline-flex; align-items: center; justify-content: center; width: 26px; height: 26px; background: #fee2e2; border-radius: 50%; color: #dc2626; font-size: 13px;">▶</span>
                <span style="font-size: 13px; color: #475569; font-weight: 500;" id="videoExtBarText">¿Prefieres ver el video explicativo directamente en YouTube?</span>
              </div>
              <a id="btnExternalVideo" href="https://youtu.be/SkHPWkxzE7o?si=AA9chSyG1lcZaSrY" target="_blank" rel="noopener noreferrer" style="display: inline-flex; align-items: center; gap: 6px; background: #dc2626; color: #ffffff; text-decoration: none; padding: 7px 14px; border-radius: 8px; font-size: 12.5px; font-weight: 700; transition: all 0.2s ease;">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                <span>Ver en YouTube (otra pestaña) ↗</span>
              </a>
            </div>

            <!-- BARRA DE PUNTOS DE CONTROL DEL VIDEO -->
            <div class="vquiz-bar-card">
              <div class="vquiz-bar-header">
                <div class="vquiz-bar-title">
                  <span>🎯 Cuestionario en video:</span>
                  <span style="font-weight: 500; font-size: 14px; color: #64748b;">Preguntas de comprensión durante la transmisión</span>
                </div>
                <div class="vquiz-bar-controls">
                  <label class="vquiz-toggle-label" title="Pausar automáticamente el video al llegar a cada punto de control">
                    <input type="checkbox" id="vquizAutoPauseToggle" checked onchange="toggleAutoPause(this.checked)" style="accent-color: var(--verde-principal, #00703c);">
                    <span>Pausa automática</span>
                  </label>
                  <span class="vquiz-score-pill" id="vquizScorePill">
                    ⭐ <span id="vquizScoreText">0/3 superadas</span>
                  </span>
                </div>
              </div>

              <!-- Puntos de control (Chips clickeables) -->
              <div class="vquiz-chips-container" id="vquizChipsContainer">
                <!-- Inyectado dinámicamente con JavaScript -->
              </div>
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center; background: #f7fbf9; border: 1px solid #dff0e8; border-radius: 10px; padding: 10px 14px; font-size: 15px;">
              <span>💡 <strong>Evaluación en tiempo real:</strong> Cada pregunta responde a la sección recién explicada para maximizar tu retención.</span>
              <button type="button" onclick="switchLessonTab('ejercicio')" style="background: var(--verde-claro); color: white; border: none; padding: 6px 14px; border-radius: 6px; font-weight: 700; cursor: pointer;">Resolver ejercicio práctico →</button>
            </div>
          </div>

          <!-- PANE: EJERCICIO PRÁCTICO -->
          <div class="lesson-tab-pane" id="paneEjercicio" style="display: none;">
            <div class="exercise-box">
              <span style="display: inline-block; background: #e0e7ff; color: #4338ca; font-size: 13px; font-weight: 700; padding: 3px 10px; border-radius: 999px; margin-bottom: 10px;" id="exerciseTag">ACTIVIDAD PRÁCTICA INTERACTIVA</span>
              <h4 style="font-size: 18px; font-weight: 700; color: var(--gris-oscuro); margin-bottom: 8px;" id="exerciseTitle">Ejercicio interactivo</h4>
              <p style="font-size: 15.5px; color: var(--gris-medio); line-height: 1.5; margin-bottom: 16px;" id="exerciseDesc">Responde la siguiente pregunta para validar tu comprensión y ganar puntos de progreso:</p>
              
              <div id="exerciseOptionsContainer"></div>

              <div id="exerciseFeedback" style="display: none; padding: 12px 14px; border-radius: 8px; margin-top: 14px; font-size: 15px;"></div>

              <button type="button" id="btnSubmitExercise" onclick="checkExercise()" style="margin-top: 14px; background: var(--verde-principal); color: white; border: none; padding: 10px 20px; border-radius: 8px; font-weight: 700; cursor: pointer;">
                Comprobar mi respuesta
              </button>
            </div>
          </div>

          <!-- PANE: AUDIO PODCAST -->
          <div class="lesson-tab-pane" id="paneAudio" style="display: none;">
            <div class="audio-player-box">
              <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 14px;">
                <div style="width: 44px; height: 44px; border-radius: 50%; background: var(--amarillo-dorado); display: grid; place-items: center; font-size: 22.5px; color: #06402d;">🎧</div>
                <div>
                  <h4 style="font-size: 18px; margin: 0; font-weight: 700;" id="audioTitle">Episodio de Audio</h4>
                  <span style="font-size: 14px; opacity: 0.8;" id="audioDuration">Duración: 18 min</span>
                </div>
              </div>
              <p style="font-size: 15px; opacity: 0.9; line-height: 1.5; margin-bottom: 16px;" id="audioDesc">
                Escucha este episodio especial mientras manejas, haces ejercicio o descansas.
              </p>
              <div style="background: rgba(255,255,255,0.12); padding: 12px 16px; border-radius: 10px; display: flex; align-items: center; justify-content: space-between;">
                <button type="button" onclick="togglePlayAudioDemo(this)" style="background: var(--verde-claro); color: white; border: none; padding: 8px 18px; border-radius: 999px; font-weight: 700; cursor: pointer; display: flex; align-items: center; gap: 6px;">
                  ▶ Reproducir episodio
                </button>
                <span style="font-size: 14px; opacity: 0.85;">🔊 Audio HD Disponible</span>
              </div>
            </div>
          </div>

          <!-- PANE: LECTURA Y LIBRO -->
          <div class="lesson-tab-pane" id="paneLibro" style="display: none;">
            <div class="book-download-card">
              <div style="display: flex; align-items: flex-start; gap: 14px;">
                <div style="font-size: 40.5px;">📖</div>
                <div>
                  <span style="font-size: 11.5px; font-weight: 700; background: #fef08a; color: #854d0e; padding: 2px 8px; border-radius: 999px;">GUÍA OFICIAL RECOMENDADA</span>
                  <h4 style="font-size: 18px; font-weight: 700; color: var(--gris-oscuro); margin: 6px 0 4px;" id="bookTitle">Libro Recomendado</h4>
                  <p style="font-size: 14.5px; color: var(--gris-medio); margin: 0 0 6px;" id="bookAuthor">Autor</p>
                  <p style="font-size: 15px; color: var(--gris-oscuro); margin: 0;" id="bookDesc">Descripción del material</p>
                </div>
              </div>
              <button type="button" onclick="downloadBookDemo()" style="background: var(--verde-principal); color: white; border: none; padding: 10px 18px; border-radius: 8px; font-weight: 700; cursor: pointer; white-space: nowrap; flex-shrink: 0;">
                📥 Descargar PDF
              </button>
            </div>
          </div>

          <!-- PANE: TEXTO DE LA LECCIÓN -->
          <div class="lesson-tab-pane" id="paneTexto" style="display: none;">
            <div class="lesson-body" id="playerBody">
              <!-- Se llena dinámicamente -->
            </div>
          </div>

          <!-- GATE DE REGISTRO EN LECCIÓN 4 -->
          <div class="gate-callout" id="registrationGate" style="display: none;">
            <div style="font-size: 34.5px; margin-bottom: 8px;">🎁</div>
            <h4>¿Te gustó lo que aprendiste en estos 3 temas?</h4>
            <p>
              <strong>¡Inscríbete gratis!</strong> Crea tu cuenta en 10 segundos y desbloquea de inmediato <strong>tu primer mes del Nivel 1 (Básico)</strong> de la carrera de 18 meses, sin ningún costo ni tarjeta de crédito.
            </p>
            <button class="btn-unlock-unit" onclick="openFreeRegisterModal()">
              🔓 Inscribirme Gratis y Liberar Nivel 1
            </button>
          </div>

          <!-- NAVEGACIÓN ENTRE LECCIONES -->
          <div class="lesson-nav-actions" id="playerNavActions">
            <button class="btn-step-prev" id="btnPrevLesson" onclick="stepLesson(-1)" disabled style="opacity: 0.5;">
              ← Lección anterior
            </button>
            <button class="btn-step-next" id="btnNextLesson" onclick="stepLesson(1)">
              <span>Siguiente lección</span>
              <span>→</span>
            </button>
          </div>

          <!-- BANNER OPCIONAL PARA CUANDO SE LIBERA UNIDAD 1 -->
          <div class="finish-unit-banner" id="finishUnitBanner" style="display: none;">
            <div>
              <h4>¿Listo para dominar las Unidades 2 y 3?</h4>
              <p>Continúa tu transformación financiera con la membresía mensual completa.</p>
            </div>
            <a href="index.php?page=suscripcion" class="btn-goto-sub">
              Ver Membresía y Pagos (SPEI / Tarjeta) →
            </a>
          </div>

        </div>

      </div>
    </div>
  </main>

  <!-- MODAL: REGISTRO GRATIS (DESBLOQUEA UNIDAD 1 COMPLETA) -->
  <div class="modal-backdrop" id="freeRegisterModal" role="dialog" aria-modal="true">
    <div class="modal-panel">
      <button class="modal-close" onclick="closeFreeRegisterModal()">✕</button>
      <div style="font-size: 34.5px; margin-bottom: 8px;">🎓</div>
      <h3>Libera la Unidad 1 Completa</h3>
      <p>Crea tu acceso gratuito para desbloquear las 4 lecciones y guardar tu avance.</p>

      <form onsubmit="handleFreeRegister(event)">
        <div class="modal-form-group">
          <label>Nombre completo</label>
          <input type="text" id="regName" placeholder="Tu nombre" required>
        </div>
        <div class="modal-form-group">
          <label>Correo electrónico</label>
          <input type="email" id="regEmail" placeholder="tucorreo@ejemplo.com" required>
        </div>
        <div class="modal-form-group">
          <label>Crea una contraseña</label>
          <input type="password" id="regPass" placeholder="Mínimo 6 caracteres" required>
        </div>
        <button type="submit" class="btn-submit-modal">
          ✅ Activar Acceso Gratuito Inmediato
        </button>
      </form>
    </div>
  </div>

  <footer class="site-footer">
    <div class="container">
      <p><strong>Educación Financiera</strong> — Aula Virtual de Aprendizaje.</p>
    </div>
  </footer>

  <!-- YouTube IFrame Player API -->
  <script src="https://www.youtube.com/iframe_api"></script>

  <script>
    const lessonsData = {
      1: {
        title: "1. Diagnóstico de tu dinero: ¿A dónde se va lo que ganas?",
        tag: "Lección 1 de 8 (Carrera Financiera)",
        duration: "14 min",
        videoUrl: "https://www.youtube.com/embed/WF6qLnuh4EA",
        videoCheckpoints: [
          {
            time: 25,
            timeLabel: "0:25",
            title: "¿Cuál es el error más frecuente al presupuestar?",
            desc: "Pregunta sobre el diagnóstico inicial del dinero:",
            options: [
              "Confiar en la memoria sin registrar ingresos y gastos por escrito",
              "Gastar más en alimentos que en ropa",
              "Ahorrar únicamente monedas en una alcancía",
              "Tener más de una cuenta bancaria"
            ],
            correct: 0,
            explanation: "¡Exacto! Presupuestar 'de memoria' falla siempre porque se omiten los gastos invisibles. Registrar por escrito es la base de todo diagnóstico financiero.",
            rewindTo: 10
          },
          {
            time: 70,
            timeLabel: "1:10",
            title: "¿Qué define realmente tu 'Ingreso Neto Disponible'?",
            desc: "Valida tu comprensión sobre el flujo de dinero:",
            options: [
              "La suma total de tu sueldo bruto prometido",
              "El saldo real disponible tras restar impuestos y deducciones obligatorias",
              "El límite de crédito autorizado en tus tarjetas",
              "Los préstamos que puedes solicitar"
            ],
            correct: 1,
            explanation: "¡Muy bien! Tus decisiones deben basarse siempre en el ingreso neto real libre de deducciones, nunca en el bruto.",
            rewindTo: 45
          },
          {
            time: 130,
            timeLabel: "2:10",
            title: "¿Para qué sirve auditar tus gastos durante 30 días?",
            desc: "Sobre la herramienta práctica presentada:",
            options: [
              "Para cancelar todas tus tarjetas de débito",
              "Para obtener una radiografía real y detectar fugas silenciosas de capital",
              "Para pedir un aumento al día siguiente",
              "Para dejar de comer fuera de por vida"
            ],
            correct: 1,
            explanation: "¡Correcto! Una auditoría de 30 días expone los hábitos automáticos que drenan tu capacidad de ahorro.",
            rewindTo: 95
          }
        ],
        audio: { title: "Mitos del dinero que te mantienen pobre", desc: "Desmontamos las creencias más comunes que frenan tu crecimiento financiero.", duration: "22 min" },
        book: { title: "Pequeño Cerdo Capitalista", author: "Sofía Macías", desc: "La guía práctica más leída sobre finanzas personales e inteligencia financiera en México." },
        exercise: {
          title: "¿Cuál es el primer paso para organizar tus finanzas?",
          desc: "Selecciona la opción correcta basada en la metodología de diagnóstico:",
          options: [
            "Anotar mentalmente lo que gastas cada semana",
            "Registrar y auditar todos tus ingresos fijos y variables antes de gastar",
            "Dejar de gastar en alimentos y entretenimiento completamente",
            "Pedir un préstamo para pagar tarjetas"
          ],
          correct: 1,
          explanation: "¡Exacto! El diagnóstico parte de conocer tu número real auditando tus ingresos y egresos por escrito."
        },
        body: `<p>Bienvenido al primer paso de tu educación financiera. En esta lección aprenderás a identificar con exactitud tu flujo neto mensual antes de gastar un solo peso.</p>
               <ul>
                 <li><strong>Cálculo de ingreso real disponible:</strong> Ingresos fijos vs variables.</li>
                 <li><strong>Los 3 errores comunes:</strong> Por qué presupuestar en la cabeza nunca funciona.</li>
                 <li><strong>Herramienta descargable:</strong> Hoja de auditoría personal en 5 minutos.</li>
               </ul>`
      },
      2: {
        title: "2. Fugas de capital y micro-gastos hormiga",
        tag: "Lección 2 de 8 (Carrera Financiera)",
        duration: "11 min",
        videoUrl: "https://www.youtube.com/embed/DT6Nh3aV5Vc",
        externalUrl: "https://youtu.be/DT6Nh3aV5Vc?si=7Goupsx4H4p_JuUP",
        videoCheckpoints: [
          {
            time: 25,
            timeLabel: "0:25",
            title: "¿Qué es exactamente un 'Gasto Hormiga'?",
            desc: "Pregunta sobre el concepto fundamental de la clase:",
            options: [
              "Una inversión en un fondo a plazo fijo",
              "Pequeños desembolsos diarios casi imperceptibles que acumulados destruyen tu ahorro",
              "El pago de la renta o hipoteca",
              "El costo de una reparación mayor de emergencia"
            ],
            correct: 1,
            explanation: "¡Correcto! Cafés diarios, golosinas, comisiones no revisadas o suscripciones olvidadas parecen insignificantes pero suman decenas de miles de pesos al año.",
            rewindTo: 10
          },
          {
            time: 65,
            timeLabel: "1:05",
            title: "Si gastas $65 MXN diarios en compras impulsivas, ¿cuánto representa al año?",
            desc: "Calcula el costo de oportunidad de este hábito:",
            options: [
              "Alrededor de $3,500 MXN",
              "Más de $23,700 MXN al año",
              "Menos de $1,000 MXN",
              "Aproximadamente $7,500 MXN"
            ],
            correct: 1,
            explanation: "¡Exacto! $65 x 365 días son $23,725 MXN anuales, suficiente para crear tu fondo de emergencia o dar el enganche de una inversión rentable.",
            rewindTo: 40
          },
          {
            time: 110,
            timeLabel: "1:50",
            title: "¿En qué consiste la 'Regla de las 72 horas' para compras no esenciales?",
            desc: "Sobre la técnica psicológica de control:",
            options: [
              "Devolver el producto a los 3 días obligatoriamente",
              "Esperar 72 horas antes de comprar un impulso para enfriar la emoción y evaluar su necesidad",
              "Pagar en 3 cuotas con tarjeta",
              "Pedir la opinión a 3 familiares"
            ],
            correct: 1,
            explanation: "¡Excelente! La pausa de 72 horas neutraliza el pico de dopamina del marketing y te permite tomar decisiones conscientes.",
            rewindTo: 80
          }
        ],
        audio: { title: "Psicología del consumo impulsivo", desc: "Cómo los algoritmos y el marketing explotan tus sesgos para hacerte gastar de más.", duration: "19 min" },
        book: { title: "Hábitos Atómicos (Finanzas)", author: "James Clear", desc: "Cómo pequeños ajustes diarios construyen una muralla contra el desperdicio económico." },
        exercise: {
          title: "Si compras un café diario de $65 MXN, ¿cuánto representa al año?",
          desc: "Calcula el costo de oportunidad anual de este gasto recurrente:",
          options: [
            "$5,000 MXN",
            "$12,000 MXN",
            "Más de $23,700 MXN (equivalente a 1 mes de sueldo o un fondo de emergencia)",
            "$800 MXN"
          ],
          correct: 2,
          explanation: "¡Correcto! $65 x 365 días son $23,725 MXN al año. Redirigir ese gasto a inversión genera miles de pesos en intereses."
        },
        body: `<p>Los pequeños goteos hunden los barcos más grandes. En esta lección aprenderás a auditar cafés diarios, suscripciones duplicadas y compras por impulso.</p>
               <ul>
                 <li><strong>Técnica de los 30 días:</strong> Regla de espera antes de compras no esenciales.</li>
                 <li><strong>Cálculo del costo de oportunidad:</strong> Cuánto te cuesta ese gasto en 5 años invertido al 11%.</li>
                 <li><strong>Plan de sustitución inteligente:</strong> Disfrutar sin desangrar tu billetera.</li>
               </ul>
               <div style="margin-top: 18px; padding: 14px 16px; background: #fef2f2; border: 1px solid #fecaca; border-radius: 10px; display: flex; align-items: center; justify-content: space-between; gap: 12px; flex-wrap: wrap;">
                 <div>
                   <div style="font-weight: 700; color: #991b1b; font-size: 14px;">📺 Video explicativo: Fugas y Micro-Gastos Hormiga</div>
                   <div style="font-size: 12.5px; color: #b91c1c; margin-top: 2px;">Aprende a detectar fugas de dinero invisibles y proteger tu flujo mensual.</div>
                 </div>
                 <a href="https://youtu.be/DT6Nh3aV5Vc?si=7Goupsx4H4p_JuUP" target="_blank" rel="noopener noreferrer" style="display: inline-flex; align-items: center; gap: 6px; background: #dc2626; color: #ffffff; text-decoration: none; padding: 8px 14px; border-radius: 6px; font-size: 13px; font-weight: 700; box-shadow: 0 2px 4px rgba(220,38,38,0.2);">
                   Abrir video en YouTube ↗
                 </a>
               </div>`
      },
      3: {
        title: "3. La Regla 50/30/20 simplificada",
        tag: "Lección 3 de 8 (Carrera Financiera)",
        duration: "15 min",
        videoUrl: "https://www.youtube.com/embed/NnL7zHjX0bU",
        videoCheckpoints: [
          {
            time: 30,
            timeLabel: "0:30",
            title: "En la regla 50/30/20, ¿qué categoría cubre el 50%?",
            desc: "Distribución del ingreso neto mensual:",
            options: [
              "Necesidades indispensables (vivienda, alimentos, transporte y servicios básicos)",
              "Salidas, entretenimiento y restaurantes",
              "Inversiones especulativas en cripto",
              "Compras de ropa de marca"
            ],
            correct: 0,
            explanation: "¡Correcto! El 50% garantiza tu subsistencia y compromisos fijos indispensables.",
            rewindTo: 10
          },
          {
            time: 75,
            timeLabel: "1:15",
            title: "¿A qué rubro se destina el 30% del presupuesto?",
            desc: "Valida tu conocimiento de la fórmula:",
            options: [
              "Pago de multas e intereses atrasados",
              "Deseos, estilo de vida, pasatiempos y entretenimiento consciente",
              "Guardarlo en efectivo en una caja",
              "Comisiones bancarias"
            ],
            correct: 1,
            explanation: "¡Exacto! El 30% te permite disfrutar del fruto de tu esfuerzo hoy, sin culpa y con límite claro.",
            rewindTo: 45
          },
          {
            time: 125,
            timeLabel: "2:05",
            title: "¿Por qué el 20% debe apartarse al inicio del mes ('Pagarte a ti primero')?",
            desc: "Sobre el principio de ahorro automático:",
            options: [
              "Porque si esperas al fin de mes, casi nunca sobra dinero para ahorrar",
              "Porque el banco cobra penalización si no lo retiras",
              "Para gastarlo en el fin de semana de quincena",
              "Porque es una ley fiscal obligatoria"
            ],
            correct: 0,
            explanation: "¡Muy bien! Si ahorras 'lo que sobre', nunca ahorrarás. Quien se paga a sí mismo primero asegura su patrimonio.",
            rewindTo: 90
          }
        ],
        audio: { title: "Automatiza tu presupuesto en 3 cuentas", desc: "El sistema de 3 cuentas bancarias para nunca volver a quedarte sin dinero antes de quincena.", duration: "25 min" },
        book: { title: "El Hombre más Rico de Babilonia", author: "George S. Clason", desc: "El principio clásico de pagarse a uno mismo primero al menos el 10% al 20% de lo ganado." },
        exercise: {
          title: "Según la regla 50/30/20, si ganas $20,000 MXN netos, ¿cuánto debes destinar a Ahorro/Inversión?",
          desc: "Calcula el monto correspondiente a la categoría del 20%:",
          options: [
            "$2,000 MXN",
            "$4,000 MXN (el 20% reservado para tu libertad futura)",
            "$6,000 MXN",
            "Lo que sobre después de pagar las salidas del fin de semana"
          ],
          correct: 1,
          explanation: "¡Excelente! El 20% de $20,000 son exactamente $4,000 MXN destinados a pagar deudas, fondo de paz e inversión."
        },
        body: `<p>El marco de distribución presupuestaria más sólido del mundo, adaptado al costo de vida real de México y Latinoamérica.</p>
               <ul>
                 <li><strong>50% Necesidades esenciales:</strong> Vivienda, despensa, transporte indispensable y servicios.</li>
                 <li><strong>30% Deseos y estilo de vida:</strong> Salidas, entretenimiento y gustos personales sin culpa.</li>
                 <li><strong>20% Ahorro e Inversión:</strong> Tu libertad financiera futura y pago acelerado de deudas.</li>
               </ul>`
      },
      4: {
        title: "4. Método anti-deuda acelerado: Bola de Nieve vs Avalancha",
        tag: "Lección 4 de 8 (Carrera Financiera)",
        duration: "18 min",
        videoUrl: "https://www.youtube.com/embed/SkHPWkxzE7o",
        externalUrl: "https://youtu.be/SkHPWkxzE7o?si=AA9chSyG1lcZaSrY",
        videoCheckpoints: [
          {
            time: 30,
            timeLabel: "0:30",
            title: "¿Por qué es una trampa financiera pagar sólo el 'pago mínimo' de tu tarjeta?",
            desc: "Pausa sobre el costo del crédito bancario:",
            options: [
              "Porque el banco te cancela la tarjeta al día siguiente",
              "Porque casi todo el monto se va a intereses y la deuda puede tardar décadas en liquidarse",
              "Porque disminuye tu sueldo laboral automáticamente",
              "Porque el banco no reporta nada a Buró"
            ],
            correct: 1,
            explanation: "¡Exacto! El pago mínimo amortiza sólo una fracción ínfima del capital, generando intereses sobre intereses a favor del banco.",
            rewindTo: 10
          },
          {
            time: 75,
            timeLabel: "1:15",
            title: "¿Cómo funciona la estrategia de deudas 'Bola de Nieve'?",
            desc: "Lógica psicológica del método:",
            options: [
              "Pagar primero la deuda con el saldo total más pequeño para lograr una victoria rápida",
              "Pagar primero la deuda más grande",
              "Pagar todas las tarjetas por partes iguales",
              "Ignorar las deudas pequeñas"
            ],
            correct: 0,
            explanation: "¡Excelente! La victoria temprana de eliminar una deuda pequeña libera flujo de efectivo y motivación para demoler la siguiente.",
            rewindTo: 45
          },
          {
            time: 130,
            timeLabel: "2:10",
            title: "¿Cuál es la principal ventaja matemática del método 'Avalancha'?",
            desc: "Comparación técnica entre métodos:",
            options: [
              "Ahorra el máximo posible de dinero en intereses atacando primero la deuda con mayor CAT",
              "Elimina la obligación de pagar impuestos",
              "Te premia con puntos bancarios adicionales",
              "Borra el Buró de Crédito inmediatamente"
            ],
            correct: 0,
            explanation: "¡Correcto! El método Avalancha es matemáticamente el más eficiente porque ataca la tasa de interés más costosa en primer lugar.",
            rewindTo: 90
          }
        ],
        audio: { title: "Saliendo de la trampa del pago mínimo", desc: "Por qué los bancos adoran que pagues el mínimo y cómo cortar esa cadena para siempre.", duration: "24 min" },
        book: { title: "La Transformación Total de su Dinero", author: "Dave Ramsey", desc: "Paso a paso para demoler deudas de tarjetas y créditos personales con la Bola de Nieve." },
        exercise: {
          title: "¿En qué consiste la estrategia de 'Bola de Nieve' para pagar deudas?",
          desc: "Identifica la lógica de ordenamiento de esta estrategia probada:",
          options: [
            "Pagar la deuda con el monto más grande primero",
            "Pagar la deuda con el saldo total más pequeño primero para lograr una victoria psicológica rápida",
            "Pagar solo los intereses de todas las tarjetas",
            "Ignorar las deudas hasta que prescriban"
          ],
          correct: 1,
          explanation: "¡Exacto! Bola de nieve ataca la deuda menor primero para darte motivación, liberar flujo de caja y crear un ritmo imparable."
        },
        body: `<p>El método probado para liquidar deudas de tarjetas y préstamos en tiempo récord pagando el mínimo interés posible.</p>
               <ul>
                 <li><strong>Estrategia Bola de Nieve:</strong> Victorias psicológicas rápidas liquidando de menor a mayor saldo.</li>
                 <li><strong>Estrategia Avalancha:</strong> Ahorro matemático máximo atacando la tasa de interés más alta.</li>
                 <li><strong>Plan de ataque:</strong> Congelar tarjetas activas y redirigir cada excedente a capital.</li>
               </ul>
               <div style="margin-top: 18px; padding: 14px 16px; background: #fef2f2; border: 1px solid #fecaca; border-radius: 10px; display: flex; align-items: center; justify-content: space-between; gap: 12px; flex-wrap: wrap;">
                 <div>
                   <div style="font-weight: 700; color: #991b1b; font-size: 14px;">📺 Video explicativo del Método Anti-Deuda</div>
                   <div style="font-size: 12.5px; color: #b91c1c; margin-top: 2px;">Bola de Nieve vs Avalancha: ¿cuál es mejor para pagar tus deudas?</div>
                 </div>
                 <a href="https://youtu.be/SkHPWkxzE7o?si=AA9chSyG1lcZaSrY" target="_blank" rel="noopener noreferrer" style="display: inline-flex; align-items: center; gap: 6px; background: #dc2626; color: #ffffff; text-decoration: none; padding: 8px 14px; border-radius: 6px; font-size: 13px; font-weight: 700; box-shadow: 0 2px 4px rgba(220,38,38,0.2);">
                   Abrir video en YouTube ↗
                 </a>
               </div>`
      },
      5: {
        title: "5. Creación del Fondo de Paz y Emergencias",
        tag: "Lección 5 de 8 (Carrera Financiera)",
        duration: "16 min",
        videoUrl: "https://www.youtube.com/embed/vp_B6Z7eF68",
        externalUrl: "https://youtu.be/vp_B6Z7eF68?si=S854mK2puo4_ystd",
        videoCheckpoints: [
          {
            time: 30,
            timeLabel: "0:30",
            title: "¿De cuántos meses de gastos básicos debe componerse un fondo de emergencia ideal?",
            desc: "Blindaje ante imprevistos de vida:",
            options: [
              "De 1 semana de salario",
              "De 3 a 6 meses de gastos indispensables y fijos",
              "De 5 años de estilo de vida",
              "De 1 quincena de gastos corrientes"
            ],
            correct: 1,
            explanation: "¡Correcto! Entre 3 y 6 meses te dan tiempo suficiente para recuperarte de pérdida de empleo o contingencia de salud sin endeudarte.",
            rewindTo: 10
          },
          {
            time: 75,
            timeLabel: "1:15",
            title: "¿Dónde es idóneo resguardar tu fondo de emergencias?",
            desc: "Criterio de disponibilidad y riesgo:",
            options: [
              "En efectivo debajo del colchón",
              "En una cuenta segura, regulada y con liquidez diaria que pague rendimientos (ej. Bonddia/CETES)",
              "En acciones de alta volatilidad",
              "Prestado a un familiar"
            ],
            correct: 1,
            explanation: "¡Excelente! Necesitas disponibilidad inmediata sin riesgo de fluctuación negativa en su valor.",
            rewindTo: 45
          },
          {
            time: 125,
            timeLabel: "2:05",
            title: "¿Cuándo es legítimo utilizar los recursos del fondo de emergencias?",
            desc: "Regla de oro de preservación:",
            options: [
              "Únicamente ante imprevistos graves (urgencia médica, desempleo o avería indispensable)",
              "Para aprovechar una oferta de tecnología en el Buen Fin",
              "Para irse de vacaciones si no sobró dinero",
              "Para comprar boletos de un concierto"
            ],
            correct: 0,
            explanation: "¡Exacto! El fondo es tu salvavidas de supervivencia; usarlo para gustos destruye tu paz financiera.",
            rewindTo: 90
          }
        ],
        audio: { title: "Dormir en paz: La psicología del colchón financiero", desc: "Cómo tener 3 meses de gastos líquidos elimina el 90% del estrés diario.", duration: "20 min" },
        book: { title: "Tu Dinero Cuenta", author: "Howard Dayton", desc: "Estrategias de blindaje y preservación ante imprevistos de salud y empleo." },
        exercise: {
          title: "¿Dónde debe guardarse el Fondo de Emergencias?",
          desc: "Selecciona el instrumento financiero idóneo para este propósito:",
          options: [
            "En efectivo debajo del colchón",
            "En acciones volátiles de alto riesgo",
            "En una cuenta líquida y segura que pague rendimiento diario (ej. CETES Bonddia o cuenta a la vista con rendimiento)",
            "En criptomonedas de alta especulación"
          ],
          correct: 2,
          explanation: "¡Correcto! El fondo de emergencia exige liquidez inmediata y nula volatilidad, sin perder contra la inflación."
        },
        body: `<p>Un fondo de paz mental es el colchón que evita que cualquier imprevisto (médico, auto, desempleo) te regrese a la deuda.</p>
               <ul>
                 <li><strong>Regla de oro:</strong> De 3 a 6 meses de gastos fijos esenciales.</li>
                 <li><strong>Dónde colocarlo:</strong> Instrumentos regulados por CNBV con liquidez diaria (Bonddia/CETES).</li>
                 <li><strong>Reglas de uso:</strong> Solo para emergencias genuinas, no para vacaciones o rebajas.</li>
               </ul>
               <div style="margin-top: 18px; padding: 14px 16px; background: #fef2f2; border: 1px solid #fecaca; border-radius: 10px; display: flex; align-items: center; justify-content: space-between; gap: 12px; flex-wrap: wrap;">
                 <div>
                   <div style="font-weight: 700; color: #991b1b; font-size: 14px;">📺 Video explicativo: Fondo de Paz y Emergencias</div>
                   <div style="font-size: 12.5px; color: #b91c1c; margin-top: 2px;">Fondo de Emergencia con Poco Dinero: Guía Paso a Paso.</div>
                 </div>
                 <a href="https://youtu.be/vp_B6Z7eF68?si=S854mK2puo4_ystd" target="_blank" rel="noopener noreferrer" style="display: inline-flex; align-items: center; gap: 6px; background: #dc2626; color: #ffffff; text-decoration: none; padding: 8px 14px; border-radius: 6px; font-size: 13px; font-weight: 700; box-shadow: 0 2px 4px rgba(220,38,38,0.2);">
                   Abrir video en YouTube ↗
                 </a>
               </div>`
      },
      6: {
        title: "6. Negociación de créditos y blindaje financiero",
        tag: "Lección 6 de 8 (Carrera Financiera)",
        duration: "14 min",
        videoUrl: "https://www.youtube.com/embed/5k3f3p4P7-I",
        videoCheckpoints: [
          {
            time: 30,
            timeLabel: "0:30",
            title: "¿Qué es una 'Reestructura de Crédito' bancaria?",
            desc: "Opciones de negociación ante dificultades:",
            options: [
              "Un acuerdo con el banco para ajustar plazo y tasa fija a un pago mensual pagable",
              "Dejar de pagar y apagar el teléfono celular",
              "Pedir otro préstamo más caro para pagar el anterior",
              "Cancelar la cuenta bancaria sin avisar"
            ],
            correct: 0,
            explanation: "¡Muy bien! Reestructurar permite conservar tu reputación financiera pactando cuotas alcanzables.",
            rewindTo: 10
          },
          {
            time: 70,
            timeLabel: "1:10",
            title: "¿Qué consecuencia negativa tiene aceptar una 'Quita' agresiva?",
            desc: "Impacto en Buró de Crédito:",
            options: [
              "Deja una marca de quebranto en Buró de Crédito que dificulta nuevos créditos por años",
              "El banco te otorga un premio por liquidar antes",
              "No tiene ningún impacto negativo en tu historial",
              "Te exenta de pagar impuestos federales"
            ],
            correct: 0,
            explanation: "¡Correcto! La quita perdona una parte de la deuda, pero queda asentado que no cumpliste el 100% de tu compromiso.",
            rewindTo: 40
          },
          {
            time: 120,
            timeLabel: "2:00",
            title: "¿Cuál es el mejor momento para acercarse al banco a renegociar?",
            desc: "Momento óptimo de negociación:",
            options: [
              "Antes de caer en impago o en cuanto anticipes que no podrás cubrir la mensualidad",
              "Después de 2 años de no pagar nada",
              "Cuando el caso pase a un despacho judicial de cobranza",
              "Nunca, el banco nunca negocia"
            ],
            correct: 0,
            explanation: "¡Exacto! Los bancos ofrecen mejores planes y tasas a clientes preventivos antes de entrar en cartera vencida.",
            rewindTo: 85
          }
        ],
        audio: { title: "Cómo negociar quitas y reestructuras sin arruinar tu historial", desc: "Estrategias de negociación directa con instituciones bancarias y despachos de cobranza.", duration: "21 min" },
        book: { title: "Rompe la Barrera del No", author: "Chris Voss", desc: "Tácticas de negociación para conseguir mejores tasas, cancelaciones de anualidades y acuerdos." },
        exercise: {
          title: "¿Qué es el CAT (Costo Anual Total) y por qué debes compararlo?",
          desc: "Identifica el significado y relevancia financiera del CAT:",
          options: [
            "Un impuesto estatal obligatorio",
            "La medida oficial en México que integra tasa de interés, comisiones y seguros del crédito",
            "El saldo mínimo que exige la tarjeta de crédito",
            "Un descuento por pronto pago"
          ],
          correct: 1,
          explanation: "¡Exacto! El CAT incluye todos los costos reales del crédito. Elegir siempre el menor CAT te ahorra miles de pesos."
        },
        body: `<p>Aprende a negociar con instituciones financieras para bajar tu tasa de interés, consolidar deudas caras y cancelar seguros innecesarios.</p>
               <ul>
                 <li><strong>Transferencia de saldos:</strong> Mover tu deuda a un banco que ofrezca tasa promocional del 0% al 12%.</li>
                 <li><strong>Revisión del Buró de Crédito:</strong> Cómo leer tu Reporte de Crédito Especial (Mi Buró).</li>
                 <li><strong>Blindaje patrimonial:</strong> El rol del seguro de gastos médicos y de auto como protección.</li>
               </ul>`
      },
      7: {
        title: "7. CETES y Primeros Pasos en Renta Fija",
        tag: "Lección 7 de 8 (Carrera Financiera)",
        duration: "19 min",
        videoUrl: "https://www.youtube.com/embed/d3UaX-s7eXU",
        videoCheckpoints: [
          {
            time: 30,
            timeLabel: "0:30",
            title: "¿Por qué el interés compuesto es la fuerza más potente del inversionista?",
            desc: "Concepto clave de acumulación de riqueza:",
            options: [
              "Porque reinvierte las ganancias periódicamente, generando intereses sobre intereses exponencialmente",
              "Porque duplica tu dinero de un día para otro",
              "Porque evita tener que pagar seguros",
              "Porque sólo funciona con millones de pesos"
            ],
            correct: 0,
            explanation: "¡Excelente! Cada rendimiento reinvertido se convierte en nuevo capital de trabajo, acelerando la curva de crecimiento patrimonial.",
            rewindTo: 10
          },
          {
            time: 75,
            timeLabel: "1:15",
            title: "¿Qué respaldo oficial tienen los CETES en México?",
            desc: "Seguridad y regulación de la inversión:",
            options: [
              "Garantía directa del Gobierno de México respaldada por SHCP y Banxico",
              "El respaldo de una cadena de tiendas departamentales",
              "Ningún respaldo formal",
              "Una plataforma extranjera no regulada"
            ],
            correct: 0,
            explanation: "¡Exacto! CETES es el instrumento con menor riesgo en México porque el deudor es el propio Gobierno Federal.",
            rewindTo: 45
          },
          {
            time: 130,
            timeLabel: "2:10",
            title: "¿En qué consiste la técnica DCA (Dollar Cost Averaging)?",
            desc: "Estrategia para invertir sin estrés:",
            options: [
              "Aportar periódicamente una cantidad fija sin preocuparte por los vaivenes temporales del mercado",
              "Comprar sólo divisas en billetes físicos",
              "Vender todo cada vez que las noticias sean malas",
              "Invertir únicamente una vez cada 5 años"
            ],
            correct: 0,
            explanation: "¡Muy bien! El DCA promedia tu precio de adquisición y elimina el sesgo emocional de intentar anticipar el mercado.",
            rewindTo: 90
          }
        ],
        audio: { title: "La magia del interés compuesto explicada para todos", desc: "Cómo Albert Einstein llamó al interés compuesto la octava maravilla del mundo y cómo activarlo.", duration: "27 min" },
        book: { title: "Inversionista de a Pie", author: "Omar Educación Financiera", desc: "Guía paso a paso para abrir cuenta en CETESdirecto, SOFIPOs y Casas de Bolsa reguladas en México." },
        exercise: {
          title: "Si inviertes $10,000 MXN en CETES al 11% anual reinvirtiendo intereses cada mes, ¿qué fenómeno estás activando?",
          desc: "Selecciona el principio financiero que acelera tu patrimonio:",
          options: [
            "Devaluación del capital",
            "Interés compuesto (ganar intereses sobre intereses)",
            "Especulación bursátil",
            "Pérdida por comisiones bancarias"
          ],
          correct: 1,
          explanation: "¡Excelente! La reinversión periódica genera crecimiento exponencial porque cada nuevo periodo los intereses ganados también rinden."
        },
        body: `<p>Aprende a poner tu dinero a trabajar en el instrumento más seguro de México: Valores gubernamentales regulados por BANXICO y SHCP.</p>
               <ul>
                 <li><strong>¿Qué es CETESdirecto?:</strong> Plataforma directa sin intermediarios bancarios ni comisiones.</li>
                 <li><strong>Plazos disponibles:</strong> 28 días, 91 días, 6 meses, 1 año y 2 años.</li>
                 <li><strong>Instrucción de ahorro recurrente:</strong> Automatiza la compra de títulos en cada fecha de cobro.</li>
               </ul>`
      },
      8: {
        title: "8. Portafolios Pasivos, ETFs y Retiro Temprano",
        tag: "Lección 8 de 8 (Carrera Financiera)",
        duration: "22 min",
        videoUrl: "https://www.youtube.com/embed/yQeT95m2r8o",
        videoCheckpoints: [
          {
            time: 30,
            timeLabel: "0:30",
            title: "¿Qué define el estado de 'Libertad Financiera'?",
            desc: "Objetivo final del programa educativo:",
            options: [
              "Tus ingresos pasivos o rendimientos cubren el 100% de tus gastos sin depender de un empleo tradicional",
              "Tener una gran cantidad de dinero en billetes en tu domicilio",
              "Dejar de consumir cualquier bien o servicio",
              "Ganar un salario alto sin tener ahorros"
            ],
            correct: 0,
            explanation: "¡Exacto! Libertad financiera es soberanía sobre tu tiempo: tu capital trabaja para ti y no tú para pagar cuentas.",
            rewindTo: 10
          },
          {
            time: 75,
            timeLabel: "1:15",
            title: "¿Qué postula la 'Regla del 4%' del Estudio Trinity para el retiro?",
            desc: "Tasa de retiro seguro:",
            options: [
              "Retirar un 4% anual de tu portafolio diversificado ajustado por inflación preserva el capital por décadas",
              "Aportar 4% de propina en todas las comidas",
              "Pagar un 4% de impuesto especial",
              "Que las inversiones rinden siempre exactamente 4%"
            ],
            correct: 0,
            explanation: "¡Correcto! La regla del 4% es el referente global para calcular cuándo puedes retirarte con tranquilidad.",
            rewindTo: 45
          },
          {
            time: 125,
            timeLabel: "2:05",
            title: "¿Cómo calculas tu 'Número de Libertad Financiera' (Regla de 25x)?",
            desc: "Fórmula de capital de retiro:",
            options: [
              "Multiplicando tu gasto anual por 25 (ej. si gastas $240,000/año, tu meta es $6,000,000 MXN)",
              "Multiplicando tu sueldo mensual por 12",
              "Dividiendo tus deudas entre 25",
              "Sumando tus últimos 3 aguinaldos"
            ],
            correct: 0,
            explanation: "¡Excelente! Gasto anual x 25 = Patrimonio necesario para vivir del 4% anual sin tocar el capital central.",
            rewindTo: 85
          }
        ],
        audio: { title: "La Regla del 4% y la Filosofía FIRE", desc: "Cómo calcular el monto exacto para vivir de tus rentas e inversiones sin depender de un jefe.", duration: "30 min" },
        book: { title: "El Pequeño Libro para Invertir con Sentido Común", author: "John C. Bogle", desc: "La obra maestra del fundador de Vanguard sobre invertir en el índice S&P 500 a bajo costo.", duration: "300 pág." },
        exercise: {
          title: "Según la Regla del 4%, ¿cuánto necesitas acumular para retirarte si gastas $300,000 MXN al año?",
          desc: "Aplica la fórmula: Gasto Anual x 25 = Patrimonio de Libertad:",
          options: [
            "$1,000,000 MXN",
            "$7,500,000 MXN invertidos en portafolio diversificado global",
            "$500,000 MXN",
            "$50,000,000 MXN"
          ],
          correct: 1,
          explanation: "¡Exacto! $300,000 x 25 = $7,500,000 MXN. Retirar el 4% anual ($300k) ajustado a inflación preserva el capital indefinidamente."
        },
        body: `<p>La estrategia definitiva para inversores a largo plazo: Diversificación global a través de fondos indexados (ETFs como VOO, IVVpeso, VT).</p>
               <ul>
                 <li><strong>El índice S&P 500:</strong> Las 500 empresas más sólidas y rentables del mercado estadounidense.</li>
                 <li><strong>Estrategia DCA (Dollar Cost Averaging):</strong> Aportar un monto fijo cada mes sin importar los altibajos del mercado.</li>
                 <li><strong>Tu número de libertad financiera:</strong> Plan de retiro y proyección patrimonial a 10, 15 y 20 años.</li>
               </ul>`
      }
    };

    // ============================================================
    // GESTIÓN DEL CUESTIONARIO INTERACTIVO EN TIEMPO REAL DEL VIDEO
    // ============================================================
    let ytPlayer = null;
    let ytPollInterval = null;
    let vquizActiveCheckpoint = null;
    let vquizSelectedOption = null;
    let vquizAutoPause = true;

    function getYouTubeVideoId(url) {
      if (!url) return '';
      const match = url.match(/(?:embed\/|v\/|watch\?v=|youtu\.be\/|\/v=)([a-zA-Z0-9_-]+)/);
      return match ? match[1] : '';
    }

    function formatYTUrlWithAPI(url) {
      if (!url) return '';
      let cleanUrl = url;
      if (!cleanUrl.includes('enablejsapi=1')) {
        cleanUrl += (cleanUrl.includes('?') ? '&' : '?') + 'enablejsapi=1&rel=0&modestbranding=1';
      }
      return cleanUrl;
    }

    // Persistencia de respuestas completadas en LocalStorage
    function getVquizState() {
      try {
        return JSON.parse(localStorage.getItem('vquiz_completed_answers') || '{}');
      } catch(e) {
        return {};
      }
    }

    function isVquizAnswered(lessonId, cpIndex) {
      const state = getVquizState();
      return !!state[`${lessonId}_${cpIndex}`];
    }

    function markVquizAnswered(lessonId, cpIndex) {
      const state = getVquizState();
      state[`${lessonId}_${cpIndex}`] = true;
      try {
        localStorage.setItem('vquiz_completed_answers', JSON.stringify(state));
      } catch(e) {}
      renderVquizBar(lessonId);
    }

    // Callback oficial de la API de YouTube
    window.onYouTubeIframeAPIReady = function() {
      initYouTubePlayer();
    };

    function initYouTubePlayer() {
      const iframe = document.getElementById('lessonVideoIframe');
      if (!iframe || !window.YT || !window.YT.Player) return;

      try {
        ytPlayer = new YT.Player('lessonVideoIframe', {
          events: {
            'onStateChange': onPlayerStateChange
          }
        });
      } catch(e) {
        console.warn('Modo asistido sin control directo de API YouTube:', e);
      }
    }

    function onPlayerStateChange(event) {
      // 1 = YT.PlayerState.PLAYING
      if (window.YT && event.data === window.YT.PlayerState.PLAYING) {
        startTrackingVideoTime();
      } else {
        stopTrackingVideoTime();
      }
    }

    function startTrackingVideoTime() {
      stopTrackingVideoTime();
      ytPollInterval = setInterval(checkVideoPlaybackTime, 350);
    }

    function stopTrackingVideoTime() {
      if (ytPollInterval) {
        clearInterval(ytPollInterval);
        ytPollInterval = null;
      }
    }

    function checkVideoPlaybackTime() {
      if (!ytPlayer || typeof ytPlayer.getCurrentTime !== 'function') return;
      const currentSec = ytPlayer.getCurrentTime();
      const lesson = lessonsData[currentLesson];
      if (!lesson || !lesson.videoCheckpoints) return;

      // Actualizar estilo visual del chip más cercano
      highlightActiveChip(currentSec);

      if (!vquizAutoPause) return;
      if (vquizActiveCheckpoint !== null) return; // ya hay una pregunta abierta

      lesson.videoCheckpoints.forEach((cp, idx) => {
        if (isVquizAnswered(currentLesson, idx)) return;
        // Si el reproductor pasa por el segundo objetivo dentro de una ventana de 2 segundos:
        if (currentSec >= cp.time && currentSec <= cp.time + 2.2) {
          triggerVideoCheckpoint(idx);
        }
      });
    }

    function highlightActiveChip(currentSec) {
      const lesson = lessonsData[currentLesson];
      if (!lesson || !lesson.videoCheckpoints) return;
      lesson.videoCheckpoints.forEach((cp, idx) => {
        const chip = document.getElementById(`vquizChip_${idx}`);
        if (!chip) return;
        if (!isVquizAnswered(currentLesson, idx) && Math.abs(currentSec - cp.time) <= 8) {
          chip.classList.add('current');
        } else {
          chip.classList.remove('current');
        }
      });
    }

    function triggerVideoCheckpoint(index) {
      const lesson = lessonsData[currentLesson];
      if (!lesson || !lesson.videoCheckpoints || !lesson.videoCheckpoints[index]) return;
      const cp = lesson.videoCheckpoints[index];
      
      vquizActiveCheckpoint = index;
      vquizSelectedOption = null;

      // Pausar video automáticamente
      if (ytPlayer && typeof ytPlayer.pauseVideo === 'function') {
        ytPlayer.pauseVideo();
      }

      // Llenar contenido del modal en video
      document.getElementById('vquizTimeBadge').textContent = '⏱️ Pausa en ' + cp.timeLabel;
      document.getElementById('vquizStepBadge').textContent = 'Pregunta ' + (index + 1) + ' de ' + lesson.videoCheckpoints.length;
      document.getElementById('vquizTitle').textContent = cp.title;
      document.getElementById('vquizDesc').textContent = cp.desc;

      const letters = ['A', 'B', 'C', 'D'];
      const optHtml = cp.options.map((opt, i) => {
        return `<button type="button" class="vquiz-option-btn" id="vquizOpt_${i}" onclick="selectVquizOption(${i})">
          <span class="vquiz-option-letter">${letters[i]}</span>
          <span>${opt}</span>
        </button>`;
      }).join('');
      document.getElementById('vquizOptionsContainer').innerHTML = optHtml;

      const feedback = document.getElementById('vquizFeedback');
      feedback.className = 'vquiz-feedback';
      feedback.style.display = 'none';

      document.getElementById('vquizBtnSubmit').style.display = 'inline-flex';
      document.getElementById('vquizBtnContinue').style.display = 'none';
      document.getElementById('vquizBtnRewind').style.display = 'none';

      const overlay = document.getElementById('videoQuizOverlay');
      if (overlay) overlay.classList.add('active');
    }

    function selectVquizOption(index) {
      vquizSelectedOption = index;
      const buttons = document.querySelectorAll('#vquizOptionsContainer .vquiz-option-btn');
      buttons.forEach((btn, i) => {
        if (i === index) btn.classList.add('selected');
        else btn.classList.remove('selected');
      });
      const feedback = document.getElementById('vquizFeedback');
      if (feedback) feedback.style.display = 'none';
    }

    function checkVideoQuestion() {
      if (vquizActiveCheckpoint === null) return;
      const lesson = lessonsData[currentLesson];
      if (!lesson || !lesson.videoCheckpoints) return;
      const cp = lesson.videoCheckpoints[vquizActiveCheckpoint];
      const feedback = document.getElementById('vquizFeedback');

      if (vquizSelectedOption === null) {
        feedback.className = 'vquiz-feedback error';
        feedback.style.display = 'block';
        feedback.textContent = '⚠️ Por favor selecciona una de las opciones antes de comprobar.';
        return;
      }

      if (vquizSelectedOption === cp.correct) {
        markVquizAnswered(currentLesson, vquizActiveCheckpoint);
        feedback.className = 'vquiz-feedback success';
        feedback.style.display = 'block';
        feedback.innerHTML = `🎉 <strong>¡Excelente comprensión!</strong> ${cp.explanation}<br><span style="font-size:14px; font-weight:700;">+25 Puntos ganados en tu progreso ⭐</span>`;
        
        document.getElementById('vquizBtnSubmit').style.display = 'none';
        document.getElementById('vquizBtnContinue').style.display = 'inline-flex';
        document.getElementById('vquizBtnRewind').style.display = 'none';

        checkAllVideoCheckpointsCompleted(lesson);
      } else {
        feedback.className = 'vquiz-feedback error';
        feedback.style.display = 'block';
        feedback.innerHTML = `❌ <strong>Esa no es la respuesta correcta.</strong> Puedes repasar el fragmento reciente del video o intentarlo de nuevo.`;

        document.getElementById('vquizBtnRewind').style.display = 'inline-flex';
      }
    }

    function resumeVideoAfterQuiz() {
      const overlay = document.getElementById('videoQuizOverlay');
      if (overlay) overlay.classList.remove('active');
      vquizActiveCheckpoint = null;

      if (ytPlayer && typeof ytPlayer.playVideo === 'function') {
        ytPlayer.playVideo();
      }
    }

    function rewindVideoSegment() {
      const overlay = document.getElementById('videoQuizOverlay');
      if (overlay) overlay.classList.remove('active');
      
      const lesson = lessonsData[currentLesson];
      const cp = lesson && lesson.videoCheckpoints && lesson.videoCheckpoints[vquizActiveCheckpoint];
      vquizActiveCheckpoint = null;

      if (ytPlayer) {
        const targetSec = (cp && cp.rewindTo !== undefined) ? cp.rewindTo : Math.max(0, (cp ? cp.time : 15) - 15);
        if (typeof ytPlayer.seekTo === 'function') {
          ytPlayer.seekTo(targetSec, true);
        }
        if (typeof ytPlayer.playVideo === 'function') {
          ytPlayer.playVideo();
        }
      }
    }

    function skipVideoQuestion() {
      resumeVideoAfterQuiz();
    }

    function jumpToVideoCheckpoint(index) {
      const lesson = lessonsData[currentLesson];
      if (!lesson || !lesson.videoCheckpoints || !lesson.videoCheckpoints[index]) return;
      const cp = lesson.videoCheckpoints[index];

      if (ytPlayer && typeof ytPlayer.seekTo === 'function') {
        ytPlayer.seekTo(cp.time, true);
        ytPlayer.pauseVideo();
      }
      triggerVideoCheckpoint(index);
    }

    function toggleAutoPause(checked) {
      vquizAutoPause = checked;
    }

    function renderVquizBar(lessonId) {
      const container = document.getElementById('vquizChipsContainer');
      const scoreText = document.getElementById('vquizScoreText');
      if (!container) return;

      const lesson = lessonsData[lessonId];
      if (!lesson || !lesson.videoCheckpoints || lesson.videoCheckpoints.length === 0) {
        container.innerHTML = '<span style="font-size:14px; color:#64748b;">No hay puntos de control en esta lección.</span>';
        if (scoreText) scoreText.textContent = 'Sin cuestionario';
        return;
      }

      let completedCount = 0;
      const chipsHtml = lesson.videoCheckpoints.map((cp, idx) => {
        const answered = isVquizAnswered(lessonId, idx);
        if (answered) completedCount++;
        return `<button type="button" class="vquiz-chip-btn ${answered ? 'completed' : ''}" id="vquizChip_${idx}" onclick="jumpToVideoCheckpoint(${idx})" title="Clic para ir a este punto y responder">
          <span>${answered ? '✅' : '⏱️ ' + cp.timeLabel}</span>
          <span>Pregunta ${idx + 1}: ${cp.title.length > 34 ? cp.title.substring(0, 32) + '...' : cp.title}</span>
        </button>`;
      }).join('');

      container.innerHTML = chipsHtml;
      if (scoreText) {
        scoreText.textContent = `${completedCount}/${lesson.videoCheckpoints.length} superadas (+${completedCount * 25} XP)`;
      }
    }

    function checkAllVideoCheckpointsCompleted(lesson) {
      let allDone = true;
      lesson.videoCheckpoints.forEach((cp, idx) => {
        if (!isVquizAnswered(currentLesson, idx)) allDone = false;
      });

      if (allDone) {
        setTimeout(() => {
          const feedback = document.getElementById('vquizFeedback');
          if (feedback) {
            feedback.innerHTML += `<div style="margin-top:8px; padding-top:8px; border-top:1px dashed #6ee7b7; font-weight:700; color:#06402d;">🏆 ¡Felicitaciones! Has completado todas las preguntas de comprensión de este video.</div>`;
          }
        }, 300);
      }
    }

    // ============================================================
    // TABS Y NAVEGACIÓN GENERAL DE LECCIONES
    // ============================================================
    function switchLessonTab(tab) {
      const tabs = ['video', 'ejercicio', 'audio', 'libro', 'texto'];
      tabs.forEach(t => {
        const btn = document.getElementById('btnTab' + t.charAt(0).toUpperCase() + t.slice(1));
        const pane = document.getElementById('pane' + t.charAt(0).toUpperCase() + t.slice(1));
        if (btn) {
          if (t === tab) btn.classList.add('active');
          else btn.classList.remove('active');
        }
        if (pane) {
          if (t === tab) {
            pane.classList.add('active');
            pane.style.display = 'block';
          } else {
            pane.classList.remove('active');
            pane.style.display = 'none';
          }
        }
      });
    }

    let selectedOptionIndex = null;
    function selectExerciseOption(index) {
      selectedOptionIndex = index;
      const opts = document.querySelectorAll('.exercise-option');
      opts.forEach((el, idx) => {
        if (idx === index) el.classList.add('selected');
        else el.classList.remove('selected');
      });
      document.getElementById('exerciseFeedback').style.display = 'none';
    }

    function checkExercise() {
      const data = lessonsData[currentLesson];
      if (!data || !data.exercise) return;
      const feedback = document.getElementById('exerciseFeedback');
      if (selectedOptionIndex === null) {
        feedback.style.display = 'block';
        feedback.style.background = '#fef2f2';
        feedback.style.color = '#b91c1c';
        feedback.textContent = '⚠️ Por favor selecciona una opción antes de comprobar.';
        return;
      }
      feedback.style.display = 'block';
      if (selectedOptionIndex === data.exercise.correct) {
        feedback.style.background = '#ecfdf5';
        feedback.style.color = '#047857';
        feedback.innerHTML = '🎉 ' + data.exercise.explanation + '<br><strong>+50 Puntos ganados en tu progreso.</strong>';
      } else {
        feedback.style.background = '#fffbeb';
        feedback.style.color = '#b45309';
        feedback.textContent = '❌ Esa no es la respuesta correcta. Revisa el video o el resumen teórico e inténtalo de nuevo.';
      }
    }

    function togglePlayAudioDemo(btn) {
      if (!window.audioDemoActive) {
        window.audioDemoActive = true;
        btn.innerHTML = '⏸ Pausar episodio';
        btn.style.background = '#e11d48';
        if ('speechSynthesis' in window) {
          window.speechSynthesis.cancel();
          const title = document.getElementById('audioTitle').textContent;
          const desc = document.getElementById('audioDesc').textContent;
          const utter = new SpeechSynthesisUtterance('Reproduciendo episodio: ' + title + '. ' + desc);
          utter.lang = 'es-MX';
          window.speechSynthesis.speak(utter);
        }
      } else {
        window.audioDemoActive = false;
        btn.innerHTML = '▶ Reproducir episodio';
        btn.style.background = 'var(--verde-claro)';
        if ('speechSynthesis' in window) {
          window.speechSynthesis.cancel();
        }
      }
    }

    function downloadBookDemo() {
      const title = (document.getElementById('bookTitle') && document.getElementById('bookTitle').textContent) || 'Guia-Financiera';
      const author = (document.getElementById('bookAuthor') && document.getElementById('bookAuthor').textContent) || 'Educación Financiera';
      
      const content = '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>' + title + '<' + '/title>' +
        '<style>body{font-family:sans-serif;padding:40px;color:#1e293b;line-height:1.6;}h1{color:#00703C;}h2{color:#06402d;}ul{margin-bottom:20px;}li{margin-bottom:8px;}</style><' + '/head>' +
        '<body><h1>' + title + '<' + '/h1><h3>' + author + ' - Guía Oficial de Aprendizaje<' + '/h3>' +
        '<hr><p>Esta es la síntesis de estudio para el programa académico de Educación Financiera.<' + '/p>' +
        '<h2>5 Principios Clave:<' + '/h2><ul>' +
        '<li><strong>1. Diagnóstico de tu dinero:</strong> Conoce tu flujo neto antes de gastar.<' + '/li>' +
        '<li><strong>2. Fondo de paz mental:</strong> Construye de 3 a 6 meses de gastos esenciales.<' + '/li>' +
        '<li><strong>3. Control de deudas:</strong> Aplica el método Bola de Nieve o Avalancha.<' + '/li>' +
        '<li><strong>4. Inversión regulada:</strong> Empieza con CETES directo y ETFs como el S&P 500.<' + '/li>' +
        '<li><strong>5. Libertad financiera:</strong> Aplica la regla del 4% para retiro temprano.<' + '/li><' + '/ul>' +
        '<footer style="margin-top:40px;font-size:14px;color:#64748b;">© Educación Financiera. Todos los derechos reservados.<' + '/footer>' +
        '<' + '/body>' + '<' + '/html>';

      const blob = new Blob([content], { type: 'text/html' });
      const a = document.createElement('a');
      a.href = URL.createObjectURL(blob);
      a.download = title.replace(/[^a-zA-Z0-9]/g, '_') + '_Guia_Oficial.html';
      document.body.appendChild(a);
      a.click();
      document.body.removeChild(a);
      alert('📥 ¡Descarga iniciada! Se ha generado tu guía oficial en formato digital para consulta sin conexión.');
    }

    let currentLesson = 1;

    function selectLesson(id) {
      currentLesson = id;
      const data = lessonsData[id];
      if (!data) return;

      document.getElementById('playerTitle').textContent = data.title;
      document.getElementById('lessonTagText').textContent = data.tag;
      document.getElementById('lessonDuration').textContent = "Duración: " + data.duration;
      document.getElementById('playerBody').innerHTML = data.body;

      // Cerrar cualquier overlay de video activo
      const overlay = document.getElementById('videoQuizOverlay');
      if (overlay) overlay.classList.remove('active');
      vquizActiveCheckpoint = null;

      // Actualizar reproductor de video
      const targetUrl = formatYTUrlWithAPI(data.videoUrl);
      const videoId = getYouTubeVideoId(data.videoUrl);

      if (ytPlayer && typeof ytPlayer.loadVideoById === 'function' && videoId) {
        try {
          ytPlayer.loadVideoById(videoId);
        } catch(e) {
          const iframe = document.getElementById('lessonVideoIframe');
          if (iframe) iframe.src = targetUrl;
        }
      } else {
        const iframe = document.getElementById('lessonVideoIframe');
        if (iframe && data.videoUrl) {
          iframe.src = targetUrl;
        }
      }

      // Renderizar barra de checkpoints del video
      
      // Actualizar enlace externo de YouTube para abrir en otra pestaña
      const extBtn = document.getElementById('btnExternalVideo');
      if (extBtn) {
        if (data.externalUrl) {
          extBtn.href = data.externalUrl;
        } else if (videoId) {
          extBtn.href = 'https://www.youtube.com/watch?v=' + videoId;
        } else if (data.videoUrl) {
          extBtn.href = data.videoUrl;
        }
      }
      renderVquizBar(id);

      // Actualizar ejercicio
      selectedOptionIndex = null;
      document.getElementById('exerciseFeedback').style.display = 'none';
      if (data.exercise) {
        document.getElementById('exerciseTitle').textContent = data.exercise.title;
        document.getElementById('exerciseDesc').textContent = data.exercise.desc;
        const optHtml = data.exercise.options.map((opt, idx) => {
          return '<div class="exercise-option" onclick="selectExerciseOption(' + idx + ')"><span>📝</span> <span>' + opt + '</span></div>';
        }).join('');
        document.getElementById('exerciseOptionsContainer').innerHTML = optHtml;
      }

      // Actualizar audio
      if (data.audio) {
        document.getElementById('audioTitle').textContent = data.audio.title;
        document.getElementById('audioDuration').textContent = "Duración: " + data.audio.duration;
        document.getElementById('audioDesc').textContent = data.audio.desc;
      }

      // Actualizar libro
      if (data.book) {
        document.getElementById('bookTitle').textContent = data.book.title;
        document.getElementById('bookAuthor').textContent = "Autor: " + data.book.author;
        document.getElementById('bookDesc').textContent = data.book.desc;
      }

      // Volver a la pestaña de video por defecto
      switchLessonTab('video');
      document.getElementById('playerBody').style.display = 'block';
      const regGate = document.getElementById('registrationGate');
      if (regGate) regGate.style.display = 'none';

      for (let i = 1; i <= 8; i++) {
        const item = document.getElementById('itemLesson' + i);
        if (item) {
          if (i === id) item.classList.add('active');
          else item.classList.remove('active');
        }
      }

      const prevBtn = document.getElementById('btnPrevLesson');
      if (prevBtn) {
        prevBtn.disabled = (id === 1);
        prevBtn.style.opacity = (id === 1) ? "0.5" : "1";
      }
    }

    function stepLesson(direction) {
      const nextId = currentLesson + direction;
      if (nextId >= 1 && nextId <= 8) {
        selectLesson(nextId);
      }
    }

    function toggleUnit(unitId) {
      const list = document.getElementById(unitId + 'List');
      if (!list) return;
      list.style.display = (list.style.display === 'none') ? 'block' : 'none';
    }

    function tieneInscripcionActiva() {
      return true; // Siempre activa para libre aprendizaje
    }

    document.addEventListener("DOMContentLoaded", function() {
      selectLesson(1);
      // Inicializar YouTube si la API ya estuviese disponible
      if (window.YT && window.YT.Player) {
        initYouTubePlayer();
      }
    });
  </script>

<script src="public/js/script.js?v=<?= time() ?>"></script>
