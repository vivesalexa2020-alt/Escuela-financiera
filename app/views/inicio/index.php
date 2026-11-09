<?php
/**
 * Vista: Inicio
 * Contenido migrado desde index.html (legacy/html).
 * Variables: $pageTitle, $pageCss, $bodyClass, $user
 */
?>
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

      <!-- ── ILUSTRACIÓN: Libros apilados + birrete ── -->
      <svg class="splash-logo" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg"
           role="img" aria-label="Birrete de graduación sobre libros">
        <defs>
          <filter id="bookShadow" x="-10%" y="-10%" width="120%" height="130%">
            <feDropShadow dx="0" dy="4" stdDeviation="5" flood-color="rgba(0,0,0,.28)"/>
          </filter>
        </defs>

        <!-- LIBRO 1 (abajo) — amarillo dorado, el más ancho -->
        <rect x="14" y="154" width="172" height="34" rx="9" fill="#f5b800" filter="url(#bookShadow)"/>
        <rect x="22"  y="160" width="156" height="22" rx="5" fill="#fff3c0"/>
        <rect x="14"  y="154" width="24"  height="34" rx="9" fill="#d49a00"/>
        <!-- líneas de páginas -->
        <line x1="44" y1="156" x2="44" y2="186" stroke="#e8c84a" stroke-width=".8" opacity=".4"/>

        <!-- LIBRO 2 (medio) — verde esmeralda -->
        <rect x="22" y="120" width="156" height="34" rx="9" fill="#2bbd6e" filter="url(#bookShadow)"
              transform="rotate(-1.5 100 137)"/>
        <rect x="30"  y="126" width="140" height="22" rx="5" fill="#d0f5e2"
              transform="rotate(-1.5 100 137)"/>
        <rect x="22"  y="120" width="24"  height="34" rx="9" fill="#1e9a58"
              transform="rotate(-1.5 100 137)"/>

        <!-- LIBRO 3 (arriba) — azul cielo -->
        <rect x="30" y="88" width="140" height="34" rx="9" fill="#1a90d4" filter="url(#bookShadow)"
              transform="rotate(1.5 100 105)"/>
        <rect x="38"  y="94" width="124" height="22" rx="5" fill="#cde8f8"
              transform="rotate(1.5 100 105)"/>
        <rect x="30"  y="88" width="24"  height="34" rx="9" fill="#1270a8"
              transform="rotate(1.5 100 105)"/>

        <!-- BIRRETE DE GRADUACIÓN (encima de los libros) -->
        <g transform="translate(100,60) scale(1.15)">
          <!-- Cabeza del birrete (cilindro) -->
          <ellipse cx="0" cy="6"  rx="28" ry="8"  fill="#1a2550"/>
          <rect    x="-28" y="-10" width="56" height="18" fill="#1a2550"/>
          <ellipse cx="0" cy="-10" rx="28" ry="8"  fill="#232e62"/>
          <!-- Tablero (ala) -->
          <ellipse cx="0" cy="-12" rx="48" ry="12" fill="#0d1c3e"/>
          <ellipse cx="0" cy="-14" rx="48" ry="11" fill="#1a2550"/>
          <ellipse cx="0" cy="-15" rx="46" ry="9.5" fill="#232e62"/>
          <!-- Botón superior -->
          <circle  cx="0" cy="-24" r="5"   fill="#f5b800"/>
          <!-- Cordón -->
          <path d="M0,-24 C24,-24 36,-20 38,-10 L38,12"
                fill="none" stroke="#f5b800" stroke-width="3.5" stroke-linecap="round"/>
          <!-- Borla -->
          <rect x="32" y="10" width="12" height="18" rx="2" fill="#f5b800"/>
          <path d="M33,28 l0,10 M38,28 l0,10 M43,28 l0,10"
                stroke="#f5b800" stroke-width="3" stroke-linecap="round"/>
        </g>
      </svg>

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
  <header class="site-header">
    <div class="container nav-wrap">
      <a href="index.php" class="brand-logo">
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
      <div class="nav-actions">
      </div>

    </div>
  </header>

  <main>
    <!-- ============================================================
         1. HERO SUPERIOR: HISTORIAS DE ÉXITO REALES (CERO FASTIDIO)
         ============================================================ -->
    <section class="success-hero-section" id="testimonios">
      <div class="container">

        <div class="success-header">
          <div class="section-eyebrow">
            <span>✨ RESULTADOS REALES, CERO HUMO</span>
          </div>
          <h1>
            Personas reales que recuperaron su paz y <span class="highlight">transformaron sus finanzas</span>
          </h1>
          <p>
            Aquí no hay fórmulas mágicas ni promesas vacías. Descubre cómo personas con ingresos comunes lograron liquidar deudas, crear ahorros de emergencia y empezar a invertir con nuestro método práctico paso a paso.
          </p>
          <div class="success-header-badges">
            <span class="success-mini-tag">⏳ Carrera de 2 Años</span>
            <span class="success-mini-tag">🏆 3 Niveles: Básico, Intermedio y Avanzado</span>
            <span class="success-mini-tag">🎁 1er Semestre de prueba 100% GRATIS</span>
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
          <div class="kpi-sub">Sistemas cognitivos & Neuroventas</div>
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
            <span title="Logro Verificado" style="font-size:16px;">🌱</span>
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
            <span title="Control Financiero Logrado" style="font-size:16px;">📊</span>
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
            <span title="Deuda Cero" style="font-size:16px;">💵</span>
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
            <span title="Familia Asegurada" style="font-size:16px;">🏠</span>
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
     SECCIÓN NEUROVENTAS: 3 CUADROS CON COLOR INDIVIDUAL
     ══════════════════════════════════════════════════════ -->
