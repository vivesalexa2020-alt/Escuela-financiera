<?php
/**
 * Vista: Inicio
 * Contenido migrado desde index.html (legacy/html).
 * Variables: $pageTitle, $pageCss, $bodyClass, $user
 */
?>
<!-- ============================================================
       SIDEBAR LATERAL IZQUIERDA (Aparece tras iniciar sesión)
       ============================================================ -->
  <?php include __DIR__ . '/../layouts/sidebar.php'; ?>

  <!-- Backdrop para cerrar sidebar en responsive -->
  <div class="sidebar-backdrop" id="sidebarBackdrop" onclick="toggleSidebar(false)"></div>

  <div class="main-wrapper" id="mainWrapper">
<!-- ============================================================
       SPLASH SCREEN — FONDO ILUSTRADO
       ============================================================ -->
  <div class="splash-screen" id="splashScreen">

    <!-- Halo solar -->
    <div class="splash-sun-halo"></div>

    <!-- Nubes flotantes -->
    <div class="splash-cloud c1"></div>
    <div class="splash-cloud c2"></div>
    <div class="splash-cloud c3"></div>


    <!-- Texto lateral IZQUIERDO -->
    <span class="splash-side left">Grandes<br>metas</span>
    <!-- Texto lateral DERECHO -->
    <span class="splash-side right">Mejores<br>decisiones</span>

    <!-- Contenedor centrado con el logo y los textos -->
    <div class="splash-inner">

      <!-- ── ILUSTRACIÓN: Libro animado con hojas volteándose ── -->
      <div class="splash-book-wrap">
        <!-- Birrete flotante arriba -->
        <div class="splash-cap">🎓</div>

        <!-- Libro 3D con páginas animadas -->
        <div class="splash-book" aria-label="Libro de educación financiera">
          <!-- Tapa izquierda (portada) -->
          <div class="book-cover-left">
            <span class="book-cover-icon">💰</span>
            <span class="book-cover-title">Finanzas</span>
          </div>

          <!-- Lomo -->
          <div class="book-spine"></div>

          <!-- Tapa derecha (contraportada) -->
          <div class="book-cover-right">
            <span class="book-cover-icon">📈</span>
          </div>

          <!-- Páginas que se voltean (animadas en secuencia) -->
          <div class="book-page page-1">
            <div class="page-front">
              <span class="page-icon">💡</span>
              <span class="page-text">Hábitos<br>Atómicos</span>
            </div>
            <div class="page-back">
              <span class="page-icon">🎯</span>
              <span class="page-text">Metas<br>Claras</span>
            </div>
          </div>

          <div class="book-page page-2">
            <div class="page-front">
              <span class="page-icon">📊</span>
              <span class="page-text">Ahorra<br>el 1%</span>
            </div>
            <div class="page-back">
              <span class="page-icon">🏦</span>
              <span class="page-text">Crece<br>Día a Día</span>
            </div>
          </div>

          <div class="book-page page-3">
            <div class="page-front">
              <span class="page-icon">✅</span>
              <span class="page-text">Buenos<br>Hábitos</span>
            </div>
            <div class="page-back">
              <span class="page-icon">🚀</span>
              <span class="page-text">¡Tú<br>Puedes!</span>
            </div>
          </div>

          <div class="book-page page-4">
            <div class="page-front">
              <span class="page-icon">💸</span>
              <span class="page-text">Invierte<br>Hoy</span>
            </div>
            <div class="page-back">
              <span class="page-icon">⭐</span>
              <span class="page-text">Éxito<br>Financiero</span>
            </div>
          </div>
        </div>

        <!-- Partículas decorativas flotantes -->
        <span class="splash-particle p1">$</span>
        <span class="splash-particle p2">%</span>
        <span class="splash-particle p3">📈</span>
        <span class="splash-particle p4">💎</span>
      </div>

      <!-- Título -->
      <div class="splash-textblock">
        <span class="edu">Educación</span>
        <span class="fin">Financiera</span>
      </div>

      <!-- Botón amarillo -->
      <div class="splash-tagline">¡Haz la prueba!</div>

      <!-- Barra de progreso -->
      <div class="splash-bar"><i></i></div>

      <!-- Saltar -->
      <button class="splash-skip" onclick="hideSplash()">Continuar al sitio</button>
    </div>

  </div>
  <!-- FIN SPLASH -->

      <!-- HEADER -->
  <header class="site-header hero-header-bar">
    <div class="container nav-wrap hero-nav-wrap">
      <div class="hero-brand-group">
        <button class="home-sidebar-toggle" onclick="toggleSidebar()" aria-label="Abrir menú lateral">
          <span class="h-bar"></span>
          <span class="h-bar"></span>
          <span class="h-bar"></span>
        </button>
        <a href="index.php" class="brand-logo hero-brand">
          <svg viewBox="0 0 240 210" width="34" height="30" role="img" aria-label="Logo Sombrero de Graduación con Libros">
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
          <span>Educación <strong>Financiera</strong></span>
        </a>
      </div>

      <!-- Badge central superior (escritorio y tablets) -->
      <div class="header-center-pill">
        <span class="hero-top-badge">✨ ¡RESULTADOS REALES, COMPROBADOS!</span>
      </div>

      <!-- Botones de acceso en header principal -->
      <div style="display: flex; align-items: center; gap: 10px;">
        <?php if (!empty($user)): ?>
          <a href="index.php?page=aula" class="topbar-admin-btn topbar-aula-btn" title="Entrar al aula virtual">
            🎓 Ingresar al aula virtual
          </a>
        <?php endif; ?>
        <?php if (!empty($user) && ($user['rol'] ?? '') === 'admin'): ?>
          <a href="index.php?page=admin" class="topbar-admin-btn" title="Panel de Administración">
            🛡️ Acceso Admin
          </a>
        <?php elseif (empty($user)): ?>
          <a href="index.php?page=reticula#login" class="topbar-admin-btn" id="btnAccesoAdmin" title="Iniciar sesión como Administrador">
            🛡️ Acceso Admin
          </a>
        <?php endif; ?>
      </div>

    </div>
  </header>

  <main>
    <!-- ============================================================
         1. HERO SUPERIOR: HISTORIAS DE ÉXITO REALES (DISEÑO ADAPTADO CON ANIMACIÓN)
         ============================================================ -->
    <section class="success-hero-section" id="testimonios">
      <!-- Fondo decorativo con ondas y destellos -->
      <div class="hero-ambient-glow"></div>
      
      <!-- Cinta / onda de luz animada que recorre el fondo -->
      <svg class="hero-light-wave" viewBox="0 0 1440 380" preserveAspectRatio="none" aria-hidden="true">
        <defs>
          <linearGradient id="waveLightGrad" x1="0%" y1="0%" x2="100%" y2="0%">
            <stop offset="0%" stop-color="#28c76f" stop-opacity="0.15"/>
            <stop offset="35%" stop-color="#f5b800" stop-opacity="0.45"/>
            <stop offset="65%" stop-color="#28c76f" stop-opacity="0.55"/>
            <stop offset="85%" stop-color="#f5b800" stop-opacity="0.65"/>
            <stop offset="100%" stop-color="#28c76f" stop-opacity="0.2"/>
          </linearGradient>
          <filter id="waveBlur" x="-10%" y="-40%" width="120%" height="200%">
            <feGaussianBlur stdDeviation="16"/>
          </filter>
        </defs>
        <!-- Resplandor difuso animado -->
        <path class="wave-glow-path" d="M-60,190 C180,90 280,290 520,230 C760,170 920,280 1140,210 C1300,160 1380,80 1500,110"
              fill="none" stroke="url(#waveLightGrad)" stroke-width="48" filter="url(#waveBlur)" opacity="0.65"/>
        <!-- Cinta visible nítida -->
        <path class="wave-core-path" d="M-60,190 C180,90 280,290 520,230 C760,170 920,280 1140,210 C1300,160 1380,80 1500,110"
              fill="none" stroke="url(#waveLightGrad)" stroke-width="4" stroke-linecap="round" opacity="0.95"/>
      </svg>

      <!-- Elemento Flotante IZQUIERDO: Globo 3D, monedas y lingote de oro -->
      <div class="hero-floating-left" aria-hidden="true">
        <!-- Globo terráqueo 3D metálico con flotación suave -->
        <div class="floating-globe-wrap">
          <svg class="globe-3d-svg" viewBox="0 0 160 160" width="130" height="130">
            <defs>
              <radialGradient id="globeSpherical" cx="35%" cy="30%" r="65%">
                <stop offset="0%" stop-color="#2ee88a"/>
                <stop offset="30%" stop-color="#148354"/>
                <stop offset="70%" stop-color="#07442a"/>
                <stop offset="100%" stop-color="#021c11"/>
              </radialGradient>
              <radialGradient id="globeHighlight" cx="30%" cy="25%" r="40%">
                <stop offset="0%" stop-color="rgba(255,255,255,0.45)"/>
                <stop offset="60%" stop-color="rgba(255,255,255,0)"/>
              </radialGradient>
              <filter id="globeGlow" x="-20%" y="-20%" width="140%" height="140%">
                <feDropShadow dx="0" dy="6" stdDeviation="12" flood-color="rgba(40,199,111,0.3)"/>
              </filter>
            </defs>
            <circle cx="80" cy="80" r="66" fill="url(#globeSpherical)" filter="url(#globeGlow)"/>
            <ellipse cx="80" cy="80" rx="66" ry="24" fill="none" stroke="rgba(255,255,255,0.18)" stroke-width="1.2"/>
            <ellipse cx="80" cy="80" rx="26" ry="66" fill="none" stroke="rgba(255,255,255,0.18)" stroke-width="1.2"/>
            <line x1="14" y1="80" x2="146" y2="80" stroke="rgba(255,255,255,0.22)" stroke-width="1.2"/>
            <path d="M50 40 Q62 30 76 38 Q88 44 94 36 Q100 48 90 62 Q74 68 62 60 Q52 52 50 40 Z" fill="#bcf5d6" opacity="0.6"/>
            <path d="M44 82 Q56 74 68 84 Q76 96 66 114 Q52 110 44 98 Z" fill="#bcf5d6" opacity="0.55"/>
            <path d="M102 65 Q118 70 126 86 Q118 104 106 98 Q96 85 102 65 Z" fill="#bcf5d6" opacity="0.55"/>
            <circle cx="80" cy="80" r="66" fill="url(#globeHighlight)"/>
            <circle class="globe-rim-pulse" cx="80" cy="80" r="66" fill="none" stroke="rgba(40,199,111,0.6)" stroke-width="1.5"/>
          </svg>
        </div>

        <!-- Monedas de oro flotantes izquierda -->
        <div class="floating-coin-1">
          <svg viewBox="0 0 54 54" width="44" height="44">
            <defs>
              <linearGradient id="coinGrad1" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" stop-color="#fff2a8"/>
                <stop offset="40%" stop-color="#f5b800"/>
                <stop offset="85%" stop-color="#b87a00"/>
              </linearGradient>
            </defs>
            <ellipse cx="27" cy="27" rx="24" ry="18" fill="url(#coinGrad1)" stroke="#ffe47a" stroke-width="2"/>
            <ellipse cx="27" cy="27" rx="19" ry="14" fill="none" stroke="#8c5800" stroke-width="1.2" stroke-dasharray="3 1.5"/>
            <text x="27" y="31" font-size="13" font-weight="900" fill="#6e4200" text-anchor="middle" font-family="'Poppins', sans-serif">$</text>
          </svg>
        </div>
        <div class="floating-coin-2">
          <svg viewBox="0 0 42 42" width="32" height="32">
            <ellipse cx="21" cy="21" rx="18" ry="13" fill="url(#coinGrad1)" stroke="#ffe47a" stroke-width="1.5"/>
            <ellipse cx="21" cy="21" rx="14" ry="10" fill="none" stroke="#8c5800" stroke-width="1"/>
            <text x="21" y="24" font-size="10" font-weight="900" fill="#6e4200" text-anchor="middle" font-family="'Poppins', sans-serif">$</text>
          </svg>
        </div>

        <!-- Lingote de oro 3D -->
        <div class="floating-gold-bar">
          <svg viewBox="0 0 90 46" width="76" height="40">
            <defs>
              <linearGradient id="ingotTop" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" stop-color="#fff5b8"/>
                <stop offset="40%" stop-color="#fbd042"/>
                <stop offset="100%" stop-color="#d49200"/>
              </linearGradient>
              <linearGradient id="ingotFront" x1="0%" y1="0%" x2="0%" y2="100%">
                <stop offset="0%" stop-color="#d49200"/>
                <stop offset="100%" stop-color="#7a4e00"/>
              </linearGradient>
              <linearGradient id="ingotSide" x1="0%" y1="0%" x2="100%" y2="0%">
                <stop offset="0%" stop-color="#f0b818"/>
                <stop offset="100%" stop-color="#a66a00"/>
              </linearGradient>
            </defs>
            <polygon points="20,6 74,6 64,22 10,22" fill="url(#ingotTop)" stroke="#fff8cf" stroke-width="0.8"/>
            <polygon points="10,22 64,22 56,40 2,40" fill="url(#ingotFront)"/>
            <polygon points="64,22 74,6 84,24 74,40 56,40" fill="url(#ingotSide)"/>
            <text x="42" y="16" font-size="6.5" font-weight="800" fill="#7d5000" text-anchor="middle" letter-spacing="1">999.9 GOLD</text>
          </svg>
        </div>
      </div>

      <!-- Elemento Flotante DERECHO: Flecha ascendente, estrellas y Medalla de oro 3D -->
      <div class="hero-floating-right" aria-hidden="true">
        <!-- Flecha ascendente con destellos -->
        <div class="floating-growth-arrow">
          <svg viewBox="0 0 90 90" width="70" height="70">
            <defs>
              <linearGradient id="arrowGrad" x1="0%" y1="100%" x2="100%" y2="0%">
                <stop offset="0%" stop-color="#28c76f" stop-opacity="0.2"/>
                <stop offset="50%" stop-color="#f5b800"/>
                <stop offset="100%" stop-color="#fff3a8"/>
              </linearGradient>
            </defs>
            <path class="arrow-path-anim" d="M10,80 C30,70 50,45 72,18" fill="none" stroke="url(#arrowGrad)" stroke-width="4.5" stroke-linecap="round"/>
            <polyline class="arrow-head-anim" points="52,16 74,16 74,38" fill="none" stroke="#fff3a8" stroke-width="4.5" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>

        <!-- Estrellas doradas destellantes -->
        <span class="hero-star star-s1">✦</span>
        <span class="hero-star star-s2">✦</span>
        <span class="hero-star star-s3">✦</span>

        <!-- Moneda flotante derecha -->
        <div class="floating-coin-3">
          <svg viewBox="0 0 44 44" width="36" height="36">
            <ellipse cx="22" cy="22" rx="19" ry="14" fill="url(#coinGrad1)" stroke="#ffe47a" stroke-width="1.8"/>
            <ellipse cx="22" cy="22" rx="14" ry="10" fill="none" stroke="#8c5800" stroke-width="1.2"/>
            <text x="22" y="26" font-size="11" font-weight="900" fill="#6e4200" text-anchor="middle">$</text>
          </svg>
        </div>

        <!-- Medalla de oro 3D con listón oficial -->
        <div class="floating-medal-wrap">
          <svg class="gold-medal-svg" viewBox="0 0 150 180" width="130" height="156">
            <defs>
              <radialGradient id="medalRadial" cx="40%" cy="35%" r="65%">
                <stop offset="0%" stop-color="#fff8c4"/>
                <stop offset="25%" stop-color="#ffd54f"/>
                <stop offset="60%" stop-color="#f5b800"/>
                <stop offset="90%" stop-color="#b87800"/>
                <stop offset="100%" stop-color="#734700"/>
              </radialGradient>
              <linearGradient id="ribbonLeftGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" stop-color="#d49200"/>
                <stop offset="50%" stop-color="#f5b800"/>
                <stop offset="100%" stop-color="#8a5300"/>
              </linearGradient>
              <linearGradient id="ribbonRightGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" stop-color="#b87800"/>
                <stop offset="50%" stop-color="#e5a700"/>
                <stop offset="100%" stop-color="#6e3e00"/>
              </linearGradient>
              <filter id="medalShadow" x="-20%" y="-10%" width="140%" height="130%">
                <feDropShadow dx="0" dy="8" stdDeviation="10" flood-color="rgba(0,0,0,0.45)"/>
                <feDropShadow dx="0" dy="0" stdDeviation="15" flood-color="rgba(245,184,0,0.4)"/>
              </filter>
            </defs>

            <!-- Listones colgantes -->
            <polygon class="medal-ribbon-l" points="56,92 40,165 58,152 74,165 68,92" fill="url(#ribbonLeftGrad)" stroke="#ffd766" stroke-width="1"/>
            <polygon class="medal-ribbon-r" points="82,92 76,165 92,152 110,165 94,92" fill="url(#ribbonRightGrad)" stroke="#ffd766" stroke-width="1"/>

            <!-- Medallón dentado -->
            <g class="medal-rosette-group" filter="url(#medalShadow)">
              <circle cx="75" cy="72" r="54" fill="url(#medalRadial)"/>
              <path d="
                M 75 14 L 79 21 L 87 16 L 89 25 L 98 22 L 98 31 L 107 31 L 104 40 L 113 42 L 108 50 L 115 53 L 108 61 L 114 66 L 105 72 L 110 79 L 100 83 L 102 92 L 92 93 L 92 102 L 83 100 L 80 109 L 72 104 L 67 112 L 61 105 L 54 111 L 51 102 L 42 106 L 41 97 L 32 98 L 34 89 L 25 87 L 29 79 L 21 74 L 27 68 L 21 61 L 28 57 L 24 49 L 32 47 L 30 38 L 39 38 L 39 29 L 48 31 L 51 22 L 59 26 L 64 18 L 71 23 Z"
                fill="url(#medalRadial)" stroke="#fff2a8" stroke-width="1.5"/>

              <circle cx="75" cy="72" r="42" fill="none" stroke="#fff8cf" stroke-width="2.5" stroke-dasharray="3 1.5"/>
              <circle cx="75" cy="72" r="38" fill="url(#medalRadial)"/>

              <!-- Estrella central 3D -->
              <polygon points="75,44 83,62 102,62 87,74 93,92 75,81 57,92 63,74 48,62 67,62" fill="#fff5b8"/>
              <polygon points="75,44 83,62 75,70" fill="#ffffff"/>
              <polygon points="83,62 102,62 87,74 75,70" fill="#f5b800"/>
              <polygon points="87,74 93,92 75,81 75,70" fill="#c48000"/>
              <polygon points="75,81 57,92 63,74 75,70" fill="#e09c00"/>
              <polygon points="63,74 48,62 67,62 75,70" fill="#ffd966"/>
            </g>
          </svg>
        </div>
      </div>

      <div class="container hero-content-container">

        <!-- ENCABEZADO Y TÍTULOS CON ANIMACIÓN DE ENTRADA -->
        <div class="success-header hero-fade-in-entry">
          <h1 class="hero-title">
            Personas reales que recuperaron su<br>
            paz y transformaron sus finanzas
          </h1>
          <p class="hero-paragraph">
            Aquí no hay fórmulas mágicas ni promesas vacías. Descubre cómo personas con ingresos comunes <span class="hero-highlight">lograron liquidar deudas</span> y crear <span class="hero-highlight">ahorros de emergencia</span> con nuestro método práctico, y <span class="hero-highlight">empezar a invertir. <svg class="inline-arrow-icon" viewBox="0 0 14 14" width="13" height="13"><path d="M2.5 11.5L11.5 2.5M11.5 2.5H4.5M11.5 2.5V9.5" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
          </p>
        </div>

        <!-- FILA DE 3 TARJETAS PRINCIPALES CON ANIMACIÓN INTERACTIVA -->
        <div class="hero-cards-grid">

          <!-- TARJETA 1: Carrera de 18 Meses -->
          <div class="hero-card hero-card-timeline">
            <div class="hcard-header">
              <span class="hcard-icon">⏳</span>
              <span class="hcard-title">Carrera de 18 Meses</span>
            </div>
            <div class="hcard-body timeline-body">
              <!-- Línea de tiempo -->
              <div class="timeline-visual">
                <div class="timeline-bar">
                  <div class="timeline-fill"></div>
                  <!-- Punto 1 -->
                  <div class="tl-point tl-p1">
                    <span class="tl-dot"></span>
                    <span class="tl-tag">Nivel 1:<br><small>Fundamentos</small></span>
                  </div>
                  <!-- Punto 2: Con resplandor especial pulsante -->
                  <div class="tl-point tl-p2 tl-active-node">
                    <span class="tl-flare-halo"></span>
                    <span class="tl-flare-ring-pulse"></span>
                    <span class="tl-dot tl-dot-flare"></span>
                    <span class="tl-tag">Nivel 2:<br><small>Plan de Acción</small></span>
                  </div>
                  <!-- Punto 3 -->
                  <div class="tl-point tl-p3">
                    <span class="tl-dot"></span>
                    <span class="tl-tag">Nivel 3:<br><small>Inversión</small></span>
                  </div>
                </div>
              </div>

              <!-- Reloj de arena 3D con animación de arena fluyendo -->
              <div class="hourglass-visual">
                <svg viewBox="0 0 76 112" width="62" height="92" class="hg-svg">
                  <defs>
                    <linearGradient id="hgGold" x1="0%" y1="0%" x2="100%" y2="0%">
                      <stop offset="0%" stop-color="#9C6B00"/>
                      <stop offset="35%" stop-color="#FFDF66"/>
                      <stop offset="70%" stop-color="#F5B800"/>
                      <stop offset="100%" stop-color="#734700"/>
                    </linearGradient>
                    <radialGradient id="hgSand" cx="50%" cy="50%" r="50%">
                      <stop offset="0%" stop-color="#FFF5B8"/>
                      <stop offset="50%" stop-color="#F5B800"/>
                      <stop offset="100%" stop-color="#C27A00"/>
                    </radialGradient>
                  </defs>
                  <!-- Platos dorados superior e inferior -->
                  <rect x="6" y="4" width="64" height="7" rx="3.5" fill="url(#hgGold)" stroke="#FFF2A8" stroke-width="0.8"/>
                  <rect x="6" y="101" width="64" height="7" rx="3.5" fill="url(#hgGold)" stroke="#FFF2A8" stroke-width="0.8"/>
                  <!-- Columnas laterales -->
                  <rect x="10" y="8" width="4" height="96" rx="2" fill="url(#hgGold)"/>
                  <rect x="62" y="8" width="4" height="96" rx="2" fill="url(#hgGold)"/>
                  <!-- Vidrio del reloj -->
                  <path d="M 16 11 Q 16 46 36 55 Q 38 56 40 56 Q 42 56 44 55 Q 60 46 60 11 Z" fill="rgba(255,255,255,0.08)" stroke="rgba(255,255,255,0.4)" stroke-width="1.2"/>
                  <path d="M 16 101 Q 16 66 36 57 Q 38 56 40 56 Q 42 56 44 57 Q 60 66 60 101 Z" fill="rgba(255,255,255,0.08)" stroke="rgba(255,255,255,0.4)" stroke-width="1.2"/>
                  <!-- Arena superior -->
                  <path d="M 22 24 Q 38 28 54 24 Q 48 42 40 54 Q 32 42 22 24 Z" fill="url(#hgSand)" opacity="0.85"/>
                  <!-- Hilo de arena animado en caída continua -->
                  <line class="hg-sand-stream" x1="38" y1="55" x2="38" y2="84" stroke="#FFF2A8" stroke-width="2"/>
                  <!-- Montículo de arena inferior con suave resplandor -->
                  <path class="hg-sand-bottom" d="M 20 100 Q 38 78 56 100 Z" fill="url(#hgSand)"/>
                  <!-- Brillo del cristal -->
                  <path d="M 20 14 Q 18 34 26 46" fill="none" stroke="rgba(255,255,255,0.6)" stroke-width="1.8" stroke-linecap="round"/>
                  <path d="M 20 98 Q 18 78 26 66" fill="none" stroke="rgba(255,255,255,0.6)" stroke-width="1.8" stroke-linecap="round"/>
                </svg>
                <div class="hg-badge">
                  <span>Nivel 3: Libertad</span>
                </div>
              </div>
            </div>
          </div>

          <!-- TARJETA 2: 3 Niveles -->
          <div class="hero-card hero-card-levels">
            <div class="hcard-header">
              <span class="hcard-icon">🎓</span>
              <span class="hcard-title">3 Niveles</span>
            </div>
            <div class="hcard-body levels-body">
              <!-- Viñetas izquierda -->
              <ul class="levels-bullets">
                <li class="bullet-item"><span class="bullet-gold">•</span> Temas detalles</li>
                <li class="bullet-item"><span class="bullet-gold">•</span> Testeos cortos</li>
                <li class="bullet-item"><span class="bullet-gold">•</span> Temas de caminos</li>
              </ul>

              <!-- Pirámide 3D escalonada con cursor animado e interactividad -->
              <div class="pyramid-visual">
                <svg viewBox="0 0 116 100" width="105" height="90" class="pyr-svg">
                  <defs>
                    <linearGradient id="pyrTop" x1="0%" y1="0%" x2="100%" y2="0%">
                      <stop offset="0%" stop-color="#C28700"/>
                      <stop offset="50%" stop-color="#FFECA0"/>
                      <stop offset="100%" stop-color="#E5A400"/>
                    </linearGradient>
                    <linearGradient id="pyrMid" x1="0%" y1="0%" x2="100%" y2="0%">
                      <stop offset="0%" stop-color="#0E583B"/>
                      <stop offset="45%" stop-color="#2FD57B"/>
                      <stop offset="70%" stop-color="#F5B800"/>
                      <stop offset="100%" stop-color="#0B4B31"/>
                    </linearGradient>
                    <linearGradient id="pyrBot" x1="0%" y1="0%" x2="100%" y2="0%">
                      <stop offset="0%" stop-color="#083824"/>
                      <stop offset="50%" stop-color="#146643"/>
                      <stop offset="100%" stop-color="#062B1C"/>
                    </linearGradient>
                    <filter id="pyrShadow" x="-20%" y="-20%" width="140%" height="140%">
                      <feDropShadow dx="0" dy="2" stdDeviation="3" flood-color="rgba(0,0,0,0.45)"/>
                    </filter>
                  </defs>

                  <!-- Nivel 3: Avanzado -->
                  <g class="pyr-tier tier-top" filter="url(#pyrShadow)" title="Nivel Avanzado">
                    <polygon points="58,6 40,32 76,32" fill="url(#pyrTop)" stroke="#FFECA0" stroke-width="0.8"/>
                    <text x="58" y="24" text-anchor="middle" font-size="8.5" font-weight="700" fill="#261700" font-family="'Poppins', sans-serif">Avanzado</text>
                  </g>

                  <!-- Nivel 2: Intermedio con cursor encima -->
                  <g class="pyr-tier pyr-active tier-mid" filter="url(#pyrShadow)" title="Nivel Intermedio">
                    <polygon points="38,36 22,63 94,63 78,36" fill="url(#pyrMid)" stroke="#81F7BE" stroke-width="0.9"/>
                    <text x="58" y="53" text-anchor="middle" font-size="9" font-weight="700" fill="#ffffff" font-family="'Poppins', sans-serif">Intermedio</text>
                  </g>

                  <!-- Nivel 1: Básico -->
                  <g class="pyr-tier tier-bot" filter="url(#pyrShadow)" title="Nivel Básico">
                    <polygon points="20,67 4,94 112,94 96,67" fill="url(#pyrBot)" stroke="#28C76F" stroke-width="0.9"/>
                    <text x="58" y="84" text-anchor="middle" font-size="9.5" font-weight="700" fill="#C4F5DA" font-family="'Poppins', sans-serif">Básico</text>
                  </g>

                  <!-- Cursor puntero descansando en Intermedio con animación suave de pulsación -->
                  <g class="pyr-hand-cursor">
                    <path d="M0,0 L3,10 L6,7 L9,13 L11.5,12 L8.5,6 L12.5,5.5 Z" fill="#ffffff" stroke="#111111" stroke-width="1.2" stroke-linejoin="round"/>
                  </g>
                </svg>
              </div>
            </div>
          </div>

