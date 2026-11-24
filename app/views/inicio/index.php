<?php
/**
 * Vista: Inicio
 * Contenido migrado desde index.html (legacy/html).
 * Variables: $pageTitle, $pageCss, $bodyClass, $user
 */
?>
  <div class="main-wrapper" id="mainWrapper">
<!-- ============================================================
       SPLASH SCREEN — FONDO ILUSTRADO
       (Se omite cuando se llega desde "Inicio" con ?skip_splash=1)
       ============================================================ -->
  <?php if (empty($_GET['skip_splash'])): ?>
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
        <div class="splash-cap"><i class="fi fi-rr-graduation-cap"></i></div>

        <!-- Libro 3D con páginas animadas -->
        <div class="splash-book" aria-label="Libro de educación financiera">
          <!-- Tapa izquierda (portada) -->
          <div class="book-cover-left">
            <span class="book-cover-icon"><i class="fi fi-rr-sack-dollar"></i></span>
            <span class="book-cover-title">Finanzas</span>
          </div>

          <!-- Lomo -->
          <div class="book-spine"></div>

          <!-- Tapa derecha (contraportada) -->
          <div class="book-cover-right">
            <span class="book-cover-icon"><i class="fi fi-rr-chart-line-up"></i></span>
          </div>

          <!-- Páginas que se voltean (animadas en secuencia) -->
          <div class="book-page page-1">
            <div class="page-front">
              <span class="page-icon"><i class="fi fi-rr-bulb"></i></span>
              <span class="page-text">Hábitos<br>Atómicos</span>
            </div>
            <div class="page-back">
              <span class="page-icon"><i class="fi fi-rr-target"></i></span>
              <span class="page-text">Metas<br>Claras</span>
            </div>
          </div>

          <div class="book-page page-2">
            <div class="page-front">
              <span class="page-icon"><i class="fi fi-rr-chart-histogram"></i></span>
              <span class="page-text">Ahorra<br>el 1%</span>
            </div>
            <div class="page-back">
              <span class="page-icon"><i class="fi fi-rr-bank"></i></span>
              <span class="page-text">Crece<br>Día a Día</span>
            </div>
          </div>

          <div class="book-page page-3">
            <div class="page-front">
              <span class="page-icon"><i class="fi fi-rr-check"></i></span>
              <span class="page-text">Buenos<br>Hábitos</span>
            </div>
            <div class="page-back">
              <span class="page-icon"><i class="fi fi-rr-rocket"></i></span>
              <span class="page-text">¡Tú<br>Puedes!</span>
            </div>
          </div>

          <div class="book-page page-4">
            <div class="page-front">
              <span class="page-icon"><i class="fi fi-rr-money-bill-wave"></i></span>
              <span class="page-text">Invierte<br>Hoy</span>
            </div>
            <div class="page-back">
              <span class="page-icon"><i class="fi fi-sr-star" style="color:#F5B800;"></i></span>
              <span class="page-text">Éxito<br>Financiero</span>
            </div>
          </div>
        </div>

        <!-- Partículas decorativas flotantes -->
        <span class="splash-particle p1">$</span>
        <span class="splash-particle p2">%</span>
        <span class="splash-particle p3"><i class="fi fi-rr-chart-line-up"></i></span>
        <span class="splash-particle p4"><i class="fi fi-rr-gem"></i></span>
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
  <?php endif; ?>
  <!-- FIN SPLASH -->

      <!-- HEADER -->
  <header class="site-header hero-header-bar">
    <div class="container nav-wrap hero-nav-wrap">
      <div class="hero-brand-group">
        <a href="index.php?page=home&skip_splash=1" class="brand-logo hero-brand">
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

      <!-- Botón de acceso en header principal -->
      <div style="display: flex; align-items: center; gap: 10px;">
        <button type="button" class="topbar-login-btn" onclick="abrirLoginDesdeHeader(); return false;">
          <i class="fi fi-sr-sign-in-alt" style="font-size: 15px; color: #28C76F;"></i>
          <span>Iniciar sesión</span>
        </button>
        <a href="javascript:void(0)" onclick="openAdminLogin(); return false;" class="topbar-admin-btn" id="btnAccesoAdmin" title="Acceso al Panel de Administrador">
          <i class="fi fi-sr-shield-check" style="font-size: 15px; color: #fabb15;"></i>
          <span>Acceder como Administrador</span>
        </a>
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
              <span class="hcard-icon"><i class="fi fi-rr-graduation-cap"></i></span>
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

    <!-- ── GRID DE ESTUDIANTES A ANCHO COMPLETO (SIN COLUMNA DERECHA) ── -->
    <div class="students-cards-full-grid">

      <!-- Tarjeta 1: Mariana González -->
      <div class="mock-student-card" onclick="openStudentTestimonial('mariana')" style="cursor: pointer;" title="Clic para ver testimonio en video">
        <div class="msc-header">
          <span class="msc-medal" title="Medalla de Oro"><svg viewBox="0 0 24 24" width="26" height="26" aria-hidden="true"><circle cx="12" cy="14" r="7" fill="#f59e0b" stroke="#b45309" stroke-width="1.5"/><circle cx="12" cy="14" r="4" fill="#fde68a"/><path d="M8 3h3v7l-1.5-1L8 10V3zm5 0h3v7l-1.5-1L13 10V3z" fill="#fbbf24" stroke="#b45309" stroke-width="0.8"/></svg></span>
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
          <div class="msc-video-preview">
            <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=500&auto=format&fit=crop&q=80" alt="Video testimonio de Mariana González" class="msc-video-thumb" loading="lazy">
            <span class="msc-video-play" aria-hidden="true"><svg viewBox="0 0 24 24" width="22" height="22" fill="currentColor"><polygon points="6 3 20 12 6 21 6 3"/></svg></span>
          </div>
          <div class="msc-actions-row">
            <div class="msc-reaction-box" onclick="event.stopPropagation();">
              <div class="msc-reactions-tray" role="toolbar" aria-label="Reacciones">
                <button type="button" class="msc-reaction-opt" data-reaction="like" data-emoji="👍" data-label="Me gusta" data-color="#1877f2" onclick="selectCardReaction(this, event);" aria-label="Me gusta">
                  <span class="msc-opt-emoji">👍</span>
                  <span class="msc-opt-tooltip">Me gusta</span>
                </button>
                <button type="button" class="msc-reaction-opt" data-reaction="love" data-emoji="❤️" data-label="Me encanta" data-color="#f33e5b" onclick="selectCardReaction(this, event);" aria-label="Me encanta">
                  <span class="msc-opt-emoji">❤️</span>
                  <span class="msc-opt-tooltip">Me encanta</span>
                </button>
                <button type="button" class="msc-reaction-opt" data-reaction="care" data-emoji="🥰" data-label="Me importa" data-color="#f59e0b" onclick="selectCardReaction(this, event);" aria-label="Me importa">
                  <span class="msc-opt-emoji">🥰</span>
                  <span class="msc-opt-tooltip">Me importa</span>
                </button>
                <button type="button" class="msc-reaction-opt" data-reaction="wow" data-emoji="😮" data-label="Me asombra" data-color="#eab308" onclick="selectCardReaction(this, event);" aria-label="Me asombra">
                  <span class="msc-opt-emoji">😮</span>
                  <span class="msc-opt-tooltip">Me asombra</span>
                </button>
                <button type="button" class="msc-reaction-opt" data-reaction="inspire" data-emoji="👏" data-label="Me inspira" data-color="#10b981" onclick="selectCardReaction(this, event);" aria-label="Me inspira">
                  <span class="msc-opt-emoji">👏</span>
                  <span class="msc-opt-tooltip">Me inspira</span>
                </button>
                <button type="button" class="msc-reaction-opt" data-reaction="fire" data-emoji="🔥" data-label="Imparable" data-color="#f97316" onclick="selectCardReaction(this, event);" aria-label="Imparable">
                  <span class="msc-opt-emoji">🔥</span>
                  <span class="msc-opt-tooltip">Imparable</span>
                </button>
              </div>
              <button type="button" class="msc-action-btn msc-reaction-main-btn" onclick="toggleCardDefaultReaction(this, event);" aria-label="Reaccionar">
                <span class="msc-btn-icon"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg></span>
                <span class="msc-btn-label">Me gusta</span> <span class="like-count">48</span>
              </button>
            </div>
            <button type="button" class="msc-action-btn" onclick="openStudentTestimonial('mariana'); event.stopPropagation();">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
              <span>Comentarios</span> <span>14</span>
            </button>
            <span title="Logro Verificado" class="msc-badge-icon"><svg viewBox="0 0 24 24" width="20" height="20" aria-hidden="true"><circle cx="12" cy="12" r="9" fill="#dcfce7" stroke="#16a34a" stroke-width="1.5"/><path d="M8 12.5l2.5 2.5L16 9" stroke="#15803d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
          </div>
        </div>
      </div>

      <!-- Tarjeta 2: Jorge Martínez -->
      <div class="mock-student-card" onclick="openStudentTestimonial('jorge')" style="cursor: pointer;" title="Clic para ver testimonio en video">
        <div class="msc-header">
          <span class="msc-medal" title="Medalla de Plata"><svg viewBox="0 0 24 24" width="26" height="26" aria-hidden="true"><circle cx="12" cy="14" r="7" fill="#9ca3af" stroke="#6b7280" stroke-width="1.5"/><circle cx="12" cy="14" r="4" fill="#e5e7eb"/><path d="M8 3h3v7l-1.5-1L8 10V3zm5 0h3v7l-1.5-1L13 10V3z" fill="#cbd5e1" stroke="#6b7280" stroke-width="0.8"/></svg></span>
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
          <div class="msc-video-preview">
            <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?w=500&auto=format&fit=crop&q=80" alt="Video testimonio de Jorge Martínez" class="msc-video-thumb" loading="lazy">
            <span class="msc-video-play" aria-hidden="true"><svg viewBox="0 0 24 24" width="22" height="22" fill="currentColor"><polygon points="6 3 20 12 6 21 6 3"/></svg></span>
          </div>
          <div class="msc-actions-row">
            <div class="msc-reaction-box" onclick="event.stopPropagation();">
              <div class="msc-reactions-tray" role="toolbar" aria-label="Reacciones">
                <button type="button" class="msc-reaction-opt" data-reaction="like" data-emoji="👍" data-label="Me gusta" data-color="#1877f2" onclick="selectCardReaction(this, event);" aria-label="Me gusta">
                  <span class="msc-opt-emoji">👍</span>
                  <span class="msc-opt-tooltip">Me gusta</span>
                </button>
                <button type="button" class="msc-reaction-opt" data-reaction="love" data-emoji="❤️" data-label="Me encanta" data-color="#f33e5b" onclick="selectCardReaction(this, event);" aria-label="Me encanta">
                  <span class="msc-opt-emoji">❤️</span>
                  <span class="msc-opt-tooltip">Me encanta</span>
                </button>
                <button type="button" class="msc-reaction-opt" data-reaction="care" data-emoji="🥰" data-label="Me importa" data-color="#f59e0b" onclick="selectCardReaction(this, event);" aria-label="Me importa">
                  <span class="msc-opt-emoji">🥰</span>
                  <span class="msc-opt-tooltip">Me importa</span>
                </button>
                <button type="button" class="msc-reaction-opt" data-reaction="wow" data-emoji="😮" data-label="Me asombra" data-color="#eab308" onclick="selectCardReaction(this, event);" aria-label="Me asombra">
                  <span class="msc-opt-emoji">😮</span>
                  <span class="msc-opt-tooltip">Me asombra</span>
                </button>
                <button type="button" class="msc-reaction-opt" data-reaction="inspire" data-emoji="👏" data-label="Me inspira" data-color="#10b981" onclick="selectCardReaction(this, event);" aria-label="Me inspira">
                  <span class="msc-opt-emoji">👏</span>
                  <span class="msc-opt-tooltip">Me inspira</span>
                </button>
                <button type="button" class="msc-reaction-opt" data-reaction="fire" data-emoji="🔥" data-label="Imparable" data-color="#f97316" onclick="selectCardReaction(this, event);" aria-label="Imparable">
                  <span class="msc-opt-emoji">🔥</span>
                  <span class="msc-opt-tooltip">Imparable</span>
                </button>
              </div>
              <button type="button" class="msc-action-btn msc-reaction-main-btn" onclick="toggleCardDefaultReaction(this, event);" aria-label="Reaccionar">
                <span class="msc-btn-icon"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg></span>
                <span class="msc-btn-label">Me gusta</span> <span class="like-count">35</span>
              </button>
            </div>
            <button type="button" class="msc-action-btn" onclick="openStudentTestimonial('jorge'); event.stopPropagation();">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
              <span>Comentarios</span> <span>9</span>
            </button>
            <span title="Control Financiero Logrado" class="msc-badge-icon"><svg viewBox="0 0 24 24" width="20" height="20" aria-hidden="true"><rect x="4" y="4" width="16" height="16" rx="4" fill="#e0f2fe" stroke="#0284c7" stroke-width="1.5"/><rect x="7" y="11" width="2.5" height="5" rx="1" fill="#0284c7"/><rect x="10.8" y="9" width="2.5" height="7" rx="1" fill="#0ea5e9"/><rect x="14.5" y="7" width="2.5" height="9" rx="1" fill="#38bdf8"/></svg></span>
          </div>
        </div>
      </div>

      <!-- Tarjeta 3: Ana López -->
      <div class="mock-student-card" onclick="openStudentTestimonial('ana')" style="cursor: pointer;" title="Clic para ver testimonio en video">
        <div class="msc-header">
          <span class="msc-medal" title="Insignia de Excelencia"><svg viewBox="0 0 24 24" width="26" height="26" aria-hidden="true"><path d="M12 3l2.2 4.5 5 .7-3.6 3.5.9 5-4.5-2.4-4.5 2.4.9-5L4.8 8.2l5-.7L12 3z" fill="#38bdf8" stroke="#0284c7" stroke-width="1.2"/><path d="M9 17l3 4 3-4" fill="#bae6fd" stroke="#0284c7" stroke-width="1"/></svg></span>
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
          <div class="msc-video-preview">
            <img src="https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=500&auto=format&fit=crop&q=80" alt="Video testimonio de Ana López" class="msc-video-thumb" loading="lazy">
            <span class="msc-video-play" aria-hidden="true"><svg viewBox="0 0 24 24" width="22" height="22" fill="currentColor"><polygon points="6 3 20 12 6 21 6 3"/></svg></span>
          </div>
          <div class="msc-actions-row">
            <div class="msc-reaction-box" onclick="event.stopPropagation();">
              <div class="msc-reactions-tray" role="toolbar" aria-label="Reacciones">
                <button type="button" class="msc-reaction-opt" data-reaction="like" data-emoji="👍" data-label="Me gusta" data-color="#1877f2" onclick="selectCardReaction(this, event);" aria-label="Me gusta">
                  <span class="msc-opt-emoji">👍</span>
                  <span class="msc-opt-tooltip">Me gusta</span>
                </button>
                <button type="button" class="msc-reaction-opt" data-reaction="love" data-emoji="❤️" data-label="Me encanta" data-color="#f33e5b" onclick="selectCardReaction(this, event);" aria-label="Me encanta">
                  <span class="msc-opt-emoji">❤️</span>
                  <span class="msc-opt-tooltip">Me encanta</span>
                </button>
                <button type="button" class="msc-reaction-opt" data-reaction="care" data-emoji="🥰" data-label="Me importa" data-color="#f59e0b" onclick="selectCardReaction(this, event);" aria-label="Me importa">
                  <span class="msc-opt-emoji">🥰</span>
                  <span class="msc-opt-tooltip">Me importa</span>
                </button>
                <button type="button" class="msc-reaction-opt" data-reaction="wow" data-emoji="😮" data-label="Me asombra" data-color="#eab308" onclick="selectCardReaction(this, event);" aria-label="Me asombra">
                  <span class="msc-opt-emoji">😮</span>
                  <span class="msc-opt-tooltip">Me asombra</span>
                </button>
                <button type="button" class="msc-reaction-opt" data-reaction="inspire" data-emoji="👏" data-label="Me inspira" data-color="#10b981" onclick="selectCardReaction(this, event);" aria-label="Me inspira">
                  <span class="msc-opt-emoji">👏</span>
                  <span class="msc-opt-tooltip">Me inspira</span>
                </button>
                <button type="button" class="msc-reaction-opt" data-reaction="fire" data-emoji="🔥" data-label="Imparable" data-color="#f97316" onclick="selectCardReaction(this, event);" aria-label="Imparable">
                  <span class="msc-opt-emoji">🔥</span>
                  <span class="msc-opt-tooltip">Imparable</span>
                </button>
              </div>
              <button type="button" class="msc-action-btn msc-reaction-main-btn" onclick="toggleCardDefaultReaction(this, event);" aria-label="Reaccionar">
                <span class="msc-btn-icon"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg></span>
                <span class="msc-btn-label">Me gusta</span> <span class="like-count">62</span>
              </button>
            </div>
            <button type="button" class="msc-action-btn" onclick="openStudentTestimonial('ana'); event.stopPropagation();">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
              <span>Comentarios</span> <span>18</span>
            </button>
            <span title="Deuda Cero" class="msc-badge-icon"><svg viewBox="0 0 24 24" width="20" height="20" aria-hidden="true"><ellipse cx="12" cy="8" rx="7" ry="3" fill="#fde68a" stroke="#d97706" stroke-width="1.3"/><path d="M5 8v4c0 1.7 3.1 3 7 3s7-1.3 7-3V8" fill="#fcd34d" stroke="#d97706" stroke-width="1.3"/><path d="M5 12v4c0 1.7 3.1 3 7 3s7-1.3 7-3v-4" fill="#fbbf24" stroke="#d97706" stroke-width="1.3"/></svg></span>
          </div>
        </div>
      </div>

      <!-- Tarjeta 4: Roberto y Silvia -->
      <div class="mock-student-card" onclick="openStudentTestimonial('roberto')" style="cursor: pointer;" title="Clic para ver testimonio en video">
        <div class="msc-header">
          <span class="msc-medal" title="Escudo de Protección"><svg viewBox="0 0 24 24" width="26" height="26" aria-hidden="true"><path d="M12 3l7 3v5c0 5-3.5 8.5-7 10-3.5-1.5-7-5-7-10V6l7-3z" fill="#34d399" stroke="#059669" stroke-width="1.3"/><path d="M9.5 12.5l1.8 1.8 3.7-4" stroke="#064e3b" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
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
          <div class="msc-video-preview">
            <img src="https://images.unsplash.com/photo-1581579438747-1dc8d17bbce4?w=500&auto=format&fit=crop&q=80" alt="Video testimonio de Roberto y Silvia" class="msc-video-thumb" loading="lazy">
            <span class="msc-video-play" aria-hidden="true"><svg viewBox="0 0 24 24" width="22" height="22" fill="currentColor"><polygon points="6 3 20 12 6 21 6 3"/></svg></span>
          </div>
          <div class="msc-actions-row">
            <div class="msc-reaction-box" onclick="event.stopPropagation();">
              <div class="msc-reactions-tray" role="toolbar" aria-label="Reacciones">
                <button type="button" class="msc-reaction-opt" data-reaction="like" data-emoji="👍" data-label="Me gusta" data-color="#1877f2" onclick="selectCardReaction(this, event);" aria-label="Me gusta">
                  <span class="msc-opt-emoji">👍</span>
                  <span class="msc-opt-tooltip">Me gusta</span>
                </button>
                <button type="button" class="msc-reaction-opt" data-reaction="love" data-emoji="❤️" data-label="Me encanta" data-color="#f33e5b" onclick="selectCardReaction(this, event);" aria-label="Me encanta">
                  <span class="msc-opt-emoji">❤️</span>
                  <span class="msc-opt-tooltip">Me encanta</span>
                </button>
                <button type="button" class="msc-reaction-opt" data-reaction="care" data-emoji="🥰" data-label="Me importa" data-color="#f59e0b" onclick="selectCardReaction(this, event);" aria-label="Me importa">
                  <span class="msc-opt-emoji">🥰</span>
                  <span class="msc-opt-tooltip">Me importa</span>
                </button>
                <button type="button" class="msc-reaction-opt" data-reaction="wow" data-emoji="😮" data-label="Me asombra" data-color="#eab308" onclick="selectCardReaction(this, event);" aria-label="Me asombra">
                  <span class="msc-opt-emoji">😮</span>
                  <span class="msc-opt-tooltip">Me asombra</span>
                </button>
                <button type="button" class="msc-reaction-opt" data-reaction="inspire" data-emoji="👏" data-label="Me inspira" data-color="#10b981" onclick="selectCardReaction(this, event);" aria-label="Me inspira">
                  <span class="msc-opt-emoji">👏</span>
                  <span class="msc-opt-tooltip">Me inspira</span>
                </button>
                <button type="button" class="msc-reaction-opt" data-reaction="fire" data-emoji="🔥" data-label="Imparable" data-color="#f97316" onclick="selectCardReaction(this, event);" aria-label="Imparable">
                  <span class="msc-opt-emoji">🔥</span>
                  <span class="msc-opt-tooltip">Imparable</span>
                </button>
              </div>
              <button type="button" class="msc-action-btn msc-reaction-main-btn" onclick="toggleCardDefaultReaction(this, event);" aria-label="Reaccionar">
                <span class="msc-btn-icon"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg></span>
                <span class="msc-btn-label">Me gusta</span> <span class="like-count">29</span>
              </button>
            </div>
            <button type="button" class="msc-action-btn" onclick="openStudentTestimonial('roberto'); event.stopPropagation();">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
              <span>Comentarios</span> <span>7</span>
            </button>
            <span title="Familia Asegurada" class="msc-badge-icon"><svg viewBox="0 0 24 24" width="20" height="20" aria-hidden="true"><path d="M3 11.5L12 4l9 7.5" stroke="#2563eb" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/><path d="M6 10.5V19h12v-8.5" fill="#dbeafe" stroke="#2563eb" stroke-width="1.4"/><rect x="10" y="13" width="4" height="6" rx="1" fill="#93c5fd" stroke="#2563eb" stroke-width="1"/></svg></span>
          </div>
        </div>
      </div>

    </div><!-- /students-cards-full-grid -->

  </div>

  <!-- ── Barra inferior de features ── -->
  <div class="m-features-bar" style="margin-top: 36px;">
    <div class="container m-features-inner">
      <div class="m-feat">
        <span class="m-feat-ico"><svg viewBox="0 0 24 24" width="26" height="26" aria-hidden="true"><path d="M4 5.5A2.5 2.5 0 0 1 6.5 3H11v16H6.5A2.5 2.5 0 0 0 4 21.5v-16z" fill="#86efac" stroke="#16a34a" stroke-width="1.4"/><path d="M20 5.5A2.5 2.5 0 0 0 17.5 3H13v16h4.5a2.5 2.5 0 0 1 2.5 2.5v-16z" fill="#bbf7d0" stroke="#16a34a" stroke-width="1.4"/><path d="M12 3v16" stroke="#15803d" stroke-width="1.2"/></svg></span>
        <div>Tu futuro financiero<br><strong>también se aprende</strong></div>
      </div>
      <div class="m-feat">
        <span class="m-feat-ico"><svg viewBox="0 0 24 24" width="26" height="26" aria-hidden="true"><rect x="3" y="4" width="18" height="12" rx="2" fill="#bfdbfe" stroke="#2563eb" stroke-width="1.5"/><rect x="5" y="6" width="14" height="8" rx="1" fill="#eff6ff"/><path d="M8 20h8M10 16v4M14 16v4" stroke="#2563eb" stroke-width="1.5" stroke-linecap="round"/></svg></span>
        <div>100% en línea<br><strong>y a tu ritmo</strong></div>
      </div>
      <div class="m-feat">
        <span class="m-feat-ico"><svg viewBox="0 0 24 24" width="26" height="26" aria-hidden="true"><path d="M12 3l8 3.5V12c0 5.2-3.8 8.8-8 10-4.2-1.2-8-4.8-8-10V6.5L12 3z" fill="#a7f3d0" stroke="#059669" stroke-width="1.5"/><path d="M9.2 12.2l1.9 1.9 3.9-4.2" stroke="#065f46" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
        <div>Contenido práctico<br><strong>y fácil de aplicar</strong></div>
      </div>
      <div class="m-feat">
        <span class="m-feat-ico"><svg viewBox="0 0 24 24" width="26" height="26" aria-hidden="true"><path d="M12 3.5l2.6 5.3 5.9.9-4.2 4.1 1 5.8-5.3-2.8-5.3 2.8 1-5.8-4.2-4.1 5.9-.9L12 3.5z" fill="#fde68a" stroke="#d97706" stroke-width="1.4" stroke-linejoin="round"/></svg></span>
        <div>Soporte de mentores<br><strong>y comunidad</strong></div>
      </div>
      <div class="m-feat m-feat-cursive">
        No es solo un curso,<br>es una nueva forma<br>de ver tu dinero <span class="m-feat-ico" style="vertical-align:middle;display:inline-flex;"><svg viewBox="0 0 24 24" width="20" height="20" aria-hidden="true"><circle cx="10" cy="12" r="5.5" fill="#bbf7d0" stroke="#16a34a" stroke-width="1.4"/><path d="M10 9v6M8.5 10.5h2.2a1.3 1.3 0 1 1 0 2.6H8.5" stroke="#166534" stroke-width="1.3" stroke-linecap="round"/><path d="M16 7c1.5 1 2.5 2.8 2.5 5s-1 4-2.5 5" stroke="#22c55e" stroke-width="1.5" stroke-linecap="round"/></svg></span>
      </div>
    </div>
  </div>