<section class="pillars-overview-section" id="neuroventas">
  <div class="container">
    
    <div class="pillars-overview-header">
      <div class="pillars-tagline">
        <span>🧠 Neuroventas y Neurociencias</span>
      </div>
      <h2>VÉNDELE A LA MENTE, NO A LA GENTE</h2>
      <p class="pillars-sub">Jürgen Klarić — Los 3 Capítulos Fundamentales para Dominar las Ventas Modernas</p>
      <p class="pillars-slogan">"El 85% de la decisión de compra es subconsciente e inconsciente; solo el 15% es consciente."</p>
      <p style="font-size: 13px; color: #4a5568; margin-top: 6px;">
        Haz clic en cualquiera de los 3 cuadros para abrir la lectura completa a pantalla completa del capítulo que elijas.
      </p>
    </div>

    <!-- ── 3 CUADROS CON COLOR INDIVIDUAL (AZUL, VERDE, ÍNDIGO) ── -->
    <div class="chapters-colored-grid" id="cuadros-capitulos">

      <!-- ==========================================
           CUADRO 1: AZUL (CAPÍTULO 1)
           ========================================== -->
      <div class="colored-chapter-card card-blue" onclick="openChapterModal('modalCapitulo1')" title="Clic para abrir el Capítulo 1 a pantalla completa">
        <div class="ccc-header">
          <div class="ccc-badge-row">
            <div class="ccc-num">1</div>
            <span class="ccc-tag">📘 CAPÍTULO 1</span>
          </div>
          <h3>Las Neuroventas frente a las Ventas Tradicionales</h3>
          <p>Supera la capacitación mecánica y descubre la ciencia real de la mente humana.</p>
        </div>
        <div class="ccc-body">
          <ul class="ccc-points">
            <li><strong>Capacitadores desactualizados:</strong> Deja de ser un robot y crea tu propia comunicación efectiva.</li>
            <li><strong>Ciencia y tecnología:</strong> Validado con el aparato electroencefalográfico <strong>Quasar (EEG)</strong>.</li>
            <li><strong>Descubrimiento clave:</strong> El <strong>85%</strong> de la decisión de compra es inconsciente y solo el 15% consciente.</li>
            <li><strong>Vender sin vender:</strong> Escuchar antes de hablar, conectar y empatizar con el cliente.</li>
          </ul>
          <button type="button" class="ccc-btn" onclick="openChapterModal('modalCapitulo1'); event.stopPropagation();">
            <span>📖 Abrir Capítulo 1 a Pantalla Completa</span>
            <span>⛶</span>
          </button>
        </div>
      </div>

      <!-- ==========================================
           CUADRO 2: VERDE (CAPÍTULO 2)
           ========================================== -->
      <div class="colored-chapter-card card-green" onclick="openChapterModal('modalCapitulo2')" title="Clic para abrir el Capítulo 2 a pantalla completa">
        <div class="ccc-header">
          <div class="ccc-badge-row">
            <div class="ccc-num">2</div>
            <span class="ccc-tag">📗 CAPÍTULO 2</span>
          </div>
          <h3>Neurociencias para las Ventas</h3>
          <p>Conoce la arquitectura cerebral: los tres cerebros y el código reptil que gobierna el instinto.</p>
        </div>
        <div class="ccc-body">
          <ul class="ccc-points">
            <li><strong>Los Tres Cerebros:</strong> Reptiliano (el que DECIDE), Límbico (el que SIENTE) y Córtex (el que JUSTIFICA).</li>
            <li><strong>El Código Reptil:</strong> <em>"El instinto mata a la razón y a la emoción"</em>. El instinto biológico manda.</li>
            <li><strong>Ejemplo clave:</strong> Fumar tiene un código reptil de rebeldía y anarquía.</li>
            <li><strong>12 Códigos biológicos:</strong> Felicidad, control, placer, seguridad, protección, pertenencia a la tribu y más.</li>
          </ul>
          <button type="button" class="ccc-btn" onclick="openChapterModal('modalCapitulo2'); event.stopPropagation();">
            <span>📖 Abrir Capítulo 2 a Pantalla Completa</span>
            <span>⛶</span>
          </button>
        </div>
      </div>

      <!-- ==========================================
           CUADRO 3: ÍNDIGO (CAPÍTULO 3)
           ========================================== -->
      <div class="colored-chapter-card card-indigo" onclick="openChapterModal('modalCapitulo3')" title="Clic para abrir el Capítulo 3 a pantalla completa">
        <div class="ccc-header">
          <div class="ccc-badge-row">
            <div class="ccc-num">3</div>
            <span class="ccc-tag">📙 CAPÍTULO 3</span>
          </div>
          <h3>El Proceso de Decisión</h3>
          <p>Los 3 escenarios, la fórmula A→E→R, los 5 neurotransmisores y las acciones concretas.</p>
        </div>
        <div class="ccc-body">
          <ul class="ccc-points">
            <li><strong>Los 3 Escenarios:</strong> 1) Quedarse como está, 2) Alternativa económica, 3) Opción ideal y completa.</li>
            <li><strong>La Fórmula A → E → R:</strong> Atención (romper rutina), Emoción (deseo) y Recordación (memoria).</li>
            <li><strong>5 Neurotransmisores:</strong> Noradrenalina, Dopamina, Acetilcolina, Endorfina y Serotonina.</li>
            <li><strong>Acciones concretas:</strong> Pasos prácticos para activar la atención, generar emoción y consolidar la compra.</li>
          </ul>
          <button type="button" class="ccc-btn" onclick="openChapterModal('modalCapitulo3'); event.stopPropagation();">
            <span>📖 Abrir Capítulo 3 a Pantalla Completa</span>
            <span>⛶</span>
          </button>
        </div>
      </div>

    </div>

    <!-- SECCIÓN PARA INSCRIBIRSE -->
    <div class="enroll-cta-wrapper">
      <div class="enroll-badge">
        <span>🧠 FORMACIÓN INTEGRAL • NEUROVENTAS Y FINANZAS</span>
      </div>
      <h2>Aprende a venderle a la mente y transforma tus resultados</h2>
      <p>
        Domina la psicología del consumidor, los principios científicos de las neurociencias y las herramientas financieras para llevar tus ingresos y tu vida al siguiente nivel.
      </p>
      <div class="cta-button-group">
        <a href="index.php?page=reticula" class="btn-main-pulse">
          <span>👉 Inscríbete Ahora Gratis</span>
        </a>
      </div>
      <div class="no-register-note">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
        <span>Acceso libre • Sin tarjeta de crédito • Comienza en menos de 1 minuto</span>
      </div>
    </div>

  </div>