</div>

      </div>
    </section>

<!-- ══════════════════════════════════════════════════════
<!-- ══════════════════════════════════════════════════════
     SECCIÓN NUESTROS ESTUDIANTES (TODO EN ESPAÑOL + FOTOS)
     ══════════════════════════════════════════════════════ -->
<section class="m-estudiantes" id="estudiantes">
  <div class="container">

    <!-- Header de sección -->
    <div class="m-est-header">
      <div class="m-est-header-left">
        <div class="m-est-icon">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        </div>
        <div>
          <h2 class="m-est-title">Comunidad y <span class="m-accent">opiniones de estudiantes</span></h2>
          <p class="m-est-sub">Historias de éxito reales, avance en el programa y opiniones verificadas de nuestra comunidad.</p>
        </div>
      </div>
      <div class="m-est-header-right">
        <div class="m-ya-badge">
          Ellos ya<br>lo lograron,<br><strong>¿y tú?</strong>
          <svg class="m-ya-arrow" viewBox="0 0 60 50" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M5 45 C25 45 45 25 55 5" stroke="#28C76F" stroke-width="3" stroke-linecap="round"/>
            <path d="M48 3 L55 5 L50 12" stroke="#28C76F" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>
      </div>
    </div>

    <!-- ── BARRA SUPERIOR DE MÉTRICAS (100% EN ESPAÑOL) ── -->
    <div class="students-kpi-bar">
      <!-- KPI 1: Curso activo -->
      <div class="kpi-card">
        <div class="kpi-icon-wrap" style="color:#059669; background:#ecfdf5;">
          📖
        </div>
        <div class="kpi-content">
          <div class="kpi-header-row">
            <span class="kpi-label">Curso activo</span>
            <span class="kpi-value-tag">65% completado</span>
          </div>
          <div class="kpi-sub">Hábitos Atómicos & Finanzas</div>
          <div class="kpi-progress-bar">
            <div class="kpi-progress-fill" style="width: 65%;"></div>
          </div>
        </div>
      </div>

      <!-- KPI 2: Nivel de logros -->
      <div class="kpi-card">
        <div class="kpi-icon-wrap" style="color:#d97706; background:#fef3c7;">
          🏆
        </div>
        <div class="kpi-content">
          <div class="kpi-header-row">
            <span class="kpi-label">Nivel de logros</span>
            <span class="kpi-value-tag">3 de 5 metas</span>
          </div>
          <div class="kpi-sub">Metas alcanzadas y certificaciones</div>
          <div class="kpi-progress-bar">
            <div class="kpi-progress-fill" style="width: 60%; background: linear-gradient(90deg,#f59e0b,#d97706);"></div>
          </div>
        </div>
      </div>

      <!-- KPI 3: Puntos y Reconocimientos -->
      <div class="kpi-card">
        <div class="kpi-icon-wrap" style="color:#2563eb; background:#eff6ff;">
          🎖️
        </div>
        <div class="kpi-content">
          <div class="kpi-header-row">
            <span class="kpi-label">Puntos y reconocimientos</span>
            <span class="kpi-value-tag" style="color:#1d4ed8;">1,520 pts</span>
          </div>
          <div class="kpi-sub">Nivel 4 • Rango Avanzado</div>
          <div class="kpi-progress-bar">
            <div class="kpi-progress-fill" style="width: 78%; background: linear-gradient(90deg,#3b82f6,#1d4ed8);"></div>
          </div>
        </div>
      </div>
    </div>

    <!-- ── GRID DE ESTUDIANTES A ANCHO COMPLETO (SIN COLUMNA DERECHA) ── -->
    <div class="students-cards-full-grid">

      <!-- Tarjeta 1: Mariana González -->
      <div class="mock-student-card" onclick="openStudentTestimonial('mariana')" style="cursor: pointer;" title="Clic para ver testimonio en video">
        <div class="msc-header">
          <span class="msc-medal" title="Medalla de Oro">🥇</span>
          <div class="msc-avatar-wrap">
            <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=160&auto=format&fit=crop&q=80" alt="Mariana González" loading="lazy" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
            <div class="msc-avatar-placeholder" style="display:none; background: linear-gradient(135deg, #00b4b4, #008080);">
              MG
            </div>
          </div>
        </div>
        <div class="msc-body">
          <h4 class="msc-name">Mariana González</h4>
          <div class="msc-role">29 años • Independiente</div>
          <p class="msc-quote">
            "Siempre creí que la educación financiera era para ricos o cursos de vendehumos. Esta plataforma me dio plantillas simples que apliqué de inmediato. Pasé de no saber a dónde se iba mi dinero a invertir mensualmente."
          </p>
          <div class="msc-chart-row">
            <div class="msc-metrics-texts">
              <span>Ahorro mensual:</span>
              <strong>+35% ingresos</strong>
            </div>
            <!-- Mini Sparkline SVG -->
            <svg class="msc-chart-svg" viewBox="0 0 70 28" fill="none">
              <path d="M2 24 C15 22, 25 14, 38 16 C50 18, 58 6, 68 4" stroke="#10b981" stroke-width="2.5" stroke-linecap="round"/>
              <path d="M2 24 C15 22, 25 14, 38 16 C50 18, 58 6, 68 4 L68 28 L2 28 Z" fill="rgba(16,185,129,0.12)"/>
            </svg>
          </div>
          <div class="msc-actions-row">
            <button type="button" class="msc-action-btn" onclick="toggleLike(this); event.stopPropagation();">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
              <span>Me gusta</span> <span class="like-count">48</span>
            </button>
            <button type="button" class="msc-action-btn" onclick="openStudentTestimonial('mariana'); event.stopPropagation();">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
              <span>Comentarios</span> <span>14</span>
            </button>
            <span title="Logro Verificado" style="font-size:18px;">🌱</span>
          </div>
        </div>
      </div>

      <!-- Tarjeta 2: Jorge Martínez -->
      <div class="mock-student-card" onclick="openStudentTestimonial('jorge')" style="cursor: pointer;" title="Clic para ver testimonio en video">
        <div class="msc-header">
          <span class="msc-medal" title="Medalla de Plata">🥈</span>
          <div class="msc-avatar-wrap">
            <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?w=160&auto=format&fit=crop&q=80" alt="Jorge Martínez" loading="lazy" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
            <div class="msc-avatar-placeholder" style="display:none; background: linear-gradient(135deg, #9b59b6, #6c3483);">
              JM
            </div>
          </div>
        </div>
        <div class="msc-body">
          <h4 class="msc-name">Jorge Martínez</h4>
          <div class="msc-role">Vendedor • 28 años</div>
          <p class="msc-quote">
            "Pasaba de comisión en comisión sin guardar nada y ahora ya tengo mi fondo de emergencia. El curso me enseñó a planear, ser constante y entender lo que el cliente realmente necesita."
          </p>
          <div class="msc-chart-row">
            <div class="msc-metrics-texts">
              <span>Fondo de emergencia:</span>
              <strong>6 meses listos</strong>
            </div>
            <!-- Mini Sparkline SVG -->
            <svg class="msc-chart-svg" viewBox="0 0 70 28" fill="none">
              <path d="M2 22 C18 20, 30 10, 45 12 C54 14, 60 4, 68 2" stroke="#10b981" stroke-width="2.5" stroke-linecap="round"/>
              <path d="M2 22 C18 20, 30 10, 45 12 C54 14, 60 4, 68 2 L68 28 L2 28 Z" fill="rgba(16,185,129,0.12)"/>
            </svg>
          </div>
          <div class="msc-actions-row">
            <button type="button" class="msc-action-btn" onclick="toggleLike(this); event.stopPropagation();">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
              <span>Me gusta</span> <span class="like-count">35</span>
            </button>
            <button type="button" class="msc-action-btn" onclick="openStudentTestimonial('jorge'); event.stopPropagation();">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
              <span>Comentarios</span> <span>9</span>
            </button>
            <span title="Control Financiero Logrado" style="font-size:18px;">📊</span>
          </div>
        </div>
      </div>

      <!-- Tarjeta 3: Ana López -->
      <div class="mock-student-card" onclick="openStudentTestimonial('ana')" style="cursor: pointer;" title="Clic para ver testimonio en video">
        <div class="msc-header">
          <span class="msc-medal" title="Insignia de Excelencia">🎖️</span>
          <div class="msc-avatar-wrap">
            <img src="https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=240&auto=format&fit=crop&q=80" alt="Ana López" loading="lazy" onerror="if(!this.dataset.fallback){this.dataset.fallback=1; this.src='https://images.unsplash.com/photo-1582750433449-648ed127bb54?w=240&auto=format&fit=crop&q=80';} else { this.style.display='none'; this.nextElementSibling.style.display='flex'; }">
            <div class="msc-avatar-placeholder" style="display:none; background: linear-gradient(135deg, #e74c3c, #a93226);">
              AL
            </div>
          </div>
        </div>
        <div class="msc-body">
          <h4 class="msc-name">Ana López</h4>
          <div class="msc-role">25 años • Enfermera</div>
          <p class="msc-quote">
            "Tenía varias deudas pequeñas que me ahogaban y no veía la salida. Aprendí a hacer un presupuesto base cero y a negociar. En 8 meses saldé todo y ahora ahorro el 20% de mi sueldo."
          </p>
          <div class="msc-chart-row">
            <div class="msc-metrics-texts">
              <span>Deudas liquidadas:</span>
              <strong>$28,500 MXN</strong>
            </div>
            <!-- Mini velocímetro / arco SVG -->
            <svg class="msc-chart-svg" viewBox="0 0 70 28" fill="none">
              <path d="M10 24 A 20 20 0 0 1 60 24" stroke="#e2e8f0" stroke-width="4" stroke-linecap="round"/>
              <path d="M10 24 A 20 20 0 0 1 52 10" stroke="#00703c" stroke-width="4.5" stroke-linecap="round"/>
            </svg>
          </div>
          <div class="msc-actions-row">
            <button type="button" class="msc-action-btn" onclick="toggleLike(this); event.stopPropagation();">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
              <span>Me gusta</span> <span class="like-count">62</span>
            </button>
            <button type="button" class="msc-action-btn" onclick="openStudentTestimonial('ana'); event.stopPropagation();">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
              <span>Comentarios</span> <span>18</span>
            </button>
            <span title="Deuda Cero" style="font-size:18px;">💵</span>
          </div>
        </div>
      </div>

      <!-- Tarjeta 4: Roberto y Silvia -->
      <div class="mock-student-card" onclick="openStudentTestimonial('roberto')" style="cursor: pointer;" title="Clic para ver testimonio en video">
        <div class="msc-header">
          <span class="msc-medal" title="Escudo de Protección">🛡️</span>
          <div class="msc-avatar-wrap">
            <img src="https://images.unsplash.com/photo-1581579438747-1dc8d17bbce4?w=160&auto=format&fit=crop&q=80" alt="Roberto y Silvia" loading="lazy" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
            <div class="msc-avatar-placeholder" style="display:none; background: linear-gradient(135deg, #4a90d9, #1a5fa0);">
              RS
            </div>
          </div>
        </div>
        <div class="msc-body">
          <h4 class="msc-name">Roberto y Silvia</h4>
          <div class="msc-role">41 años • Pareja y padres</div>
          <p class="msc-quote">
            "El dinero era motivo de discusiones cada fin de mes. Al tomar el curso juntos fijamos metas claras para la educación de nuestros hijos. Hoy tenemos tranquilidad y control total de nuestra economía familiar."
          </p>
          <div class="msc-chart-row">
            <div class="msc-metrics-texts">
              <span>Meta familiar:</span>
              <strong>Fondo universitario</strong>
            </div>
            <!-- Mini Sparkline SVG -->
            <svg class="msc-chart-svg" viewBox="0 0 70 28" fill="none">
              <path d="M2 24 C16 22, 28 16, 40 12 C52 8, 60 4, 68 2" stroke="#10b981" stroke-width="2.5" stroke-linecap="round"/>
              <path d="M2 24 C16 22, 28 16, 40 12 C52 8, 60 4, 68 2 L68 28 L2 28 Z" fill="rgba(16,185,129,0.12)"/>
            </svg>
          </div>
          <div class="msc-actions-row">
            <button type="button" class="msc-action-btn" onclick="toggleLike(this); event.stopPropagation();">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
              <span>Me gusta</span> <span class="like-count">29</span>
            </button>
            <button type="button" class="msc-action-btn" onclick="openStudentTestimonial('roberto'); event.stopPropagation();">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
              <span>Comentarios</span> <span>7</span>
            </button>
            <span title="Familia Asegurada" style="font-size:18px;">🏠</span>
          </div>
        </div>
      </div>

    </div><!-- /students-cards-full-grid -->

  </div>

  <!-- ── Barra inferior de features ── -->
  <div class="m-features-bar" style="margin-top: 36px;">
    <div class="container m-features-inner">
      <div class="m-feat">
        <span class="m-feat-ico">🔥</span>
        <div>Tu futuro financiero<br><strong>también se aprende</strong></div>
      </div>
      <div class="m-feat">
        <span class="m-feat-ico">💻</span>
        <div>100% en línea<br><strong>y a tu ritmo</strong></div>
      </div>
      <div class="m-feat">
        <span class="m-feat-ico">🛡️</span>
        <div>Contenido práctico<br><strong>y fácil de aplicar</strong></div>
      </div>
      <div class="m-feat">
        <span class="m-feat-ico">⭐</span>
        <div>Soporte de mentores<br><strong>y comunidad</strong></div>
      </div>
      <div class="m-feat m-feat-cursive">
        No es solo un curso,<br>es una nueva forma<br>de ver tu dinero 💚
      </div>
    </div>
  </div>