</section>

<!-- ══════════════════════════════════════════════════════
     SECCIÓN: HÁBITOS ATÓMICOS EN TUS FINANZAS (DIAGNÓSTICO INTERACTIVO)
     ══════════════════════════════════════════════════════ -->
<section class="atomic-habits-section" id="habitos-atomicos">
  <div class="container">
    
      <!-- TARJETA PRINCIPAL DEL FORMULARIO / DIAGNÓSTICO -->
      <div class="atomic-card-container">
        <div class="atomic-form-header">
          <button type="button" class="atomic-exit-btn" onclick="exitAtomicDiagnostic()" aria-label="Salir del diagnóstico">
            <i class="fi fi-rr-cross-small" aria-hidden="true"></i> Salir
          </button>
          <h2 class="atomic-form-title">Diagnóstico de Hábitos Financieros</h2>
          <p class="atomic-form-subtitle">Responde estas preguntas para descubrir tu perfil y recibir recomendaciones personalizadas.</p>
        </div>

      <!-- Formulario de Preguntas -->
      <form id="atomicHabitsForm" class="atomic-questions-form" onsubmit="submitAtomicDiagnostic(event)">

        <!-- Alerta si faltan preguntas -->
        <div id="atomicValidationAlert" class="atomic-validation-alert" style="display: none;">
          <span><i class="fi fi-rr-exclamation"></i> Por favor responde todas las preguntas (<span id="atomicMissingCount">0</span> pendientes) para generar tu diagnóstico interactivo completo.</span>
        </div>

        <!-- Carrusel: 2 preguntas por diapositiva -->
        <div class="atomic-carousel" id="atomicCarousel">
          <div class="atomic-carousel-viewport" id="atomicCarouselViewport">
          <div class="atomic-carousel-track" id="atomicCarouselTrack">

            <div class="atomic-slide active" data-slide="1" data-label="Preguntas 1 y 2">

        <!-- PREGUNTA 1: ADMINISTRACIÓN DE INGRESOS -->
        <div class="atomic-q-block" id="qBlock1">
          <div class="atomic-q-header">
            <h4 class="atomic-q-title">1. ¿Cómo administras tu dinero cuando recibes tus ingresos?</h4>
          </div>
          <div class="atomic-options-group">
            <label class="atomic-option-label">
              <input type="radio" name="p1" value="opt1" onchange="updateAtomicProgress()">
              <span class="atomic-radio-circle"></span>
              <span class="atomic-option-text">Guardo una parte para ahorrar.</span>
            </label>
            <label class="atomic-option-label">
              <input type="radio" name="p1" value="opt2" onchange="updateAtomicProgress()">
              <span class="atomic-radio-circle"></span>
              <span class="atomic-option-text">Gasto primero y ahorro si sobra.</span>
            </label>
            <label class="atomic-option-label">
              <input type="radio" name="p1" value="opt3" onchange="updateAtomicProgress()">
              <span class="atomic-radio-circle"></span>
              <span class="atomic-option-text">Lo gasto sin llevar un control.</span>
            </label>
          </div>
        </div>

        <!-- PREGUNTA 2: COMPRAS INNECESARIAS -->
        <div class="atomic-q-block" id="qBlock2">
          <div class="atomic-q-header">
            <h4 class="atomic-q-title">2. ¿Con qué frecuencia compras cosas que realmente no necesitas?</h4>
          </div>
          <div class="atomic-options-group">
            <label class="atomic-option-label">
              <input type="radio" name="p2" value="opt1" onchange="updateAtomicProgress()">
              <span class="atomic-radio-circle"></span>
              <span class="atomic-option-text">Casi nunca.</span>
            </label>
            <label class="atomic-option-label">
              <input type="radio" name="p2" value="opt2" onchange="updateAtomicProgress()">
              <span class="atomic-radio-circle"></span>
              <span class="atomic-option-text">Algunas veces por semana.</span>
            </label>
            <label class="atomic-option-label">
              <input type="radio" name="p2" value="opt3" onchange="updateAtomicProgress()">
              <span class="atomic-radio-circle"></span>
              <span class="atomic-option-text">Frecuentemente, por impulso.</span>
            </label>
          </div>
        </div>

            </div><!-- /slide 1 -->

            <div class="atomic-slide" data-slide="2" data-label="Preguntas 3 y 4">

        <!-- PREGUNTA 3: REGISTRO DE GASTOS DIARIOS -->
        <div class="atomic-q-block" id="qBlock3">
          <div class="atomic-q-header">
            <h4 class="atomic-q-title">3. ¿Registras tus gastos diarios?</h4>
          </div>
          <div class="atomic-options-group">
            <label class="atomic-option-label">
              <input type="radio" name="p3" value="opt1" onchange="updateAtomicProgress()">
              <span class="atomic-radio-circle"></span>
              <span class="atomic-option-text">Sí, llevo un registro.</span>
            </label>
            <label class="atomic-option-label">
              <input type="radio" name="p3" value="opt2" onchange="updateAtomicProgress()">
              <span class="atomic-radio-circle"></span>
              <span class="atomic-option-text">A veces lo hago.</span>
            </label>
            <label class="atomic-option-label">
              <input type="radio" name="p3" value="opt3" onchange="updateAtomicProgress()">
              <span class="atomic-radio-circle"></span>
              <span class="atomic-option-text">No, nunca los registro.</span>
            </label>
          </div>
        </div>

        <!-- PREGUNTA 4: HÁBITO DE AHORRAR -->
        <div class="atomic-q-block" id="qBlock4">
          <div class="atomic-q-header">
            <h4 class="atomic-q-title">4. ¿Tienes el hábito de ahorrar?</h4>
          </div>
          <div class="atomic-options-group">
            <label class="atomic-option-label">
              <input type="radio" name="p4" value="opt1" onchange="updateAtomicProgress()">
              <span class="atomic-radio-circle"></span>
              <span class="atomic-option-text">Sí, ahorro constantemente.</span>
            </label>
            <label class="atomic-option-label">
              <input type="radio" name="p4" value="opt2" onchange="updateAtomicProgress()">
              <span class="atomic-radio-circle"></span>
              <span class="atomic-option-text">Ahorro cuando puedo.</span>
            </label>
            <label class="atomic-option-label">
              <input type="radio" name="p4" value="opt3" onchange="updateAtomicProgress()">
              <span class="atomic-radio-circle"></span>
              <span class="atomic-option-text">No tengo el hábito de ahorrar.</span>
            </label>
          </div>
        </div>

            </div><!-- /slide 2 -->

            <div class="atomic-slide" data-slide="3" data-label="Preguntas 5 y 6">

        <!-- PREGUNTA 5: REACCIÓN AL DESEAR COMPRAR ALGO -->
        <div class="atomic-q-block" id="qBlock5">
          <div class="atomic-q-header">
            <h4 class="atomic-q-title">5. ¿Qué haces cuando quieres comprar algo que te gusta?</h4>
          </div>
          <div class="atomic-options-group">
            <label class="atomic-option-label">
              <input type="radio" name="p5" value="opt1" onchange="updateAtomicProgress()">
              <span class="atomic-radio-circle"></span>
              <span class="atomic-option-text">Analizo si realmente lo necesito.</span>
            </label>
            <label class="atomic-option-label">
              <input type="radio" name="p5" value="opt2" onchange="updateAtomicProgress()">
              <span class="atomic-radio-circle"></span>
              <span class="atomic-option-text">Espero un poco y después decido.</span>
            </label>
            <label class="atomic-option-label">
              <input type="radio" name="p5" value="opt3" onchange="updateAtomicProgress()">
              <span class="atomic-radio-circle"></span>
              <span class="atomic-option-text">Lo compro inmediatamente.</span>
            </label>
          </div>
        </div>

        <!-- PREGUNTA 6: HÁBITO QUE TE GUSTARÍA CAMBIAR -->
        <div class="atomic-q-block" id="qBlock6">
          <div class="atomic-q-header">
            <h4 class="atomic-q-title">6. ¿Qué hábito financiero te gustaría cambiar?</h4>
          </div>
          <div class="atomic-options-group">
            <label class="atomic-option-label">
              <input type="radio" name="p6" value="opt1" onchange="updateAtomicProgress()">
              <span class="atomic-radio-circle"></span>
              <span class="atomic-option-text">Dejar de comprar por impulso.</span>
            </label>
            <label class="atomic-option-label">
              <input type="radio" name="p6" value="opt2" onchange="updateAtomicProgress()">
              <span class="atomic-radio-circle"></span>
              <span class="atomic-option-text">Evitar los gastos hormiga.</span>
            </label>
            <label class="atomic-option-label">
              <input type="radio" name="p6" value="opt3" onchange="updateAtomicProgress()">
              <span class="atomic-radio-circle"></span>
              <span class="atomic-option-text">Aprender a ahorrar constantemente.</span>
            </label>
            <label class="atomic-option-label">
              <input type="radio" name="p6" value="opt4" onchange="updateAtomicProgress()">
              <span class="atomic-radio-circle"></span>
              <span class="atomic-option-text">Organizar mejor mi dinero.</span>
            </label>
          </div>
        </div>

            </div><!-- /slide 3 -->

          </div><!-- /atomic-carousel-track -->
          </div><!-- /atomic-carousel-viewport -->

          <!-- Navegación del carrusel -->
          <div class="atomic-carousel-nav">
            <button type="button" class="atomic-carousel-arrow" id="atomicPrevBtn" onclick="prevAtomicSlide()" disabled>← Anterior</button>
            <div class="atomic-carousel-status">
              <span class="atomic-carousel-label" id="atomicSlideLabel">Paso 1 de 3 · Preguntas 1 y 2</span>
              <div class="atomic-carousel-dots" id="atomicCarouselDots">
                <button type="button" class="atomic-carousel-dot active" data-slide="1" onclick="goToAtomicSlide(1)" aria-label="Ir a las preguntas 1 y 2"></button>
                <button type="button" class="atomic-carousel-dot" data-slide="2" onclick="goToAtomicSlide(2)" aria-label="Ir a las preguntas 3 y 4"></button>
                <button type="button" class="atomic-carousel-dot" data-slide="3" onclick="goToAtomicSlide(3)" aria-label="Ir a las preguntas 5 y 6"></button>
              </div>
            </div>
            <button type="button" class="atomic-carousel-arrow" id="atomicNextBtn" onclick="nextAtomicSlide()">Siguiente →</button>
          </div>
        </div><!-- /atomic-carousel -->

        <!-- Botón para finalizar -->
        <div class="atomic-submit-wrap">
          <button type="submit" class="atomic-btn-submit" id="btnFinalizarDiag">
            <span>Finalizar diagnóstico</span>
            <span>→</span>
          </button>
        </div>

      </form>

      <!-- ANÁLISIS BREVE DEL DIAGNÓSTICO (Generado con JS) -->
      <div id="atomicMiniAnalysis" class="atomic-mini-analysis" style="display: none;" aria-live="polite">
        <div class="atomic-mini-head">
          <span class="atomic-mini-icon"><i class="fi fi-rr-chart-histogram" aria-hidden="true"></i></span>
          <div class="atomic-mini-copy">
            <span class="atomic-mini-label">Tu análisis rápido</span>
            <h3 class="atomic-mini-profile" id="atomicMiniProfile"></h3>
          </div>
          <span class="atomic-mini-score" id="atomicMiniScore">0%</span>
        </div>
        <p class="atomic-mini-text" id="atomicMiniSummary"></p>
        <div class="atomic-mini-actions">
          <button type="button" class="atomic-btn-outline" onclick="resetAtomicDiagnostic()"><i class="fi fi-rr-refresh" aria-hidden="true"></i> Repetir diagnóstico</button>
          <button type="button" class="atomic-btn-exit" onclick="exitAtomicDiagnostic()"><i class="fi fi-rr-sign-out-alt" aria-hidden="true"></i> Salir del diagnóstico</button>
        </div>
      </div>

    </div><!-- /atomic-card-container -->

    <!-- AVISO AL SALIR DEL ESPACIO DE DIAGNÓSTICO -->
    <div id="atomicExitNotice" class="atomic-exit-notice" style="display: none;">
      <span><i class="fi fi-rr-info" aria-hidden="true"></i> Saliste del diagnóstico. Tus respuestas se conservarán si vuelves a entrar.</span>
      <button type="button" onclick="reopenAtomicDiagnostic()">Volver al diagnóstico</button>
    </div>

  </div>