</section>
</main>

<footer class="site-footer">
  <div class="container">
    <p><strong>Educación Financiera</strong> — Plataforma Educativa de Aprendizaje y Transformación.</p>
  </div>
</footer>

<!-- ══════════════════════════════════════════════════════
     MODAL INDEPENDIENTE: CAPÍTULO 1
     ══════════════════════════════════════════════════════ -->
<div class="neuro-fullscreen-modal" id="modalCapitulo1" role="dialog" aria-modal="true" aria-label="Lectura de Capítulo 1">
  
  <div class="nfm-topbar nfm-topbar-blue">
    <div class="nfm-title-group">
      <span style="font-size: 22px;">📘</span>
      <div>
        <h3 id="nfmModalTitle1">CAPÍTULO 1: LAS NEUROVENTAS FRENTE A LAS VENTAS TRADICIONALES</h3>
        <span style="font-size: 11.5px; color: #bae6fd;">Jürgen Klarić • Véndele a la Mente, no a la Gente</span>
      </div>
    </div>

    <button type="button" class="nfm-close-btn" onclick="closeChapterModal('modalCapitulo1')" title="Cerrar capítulo (Esc)">
      ✕
    </button>
  </div>

  <div class="nfm-body">
    <div class="nfm-chapters-container">

      <!-- ==========================================
           CAPÍTULO 1 (MODAL COMPLETO)
           ========================================== -->
      <section class="pillar-card pillar-blue" id="modalCap1" style="box-shadow: 0 4px 20px rgba(0,0,0,0.06); border-radius: 16px;">
        <div class="pillar-header" style="border-radius: 16px 16px 0 0;">
          <div class="pillar-number">1</div>
          <span class="chapter-badge">Capítulo 1</span>
          <h3>LAS NEUROVENTAS FRENTE A LAS VENTAS TRADICIONALES</h3>
          <p>Supera la capacitación mecánica y descubre la ciencia real detrás de la mente humana.</p>
        </div>

        <div class="pillar-body" style="padding: 22px;">
          <div class="neuro-card-content">

            <!-- Subtema 1: Los capacitadores desactualizados -->
            <div class="neuro-block">
              <span class="neuro-badge">Subcapítulo 1 • Subtema 1</span>
              <h4 class="neuro-block-title">
                <span>🤖</span> Los Capacitadores Desactualizados
              </h4>
              <p>
                La capacitación tradicional de los vendedores en casi todo el mundo es mecánica y lo que hace es <strong>volverte un robot</strong>.
              </p>
              <div class="neuro-highlight-box">
                Entre los pilares de las técnicas tradicionales encontramos que incluso enseñan qué y cómo decir a través de unas <em>oraciones típicas</em>.
              </div>
              <p>
                <strong>Lo que voy a enseñarte:</strong> Son los criterios, las estructuras y los elementos para que tú construyas tu propia comunicación y sea efectiva en tu contexto.
              </p>
            </div>

            <!-- ¿Por qué las neuroventas son una ciencia? -->
            <div class="neuro-block">
              <h4 class="neuro-block-title">
                <span>🔬</span> ¿Por qué las neuroventas son una ciencia?
              </h4>
              <p>
                Las neuroventas se consideran una ciencia porque todos sus conocimientos están fundamentados a partir de <strong>hallazgos obtenidos a través de estudios objetivos</strong>, siguiendo principios metodológicos sistemáticos.
              </p>
            </div>

            <!-- Tecnología que se utiliza para validar las neuroventas -->
            <div class="neuro-block">
              <h4 class="neuro-block-title">
                <span>⚡</span> Tecnología que se utiliza para validar las neuroventas
              </h4>
              <p>
                La pieza clave de la tecnología para validar los principios de neuroventas ha sido el caso de <strong>Quasar</strong>, que es un aparato de registro electroencefalográfico (EEG), creado originalmente para el ejército de los Estados Unidos.
              </p>
              <div class="neuro-highlight-box">
                Posee una serie de sensores para estudiar cómo afectan los estímulos al cerebro de la persona que lo lleva puesto, a partir de la medición de los impulsos eléctricos provocados por la actividad neuronal en determinadas áreas de la corteza cerebral.
              </div>
            </div>

            <!-- ¿Qué enseñan las neuroventas? -->
            <div class="neuro-block">
              <h4 class="neuro-block-title">
                <span>💡</span> ¿Qué enseñan las neuroventas?
              </h4>
              <p>
                Ante todo, <strong>cómo funciona la mente humana</strong> y cómo es el proceso de toma de decisiones de compra.
              </p>
              <p style="font-weight: 700; margin-top: 6px; margin-bottom: 4px;">Pero además enseña:</p>
              <ul class="neuro-list">
                <li>¿Qué le gusta escuchar a la mente?</li>
                <li>¿Cómo venderle de forma diferenciada a una mujer y a un hombre?</li>
                <li>¿Cómo cambiar las percepciones creadas?</li>
                <li>¿Qué compra instintivamente el ser humano?</li>
                <li>¿Cómo desarticular el precio del juego o hacerlo jugar a favor?</li>
                <li>¿Cómo involucrar a la mayoría de los sentidos en las ventas?</li>
                <li>¿Con cuáles palabras se activa la mente para comprar?</li>
              </ul>
            </div>

            <!-- ¿Por qué compra la gente? -->
            <div class="neuro-block">
              <h4 class="neuro-block-title">
                <span>🎯</span> ¿Por qué compra la gente?
              </h4>
              <div class="neuro-quote">
                "El cliente no sabe por qué está comprando un producto o servicio, esa es la pura verdad."
              </div>
              <p>
                El primer descubrimiento científico en el sector de las neuroventas es contundente:
              </p>
              <div class="neuro-stat-pill">
                <div>
                  <span class="stat-num">85%</span>
                  <span class="stat-sub">Inconsciente o Subconsciente</span>
                </div>
                <div style="font-size: 22px; opacity: 0.3;">|</div>
                <div>
                  <span class="stat-num" style="color: #cbd5e1;">15%</span>
                  <span class="stat-sub">Consciente</span>
                </div>
              </div>
            </div>

            <!-- Vender sin vender -->
            <div class="neuro-block">
              <h4 class="neuro-block-title">
                <span>🤝</span> Vender sin vender
              </h4>
              <p>
                Lo que tenemos que hacer hoy es <strong>VENDER SIN VENDER</strong>: ese es el espíritu y la esencia de las neuroventas.
              </p>
              <div class="neuro-highlight-box">
                <strong>¿Qué significa eso?</strong> Que tú tienes que hacer todo, menos estar pensando en la urgencia de vender, y cuando lo haces, <em>¡Oh sorpresa!, la gente te compra</em>. Empieza por hacer lo que muy pocos vendedores acostumbran: <strong>escuchar</strong>.
              </div>
              <p>
                Hoy se vende más escuchando que hablando, comiendo agradablemente con la gente que sentados en un espacio frío e impersonal, porque cuando uno come y se siente a gusto las emociones se solidarizan.
              </p>
              <p style="margin-top: 6px;">
                Compartir, desestresarnos, conversar sin pedir nada a cambio, emocionar, hablar de deportes, contar chistes: ese tipo de cosas vende más que el discurso bruto de ventas. <strong>Eso está probado por las neuroventas.</strong>
              </p>
            </div>

          </div>

          <div class="pillar-bottom-banner" style="margin-top: 14px;">
            ¡Vender sin vender: el espíritu de las neuroventas!
          </div>
        </div>
      </section>

    </div>
  </div>