</section>

<!-- ══════════════════════════════════════════════════════
     SECCIÓN: HÁBITOS ATÓMICOS EN TUS FINANZAS (DIAGNÓSTICO INTERACTIVO)
     ══════════════════════════════════════════════════════ -->
<section class="atomic-habits-section" id="habitos-atomicos">
  <div class="container">
    
    <!-- Encabezado de la sección -->
    <div class="atomic-overview-header">
      <div class="atomic-tagline">
        <span>⚛️ Hábitos Atómicos & Finanzas</span>
      </div>
      <h2>FORMULARIO: DESCUBRE TUS HÁBITOS FINANCIEROS</h2>
      <p class="atomic-sub">Inspirado en los fundamentos de <strong>James Clear</strong> aplicados a tus decisiones de dinero</p>
      <p class="atomic-intro-desc">
        Descubre qué hábitos tienes actualmente, cuáles afectan tus finanzas y qué pequeños cambios del 1% diario puedes comenzar a realizar. Un diagnóstico interactivo para conocer tus comportamientos y transformarlos paso a paso.
      </p>
    </div>

    <!-- TARJETA OSCURA PRINCIPAL DEL FORMULARIO / DIAGNÓSTICO -->
    <div class="atomic-card-container">

      <!-- Encabezado de la tarjeta interactiva -->
      <div class="atomic-card-head">
        <div class="atomic-head-flex">
          <div>
            <span class="atomic-pill-badge">Actividad interactiva</span>
            <h3 class="atomic-card-title">¿Qué hábitos están controlando tu dinero?</h3>
            <p class="atomic-card-subtitle">Antes de cambiar tus finanzas, necesitas conocer tus comportamientos. Responde con sinceridad.</p>
          </div>
          <div class="atomic-score-live-pill" id="liveScorePill">
            <span class="live-score-label">Diagnóstico en vivo</span>
            <span class="live-score-number" id="liveScoreNum">0%</span>
          </div>
        </div>
      </div>

      <!-- BANNER ILUSTRATIVO INTERACTIVO (Reemplaza la imagen estática con interactividad viva) -->
      <div class="atomic-interactive-banner">
        <div class="banner-graphic-side">
          <div class="banner-avatar-wrap" id="bannerAvatarWrap" title="Toca para interactuar">
            🧑‍💼
          </div>
          <div class="banner-graphic-text">
            <h4>Controla tus comportamientos diarios</h4>
            <p>Tus hábitos de hoy construyen tu libertad financiera de mañana. Interactúa con las herramientas abajo:</p>
          </div>
        </div>
        <div class="banner-interactive-badges">
          <button type="button" class="banner-badge-btn" onclick="interactivePiggyBank()" title="Toca para simular un micro-ahorro diario">
            <span>🐷 Micro-ahorro:</span>
            <span class="badge-pill-val" id="simPiggyAmount">$0 MXN</span>
          </button>
          <div class="banner-badge-btn" style="cursor: default;">
            <span>📅 Racha del 1%:</span>
            <span class="badge-pill-val" style="background: #0ea5e9;">21 Días Activos 🔥</span>
          </div>
        </div>
      </div>

      <!-- ══════════════════════════════════════════════════════
           HUB VISUAL INTERACTIVO (Herramientas Dinámicas)
           ══════════════════════════════════════════════════════ -->
      <div class="atomic-visual-hub" id="atomicVisualHub">

        <!-- Selector de pestañas interactivas del Hub -->
        <div class="atomic-hub-tabs">
          <button type="button" class="atomic-hub-tab active" id="tabBtnSimulador" onclick="switchAtomicTab('simulador')">
            <span>📈 Simulador del 1% Diario</span>
          </button>
          <button type="button" class="atomic-hub-tab" id="tabBtnBucle" onclick="switchAtomicTab('bucle')">
            <span>🧬 El Bucle del Hábito (4 Leyes)</span>
          </button>
          <button type="button" class="atomic-hub-tab" id="tabBtnReactor" onclick="switchAtomicTab('reactor')">
            <span>⚛️ Reactor de Energía Atómica</span>
          </button>
        </div>

        <!-- PANEL 1: SIMULADOR INTERACTIVO DEL 1% DIARIO -->
        <div class="atomic-hub-panel active" id="tabPanelSimulador">
          <div class="atomic-sim-header">
            <div>
              <span class="atomic-sim-tag">Fórmula Central de James Clear</span>
              <h4 class="atomic-sim-title">El Interés Compuesto de tus Hábitos</h4>
              <p class="atomic-sim-sub">Mueve el control deslizante para simular cómo tus micro-decisiones financieras diarias componen con el tiempo.</p>
            </div>
            <div class="atomic-metric-pill">
              <span class="atomic-metric-label">Factor multiplicador:</span>
              <span class="atomic-metric-val" id="simMultiplierVal">1.01x</span>
            </div>
          </div>

          <!-- Slider Interactivo (Inicia y se mantiene en Día 1) -->
          <div class="atomic-slider-box">
            <div class="atomic-slider-labels">
              <span>Día 1</span>
              <span class="atomic-slider-curr" id="simDaysDisplay">Día 1 (Punto de partida)</span>
              <span>Día 365</span>
            </div>
            <input type="range" min="1" max="365" value="1" class="atomic-range-slider" id="atomicDaysSlider" oninput="updateAtomicSimulator(this.value)">
            <div class="atomic-slider-presets">
              <button type="button" class="preset-btn active" onclick="setSimDays(1)">🌱 Día 1 (Inicio)</button>
              <button type="button" class="preset-btn" onclick="setSimDays(30)">📅 1 Mes (30d)</button>
              <button type="button" class="preset-btn" onclick="setSimDays(90)">📊 3 Meses (90d)</button>
              <button type="button" class="preset-btn" onclick="setSimDays(180)">⚡ 6 Meses (180d)</button>
              <button type="button" class="preset-btn" onclick="setSimDays(365)">🏆 1 Año (365d: 37x)</button>
            </div>
          </div>

          <!-- Comparativa Visual Interactiva -->
          <div class="atomic-comparison-grid">
            <div class="atomic-comp-card comp-positive">
              <div class="comp-badge">🌱 1% MEJOR CADA DÍA (1.01<sup>n</sup>)</div>
              <div class="comp-val" id="compPosValue">+1% (1.01x)</div>
              <div class="comp-prog-bar"><div class="comp-fill comp-fill-pos" id="compFillPos" style="width: 3%;"></div></div>
              <p class="comp-desc" id="compPosDesc">Día 1: Tu primer micro-ahorro de $50 MXN. El cambio parece pequeño hoy, pero es la semilla que multiplicará tu dinero con el tiempo.</p>
            </div>
            <div class="atomic-comp-card comp-negative">
              <div class="comp-badge">⚠️ 1% PEOR CADA DÍA (0.99<sup>n</sup>)</div>
              <div class="comp-val" id="compNegValue">0.99x (-1%)</div>
              <div class="comp-prog-bar"><div class="comp-fill comp-fill-neg" id="compFillNeg" style="width: 99%;"></div></div>
              <p class="comp-desc" id="compNegDesc">Día 1: Un gasto impulsivo de $50 MXN. Parece inofensivo en un solo día, pero repetirlo continuamente es lo que drena tu patrimonio.</p>
            </div>
          </div>
        </div>

        <!-- PANEL 2: EL BUCLE DEL HÁBITO EN 4 LEYES (CLICABLE) -->
        <div class="atomic-hub-panel" id="tabPanelBucle" style="display: none;">
          <div class="atomic-bucle-intro">
            <span class="atomic-sim-tag">Interactivo: Haz clic en cada cuadrante para explorar su táctica</span>
            <h4 class="atomic-sim-title">Las 4 Fases de un Hábito Financiero</h4>
          </div>
          <div class="atomic-quadrants-grid">
            <div class="atomic-quadrant-card active" id="quad1" onclick="selectQuadrant(1)">
              <div class="quad-num">1. SEÑAL</div>
              <div class="quad-name">Hazlo Obvio 🔍</div>
              <div class="quad-hint">Toca para ver táctica</div>
            </div>
            <div class="atomic-quadrant-card" id="quad2" onclick="selectQuadrant(2)">
              <div class="quad-num">2. ANHELO</div>
              <div class="quad-name">Hazlo Atractivo 💡</div>
              <div class="quad-hint">Toca para ver táctica</div>
            </div>
            <div class="atomic-quadrant-card" id="quad3" onclick="selectQuadrant(3)">
              <div class="quad-num">3. RESPUESTA</div>
              <div class="quad-name">Hazlo Sencillo ⚡</div>
              <div class="quad-hint">Toca para ver táctica</div>
            </div>
            <div class="atomic-quadrant-card" id="quad4" onclick="selectQuadrant(4)">
              <div class="quad-num">4. RECOMPENSA</div>
              <div class="quad-name">Hazlo Satisfactorio 🎁</div>
              <div class="quad-hint">Toca para ver táctica</div>
            </div>
          </div>
          <div class="atomic-quad-detail-box" id="quadrantDetailBox"></div>
        </div>

        <!-- PANEL 3: REACTOR DE ENERGÍA ATÓMICA EN VIVO -->
        <div class="atomic-hub-panel" id="tabPanelReactor" style="display: none;">
          <div class="atomic-reactor-wrap">
            <div class="atomic-reactor-stage">
              <div class="atomic-svg-atom">
                <svg viewBox="0 0 200 200" class="reactor-core-svg" id="reactorSvgCore">
                  <defs>
                    <radialGradient id="atomicGlowGrad" cx="50%" cy="50%" r="50%">
                      <stop offset="0%" stop-color="#34d399" stop-opacity="0.95"/>
                      <stop offset="60%" stop-color="#10b981" stop-opacity="0.45"/>
                      <stop offset="100%" stop-color="#047857" stop-opacity="0"/>
                    </radialGradient>
                  </defs>
                  <!-- Órbita 1 -->
                  <ellipse cx="100" cy="100" rx="80" ry="32" class="atom-orbit orbit-1" />
                  <circle cx="180" cy="100" r="5" class="atom-electron electron-1" />
                  <!-- Órbita 2 -->
                  <ellipse cx="100" cy="100" rx="80" ry="32" class="atom-orbit orbit-2" />
                  <circle cx="180" cy="100" r="5" class="atom-electron electron-2" />
                  <!-- Órbita 3 -->
                  <ellipse cx="100" cy="100" rx="80" ry="32" class="atom-orbit orbit-3" />
                  <circle cx="180" cy="100" r="5" class="atom-electron electron-3" />
                  <!-- Núcleo con pulso -->
                  <circle cx="100" cy="100" r="28" fill="url(#atomicGlowGrad)" class="atom-glow-pulse" />
                  <circle cx="100" cy="100" r="16" fill="#10b981" class="atom-nucleus" />
                  <text x="100" y="105" text-anchor="middle" fill="#ffffff" font-size="11" font-weight="bold" id="reactorAtomText">1%</text>
                </svg>
              </div>
              <div class="atomic-reactor-info">
                <span class="atomic-sim-tag">Energía en Tiempo Real</span>
                <h4 class="atomic-sim-title" id="reactorPowerTitle">Diagnóstico de Hábitos: 0 de 6</h4>
                <p class="atomic-reactor-text" id="reactorPowerDesc">A medida que respondes las 6 preguntas abajo, el reactor evalúa la madurez de tus hábitos financieros diarios.</p>
                <div class="atomic-reactor-chips">
                  <span class="atom-chip" id="chipQ1" onclick="jumpToQuestion(1)">1. Administrar Ingresos</span>
                  <span class="atom-chip" id="chipQ2" onclick="jumpToQuestion(2)">2. Compras Innecesarias</span>
                  <span class="atom-chip" id="chipQ3" onclick="jumpToQuestion(3)">3. Registrar Gastos</span>
                  <span class="atom-chip" id="chipQ4" onclick="jumpToQuestion(4)">4. Hábito de Ahorrar</span>
                  <span class="atom-chip" id="chipQ5" onclick="jumpToQuestion(5)">5. Decisión de Compra</span>
                  <span class="atom-chip" id="chipQ6" onclick="jumpToQuestion(6)">6. Hábito a Transformar</span>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div><!-- /atomic-visual-hub -->

      <!-- Barra de progreso interactiva y Navegador Stepper -->
      <div class="atomic-progress-box">
        <div class="atomic-progress-labels">
          <span class="atomic-prog-title">Tu diagnóstico</span>
          <span class="atomic-prog-count" id="atomicCounter">0 de 6 respondidas</span>
        </div>
        <div class="atomic-progress-bar-track">
          <div class="atomic-progress-bar-fill" id="atomicProgressBar" style="width: 0%;"></div>
        </div>
        <!-- Stepper interactivo para saltar de pregunta -->
        <div class="atomic-stepper-row">
          <button type="button" class="stepper-step" id="stepBtn1" onclick="jumpToQuestion(1)">1</button>
          <button type="button" class="stepper-step" id="stepBtn2" onclick="jumpToQuestion(2)">2</button>
          <button type="button" class="stepper-step" id="stepBtn3" onclick="jumpToQuestion(3)">3</button>
          <button type="button" class="stepper-step" id="stepBtn4" onclick="jumpToQuestion(4)">4</button>
          <button type="button" class="stepper-step" id="stepBtn5" onclick="jumpToQuestion(5)">5</button>
          <button type="button" class="stepper-step" id="stepBtn6" onclick="jumpToQuestion(6)">6</button>
        </div>
      </div>

      <!-- Formulario de Preguntas con textos interactivos -->
      <form id="atomicHabitsForm" class="atomic-questions-form" onsubmit="submitAtomicDiagnostic(event)">

        <!-- PREGUNTA 1: ADMINISTRACIÓN DE INGRESOS -->
        <div class="atomic-q-block" id="qBlock1">
          <div class="atomic-q-header">
            <h4 class="atomic-q-title">1. ¿Cómo administras tu dinero cuando recibes tus ingresos?</h4>
            <button type="button" class="atomic-glossary-btn" onclick="toggleGlossary('glosario1')">
              💡 Ver Principio: Págate a ti primero
            </button>
          </div>
          <!-- Texto interactivo expandible -->
          <div class="atomic-glossary-card" id="glosario1" style="display: none;">
            <strong>Principio Fundamental (1ª Ley):</strong> Si esperas a ver "qué sobra" a fin de mes, nunca quedará nada. La clave de James Clear es hacer el ahorro automático e invisible al recibir tus ingresos antes de que entre el impulso de gastar.
          </div>
          <div class="atomic-options-group">
            <label class="atomic-option-label" onclick="showOptionInsight(1, 'opt1')">
              <input type="radio" name="p1" value="opt1" onchange="updateAtomicProgress()">
              <span class="atomic-radio-circle"></span>
              <span class="atomic-option-text">Guardo una parte para ahorrar.</span>
              <span class="atomic-opt-badge badge-pro">🌱 Págate a ti primero</span>
            </label>
            <label class="atomic-option-label" onclick="showOptionInsight(1, 'opt2')">
              <input type="radio" name="p1" value="opt2" onchange="updateAtomicProgress()">
              <span class="atomic-radio-circle"></span>
              <span class="atomic-option-text">Gasto primero y ahorro si sobra.</span>
              <span class="atomic-opt-badge badge-neutral">⚖️ Ahorro reactivo</span>
            </label>
            <label class="atomic-option-label" onclick="showOptionInsight(1, 'opt3')">
              <input type="radio" name="p1" value="opt3" onchange="updateAtomicProgress()">
              <span class="atomic-radio-circle"></span>
              <span class="atomic-option-text">Lo gasto sin llevar un control.</span>
              <span class="atomic-opt-badge badge-danger">⚠️ Sin sistema</span>
            </label>
          </div>
          <!-- Micro-feedback interactivo en vivo -->
          <div class="atomic-live-insight" id="insightBox1" style="display: none;"></div>
        </div>

        <!-- PREGUNTA 2: COMPRAS INNECESARIAS -->
        <div class="atomic-q-block" id="qBlock2">
          <div class="atomic-q-header">
            <h4 class="atomic-q-title">2. ¿Con qué frecuencia compras cosas que realmente no necesitas?</h4>
            <button type="button" class="atomic-glossary-btn" onclick="toggleGlossary('glosario2')">
              💡 Ver Principio: Fricción contra el impulso
            </button>
          </div>
          <div class="atomic-glossary-card" id="glosario2" style="display: none;">
            <strong>3ª Ley Invertida (Hazlo Difícil):</strong> Las compras impulsivas son un anhelo de dopamina rápida. Desinstala apps de compras impulsivas o borra tus tarjetas guardadas: 20 segundos de fricción son suficientes para enfriar el impulso.
          </div>
          <div class="atomic-options-group">
            <label class="atomic-option-label" onclick="showOptionInsight(2, 'opt1')">
              <input type="radio" name="p2" value="opt1" onchange="updateAtomicProgress()">
              <span class="atomic-radio-circle"></span>
              <span class="atomic-option-text">Casi nunca.</span>
              <span class="atomic-opt-badge badge-pro">🌱 Control consciente</span>
            </label>
            <label class="atomic-option-label" onclick="showOptionInsight(2, 'opt2')">
              <input type="radio" name="p2" value="opt2" onchange="updateAtomicProgress()">
              <span class="atomic-radio-circle"></span>
              <span class="atomic-option-text">Algunas veces por semana.</span>
              <span class="atomic-opt-badge badge-neutral">⚖️ Gastos hormiga</span>
            </label>
            <label class="atomic-option-label" onclick="showOptionInsight(2, 'opt3')">
              <input type="radio" name="p2" value="opt3" onchange="updateAtomicProgress()">
              <span class="atomic-radio-circle"></span>
              <span class="atomic-option-text">Frecuentemente, por impulso.</span>
              <span class="atomic-opt-badge badge-danger">⚠️ Gratificación inmediata</span>
            </label>
          </div>
          <div class="atomic-live-insight" id="insightBox2" style="display: none;"></div>
        </div>

        <!-- PREGUNTA 3: REGISTRO DE GASTOS DIARIOS -->
        <div class="atomic-q-block" id="qBlock3">
          <div class="atomic-q-header">
            <h4 class="atomic-q-title">3. ¿Registras tus gastos diarios?</h4>
            <button type="button" class="atomic-glossary-btn" onclick="toggleGlossary('glosario3')">
              💡 Ver Principio: Medir para mejorar (Hazlo Obvio)
            </button>
          </div>
          <div class="atomic-glossary-card" id="glosario3" style="display: none;">
            <strong>Visibilidad y Conciencia:</strong> Lo que no se mide, no se puede mejorar. Llevar un registro no significa pasar horas; basta con abrir una app o bloc de notas durante 30 segundos cada noche (Regla de los 2 Minutos).
          </div>
          <div class="atomic-options-group">
            <label class="atomic-option-label" onclick="showOptionInsight(3, 'opt1')">
              <input type="radio" name="p3" value="opt1" onchange="updateAtomicProgress()">
              <span class="atomic-radio-circle"></span>
              <span class="atomic-option-text">Sí, llevo un registro.</span>
              <span class="atomic-opt-badge badge-pro">🌱 Claridad total</span>
            </label>
            <label class="atomic-option-label" onclick="showOptionInsight(3, 'opt2')">
              <input type="radio" name="p3" value="opt2" onchange="updateAtomicProgress()">
              <span class="atomic-radio-circle"></span>
              <span class="atomic-option-text">A veces lo hago.</span>
              <span class="atomic-opt-badge badge-neutral">⚖️ Inconstante</span>
            </label>
            <label class="atomic-option-label" onclick="showOptionInsight(3, 'opt3')">
              <input type="radio" name="p3" value="opt3" onchange="updateAtomicProgress()">
              <span class="atomic-radio-circle"></span>
              <span class="atomic-option-text">No, nunca los registro.</span>
              <span class="atomic-opt-badge badge-danger">⚠️ Ceguera financiera</span>
            </label>
          </div>
          <div class="atomic-live-insight" id="insightBox3" style="display: none;"></div>
        </div>

        <!-- PREGUNTA 4: HÁBITO DE AHORRAR -->
        <div class="atomic-q-block" id="qBlock4">
          <div class="atomic-q-header">
            <h4 class="atomic-q-title">4. ¿Tienes el hábito de ahorrar?</h4>
            <button type="button" class="atomic-glossary-btn" onclick="toggleGlossary('glosario4')">
              💡 Ver Principio: La identidad sobre el resultado
            </button>
          </div>
          <div class="atomic-glossary-card" id="glosario4" style="display: none;">
            <strong>Cambio de Identidad:</strong> En <em>Hábitos Atómicos</em>, no ahorras para tener una cantidad; ahorras porque te consideras "una persona que cuida de su futuro". Cada peso apartado es un voto a favor de tu nueva identidad financiera.
          </div>
          <div class="atomic-options-group">
            <label class="atomic-option-label" onclick="showOptionInsight(4, 'opt1')">
              <input type="radio" name="p4" value="opt1" onchange="updateAtomicProgress()">
              <span class="atomic-radio-circle"></span>
              <span class="atomic-option-text">Sí, ahorro constantemente.</span>
              <span class="atomic-opt-badge badge-pro">🌱 Hábito consolidado</span>
            </label>
            <label class="atomic-option-label" onclick="showOptionInsight(4, 'opt2')">
              <input type="radio" name="p4" value="opt2" onchange="updateAtomicProgress()">
              <span class="atomic-radio-circle"></span>
              <span class="atomic-option-text">Ahorro cuando puedo.</span>
              <span class="atomic-opt-badge badge-neutral">⚖️ Sin sistema fijo</span>
            </label>
            <label class="atomic-option-label" onclick="showOptionInsight(4, 'opt3')">
              <input type="radio" name="p4" value="opt3" onchange="updateAtomicProgress()">
              <span class="atomic-radio-circle"></span>
              <span class="atomic-option-text">No tengo el hábito de ahorrar.</span>
              <span class="atomic-opt-badge badge-danger">⚠️ Oportunidad de oro</span>
            </label>
          </div>
          <div class="atomic-live-insight" id="insightBox4" style="display: none;"></div>
        </div>

        <!-- PREGUNTA 5: REACCIÓN AL DESEAR COMPRAR ALGO -->
        <div class="atomic-q-block" id="qBlock5">
          <div class="atomic-q-header">
            <h4 class="atomic-q-title">5. ¿Qué haces cuando quieres comprar algo que te gusta?</h4>
            <button type="button" class="atomic-glossary-btn" onclick="toggleGlossary('glosario5')">
              💡 Ver Principio: La regla de las 72 horas
            </button>
          </div>
          <div class="atomic-glossary-card" id="glosario5" style="display: none;">
            <strong>Pausa Emocional:</strong> Esperar 72 horas antes de adquirir cualquier capricho no esencial reduce el pico de dopamina en el cerebro. Si después de 3 días aún lo deseas y cabe en tu presupuesto, cómpralo con tranquilidad.
          </div>
          <div class="atomic-options-group">
            <label class="atomic-option-label" onclick="showOptionInsight(5, 'opt1')">
              <input type="radio" name="p5" value="opt1" onchange="updateAtomicProgress()">
              <span class="atomic-radio-circle"></span>
              <span class="atomic-option-text">Analizo si realmente lo necesito.</span>
              <span class="atomic-opt-badge badge-pro">🌱 Pausa analítica</span>
            </label>
            <label class="atomic-option-label" onclick="showOptionInsight(5, 'opt2')">
              <input type="radio" name="p5" value="opt2" onchange="updateAtomicProgress()">
              <span class="atomic-radio-circle"></span>
              <span class="atomic-option-text">Espero un poco y después decido.</span>
              <span class="atomic-opt-badge badge-neutral">⚖️ Enfriamiento previo</span>
            </label>
            <label class="atomic-option-label" onclick="showOptionInsight(5, 'opt3')">
              <input type="radio" name="p5" value="opt3" onchange="updateAtomicProgress()">
              <span class="atomic-radio-circle"></span>
              <span class="atomic-option-text">Lo compro inmediatamente.</span>
              <span class="atomic-opt-badge badge-danger">⚠️ Impulso directo</span>
            </label>
          </div>
          <div class="atomic-live-insight" id="insightBox5" style="display: none;"></div>
        </div>

        <!-- PREGUNTA 6: HÁBITO QUE TE GUSTARÍA CAMBIAR -->
        <div class="atomic-q-block" id="qBlock6">
          <div class="atomic-q-header">
            <h4 class="atomic-q-title">6. ¿Qué hábito financiero te gustaría cambiar?</h4>
            <button type="button" class="atomic-glossary-btn" onclick="toggleGlossary('glosario6')">
              💡 Ver Principio: Intención de Implementación
            </button>
          </div>
          <div class="atomic-glossary-card" id="glosario6" style="display: none;">
            <strong>Tu Foco de Transformación:</strong> Según James Clear, las personas que formulan una <em>Intención de Implementación</em> concreta («Cuando ocurra X, haré Y») tienen 3 veces más probabilidades de éxito que quienes solo tienen buenos deseos.
          </div>
          <div class="atomic-options-group">
            <label class="atomic-option-label" onclick="showOptionInsight(6, 'opt1')">
              <input type="radio" name="p6" value="opt1" onchange="updateAtomicProgress()">
              <span class="atomic-radio-circle"></span>
              <span class="atomic-option-text">Dejar de comprar por impulso.</span>
              <span class="atomic-opt-badge badge-target">🎯 Fricción de compra</span>
            </label>
            <label class="atomic-option-label" onclick="showOptionInsight(6, 'opt2')">
              <input type="radio" name="p6" value="opt2" onchange="updateAtomicProgress()">
              <span class="atomic-radio-circle"></span>
              <span class="atomic-option-text">Evitar los gastos hormiga.</span>
              <span class="atomic-opt-badge badge-target">🎯 Micro-ahorros</span>
            </label>
            <label class="atomic-option-label" onclick="showOptionInsight(6, 'opt3')">
              <input type="radio" name="p6" value="opt3" onchange="updateAtomicProgress()">
              <span class="atomic-radio-circle"></span>
              <span class="atomic-option-text">Aprender a ahorrar constantemente.</span>
              <span class="atomic-opt-badge badge-target">🎯 Automatización</span>
            </label>
            <label class="atomic-option-label" onclick="showOptionInsight(6, 'opt4')">
              <input type="radio" name="p6" value="opt4" onchange="updateAtomicProgress()">
              <span class="atomic-radio-circle"></span>
              <span class="atomic-option-text">Organizar mejor mi dinero.</span>
              <span class="atomic-opt-badge badge-target">🎯 Sistema de 2 minutos</span>
            </label>
          </div>
          <div class="atomic-live-insight" id="insightBox6" style="display: none;"></div>
        </div>

        <!-- Alerta si faltan preguntas -->
        <div id="atomicValidationAlert" class="atomic-validation-alert" style="display: none;">
          <span>⚠️ Por favor responde todas las preguntas (<span id="atomicMissingCount">0</span> pendientes) para generar tu diagnóstico interactivo completo.</span>
        </div>

        <!-- Botón para finalizar -->
        <div class="atomic-submit-wrap">
          <button type="submit" class="atomic-btn-submit" id="btnFinalizarDiag">
            <span>Finalizar diagnóstico</span>
            <span>→</span>
          </button>
        </div>

      </form>

      <!-- RESULTADO DEL DIAGNÓSTICO (Generado con JS) -->
      <div id="atomicResultSection" class="atomic-result-box" style="display: none;"></div>

    </div><!-- /atomic-card-container -->

  </div>