</section>

  <div class="home-probar-wrap">
    <a href="index.php?page=aula&amp;preview=1" class="home-probar-btn" id="btnHomeProbar">
      <span>Probar</span>
      <i class="fi fi-rr-arrow-small-right" style="font-size: 28px; line-height: 1; margin-left: 8px;"></i>
    </a>
  </div>
</main>

<footer class="site-footer">
  <div class="container" style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px;">
    <p><strong>Educación Financiera</strong> — Plataforma Educativa de Aprendizaje y Transformación.</p>
    <p style="font-size: 13px; opacity: 0.75; margin: 0;">Iconos por <a href="https://www.flaticon.es/uicons" target="_blank" rel="noopener" style="text-decoration: underline; color: inherit;">Flaticon UIcons</a></p>
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
        <span><i class="fi fi-rr-film"></i></span> Testimonio en video de estudiante
      </div>

      <div class="svm-achievement-badge" id="svmBadge">
        <span><i class="fi fi-rr-trophy"></i></span> Logro verificado
      </div>

      <div class="svm-quote-box">
        "<span id="svmQuote">Testimonio</span>"
      </div>

      <div class="svm-comments-section">
        <div class="svm-comments-label">
          <span>Comentarios de la comunidad:</span>
          <span style="color:#00703c; font-size:13px;"><i class="fi fi-sr-circle" style="font-size:10px;"></i> En línea</span>
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
            <button type="button" class="svm-share-btn svm-share-ig" onclick="shareTestimonialComment('instagram')">Instagram</button>
            <button type="button" class="svm-share-btn svm-share-yt" onclick="shareTestimonialComment('youtube')">YouTube</button>
            <button type="button" class="svm-share-btn svm-share-x" onclick="shareTestimonialComment('x')">X</button>
            <button type="button" class="svm-share-btn svm-share-wa" onclick="shareTestimonialComment('whatsapp')">WhatsApp</button>
            <button type="button" class="svm-share-btn svm-share-no" onclick="discardTestimonialCommentShare()">Ahora no</button>
          </div>
          <div class="svm-share-toast" id="svmShareToast" aria-live="polite"></div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ══════════════════════════════════════════════════════
     MODALES DE AUTENTICACIÓN (login / recuperación / registro)
     Necesarios para el botón "Probar" y para #login / #signup
     ══════════════════════════════════════════════════════ -->