</div>

<!-- ══════════════════════════════════════════════════════
     MODAL INDEPENDIENTE: CAPÍTULO 2
     ══════════════════════════════════════════════════════ -->
<div class="neuro-fullscreen-modal" id="modalCapitulo2" role="dialog" aria-modal="true" aria-label="Lectura de Capítulo 2">
  
  <div class="nfm-topbar nfm-topbar-green">
    <div class="nfm-title-group">
      <span style="font-size: 22px;">📗</span>
      <div>
        <h3 id="nfmModalTitle2">CAPÍTULO 2: NEUROCIENCIAS PARA LAS VENTAS</h3>
        <span style="font-size: 11.5px; color: #a7f3d0;">Jürgen Klarić • Véndele a la Mente, no a la Gente</span>
      </div>
    </div>

    <button type="button" class="nfm-close-btn" onclick="closeChapterModal('modalCapitulo2')" title="Cerrar capítulo (Esc)">
      ✕
    </button>
  </div>

  <div class="nfm-body">
    <div class="nfm-chapters-container">

      <!-- ==========================================
           CAPÍTULO 2 (MODAL COMPLETO)
           ========================================== -->
      <section class="pillar-card pillar-green" id="modalCap2" style="box-shadow: 0 4px 20px rgba(0,0,0,0.06); border-radius: 16px;">
        <div class="pillar-header" style="border-radius: 16px 16px 0 0;">
          <div class="pillar-number">2</div>
          <span class="chapter-badge">Capítulo 2</span>
          <h3>NEUROCIENCIAS PARA LAS VENTAS</h3>
          <p>Conoce la arquitectura cerebral: los tres cerebros y el código reptil que gobierna el instinto.</p>
        </div>

        <div class="pillar-body" style="padding: 22px;">
          <div class="neuro-card-content">

            <!-- ¿Cómo funciona la mente humana? Los tres cerebros -->
            <div class="neuro-block">
              <h4 class="neuro-block-title">
                <span>🧠</span> ¿Cómo funciona la mente humana?
              </h4>
              <p style="font-weight: 700; margin-bottom: 8px;">El modelo de los "Tres Cerebros":</p>

              <!-- 1. Cerebro Reptiliano -->
              <div class="brain-subcard reptil">
                <div class="brain-subcard-title">
                  <span>1. Cerebro Reptiliano</span>
                  <span class="neuro-badge" style="background:#fee2e2;color:#991b1b;">El que DECIDE</span>
                </div>
                <ul class="neuro-list">
                  <li>Es el más primitivo y poderoso.</li>
                  <li>No razona, reacciona por instinto: supervivencia, protección, pertenencia a un grupo, ahorro de energía.</li>
                  <li><strong>Es quien realmente aprieta el botón de comprar.</strong></li>
                  <li>Busca siempre: <em>seguridad, comodidad, ahorro, estatus, libertad, familia</em>.</li>
                </ul>
              </div>

              <!-- 2. Cerebro Límbico -->
              <div class="brain-subcard limbico">
                <div class="brain-subcard-title">
                  <span>2. Cerebro Límbico</span>
                  <span class="neuro-badge" style="background:#fef3c7;color:#92400e;">El que SIENTE</span>
                </div>
                <ul class="neuro-list">
                  <li>Es el centro de las emociones.</li>
                  <li>Asocia productos con sentimientos: <em>felicidad, confianza, miedo, tranquilidad</em>.</li>
                </ul>
              </div>

              <!-- 3. Cerebro Córtex -->
              <div class="brain-subcard cortex">
                <div class="brain-subcard-title">
                  <span>3. Cerebro Córtex</span>
                  <span class="neuro-badge" style="background:#dbeafe;color:#1e40af;">El que JUSTIFICA</span>
                </div>
                <ul class="neuro-list">
                  <li>Es la parte racional: números, datos, características.</li>
                  <li><strong>No decide</strong>, solo explica después por qué decidiste.</li>
                </ul>
              </div>
            </div>

            <!-- El Código Reptil -->
            <div class="neuro-block">
              <h4 class="neuro-block-title">
                <span>🦎</span> El Código Reptil
              </h4>
              <div class="neuro-quote">
                "En México dicen que emoción mata a razón, pues yo digo ahora que el instinto mata a los dos."
              </div>
              <p>
                Siempre pregúntate dónde está el reptil de tu producto o servicio. Todos tienen una necesidad reptil (a veces varias), pero siempre hay una que es el instinto más básico; el más biológico entre todos los demás, que será el que hay que señalar, y es conocido como el <strong>código reptil</strong>.
              </p>
              <div class="neuro-highlight-box">
                <strong>Por ejemplo:</strong> Fumar tiene un reptil de <em>rebeldía</em>. Cuando empiezas a hacerlo estás construyendo tu propio perfil de anarquía, aunque quizás después ya lo haces por otras razones.
              </div>
            </div>

            <!-- ¿Cuáles son los códigos reptiles en un ser humano? -->
            <div class="neuro-block">
              <h4 class="neuro-block-title">
                <span>🔑</span> ¿Cuáles son los códigos reptiles en un ser humano?
              </h4>
              <p style="margin-bottom: 8px;">
                Los principales motivadores biológicos e instintivos son:
              </p>
              <div class="reptil-chips-grid">
                <span class="reptil-chip">⚡ Anarquía</span>
                <span class="reptil-chip">😊 Felicidad</span>
                <span class="reptil-chip">🎮 Control</span>
                <span class="reptil-chip">👑 Dominación</span>
                <span class="reptil-chip">🧬 Reproducción</span>
                <span class="reptil-chip">✨ Placer</span>
                <span class="reptil-chip">🛡️ Seguridad</span>
                <span class="reptil-chip">🏡 Protección</span>
                <span class="reptil-chip">🌟 Trascendencia</span>
                <span class="reptil-chip">🤝 Unión de la tribu</span>
                <span class="reptil-chip">🧭 Exploración</span>
                <span class="reptil-chip">🏃 Movimiento</span>
              </div>
              <p style="font-size: 11px; color: #64748b; margin-top: 6px;">
                *La reproducción puede ser regulada por la cultura, pero sigue siendo un código primario en el cerebro instintivo.
              </p>
            </div>

          </div>

          <div class="pillar-bottom-banner" style="margin-top: 14px;">
            ¡El instinto mata a la razón y a la emoción!
          </div>
        </div>
      </section>

    </div>
  </div>