</section>
</main>

<footer class="site-footer">
  <div class="container">
    <p><strong>Educación Financiera</strong> — Plataforma Educativa de Aprendizaje y Transformación.</p>
  </div>
</footer>

  </div><!-- /main-wrapper -->



<!-- ══════════════════════════════════════════════════════
     MODAL DE TESTIMONIO EN VIDEO DE ESTUDIANTE (POPUPS DE COMENTARIOS)
     ══════════════════════════════════════════════════════ -->
<style>
/* Estilos embebidos directos garantizados para el modal de video */
.student-video-modal {
  display: none;
  position: fixed !important;
  inset: 0 !important;
  width: 100vw !important;
  height: 100vh !important;
  background: rgba(8, 18, 28, 0.8) !important;
  backdrop-filter: blur(8px) !important;
  -webkit-backdrop-filter: blur(8px) !important;
  z-index: 999999 !important;
  align-items: center !important;
  justify-content: center !important;
  padding: 16px !important;
  box-sizing: border-box !important;
}
.student-video-modal.is-active {
  display: flex !important;
}
.svm-panel {
  background: #ffffff !important;
  border-radius: 20px !important;
  max-width: 500px !important;
  width: 100% !important;
  padding: 0 !important;
  box-shadow: 0 25px 60px rgba(0, 0, 0, 0.45) !important;
  position: relative !important;
  overflow: hidden !important;
  overflow-y: auto !important;
  max-height: 88vh !important;
  border: 1px solid rgba(0, 0, 0, 0.1) !important;
  margin: auto !important;
}
.svm-header {
  display: flex !important;
  align-items: center !important;
  justify-content: space-between !important;
  padding: 14px 18px !important;
  background: #f8fafc !important;
  border-bottom: 1px solid #edf2f7 !important;
}
.svm-student-info {
  display: flex !important;
  align-items: center !important;
  gap: 12px !important;
}
.svm-avatar-thumb {
  width: 44px !important;
  height: 44px !important;
  border-radius: 50% !important;
  object-fit: cover !important;
  border: 2px solid #00703c !important;
}
.svm-meta h4 {
  font-size: 17px !important;
  font-weight: 800 !important;
  color: #0f172a !important;
  margin: 0 !important;
}
.svm-meta span {
  font-size: 13.5px !important;
  color: #64748b !important;
  display: block !important;
}
.svm-close-btn {
  background: #e2e8f0 !important;
  border: none !important;
  width: 32px !important;
  height: 32px !important;
  border-radius: 50% !important;
  font-size: 20px !important;
  font-weight: 700 !important;
  cursor: pointer !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  color: #475569 !important;
}
.svm-close-btn:hover {
  background: #cbd5e1 !important;
  color: #0f172a !important;
}
.svm-video-box {
  position: relative !important;
  width: 100% !important;
  height: 230px !important;
  background: #0f172a !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  overflow: hidden !important;
}
.svm-video-bg {
  position: absolute !important;
  inset: 0 !important;
  width: 100% !important;
  height: 100% !important;
  object-fit: cover !important;
  filter: brightness(0.62) contrast(1.05) !important;
}
.svm-video-overlay {
  position: absolute !important;
  inset: 0 !important;
  background: linear-gradient(180deg, rgba(0,0,0,0.3) 0%, transparent 40%, rgba(0,0,0,0.85) 100%) !important;
  pointer-events: none !important;
}
.svm-live-pill {
  position: absolute !important;
  top: 12px !important;
  left: 14px !important;
  background: rgba(0, 0, 0, 0.65) !important;
  color: #ffffff !important;
  padding: 4px 10px !important;
  border-radius: 20px !important;
  font-size: 12px !important;
  font-weight: 700 !important;
  display: flex !important;
  align-items: center !important;
  gap: 6px !important;
  z-index: 2 !important;
}
.svm-live-dot {
  width: 7px !important;
  height: 7px !important;
  border-radius: 50% !important;
  background: #ef4444 !important;
}
.svm-duration-pill {
  position: absolute !important;
  top: 12px !important;
  right: 14px !important;
  background: rgba(0, 0, 0, 0.65) !important;
  color: #34d399 !important;
  padding: 4px 10px !important;
  border-radius: 20px !important;
  font-size: 13px !important;
  font-weight: 700 !important;
  z-index: 2 !important;
}
.svm-play-btn {
  position: relative !important;
  z-index: 2 !important;
  width: 62px !important;
  height: 62px !important;
  border-radius: 50% !important;
  background: #10b981 !important;
  border: 3px solid #ffffff !important;
  color: #ffffff !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  cursor: pointer !important;
  box-shadow: 0 8px 25px rgba(16, 185, 129, 0.55) !important;
}
.svm-play-btn:hover {
  transform: scale(1.08) !important;
  background: #059669 !important;
}
.svm-play-btn svg {
  margin-left: 3px !important;
  width: 24px !important;
  height: 24px !important;
}
.svm-player-controls {
  position: absolute !important;
  bottom: 0 !important;
  left: 0 !important;
  right: 0 !important;
  padding: 8px 14px 10px !important;
  z-index: 2 !important;
  background: linear-gradient(0deg, rgba(0,0,0,0.85) 0%, transparent 100%) !important;
}
.svm-progress-bar-bg {
  width: 100% !important;
  height: 4px !important;
  background: rgba(255, 255, 255, 0.25) !important;
  border-radius: 2px !important;
  cursor: pointer !important;
}
.svm-progress-bar-fill {
  height: 100% !important;
  background: #10b981 !important;
  transition: width 0.3s linear !important;
}
.svm-controls-meta {
  display: flex !important;
  align-items: center !important;
  justify-content: space-between !important;
  margin-top: 6px !important;
  font-size: 13px !important;
  color: #cbd5e1 !important;
}
.svm-soundwave {
  display: flex !important;
  align-items: center !important;
  gap: 3px !important;
  height: 14px !important;
}
.svm-soundwave span {
  display: block !important;
  width: 3px !important;
  background: #34d399 !important;
  border-radius: 2px !important;
}
.svm-body {
  padding: 16px 20px 20px !important;
}
.svm-video-title {
  font-size: 15.5px !important;
  font-weight: 800 !important;
  color: #0f172a !important;
  margin-bottom: 8px !important;
  display: flex !important;
  align-items: center !important;
  gap: 6px !important;
}
.svm-quote-box {
  background: #f8fafc !important;
  border-left: 3.5px solid #00703c !important;
  padding: 11px 14px !important;
  border-radius: 10px !important;
  font-size: 14.5px !important;
  color: #334155 !important;
  line-height: 1.55 !important;
  font-style: italic !important;
  margin-bottom: 12px !important;
}
.svm-achievement-badge {
  display: inline-flex !important;
  align-items: center !important;
  gap: 6px !important;
  background: #e8f5e9 !important;
  color: #00703c !important;
  padding: 4px 11px !important;
  border-radius: 20px !important;
  font-size: 13px !important;
  font-weight: 700 !important;
  margin-bottom: 12px !important;
}
.svm-comments-section {
  border-top: 1px solid #f1f5f9 !important;
  padding-top: 10px !important;
}
.svm-comments-label {
  font-size: 13px !important;
  font-weight: 700 !important;
  color: #64748b !important;
  margin-bottom: 8px !important;
  display: flex !important;
  align-items: center !important;
  justify-content: space-between !important;
}
.svm-comment-sample {
  font-size: 13.5px !important;
  color: #475569 !important;
  background: #f1f5f9 !important;
  padding: 8px 12px !important;
  border-radius: 8px !important;
  margin-bottom: 10px !important;
  line-height: 1.4 !important;
}
.svm-comment-input-row {
  display: flex !important;
  gap: 8px !important;
}
.svm-comment-input {
  flex: 1 !important;
  padding: 7px 11px !important;
  font-size: 13.5px !important;
  border: 1px solid #cbd5e1 !important;
  border-radius: 8px !important;
  font-family: inherit !important;
  outline: none !important;
}
.svm-send-btn {
  background: #00703c !important;
  color: #ffffff !important;
  border: none !important;
  padding: 7px 13px !important;
  font-size: 13.5px !important;
  font-weight: 700 !important;
  border-radius: 8px !important;
  cursor: pointer !important;
}
</style>
<div class="student-video-modal" id="studentVideoModal" style="display:none;" role="dialog" aria-modal="true" aria-label="Testimonio de estudiante en video" onclick="if(event.target === this) closeStudentTestimonial();">
  <div class="svm-panel">
    <div class="svm-header">
      <div class="svm-student-info">
        <img id="svmAvatar" src="" alt="Estudiante" class="svm-avatar-thumb">
        <div class="svm-meta">
          <h4 id="svmName">Estudiante</h4>
          <span id="svmRole">Rol</span>
        </div>
      </div>
      <button type="button" class="svm-close-btn" onclick="closeStudentTestimonial()" title="Cerrar">&times;</button>
    </div>

    <!-- Reproductor de Video Simulado -->
    <div class="svm-video-box">
      <img id="svmVideoPoster" src="" alt="Portada de Video" class="svm-video-bg">
      <div class="svm-video-overlay"></div>
      
      <div class="svm-live-pill">
        <span class="svm-live-dot"></span>
        <span>TESTIMONIO EN VIDEO</span>
      </div>

      <div class="svm-duration-pill" id="svmDuration">⏱️ 2:30 min</div>

      <!-- Botón de Play animado -->
      <button type="button" class="svm-play-btn" id="svmPlayBtn" onclick="toggleTestimonialVideo()" title="Reproducir testimonio">
        <svg id="svmPlayIcon" viewBox="0 0 24 24" fill="currentColor"><polygon points="6 3 20 12 6 21 6 3"/></svg>
      </button>

      <!-- Barra de progreso y controles inferiores -->
      <div class="svm-player-controls">
        <div class="svm-progress-bar-bg" onclick="scrubTestimonialVideo(event)">
          <div class="svm-progress-bar-fill" id="svmProgressFill" style="width: 25%;"></div>
        </div>
        <div class="svm-controls-meta">
          <span id="svmTimeCurrent">0:38 / 2:30 min</span>
          <div class="svm-soundwave" id="svmSoundwave">
            <span></span><span></span><span></span><span></span>
          </div>
        </div>
      </div>
    </div>

    <div class="svm-body">
      <div class="svm-video-title" id="svmTitle">
        <span>🎬</span> Testimonio en video de estudiante
      </div>

      <div class="svm-achievement-badge" id="svmBadge">
        <span>🏆</span> Logro verificado
      </div>

      <div class="svm-quote-box">
        "<span id="svmQuote">Testimonio</span>"
      </div>

      <div class="svm-comments-section">
        <div class="svm-comments-label">
          <span>Comentarios de la comunidad:</span>
          <span style="color:#00703c; font-size:13px;">🟢 En línea</span>
        </div>
        <div class="svm-comment-sample" id="svmCommentsList">
          <strong>Comunidad Oficial:</strong> "¡Gran testimonio! Tu disciplina financiera inspira a toda la plataforma."
        </div>
        <div class="svm-comment-input-row">
          <input type="text" id="svmNewComment" class="svm-comment-input" placeholder="Escribe un mensaje de apoyo o felicitación..." maxlength="280">
          <button type="button" class="svm-send-btn" onclick="postTestimonialComment()">Comentar</button>
        </div>
        <div class="svm-share-box" id="svmShareBox" hidden>
          <span class="svm-share-icon" aria-hidden="true">
            <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M18 16a3 3 0 0 0-2.24 1.04l-6.68-3.9a3.4 3.4 0 0 0 0-2.28l6.68-3.9A3 3 0 1 0 15 4a3.2 3.2 0 0 0 .04.44L8.36 8.34a3 3 0 1 0 0 7.32l6.68 3.9a3 3 0 1 0 2.96-3.56z"/></svg>
          </span>
          <div class="svm-share-text">
            <strong>¿Quieres compartir tu comentario en redes sociales?</strong>
            <span>Tu testimonio se publicará con tu cuenta para que se vea que es real.</span>
          </div>
          <div class="svm-share-actions">
            <button type="button" class="svm-share-btn svm-share-fb" onclick="shareTestimonialComment('facebook')">Facebook</button>
            <button type="button" class="svm-share-btn svm-share-x" onclick="shareTestimonialComment('x')">X</button>
            <button type="button" class="svm-share-btn svm-share-wa" onclick="shareTestimonialComment('whatsapp')">WhatsApp</button>
            <button type="button" class="svm-share-btn svm-share-no" onclick="discardTestimonialCommentShare()">Ahora no</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="public/js/script.js?v=<?= time() ?>"></script>