<div class="modal-overlay" id="loginModal" role="dialog" aria-modal="true">
  <div class="modal-card">
    <button class="modal-close-btn" onclick="closeLoginModal()" aria-label="Cerrar"><i class="fi fi-rr-cross-small"></i></button>
    <div style="display: flex; justify-content: center; margin-bottom: 12px;">
      <svg viewBox="0 0 240 210" xmlns="http://www.w3.org/2000/svg" style="width: 54px; height: 48px; flex-shrink: 0;" role="img" aria-label="Logo Sombrero de Graduación con Libros">
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
      <button type="submit" class="btn-cta-yellow" style="width: 100%; justify-content: center; margin-top: 8px; display: inline-flex; align-items: center; gap: 8px;">
        <i class="fi fi-sr-sign-in-alt"></i>
        <span>Iniciar sesión</span>
      </button>
    </form>
    <p class="modal-switch-text">¿No tienes cuenta? <button type="button" onclick="openSignupModal()">Crear cuenta</button></p>
  </div>
</div>

<div class="modal-overlay" id="forgotModal" role="dialog" aria-modal="true">
  <div class="modal-card">
    <button class="modal-close-btn" onclick="closeForgotModal()" aria-label="Cerrar"><i class="fi fi-rr-cross-small"></i></button>
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
      <button type="submit" class="btn-cta-yellow" style="width: 100%; justify-content: center; margin-top: 8px; display: inline-flex; align-items: center; gap: 8px;">
        <i class="fi fi-rr-key"></i>
        <span>Restablecer mi contraseña</span>
      </button>
    </form>
    <p class="modal-switch-text">¿Recordaste tu contraseña? <button type="button" onclick="openLoginModal()">Iniciar sesión</button></p>
  </div>