</div>

<!-- ══════════════════════════════════════════════════════
     MODAL INDEPENDIENTE: CAPÍTULO 3
     ══════════════════════════════════════════════════════ -->
<div class="neuro-fullscreen-modal" id="modalCapitulo3" role="dialog" aria-modal="true" aria-label="Lectura de Capítulo 3">
  
  <div class="nfm-topbar nfm-topbar-indigo">
    <div class="nfm-title-group">
      <span style="font-size: 22px;">📙</span>
      <div>
        <h3 id="nfmModalTitle3">CAPÍTULO 3: EL PROCESO DE DECISIÓN</h3>
        <span style="font-size: 11.5px; color: #c7d2fe;">Jürgen Klarić • Véndele a la Mente, no a la Gente</span>
      </div>
    </div>

    <button type="button" class="nfm-close-btn" onclick="closeChapterModal('modalCapitulo3')" title="Cerrar capítulo (Esc)">
      ✕
    </button>
  </div>

  <div class="nfm-body">
    <div class="nfm-chapters-container">

      <!-- ==========================================
           CAPÍTULO 3 (MODAL COMPLETO)
           ========================================== -->
      <section class="pillar-card pillar-indigo" id="modalCap3" style="box-shadow: 0 4px 20px rgba(0,0,0,0.06); border-radius: 16px;">
        <div class="pillar-header" style="border-radius: 16px 16px 0 0;">
          <div class="pillar-number">3</div>
          <span class="chapter-badge">Capítulo 3</span>
          <h3>EL PROCESO DE DECISIÓN</h3>
          <p>Domina los 3 escenarios, la fórmula A-E-R, los neurotransmisores y las acciones concretas.</p>
        </div>

        <div class="pillar-body" style="padding: 22px;">
          <div class="neuro-card-content">

            <!-- Los Tres Escenarios Emocionales -->
            <div class="neuro-block">
              <h4 class="neuro-block-title">
                <span>🎭</span> Los Tres Escenarios Emocionales
              </h4>
              <p>
                Cuando la necesidad reptil o instintiva es cubierta, debemos continuar con la siguiente etapa y es comprender cómo las personas toman decisiones.
              </p>
              <div class="neuro-highlight-box">
                La mente normalmente necesita <strong>tres escenarios antes de optar</strong>, ni cuatro porque se confunde. Siempre debe tener tres alternativas porque si no se las das va a renunciar a tu ofrecimiento y saldrá a ver dónde las consigue.
              </div>

              <!-- Escenario 1 -->
              <div class="scenario-card">
                <div class="scenario-title">Escenario 1 — Quedarse como está (no comprar nada)</div>
                <span class="scenario-quote">"Seguiré haciendo lo que siempre he hecho"</span>
                <ul class="neuro-list">
                  <li>Es la opción de no cambio, la zona de confort.</li>
                  <li>El cerebro la usa como referencia para comparar las otras dos.</li>
                </ul>
              </div>

              <!-- Escenario 2 -->
              <div class="scenario-card">
                <div class="scenario-title">Escenario 2 — Elegir tu alternativa económica / básica</div>
                <span class="scenario-quote">"Puedo empezar con algo sencillo"</span>
                <ul class="neuro-list">
                  <li>Es la opción de entrada, accesible.</li>
                  <li>Le muestra al cerebro que sí es posible dar el paso sin mucho riesgo.</li>
                </ul>
              </div>

              <!-- Escenario 3 -->
              <div class="scenario-card">
                <div class="scenario-title">Escenario 3 — Elegir tu opción ideal / completa</div>
                <span class="scenario-quote">"Obtener todo lo que realmente quiero"</span>
                <ul class="neuro-list">
                  <li>Es la opción de valor completo, la más atractiva.</li>
                  <li>Al compararla con las otras dos, el cerebro siente que "gana" al elegirla.</li>
                </ul>
              </div>
            </div>

            <!-- La Fórmula que Decide la Compra: Atención, Emoción y Recordación -->
            <div class="neuro-block">
              <h4 class="neuro-block-title">
                <span>📈</span> La Fórmula que Decide la Compra: A → E → R
              </h4>
              <div class="aer-badge-flow">
                <span class="aer-step">A: Atención</span>
                <span>→</span>
                <span class="aer-step">E: Emoción</span>
                <span>→</span>
                <span class="aer-step">R: Recordación</span>
              </div>

              <div style="margin-top: 8px;">
                <p><strong>1. Atención:</strong> Lograr que la persona se enfoque en ti. Si no captas su atención primero, el proceso nunca empieza.</p>
                <ul class="neuro-list">
                  <li>Rompe su rutina con algo nuevo, inesperado o relevante.</li>
                  <li>Solo cuando te presta atención, su cerebro está abierto a recibir tu mensaje.</li>
                </ul>
              </div>

              <div style="margin-top: 8px;">
                <p><strong>2. Emoción:</strong> Crear una asociación emocional positiva entre tu producto y lo que la persona desea.</p>
                <ul class="neuro-list">
                  <li>No basta con que te escuche; debe sentir que esto es para él/ella.</li>
                  <li>Aquí es donde nace el deseo de tenerlo.</li>
                  <li>Sin emoción, la persona se queda indiferente: <em>"es interesante, pero no lo necesito"</em>.</li>
                </ul>
              </div>

              <div style="margin-top: 8px;">
                <p><strong>3. Recordación:</strong> Conectar ese sentimiento con su propia historia de vida y sus instintos, de modo que recuerde por qué le importa.</p>
                <ul class="neuro-list">
                  <li>Le muestras cómo su vida mejora con esto.</li>
                  <li>Es el mensaje que se queda grabado y lo impulsa a actuar.</li>
                  <li>Aquí es donde la decisión se consolida.</li>
                </ul>
              </div>
            </div>

            <!-- ¿Cómo usar los Neurotransmisores a tu favor? -->
            <div class="neuro-block">
              <h4 class="neuro-block-title">
                <span>🧪</span> ¿Cómo usar los Neurotransmisores a tu favor?
              </h4>

              <!-- Noradrenalina -->
              <div class="neurotrans-card">
                <div class="neurotrans-title">
                  <span>⚡ Noradrenalina</span>
                  <span class="neurotrans-badge">Captar la atención</span>
                </div>
                <p><strong>Qué hace:</strong> Se activa ante lo nuevo, lo sorpresivo y lo inesperado. Rompe la monotonía.</p>
                <p style="margin-top: 4px;"><strong>Cómo usarlo:</strong></p>
                <ul class="neuro-list">
                  <li>Presenta tu mensaje con un enfoque diferente, no como todo el mundo.</li>
                  <li>Muestra algo que la persona no esperaba ver.</li>
                  <li>Cambia la perspectiva: <em>"¿Sabías que hay otra forma de ver tus finanzas?"</em></li>
                  <li>No hables igual que todos; sé único para que el cerebro diga: <em>"¡Espera, esto me interesa!"</em></li>
                </ul>
              </div>

              <!-- Dopamina -->
              <div class="neurotrans-card">
                <div class="neurotrans-title">
                  <span>✨ Dopamina</span>
                  <span class="neurotrans-badge">Placer y deseo</span>
                </div>
                <p><strong>Qué hace:</strong> Es el químico del cerebro que nos hace sentir bien. Se libera cuando anticipamos una recompensa y nos impulsa a repetir la conducta.</p>
                <p style="margin-top: 4px;"><strong>Cómo usarlo:</strong></p>
                <ul class="neuro-list">
                  <li>Muestra el beneficio que obtendrá, no solo la información.</li>
                  <li>Crea sensación de progreso: <em>"Cada paso que das te acerca a tu libertad financiera"</em>.</li>
                  <li>Celebra los logros, aunque sean pequeños.</li>
                  <li>Dale metas claras y alcanzables: el cerebro ama sentir que avanza.</li>
                  <li>Haz que imagine cómo será su vida cuando aplique lo que aprenda contigo.</li>
                </ul>
              </div>

              <!-- Acetilcolina -->
              <div class="neurotrans-card">
                <div class="neurotrans-title">
                  <span>🔗 Acetilcolina</span>
                  <span class="neurotrans-badge">Enseñar y conectar</span>
                </div>
                <p><strong>Qué hace:</strong> Ayuda al cerebro a aprender y a relacionar lo nuevo con lo que ya conoce.</p>
                <p style="margin-top: 4px;"><strong>Cómo usarlo:</strong></p>
                <ul class="neuro-list">
                  <li>Usa ejemplos de su vida cotidiana.</li>
                  <li>Conecta conceptos nuevos con lo que ya sabe.</li>
                  <li>Explica paso a paso, sin abrumar: <em>"Ya sabes cómo funciona… pues con el dinero funciona igual"</em>.</li>
                </ul>
              </div>

              <!-- Endorfina -->
              <div class="neurotrans-card">
                <div class="neurotrans-title">
                  <span>🛡️ Endorfina</span>
                  <span class="neurotrans-badge">Aliviar miedo y preocupación</span>
                </div>
                <p><strong>Qué hace:</strong> Reduce el dolor y la tensión. Da sensación de alivio y calma.</p>
                <p style="margin-top: 4px;"><strong>Cómo usarlo:</strong></p>
                <ul class="neuro-list">
                  <li>Valida sus preocupaciones: <em>"Es normal sentirse abrumado con el dinero"</em>.</li>
                  <li>Quita el miedo: <em>"No necesitas ser experto para empezar, solo dar el primer paso"</em>.</li>
                  <li>Transmite seguridad y tranquilidad, no presión.</li>
                  <li>Hazle sentir comprendido y acompañado.</li>
                </ul>
              </div>

              <!-- Serotonina -->
              <div class="neurotrans-card">
                <div class="neurotrans-title">
                  <span>🌟 Serotonina</span>
                  <span class="neurotrans-badge">Confianza y pertenencia</span>
                </div>
                <p><strong>Qué hace:</strong> Relacionada con el bienestar, el estatus y sentir que pertenecemos a algo.</p>
                <p style="margin-top: 4px;"><strong>Cómo usarlo:</strong></p>
                <ul class="neuro-list">
                  <li>Hazle sentir que no está solo: <em>"Miles de personas ya están transformando su relación con el dinero"</em>.</li>
                  <li>Reconoce su esfuerzo y progreso.</li>
                  <li>Comparte historias de personas como él/ella que ya lograron cambios.</li>
                  <li>Crea identidad: <em>"Tú también puedes tomar el control de tu futuro"</em>.</li>
                </ul>
              </div>
            </div>

            <!-- Acciones Concretas en el Proceso de Venta -->
            <div class="neuro-block">
              <h4 class="neuro-block-title">
                <span>📋</span> Acciones Concretas en el Proceso de Venta
              </h4>

              <div class="action-group">
                <div class="action-group-title">1. Para lograr la Atención:</div>
                <ul class="neuro-list">
                  <li>Busca elementos conocidos.</li>
                  <li>Busca elementos novedosos.</li>
                  <li>Haz que comprenda.</li>
                  <li>Genera expectativa.</li>
                  <li>Asocia elementos.</li>
                  <li>Dale la forma correcta de atención.</li>
                </ul>
              </div>

              <div class="action-group" style="border-left-color: #10b981;">
                <div class="action-group-title" style="color: #047857;">2. Para lograr la Emoción:</div>
                <ul class="neuro-list">
                  <li>Involúcrate emocionalmente.</li>
                  <li>Permite que exprese sus emociones.</li>
                  <li>Comprende y acalla sus miedos.</li>
                  <li>Háblale de experiencias emocionales positivas.</li>
                  <li>Facilita la evasión y el escape.</li>
                </ul>
              </div>

              <div class="action-group" style="border-left-color: #8b5cf6;">
                <div class="action-group-title" style="color: #6d28d9;">3. Para lograr Recordación:</div>
                <ul class="neuro-list">
                  <li>Favorece la asociación con elementos conocidos.</li>
                  <li>Ayúdale a clasificar y categorizar.</li>
                </ul>
              </div>
            </div>

          </div>

          <div class="pillar-bottom-banner" style="margin-top: 14px;">
            ¡Atención → Emoción → Recordación: la fórmula definitiva!
          </div>
        </div>
      </section>

    </div>
  </div>