<script>
  // ── Splash screen ──────────────────────────────────────────
  (function() {
    var sp = document.getElementById('splashScreen');
    if (!sp) return;
    function hideSplash() {
      sp.classList.add('hide');
    }
    window.hideSplash = hideSplash;
    setTimeout(hideSplash, 5200);
  })();

  // ── Likes interactivos (Me gusta) ──────────────────────────
  function toggleLike(btn) {
    if (!btn) return;
    var countEl = btn.querySelector('.like-count');
    var isLiked = btn.classList.contains('liked');
    var count = parseInt(countEl ? countEl.textContent : '0', 10);
    if (isLiked) {
      btn.classList.remove('liked');
      if (countEl) countEl.textContent = Math.max(0, count - 1);
    } else {
      btn.classList.add('liked');
      if (countEl) countEl.textContent = count + 1;
    }
  }

  // ── Datos de los Estudiantes para el Video Testimonial ──────
  var studentDirectory = {
    mariana: {
      name: 'Mariana González',
      role: '29 años • Emprendedora Independiente',
      medal: '🥇',
      photo: 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=500&auto=format&fit=crop&q=80',
      duration: '⏱️ 2:45 min',
      totalSec: 165,
      title: 'Cómo logré ahorrar e invertir el 35% de mis ingresos',
      badge: '📈 +35% de ahorro mensual e inversión activa',
      quote: 'Siempre creí que la educación financiera era para ricos o cursos de vendehumos. Esta plataforma me dio plantillas simples que apliqué de inmediato. Pasé de no saber a dónde se iba mi dinero a invertir mensualmente.',
      defaultComment: '<strong>Carlos R.:</strong> "Mariana, qué gran cambio. Yo también empecé con las plantillas y son oro puro."'
    },
    jorge: {
      name: 'Jorge Martínez',
      role: 'Vendedor Profesional • 28 años',
      medal: '🥈',
      photo: 'https://images.unsplash.com/photo-1560250097-0b93528c311a?w=500&auto=format&fit=crop&q=80',
      duration: '⏱️ 3:12 min',
      totalSec: 192,
      title: 'De vivir al día con comisiones a tener 6 meses de fondo de emergencia',
      badge: '🛡️ Fondo de emergencia completo garantizado',
      quote: 'Pasaba de comisión en comisión sin guardar nada y ahora ya tengo mi fondo de emergencia. El curso me enseñó a planear, ser constante y entender lo que el cliente realmente necesita.',
      defaultComment: '<strong>Laura T.:</strong> "¡Felicidades Jorge! Aplicar hábitos atómicos en el ahorro cambia por completo las finanzas."'
    },
    ana: {
      name: 'Ana López',
      role: '25 años • Enfermera',
      medal: '🎖️',
      photo: 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=500&auto=format&fit=crop&q=80',
      duration: '⏱️ 2:18 min',
      totalSec: 138,
      title: 'Liquidando $28,500 MXN en deudas con presupuesto base cero',
      badge: '💵 $28,500 MXN en deudas totalmente liquidadas',
      quote: 'Tenía varias deudas pequeñas que me ahogaban y no veía la salida. Aprendí a hacer un presupuesto base cero y a negociar. En 8 meses saldé todo y ahora ahorro el 20% de mi sueldo.',
      defaultComment: '<strong>Dr. Mendoza:</strong> "Admirable Ana, en el sector salud los horarios son duros pero organizarte hace toda la diferencia."'
    },
    roberto: {
      name: 'Roberto y Silvia',
      role: '41 años • Pareja y padres de familia',
      medal: '🛡️',
      photo: 'https://images.unsplash.com/photo-1581579438747-1dc8d17bbce4?w=500&auto=format&fit=crop&q=80',
      duration: '⏱️ 3:30 min',
      totalSec: 210,
      title: 'Paz financiera en familia: construyendo el fondo universitario',
      badge: '🏠 Plan patrimonial y fondo educativo consolidado',
      quote: 'El dinero era motivo de discusiones cada fin de mes. Al tomar el curso juntos fijamos metas claras para la educación de nuestros hijos. Hoy tenemos tranquilidad y control total de nuestra economía familiar.',
      defaultComment: '<strong>Familia Ramos:</strong> "Qué inspiración ver a una pareja crecer financieramente de la mano."'
    }
  };

  var videoTimer = null;
  var videoIsPlaying = false;
  var videoCurrentSec = 45;
  var videoTotalDuration = 150;

  // ── Abrir Ventana con Testimonio en Video (Pocos Minutos) ──
  function openStudentTestimonial(studentKey) {
    var data = studentDirectory[studentKey];
    if (!data) {
      if (typeof studentKey === 'string' && studentKey.indexOf(' ') > -1) {
        var lower = studentKey.toLowerCase();
        if (lower.indexOf('mariana') > -1) data = studentDirectory.mariana;
        else if (lower.indexOf('jorge') > -1) data = studentDirectory.jorge;
        else if (lower.indexOf('ana') > -1) data = studentDirectory.ana;
        else if (lower.indexOf('roberto') > -1 || lower.indexOf('silvia') > -1) data = studentDirectory.roberto;
      }
    }
    if (!data) data = studentDirectory.mariana;

    document.getElementById('svmName').textContent = data.name;
    document.getElementById('svmRole').textContent = data.role;
    document.getElementById('svmAvatar').src = data.photo;
    document.getElementById('svmVideoPoster').src = data.photo;
    document.getElementById('svmDuration').textContent = data.duration;
    document.getElementById('svmTitle').innerHTML = '<span>🎬</span> ' + data.title;
    document.getElementById('svmBadge').innerHTML = '<span>🏆</span> ' + data.badge;
    document.getElementById('svmQuote').textContent = data.quote;
    document.getElementById('svmCommentsList').innerHTML = data.defaultComment;
    lastTestimonialComment = '';
    discardTestimonialCommentShare();
    var svmInput = document.getElementById('svmNewComment');
    if (svmInput) svmInput.value = '';

    // Reiniciar video simulado
    videoTotalDuration = data.totalSec || 150;
    videoCurrentSec = Math.floor(videoTotalDuration * 0.28);
    updateVideoTimeDisplay();

    var modal = document.getElementById('studentVideoModal');
    if (modal) { modal.style.display = 'flex'; modal.classList.add('is-active'); }
    document.documentElement.classList.add('demo-modal-open');
    document.body.classList.add('demo-modal-open');
  }

  // Compatibilidad con llamada previa
  function openStudentComment(name, role, quote, medal) {
    openStudentTestimonial(name);
  }

  function closeStudentTestimonial() {
    var modal = document.getElementById('studentVideoModal');
    if (modal) { modal.style.display = 'none'; modal.classList.remove('is-active'); }
    document.documentElement.classList.remove('demo-modal-open');
    document.body.classList.remove('demo-modal-open');
    pauseTestimonialVideo();
    discardTestimonialCommentShare();
    var svmInput = document.getElementById('svmNewComment');
    if (svmInput) svmInput.value = '';
    lastTestimonialComment = '';
  }

  function closeStudentComment() {
    closeStudentTestimonial();
  }

  // ── Controles de Reproducción del Video Testimonial ─────────
  function toggleTestimonialVideo() {
    if (videoIsPlaying) {
      pauseTestimonialVideo();
    } else {
      playTestimonialVideo();
    }
  }

  function playTestimonialVideo() {
    videoIsPlaying = true;
    var playIcon = document.getElementById('svmPlayIcon');
    if (playIcon) {
      playIcon.innerHTML = '<rect x="6" y="4" width="4" height="16"></rect><rect x="14" y="4" width="4" height="16"></rect>';
    }
    var soundwave = document.getElementById('svmSoundwave');
    if (soundwave) soundwave.style.opacity = '1';

    clearInterval(videoTimer);
    videoTimer = setInterval(function() {
      if (videoCurrentSec < videoTotalDuration) {
        videoCurrentSec++;
        updateVideoTimeDisplay();
      } else {
        pauseTestimonialVideo();
        videoCurrentSec = 0;
        updateVideoTimeDisplay();
      }
    }, 1000);
  }

  function pauseTestimonialVideo() {
    videoIsPlaying = false;
    clearInterval(videoTimer);
    var playIcon = document.getElementById('svmPlayIcon');
    if (playIcon) {
      playIcon.innerHTML = '<polygon points="6 3 20 12 6 21 6 3"/>';
    }
    var soundwave = document.getElementById('svmSoundwave');
    if (soundwave) soundwave.style.opacity = '0.5';
  }

  function updateVideoTimeDisplay() {
    var currentMin = Math.floor(videoCurrentSec / 60);
    var currentSecRemaining = videoCurrentSec % 60;
    var totalMin = Math.floor(videoTotalDuration / 60);
    var totalSecRemaining = videoTotalDuration % 60;

    var formattedCurrent = currentMin + ':' + (currentSecRemaining < 10 ? '0' : '') + currentSecRemaining;
    var formattedTotal = totalMin + ':' + (totalSecRemaining < 10 ? '0' : '') + totalSecRemaining;

    var timeEl = document.getElementById('svmTimeCurrent');
    if (timeEl) timeEl.textContent = formattedCurrent + ' / ' + formattedTotal + ' min';

    var pct = Math.min(100, (videoCurrentSec / videoTotalDuration) * 100);
    var fillEl = document.getElementById('svmProgressFill');
    if (fillEl) fillEl.style.width = pct + '%';
  }

  function scrubTestimonialVideo(event) {
    var rect = event.currentTarget.getBoundingClientRect();
    var clickX = event.clientX - rect.left;
    var pct = Math.max(0, Math.min(1, clickX / rect.width));
    videoCurrentSec = Math.floor(pct * videoTotalDuration);
    updateVideoTimeDisplay();
  }

  var lastTestimonialComment = '';

  function escapeSvmText(str) {
    return String(str).replace(/[&<>"']/g, function (c) {
      return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c];
    });
  }

  function discardTestimonialCommentShare() {
    var box = document.getElementById('svmShareBox');
    if (box) box.hidden = true;
  }

  function askToShareTestimonialComment() {
    var box = document.getElementById('svmShareBox');
    if (box) box.hidden = false;
  }

  function postTestimonialComment() {
    var input = document.getElementById('svmNewComment');
    if (!input || !input.value.trim()) return;
    var text = input.value.trim();
    var list = document.getElementById('svmCommentsList');
    var newMsg = document.createElement('div');
    newMsg.className = 'svm-comment-sample';
    newMsg.style.marginTop = '6px';
    newMsg.style.borderLeft = '3px solid #10b981';
    newMsg.innerHTML = '<strong>Tú:</strong> "' + escapeSvmText(text) + '"';
    list.appendChild(newMsg);
    input.value = '';
    lastTestimonialComment = text;
    askToShareTestimonialComment();
  }

  function shareTestimonialComment(network) {
    var comment = lastTestimonialComment || 'Mi testimonio en Educación Financiera';
    var url = window.location.href;
    var text = 'Mi testimonio en Educaci\u00f3n Financiera: \u201c' + comment + '\u201d';
    var share = '';
    if (network === 'facebook') {
      share = 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(url);
    } else if (network === 'x') {
      share = 'https://twitter.com/intent/tweet?text=' + encodeURIComponent(text) + '&url=' + encodeURIComponent(url);
    } else if (network === 'whatsapp') {
      share = 'https://wa.me/?text=' + encodeURIComponent(text + ' ' + url);
    }
    if (share) window.open(share, 'share', 'noopener,width=620,height=440');
    discardTestimonialCommentShare();
  }

  // ── Módulos y Lógica Interactiva de Hábitos Atómicos ──

  // 1. Selector de Pestañas del Hub Visual Interactivo
  function switchAtomicTab(tabName) {
    var tabs = ['simulador', 'bucle', 'reactor'];
    tabs.forEach(function(t) {
      var btn = document.getElementById('tabBtn' + t.charAt(0).toUpperCase() + t.slice(1));
      var panel = document.getElementById('tabPanel' + t.charAt(0).toUpperCase() + t.slice(1));
      if (btn) btn.classList.toggle('active', t === tabName);
      if (panel) {
        if (t === tabName) {
          panel.style.display = 'block';
          panel.classList.add('active');
        } else {
          panel.style.display = 'none';
          panel.classList.remove('active');
        }
      }
    });

    if (tabName === 'bucle') {
      selectQuadrant(1);
    }
  }

  // 2. Simulador Interactivo de la Regla del 1% Diario (James Clear)
  function updateAtomicSimulator(days) {
    days = parseInt(days, 10) || 1;
    var display = document.getElementById('simDaysDisplay');
    if (display) {
      display.textContent = 'Día ' + days + (days === 1 ? ' (Punto de partida)' : (days === 365 ? ' (1 Año: 37x)' : (days === 180 ? ' (Medio año)' : (days === 30 ? ' (1 Mes)' : ''))));
    }

    var posMult = Math.pow(1.01, days);
    var negMult = Math.pow(0.99, days);

    var multVal = document.getElementById('simMultiplierVal');
    if (multVal) {
      multVal.textContent = posMult.toFixed(2) + 'x';
    }

    var posValElem = document.getElementById('compPosValue');
    var negValElem = document.getElementById('compNegValue');
    var fillPos = document.getElementById('compFillPos');
    var fillNeg = document.getElementById('compFillNeg');
    var posDesc = document.getElementById('compPosDesc');
    var negDesc = document.getElementById('compNegDesc');

    if (posValElem) {
      var pct = Math.round((posMult - 1) * 100);
      posValElem.textContent = (posMult >= 1 ? '+' : '') + pct.toLocaleString() + '% (' + posMult.toFixed(2) + 'x)';
    }
    if (negValElem) {
      var negPct = Math.round((1 - negMult) * 100);
      negValElem.textContent = negMult.toFixed(2) + 'x (-' + negPct + '%)';
    }

    if (fillPos) {
      var wPos = Math.min(100, Math.max(8, (posMult / 37.78) * 100));
      fillPos.style.width = wPos + '%';
    }
    if (fillNeg) {
      var wNeg = Math.min(100, Math.max(3, negMult * 100));
      fillNeg.style.width = wNeg + '%';
    }

    if (posDesc) {
      var savings = Math.round(50 * days * posMult);
      posDesc.innerHTML = 'Con $50 MXN diarios de micro-ahorro constante, en ' + days + ' días acumulas una potencia de valor proyectada de <strong>$' + savings.toLocaleString() + ' MXN</strong> gracias al interés compuesto.';
    }
    if (negDesc) {
      var lost = Math.round(50 * days);
      negDesc.innerHTML = 'Un gasto hormiga impulsivo de $50 MXN diarios en ' + days + ' días te costó <strong>$' + lost.toLocaleString() + ' MXN</strong> perdidos y redujo tu patrimonio a solo ' + negMult.toFixed(2) + 'x de tu potencial.';
    }
  }

  function setSimDays(days) {
    days = parseInt(days, 10) || 1;
    var slider = document.getElementById('atomicDaysSlider');
    if (slider) {
      slider.value = days;
      updateAtomicSimulator(days);
    }
    var btns = document.querySelectorAll('.atomic-slider-presets .preset-btn');
    btns.forEach(function(b) {
      b.classList.remove('active');
      if (
        (days === 1 && (b.textContent.indexOf('Día 1') !== -1 || b.textContent.indexOf('Inicio') !== -1)) ||
        (days === 30 && b.textContent.indexOf('30d') !== -1) ||
        (days === 90 && b.textContent.indexOf('90d') !== -1) ||
        (days === 180 && b.textContent.indexOf('180d') !== -1) ||
        (days === 365 && (b.textContent.indexOf('365d') !== -1 || b.textContent.indexOf('1 Año') !== -1))
      ) {
        b.classList.add('active');
      }
    });
  }

  // Micro-ahorro interactivo en el banner
  var currentPiggySavings = 0;
  function interactivePiggyBank() {
    currentPiggySavings += 50;
    var amountEl = document.getElementById('simPiggyAmount');
    if (amountEl) {
      amountEl.textContent = '+$' + currentPiggySavings.toLocaleString() + ' MXN';
      amountEl.style.transform = 'scale(1.25)';
      amountEl.style.transition = 'transform 0.2s ease';
      setTimeout(function() { amountEl.style.transform = 'scale(1)'; }, 200);
    }
    var avatar = document.getElementById('bannerAvatarWrap');
    if (avatar) {
      avatar.style.transform = 'rotate(-10deg) scale(1.1)';
      avatar.style.transition = 'transform 0.25s ease';
      setTimeout(function() { avatar.style.transform = 'none'; }, 250);
    }
  }

  // 3. Cuadrantes Interactivos del Bucle del Hábito
  var quadrantData = {
    1: {
      name: '1ª Ley: Hazlo Obvio (La Señal)',
      desc: 'No dejes que tu dinero dependa de acordarte a fin de mes. Diseña tu entorno para que el estímulo del ahorro sea inevitable.',
      action: '🎯 Táctica: Regla de la Nómina Inmediata',
      example: 'El mismo día que recibes tu salario o ingresos por ventas, programa una transferencia automatizada a una cuenta apartada (ej. CETES Directo). Si no ves el dinero disponible en tu cuenta corriente, no lo gastarás.'
    },
    2: {
      name: '2ª Ley: Hazlo Atractivo (El Anhelo)',
      desc: 'El cerebro humano busca dopamina. Si ves el ahorro como "privación" o "aburrimiento", tu mente lo saboteará.',
      action: '🎯 Táctica: Vinculación con Tu Identidad',
      example: 'Renombra tu cuenta de banco de "Ahorro" a "Fondo de Libertad y Tranquilidad". Asocia cada peso guardado no con lo que te estás perdiendo hoy, sino con la libertad y paz mental que estás comprando para tu futuro.'
    },
    3: {
      name: '3ª Ley: Hazlo Sencillo (La Respuesta)',
      desc: 'Reduce la fricción para los buenos hábitos financieros y auméntala drásticamente para los malos hábitos.',
      action: '🎯 Táctica: Regla de los 20 Segundos de Fricción',
      example: 'Elimina las tarjetas de crédito guardadas en MercadoLibre o Amazon. Obligarte a buscar la cartera, sacar la tarjeta y escribir los 16 dígitos toma 20 segundos: tiempo suficiente para enfriar el impulso de compra.'
    },
    4: {
      name: '4ª Ley: Hazlo Satisfactorio (La Recompensa)',
      desc: 'Lo que se recompensa de inmediato se repite; lo que se castiga se evita. Necesitas sentir satisfacción instantánea al ahorrar.',
      action: '🎯 Táctica: Rastreador Visual de Hábitos',
      example: 'Lleva una cadena visual de días sin compras innecesarias. Marcar una palomita verde cada día activa un golpe de dopamina sano. La regla de James Clear: "Nunca rompas la cadena dos veces seguidas".'
    }
  };

  function selectQuadrant(num) {
    for (var i = 1; i <= 4; i++) {
      var c = document.getElementById('quad' + i);
      if (c) c.classList.toggle('active', i === num);
    }
    var box = document.getElementById('quadrantDetailBox');
    var data = quadrantData[num];
    if (box && data) {
      box.innerHTML = 
        '<div class="quad-detail-card">' +
          '<div class="quad-detail-title">' + data.name + '</div>' +
          '<p class="quad-detail-desc">' + data.desc + '</p>' +
          '<div class="quad-detail-tactic">' +
            '<strong>' + data.action + ':</strong> ' + data.example +
          '</div>' +
        '</div>';
    }
  }

  // 4. Glosarios y Textos Interactivos Expandibles
  function toggleGlossary(id) {
    var card = document.getElementById(id);
    if (!card) return;
    var isHidden = card.style.display === 'none' || card.style.display === '';
    card.style.display = isHidden ? 'block' : 'none';
  }

  // 5. Micro-Feedback Inmediato al Seleccionar Opciones (Hábitos Financieros)
  var optionInsights = {
    // 1. ¿Cómo administras tu dinero cuando recibes tus ingresos?
    '1_opt1': '🌟 <strong>¡Excelente hábito!</strong> Aplicas el principio fundamental: "Págate a ti mismo primero". Priorizar el ahorro antes del gasto asegura que tus fondos de libertad crezcan sin depender de lo que sobre.',
    '1_opt2': '💡 <strong>Hábito reactivo:</strong> Si esperas a ver qué sobra a fin de mes, casi nunca sobrará. James Clear recomienda programar un traspaso automático el día exacto de pago.',
    '1_opt3': '⚠️ <strong>Punto ciego crítico:</strong> Gastar sin control genera estrés y desorden. Para romper este ciclo, basta aplicar la Regla de los 2 Minutos y registrar tus compras diarias.',
    
    // 2. ¿Con qué frecuencia compras cosas que realmente no necesitas?
    '2_opt1': '🌟 <strong>¡Gran autocontrol!</strong> Sabes diferenciar entre un deseo momentáneo y una necesidad real, protegiendo tu dinero de compras impulsivas.',
    '2_opt2': '💡 <strong>Cuidado con los gastos hormiga:</strong> Varias compras pequeñas a la semana parecen inofensivas hoy, pero al cabo de un año representan miles de pesos que podrías haber invertido.',
    '2_opt3': '⚠️ <strong>Trampa de dopamina:</strong> Las compras por impulso responden a gratificación rápida. Solución de James Clear: aumenta la fricción borrando tus tarjetas guardadas en tu celular.',
    
    // 3. ¿Registras tus gastos diarios?
    '3_opt1': '🌟 <strong>¡1ª Ley: Hazlo Obvio!</strong> Llevar un registro claro te da el poder de decidir con información real. Lo que se mide se puede optimizar y mejorar.',
    '3_opt2': '💡 <strong>Falta de consistencia:</strong> Registrar solo de vez en cuando genera lagunas de información. No necesitas tablas complejas: anota en 30 segundos tus gastos en una nota rápida.',
    '3_opt3': '⚠️ <strong>Ceguera de gastos:</strong> No saber en qué se va el dinero es el mayor obstáculo para prosperar. Inicia hoy con la meta mínima de anotar 1 solo gasto al día.',
    
    // 4. ¿Tienes el hábito de ahorrar?
    '4_opt1': '🌟 <strong>¡Identidad Atómica Sólida!</strong> Has adoptado la identidad de una persona ahorradora e inversionista. Cada depósito es un voto a favor de tu libertad futura.',
    '4_opt2': '💡 <strong>Ahorro inconstante:</strong> Ahorrar "cuando se puede" depende de la suerte y el estado de ánimo. Convierte el ahorro en un sistema fijo, no en una casualidad.',
    '4_opt3': '⚠️ <strong>Oportunidad de oro:</strong> No necesitas miles de pesos para comenzar. Un hábito atómico de apartar $20 MXN diarios entrena la disciplina mental antes de que crezcan los montos.',
    
    // 5. ¿Qué haces cuando quieres comprar algo que te gusta?
    '5_opt1': '🌟 <strong>¡Filtro racional!</strong> Preguntarte si realmente lo necesitas te da una pausa consciente frente a los impulsos emocionales de consumo.',
    '5_opt2': '💡 <strong>Estrategia de enfriamiento:</strong> Dar un tiempo de espera (Regla de las 72 Horas) permite que el cerebro recupere la calma y decida sin el pico de emoción inicial.',
    '5_opt3': '⚠️ <strong>Compra inmediata:</strong> Comprar en el instante responde a gratificación inmediata. Añade fricción: retira los métodos de pago de un solo clic.',
    
    // 6. ¿Qué hábito financiero te gustaría cambiar?
    '6_opt1': '🎯 <strong>Objetivo fijado:</strong> Dejar de comprar por impulso. Usaremos la 3ª Ley Invertida (Hacerlo Difícil) para crear barreras entre la tentación y el pago.',
    '6_opt2': '🎯 <strong>Objetivo fijado:</strong> Evitar los gastos hormiga. Usaremos la 1ª Ley Invertida (Hacerlo Invisible) y la sustitución por micro-transferencias de ahorro.',
    '6_opt3': '🎯 <strong>Objetivo fijado:</strong> Aprender a ahorrar constantemente. Usaremos la 1ª Ley (Hacerlo Obvio) automatizando transferencias el día que recibes tu dinero.',
    '6_opt4': '🎯 <strong>Objetivo fijado:</strong> Organizar mejor mi dinero. Usaremos la Regla de los 2 Minutos para diseñar un presupuesto simple que no te quite tiempo.'
  };

  function showOptionInsight(qNum, optVal) {
    var box = document.getElementById('insightBox' + qNum);
    var key = qNum + '_' + optVal;
    if (box && optionInsights[key]) {
      box.innerHTML = optionInsights[key];
      box.style.display = 'block';
    }
  }

  // 6. Navegación Stepper Directa a Preguntas
  function jumpToQuestion(qNum) {
    var block = document.getElementById('qBlock' + qNum);
    if (block) {
      block.scrollIntoView({ behavior: 'smooth', block: 'center' });
      block.classList.add('pulse-highlight');
      setTimeout(function() { block.classList.remove('pulse-highlight'); }, 1200);
    }
  }

  // 7. Actualización de Progreso y Salud Atómica en Vivo
  function updateAtomicProgress() {
    var form = document.getElementById('atomicHabitsForm');
    if (!form) return;

    var questions = ['p1', 'p2', 'p3', 'p4', 'p5', 'p6'];
    var answeredCount = 0;
    var liveScore = 0;
    var scoreMap = { 'opt1': 3, 'opt2': 1, 'opt3': 0, 'opt4': 2 };

    questions.forEach(function(q, idx) {
      var selected = form.querySelector('input[name="' + q + '"]:checked');
      var block = document.getElementById('qBlock' + (idx + 1));
      var stepBtn = document.getElementById('stepBtn' + (idx + 1));
      var chip = document.getElementById('chipQ' + (idx + 1));

      if (selected) {
        answeredCount++;
        if (block) block.classList.remove('has-error');
        if (stepBtn) {
          stepBtn.classList.add('answered');
          stepBtn.innerHTML = '✓';
        }
        if (chip) chip.classList.add('active');

        // Preguntas 1 a 5 suman puntos de madurez de hábitos
        if (idx < 5) {
          liveScore += (scoreMap[selected.value] || 0);
        }
      } else {
        if (stepBtn) {
          stepBtn.classList.remove('answered');
          stepBtn.innerHTML = (idx + 1);
        }
        if (chip) chip.classList.remove('active');
      }
    });

    // Actualizar Contador y Barra (Tu diagnóstico: X de 6 respondidas)
    var counter = document.getElementById('atomicCounter');
    var bar = document.getElementById('atomicProgressBar');
    if (counter) counter.textContent = answeredCount + ' de 6 respondidas';
    if (bar) bar.style.width = Math.round((answeredCount / 6) * 100) + '%';

    // Diagnóstico en vivo (0 - 100%)
    var healthPct = answeredCount === 0 ? 0 : Math.round((liveScore / 15) * 100);
    var livePillNum = document.getElementById('liveScoreNum');
    if (livePillNum) {
      livePillNum.textContent = healthPct + '%';
    }

    // Actualizar Reactor en pestaña 3
    var reactorTitle = document.getElementById('reactorPowerTitle');
    var reactorDesc = document.getElementById('reactorPowerDesc');
    var reactorText = document.getElementById('reactorAtomText');
    if (reactorTitle) {
      reactorTitle.textContent = 'Diagnóstico de Hábitos: ' + answeredCount + ' de 6 (' + healthPct + '%)';
    }
    if (reactorText) {
      reactorText.textContent = healthPct > 0 ? healthPct + '%' : '1%';
    }
    if (reactorDesc) {
      reactorDesc.textContent = answeredCount === 6 
        ? '¡Diagnóstico 100% completado! Haz clic abajo en "Finalizar diagnóstico" para ver tu plan de transformación.'
        : 'Llevas ' + answeredCount + ' preguntas respondidas. Completa las ' + (6 - answeredCount) + ' restantes para calibrar tu perfil.';
    }

    var alertBox = document.getElementById('atomicValidationAlert');
    if (alertBox && answeredCount === 6) {
      alertBox.style.display = 'none';
    }
  }

  // 8. Envío y Diagnóstico Interactivo Completo
  function submitAtomicDiagnostic(e) {
    if (e) e.preventDefault();
    var form = document.getElementById('atomicHabitsForm');
    if (!form) return;

    var questions = ['p1', 'p2', 'p3', 'p4', 'p5', 'p6'];
    var unanswered = [];
    var firstUnansweredBlock = null;

    questions.forEach(function(q, idx) {
      var selected = form.querySelector('input[name="' + q + '"]:checked');
      var block = document.getElementById('qBlock' + (idx + 1));
      if (!selected) {
        unanswered.push(idx + 1);
        if (block) block.classList.add('has-error');
        if (!firstUnansweredBlock) firstUnansweredBlock = block;
      } else {
        if (block) block.classList.remove('has-error');
      }
    });

    var alertBox = document.getElementById('atomicValidationAlert');
    var missingCountSpan = document.getElementById('atomicMissingCount');

    if (unanswered.length > 0) {
      if (alertBox) {
        if (missingCountSpan) missingCountSpan.textContent = unanswered.length;
        alertBox.style.display = 'flex';
      }
      if (firstUnansweredBlock) {
        firstUnansweredBlock.scrollIntoView({ behavior: 'smooth', block: 'center' });
      }
      return;
    }

    if (alertBox) alertBox.style.display = 'none';

    // Puntuación de las preguntas 1 a 5 (madurez actual)
    var scoreMap = { 'opt1': 3, 'opt2': 1, 'opt3': 0 };
    var score = 0;
    for (var i = 1; i <= 5; i++) {
      var sel = form.querySelector('input[name="p' + i + '"]:checked');
      score += sel ? (scoreMap[sel.value] || 0) : 0;
    }

    var pctScore = Math.round((score / 15) * 100);

    // Hábito objetivo seleccionado en Pregunta 6
    var q6Sel = form.querySelector('input[name="p6"]:checked');
    var targetHabitKey = q6Sel ? q6Sel.value : 'opt1';

    var targetHabitConfig = {
      'opt1': {
        title: 'Dejar de comprar por impulso',
        prompt: 'sentir el deseo urgente de comprar un artículo no esencial',
        action: 'esperaré 72 horas y calcularé su valor en horas de trabajo antes de realizar el pago',
        laws: [
          { num: '1ª Ley Invertida: Hazlo Invisible', title: 'Elimina las Tentaciones', desc: 'Desinstala las apps de compras compulsivas de la pantalla de inicio de tu celular para no ver ofertas.' },
          { num: '2ª Ley Invertida: Hazlo Poco Atractivo', title: 'Calcula el Tiempo de Vida', desc: 'Convierte el precio del artículo a las horas de trabajo reales que te costó ganarlo: ¿vale 8 horas de tu vida?' },
          { num: '3ª Ley Invertida: Hazlo Difícil', title: 'Aumenta la Fricción de Pago', desc: 'Borra las tarjetas de crédito almacenadas en navegadores o tiendas digitales para evitar compras en 1 clic.' },
          { num: '4ª Ley: Hazlo Satisfactorio', title: 'Recompensa el Autocontrol', desc: 'Cada compra impulsiva evitada, transfiere el 50% de su valor a tu fondo de ahorro y felicítate conscientemente.' }
        ]
      },
      'opt2': {
        title: 'Evitar los gastos hormiga',
        prompt: 'tener el impulso de comprar un café, snack o comida rápida innecesaria',
        action: 'transferiré de inmediato esos $50 MXN a mi cuenta de ahorro en menos de 2 minutos',
        laws: [
          { num: '1ª Ley: Hazlo Obvio', title: 'Prepara tu Alternativa', desc: 'Lleva tu termo de café o snack preparado desde casa para que la opción económica sea visible y accesible.' },
          { num: '2ª Ley: Hazlo Atractivo', title: 'Micro-Interés Compuesto', desc: 'Recuerda que $50 MXN diarios evitados representan más de $18,000 MXN al año listos para invertir.' },
          { num: '3ª Ley: Hazlo Sencillo', title: 'Regla de Sustitución Directa', desc: 'Reemplaza el acto de comprar con un micro-ahorro de 2 minutos en tu banca móvil cada vez que sientas el antojo.' },
          { num: '4ª Ley: Hazlo Satisfactorio', title: 'Rastreador de Días Limpios', desc: 'Lleva un calendario visual marcando cada día sin gastos hormiga: "No rompas la cadena dos veces seguidas".' }
        ]
      },
      'opt3': {
        title: 'Aprender a ahorrar constantemente',
        prompt: 'recibir el depósito de mi sueldo o ingresos por ventas',
        action: 'apartaré de forma inmediata el 10% a una cuenta de ahorro programado antes de hacer cualquier gasto',
        laws: [
          { num: '1ª Ley: Hazlo Obvio', title: 'Págate a Ti Primero', desc: 'Automatiza una orden de transferencia bancaria el mismo día de nómina para que el ahorro ocurra sin esfuerzo.' },
          { num: '2ª Ley: Hazlo Atractivo', title: 'Bautiza tu Cuenta de Ahorro', desc: 'Renombra tu cuenta de banco como "Fondo de Tranquilidad y Libertad" para vincularlo a tu identidad y paz mental.' },
          { num: '3ª Ley: Hazlo Sencillo', title: 'Comienza con la Regla del 1%', desc: 'No intentes ahorrar el 50% de golpe; comienza con el 5% o 10% para que el sistema sea fácil y sostenible.' },
          { num: '4ª Ley: Hazlo Satisfactorio', title: 'Celebra tus Metas Mensuales', desc: 'Al final de cada mes, observa el total acumulado y date una pequeña recompensa sana por mantener la disciplina.' }
        ]
      },
      'opt4': {
        title: 'Organizar mejor mi dinero',
        prompt: 'terminar de cenar cada noche antes de dormir',
        action: 'registraré mis gastos del día en una app simple en menos de 2 minutos',
        laws: [
          { num: '1ª Ley: Hazlo Obvio', title: 'Coloca tu App a la Vista', desc: 'Pon el acceso directo de tu app de gastos o bloc de notas en la pantalla principal de tu teléfono.' },
          { num: '2ª Ley: Hazlo Atractivo', title: 'Claridad vs Estrés', desc: 'Asocia el registro con la sensación de calma y control total sobre tu futuro financiero.' },
          { num: '3ª Ley: Hazlo Sencillo', title: 'Regla de los 2 Minutos', desc: 'Estandariza antes de optimizar: anota solo el total y categoría rápida sin complicarte con fórmulas complejas.' },
          { num: '4ª Ley: Hazlo Satisfactorio', title: 'Revisión Semanal Exitosa', desc: 'Dedica 5 minutos los domingos a ver el balance de tu semana y planificar la siguiente con tranquilidad.' }
        ]
      }
    };

    var currentTarget = targetHabitConfig[targetHabitKey] || targetHabitConfig['opt1'];

    var profileTitle = '';
    var profileBadge = '';
    var badgeClass = '';
    var profileDesc = '';

    if (score >= 12) {
      profileTitle = 'Arquitecto Financiero Consciente';
      profileBadge = '🏆 Dominio Sólido de Hábitos (Alto)';
      badgeClass = 'badge-success';
      profileDesc = '¡Felicidades! Tienes excelentes bases y comprendes la importancia de diseñar sistemas diarios. Para llevar tu dinero al siguiente nivel, enfocaremos tus esfuerzos en optimizar el hábito que elegiste: <strong>' + currentTarget.title + '</strong>.';
    } else if (score >= 7) {
      profileTitle = 'Constructor en Transición';
      profileBadge = '🌱 En Proceso de Mejora (Medio)';
      badgeClass = 'badge-warning';
      profileDesc = 'Tienes buenas intenciones y algunos hábitos positivos, pero la falta de sistemas automáticos provoca inconsistencia en tus resultados. Aplicando las 4 Leyes de James Clear lograremos instalar el hábito de <strong>' + currentTarget.title + '</strong> con facilidad.';
    } else {
      profileTitle = 'Enfoque Reactivo: Momento de Instalar Sistemas';
      profileBadge = '💡 Fase de Despertar Financiero (Inicial)';
      badgeClass = 'badge-alert';
      profileDesc = 'Actualmente tus comportamientos financieros responden más al impulso y a la inmediatez que a un sistema estructurado. La buena noticia: según <em>Hábitos Atómicos</em>, no necesitas más fuerza de voluntad, sino diseñar un entorno que te facilite tomar buenas decisiones.';
    }

    var resultBox = document.getElementById('atomicResultSection');
    if (!resultBox) return;

    var lawsHtml = '';
    currentTarget.laws.forEach(function(law) {
      lawsHtml += '<div class="atomic-law-card">' +
                    '<div class="atomic-law-num">' + law.num + '</div>' +
                    '<div class="atomic-law-title">' + law.title + '</div>' +
                    '<p class="atomic-law-desc">' + law.desc + '</p>' +
                  '</div>';
    });

    resultBox.innerHTML = 
      '<div class="atomic-res-header">' +
        '<div>' +
          '<span class="atomic-res-badge ' + badgeClass + '">' + profileBadge + '</span>' +
          '<h3 class="atomic-res-title">' + profileTitle + '</h3>' +
          '<div class="atomic-res-score">Madurez de Hábitos Actual: <strong>' + score + ' de 15 puntos</strong> (' + pctScore + '% de alineación)</div>' +
        '</div>' +
      '</div>' +
      '<div class="atomic-res-body">' +
        '<p>' + profileDesc + '</p>' +
        '<div class="atomic-target-box">' +
          '<div class="atomic-target-title">🎯 Hábito Seleccionado para Transformar: ' + currentTarget.title + '</div>' +
          '<p style="margin: 0; font-size: 14.5px; color: #e2e8f0;">Siguiendo los principios de James Clear, el cambio duradero no proviene de metas gigantescas, sino de instalar una <strong>Intención de Implementación</strong> clara y reducir la fricción inicial.</p>' +
        '</div>' +
        
        <!-- Creador Interactivo de Intención de Implementación Personalizada -->
        '<div class="atomic-intention-box">' +
          '<div class="atomic-intention-head">' +
            '<span>✍️ Tu Fórmula de Compromiso Atómico (James Clear):</span>' +
          '</div>' +
          '<div class="atomic-intention-formula">' +
            '«Después de <span class="intent-highlight" id="intentPromptText">' + currentTarget.prompt + '</span>, yo <span class="intent-highlight" id="intentActionText">' + currentTarget.action + '</span>.»' +
          '</div>' +
          '<button type="button" class="atomic-copy-intent-btn" onclick="copyAtomicCommitment()">' +
            '📋 Copiar mi compromiso diario' +
          '</button>' +
          '<span id="intentCopiedMsg" style="display:none; color:#34d399; font-size:13px; font-weight:600; margin-left:10px;">¡Copiado al portapapeles!</span>' +
        '</div>' +

        '<h4 style="color: #ffffff; font-size: 16px; margin: 20px 0 10px 0;">Plan de Acción con las 4 Leyes de James Clear para ' + currentTarget.title + ':</h4>' +
        '<div class="atomic-laws-grid">' + lawsHtml + '</div>' +
        '<div class="atomic-res-quote">' +
          '«No te elevas al nivel de tus metas. Caes al nivel de tus sistemas. Tus hábitos son el interés compuesto de la superación personal.»<br>' +
          '<strong>— James Clear, Hábitos Atómicos</strong>' +
        '</div>' +
        '<div class="atomic-res-actions">' +
          '<button type="button" class="atomic-btn-restart" onclick="resetAtomicDiagnostic()">🔄 Modificar o repetir respuestas</button>' +
          '<a href="index.php?page=cursos" class="atomic-btn-course">📚 Comenzar Curso: Psicología del Dinero y Hábitos →</a>' +
        '</div>' +
      '</div>';

    resultBox.style.display = 'block';
    resultBox.scrollIntoView({ behavior: 'smooth', block: 'start' });
  }

  function copyAtomicCommitment() {
    var pText = document.getElementById('intentPromptText');
    var aText = document.getElementById('intentActionText');
    if (!pText || !aText) return;
    var full = 'Mi compromiso atómico: «Después de ' + pText.textContent + ', yo ' + aText.textContent + '.»';
    if (navigator.clipboard) {
      navigator.clipboard.writeText(full).then(function() {
        var msg = document.getElementById('intentCopiedMsg');
        if (msg) {
          msg.style.display = 'inline';
          setTimeout(function() { msg.style.display = 'none'; }, 2500);
        }
      });
    } else {
      alert(full);
    }
  }

  function resetAtomicDiagnostic() {
    var form = document.getElementById('atomicHabitsForm');
    if (form) form.reset();

    var counter = document.getElementById('atomicCounter');
    var bar = document.getElementById('atomicProgressBar');
    if (counter) counter.textContent = '0 de 6 respondidas';
    if (bar) bar.style.width = '0%';

    var liveScore = document.getElementById('liveScoreNum');
    if (liveScore) liveScore.textContent = '0%';

    var resultBox = document.getElementById('atomicResultSection');
    if (resultBox) {
      resultBox.style.display = 'none';
      resultBox.innerHTML = '';
    }

    var alertBox = document.getElementById('atomicValidationAlert');
    if (alertBox) alertBox.style.display = 'none';

    for (var i = 1; i <= 6; i++) {
      var block = document.getElementById('qBlock' + i);
      var stepBtn = document.getElementById('stepBtn' + i);
      var chip = document.getElementById('chipQ' + i);
      var insight = document.getElementById('insightBox' + i);
      var gloss = document.getElementById('glosario' + i);
      if (block) block.classList.remove('has-error');
      if (stepBtn) { stepBtn.classList.remove('answered'); stepBtn.innerHTML = i; }
      if (chip) chip.classList.remove('active');
      if (insight) insight.style.display = 'none';
      if (gloss) gloss.style.display = 'none';
    }

    // Reiniciar slider a Día 1
    if (typeof setSimDays === 'function') setSimDays(1);

    var card = document.querySelector('.atomic-card-container');
    if (card) card.scrollIntoView({ behavior: 'smooth', block: 'start' });
  }

  // Inicializar cuadrante 1 por defecto y slider en Día 1
  document.addEventListener('DOMContentLoaded', function() {
    if (typeof selectQuadrant === 'function') selectQuadrant(1);
    if (typeof setSimDays === 'function') setSimDays(1);
  });

  // Cerrar con Escape
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' || e.key === 'Esc') {
      closeStudentTestimonial();
    }
  });

  // Cerrar con Escape
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' || e.key === 'Esc') {
      closeStudentTestimonial();
    }
  });
</script>