</div>

<div class="modal-overlay" id="signupModal" role="dialog" aria-modal="true">
  <div class="modal-card">
    <button class="modal-close-btn" onclick="closeSignupModal()" aria-label="Cerrar"><i class="fi fi-rr-cross-small"></i></button>
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
          <input type="password" id="signupConfirm" required minlength="6" placeholder="Repite tu nueva contraseña">
          <button type="button" class="btn-toggle-eye" onclick="togglePasswordVisibility('signupConfirm', this)" aria-label="Mostrar contraseña" title="Mostrar contraseña">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
              <circle cx="12" cy="12" r="3"></circle>
            </svg>
          </button>
        </div>
        <span id="signupConfirmErr" style="display:none; color: #e11d48; font-size: 13px; margin-top: 2px;">Las contraseñas no coinciden.</span>
      </div>
      <button type="submit" class="btn-cta-yellow" style="width: 100%; justify-content: center; margin-top: 8px; display: inline-flex; align-items: center; gap: 8px;">
        <i class="fi fi-rr-user-add"></i>
        <span>Registrarme y acceder</span>
      </button>
    </form>
    <p class="modal-switch-text">¿Ya tienes cuenta? <button type="button" onclick="openLoginModal()">Iniciar sesión</button></p>
  </div>
</div>