</div>

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
  font-size: 15px !important;
  font-weight: 800 !important;
  color: #0f172a !important;
  margin: 0 !important;
}
.svm-meta span {
  font-size: 11.5px !important;
  color: #64748b !important;
  display: block !important;
}
.svm-close-btn {
  background: #e2e8f0 !important;
  border: none !important;
  width: 32px !important;
  height: 32px !important;
  border-radius: 50% !important;
  font-size: 18px !important;
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
  font-size: 10.5px !important;
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
  font-size: 11px !important;
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
  font-size: 11px !important;
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
  font-size: 13.5px !important;
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
  font-size: 12.5px !important;
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
  font-size: 11px !important;
  font-weight: 700 !important;
  margin-bottom: 12px !important;
}
.svm-comments-section {
  border-top: 1px solid #f1f5f9 !important;
  padding-top: 10px !important;
}
.svm-comments-label {
  font-size: 11px !important;
  font-weight: 700 !important;
  color: #64748b !important;
  margin-bottom: 8px !important;
  display: flex !important;
  align-items: center !important;
  justify-content: space-between !important;
}
.svm-comment-sample {
  font-size: 11.5px !important;
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
  font-size: 11.5px !important;
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
  font-size: 11.5px !important;
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
          <span style="color:#00703c; font-size:11px;">🟢 En línea</span>
        </div>
        <div class="svm-comment-sample" id="svmCommentsList">
          <strong>Comunidad Oficial:</strong> "¡Gran testimonio! Tu disciplina financiera inspira a toda la plataforma."
        </div>
        <div class="svm-comment-input-row">
          <input type="text" id="svmNewComment" class="svm-comment-input" placeholder="Escribe un mensaje de apoyo o felicitación...">
          <button type="button" class="svm-send-btn" onclick="postTestimonialComment()">Comentar</button>
        </div>
      </div>
    </div>
  </div>
</div>

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
      defaultComment: '<strong>Laura T.:</strong> "¡Felicidades Jorge! Entender las neuroventas cambia por completo los ingresos."'
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

  function postTestimonialComment() {
    var input = document.getElementById('svmNewComment');
    if (!input || !input.value.trim()) return;
    var list = document.getElementById('svmCommentsList');
    var newMsg = document.createElement('div');
    newMsg.className = 'svm-comment-sample';
    newMsg.style.marginTop = '6px';
    newMsg.style.borderLeft = '3px solid #10b981';
    newMsg.innerHTML = '<strong>Tú:</strong> "' + input.value.trim() + '"';
    list.appendChild(newMsg);
    input.value = '';
  }

  // ── Modales de Capítulos Independientes (Sin menú ni dependencias) ──
  function openChapterModal(modalId) {
    // Cerrar cualquier otro modal que pudiera estar abierto
    closeChapterModal('modalCapitulo1');
    closeChapterModal('modalCapitulo2');
    closeChapterModal('modalCapitulo3');

    var modal = document.getElementById(modalId);
    if (!modal) return;
    modal.classList.add('is-active');
    document.documentElement.classList.add('demo-modal-open');
    document.body.classList.add('demo-modal-open');

    var body = modal.querySelector('.nfm-body');
    if (body) body.scrollTop = 0;
  }

  function closeChapterModal(modalId) {
    var modal = document.getElementById(modalId);
    if (modal) { modal.style.display = 'none'; modal.classList.remove('is-active'); }

    // Verificar si queda algún modal abierto antes de quitar clase de bloqueo de scroll
    var hasActive = document.querySelector('.neuro-fullscreen-modal.is-active, .student-video-modal.is-active');
    if (!hasActive) {
      document.documentElement.classList.remove('demo-modal-open');
      document.body.classList.remove('demo-modal-open');
    }
  }

  // Compatibilidad hacia atrás
  function openChapterOnly(capId) {
    if (capId === 'cap1') openChapterModal('modalCapitulo1');
    else if (capId === 'cap2') openChapterModal('modalCapitulo2');
    else if (capId === 'cap3') openChapterModal('modalCapitulo3');
  }

  function closeNeuroFullscreenModal() {
    closeChapterModal('modalCapitulo1');
    closeChapterModal('modalCapitulo2');
    closeChapterModal('modalCapitulo3');
  }

  // Cerrar con Escape
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' || e.key === 'Esc') {
      closeChapterModal('modalCapitulo1');
      closeChapterModal('modalCapitulo2');
      closeChapterModal('modalCapitulo3');
      closeStudentTestimonial();
    }
  });
</script>