<script src="public/js/script.js?v=<?= \App\Config\AppConfig::APP_VERSION ?>"></script>
<script>
  // ── Splash screen ──────────────────────────────────────────
  (function() {
    var sp = document.getElementById('splashScreen');
    if (!sp) {
      try { sessionStorage.setItem('ef_splash_seen', '1'); } catch (e) {}
      return;
    }
    function hideSplash() {
      sp.classList.add('hide');
      try { sessionStorage.setItem('ef_splash_seen', '1'); } catch (e) {}
    }
    window.hideSplash = hideSplash;
    setTimeout(hideSplash, 5200);
  })();
  // ── Reacciones estilo Facebook (Emojis interactivos) ──────────
  var DEFAULT_REACTION_ICON = '<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>';

  function selectCardReaction(optBtn, e) {
    if (e) e.stopPropagation();
    var box = optBtn.closest('.msc-reaction-box');
    if (!box) return;
    var mainBtn = box.querySelector('.msc-reaction-main-btn');
    var countEl = box.querySelector('.like-count');
    var iconEl = box.querySelector('.msc-btn-icon');
    var labelEl = box.querySelector('.msc-btn-label');

    var reaction = optBtn.getAttribute('data-reaction');
    var emoji = optBtn.getAttribute('data-emoji');
    var label = optBtn.getAttribute('data-label');
    var color = optBtn.getAttribute('data-color');

    var currentReaction = mainBtn ? mainBtn.getAttribute('data-active-reaction') : null;
    var count = parseInt(countEl ? countEl.textContent : '0', 10);

    if (currentReaction === reaction) {
      mainBtn.removeAttribute('data-active-reaction');
      mainBtn.classList.remove('has-reaction', 'liked');
      mainBtn.style.color = '';
      if (iconEl) iconEl.innerHTML = DEFAULT_REACTION_ICON;
      if (labelEl) labelEl.textContent = 'Me gusta';
      if (countEl) countEl.textContent = Math.max(0, count - 1);
    } else {
      if (!currentReaction) {
        if (countEl) countEl.textContent = count + 1;
      }
      mainBtn.setAttribute('data-active-reaction', reaction);
      mainBtn.classList.add('has-reaction', 'liked');
      mainBtn.style.color = color;
      if (iconEl) iconEl.textContent = emoji;
      if (labelEl) labelEl.textContent = label;
    }
    box.classList.remove('tray-open');
  }

  function toggleCardDefaultReaction(mainBtn, e) {
    if (e) e.stopPropagation();
    var box = mainBtn.closest('.msc-reaction-box');
    if (!box) return;
    var countEl = box.querySelector('.like-count');
    var iconEl = box.querySelector('.msc-btn-icon');
    var labelEl = box.querySelector('.msc-btn-label');

    var currentReaction = mainBtn.getAttribute('data-active-reaction');
    var count = parseInt(countEl ? countEl.textContent : '0', 10);

    if (currentReaction) {
      mainBtn.removeAttribute('data-active-reaction');
      mainBtn.classList.remove('has-reaction', 'liked');
      mainBtn.style.color = '';
      if (iconEl) iconEl.innerHTML = DEFAULT_REACTION_ICON;
      if (labelEl) labelEl.textContent = 'Me gusta';
      if (countEl) countEl.textContent = Math.max(0, count - 1);
    } else {
      mainBtn.setAttribute('data-active-reaction', 'like');
      mainBtn.classList.add('has-reaction', 'liked');
      mainBtn.style.color = '#1877f2';
      if (iconEl) iconEl.textContent = '👍';
      if (labelEl) labelEl.textContent = 'Me gusta';
      if (countEl) countEl.textContent = count + 1;
    }
    box.classList.remove('tray-open');
  }

  function toggleLike(btn) {
    toggleCardDefaultReaction(btn);
  }

  // Soporte touch en móviles para cerrar bandeja al hacer clic fuera
  document.addEventListener('click', function(e) {
    if (!e.target.closest('.msc-reaction-box')) {
      document.querySelectorAll('.msc-reaction-box.tray-open').forEach(function(b) {
        b.classList.remove('tray-open');
      });
    }
  });

  // Mantener presionado en móvil para abrir bandeja
  document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.msc-reaction-box').forEach(function(box) {
      var touchTimer = null;
      var mainBtn = box.querySelector('.msc-reaction-main-btn');
      if (!mainBtn) return;
      mainBtn.addEventListener('touchstart', function(e) {
        touchTimer = setTimeout(function() {
          box.classList.add('tray-open');
        }, 320);
      }, { passive: true });
      mainBtn.addEventListener('touchend', function(e) {
        if (touchTimer) clearTimeout(touchTimer);
      });
      mainBtn.addEventListener('touchmove', function(e) {
        if (touchTimer) clearTimeout(touchTimer);
      });
    });
  });

  // ── Datos de los Estudiantes para el Video Testimonial ──────
  var studentDirectory = {
    mariana: {
      name: 'Mariana González',
      role: '29 años • Emprendedora Independiente',
      medal: '<i class="fi fi-rr-medal"></i>',
      photo: 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=500&auto=format&fit=crop&q=80',
      duration: '2:45 min',
      totalSec: 165,
      title: 'Cómo logré ahorrar e invertir el 35% de mis ingresos',
      badge: '<i class="fi fi-rr-chart-line-up"></i> +35% de ahorro mensual e inversión activa',
      quote: 'Siempre creí que la educación financiera era para ricos o cursos de vendehumos. Esta plataforma me dio plantillas simples que apliqué de inmediato. Pasé de no saber a dónde se iba mi dinero a invertir mensualmente.',
      defaultComment: '<strong>Carlos R.:</strong> "Mariana, qué gran cambio. Yo también empecé con las plantillas y son oro puro."'
    },
    jorge: {
      name: 'Jorge Martínez',
      role: 'Vendedor Profesional • 28 años',
      medal: '<i class="fi fi-rr-medal"></i>',
      photo: 'https://images.unsplash.com/photo-1560250097-0b93528c311a?w=500&auto=format&fit=crop&q=80',
      duration: '3:12 min',
      totalSec: 192,
      title: 'De vivir al día con comisiones a tener 6 meses de fondo de emergencia',
      badge: '<i class="fi fi-rr-shield-check"></i> Fondo de emergencia completo garantizado',
      quote: 'Pasaba de comisión en comisión sin guardar nada y ahora ya tengo mi fondo de emergencia. El curso me enseñó a planear, ser constante y entender lo que el cliente realmente necesita.',
      defaultComment: '<strong>Laura T.:</strong> "¡Felicidades Jorge! Aplicar hábitos atómicos en el ahorro cambia por completo las finanzas."'
    },
    ana: {
      name: 'Ana López',
      role: '25 años • Enfermera',
      medal: '<i class="fi fi-rr-medal"></i>',
      photo: 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=500&auto=format&fit=crop&q=80',
      duration: '2:18 min',
      totalSec: 138,
      title: 'Liquidando $28,500 MXN en deudas con presupuesto base cero',
      badge: '<i class="fi fi-rr-money-bill-wave"></i> $28,500 MXN en deudas totalmente liquidadas',
      quote: 'Tenía varias deudas pequeñas que me ahogaban y no veía la salida. Aprendí a hacer un presupuesto base cero y a negociar. En 8 meses saldé todo y ahora ahorro el 20% de mi sueldo.',
      defaultComment: '<strong>Dr. Mendoza:</strong> "Admirable Ana, en el sector salud los horarios son duros pero organizarte hace toda la diferencia."'
    },
    roberto: {
      name: 'Roberto y Silvia',
      role: '41 años • Pareja y padres de familia',
      medal: '<i class="fi fi-rr-shield-check"></i>',
      photo: 'https://images.unsplash.com/photo-1581579438747-1dc8d17bbce4?w=500&auto=format&fit=crop&q=80',
      duration: '3:30 min',
      totalSec: 210,
      title: 'Paz financiera en familia: construyendo el fondo universitario',
      badge: '<i class="fi fi-rr-home"></i> Plan patrimonial y fondo educativo consolidado',
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
    document.getElementById('svmTitle').innerHTML = '<span><i class="fi fi-rr-film"></i></span> ' + data.title;
    document.getElementById('svmBadge').innerHTML = '<span><i class="fi fi-rr-trophy"></i></span> ' + data.badge;
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

  function copyTestimonialShareText(text, network) {
    if (navigator.clipboard && navigator.clipboard.writeText) {
      navigator.clipboard.writeText(text).catch(function () {});
    } else {
      var ta = document.createElement('textarea');
      ta.value = text;
      ta.setAttribute('readonly', '');
      ta.style.position = 'fixed';
      ta.style.opacity = '0';
      document.body.appendChild(ta);
      ta.select();
      try { document.execCommand('copy'); } catch (e) {}
      document.body.removeChild(ta);
    }
    var toast = document.getElementById('svmShareToast');
    if (toast) {
      toast.textContent = 'Comentario copiado. Pégalo en ' + (network === 'instagram' ? 'Instagram' : 'YouTube') + '.';
      toast.classList.add('show');
      setTimeout(function () { toast.classList.remove('show'); }, 2200);
    }
  }

  function shareTestimonialComment(network) {
    var comment = lastTestimonialComment || 'Mi testimonio en Educación Financiera';
    var canonical = document.querySelector('link[rel="canonical"]');
    var url = canonical ? canonical.href : window.location.href.split('#')[0];
    var text = 'Mi testimonio en Educaci\u00f3n Financiera: \u201c' + comment + '\u201d';
    var share = '';
    if (network === 'facebook') {
      share = 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(url);
    } else if (network === 'instagram') {
      copyTestimonialShareText(text + ' ' + url, network);
      window.open('https://www.instagram.com/', '_blank', 'noopener');
      setTimeout(discardTestimonialCommentShare, 2200);
      return;
    } else if (network === 'youtube') {
      copyTestimonialShareText(text + ' ' + url, network);
      window.open('https://www.youtube.com/', '_blank', 'noopener');
      setTimeout(discardTestimonialCommentShare, 2200);
      return;
    } else if (network === 'x') {
      share = 'https://twitter.com/intent/tweet?text=' + encodeURIComponent(text) + '&url=' + encodeURIComponent(url);
    } else if (network === 'whatsapp') {
      share = 'https://wa.me/?text=' + encodeURIComponent(text + ' ' + url);
    }
    if (network === 'facebook' && share) {
      window.open(share, 'fb-share', 'noopener,noreferrer,width=620,height=440');
    } else if (share) {
      window.open(share, '_blank', 'noopener');
    }
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
      action: '<i class="fi fi-rr-target"></i> Táctica: Regla de la Nómina Inmediata',
      example: 'El mismo día que recibes tu salario o ingresos por ventas, programa una transferencia automatizada a una cuenta apartada (ej. CETES Directo). Si no ves el dinero disponible en tu cuenta corriente, no lo gastarás.'
    },
    2: {
      name: '2ª Ley: Hazlo Atractivo (El Anhelo)',
      desc: 'El cerebro humano busca dopamina. Si ves el ahorro como "privación" o "aburrimiento", tu mente lo saboteará.',
      action: '<i class="fi fi-rr-target"></i> Táctica: Vinculación con Tu Identidad',
      example: 'Renombra tu cuenta de banco de "Ahorro" a "Fondo de Libertad y Tranquilidad". Asocia cada peso guardado no con lo que te estás perdiendo hoy, sino con la libertad y paz mental que estás comprando para tu futuro.'
    },
    3: {
      name: '3ª Ley: Hazlo Sencillo (La Respuesta)',
      desc: 'Reduce la fricción para los buenos hábitos financieros y auméntala drásticamente para los malos hábitos.',
      action: '<i class="fi fi-rr-target"></i> Táctica: Regla de los 20 Segundos de Fricción',
      example: 'Elimina las tarjetas de crédito guardadas en MercadoLibre o Amazon. Obligarte a buscar la cartera, sacar la tarjeta y escribir los 16 dígitos toma 20 segundos: tiempo suficiente para enfriar el impulso de compra.'
    },
    4: {
      name: '4ª Ley: Hazlo Satisfactorio (La Recompensa)',
      desc: 'Lo que se recompensa de inmediato se repite; lo que se castiga se evita. Necesitas sentir satisfacción instantánea al ahorrar.',
      action: '<i class="fi fi-rr-target"></i> Táctica: Rastreador Visual de Hábitos',
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
    setTimeout(syncAtomicCarouselHeight, 0);
  }

  // 5. Micro-Feedback Inmediato al Seleccionar Opciones (Hábitos Financieros)
  var optionInsights = {
    // 1. ¿Cómo administras tu dinero cuando recibes tus ingresos?
    '1_opt1': '<i class="fi fi-sr-star" style="color:#F5B800;"></i> <strong>¡Excelente hábito!</strong> Aplicas el principio fundamental: "Págate a ti mismo primero". Priorizar el ahorro antes del gasto asegura que tus fondos de libertad crezcan sin depender de lo que sobre.',
    '1_opt2': '<i class="fi fi-rr-bulb" style="color:#F5B800;"></i> <strong>Hábito reactivo:</strong> Si esperas a ver qué sobra a fin de mes, casi nunca sobrará. James Clear recomienda programar un traspaso automático el día exacto de pago.',
    '1_opt3': '<i class="fi fi-rr-exclamation" style="color:#c2410c;"></i> <strong>Punto ciego crítico:</strong> Gastar sin control genera estrés y desorden. Para romper este ciclo, basta aplicar la Regla de los 2 Minutos y registrar tus compras diarias.',
    
    // 2. ¿Con qué frecuencia compras cosas que realmente no necesitas?
    '2_opt1': '<i class="fi fi-sr-star" style="color:#F5B800;"></i> <strong>¡Gran autocontrol!</strong> Sabes diferenciar entre un deseo momentáneo y una necesidad real, protegiendo tu dinero de compras impulsivas.',
    '2_opt2': '<i class="fi fi-rr-bulb" style="color:#F5B800;"></i> <strong>Cuidado con los gastos hormiga:</strong> Varias compras pequeñas a la semana parecen inofensivas hoy, pero al cabo de un año representan miles de pesos que podrías haber invertido.',
    '2_opt3': '<i class="fi fi-rr-exclamation" style="color:#c2410c;"></i> <strong>Trampa de dopamina:</strong> Las compras por impulso responden a gratificación rápida. Solución de James Clear: aumenta la fricción borrando tus tarjetas guardadas en tu celular.',
    
    // 3. ¿Registras tus gastos diarios?
    '3_opt1': '<i class="fi fi-sr-star" style="color:#F5B800;"></i> <strong>¡1ª Ley: Hazlo Obvio!</strong> Llevar un registro claro te da el poder de decidir con información real. Lo que se mide se puede optimizar y mejorar.',
    '3_opt2': '<i class="fi fi-rr-bulb" style="color:#F5B800;"></i> <strong>Falta de consistencia:</strong> Registrar solo de vez en cuando genera lagunas de información. No necesitas tablas complejas: anota en 30 segundos tus gastos en una nota rápida.',
    '3_opt3': '<i class="fi fi-rr-exclamation" style="color:#c2410c;"></i> <strong>Ceguera de gastos:</strong> No saber en qué se va el dinero es el mayor obstáculo para prosperar. Inicia hoy con la meta mínima de anotar 1 solo gasto al día.',
    
    // 4. ¿Tienes el hábito de ahorrar?
    '4_opt1': '<i class="fi fi-sr-star" style="color:#F5B800;"></i> <strong>¡Identidad Atómica Sólida!</strong> Has adoptado la identidad de una persona ahorradora e inversionista. Cada depósito es un voto a favor de tu libertad futura.',
    '4_opt2': '<i class="fi fi-rr-bulb" style="color:#F5B800;"></i> <strong>Ahorro inconstante:</strong> Ahorrar "cuando se puede" depende de la suerte y el estado de ánimo. Convierte el ahorro en un sistema fijo, no en una casualidad.',
    '4_opt3': '<i class="fi fi-rr-exclamation" style="color:#c2410c;"></i> <strong>Oportunidad de oro:</strong> No necesitas miles de pesos para comenzar. Un hábito atómico de apartar $20 MXN diarios entrena la disciplina mental antes de que crezcan los montos.',
    
    // 5. ¿Qué haces cuando quieres comprar algo que te gusta?
    '5_opt1': '<i class="fi fi-sr-star" style="color:#F5B800;"></i> <strong>¡Filtro racional!</strong> Preguntarte si realmente lo necesitas te da una pausa consciente frente a los impulsos emocionales de consumo.',
    '5_opt2': '<i class="fi fi-rr-bulb" style="color:#F5B800;"></i> <strong>Estrategia de enfriamiento:</strong> Dar un tiempo de espera (Regla de las 72 Horas) permite que el cerebro recupere la calma y decida sin el pico de emoción inicial.',
    '5_opt3': '<i class="fi fi-rr-exclamation" style="color:#c2410c;"></i> <strong>Compra inmediata:</strong> Comprar en el instante responde a gratificación inmediata. Añade fricción: retira los métodos de pago de un solo clic.',
    
    // 6. ¿Qué hábito financiero te gustaría cambiar?
    '6_opt1': '<i class="fi fi-rr-target"></i> <strong>Objetivo fijado:</strong> Dejar de comprar por impulso. Usaremos la 3ª Ley Invertida (Hacerlo Difícil) para crear barreras entre la tentación y el pago.',
    '6_opt2': '<i class="fi fi-rr-target"></i> <strong>Objetivo fijado:</strong> Evitar los gastos hormiga. Usaremos la 1ª Ley Invertida (Hacerlo Invisible) y la sustitución por micro-transferencias de ahorro.',
    '6_opt3': '<i class="fi fi-rr-target"></i> <strong>Objetivo fijado:</strong> Aprender a ahorrar constantemente. Usaremos la 1ª Ley (Hacerlo Obvio) automatizando transferencias el día que recibes tu dinero.',
    '6_opt4': '<i class="fi fi-rr-target"></i> <strong>Objetivo fijado:</strong> Organizar mejor mi dinero. Usaremos la Regla de los 2 Minutos para diseñar un presupuesto simple que no te quite tiempo.'
  };

  function showOptionInsight(qNum, optVal) {
    var box = document.getElementById('insightBox' + qNum);
    var key = qNum + '_' + optVal;
    if (box && optionInsights[key]) {
      box.innerHTML = optionInsights[key];
      box.style.display = 'block';
      setTimeout(syncAtomicCarouselHeight, 0);
    }
  }

  // 6. Carrusel del formulario: 2 preguntas por diapositiva
  var atomicCurrentSlide = 1;
  var atomicTotalSlides = 3;

  function updateAtomicCarouselUI() {
    var track = document.getElementById('atomicCarouselTrack');
    var form = document.getElementById('atomicHabitsForm');
    if (!track) return;

    track.style.transform = 'translateX(-' + ((atomicCurrentSlide - 1) * 100) + '%)';

    var slides = track.querySelectorAll('.atomic-slide');
    slides.forEach(function(slide, idx) {
      slide.classList.toggle('active', idx + 1 === atomicCurrentSlide);
    });

    var dots = document.querySelectorAll('.atomic-carousel-dot');
    dots.forEach(function(dot, idx) {
      dot.classList.toggle('active', idx + 1 === atomicCurrentSlide);
    });

    var label = document.getElementById('atomicSlideLabel');
    if (label) {
      var currentSlideEl = slides[atomicCurrentSlide - 1];
      var slideLabel = currentSlideEl ? currentSlideEl.getAttribute('data-label') : '';
      label.textContent = 'Paso ' + atomicCurrentSlide + ' de ' + atomicTotalSlides + (slideLabel ? ' · ' + slideLabel : '');
    }

    var prevBtn = document.getElementById('atomicPrevBtn');
    var nextBtn = document.getElementById('atomicNextBtn');
    if (prevBtn) prevBtn.disabled = atomicCurrentSlide === 1;
    if (nextBtn) nextBtn.classList.toggle('is-hidden', atomicCurrentSlide === atomicTotalSlides);
    if (form) form.classList.toggle('atomic-on-last-step', atomicCurrentSlide === atomicTotalSlides);

    observeActiveAtomicSlide();
  }

  function goToAtomicSlide(n, skipScroll) {
    atomicCurrentSlide = Math.min(atomicTotalSlides, Math.max(1, parseInt(n, 10) || 1));
    updateAtomicCarouselUI();
    if (!skipScroll) {
      var carousel = document.getElementById('atomicCarousel');
      if (carousel) {
        setTimeout(function() {
          carousel.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }, 60);
      }
    }
  }

  function nextAtomicSlide() {
    goToAtomicSlide(atomicCurrentSlide + 1);
  }

  function prevAtomicSlide() {
    goToAtomicSlide(atomicCurrentSlide - 1);
  }

  var atomicSlideResizeObserver = null;

  function syncAtomicCarouselHeight() {
    var viewport = document.getElementById('atomicCarouselViewport');
    var track = document.getElementById('atomicCarouselTrack');
    if (!viewport || !track) return;
    var active = track.querySelector('.atomic-slide.active');
    if (active) viewport.style.height = active.offsetHeight + 'px';
  }

  function observeActiveAtomicSlide() {
    var track = document.getElementById('atomicCarouselTrack');
    if (!track) return;
    var active = track.querySelector('.atomic-slide.active');
    if (!active) return;
    if (window.ResizeObserver) {
      if (!atomicSlideResizeObserver) {
        atomicSlideResizeObserver = new ResizeObserver(syncAtomicCarouselHeight);
      }
      atomicSlideResizeObserver.disconnect();
      atomicSlideResizeObserver.observe(active);
    }
    syncAtomicCarouselHeight();
  }

  // 7. Navegación Stepper Directa a Preguntas
  function jumpToQuestion(qNum) {
    goToAtomicSlide(Math.ceil(qNum / 2), true);
    var block = document.getElementById('qBlock' + qNum);
    if (block) {
      setTimeout(function() {
        block.scrollIntoView({ behavior: 'smooth', block: 'center' });
        block.classList.add('pulse-highlight');
        setTimeout(function() { block.classList.remove('pulse-highlight'); }, 1200);
      }, 120);
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
          stepBtn.innerHTML = '<i class="fi fi-rr-check"></i>';
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
        goToAtomicSlide(Math.ceil(unanswered[0] / 2), true);
        setTimeout(function() {
          firstUnansweredBlock.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }, 120);
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

    var targetHabitTitles = {
      'opt1': 'Dejar de comprar por impulso',
      'opt2': 'Evitar los gastos hormiga',
      'opt3': 'Aprender a ahorrar constantemente',
      'opt4': 'Organizar mejor mi dinero'
    };
    var targetHabitTitle = targetHabitTitles[targetHabitKey] || targetHabitTitles['opt1'];

    var profileTitle = '';
    var profileDesc = '';

    if (score >= 12) {
      profileTitle = 'Arquitecto Financiero Consciente';
      profileDesc = '¡Felicidades! Tienes excelentes bases y comprendes la importancia de diseñar sistemas diarios. Tu siguiente paso es optimizar: <strong>' + targetHabitTitle + '</strong>.';
    } else if (score >= 7) {
      profileTitle = 'Constructor en Transición';
      profileDesc = 'Tienes buenas intenciones y algunos hábitos positivos, pero aún faltan sistemas automáticos. Puedes fortalecer: <strong>' + targetHabitTitle + '</strong>.';
    } else {
      profileTitle = 'Enfoque Reactivo: Momento de Instalar Sistemas';
      profileDesc = 'Tus decisiones responden más al impulso que a un sistema. Empieza con una acción pequeña y constante: <strong>' + targetHabitTitle + '</strong>.';
    }

    var miniBox = document.getElementById('atomicMiniAnalysis');
    var miniProfile = document.getElementById('atomicMiniProfile');
    var miniScore = document.getElementById('atomicMiniScore');
    var miniSummary = document.getElementById('atomicMiniSummary');

    if (miniProfile) miniProfile.textContent = profileTitle;
    if (miniScore) miniScore.textContent = pctScore + '%';
    if (miniSummary) {
      var summaryText = {
        'opt1': 'Tu próximo paso: crear fricción antes de pagar y aplicar la regla de las 72 horas.',
        'opt2': 'Tu próximo paso: convertir cada gasto hormiga evitado en un micro-ahorro automático.',
        'opt3': 'Tu próximo paso: apartar el 10% de tus ingresos el mismo día que te paguen.',
        'opt4': 'Tu próximo paso: registrar tus gastos en 2 minutos cada noche.'
      };
      miniSummary.textContent = 'Madurez de hábitos: ' + score + ' de 15 puntos. ' +
        (summaryText[targetHabitKey] || summaryText['opt1']);
    }
    if (miniBox) {
      miniBox.style.display = 'block';
      miniBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
  }

  function exitAtomicDiagnostic() {
    var card = document.querySelector('.atomic-card-container');
    var notice = document.getElementById('atomicExitNotice');
    if (card) card.style.display = 'none';
    if (notice) {
      notice.style.display = 'flex';
      notice.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
  }

  function reopenAtomicDiagnostic() {
    var card = document.querySelector('.atomic-card-container');
    var notice = document.getElementById('atomicExitNotice');
    if (card) {
      card.style.display = 'block';
      card.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
    if (notice) notice.style.display = 'none';
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

    var miniBox = document.getElementById('atomicMiniAnalysis');
    if (miniBox) miniBox.style.display = 'none';

    reopenAtomicDiagnostic();

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

    // Volver al primer carrusel
    goToAtomicSlide(1, true);

    // Reiniciar slider a Día 1
    if (typeof setSimDays === 'function') setSimDays(1);

    var card = document.querySelector('.atomic-card-container');
    if (card) card.scrollIntoView({ behavior: 'smooth', block: 'start' });
  }

  // Inicializar cuadrante 1, slider y carrusel
  document.addEventListener('DOMContentLoaded', function() {
    if (typeof selectQuadrant === 'function') selectQuadrant(1);
    if (typeof setSimDays === 'function') setSimDays(1);
    if (typeof updateAtomicCarouselUI === 'function') updateAtomicCarouselUI();
  });

  // Deslizamiento táctil del carrusel
  (function initAtomicCarouselSwipe() {
    var carousel = document.getElementById('atomicCarousel');
    if (!carousel) return;
    var startX = 0;
    var startY = 0;
    var tracking = false;

    carousel.addEventListener('touchstart', function(e) {
      if (e.touches.length !== 1) return;
      startX = e.touches[0].clientX;
      startY = e.touches[0].clientY;
      tracking = true;
    }, { passive: true });

    carousel.addEventListener('touchend', function(e) {
      if (!tracking) return;
      tracking = false;
      var dx = e.changedTouches[0].clientX - startX;
      var dy = e.changedTouches[0].clientY - startY;
      if (Math.abs(dx) > 50 && Math.abs(dx) > Math.abs(dy)) {
        if (dx < 0) {
          nextAtomicSlide();
        } else {
          prevAtomicSlide();
        }
      }
    }, { passive: true });
  })();

  // Cerrar con Escape
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' || e.key === 'Esc') {
      closeStudentTestimonial();
    }
  });

  // Función para abrir modal de inicio de sesión de Administrador
  window.openAdminLogin = function() {
    if (typeof openLoginModal === 'function') {
      openLoginModal();
      const title = document.querySelector('#loginModal h3');
      if (title) title.innerHTML = '<i class="fi fi-sr-shield-check" style="color:#fabb15; margin-right:8px;"></i>Acceso Administrador';
      const subtitle = document.querySelector('#loginModal p');
      if (subtitle) subtitle.textContent = 'Ingresa tus credenciales de administrador para acceder al panel de control.';
      const emailInput = document.getElementById('loginEmail');
      if (emailInput && (!emailInput.value || emailInput.value === 'tu@correo.com')) {
        emailInput.value = 'admin@educacionfinanciera.com';
      }
      const passwordInput = document.getElementById('loginPassword');
      if (passwordInput) {
        setTimeout(function() { passwordInput.focus(); }, 150);
      }
    } else {
      window.location.href = 'index.php?page=home&skip_splash=1#login';
    }
  };

  // Abrir modal automáticamente si la URL incluye ?admin_login=1
  document.addEventListener('DOMContentLoaded', function() {
    if (new URLSearchParams(window.location.search).get('admin_login') === '1') {
      setTimeout(function() {
        if (typeof openAdminLogin === 'function') openAdminLogin();
      }, 350);
    }
  });
</script>

<style>
/* Estilos destacados para el botón de Panel Admin en el header */
.topbar-admin-btn {
  display: inline-flex !important;
  align-items: center !important;
  gap: 8px !important;
  padding: 8px 18px !important;
  background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%) !important;
  color: #fabb15 !important;
  font-size: 13.5px !important;
  font-weight: 700 !important;
  border-radius: 20px !important;
  text-decoration: none !important;
  border: 1.5px solid #fabb15 !important;
  letter-spacing: 0.02em !important;
  transition: all 0.25s ease !important;
  white-space: nowrap !important;
  box-shadow: 0 3px 12px rgba(250, 187, 21, 0.3) !important;
  cursor: pointer !important;
  z-index: 101 !important;
}
.topbar-admin-btn:hover {
  background: #fabb15 !important;
  color: #042e20 !important;
  border-color: #fabb15 !important;
  box-shadow: 0 4px 20px rgba(250, 187, 21, 0.6) !important;
  transform: translateY(-2px) !important;
}
.topbar-admin-btn:hover i {
  color: #042e20 !important;
}
/* Botón de acceso para estudiantes en el header */
.topbar-login-btn {
  display: inline-flex !important;
  align-items: center !important;
  gap: 8px !important;
  padding: 8px 18px !important;
  background: linear-gradient(135deg, #00703C 0%, #06402d 100%) !important;
  color: #ffffff !important;
  font-size: 13.5px !important;
  font-weight: 700 !important;
  border-radius: 20px !important;
  text-decoration: none !important;
  border: 1.5px solid #28C76F !important;
  letter-spacing: 0.02em !important;
  transition: all 0.25s ease !important;
  white-space: nowrap !important;
  box-shadow: 0 3px 12px rgba(40, 199, 111, 0.3) !important;
  cursor: pointer !important;
  z-index: 101 !important;
}
.topbar-login-btn:hover {
  background: #28C76F !important;
  color: #042e20 !important;
  border-color: #28C76F !important;
  box-shadow: 0 4px 20px rgba(40, 199, 111, 0.6) !important;
  transform: translateY(-2px) !important;
}
.topbar-login-btn:hover i {
  color: #042e20 !important;
}
</style>
